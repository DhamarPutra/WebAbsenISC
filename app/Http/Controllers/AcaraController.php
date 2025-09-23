<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use Illuminate\Http\Request;

class AcaraController extends Controller
{
    public function create()
    {
        return view('admin.cms.acara');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'image_path' => 'required|image|mimes:jpg,png,jpeg|max:5120',
        ]);

        $path = $request->file('image_path')->store('acara', 'public');

        $acara = Acara::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'image_path' => $path,
        ]);

        // Cek apakah berhasil
        if ($acara) {
            return back()->with('success', 'Berita acara berhasil ditambahkan!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data.');
        }
    }
}
