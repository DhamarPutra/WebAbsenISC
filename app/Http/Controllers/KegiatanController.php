<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function create()
    {
        return view('admin.cms.kegiatan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'image_path' => 'required|image|mimes:jpg,png,jpeg|max:5120',
        ]);

        $path = $request->file('image_path')->store('kegiatan', 'public');

        $kegiatan = Kegiatan::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'image_path' => $path,
        ]);

        // Cek apakah berhasil
        if ($kegiatan) {
            return back()->with('success', 'Kegiatan berhasil ditambahkan!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data.');
        }
    }
}
