<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Tata Tertib & Prestasi SMK Bakti Nusantara 666</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 50%, #cbd5e1 100%);
            min-height: 100vh;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .input-focus:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 32px 64px -12px rgba(0, 0, 0, 0.35);
        }
    </style>
</head>

<body class="gradient-bg">

    <div class="min-h-screen flex items-center justify-center p-4 py-8">
        <div class="w-full max-w-4xl">

            <!-- Main Content -->
            <div class="grid lg:grid-cols-2 gap-6 md:gap-8 items-center">

                <!-- Information Cards -->
                <div class="space-y-4 md:space-y-5 order-2 lg:order-1" data-aos="fade-right">

                    <!-- Login Card -->
                    <div class="glass-card rounded-xl md:rounded-2xl p-4 md:p-6 shadow-xl card-hover border-l-4 border-blue-500">
                        <div class="flex items-start gap-3 md:gap-4">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg md:rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                <i class="fas fa-sign-in-alt text-white text-base md:text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 mb-1.5 md:mb-2 text-base md:text-lg">Sudah Punya Akun?</h3>
                                <p class="text-gray-600 text-xs md:text-sm leading-relaxed mb-2 md:mb-3">
                                    Masuk ke sistem dengan akun yang sudah ada
                                </p>
                                <a href="{{ url('/login') }}" class="inline-flex items-center bg-blue-100 hover:bg-blue-200 text-blue-700 px-2.5 md:px-3 py-1.5 md:py-2 rounded-lg text-xs md:text-sm font-medium transition-all duration-300">
                                    <i class="fas fa-arrow-right mr-1.5 md:mr-2"></i>Login Sekarang
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Registration Benefits Card -->
                    <div class="glass-card rounded-xl md:rounded-2xl p-4 md:p-6 shadow-xl card-hover border-l-4 border-purple-500">
                        <div class="flex items-start gap-3 md:gap-4 mb-3 md:mb-4">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg md:rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                <i class="fas fa-crown text-white text-base md:text-lg"></i>
                            </div>
                            <h3 class="font-bold text-gray-800 text-base md:text-lg">Keuntungan Registrasi</h3>
                        </div>
                        <div class="space-y-2.5 md:space-y-3 ml-13 md:ml-16">
                            <div class="flex items-center gap-2.5 md:gap-3">
                                <div class="w-5 h-5 md:w-6 md:h-6 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-purple-600 text-xs"></i>
                                </div>
                                <span class="text-gray-700 text-xs md:text-sm font-medium">Akses sesuai role pengguna</span>
                            </div>
                            <div class="flex items-center gap-2.5 md:gap-3">
                                <div class="w-5 h-5 md:w-6 md:h-6 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-indigo-600 text-xs"></i>
                                </div>
                                <span class="text-gray-700 text-xs md:text-sm font-medium">Dashboard personal</span>
                            </div>
                            <div class="flex items-center gap-2.5 md:gap-3">
                                <div class="w-5 h-5 md:w-6 md:h-6 bg-pink-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-pink-600 text-xs"></i>
                                </div>
                                <span class="text-gray-700 text-xs md:text-sm font-medium">Notifikasi real-time</span>
                            </div>
                            <div class="flex items-center gap-2.5 md:gap-3">
                                <div class="w-5 h-5 md:w-6 md:h-6 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-trophy text-yellow-600 text-xs"></i>
                                </div>
                                <span class="text-gray-700 text-xs md:text-sm font-medium">Kelola prestasi siswa</span>
                            </div>
                        </div>
                    </div>

                    <!-- User Roles Card -->
                    <div class="glass-card rounded-2xl p-6 shadow-xl card-hover border-l-4 border-blue-500">
                        <div class="flex items-start gap-4 mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                <i class="fas fa-users-cog text-white text-lg"></i>
                            </div>
                            <h3 class="font-bold text-gray-800 text-lg">Role Pengguna</h3>
                        </div>
                        <div class="space-y-3 ml-16">
                            <div class="flex items-center gap-3">
                                <div class="w-6 h-6 bg-red-100 rounded-full flex items-center justify-center">
                                    <span class="text-red-600 text-xs font-bold">A</span>
                                </div>
                                <span class="text-gray-700 text-sm font-medium">Administrator - Akses penuh</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center">
                                    <span class="text-green-600 text-xs font-bold">BK</span>
                                </div>
                                <span class="text-gray-700 text-sm font-medium">Guru BK - Manajemen pelanggaran</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-blue-600 text-xs font-bold">W</span>
                                </div>
                                <span class="text-gray-700 text-sm font-medium">Wali Kelas - Monitor kelas</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center">
                                    <span class="text-purple-600 text-xs font-bold">KS</span>
                                </div>
                                <span class="text-gray-700 text-sm font-medium">Kepala Sekolah - Supervisi</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-6 h-6 bg-pink-100 rounded-full flex items-center justify-center">
                                    <span class="text-pink-600 text-xs font-bold">OT</span>
                                </div>
                                <span class="text-gray-700 text-sm font-medium">Orang Tua - Monitor anak</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center">
                                    <span class="text-gray-600 text-xs font-bold">G</span>
                                </div>
                                <span class="text-gray-700 text-sm font-medium">Guru - Mengajar & monitor</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-6 h-6 bg-teal-100 rounded-full flex items-center justify-center">
                                    <span class="text-teal-600 text-xs font-bold">S</span>
                                </div>
                                <span class="text-gray-700 text-sm font-medium">Siswa - Lihat data pribadi</span>
                            </div>
                        </div>
                    </div>

                    <!-- Data Security Card -->
                    <div class="glass-card rounded-2xl p-6 shadow-xl card-hover border-l-4 border-green-500">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                <i class="fas fa-lock text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 mb-2 text-lg">Keamanan Data</h3>
                                <p class="text-gray-600 text-sm leading-relaxed mb-3">
                                    Semua data pengguna dienkripsi dan disimpan dengan standar keamanan tinggi
                                </p>
                                <div class="flex flex-wrap gap-2">
                                    <div class="flex items-center gap-1 bg-green-100 px-2 py-1 rounded-full">
                                        <i class="fas fa-lock text-green-600 text-xs"></i>
                                        <span class="text-green-600 text-xs font-semibold">Encrypted</span>
                                    </div>
                                    <div class="flex items-center gap-1 bg-blue-100 px-2 py-1 rounded-full">
                                        <i class="fas fa-shield text-blue-600 text-xs"></i>
                                        <span class="text-blue-600 text-xs font-semibold">Protected</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Register Form -->
                <div class="glass-card rounded-2xl md:rounded-3xl shadow-xl p-6 md:p-8 card-hover order-1 lg:order-2" data-aos="fade-left">

                    @if(!$isAdmin)
                    <!-- Info Alert for Non-Admin -->
                    <div id="verificationAlert" class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg transition-opacity duration-500">
                        <div class="flex items-center">
                            <div class="text-blue-500 mr-2">ℹ️</div>
                            <p class="text-sm text-blue-700">Akun akan diverifikasi oleh admin sebelum dapat digunakan</p>
                        </div>
                    </div>
                    @endif

                    <!-- Back to Welcome -->
                    <div class="mb-4">
                        <a href="{{ url('/') }}" class="inline-flex items-center text-gray-600 hover:text-blue-600 text-xs md:text-sm font-medium transition-all duration-300 group">
                            <div class="w-7 h-7 md:w-8 md:h-8 bg-gray-100 group-hover:bg-blue-100 rounded-lg flex items-center justify-center mr-2 transition-all duration-300">
                                <i class="fas fa-arrow-left text-gray-600 group-hover:text-blue-600 text-xs"></i>
                            </div>
                            Kembali ke Beranda
                        </a>
                    </div>

                    <!-- Header -->
                    <div class="text-center mb-5 md:mb-6">
                        <div class="flex justify-center mb-3">
                            <div class="w-14 h-14 md:w-16 md:h-16 bg-white rounded-xl shadow-lg flex items-center justify-center">
                                <img src="{{ asset('assets/img/logo.jpg') }}" alt="Logo SMK" class="w-10 h-10 md:w-12 md:h-12 object-contain rounded-lg">
                            </div>
                        </div>
                        <h1 class="text-xl md:text-2xl font-bold text-gray-800 mb-1">Sistem Tata Tertib & Prestasi Register</h1>
                        <p class="text-gray-600 text-xs md:text-sm">Sistem Tata Tertib</p>
                        <p class="text-gray-500 text-xs italic">"Smart Discipline, Smart School."</p>
                    </div>

                    @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
                        {{ session('error') }}
                    </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST" class="space-y-4 md:space-y-5">
                        @csrf
                        
                        <!-- Role Selection Cards -->
                        <div class="mb-6">
                            <p class="text-center text-sm font-semibold text-gray-700 mb-4">Pilih Role Pengguna</p>
                            @if($isAdmin ?? false)
                            <div class="grid grid-cols-3 gap-2 mb-4">
                                <div class="role-card cursor-pointer p-3 bg-gray-50 hover:bg-blue-50 border-2 border-gray-200 hover:border-blue-400 rounded-lg transition-all duration-300 text-center" data-role="admin">
                                    <i class="fas fa-crown text-blue-600 text-lg mb-2"></i>
                                    <p class="text-xs font-medium text-gray-700">Admin</p>
                                </div>
                                <div id="kepsekCard" class="role-card cursor-pointer p-3 bg-gray-50 hover:bg-red-50 border-2 border-gray-200 hover:border-red-400 rounded-lg transition-all duration-300 text-center" data-role="kepala_sekolah">
                                    <i class="fas fa-user-tie text-red-600 text-lg mb-2"></i>
                                    <p class="text-xs font-medium text-gray-700">Kepsek</p>
                                </div>
                                <div class="role-card cursor-pointer p-3 bg-gray-50 hover:bg-purple-50 border-2 border-gray-200 hover:border-purple-400 rounded-lg transition-all duration-300 text-center" data-role="wali_kelas">
                                    <i class="fas fa-chalkboard-teacher text-purple-600 text-lg mb-2"></i>
                                    <p class="text-xs font-medium text-gray-700">Wali Kelas</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-4 gap-2">
                                                <div class="role-card cursor-pointer p-3 bg-gray-50 hover:bg-green-50 border-2 border-gray-200 hover:border-green-400 rounded-lg transition-all duration-300 text-center" data-role="bk">
                                    <i class="fas fa-user-shield text-green-600 text-lg mb-2"></i>
                                    <p class="text-xs font-medium text-gray-700">Guru BK</p>
                                </div>
                                <div class="role-card cursor-pointer p-3 bg-gray-50 hover:bg-yellow-50 border-2 border-gray-200 hover:border-yellow-400 rounded-lg transition-all duration-300 text-center" data-role="orang_tua">
                                    <i class="fas fa-users text-yellow-600 text-lg mb-2"></i>
                                    <p class="text-xs font-medium text-gray-700">Ortu</p>
                                </div>
                                <div id="kesiswaanCard" class="role-card cursor-pointer p-3 bg-gray-50 hover:bg-orange-50 border-2 border-gray-200 hover:border-orange-400 rounded-lg transition-all duration-300 text-center" data-role="kesiswaan">
                                    <i class="fas fa-clipboard-list text-orange-600 text-lg mb-2"></i>
                                    <p class="text-xs font-medium text-gray-700">Kesiswaan</p>
                                </div>
                                <div class="role-card cursor-pointer p-3 bg-gray-50 hover:bg-indigo-50 border-2 border-gray-200 hover:border-indigo-400 rounded-lg transition-all duration-300 text-center" data-role="guru">
                                    <i class="fas fa-chalkboard-teacher text-indigo-600 text-lg mb-2"></i>
                                    <p class="text-xs font-medium text-gray-700">Guru</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 gap-2 mt-2">
                                <div class="role-card cursor-pointer p-3 bg-gray-50 hover:bg-teal-50 border-2 border-gray-200 hover:border-teal-400 rounded-lg transition-all duration-300 text-center" data-role="siswa">
                                    <i class="fas fa-user-graduate text-teal-600 text-lg mb-2"></i>
                                    <p class="text-xs font-medium text-gray-700">Siswa</p>
                                </div>
                            </div>
                            @else
                            <div class="grid grid-cols-2 gap-3 mb-4">
                                <div class="role-card cursor-pointer p-3 bg-gray-50 hover:bg-yellow-50 border-2 border-gray-200 hover:border-yellow-400 rounded-lg transition-all duration-300 text-center" data-role="orang_tua">
                                    <i class="fas fa-users text-yellow-600 text-lg mb-2"></i>
                                    <p class="text-xs font-medium text-gray-700">Orang Tua</p>
                                </div>
                                <div class="role-card cursor-pointer p-3 bg-gray-50 hover:bg-teal-50 border-2 border-gray-200 hover:border-teal-400 rounded-lg transition-all duration-300 text-center" data-role="siswa">
                                    <i class="fas fa-user-graduate text-teal-600 text-lg mb-2"></i>
                                    <p class="text-xs font-medium text-gray-700">Siswa</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="role-card cursor-pointer p-3 bg-gray-50 hover:bg-purple-50 border-2 border-gray-200 hover:border-purple-400 rounded-lg transition-all duration-300 text-center" data-role="wali_kelas">
                                    <i class="fas fa-chalkboard-teacher text-purple-600 text-lg mb-2"></i>
                                    <p class="text-xs font-medium text-gray-700">Wali Kelas</p>
                                </div>
                                <div class="role-card cursor-pointer p-3 bg-gray-50 hover:bg-indigo-50 border-2 border-gray-200 hover:border-indigo-400 rounded-lg transition-all duration-300 text-center" data-role="guru">
                                    <i class="fas fa-chalkboard-teacher text-indigo-600 text-lg mb-2"></i>
                                    <p class="text-xs font-medium text-gray-700">Guru</p>
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Hidden Role Input -->
                        <input type="hidden" id="role" name="role" required>
                        @error('role')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        
                        <!-- Dynamic Form Container -->
                        <div id="dynamicForm"></div>

                        <!-- Register Button -->
                        <button type="submit" id="registerBtn" disabled
                            class="w-full bg-gray-400 text-white py-2.5 md:py-3 px-6 rounded-xl text-sm md:text-base font-semibold transition-all duration-300 shadow-lg cursor-not-allowed">
                            <i class="fas fa-user-plus mr-2"></i>Pilih Role Terlebih Dahulu
                        </button>
                    </form>

                </div>

            </div>

        </div>
    </div>

    <!-- AOS Animation Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 600,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });

        // Toggle Password Visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Dynamic Form Templates
        const formTemplates = {
            default: `
                <div>
                    <label for="name" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user mr-2 text-blue-600"></i>Nama Lengkap
                    </label>
                    <input type="text" id="name" name="name" required
                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-50 hover:bg-white"
                        placeholder="Masukkan nama lengkap">
                </div>
                <div>
                    <label for="username" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-at mr-2 text-blue-600"></i>Username
                    </label>
                    <div class="flex gap-2">
                        <input type="text" id="username" name="username" required
                            class="flex-1 px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-50 hover:bg-white"
                            placeholder="Masukkan username" oninput="removeSpaces(this); usernameChecked = false;">
                        <button type="button" onclick="checkUsername()" id="checkBtn"
                            class="px-4 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-medium hover:bg-blue-700 transition-colors">
                            <i class="fas fa-check"></i>
                        </button>
                    </div>
                    <div id="usernameFeedback" class="text-xs mt-1 hidden"></div>
                </div>
                <div>
                    <label for="password" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required minlength="8"
                            class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 pr-10 md:pr-12 bg-gray-50 hover:bg-white"
                            placeholder="Masukkan password (min. 8 karakter)" oninput="validatePassword()">
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-3 md:right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-blue-600 transition-colors">
                            <i class="fas fa-eye text-sm md:text-base" id="toggleIcon"></i>
                        </button>
                    </div>
                    <div id="passwordFeedback" class="text-xs mt-1 hidden"></div>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Konfirmasi Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-50 hover:bg-white"
                        placeholder="Konfirmasi password" oninput="validatePasswordMatch()">
                    <div id="confirmFeedback" class="text-xs mt-1 hidden"></div>
                </div>
            `,
            guru: `
                <div>
                    <label for="guru_id" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-chalkboard-teacher mr-2 text-indigo-600"></i>Pilih Guru
                    </label>
                    <select id="guru_id" name="guru_id" required onchange="updateGuruName()"
                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-50 hover:bg-white">
                        <option value="">Pilih guru yang belum memiliki akun...</option>
                    </select>
                </div>
                <input type="hidden" id="guru_name" name="name">
                <div>
                    <label for="username" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-at mr-2 text-blue-600"></i>Username
                    </label>
                    <div class="flex gap-2">
                        <input type="text" id="username" name="username" required
                            class="flex-1 px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-50 hover:bg-white"
                            placeholder="Masukkan username" oninput="removeSpaces(this); usernameChecked = false;">
                        <button type="button" onclick="checkUsername()" id="checkBtn"
                            class="px-4 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-medium hover:bg-blue-700 transition-colors">
                            <i class="fas fa-check"></i>
                        </button>
                    </div>
                    <div id="usernameFeedback" class="text-xs mt-1 hidden"></div>
                </div>
                <div>
                    <label for="password" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required minlength="8"
                            class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 pr-10 md:pr-12 bg-gray-50 hover:bg-white"
                            placeholder="Masukkan password (min. 8 karakter)" oninput="validatePassword()">
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-3 md:right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-blue-600 transition-colors">
                            <i class="fas fa-eye text-sm md:text-base" id="toggleIcon"></i>
                        </button>
                    </div>
                    <div id="passwordFeedback" class="text-xs mt-1 hidden"></div>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Konfirmasi Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-50 hover:bg-white"
                        placeholder="Konfirmasi password" oninput="validatePasswordMatch()">
                    <div id="confirmFeedback" class="text-xs mt-1 hidden"></div>
                </div>
            `,
            bk: `
                <div>
                    <label for="guru_bk_id" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user-shield mr-2 text-green-600"></i>Pilih Guru BK
                    </label>
                    <select id="guru_bk_id" name="guru_id" required onchange="updateGuruBkName()"
                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-50 hover:bg-white">
                        <option value="">Pilih guru BK yang belum memiliki akun...</option>
                    </select>
                </div>
                <input type="hidden" id="guru_bk_name" name="name">
                <div>
                    <label for="username" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-at mr-2 text-blue-600"></i>Username
                    </label>
                    <div class="flex gap-2">
                        <input type="text" id="username" name="username" required
                            class="flex-1 px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-50 hover:bg-white"
                            placeholder="Masukkan username" oninput="removeSpaces(this); usernameChecked = false;">
                        <button type="button" onclick="checkUsername()" id="checkBtn"
                            class="px-4 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-medium hover:bg-blue-700 transition-colors">
                            <i class="fas fa-check"></i>
                        </button>
                    </div>
                    <div id="usernameFeedback" class="text-xs mt-1 hidden"></div>
                </div>
                <div>
                    <label for="password" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required minlength="8"
                            class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 pr-10 md:pr-12 bg-gray-50 hover:bg-white"
                            placeholder="Masukkan password (min. 8 karakter)" oninput="validatePassword()">
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-3 md:right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-blue-600 transition-colors">
                            <i class="fas fa-eye text-sm md:text-base" id="toggleIcon"></i>
                        </button>
                    </div>
                    <div id="passwordFeedback" class="text-xs mt-1 hidden"></div>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Konfirmasi Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-50 hover:bg-white"
                        placeholder="Konfirmasi password" oninput="validatePasswordMatch()">
                    <div id="confirmFeedback" class="text-xs mt-1 hidden"></div>
                </div>
            `,
            siswa: `
                <div>
                    <label for="siswa_id" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user-graduate mr-2 text-teal-600"></i>Pilih Siswa
                    </label>
                    <select id="siswa_id" name="siswa_id" required
                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-50 hover:bg-white">
                        <option value="">Pilih siswa yang belum memiliki akun...</option>
                    </select>
                </div>
                <div>
                    <label for="username" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-at mr-2 text-blue-600"></i>Username
                    </label>
                    <div class="flex gap-2">
                        <input type="text" id="username" name="username" required
                            class="flex-1 px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-50 hover:bg-white"
                            placeholder="Masukkan username" oninput="removeSpaces(this); usernameChecked = false;">
                        <button type="button" onclick="checkUsername()" id="checkBtn"
                            class="px-4 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-medium hover:bg-blue-700 transition-colors">
                            <i class="fas fa-check"></i>
                        </button>
                    </div>
                    <div id="usernameFeedback" class="text-xs mt-1 hidden"></div>
                </div>
                <div>
                    <label for="password" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required minlength="8"
                            class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 pr-10 md:pr-12 bg-gray-50 hover:bg-white"
                            placeholder="Masukkan password (min. 8 karakter)" oninput="validatePassword()">
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-3 md:right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-blue-600 transition-colors">
                            <i class="fas fa-eye text-sm md:text-base" id="toggleIcon"></i>
                        </button>
                    </div>
                    <div id="passwordFeedback" class="text-xs mt-1 hidden"></div>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Konfirmasi Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-50 hover:bg-white"
                        placeholder="Konfirmasi password" oninput="validatePasswordMatch()">
                    <div id="confirmFeedback" class="text-xs mt-1 hidden"></div>
                </div>
            `,
            orang_tua: `
                <div>
                    <label for="siswa_anak" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-child mr-2 text-yellow-600"></i>Pilih Anak (Siswa)
                    </label>
                    <select id="siswa_anak" name="siswa_id" required
                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-50 hover:bg-white" onchange="loadParentData()">
                        <option value="">Pilih anak yang sudah memiliki akun siswa...</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Hanya siswa yang sudah memiliki akun yang akan muncul. Jika kosong, buat akun siswa terlebih dahulu.</p>
                </div>
                <div>
                    <label for="nama_ayah" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-male mr-2 text-blue-600"></i>Nama Ayah
                    </label>
                    <input type="text" id="nama_ayah" name="nama_ayah" readonly
                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-100"
                        placeholder="Nama ayah akan diisi otomatis">
                </div>
                <div>
                    <label for="nama_ibu" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-female mr-2 text-pink-600"></i>Nama Ibu
                    </label>
                    <input type="text" id="nama_ibu" name="nama_ibu" readonly
                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-100"
                        placeholder="Nama ibu akan diisi otomatis">
                </div>
                <input type="hidden" id="parent_name" name="name">
                <div>
                    <label for="username" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-at mr-2 text-blue-600"></i>Username
                    </label>
                    <div class="flex gap-2">
                        <input type="text" id="username" name="username" required
                            class="flex-1 px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-50 hover:bg-white"
                            placeholder="Masukkan username" oninput="removeSpaces(this); usernameChecked = false;">
                        <button type="button" onclick="checkUsername()" id="checkBtn"
                            class="px-4 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-medium hover:bg-blue-700 transition-colors">
                            <i class="fas fa-check"></i>
                        </button>
                    </div>
                    <div id="usernameFeedback" class="text-xs mt-1 hidden"></div>
                </div>
                <div>
                    <label for="password" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required minlength="8"
                            class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 pr-10 md:pr-12 bg-gray-50 hover:bg-white"
                            placeholder="Masukkan password (min. 8 karakter)" oninput="validatePassword()">
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-3 md:right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-blue-600 transition-colors">
                            <i class="fas fa-eye text-sm md:text-base" id="toggleIcon"></i>
                        </button>
                    </div>
                    <div id="passwordFeedback" class="text-xs mt-1 hidden"></div>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Konfirmasi Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-50 hover:bg-white"
                        placeholder="Konfirmasi password" oninput="validatePasswordMatch()">
                    <div id="confirmFeedback" class="text-xs mt-1 hidden"></div>
                </div>
            `,
            single_role: `
                <div>
                    <label for="name" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user mr-2 text-blue-600"></i>Nama Lengkap
                    </label>
                    <input type="text" id="name" name="name" required readonly
                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-100"
                        placeholder="Nama akan diisi otomatis">
                </div>
                <div>
                    <label for="username" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-at mr-2 text-blue-600"></i>Username
                    </label>
                    <input type="text" id="username" name="username" required readonly
                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-100"
                        placeholder="Username akan diisi otomatis">
                </div>
                <div>
                    <label for="password" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required minlength="8"
                            class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 pr-10 md:pr-12 bg-gray-50 hover:bg-white"
                            placeholder="Masukkan password (min. 8 karakter)" oninput="validatePassword()">
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-3 md:right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-blue-600 transition-colors">
                            <i class="fas fa-eye text-sm md:text-base" id="toggleIcon"></i>
                        </button>
                    </div>
                    <div id="passwordFeedback" class="text-xs mt-1 hidden"></div>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Konfirmasi Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-50 hover:bg-white"
                        placeholder="Konfirmasi password" oninput="validatePasswordMatch()">
                    <div id="confirmFeedback" class="text-xs mt-1 hidden"></div>
                </div>
            `,
            wali_kelas: `
                <div>
                    <label for="wali_kelas_id" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-chalkboard-teacher mr-2 text-purple-600"></i>Pilih Wali Kelas
                    </label>
                    <select id="wali_kelas_id" name="guru_id" required onchange="loadWaliKelasInfo(); updateNameField();"
                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-50 hover:bg-white">
                        <option value="">Pilih wali kelas yang belum memiliki akun...</option>
                    </select>
                </div>
                <div>
                    <label for="kelas_wali" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-school mr-2 text-purple-600"></i>Kelas
                    </label>
                    <input type="text" id="kelas_wali" name="kelas" readonly
                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-100"
                        placeholder="Kelas akan diisi otomatis">
                </div>
                <div>
                    <label for="username" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-at mr-2 text-blue-600"></i>Username
                    </label>
                    <div class="flex gap-2">
                        <input type="text" id="username" name="username" required
                            class="flex-1 px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-50 hover:bg-white"
                            placeholder="Masukkan username" oninput="removeSpaces(this); usernameChecked = false;">
                        <button type="button" onclick="checkUsername()" id="checkBtn"
                            class="px-4 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-medium hover:bg-blue-700 transition-colors">
                            <i class="fas fa-check"></i>
                        </button>
                    </div>
                    <div id="usernameFeedback" class="text-xs mt-1 hidden"></div>
                </div>
                <div>
                    <label for="password" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required minlength="8"
                            class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 pr-10 md:pr-12 bg-gray-50 hover:bg-white"
                            placeholder="Masukkan password (min. 8 karakter)" oninput="validatePassword()">
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-3 md:right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-blue-600 transition-colors">
                            <i class="fas fa-eye text-sm md:text-base" id="toggleIcon"></i>
                        </button>
                    </div>
                    <div id="passwordFeedback" class="text-xs mt-1 hidden"></div>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Konfirmasi Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-50 hover:bg-white"
                        placeholder="Konfirmasi password" oninput="validatePasswordMatch()">
                    <div id="confirmFeedback" class="text-xs mt-1 hidden"></div>
                </div>
            `
        };

        // Role Card Selection
        document.addEventListener('DOMContentLoaded', function() {
            const roleCards = document.querySelectorAll('.role-card');
            const roleInput = document.getElementById('role');
            const dynamicForm = document.getElementById('dynamicForm');
            const isAdmin = {{ $isAdmin ? 'true' : 'false' }};

            // Check for existing single-role accounts if admin
            if (isAdmin) {
                checkSingleRoleAccounts();
            }

            roleCards.forEach(card => {
                card.addEventListener('click', function() {
                    if (this.classList.contains('disabled-role')) {
                        return; // Don't allow clicking disabled roles
                    }
                    
                    // Remove active class from all cards
                    roleCards.forEach(c => {
                        c.classList.remove('bg-blue-100', 'border-blue-500', 'shadow-lg');
                        c.classList.add('bg-gray-50', 'border-gray-200');
                    });
                    
                    // Add active class to clicked card
                    this.classList.remove('bg-gray-50', 'border-gray-200');
                    this.classList.add('bg-blue-100', 'border-blue-500', 'shadow-lg');
                    
                    // Set role value
                    const selectedRole = this.dataset.role;
                    roleInput.value = selectedRole;
                    
                    // Enable register button
                    enableRegisterButton();
                    
                    // Load appropriate form
                    if (selectedRole === 'guru') {
                        dynamicForm.innerHTML = formTemplates.guru;
                        loadGuruData();
                    } else if (selectedRole === 'bk') {
                        dynamicForm.innerHTML = formTemplates.bk;
                        loadGuruBkData();
                    } else if (selectedRole === 'wali_kelas') {
                        dynamicForm.innerHTML = formTemplates.wali_kelas;
                        loadWaliKelasData();
                    } else if (selectedRole === 'siswa') {
                        dynamicForm.innerHTML = formTemplates.siswa;
                        loadSiswaWithoutAccountData();
                    } else if (selectedRole === 'orang_tua') {
                        dynamicForm.innerHTML = formTemplates.orang_tua;
                        loadSiswaWithAccountData();
                    } else if (selectedRole === 'kepala_sekolah') {
                        loadRoleWithName('kepala_sekolah');
                    } else if (selectedRole === 'kesiswaan') {
                        loadRoleWithName('kesiswaan');
                    } else {
                        dynamicForm.innerHTML = formTemplates.default;
                    }
                });
            });
        });
        
        async function checkSingleRoleAccounts() {
            try {
                const response = await fetch('/api/check-single-role-accounts');
                const data = await response.json();
                
                // Handle kesiswaan first (priority)
                if (data.kesiswaan_exists) {
                    const kesiswaanCard = document.querySelector('[data-role="kesiswaan"]');
                    if (kesiswaanCard) {
                        kesiswaanCard.classList.add('disabled-role', 'opacity-50', 'cursor-not-allowed');
                        kesiswaanCard.innerHTML = `
                            <div class="relative">
                                <i class="fas fa-clipboard-list text-orange-600 text-lg mb-2"></i>
                                <p class="text-xs font-medium text-gray-700">Kesiswaan</p>
                                <div class="absolute inset-0 flex items-center justify-center bg-red-500 bg-opacity-75 rounded-lg">
                                    <span class="text-white text-xs font-bold">Sudah Ada</span>
                                </div>
                            </div>
                        `;
                        kesiswaanCard.style.position = 'relative';
                    }
                }
                
                // Handle kepala sekolah
                if (data.kepala_sekolah_exists) {
                    const kepsekCard = document.querySelector('[data-role="kepala_sekolah"]');
                    if (kepsekCard) {
                        kepsekCard.classList.add('disabled-role', 'opacity-50', 'cursor-not-allowed');
                        kepsekCard.innerHTML = `
                            <div class="relative">
                                <i class="fas fa-user-tie text-red-600 text-lg mb-2"></i>
                                <p class="text-xs font-medium text-gray-700">Kepsek</p>
                                <div class="absolute inset-0 flex items-center justify-center bg-red-500 bg-opacity-75 rounded-lg">
                                    <span class="text-white text-xs font-bold">Sudah Ada</span>
                                </div>
                            </div>
                        `;
                        kepsekCard.style.position = 'relative';
                    }
                }
            } catch (error) {
                console.error('Error checking single role accounts:', error);
            }
        }
        
        async function loadRoleWithName(role) {
            try {
                const response = await fetch('/api/check-single-role-accounts');
                const data = await response.json();
                const dynamicForm = document.getElementById('dynamicForm');
                
                let name = '';
                let username = '';
                
                if (role === 'kepala_sekolah') {
                    name = data.kepala_sekolah_name || 'Dr. Hendra Wijaya, M.Pd';
                    username = 'kepsek';
                } else if (role === 'kesiswaan') {
                    name = data.kesiswaan_name || 'Dra. Sri Mulyani, M.Pd';
                    username = 'kesiswaan';
                }
                
                // Load single role form template
                dynamicForm.innerHTML = formTemplates.single_role;
                
                // Set the name and username values
                const nameInput = document.getElementById('name');
                const usernameInput = document.getElementById('username');
                if (nameInput) {
                    nameInput.value = name;
                }
                if (usernameInput) {
                    usernameInput.value = username;
                }
            } catch (error) {
                console.error('Error loading role data:', error);
                loadFallbackRoleData(role);
            }
        }
        
        function loadFallbackRoleData(role) {
            const dynamicForm = document.getElementById('dynamicForm');
            dynamicForm.innerHTML = formTemplates.single_role;
            
            const nameInput = document.getElementById('name');
            const usernameInput = document.getElementById('username');
            if (nameInput && usernameInput) {
                if (role === 'kepala_sekolah') {
                    nameInput.value = 'Dr. Hendra Wijaya, M.Pd';
                    usernameInput.value = 'kepsek';
                } else if (role === 'kesiswaan') {
                    nameInput.value = 'Dra. Sri Mulyani, M.Pd';
                    usernameInput.value = 'kesiswaan';
                }
            }
        }
        
        async function loadGuruData() {
            try {
                const response = await fetch('/api/get-guru-without-account');
                const data = await response.json();
                const select = document.getElementById('guru_id');
                
                data.forEach(guru => {
                    const option = document.createElement('option');
                    option.value = guru.id;
                    option.textContent = `${guru.nama} - ${guru.nip}`;
                    option.dataset.nama = guru.nama;
                    select.appendChild(option);
                });
            } catch (error) {
                console.error('Error loading guru data:', error);
            }
        }
        
        async function loadGuruBkData() {
            try {
                const response = await fetch('/api/get-guru-without-account');
                const data = await response.json();
                const select = document.getElementById('guru_bk_id');
                
                // Filter hanya guru BK
                const guruBk = data.filter(guru => guru.jabatan === 'guru_bk');
                
                if (guruBk.length === 0) {
                    const option = document.createElement('option');
                    option.value = '';
                    option.textContent = 'Semua guru BK sudah memiliki akun';
                    option.disabled = true;
                    select.appendChild(option);
                } else {
                    guruBk.forEach(guru => {
                        const option = document.createElement('option');
                        option.value = guru.id;
                        option.textContent = `${guru.nama} - ${guru.nip}`;
                        option.dataset.nama = guru.nama;
                        select.appendChild(option);
                    });
                }
            } catch (error) {
                console.error('Error loading guru BK data:', error);
            }
        }
        
        function updateGuruName() {
            const select = document.getElementById('guru_id');
            const selectedOption = select.options[select.selectedIndex];
            const nameInput = document.getElementById('guru_name');
            
            if (selectedOption && selectedOption.value) {
                nameInput.value = selectedOption.dataset.nama || '';
            } else {
                nameInput.value = '';
            }
        }
        
        function updateGuruBkName() {
            const select = document.getElementById('guru_bk_id');
            const selectedOption = select.options[select.selectedIndex];
            const nameInput = document.getElementById('guru_bk_name');
            
            if (selectedOption && selectedOption.value) {
                nameInput.value = selectedOption.dataset.nama || '';
            } else {
                nameInput.value = '';
            }
        }
        
        async function loadSiswaWithoutAccountData() {
            try {
                const response = await fetch('/api/get-siswa-without-account');
                const data = await response.json();
                const select = document.getElementById('siswa_id');
                
                if (data.length === 0) {
                    const option = document.createElement('option');
                    option.value = '';
                    option.textContent = 'Semua siswa sudah memiliki akun';
                    option.disabled = true;
                    select.appendChild(option);
                } else {
                    data.forEach(siswa => {
                        const option = document.createElement('option');
                        option.value = siswa.id;
                        option.textContent = `${siswa.nama} - ${siswa.nis} - ${siswa.kelas}`;
                        select.appendChild(option);
                    });
                }
            } catch (error) {
                console.error('Error loading siswa data:', error);
            }
        }
        
        async function loadWaliKelasData() {
            try {
                const response = await fetch('/api/get-wali-kelas-without-account');
                const data = await response.json();
                const select = document.getElementById('wali_kelas_id');
                
                data.forEach(waliKelas => {
                    const option = document.createElement('option');
                    option.value = waliKelas.id;
                    option.textContent = `${waliKelas.nama} - ${waliKelas.nip}`;
                    option.dataset.kelas = waliKelas.wali_kelas;
                    select.appendChild(option);
                });
            } catch (error) {
                console.error('Error loading wali kelas data:', error);
            }
        }
        
        function loadWaliKelasInfo() {
            const select = document.getElementById('wali_kelas_id');
            const selectedOption = select.options[select.selectedIndex];
            const kelasInput = document.getElementById('kelas_wali');
            
            if (selectedOption && selectedOption.value) {
                kelasInput.value = selectedOption.dataset.kelas || '';
            } else {
                kelasInput.value = '';
            }
        }
        
        function updateNameField() {
            const select = document.getElementById('wali_kelas_id');
            const selectedOption = select.options[select.selectedIndex];
            
            if (selectedOption && selectedOption.value) {
                // Create hidden name field for wali kelas
                let nameInput = document.getElementById('hidden_name');
                if (!nameInput) {
                    nameInput = document.createElement('input');
                    nameInput.type = 'hidden';
                    nameInput.id = 'hidden_name';
                    nameInput.name = 'name';
                    document.querySelector('form').appendChild(nameInput);
                }
                nameInput.value = selectedOption.textContent.split(' - ')[0];
            }
        }
        
        function loadSampleSiswaData() {
            const select = document.getElementById('siswa_id');
            const sampleData = [
                {id: 1, nama: 'Ahmad Rizki', nis: '2024001', kelas: 'XII RPL 1'},
                {id: 2, nama: 'Siti Nurhaliza', nis: '2024002', kelas: 'XII RPL 2'},
                {id: 3, nama: 'Budi Santoso', nis: '2024003', kelas: 'XII TKJ 1'}
            ];
            
            sampleData.forEach(siswa => {
                const option = document.createElement('option');
                option.value = siswa.id;
                option.textContent = `${siswa.nama} - ${siswa.nis} - ${siswa.kelas}`;
                select.appendChild(option);
            });
        }
        
        async function loadSiswaWithAccountData() {
            try {
                const response = await fetch('/api/get-siswa-with-account');
                const data = await response.json();
                const select = document.getElementById('siswa_anak');
                
                if (data.length === 0) {
                    const option = document.createElement('option');
                    option.value = '';
                    option.textContent = 'Belum ada siswa yang memiliki akun';
                    option.disabled = true;
                    select.appendChild(option);
                } else {
                    data.forEach(siswa => {
                        const option = document.createElement('option');
                        option.value = siswa.id;
                        option.textContent = `${siswa.nama} - ${siswa.nis} - ${siswa.kelas}`;
                        option.dataset.orangTua = JSON.stringify(siswa.orang_tua);
                        select.appendChild(option);
                    });
                }
            } catch (error) {
                console.error('Error loading siswa data:', error);
            }
        }
        
        function loadSampleParentData() {
            const select = document.getElementById('siswa_anak');
            const sampleData = [
                {
                    id: 1, 
                    nama: 'Ahmad Rizki', 
                    nis: '2024001', 
                    kelas: 'XII RPL 1',
                    orang_tua: {
                        nama_ayah: 'Bapak Ahmad',
                        nama_ibu: 'Ibu Siti'
                    }
                },
                {
                    id: 2, 
                    nama: 'Siti Nurhaliza', 
                    nis: '2024002', 
                    kelas: 'XII RPL 2',
                    orang_tua: {
                        nama_ayah: 'Bapak Budi',
                        nama_ibu: 'Ibu Ani'
                    }
                }
            ];
            
            sampleData.forEach(siswa => {
                const option = document.createElement('option');
                option.value = siswa.id;
                option.textContent = `${siswa.nama} - ${siswa.nis} - ${siswa.kelas}`;
                option.dataset.orangTua = JSON.stringify(siswa.orang_tua);
                select.appendChild(option);
            });
        }
        
        function loadParentData() {
            const select = document.getElementById('siswa_anak');
            const selectedOption = select.options[select.selectedIndex];
            
            if (selectedOption && selectedOption.value) {
                const orangTua = JSON.parse(selectedOption.dataset.orangTua || 'null');
                const namaAyahInput = document.getElementById('nama_ayah');
                const namaIbuInput = document.getElementById('nama_ibu');
                const parentNameInput = document.getElementById('parent_name');
                
                if (orangTua) {
                    namaAyahInput.value = orangTua.nama_ayah || '';
                    namaIbuInput.value = orangTua.nama_ibu || '';
                    const parentName = `${orangTua.nama_ayah || ''} & ${orangTua.nama_ibu || ''}`.replace(/^& |&$/g, '').trim();
                    parentNameInput.value = parentName || 'Orang Tua';
                } else {
                    namaAyahInput.value = '';
                    namaIbuInput.value = '';
                    parentNameInput.value = '';
                    showValidationModal('Data Orang Tua Tidak Tersedia', 'Data orang tua belum tersedia untuk siswa ini. Silahkan lengkapi data orang tua terlebih dahulu di menu Kelola Orang Tua.');
                }
            } else {
                document.getElementById('nama_ayah').value = '';
                document.getElementById('nama_ibu').value = '';
                document.getElementById('parent_name').value = '';
            }
        }

        // Auto-hide verification alert after 3 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const verificationAlert = document.getElementById('verificationAlert');
            if (verificationAlert) {
                setTimeout(function() {
                    verificationAlert.style.opacity = '0';
                    setTimeout(function() {
                        verificationAlert.style.display = 'none';
                    }, 500);
                }, 3000);
            }
        });

        // Register button control
        function enableRegisterButton() {
            const registerBtn = document.getElementById('registerBtn');
            const isAdmin = {{ $isAdmin ? 'true' : 'false' }};
            
            registerBtn.disabled = false;
            registerBtn.className = 'w-full bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white py-2.5 md:py-3 px-6 rounded-xl text-sm md:text-base font-semibold transition-all duration-300 shadow-lg hover:shadow-xl cursor-pointer';
            registerBtn.innerHTML = '<i class="fas fa-user-plus mr-2"></i>' + (isAdmin ? 'Daftar Pengguna Baru' : 'Daftar Akun (Perlu Verifikasi)');
        }
        
        // Username validation functions
        function removeSpaces(input) {
            input.value = input.value.replace(/\s/g, '');
        }
        
        let usernameChecked = false;
        
        async function checkUsername() {
            const usernameInput = document.getElementById('username');
            const feedback = document.getElementById('usernameFeedback');
            const checkBtn = document.getElementById('checkBtn');
            const username = usernameInput.value.trim();
            
            if (!username) {
                feedback.innerHTML = '<i class="fas fa-times text-red-600 mr-1"></i>Username tidak boleh kosong';
                feedback.className = 'text-xs mt-1 text-red-600';
                feedback.classList.remove('hidden');
                return;
            }
            
            if (username.length < 6) {
                feedback.innerHTML = '<i class="fas fa-times text-red-600 mr-1"></i>Username minimal 6 karakter';
                feedback.className = 'text-xs mt-1 text-red-600';
                feedback.classList.remove('hidden');
                return;
            }
            
            checkBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            checkBtn.disabled = true;
            
            try {
                const response = await fetch(`/api/check-username/${username}`);
                const data = await response.json();
                
                if (data.available) {
                    feedback.innerHTML = '<i class="fas fa-check text-green-600 mr-1"></i>Username tersedia';
                    feedback.className = 'text-xs mt-1 text-green-600';
                    usernameInput.classList.remove('border-red-300');
                    usernameInput.classList.add('border-green-300');
                    usernameChecked = true;
                } else {
                    feedback.innerHTML = '<i class="fas fa-times text-red-600 mr-1"></i>Username sudah digunakan';
                    feedback.className = 'text-xs mt-1 text-red-600';
                    usernameInput.classList.remove('border-green-300');
                    usernameInput.classList.add('border-red-300');
                    usernameChecked = false;
                }
                
                feedback.classList.remove('hidden');
            } catch (error) {
                feedback.innerHTML = '<i class="fas fa-times text-red-600 mr-1"></i>Error checking username';
                feedback.className = 'text-xs mt-1 text-red-600';
                feedback.classList.remove('hidden');
                usernameChecked = false;
            }
            
            checkBtn.innerHTML = '<i class="fas fa-check"></i>';
            checkBtn.disabled = false;
        }
        
        // Form validation before submit
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const usernameInput = document.getElementById('username');
                if (usernameInput && !usernameChecked) {
                    e.preventDefault();
                    showValidationModal('Username belum dicek', 'Silahkan check ketersediaan username terlebih dahulu dengan menekan tombol check.');
                    return false;
                }
            });
        });
        
        function showValidationModal(title, message) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4';
            modal.innerHTML = `
                <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">${title}</h3>
                    </div>
                    <p class="text-gray-600 mb-6">${message}</p>
                    <div class="flex justify-end">
                        <button onclick="closeValidationModal()" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            <i class="fas fa-times mr-2"></i>Tutup
                        </button>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            
            window.closeValidationModal = function() {
                document.body.removeChild(modal);
            };
        }

        // Password validation functions
        function validatePassword() {
            const password = document.getElementById('password');
            const feedback = document.getElementById('passwordFeedback');
            
            if (!password || !feedback) return;
            
            const value = password.value;
            const isValid = value.length >= 8;
            
            feedback.classList.remove('hidden');
            
            if (value.length === 0) {
                feedback.classList.add('hidden');
            } else if (isValid) {
                feedback.innerHTML = '<i class="fas fa-check text-green-600 mr-1"></i>Password valid';
                feedback.className = 'text-xs mt-1 text-green-600';
                password.classList.remove('border-red-300');
                password.classList.add('border-green-300');
            } else {
                feedback.innerHTML = '<i class="fas fa-times text-red-600 mr-1"></i>Password minimal 8 karakter';
                feedback.className = 'text-xs mt-1 text-red-600';
                password.classList.remove('border-green-300');
                password.classList.add('border-red-300');
            }
            
            validatePasswordMatch();
        }
        
        function validatePasswordMatch() {
            const password = document.getElementById('password');
            const confirm = document.getElementById('password_confirmation');
            const feedback = document.getElementById('confirmFeedback');
            
            if (!password || !confirm || !feedback) return;
            
            const passwordValue = password.value;
            const confirmValue = confirm.value;
            
            if (confirmValue.length === 0) {
                feedback.classList.add('hidden');
                confirm.classList.remove('border-red-300', 'border-green-300');
                return;
            }
            
            feedback.classList.remove('hidden');
            
            if (passwordValue === confirmValue && passwordValue.length >= 8) {
                feedback.innerHTML = '<i class="fas fa-check text-green-600 mr-1"></i>Password cocok';
                feedback.className = 'text-xs mt-1 text-green-600';
                confirm.classList.remove('border-red-300');
                confirm.classList.add('border-green-300');
            } else {
                feedback.innerHTML = '<i class="fas fa-times text-red-600 mr-1"></i>Password tidak cocok';
                feedback.className = 'text-xs mt-1 text-red-600';
                confirm.classList.remove('border-green-300');
                confirm.classList.add('border-red-300');
            }
        }
    </script>

</body>

</html>