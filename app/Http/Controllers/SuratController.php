<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\NomorSurat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function createNomorSurat()
    {
        $jenisSurat = JenisSurat::all();
        return view('admin.surat.requestNomorSurat', compact('jenisSurat'));
    }

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

        NomorSurat::create([
            'id_isc' => auth()->user()->id_isc,
            'jenis_surat_id' => $jenis->id,
            'nomor_surat' => $nomorSurat,
            'tanggal_pengajuan' => now()->toDateString(),
            'waktu_pengajuan' => now()->toTimeString(),
        ]);

        return redirect()->back()->with('success', 'Surat berhasil dibuat dengan nomor: ' . $nomorSurat);
    }

    public function indexNomorSurat()
    {
        $nomorSurat = NomorSurat::with('jenisSurat')->get();
        return view('admin.surat.listNomorSurat', compact('nomorSurat'));
    }

    public function showNomorSurat($id)
    {
        $surat = NomorSurat::with(['jenisSurat', 'mahasiswa'])->findOrFail($id);
        return view('admin.surat.detailNomorSurat', compact('surat'));
    }

    public function createJenisSurat()
    {
        return view('admin.surat.addJenisSurat');
    }

    public function storeJenisSurat(Request $request)
    {
        $request->validate([
            'kode_jenis' => 'required|string|max:10',
            'nama_jenis' => 'required|string|max:255',
            'level_surat' => 'required|string|max:10',
        ]);

        JenisSurat::create($request->all());

        return redirect()->route('jenis-surat.create')->with('success', 'Jenis surat berhasil ditambahkan.');
    }
}
