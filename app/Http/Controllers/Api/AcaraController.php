<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Acara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AcaraController extends Controller
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

        $path = $request->file('image_path')->store('acara', 'public');

        $acara = Acara::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'image_path' => $path,
        ]);

        // Cek apakah berhasil
        if ($acara) {
            return response()->json(['success', 'Berita acara berhasil ditambahkan!'], 200);
        } else {
            return response()->json(['error', 'Gagal menyimpan data.']);
        }
    }
}
