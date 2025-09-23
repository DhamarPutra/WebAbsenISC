<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Modul;
use App\Services\GDriveService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModulController extends Controller
{
    public function index()
    {
        $user = auth()->user()->id_isc;
        $bidang = Mahasiswa::where('id_isc', $user)->value('peminatan');

        if (auth()->user()->role === 'admin' || auth()->user()->role === 'koor') {
            $modul = Modul::all();
        } else {
            $modul = Modul::where('bidang', $bidang)->get();
        }

        return response()->json(['modul' => $modul]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'file_path' => 'required|file|mimes:pdf,doc,docx,ppt,pptx|max:102400',
        ]);

        $user = auth()->user()->id_isc;
        $bidang = str_replace('/', '_', Mahasiswa::where('id_isc', $user)->value('peminatan'));
        $uploader = Mahasiswa::where('id_isc', $user)->value('nama_mahasiswa');

        $judul = strtoupper($request->judul);
        $modulFileName = "Modul {$bidang} {$judul}." . $request->file('file_path')->getClientOriginalExtension();

        // Simpan lokal
        $path = $request->file('file_path')->storeAs('modul/' . $bidang, $modulFileName, 'public');
        $fullPath = storage_path('app/public/' . $path);

        // Upload ke Google Drive
        $baseParentId = '1KYIfx4qfufzvnHhgGXDYEDzw1TwnXs2v'; // Folder induk di Drive
        $folderHierarchy = ['modul', $bidang];
        $gdriveFileId = GDriveService::uploadFile($fullPath, $modulFileName, $folderHierarchy, $baseParentId);

        // Simpan DB
        $modul = Modul::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'bidang' => $bidang,
            'uploader' => $uploader,
            'file_path' => $path,
            'gdrive_file_id' => $gdriveFileId,
        ]);

        return response()->json([
            'message' => 'Modul berhasil ditambahkan!',
            'modul' => $modul,
        ], 201);
    }

    public function destroy($id)
    {
        $modul = Modul::find($id);

        if (!$modul) {
            return response()->json(['error' => 'Modul tidak ditemukan.'], 404);
        }

        // Hapus file lokal jika ada
        if ($modul->file_path && Storage::disk('public')->exists($modul->file_path)) {
            Storage::disk('public')->delete($modul->file_path);
        }

        // Hapus dari Google Drive
        if ($modul->gdrive_file_id) {
            GDriveService::deleteFile($modul->gdrive_file_id);
        }

        $modul->delete();

        return response()->json(['message' => 'Modul berhasil dihapus.']);
    }
}
