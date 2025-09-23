<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function edit($id_isc)
    {
        $mahasiswa = Mahasiswa::where('id_isc', $id_isc)->firstOrFail();
        $user = User::where('id_isc', $id_isc)->first();
        $role = $user->role ?? 'user';

        return response()->json([
            'mahasiswa' => $mahasiswa,
            'user' => $user,
            'role' => $role,
        ]);
    }

    public function show($id_isc)
    {
        $mahasiswa = Mahasiswa::where('id_isc', $id_isc)->first();

        if (!$mahasiswa) {
            return response()->json(['error' => 'Mahasiswa tidak ditemukan'], 404);
        }

        $user = User::where('id_isc', $id_isc)->first();
        $role = $user ? $user->role : 'user';

        return response()->json([
            'mahasiswa' => $mahasiswa,
            'role' => $role,
        ]);
    }

    // PUT /api/mahasiswa/{id_isc}
    public function update(Request $request, $id_isc)
    {
        $validator = Validator::make($request->all(), [
            'nama_mahasiswa' => 'required|string|max:255',
            'id_isc' => 'required|string|max:10',
            'peminatan' => 'required|string',
            'role' => 'required|string|in:admin,koor,user',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $mahasiswa = Mahasiswa::where('id_isc', $id_isc)->first();

        if (!$mahasiswa) {
            return response()->json(['error' => 'Mahasiswa tidak ditemukan'], 404);
        }

        $mahasiswa->update([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'id_isc' => $request->id_isc,
            'peminatan' => $request->peminatan,
        ]);

        $user = User::where('id_isc', $id_isc)->first();

        if ($user) {
            $user->update([
                'role' => $request->role,
                'id_isc' => $request->id_isc,
                'nama_mahasiswa' => $request->nama_mahasiswa,
            ]);
        }

        return response()->json([
            'message' => 'Data mahasiswa berhasil diperbarui',
            'mahasiswa' => $mahasiswa,
            'user' => $user,
        ], 200);
    }

    // DELETE /api/mahasiswa/{id_isc}
    public function destroy($id_isc)
    {
        $mahasiswa = Mahasiswa::where('id_isc', $id_isc)->first();

        if (!$mahasiswa) {
            return response()->json(['error' => 'Mahasiswa tidak ditemukan'], 404);
        }

        $mahasiswa->delete();

        return response()->json(['message' => 'Data mahasiswa berhasil dihapus'], 200);
    }
}
