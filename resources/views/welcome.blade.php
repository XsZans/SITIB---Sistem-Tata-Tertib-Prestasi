<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiTib - Sistem Tata Tertib & Prestasi SMK Bakti Nusantara 666</title>
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
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* Mobile Responsive Improvements */
        @media (max-width: 768px) {
            .feature-card {
                padding: 1.5rem !important;
            }

            .feature-card h3 {
                font-size: 1rem !important;
                line-height: 1.4;
            }

            .feature-card p {
                font-size: 0.813rem !important;
                line-height: 1.5;
            }

            .feature-card .icon-box {
                width: 3rem !important;
                height: 3rem !important;
            }

            .feature-card .icon-box i {
                font-size: 1.25rem !important;
            }
        }
    </style>
</head>

<body class="gradient-bg">
    <!-- Navbar -->
    <nav class="bg-white/95 backdrop-blur-sm shadow-lg" data-aos="fade-down">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="flex items-center justify-between py-4">
                <!-- Logo & Brand -->
                <div class="flex items-center gap-2 md:gap-4">
                    <div class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center">
                        <img src="{{ asset('assets/img/logo.jpg') }}" alt="Logo SMK Bakti Nusantara 666" class="w-10 h-10 md:w-12 md:h-12 object-contain rounded-lg">
                    </div>
                    <div>
                        <h1 class="text-sm md:text-xl font-bold text-gray-800">SMK Bakti Nusantara 666</h1>
                        <p class="text-xs md:text-sm text-gray-600">SiTib - Sistem Tata Tertib & Prestasi</p>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center gap-3">
                    <a href="{{ route('login') }}" class="bg-blue-50 hover:bg-blue-100 text-blue-700 hover:text-blue-800 px-4 py-2 rounded-lg font-medium transition-all duration-200 border border-blue-200">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-green-50 hover:bg-green-100 text-green-700 hover:text-green-800 px-4 py-2 rounded-lg font-medium transition-all duration-200 border border-green-200">
                        Register
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-gray-700 hover:text-blue-600" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden pb-4">
                <div class="flex flex-col gap-2">
                    <a href="{{ route('login') }}" class="bg-blue-50 hover:bg-blue-100 text-blue-700 hover:text-blue-800 px-4 py-2 rounded-lg font-medium text-center transition-all duration-200 border border-blue-200">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-green-50 hover:bg-green-100 text-green-700 hover:text-green-800 px-4 py-2 rounded-lg font-medium text-center transition-all duration-200 border border-green-200">
                        Register
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-4 md:py-8 max-w-6xl">

        <!-- Main Content -->
        <main class="glass-card rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-10 mb-8" data-aos="fade-up" data-aos-duration="800">

            <div class="text-center mb-8 md:mb-16" data-aos="fade-up" data-aos-delay="200">
                <div class="inline-block bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-4 md:px-6 py-1.5 md:py-2 rounded-full text-xs md:text-sm font-semibold mb-3 md:mb-4 shadow-lg">
                    SISTEM TERPADU
                </div>
                <h2 class="text-2xl md:text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-3 md:mb-4">
                    SiTib - Sistem Tata Tertib & Prestasi
                </h2>
                <p class="text-gray-600 max-w-3xl mx-auto text-sm md:text-lg leading-relaxed px-2">
                    Platform digital untuk monitoring dan pengelolaan tata tertib siswa secara terpadu dengan teknologi modern
                </p>
            </div>

            <!-- Features - 2 kolom di mobile, 3 kolom di desktop -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-8 mb-8 md:mb-16">

                <div class="feature-card bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl md:rounded-2xl p-6 md:p-8 hover-lift" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon-box w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl md:rounded-2xl flex items-center justify-center mb-3 md:mb-6 shadow-lg">
                        <i class="fas fa-file-alt text-white text-lg md:text-2xl"></i>
                    </div>
                    <h3 class="text-base md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Pencatatan Digital</h3>
                    <p class="text-gray-600 text-xs md:text-base leading-relaxed">
                        Catat pelanggaran siswa secara digital dengan mudah dan terstruktur
                    </p>
                </div>

                <div class="feature-card bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl md:rounded-2xl p-6 md:p-8 hover-lift" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon-box w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl md:rounded-2xl flex items-center justify-center mb-3 md:mb-6 shadow-lg">
                        <i class="fas fa-chart-line text-white text-lg md:text-2xl"></i>
                    </div>
                    <h3 class="text-base md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Monitoring Realtime</h3>
                    <p class="text-gray-600 text-xs md:text-base leading-relaxed">
                        Pantau data pelanggaran siswa dengan dashboard yang informatif
                    </p>
                </div>

                <div class="feature-card bg-gradient-to-br from-amber-50 to-amber-100 border border-amber-200 rounded-xl md:rounded-2xl p-6 md:p-8 hover-lift" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon-box w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl md:rounded-2xl flex items-center justify-center mb-3 md:mb-6 shadow-lg">
                        <i class="fas fa-balance-scale text-white text-lg md:text-2xl"></i>
                    </div>
                    <h3 class="text-base md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Sistem Poin Otomatis</h3>
                    <p class="text-gray-600 text-xs md:text-base leading-relaxed">
                        Perhitungan poin dan sanksi otomatis sesuai peraturan sekolah
                    </p>
                </div>

                <div class="feature-card bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 rounded-xl md:rounded-2xl p-6 md:p-8 hover-lift" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon-box w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl md:rounded-2xl flex items-center justify-center mb-3 md:mb-6 shadow-lg">
                        <i class="fas fa-bell text-white text-lg md:text-2xl"></i>
                    </div>
                    <h3 class="text-base md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Notifikasi Cerdas</h3>
                    <p class="text-gray-600 text-xs md:text-base leading-relaxed">
                        Notifikasi otomatis untuk guru BK, wali kelas, dan orang tua
                    </p>
                </div>

                <div class="feature-card bg-gradient-to-br from-red-50 to-red-100 border border-red-200 rounded-xl md:rounded-2xl p-6 md:p-8 hover-lift" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon-box w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-xl md:rounded-2xl flex items-center justify-center mb-3 md:mb-6 shadow-lg">
                        <i class="fas fa-file-pdf text-white text-lg md:text-2xl"></i>
                    </div>
                    <h3 class="text-base md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Laporan Lengkap</h3>
                    <p class="text-gray-600 text-xs md:text-base leading-relaxed">
                        Generate laporan dalam format PDF atau Excel untuk analisis
                    </p>
                </div>

                <div class="feature-card bg-gradient-to-br from-indigo-50 to-indigo-100 border border-indigo-200 rounded-xl md:rounded-2xl p-6 md:p-8 hover-lift" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon-box w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl md:rounded-2xl flex items-center justify-center mb-3 md:mb-6 shadow-lg">
                        <i class="fas fa-users text-white text-lg md:text-2xl"></i>
                    </div>
                    <h3 class="text-base md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Multi-User Access</h3>
                    <p class="text-gray-600 text-xs md:text-base leading-relaxed">
                        Akses berbeda untuk Admin, Guru BK, Wali Kelas, dan Guru
                    </p>
                </div>

                <div class="feature-card bg-gradient-to-br from-yellow-50 to-yellow-100 border border-yellow-200 rounded-xl md:rounded-2xl p-6 md:p-8 hover-lift" data-aos="fade-up" data-aos-delay="400">
                    <div class="icon-box w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl md:rounded-2xl flex items-center justify-center mb-3 md:mb-6 shadow-lg">
                        <i class="fas fa-trophy text-white text-lg md:text-2xl"></i>
                    </div>
                    <h3 class="text-base md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Tracking Prestasi</h3>
                    <p class="text-gray-600 text-xs md:text-base leading-relaxed">
                        Monitor dan catat prestasi siswa untuk evaluasi komprehensif
                    </p>
                </div>

                <div class="feature-card bg-gradient-to-br from-teal-50 to-teal-100 border border-teal-200 rounded-xl md:rounded-2xl p-6 md:p-8 hover-lift" data-aos="fade-up" data-aos-delay="500">
                    <div class="icon-box w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl md:rounded-2xl flex items-center justify-center mb-3 md:mb-6 shadow-lg">
                        <i class="fas fa-award text-white text-lg md:text-2xl"></i>
                    </div>
                    <h3 class="text-base md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Sistem Prestasi</h3>
                    <p class="text-gray-600 text-xs md:text-base leading-relaxed">
                        Kelola dan berikan penghargaan untuk prestasi siswa secara digital
                    </p>
                </div>

            </div>

            <!-- Objectives -->
            <div class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 rounded-2xl md:rounded-3xl p-6 md:p-10 mb-8 md:mb-12 border border-blue-100 shadow-lg" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center mb-6 md:mb-10">
                    <div class="inline-block p-3 md:p-4 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl md:rounded-2xl mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-bullseye text-white text-2xl md:text-3xl"></i>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-2">Tujuan Sistem</h3>
                    <p class="text-gray-600 text-sm md:text-base">Menciptakan lingkungan sekolah yang lebih disiplin dan teratur</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <div class="flex items-start gap-3 md:gap-4 p-3 md:p-4 bg-white/60 rounded-lg md:rounded-xl" data-aos="fade-right" data-aos-delay="300">
                        <div class="w-7 h-7 md:w-8 md:h-8 bg-gradient-to-br from-green-400 to-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check text-white text-xs md:text-sm"></i>
                        </div>
                        <span class="text-gray-700 font-medium text-sm md:text-base">Meningkatkan kedisiplinan siswa</span>
                    </div>
                    <div class="flex items-start gap-3 md:gap-4 p-3 md:p-4 bg-white/60 rounded-lg md:rounded-xl" data-aos="fade-left" data-aos-delay="350">
                        <div class="w-7 h-7 md:w-8 md:h-8 bg-gradient-to-br from-green-400 to-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check text-white text-xs md:text-sm"></i>
                        </div>
                        <span class="text-gray-700 font-medium text-sm md:text-base">Mempermudah administrasi pelanggaran</span>
                    </div>
                    <div class="flex items-start gap-3 md:gap-4 p-3 md:p-4 bg-white/60 rounded-lg md:rounded-xl" data-aos="fade-right" data-aos-delay="400">
                        <div class="w-7 h-7 md:w-8 md:h-8 bg-gradient-to-br from-green-400 to-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check text-white text-xs md:text-sm"></i>
                        </div>
                        <span class="text-gray-700 font-medium text-sm md:text-base">Transparansi data pelanggaran</span>
                    </div>
                    <div class="flex items-start gap-3 md:gap-4 p-3 md:p-4 bg-white/60 rounded-lg md:rounded-xl" data-aos="fade-left" data-aos-delay="450">
                        <div class="w-7 h-7 md:w-8 md:h-8 bg-gradient-to-br from-green-400 to-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check text-white text-xs md:text-sm"></i>
                        </div>
                        <span class="text-gray-700 font-medium text-sm md:text-base">Tindakan preventif lebih cepat</span>
                    </div>
                    <div class="flex items-start gap-3 md:gap-4 p-3 md:p-4 bg-white/60 rounded-lg md:rounded-xl" data-aos="fade-right" data-aos-delay="500">
                        <div class="w-7 h-7 md:w-8 md:h-8 bg-gradient-to-br from-green-400 to-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check text-white text-xs md:text-sm"></i>
                        </div>
                        <span class="text-gray-700 font-medium text-sm md:text-base">Pembinaan siswa lebih efektif</span>
                    </div>
                    <div class="flex items-start gap-3 md:gap-4 p-3 md:p-4 bg-white/60 rounded-lg md:rounded-xl" data-aos="fade-left" data-aos-delay="550">
                        <div class="w-7 h-7 md:w-8 md:h-8 bg-gradient-to-br from-green-400 to-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check text-white text-xs md:text-sm"></i>
                        </div>
                        <span class="text-gray-700 font-medium text-sm md:text-base">Komunikasi dengan orang tua lebih baik</span>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="text-center" data-aos="zoom-in" data-aos-delay="300">
                <a href="{{ route('login') }}" class="inline-block bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white px-8 md:px-12 py-3 md:py-4 rounded-xl md:rounded-2xl font-semibold text-base md:text-lg transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105">
                    <i class="fas fa-sign-in-alt mr-2 md:mr-3"></i>Masuk ke Sistem
                </a>
                <p class="mt-4 md:mt-6 text-gray-500 flex items-center justify-center gap-2 text-xs md:text-base px-4">
                    <i class="fas fa-shield-alt text-blue-600"></i>
                    <span>Gunakan akun yang telah diberikan oleh administrator</span>
                </p>
            </div>

        </main>

    </div>

    <!-- Footer -->
    <footer class="mt-8 md:mt-16 bg-gradient-to-b from-transparent via-slate-100/50 to-slate-200/80 backdrop-blur-sm" data-aos="fade-up" data-aos-delay="200">
        <div class="container mx-auto px-4 max-w-6xl py-8 md:py-16">

            <!-- Main Footer Content -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 mb-8 md:mb-12">

                <!-- School Info -->
                <div class="text-center md:text-left" data-aos="fade-right" data-aos-delay="300">
                    <div class="flex justify-center md:justify-start items-center gap-3 mb-4 md:mb-6">
                        <div class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center">
                            <img src="{{ asset('assets/img/logo.jpg') }}" alt="Logo SMK Bakti Nusantara 666" class="w-10 h-10 md:w-12 md:h-12 object-contain rounded-lg">
                        </div>
                        <div>
                            <h3 class="text-lg md:text-xl font-bold text-gray-800">SMK Bakti Nusantara 666</h3>
                            <p class="text-xs md:text-sm text-gray-600">Sekolah Menengah Kejuruan</p>
                        </div>
                    </div>
                    <p class="text-gray-600 leading-relaxed mb-4 text-sm md:text-base">
                        Membentuk generasi unggul yang berkarakter, kompeten, dan siap menghadapi tantangan masa depan.
                    </p>
                    <div class="inline-block bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-4 py-2 rounded-full text-xs md:text-sm font-semibold">
                        Terakreditasi A
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="text-center md:text-left" data-aos="fade-up" data-aos-delay="400">
                    <h4 class="text-base md:text-lg font-bold text-gray-800 mb-4 md:mb-6">Informasi Kontak</h4>
                    <div class="space-y-3 md:space-y-4">
                        <div class="flex items-start gap-3 justify-center md:justify-start">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-blue-600 text-sm"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-gray-700 font-medium text-sm md:text-base">Alamat</p>
                                <p class="text-gray-600 text-xs md:text-sm">Jalan Percobaan KM. 17 No. 65, <br> Cimekar, Kecamatan Cileunyi, Kabupaten Bandung, Jawa Barat</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 justify-center md:justify-start">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-phone text-green-600 text-sm"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-gray-700 font-medium text-sm md:text-base">Telepon</p>
                                <p class="text-gray-600 text-xs md:text-sm">+62 812-2107-5502 (Supriatna)</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 justify-center md:justify-start">
                            <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-envelope text-red-600 text-sm"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-gray-700 font-medium text-sm md:text-base">Email</p>
                                <p class="text-gray-600 text-xs md:text-sm">@smkbn666.sch.id</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Info -->
                <div class="text-center md:text-left" data-aos="fade-left" data-aos-delay="500">
                    <h4 class="text-base md:text-lg font-bold text-gray-800 mb-4 md:mb-6">Sistem Informasi</h4>
                    <div class="space-y-3 md:space-y-4">
                        <div class="bg-white/60 rounded-xl p-3 md:p-4 border border-gray-200">
                            <div class="flex items-center gap-3 mb-2">
                                <i class="fas fa-desktop text-blue-600 text-sm md:text-base"></i>
                                <span class="font-semibold text-gray-800 text-sm md:text-base">SiTib v1.0</span>
                            </div>
                            <p class="text-gray-600 text-xs md:text-sm">Platform digital untuk monitoring tata tertib siswa</p>
                        </div>
                        <div class="bg-white/60 rounded-xl p-3 md:p-4 border border-gray-200">
                            <div class="flex items-center gap-3 mb-2">
                                <i class="fas fa-shield-alt text-green-600 text-sm md:text-base"></i>
                                <span class="font-semibold text-gray-800 text-sm md:text-base">Keamanan Data</span>
                            </div>
                            <p class="text-gray-600 text-xs md:text-sm">Data siswa terlindungi dengan enkripsi tingkat tinggi</p>
                        </div>
                        <div class="bg-white/60 rounded-xl p-3 md:p-4 border border-gray-200">
                            <div class="flex items-center gap-3 mb-2">
                                <i class="fas fa-clock text-amber-600 text-sm md:text-base"></i>
                                <span class="font-semibold text-gray-800 text-sm md:text-base">07:00 - 16:00 WIB</span>
                            </div>
                            <p class="text-gray-600 text-xs md:text-sm">Akses sistem pada jam operasional sekolah</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bottom Footer -->
            <div class="border-t border-gray-300/50 pt-6 md:pt-8" data-aos="fade-up" data-aos-delay="600">
                <div class="text-center">
                    <p class="text-gray-700 font-bold text-base md:text-lg mb-2">SiTib - Sistem Tata Tertib & Prestasi</p>
                    <p class="text-gray-600 text-xs md:text-sm italic">"Smart Discipline, Smart School."</p>
                </div>
            </div>

        </div>
    </footer>
    <!-- AOS Animation Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });

        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('hidden');
        }
    </script>

</body>

</html>