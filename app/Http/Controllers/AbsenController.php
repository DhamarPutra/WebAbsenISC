<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Absen;
use Illuminate\Support\Facades\Log;

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

        return view('user.absen.check', compact('absens'));
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

        // Cek sudah absen atau belum
        $alreadyAbsent = Absen::where('id_isc', $id_isc)
            ->where('pertemuan', $pertemuan)
            ->exists();

        if ($alreadyAbsent) {
            return response()->json(['message' => 'Absen untuk pertemuan ini sudah ada'], 409);
        }

        // Simpan absen baru
        Absen::create([
            'id_isc' => $id_isc,
            'pertemuan' => $pertemuan,
            'status' => $status,
        ]);

        return response()->json([
            'message' => 'Absen berhasil disimpan',
            'id_isc' => $id_isc,
            'pertemuan' => $pertemuan,
            'status' => $status,
            'nama_mahasiswa' => $mahasiswa->nama_mahasiswa,
        ], 201);
    }

    public function markRemainingAbsent(Request $request)
    {
        $request->validate([
            'pertemuan' => 'required|integer',
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

        return back()->with('success', 'Mahasiswa yang belum absen telah ditandai sebagai Tidak Hadir.');
    }

    public function scan()
    {
        return view('admin.absen.scan');
    }

    public function manual(Request $request)
    {
        $bidang = $request->query('bidang');
        $pertemuan = $request->query('pertemuan', 1);

        $query = Mahasiswa::query();

        if ($bidang) {
            $query->where('peminatan', $bidang);
        }

        $mahasiswa = $query->with(['absens' => function ($q) use ($pertemuan) {
            $q->where('pertemuan', $pertemuan);
        }])->orderBy('nama_mahasiswa', 'asc')->get();

        $count = $mahasiswa->count();

        return view('admin.absen.manual', compact('mahasiswa', 'bidang', 'count', 'pertemuan'));
    }
}
