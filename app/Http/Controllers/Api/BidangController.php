<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    // Admin: get semua mahasiswa, dengan filter bidang dan pencarian
    public function index(Request $request)
    {
        $bidang = $request->query('bidang');
        $search = $request->query('search');

        $query = Mahasiswa::withCount('absens');

        if ($bidang) {
            $query->where('peminatan', $bidang);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_mahasiswa', 'like', '%' . $search . '%')
                    ->orWhere('id_isc', 'like', '%' . $search . '%')
                    ->orWhere('peminatan', 'like', '%' . $search . '%');
            });
        }

        $mahasiswa = $query->paginate(10);

        return response()->json([
            'message' => 'Data mahasiswa berhasil diambil',
            'total' => $mahasiswa->total(),
            'data' => [
                'data' => $mahasiswa->items()
            ],
        ]);
    }

    // Koor: hanya mahasiswa sesuai bidang (peminatan) koor login
    public function indexKoor(Request $request)
    {
        $user = $request->user();
        $bidang = $user->mahasiswa->peminatan ?? null;

        if (!$bidang) {
            return response()->json(['error' => 'Peminatan tidak ditemukan untuk user ini.'], 400);
        }

        $search = $request->query('search');

        $query = Mahasiswa::withCount('absens')->where('peminatan', $bidang);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_mahasiswa', 'like', '%' . $search . '%')
                    ->orWhere('id_isc', 'like', '%' . $search . '%')
                    ->orWhere('peminatan', 'like', '%' . $search . '%');
            });
        }

        $mahasiswa = $query->paginate(10);

        return response()->json([
            'message' => 'Data mahasiswa bidang ' . $bidang . ' berhasil diambil',
            'total' => $mahasiswa->total(),
            'data' => $mahasiswa,
        ]);
    }
}
