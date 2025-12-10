<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $isAdmin = Auth::check() && Auth::user()->role === 'admin';
        $isLoggedIn = Auth::check();
        return view('auth.register', compact('isAdmin', 'isLoggedIn'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $isAdmin = Auth::check() && Auth::user()->role === 'admin';
        $isLoggedIn = Auth::check();
        
        // If not logged in, only allow specific roles
        if (!$isLoggedIn && !in_array($request->role, ['orang_tua', 'siswa', 'wali_kelas', 'guru'])) {
            return redirect()->route('register')->with('error', 'Role tidak diizinkan untuk registrasi publik.');
        }
        
        // If logged in but not admin, only allow specific roles
        if ($isLoggedIn && !$isAdmin && !in_array($request->role, ['orang_tua', 'siswa', 'wali_kelas', 'guru'])) {
            return redirect()->route('register')->with('error', 'Anda tidak memiliki akses untuk membuat akun dengan role ini.');
        }

        // Special validation for kesiswaan and kepala_sekolah
        if (in_array($request->role, ['kesiswaan', 'kepala_sekolah'])) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'min:6', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'role' => ['required', 'string', 'in:kesiswaan,kepala_sekolah'],
            ]);
            
            $username = $request->username;
            $email = $request->role . '@smk.sch.id';
        } else {
            // Regular validation for other roles
            $validationRules = [
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'role' => ['required', 'string', 'in:admin,bk,wali_kelas,guru,orang_tua,siswa'],
            ];
            
            // Add name validation for roles that don't use related records
            if (!in_array($request->role, ['guru', 'siswa'])) {
                $validationRules['name'] = ['required', 'string', 'max:255'];
            }
            
            // Add username validation for roles that need it
            if (!in_array($request->role, ['guru', 'siswa'])) {
                $validationRules['username'] = ['required', 'string', 'min:6', 'max:255', 'unique:'.User::class];
            }
            
            // Add specific validation for roles that need related records
            if (in_array($request->role, ['guru', 'wali_kelas', 'bk'])) {
                $validationRules['guru_id'] = ['required', 'exists:guru,id'];
            }
            
            if ($request->role === 'siswa') {
                $validationRules['siswa_id'] = ['required', 'exists:siswa,id'];
            }
            
            if ($request->role === 'orang_tua') {
                $validationRules['siswa_id'] = ['required', 'exists:siswa,id'];
                $validationRules['nama_ayah'] = ['nullable', 'string', 'max:255'];
                $validationRules['nama_ibu'] = ['nullable', 'string', 'max:255'];
            }
            
            $request->validate($validationRules);
            
            $username = $request->username ?? null;
            $email = $request->role . '_' . time() . '@smk.sch.id'; // Generate email for roles without username
        }

        try {
            // Additional validation for specific roles
            if (in_array($request->role, ['guru', 'wali_kelas', 'bk']) && $request->guru_id) {
                $guru = \App\Models\Guru::findOrFail($request->guru_id);
                if ($guru->user_id) {
                    return redirect()->route('register')->with('error', 'Guru ' . $guru->nama . ' sudah memiliki akun!');
                }
            }
            
            if ($request->role === 'siswa' && $request->siswa_id) {
                $siswa = Siswa::findOrFail($request->siswa_id);
                if ($siswa->user_id) {
                    return redirect()->route('register')->with('error', 'Siswa ' . $siswa->nama . ' sudah memiliki akun!');
                }
            }
            
            if ($request->role === 'orang_tua' && $request->siswa_id) {
                $siswa = Siswa::findOrFail($request->siswa_id);
                if ($siswa->orang_tua_user_id) {
                    return redirect()->route('register')->with('error', 'Orang tua siswa ' . $siswa->nama . ' sudah memiliki akun!');
                }
            }

            // Get name from related record for guru and siswa
            $name = $request->name;
            if (in_array($request->role, ['guru', 'wali_kelas', 'bk']) && $request->guru_id) {
                $guru = \App\Models\Guru::findOrFail($request->guru_id);
                $name = $guru->nama;
            } elseif ($request->role === 'siswa' && $request->siswa_id) {
                $siswa = Siswa::findOrFail($request->siswa_id);
                $name = $siswa->nama;
            }
            
            // Determine final role - wali_kelas should get wali_kelas role
            $finalRole = $request->role;
            if ($request->role === 'wali_kelas' && $request->guru_id) {
                $guru = \App\Models\Guru::findOrFail($request->guru_id);
                if ($guru->wali_kelas) {
                    $finalRole = 'wali_kelas';
                } else {
                    return redirect()->route('register')->with('error', 'Guru yang dipilih bukan wali kelas!');
                }
            }
            
            $user = User::create([
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'password' => Hash::make($request->password),
                'plain_password' => $request->password,
                'role' => $finalRole,
                'is_verified' => $isAdmin, // Auto-verify if admin creates account
                'verified_at' => $isAdmin ? now() : null,
                'verified_by' => $isAdmin ? Auth::id() : null,
            ]);

            // Link user to related records
            if (in_array($request->role, ['guru', 'wali_kelas', 'bk']) && $request->guru_id) {
                $guru = \App\Models\Guru::findOrFail($request->guru_id);
                $guru->user_id = $user->id;
                $guru->save();
                if ($finalRole === 'wali_kelas') {
                    $roleText = 'wali kelas ' . $guru->wali_kelas;
                } elseif ($finalRole === 'bk') {
                    $roleText = 'guru BK';
                } else {
                    $roleText = 'guru';
                }
                $successMessage = 'Akun ' . $roleText . ' berhasil dibuat untuk ' . $guru->nama . ' dengan username: ' . $username;
            } elseif ($request->role === 'siswa' && $request->siswa_id) {
                $siswa = Siswa::findOrFail($request->siswa_id);
                $siswa->user_id = $user->id;
                $siswa->save();
                if ($isAdmin) {
                    $successMessage = 'Akun siswa berhasil dibuat untuk ' . $siswa->nama . ' dengan username: ' . $username;
                } else {
                    $successMessage = 'Akun siswa berhasil dibuat untuk ' . $siswa->nama . ' dengan username: ' . $username . '. Tunggu verifikasi dari admin untuk dapat login.';
                }
            } elseif ($request->role === 'orang_tua' && $request->siswa_id) {
                $siswa = Siswa::findOrFail($request->siswa_id);
                $siswa->orang_tua_user_id = $user->id;
                $siswa->save();
                if ($isAdmin) {
                    $successMessage = 'Akun orang tua berhasil dibuat untuk anak ' . $siswa->nama . ' dengan username: ' . $username;
                } else {
                    $successMessage = 'Akun orang tua berhasil dibuat untuk anak ' . $siswa->nama . ' dengan username: ' . $username . '. Tunggu verifikasi dari admin untuk dapat login.';
                }
            } else {
                if ($isAdmin) {
                    $successMessage = 'User ' . $request->name . ' berhasil didaftarkan dengan role ' . $request->role . '!';
                } else {
                    $successMessage = 'Akun berhasil dibuat dengan username: ' . $username . '. Tunggu verifikasi dari admin untuk dapat login.';
                }
            }

            event(new Registered($user));

            return redirect()->route('register')->with('success', $successMessage);
        } catch (\Exception $e) {
            return redirect()->route('register')->with('error', 'Gagal mendaftarkan user: ' . $e->getMessage());
        }
    }
}
