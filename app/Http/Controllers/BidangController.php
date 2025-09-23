<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    public function index(Request $request)
    {
        $bidang = $request->query('bidang');
        $search = $request->query('search');

        $query = Mahasiswa::withCount('absens_hadir');
        $count = Mahasiswa::count();

        if ($bidang) {
            $query->where('peminatan', $bidang);
            $count = Mahasiswa::where('peminatan', $bidang)->count();
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_mahasiswa', 'like', '%' . $search . '%')
                    ->orWhere('id_isc', 'like', '%' . $search . '%')
                    ->orWhere('peminatan', 'like', '%' . $search . '%');
            });
        }

        $mahasiswa = $query->paginate(10)->withQueryString();

        return view('admin.bidang.index', compact('mahasiswa', 'bidang', 'search', 'count'))->with('count', $count);
    }

    public function indexKoor(Request $request)
    {
        $userPeminatan = auth()->user()->mahasiswa->peminatan;

        // Paksa nilai bidang sesuai dengan peminatan user
        $bidang = $userPeminatan;
        $search = $request->query('search');

        $query = Mahasiswa::withCount('absens_hadir');
        $count = Mahasiswa::where('peminatan', $bidang)->count(); // Hanya hitung sesuai bidang user

        // Filter berdasarkan peminatan user
        $query->where('peminatan', $bidang);

        // Jika ada pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_mahasiswa', 'like', '%' . $search . '%')
                    ->orWhere('id_isc', 'like', '%' . $search . '%')
                    ->orWhere('peminatan', 'like', '%' . $search . '%');
            });
        }

        $mahasiswa = $query->paginate(10)->withQueryString();

        return view('admin.bidang.index', compact('mahasiswa', 'bidang', 'search', 'count'));
    }
}
