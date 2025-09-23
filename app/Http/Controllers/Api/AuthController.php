<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\ChangePassword;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_isc' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $user = User::where('id_isc', $request->id_isc)->first();

        if (!$user) {
            return response()->json(['error', 'ID ISC belum terdaftar.'], 404);
        }

        if ($user->has_access_mobile == 0) {
            return response()->json(['error' => 'Kamu tidak memiliki akses mobile.'], 401);
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'ID ISC atau password salah.'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil.',
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout berhasil.'], 200);
    }

    public function requestPasswordChange(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
            'selfie_image' => 'required|string',
        ]);

        $user = $request->user();

        $imageData = $request->selfie_image;
        $image = str_replace('data:image/png;base64,', '', $imageData);
        $image = str_replace(' ', '+', $image);
        $imageName = 'selfie_' . time() . '_' . $user->id_isc . '.png';
        Storage::disk('public')->put('selfies/' . $imageName, base64_decode($image));

        ChangePassword::create([
            'id_isc' => $user->id_isc,
            'new_password' => Hash::make($request->new_password),
            'selfie_path' => 'selfies/' . $imageName,
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Permintaan ganti password berhasil dikirim, menunggu persetujuan admin.']);
    }

    public function listPasswordRequests()
    {
        $requests = ChangePassword::with('user')->where('status', 'pending')->latest()->get();
        return response()->json(['requests' => $requests]);
    }

    public function approvePasswordChange($id)
    {
        $request = ChangePassword::findOrFail($id);

        User::where('id_isc', $request->id_isc)->update([
            'password' => $request->new_password
        ]);

        $request->update(['status' => 'approved']);
        Storage::disk('public')->delete($request->selfie_path);

        return response()->json(['message' => 'Password berhasil diperbarui.']);
    }

    public function rejectPasswordChange($id)
    {
        $request = ChangePassword::findOrFail($id);

        $request->update(['status' => 'rejected']);
        Storage::disk('public')->delete($request->selfie_path);

        return response()->json(['message' => 'Permintaan ganti password ditolak.']);
    }
}
