<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KegiatanController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'image_path' => 'required|image|mimes:jpg,png,jpeg|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()->first()
            ], 422);
        }

        // Simpan gambar ke storage
        $path = $request->file('image_path')->store('kegiatan', 'public');

        // Simpan ke database
        $kegiatan = Kegiatan::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'image_path' => $path,
        ]);

        if ($kegiatan) {
            return response()->json([
                'success' => true,
                'message' => 'Kegiatan berhasil ditambahkan!',
                'data' => $kegiatan
            ], 201);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Gagal menyimpan kegiatan.'
            ], 500);
        }
    }
}
