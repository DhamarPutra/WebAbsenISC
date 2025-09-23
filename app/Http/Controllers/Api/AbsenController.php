<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Absen;

class AbsenController extends Controller
{
    public function getAbsen(Request $request)
    {
        $peminatan = $request->query('peminatan');

        $absenList = Absen::join('mahasiswa', 'absen.id_isc', '=', 'mahasiswa.id_isc')
            ->select('absen.id', 'absen.id_isc', 'absen.pertemuan', 'absen.status', 'mahasiswa.nama_mahasiswa', 'mahasiswa.peminatan')
            ->where('mahasiswa.peminatan', $peminatan)
            ->get();

        return response()->json($absenList);
    }

    public function showPresensiSaya()
    {
        $id_isc = auth()->user()->id_isc;

        $absens = Absen::where('id_isc', $id_isc)
            ->orderBy('pertemuan')
            ->get();

        return response()->json($absens);
    }

    public function addAbsen(Request $request)
    {
        $request->validate([
            'id_isc' => 'required|string',
            'pertemuan' => 'required|string',
            'status' => 'required|string',
        ]);

        $id_isc = $request->id_isc;
        $pertemuan = $request->pertemuan;
        $status = $request->status;

        // Cari mahasiswa
        $mahasiswa = Mahasiswa::find($id_isc);

        if (!$mahasiswa) {
            return response()->json(['message' => 'ID ISC not found'], 404);
        }

        Absen::updateOrCreate(
            [
                'id_isc' => $id_isc,
                'pertemuan' => $pertemuan,
            ],
            [
                'status' => $status,
            ]
        );

        return response()->json([
            'message' => 'Absen berhasil disimpan',
            'id_isc' => $id_isc,
            'pertemuan' => $pertemuan,
            'status' => $status,
            'nama_mahasiswa' => $mahasiswa->nama_mahasiswa,
        ], 200);
    }

    public function markRemainingAbsent(Request $request)
    {
        $request->validate([
            'pertemuan' => 'required|string',
        ]);

        $pertemuan = $request->pertemuan;

        $mahasiswas = Mahasiswa::whereDoesntHave('absens', function ($query) use ($pertemuan) {
            $query->where('pertemuan', $pertemuan);
        })->get();

        $data = [];

        foreach ($mahasiswas as $mhs) {
            $data[] = [
                'id_isc' => $mhs->id_isc,
                'pertemuan' => $pertemuan,
                'status' => 'Tidak Hadir',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Absen::insert($data);

        return response()->json(['message', 'Mahasiswa yang belum absen telah ditandai sebagai Tidak Hadir.'], 200);
    }

    public function countAbsent(Request $request)
    {
        $request->validate([
            'pertemuan' => 'required|integer',
            'peminatan' => 'required|string',
        ]);

        $count = Mahasiswa::where('peminatan', $request->peminatan)
            ->whereDoesntHave('absens', function ($query) use ($request) {
                $query->where('pertemuan', $request->pertemuan);
            })
            ->count();

        return response()->json([
            'absentCount' => $count
        ]);
    }

    public function scan()
    {
        return view('admin.absen.scan');
    }
}
