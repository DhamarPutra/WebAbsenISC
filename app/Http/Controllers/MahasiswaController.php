<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function edit($id_isc)
    {
        $mahasiswa = Mahasiswa::where('id_isc', $id_isc)->firstOrFail();
        $role = User::where('id_isc', $id_isc)->value('role') ?? 'user';
        $user = User::where('id_isc', $id_isc)->first();
        return view('admin.mahasiswa.edit', compact('mahasiswa', 'role', 'user'));
    }

    public function update(Request $request, $id_isc)
    {
        $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'id_isc' => 'required|string|max:10',
            'peminatan' => 'required|string',
            'role' => 'required|string',
        ]);

        $user = User::where('id_isc', $id_isc)->first();

        $mahasiswa = Mahasiswa::where('id_isc', $id_isc)->firstOrFail();

        $mahasiswa->update([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'id_isc' => $request->id_isc,
            'peminatan' => $request->peminatan,
        ]);

        if ($user) {
            $user->update([
                'role' => $request->role,
            ]);
        }

        return redirect()->route('bidang.index', ['bidang' => $request->peminatan])
            ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy($id_isc)
    {
        $mahasiswa = Mahasiswa::where('id_isc', $id_isc)->firstOrFail();
        $mahasiswa->delete();

        return back()->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
