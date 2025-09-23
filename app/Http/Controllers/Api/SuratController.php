<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use App\Models\NomorSurat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    // Ambil semua jenis surat
    public function getJenisSurat()
    {
        $jenisSurat = JenisSurat::all();
        return response()->json(['jenis_surat' => $jenisSurat]);
    }

    // Tambah jenis surat
    public function storeJenisSurat(Request $request)
    {
        $request->validate([
            'kode_jenis' => 'required|string|max:10',
            'nama_jenis' => 'required|string|max:255',
            'level_surat' => 'required|string|max:10',
        ]);

        $jenis = JenisSurat::create($request->all());

        return response()->json([
            'message' => 'Jenis surat berhasil ditambahkan.',
            'data' => $jenis,
        ], 201);
    }

    // Buat nomor surat
    public function storeNomorSurat(Request $request)
    {
        $request->validate([
            'jenis_surat_id' => 'required|exists:jenis_surat,id',
        ]);

        $jenis = JenisSurat::findOrFail($request->jenis_surat_id);
        $tahun = now()->year;
        $jumlahTahunIni = NomorSurat::whereYear('created_at', $tahun)->count() + 1;
        $nomorUrut = str_pad($jumlahTahunIni, 3, '0', STR_PAD_LEFT);

        $nomorSurat = "{$nomorUrut}/{$jenis->kode_jenis}/ISC/{$jenis->level_surat}/{$tahun}";

        $surat = NomorSurat::create([
            'id_isc' => auth()->user()->id_isc,
            'jenis_surat_id' => $jenis->id,
            'nomor_surat' => $nomorSurat,
            'tanggal_pengajuan' => now()->toDateString(),
            'waktu_pengajuan' => now()->toTimeString(),
        ]);

        return response()->json([
            'message' => 'Surat berhasil dibuat.',
            'nomor_surat' => $nomorSurat,
            'data' => $surat
        ], 201);
    }

    // List semua nomor surat
    public function indexNomorSurat()
    {
        $nomorSurat = NomorSurat::with('jenisSurat')->get();
        return response()->json(['data' => $nomorSurat]);
    }

    // Detail 1 nomor surat
    public function showNomorSurat($id)
    {
        $surat = NomorSurat::with(['jenisSurat', 'mahasiswa'])->find($id);

        if (!$surat) {
            return response()->json(['error' => 'Surat tidak ditemukan.'], 404);
        }

        return response()->json(['data' => $surat]);
    }
}
