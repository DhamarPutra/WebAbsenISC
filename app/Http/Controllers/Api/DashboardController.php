<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.dashboard');
    }
    public function indexUser()
    {
        $user = auth()->user()->id_isc;
        $bidang = Mahasiswa::where('id_isc', $user)->value('peminatan');
        return view('user.dashboard.dashboard', compact('bidang'));
    }
    
    public function indexKoor()
    {
        $user = auth()->user()->id_isc;
        $bidang = Mahasiswa::where('id_isc', $user)->value('peminatan');
        return view('koor.dashboard.dashboard', compact('bidang'));
    }
}
