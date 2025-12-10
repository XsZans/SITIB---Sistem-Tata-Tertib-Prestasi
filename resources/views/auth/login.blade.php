<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Tata Tertib & Prestasi SMK Bakti Nusantara 666</title>
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

        .btn-glow {
            position: relative;
            overflow: hidden;
        }

        .btn-glow::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }

        .btn-glow:hover::before {
            left: 100%;
        }
    </style>
</head>

<body class="gradient-bg">

    <!-- Success Notification -->
    @if (session('status') === 'password-updated')
        <div id="successNotification" class="bg-green-500 text-white px-6 py-4 text-center shadow-lg">
            <i class="fas fa-check mr-2"></i>Password berhasil diubah! Silakan login dengan password baru.
        </div>
    @endif

    <div class="min-h-screen flex items-center justify-center p-4 py-8">
        <div class="w-full max-w-4xl">

            <!-- Main Content -->
            <div class="grid lg:grid-cols-2 gap-6 md:gap-8 items-center">

                <!-- Login Form -->
                <div class="glass-card rounded-2xl md:rounded-3xl shadow-xl p-6 md:p-8 card-hover" data-aos="fade-right">
                    <!-- Back to Home -->
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
                                <img src="{{ asset('assets/img/logo.jpg') }}" alt="Logo SMK Bakti Nusantara 666" class="w-10 h-10 md:w-12 md:h-12 object-contain rounded-lg">
                            </div>
                        </div>
                        <h1 class="text-xl md:text-2xl font-bold text-gray-800 mb-1">Sistem Tata Tertib & Prestasi Login</h1>
                        <p class="text-gray-600 text-xs md:text-sm">Sistem Tata Tertib</p>
                        <p class="text-gray-500 text-xs italic">"Smart Discipline, Smart School."</p>
                    </div>



                    <form action="{{ route('custom.login.post') }}" method="POST" class="space-y-4 md:space-y-5">
                        @csrf
                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user mr-2 text-blue-600"></i>Username
                            </label>
                            <input type="text" id="username" name="username" required value="{{ old('username') }}"
                                class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 bg-gray-50 hover:bg-white"
                                placeholder="Masukkan username Anda" onkeypress="return event.charCode != 32">
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-xs md:text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-lock mr-2 text-blue-600"></i>Password
                            </label>
                            <div class="relative">
                                <input type="password" id="password" name="password" required
                                    class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border-2 border-gray-200 rounded-xl focus:outline-none input-focus transition-all duration-300 pr-10 md:pr-12 bg-gray-50 hover:bg-white"
                                    placeholder="Masukkan password Anda">
                                <button type="button" onclick="togglePassword()"
                                    class="absolute right-3 md:right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-blue-600 transition-colors">
                                    <i class="fas fa-eye text-sm md:text-base" id="toggleIcon"></i>
                                </button>
                            </div>
                        </div>



                        <!-- Remember Me -->
                        <div class="flex items-center justify-between text-xs md:text-sm">
                            <label class="flex items-center">
                                <input type="checkbox" class="w-3.5 h-3.5 md:w-4 md:h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <span class="ml-2 text-gray-600">Ingat saya</span>
                            </label>
                            <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Lupa password?</a>
                        </div>

                        @if($errors->has('login'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            {{ $errors->first('login') }}
                        </div>
                        @endif

                        <!-- Login Button -->
                        <button type="submit" id="loginBtn"
                            class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white py-2.5 md:py-3 px-6 rounded-xl text-sm md:text-base font-semibold transition-all duration-300 shadow-lg hover:shadow-xl btn-glow">
                            <i class="fas fa-sign-in-alt mr-2"></i>Masuk ke Sistem
                        </button>
                    </form>




                </div>

                <!-- Information Cards -->
                <div class="space-y-4 md:space-y-5" data-aos="fade-left">

                    <!-- System Info Card -->
                    <div class="glass-card rounded-xl md:rounded-2xl p-4 md:p-6 shadow-xl card-hover border-l-4 border-blue-500">
                        <div class="flex items-start gap-3 md:gap-4">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg md:rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                <i class="fas fa-desktop text-white text-base md:text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 mb-1.5 md:mb-2 text-base md:text-lg">Sistem Tata Tertib & Prestasi</h3>
                                <p class="text-gray-600 text-xs md:text-sm leading-relaxed">
                                    Platform digital untuk monitoring dan pengelolaan tata tertib siswa secara terpadu
                                </p>
                                <div class="flex items-center gap-2 mt-2 md:mt-3">
                                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                    <span class="text-green-600 text-xs font-medium">Online</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Features Card -->
                    <div class="glass-card rounded-xl md:rounded-2xl p-4 md:p-6 shadow-xl card-hover border-l-4 border-green-500">
                        <div class="flex items-start gap-3 md:gap-4 mb-3 md:mb-4">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-lg md:rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                <i class="fas fa-star text-white text-base md:text-lg"></i>
                            </div>
                            <h3 class="font-bold text-gray-800 text-base md:text-lg">Fitur Unggulan</h3>
                        </div>
                        <div class="space-y-2.5 md:space-y-3 ml-13 md:ml-16">
                            <div class="flex items-center gap-2.5 md:gap-3">
                                <div class="w-5 h-5 md:w-6 md:h-6 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-blue-600 text-xs"></i>
                                </div>
                                <span class="text-gray-700 text-xs md:text-sm font-medium">Pencatatan digital</span>
                            </div>
                            <div class="flex items-center gap-2.5 md:gap-3">
                                <div class="w-5 h-5 md:w-6 md:h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-green-600 text-xs"></i>
                                </div>
                                <span class="text-gray-700 text-xs md:text-sm font-medium">Monitoring real-time</span>
                            </div>
                            <div class="flex items-center gap-2.5 md:gap-3">
                                <div class="w-5 h-5 md:w-6 md:h-6 bg-amber-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-amber-600 text-xs"></i>
                                </div>
                                <span class="text-gray-700 text-xs md:text-sm font-medium">Sistem poin otomatis</span>
                            </div>
                            <div class="flex items-center gap-2.5 md:gap-3">
                                <div class="w-5 h-5 md:w-6 md:h-6 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-trophy text-yellow-600 text-xs"></i>
                                </div>
                                <span class="text-gray-700 text-xs md:text-sm font-medium">Tracking prestasi siswa</span>
                            </div>
                        </div>
                    </div>

                    <!-- Security Card -->
                    <div class="glass-card rounded-xl md:rounded-2xl p-4 md:p-6 shadow-xl card-hover border-l-4 border-red-500">
                        <div class="flex items-start gap-3 md:gap-4">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-lg md:rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                <i class="fas fa-shield-alt text-white text-base md:text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 mb-1.5 md:mb-2 text-base md:text-lg">Keamanan Terjamin</h3>
                                <p class="text-gray-600 text-xs md:text-sm leading-relaxed mb-2 md:mb-3">
                                    Data terlindungi dengan enkripsi tingkat tinggi dan sistem keamanan berlapis
                                </p>
                                <div class="flex items-center gap-2">
                                    <div class="flex items-center gap-1 bg-green-100 px-2 py-1 rounded-full">
                                        <i class="fas fa-lock text-green-600 text-xs"></i>
                                        <span class="text-green-600 text-xs font-semibold">SSL Encrypted</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Register Card -->
                    <div class="glass-card rounded-xl md:rounded-2xl p-4 md:p-6 shadow-xl card-hover border-l-4 border-purple-500">
                        <div class="flex items-start gap-3 md:gap-4">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg md:rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                <i class="fas fa-user-plus text-white text-base md:text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 mb-1.5 md:mb-2 text-base md:text-lg">Ingin Buat Akun?</h3>
                                <p class="text-gray-600 text-xs md:text-sm leading-relaxed mb-2 md:mb-3">
                                    Silahkan hubungi administrator untuk membuat akun baru
                                </p>
                                <a href="{{ route('register') }}" class="inline-flex items-center bg-purple-100 hover:bg-purple-200 text-purple-700 px-2.5 md:px-3 py-1.5 md:py-2 rounded-lg text-xs md:text-sm font-medium transition-all duration-300">
                                    <i class="fas fa-arrow-right mr-1.5 md:mr-2"></i>Daftar Pengguna
                                </a>
                            </div>
                        </div>
                    </div>

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

        // Prevent space in username
        document.getElementById('username').addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedText = (e.clipboardData || window.clipboardData).getData('text');
            const cleanedText = pastedText.replace(/\s/g, '');
            this.value = cleanedText;
        });


    </script>

</body>

</html>