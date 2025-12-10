<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Check if user is verified (admin is always verified)
            if (!$user->is_verified && $user->role !== 'admin') {
                return back()->withErrors(['login' => 'Akun Anda belum diverifikasi oleh admin. Silahkan tunggu verifikasi.']);
            }
            
            Auth::login($user);
            
            // Redirect based on user's role from database
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.index');
                case 'kesiswaan':
                    return redirect()->route('kesiswaan.index');
                case 'kepala_sekolah':
                    return redirect()->route('kepsek.index');
                case 'wali_kelas':
                    return redirect()->route('wali_kelas.index');
                case 'guru':
                    return redirect()->route('guru.index');
                case 'bk':
                    return redirect()->route('bk.index');
                case 'siswa':
                    return redirect()->route('siswa.index');
                case 'orang_tua':
                    return redirect()->route('orang_tua.dashboard');
                default:
                    return redirect()->route('dashboard');
            }
        }

        return back()->withErrors(['login' => 'Username atau password tidak valid']);
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}