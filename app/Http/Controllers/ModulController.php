<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Modul;
use App\Services\GDriveService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user()->id_isc;
        $bidang = Mahasiswa::where('id_isc', $user)->value('peminatan');
        if (auth()->user()->role == 'admin' || auth()->user()->role == 'koor') {
            $modul = Modul::all();
        } else {
            $modul = Modul::where('bidang', $bidang)->get();
        }
        return view('user.modul.index', compact('modul'));
    }

    public function create()
    {
        return view('koor.modul.create');
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

        // Simpan lokal (opsional kalau lo tetep mau simpen di disk public)
        $path = $request->file('file_path')->storeAs('modul/' . $bidang, $modulFileName, 'public');
        $fullPath = storage_path('app/public/' . 'modul/' . $bidang . '/' . $modulFileName);

        $baseParentId = '1KYIfx4qfufzvnHhgGXDYEDzw1TwnXs2v';
        $folderHierarchy = ['modul', $bidang];

        $gdriveFileId = GDriveService::uploadFile($fullPath, $modulFileName, $folderHierarchy, $baseParentId);

        // Simpan ke database
        $modul = Modul::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'bidang' => Mahasiswa::where('id_isc', $user)->value('peminatan'),
            'uploader' => $uploader,
            'file_path' => $path,
            'gdrive_file_id' => $gdriveFileId,
        ]);

        if ($modul) {
            return back()->with('success', 'Modul berhasil ditambahkan!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data.');
        }
    }

    public function destroy($id)
    {
        $modul = Modul::where('id', $id)->firstOrFail();

        if ($modul->file_path && Storage::disk('public')->exists($modul->file_path)) {
            Storage::disk('public')->delete($modul->file_path);
        }

        if ($modul->gdrive_file_id) {
            GDriveService::deleteFile($modul->gdrive_file_id);
        }

        $modul->delete();

        return back()->with('success', 'Modul berhasil dihapus.');
    }
}
