<?php

namespace App\Http\Controllers;

use App\Models\ChangePassword;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_isc' => 'required|exists:mahasiswa,id_isc',
            'password' => 'required|min:8|confirmed',
        ], [
            'id_isc.required' => 'ID ISC wajib diisi.',
            'id_isc.exists' => 'ID ISC tidak ditemukan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error', $validator->errors()->first());
        }

        $userCheck = User::where('id_isc', $request->id_isc)->first();

        if ($userCheck) {
            return back()->withInput()->with('error', 'ID ISC sudah terdaftar.');
        }

        $mahasiswa = Mahasiswa::where('id_isc', $request->id_isc)->first();

        User::create([
            'id_isc' => $request->id_isc,
            'nama_mahasiswa' => $mahasiswa->nama_mahasiswa,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('account')->with('success', 'Registrasi berhasil!');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('id_isc', 'password');

        $user = User::where('id_isc', $credentials['id_isc'])->first();

        if (!$user) {
            return back()->withInput()->with('error', 'ID ISC belum terdaftar.');
        }

        $mahasiswa = Mahasiswa::where('id_isc', $request->id_isc)->first();
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            if (Auth::user()->role == 'admin') {
                return redirect()->route('dashboard.admin')->with('success', 'Welcome, ' . $mahasiswa->nama_mahasiswa);
            } elseif (Auth::user()->role == 'koor') {
                return redirect()->route('dashboard.koor')->with('success', 'Welcome, ' . $mahasiswa->nama_mahasiswa);
            }
            return redirect()->route('dashboard.user')->with('success', 'Welcome, ' . $mahasiswa->nama_mahasiswa);
        }

        return back()->withInput()->with('error', 'ID ISC atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('account');
    }

    public function requestChangeShow()
    {
        return view('auth.change-password');
    }

    public function requestChangeStore(Request $request)
    {
        $request->validate([
            'id_isc' => 'required',
            'new_password' => 'required|min:8|confirmed',
            'selfie_image' => 'required|string',
        ]);

        $imageData = $request->selfie_image;
        $image = str_replace('data:image/png;base64,', '', $imageData);
        $image = str_replace(' ', '+', $image);
        $imageName = 'selfie_' . time() . '.png';
        Storage::disk('public')->put('selfies/' . $imageName, base64_decode($image));

        ChangePassword::create([
            'id_isc' => $request->id_isc,
            'new_password' => Hash::make($request->new_password),
            'selfie_path' => 'selfies/' . $imageName,
            'status' => 'pending',
        ]);

        return redirect()->route('account')->with('success', 'Permintaan ganti password berhasil dikirim, menunggu persetujuan admin.');
    }

    public function passwordChangeConfirmShow()
    {
        $requests = ChangePassword::with('user')->where('status', 'pending')->latest()->get();
        return view('admin.mahasiswa.password-requests', compact('requests'));
    }

    public function passwordChangeConfirmApprove($id)
    {
        $request = ChangePassword::findOrFail($id);

        User::where('id_isc', $request->id_isc)->update([
            'password' => $request->new_password
        ]);

        $request->update(['status' => 'approved']);
        Storage::disk('public')->delete($request->selfie_path);

        return back()->with('success', 'Password berhasil diperbarui.');
    }

    public function passwordChangeConfirmReject($id)
    {
        $request = ChangePassword::findOrFail($id);
        $request->update(['status' => 'rejected']);
        Storage::disk('public')->delete($request->selfie_path);

        return back()->with('success', 'Permintaan ditolak.');
    }
}
