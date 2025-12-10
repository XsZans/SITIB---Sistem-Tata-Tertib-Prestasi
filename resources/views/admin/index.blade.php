<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Tata Tertib & Prestasi</title>
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
        
        .typing-text {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1f2937;
            display: inline-block;
        }
        
        .cursor {
            color: #1f2937;
            animation: blink 1s infinite;
        }
        
        @keyframes blink {
            0%, 50% { opacity: 1; }
            51%, 100% { opacity: 0; }
        }
    </style>
</head>
<body class="gradient-bg">

    @if(Auth::user()->role === 'kesiswaan')
        @include('layouts.kesiswaan-navbar', ['title' => 'Sistem Tata Tertib & Prestasi', 'subtitle' => 'Dashboard Kesiswaan'])
    @else
        @include('layouts.admin-navbar', ['title' => 'Sistem Tata Tertib & Prestasi', 'subtitle' => 'Dashboard Administrator'])
    @endif

    <div class="container mx-auto px-4 py-4 md:py-8 max-w-6xl">
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-lg" data-aos="fade-down">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3 text-green-600"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <!-- Main Content -->
        <main class="glass-card rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-10 mb-8" data-aos="fade-up" data-aos-duration="800">

            <!-- Welcome Section -->
            <div class="text-center mb-8 md:mb-16" data-aos="fade-up" data-aos-delay="200">
                <div class="flex justify-center mb-4 md:mb-6">
                    <div class="typing-text">
                        <span id="typed-text"></span>
                    </div>
                </div>
                <div class="inline-block bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-4 md:px-6 py-1.5 md:py-2 rounded-full text-xs md:text-sm font-semibold mb-3 md:mb-4 shadow-lg">
                    ADMINISTRATOR PANEL
                </div>
                <h2 class="text-2xl md:text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-3 md:mb-4">
                    Dashboard Admin Sistem Tata Tertib & Prestasi
                </h2>
                <p class="text-gray-600 max-w-3xl mx-auto text-sm md:text-lg leading-relaxed px-2">
                    Kelola sistem tata tertib sekolah dengan akses penuh sebagai administrator
                </p>
                <div class="flex items-center justify-center gap-2 mt-4 md:mt-6">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-green-600 text-sm font-medium">System Online</span>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8" data-aos="fade-up" data-aos-delay="300">
                <!-- Pelanggaran Chart -->
                <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Grafik Pelanggaran</h3>
                            <p class="text-gray-600 text-sm">Statistik pelanggaran bulan ini</p>
                        </div>
                        <a href="{{ route('admin.pelanggaran') }}#grafik" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-xs transition-colors">
                            <i class="fas fa-chart-bar mr-1"></i>Lihat Detail
                        </a>
                    </div>
                    <div class="flex justify-center mb-4">
                        <div style="width: 280px; height: 280px;" class="cursor-pointer" onclick="window.location.href='{{ route('admin.pelanggaran') }}#grafik'">
                            <canvas id="dashboardPelanggaranChart"></canvas>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3 text-center">
                        <div class="bg-yellow-50 rounded-lg p-3">
                            <div class="text-lg font-bold text-yellow-700" id="dashboardRingan">0</div>
                            <div class="text-xs text-yellow-600">Ringan</div>
                        </div>
                        <div class="bg-orange-50 rounded-lg p-3">
                            <div class="text-lg font-bold text-orange-700" id="dashboardSedang">0</div>
                            <div class="text-xs text-orange-600">Sedang</div>
                        </div>
                        <div class="bg-red-50 rounded-lg p-3">
                            <div class="text-lg font-bold text-red-700" id="dashboardBerat">0</div>
                            <div class="text-xs text-red-600">Berat</div>
                        </div>
                    </div>
                </div>

                <!-- Prestasi Chart -->
                <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Grafik Prestasi</h3>
                            <p class="text-gray-600 text-sm">Statistik prestasi bulan ini</p>
                        </div>
                        <a href="{{ route('admin.prestasi') }}#grafik" class="bg-amber-600 hover:bg-amber-700 text-white px-3 py-2 rounded-lg text-xs transition-colors">
                            <i class="fas fa-chart-bar mr-1"></i>Lihat Detail
                        </a>
                    </div>
                    <div class="flex justify-center mb-4">
                        <div style="width: 280px; height: 280px;" class="cursor-pointer" onclick="window.location.href='{{ route('admin.prestasi') }}#grafik'">
                            <canvas id="dashboardPrestasiChart"></canvas>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 text-center">
                        <div class="bg-green-50 rounded-lg p-3">
                            <div class="text-lg font-bold text-green-700" id="dashboardAkademik">0</div>
                            <div class="text-xs text-green-600">Akademik</div>
                        </div>
                        <div class="bg-blue-50 rounded-lg p-3">
                            <div class="text-lg font-bold text-blue-700" id="dashboardNonAkademik">0</div>
                            <div class="text-xs text-blue-600">Non-Akademik</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 md:gap-6 mb-8 md:mb-16" data-aos="fade-up" data-aos-delay="400">
                
                <button onclick="openDalamProsesModal()" class="bg-gradient-to-br from-yellow-50 to-yellow-100 border border-yellow-200 rounded-xl md:rounded-2xl p-4 md:p-6 hover-lift text-center flex flex-col justify-center h-full w-full cursor-pointer transition-all">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-clock text-white text-lg md:text-2xl"></i>
                    </div>
                    <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Dalam Proses</p>
                    @php
                        $prestasiCount = App\Models\PrestasiSiswa::where('status', 'menunggu_verifikasi')->count();
                        $pelanggaranMenunggu = App\Models\Pelanggaran::where('status', 'menunggu_verifikasi')->count();
                        $pelanggaranPending = App\Models\Pelanggaran::where('status', 'pending')->count();
                        $pelanggaranDalamSanksi = App\Models\Pelanggaran::where('status', 'dalam_sanksi')->count();
                        $pelaksanaanProses = App\Models\PelaksanaanSanksi::where('status', 'dalam_proses')->count();
                        $pelanggaranCount = $pelanggaranMenunggu + $pelanggaranPending + $pelanggaranDalamSanksi + $pelaksanaanProses;
                    @endphp
                    <p class="text-xl md:text-2xl font-bold text-yellow-700">
                        <span class="text-green-600">{{ $prestasiCount }}</span>/<span class="text-red-600">{{ $pelanggaranCount }}</span>
                    </p>
                </button>
                
                <a href="{{ route('admin.verifikasi-laporan-request') }}" class="bg-gradient-to-br from-indigo-50 to-indigo-100 border border-indigo-200 rounded-xl md:rounded-2xl p-4 md:p-6 hover-lift text-center flex flex-col justify-center h-full cursor-pointer transition-all">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-file-alt text-white text-lg md:text-2xl"></i>
                    </div>
                    <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Verifikasi Laporan</p>
                    @php
                        $pendingLaporan = App\Models\LaporanRequest::where('status', 'pending')->count();
                    @endphp
                    <p class="text-xl md:text-2xl font-bold text-indigo-700">{{ $pendingLaporan }}</p>
                    @if($pendingLaporan > 0)
                    <div class="mt-1">
                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">
                            Pending
                        </span>
                    </div>
                    @endif
                </a>
                
                <a href="{{ route('admin.selesai') }}" class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl md:rounded-2xl p-4 md:p-6 hover-lift text-center flex flex-col justify-center h-full cursor-pointer transition-all">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-check-circle text-white text-lg md:text-2xl"></i>
                    </div>
                    <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Selesai</p>
                    @php
                        $pelanggaranSelesai = App\Models\Pelanggaran::where('status', 'selesai')
                            ->whereMonth('created_at', now()->month)
                            ->whereYear('created_at', now()->year)
                            ->count();
                        $prestasiSelesai = App\Models\PrestasiSiswa::where('status', 'diverifikasi')
                            ->whereMonth('created_at', now()->month)
                            ->whereYear('created_at', now()->year)
                            ->count();
                    @endphp
                    <p class="text-xl md:text-2xl font-bold text-green-700">
                        <span class="text-green-600">{{ $prestasiSelesai }}</span>/<span class="text-red-600">{{ $pelanggaranSelesai }}</span>
                    </p>
                </a>
                
                <button onclick="openTidakTerverifikasiModal()" class="bg-gradient-to-br from-gray-50 to-gray-100 border border-gray-200 rounded-xl md:rounded-2xl p-4 md:p-6 hover-lift text-center flex flex-col justify-center h-full w-full cursor-pointer transition-all">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-gray-500 to-gray-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-times-circle text-white text-lg md:text-2xl"></i>
                    </div>
                    <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Tidak Terverifikasi</p>
                    @php
                        $pelanggaranDitolak = App\Models\Pelanggaran::where('status', 'ditolak')->count();
                        $prestasiDitolak = App\Models\PrestasiSiswa::where('status', 'ditolak')->count();
                        $totalDitolak = $pelanggaranDitolak + $prestasiDitolak;
                    @endphp
                    <p class="text-xl md:text-2xl font-bold text-gray-700">
                        <span class="text-green-600">{{ $prestasiDitolak }}</span>/<span class="text-red-600">{{ $pelanggaranDitolak }}</span>
                    </p>
                </button>
            </div>

            <!-- Menu Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 md:gap-6 mb-8 md:mb-16" data-aos="fade-up" data-aos-delay="500">
                
                <!-- Kelola Siswa -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl md:rounded-2xl p-6 md:p-8 hover-lift text-center flex flex-col justify-between h-full">
                    <div>
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-4 md:mb-6 shadow-lg">
                            <i class="fas fa-users text-white text-2xl md:text-3xl"></i>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Kelola Siswa</h3>
                        <p class="text-gray-600 text-sm md:text-base leading-relaxed mb-4 md:mb-6">
                            Tambah, edit, dan hapus data siswa sekolah
                        </p>
                    </div>
                    <a href="{{ route('admin.siswa') }}" class="inline-block bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 whitespace-nowrap">
                        <i class="fas fa-arrow-right mr-2"></i>Kelola
                    </a>
                </div>

                <!-- Kelola Pelanggaran -->
                <div class="bg-gradient-to-br from-red-50 to-red-100 border border-red-200 rounded-xl md:rounded-2xl p-6 md:p-8 hover-lift text-center flex flex-col justify-between h-full">
                    <div>
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-red-500 to-red-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-4 md:mb-6 shadow-lg">
                            <i class="fas fa-exclamation-triangle text-white text-2xl md:text-3xl"></i>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Kelola Pelanggaran</h3>
                        <p class="text-gray-600 text-sm md:text-base leading-relaxed mb-4 md:mb-6">
                            Monitor dan kelola data pelanggaran siswa
                        </p>
                    </div>
                    <a href="{{ route('admin.pelanggaran') }}" class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 whitespace-nowrap">
                        <i class="fas fa-arrow-right mr-2"></i>Kelola
                    </a>
                </div>

                <!-- Kelola Pengajar -->
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 rounded-xl md:rounded-2xl p-6 md:p-8 hover-lift text-center flex flex-col justify-between h-full">
                    <div>
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-4 md:mb-6 shadow-lg">
                            <i class="fas fa-chalkboard-teacher text-white text-2xl md:text-3xl"></i>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Kelola Pengajar</h3>
                        <p class="text-gray-600 text-sm md:text-base leading-relaxed mb-4 md:mb-6">
                            Kelola data pengajar dan wali kelas
                        </p>
                    </div>
                    <a href="{{ route('admin.guru') }}" class="inline-block bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 whitespace-nowrap">
                        <i class="fas fa-arrow-right mr-2"></i>Kelola
                    </a>
                </div>

                @if(Auth::user()->role !== 'kesiswaan')
                <!-- Kelola User -->
                <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl md:rounded-2xl p-6 md:p-8 hover-lift text-center flex flex-col justify-between h-full">
                    <div>
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-4 md:mb-6 shadow-lg">
                            <i class="fas fa-user-cog text-white text-2xl md:text-3xl"></i>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Kelola User</h3>
                        <p class="text-gray-600 text-sm md:text-base leading-relaxed mb-4 md:mb-6">
                            Tambah dan kelola akun pengguna sistem
                        </p>
                    </div>
                    <div class="relative">
                        <button onclick="toggleUserDropdown()" class="inline-block bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 whitespace-nowrap">
                            <i class="fas fa-arrow-right mr-2"></i>Kelola
                        </button>
                        <div id="userDropdown" class="hidden absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 z-50">
                            <button onclick="openUserModal()" class="w-full px-4 py-3 text-left hover:bg-gray-50 rounded-t-lg transition-colors">
                                <i class="fas fa-users mr-2 text-green-600"></i>Lihat Semua User
                            </button>
                            <a href="{{ route('register') }}" class="block w-full px-4 py-3 text-left hover:bg-gray-50 rounded-b-lg transition-colors">
                                <i class="fas fa-user-plus mr-2 text-green-600"></i>Tambah User Baru
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Prestasi Siswa -->
                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 border border-yellow-200 rounded-xl md:rounded-2xl p-6 md:p-8 hover-lift text-center flex flex-col justify-between h-full">
                    <div>
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-4 md:mb-6 shadow-lg">
                            <i class="fas fa-trophy text-white text-2xl md:text-3xl"></i>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Prestasi Siswa</h3>
                        <p class="text-gray-600 text-sm md:text-base leading-relaxed mb-4 md:mb-6">
                            Kelola prestasi akademik dan non-akademik
                        </p>
                    </div>
                    <a href="{{ route('admin.prestasi') }}" class="inline-block bg-gradient-to-r from-yellow-600 to-yellow-700 hover:from-yellow-700 hover:to-yellow-800 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 whitespace-nowrap">
                        <i class="fas fa-arrow-right mr-2"></i>Kelola
                    </a>
                </div>
            </div>



        </main>
    </div>

    <!-- Floating Action Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <div class="relative">
            <button onclick="toggleFAB()" class="w-14 h-14 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center transform hover:scale-110">
                <i id="fabIcon" class="fas fa-plus text-xl"></i>
            </button>
            
            <!-- FAB Menu -->
            <div id="fabMenu" class="hidden absolute bottom-16 right-0 bg-white rounded-lg shadow-xl border border-gray-200 p-2 min-w-48">
                <a href="{{ route('admin.guru') }}" class="flex items-center gap-3 px-3 py-2 hover:bg-gray-50 rounded-lg transition-colors text-sm">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-chalkboard-teacher text-purple-600 text-sm"></i>
                    </div>
                    <span class="text-gray-700">Kelola Pengajar</span>
                </a>
                <a href="{{ route('admin.prestasi') }}" class="flex items-center gap-3 px-3 py-2 hover:bg-gray-50 rounded-lg transition-colors text-sm">
                    <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-trophy text-yellow-600 text-sm"></i>
                    </div>
                    <span class="text-gray-700">Reward</span>
                </a>
                <a href="{{ route('admin.laporan') }}" class="flex items-center gap-3 px-3 py-2 hover:bg-gray-50 rounded-lg transition-colors text-sm">
                    <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clipboard-list text-red-600 text-sm"></i>
                    </div>
                    <span class="text-gray-700">Verifikasi Pelanggaran</span>
                </a>
                <a href="{{ route('admin.verifikasi-laporan-request') }}" class="flex items-center gap-3 px-3 py-2 hover:bg-gray-50 rounded-lg transition-colors text-sm">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-file-alt text-blue-600 text-sm"></i>
                    </div>
                    <span class="text-gray-700">Verifikasi Laporan</span>
                </a>
                <a href="{{ route('admin.sanksi') }}" class="flex items-center gap-3 px-3 py-2 hover:bg-gray-50 rounded-lg transition-colors text-sm">
                    <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-gavel text-orange-600 text-sm"></i>
                    </div>
                    <span class="text-gray-700">Sanksi</span>
                </a>
            </div>
        </div>
    </div>



    <!-- Modal Grafik Pelanggaran -->
    <div id="grafikModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-6xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Grafik Pelanggaran</h3>
                        <p class="text-gray-600">Statistik pelanggaran per bulan dan tahun</p>
                    </div>
                    <div class="flex gap-3 items-center">
                        <button onclick="exportCurrentViewModal()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors">
                            <i class="fas fa-file-pdf mr-2"></i>Export PDF
                        </button>
                        <button onclick="closeGrafikModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- Filter -->
                <div class="mb-6 flex justify-between items-center">
                    <div class="flex gap-4">
                        <select id="periodeFilterModal" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" onchange="toggleFilterInputsModal()">
                            <option value="bulan">Bulan</option>
                            <option value="tahun">Tahun</option>
                            <option value="all">Semua Data</option>
                        </select>
                        
                        <select id="bulanFilterModal" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ $i == now()->month ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                </option>
                            @endfor
                        </select>
                        
                        <select id="tahunFilterModal" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                            @for($i = now()->year; $i >= now()->year - 5; $i--)
                                <option value="{{ $i }}" {{ $i == now()->year ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        
                        <button onclick="updateGrafikModal()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors">
                            <i class="fas fa-sync mr-2"></i>Update
                        </button>
                    </div>
                </div>

                <!-- Chart -->
                <div class="bg-gray-50 rounded-lg p-4 mb-6 flex justify-center">
                    <div style="width: 300px; height: 300px;">
                        <canvas id="pelanggaranChart"></canvas>
                    </div>
                </div>

                <!-- Summary -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <h4 id="totalLabelModal" class="font-semibold text-gray-800 mb-2">Total Bulan Ini</h4>
                        <p id="totalTahun" class="text-2xl font-bold text-gray-700">0</p>
                    </div>
                    <div class="bg-yellow-50 rounded-lg p-4 text-center">
                        <h4 class="font-semibold text-yellow-800 mb-2">Pelanggaran Ringan</h4>
                        <p id="pelanggaranRingan" class="text-2xl font-bold text-yellow-700">0</p>
                    </div>
                    <div class="bg-orange-50 rounded-lg p-4 text-center">
                        <h4 class="font-semibold text-orange-800 mb-2">Pelanggaran Sedang</h4>
                        <p id="pelanggaranSedang" class="text-2xl font-bold text-orange-700">0</p>
                    </div>
                    <div class="bg-red-50 rounded-lg p-4 text-center">
                        <h4 class="font-semibold text-red-800 mb-2">Pelanggaran Berat</h4>
                        <p id="pelanggaranBerat" class="text-2xl font-bold text-red-700">0</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Status Pelanggaran -->
    <div id="statusModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-6xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 id="statusModalTitle" class="text-2xl font-bold text-gray-800">Detail Status</h3>
                        <p class="text-gray-600">Daftar pelanggaran berdasarkan status</p>
                    </div>
                    <button onclick="closeStatusModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <!-- Filter Status -->
                <div class="mb-6 flex gap-4">
                    <select id="tahunStatusFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="{{ now()->year }}">{{ now()->year }}</option>
                        <option value="{{ now()->year - 1 }}">{{ now()->year - 1 }}</option>
                        <option value="{{ now()->year - 2 }}">{{ now()->year - 2 }}</option>
                    </select>
                    <select id="bulanStatusFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Bulan</option>
                        <option value="1" {{ now()->month == 1 ? 'selected' : '' }}>Januari</option>
                        <option value="2" {{ now()->month == 2 ? 'selected' : '' }}>Februari</option>
                        <option value="3" {{ now()->month == 3 ? 'selected' : '' }}>Maret</option>
                        <option value="4" {{ now()->month == 4 ? 'selected' : '' }}>April</option>
                        <option value="5" {{ now()->month == 5 ? 'selected' : '' }}>Mei</option>
                        <option value="6" {{ now()->month == 6 ? 'selected' : '' }}>Juni</option>
                        <option value="7" {{ now()->month == 7 ? 'selected' : '' }}>Juli</option>
                        <option value="8" {{ now()->month == 8 ? 'selected' : '' }}>Agustus</option>
                        <option value="9" {{ now()->month == 9 ? 'selected' : '' }}>September</option>
                        <option value="10" {{ now()->month == 10 ? 'selected' : '' }}>Oktober</option>
                        <option value="11" {{ now()->month == 11 ? 'selected' : '' }}>November</option>
                        <option value="12" {{ now()->month == 12 ? 'selected' : '' }}>Desember</option>
                    </select>
                    <button onclick="loadStatusData()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-search mr-2"></i>Filter
                    </button>
                </div>

                <!-- Status Content -->
                <div id="statusContent" class="space-y-4">
                    <!-- Data status akan dimuat di sini -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Pelanggaran -->
    <div id="detailPelanggaranModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-6xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Detail Pelanggaran</h3>
                        <p class="text-gray-600">Riwayat lengkap pelanggaran per bulan dan tahun</p>
                    </div>
                    <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <!-- Filter Detail -->
                <div class="mb-6 flex gap-4">
                    <select id="tahunDetailFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="{{ now()->year }}">{{ now()->year }}</option>
                        <option value="{{ now()->year - 1 }}">{{ now()->year - 1 }}</option>
                        <option value="{{ now()->year - 2 }}">{{ now()->year - 2 }}</option>
                    </select>
                    <select id="bulanDetailFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Bulan</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                    <button onclick="loadDetailData()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-search mr-2"></i>Filter
                    </button>
                </div>

                <!-- Detail Content -->
                <div id="detailContent" class="space-y-4">
                    <!-- Data detail akan dimuat di sini -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Siswa Berprestasi -->
    <div id="prestasiModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-6xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Siswa Berprestasi</h3>
                        <p class="text-gray-600">Daftar siswa dan grafik prestasi</p>
                    </div>
                    <button onclick="closePrestasiModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <!-- Tab Navigation -->
                <div class="flex border-b border-gray-200 mb-6">
                    <button onclick="switchPrestasiTab('list')" id="listTab" class="px-4 py-2 text-sm font-medium text-amber-600 border-b-2 border-amber-600">
                        <i class="fas fa-list mr-2"></i>Daftar Siswa
                    </button>
                    <button onclick="switchPrestasiTab('chart')" id="chartTab" class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent">
                        <i class="fas fa-chart-pie mr-2"></i>Grafik Prestasi
                    </button>
                </div>

                <!-- List Content -->
                <div id="prestasiListContent">

                    
                    <div id="siswaPrestasiList">
                        @php
                            $siswaBerprestasi = App\Models\Siswa::where('poin_prestasi', '>', 0)->with(['prestasiSiswa' => function($q) {
                                $q->where('status', 'diverifikasi')->with('prestasi');
                            }])->get();
                        @endphp
                        @forelse($siswaBerprestasi as $siswa)
                            <div class="inline-block bg-gradient-to-r from-amber-50 to-yellow-50 rounded-lg p-3 border border-amber-200 m-1 cursor-pointer hover:shadow-md transition-shadow" onclick="openPrestasiDetailModal({{ $siswa->id }})">
                                <div class="text-center">
                                    <h5 class="text-sm font-medium text-gray-800 mb-1">{{ $siswa->nama }}</h5>
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                        {{ $siswa->poin_prestasi }} Poin
                                    </span>
                                    <div class="text-xs text-amber-600 mt-1">
                                        <i class="fas fa-eye mr-1"></i>Show More
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-trophy text-amber-600 text-2xl"></i>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-2">Belum Ada Siswa Berprestasi</h4>
                                <p class="text-gray-600">Siswa dengan poin prestasi akan muncul di sini</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Chart Content -->
                <div id="prestasiChartContent" class="hidden">
                    <!-- Filter -->
                    <div class="mb-6 flex justify-between items-center">
                        <div class="flex gap-4">
                            <select id="periodeFilterPrestasi" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500" onchange="toggleFilterInputsPrestasi()">
                                <option value="bulan">Bulan</option>
                                <option value="tahun">Tahun</option>
                                <option value="all">Semua Data</option>
                            </select>
                            
                            <select id="bulanFilterPrestasi" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ $i == now()->month ? 'selected' : '' }}>
                                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                    </option>
                                @endfor
                            </select>
                            
                            <select id="tahunFilterPrestasi" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                                @for($i = now()->year; $i >= now()->year - 5; $i--)
                                    <option value="{{ $i }}" {{ $i == now()->year ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            
                            <button onclick="updateGrafikPrestasi()" class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg transition-colors">
                                <i class="fas fa-sync mr-2"></i>Update
                            </button>
                        </div>
                        <button onclick="exportCurrentViewPrestasi()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors">
                            <i class="fas fa-file-pdf mr-2"></i>Export PDF
                        </button>
                    </div>

                    <!-- Chart -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-6 flex justify-center">
                        <div style="width: 300px; height: 300px;">
                            <canvas id="prestasiChart"></canvas>
                        </div>
                    </div>

                    <!-- Summary -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <h4 id="totalLabelPrestasi" class="font-semibold text-gray-800 mb-2">Total Bulan Ini</h4>
                            <p id="totalPrestasi" class="text-2xl font-bold text-gray-700">0</p>
                        </div>
                        <div class="bg-green-50 rounded-lg p-4 text-center">
                            <h4 class="font-semibold text-green-800 mb-2">Prestasi Akademik</h4>
                            <p id="prestasiAkademikCount" class="text-2xl font-bold text-green-700">0</p>
                        </div>
                        <div class="bg-blue-50 rounded-lg p-4 text-center">
                            <h4 class="font-semibold text-blue-800 mb-2">Prestasi Non-Akademik</h4>
                            <p id="prestasiNonAkademikCount" class="text-2xl font-bold text-blue-700">0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal User Management -->
    <div id="userModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-6xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Kelola User</h3>
                        <p class="text-gray-600">Daftar semua akun pengguna sistem</p>
                    </div>
                    <button onclick="closeUserModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div id="userContent" class="space-y-4">
                    @foreach(App\Models\User::all() as $user)
                        <div class="bg-gray-50 rounded-lg p-4 border">
                            <div class="flex justify-between items-start mb-2">
                                <h5 class="font-semibold text-gray-800">{{ $user->name }}</h5>
                                <span class="px-2 py-1 text-xs rounded-full bg-{{ $user->role == 'admin' ? 'red' : ($user->role == 'kesiswaan' ? 'blue' : 'green') }}-100 text-{{ $user->role == 'admin' ? 'red' : ($user->role == 'kesiswaan' ? 'blue' : 'green') }}-800">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-600 mb-1">Email: {{ $user->email }}</p>
                            <p class="text-sm text-gray-500">Dibuat: {{ $user->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Prestasi Siswa -->
    <div id="prestasiDetailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 id="prestasiDetailTitle" class="text-2xl font-bold text-gray-800">Detail Prestasi Siswa</h3>
                        <p id="prestasiDetailSubtitle" class="text-gray-600">Riwayat lengkap prestasi siswa</p>
                    </div>
                    <button onclick="closePrestasiDetailModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div id="prestasiDetailContent" class="space-y-4">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- AOS Animation Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });
        
        // Typing effect
        const text = "Halo Selamat Datang {{ Auth::user()->name ?? 'Admin' }}";
        const typedTextElement = document.getElementById('typed-text');
        let index = 0;
        let isDeleting = false;
        
        function typeWriter() {
            const currentText = text.substring(0, index);
            typedTextElement.innerHTML = currentText + '<span class="cursor">|</span>';
            
            if (!isDeleting && index < text.length) {
                index++;
                setTimeout(typeWriter, 100);
            } else if (isDeleting && index > 0) {
                index--;
                setTimeout(typeWriter, 50);
            } else if (!isDeleting && index === text.length) {
                setTimeout(() => {
                    isDeleting = true;
                    typeWriter();
                }, 2000);
            } else if (isDeleting && index === 0) {
                isDeleting = false;
                setTimeout(typeWriter, 500);
            }
        }
        
        typeWriter();
        
        // Dashboard Charts
        let dashboardPelanggaranChart;
        let dashboardPrestasiChart;
        
        // Load dashboard charts on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadDashboardCharts();
        });
        
        async function loadDashboardCharts() {
            await Promise.all([
                loadDashboardPelanggaranChart(),
                loadDashboardPrestasiChart()
            ]);
        }
        
        async function loadDashboardPelanggaranChart() {
            try {
                const response = await fetch('/admin/grafik-pelanggaran');
                const data = await response.json();
                
                if (dashboardPelanggaranChart) {
                    dashboardPelanggaranChart.destroy();
                }
                
                const ctx = document.getElementById('dashboardPelanggaranChart').getContext('2d');
                
                // Handle case when all data is 0
                const hasData = data.ringan > 0 || data.sedang > 0 || data.berat > 0;
                
                if (hasData) {
                    dashboardPelanggaranChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Ringan (1-5)', 'Sedang (6-15)', 'Berat (16+)'],
                            datasets: [{
                                data: [data.ringan, data.sedang, data.berat],
                                backgroundColor: [
                                    'rgba(234, 179, 8, 0.8)',
                                    'rgba(251, 146, 60, 0.8)',
                                    'rgba(239, 68, 68, 0.8)'
                                ],
                                borderColor: [
                                    'rgb(234, 179, 8)',
                                    'rgb(251, 146, 60)',
                                    'rgb(239, 68, 68)'
                                ],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        padding: 15,
                                        font: {
                                            size: 11
                                        }
                                    }
                                }
                            }
                        }
                    });
                } else {
                    // Show "no data" message
                    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
                    ctx.font = '14px Poppins';
                    ctx.fillStyle = '#9CA3AF';
                    ctx.textAlign = 'center';
                    ctx.fillText('Tidak ada data', ctx.canvas.width / 2, ctx.canvas.height / 2);
                }
                
                document.getElementById('dashboardRingan').textContent = data.ringan || 0;
                document.getElementById('dashboardSedang').textContent = data.sedang || 0;
                document.getElementById('dashboardBerat').textContent = data.berat || 0;
                
            } catch (error) {
                console.error('Error loading dashboard pelanggaran chart:', error);
                document.getElementById('dashboardRingan').textContent = '0';
                document.getElementById('dashboardSedang').textContent = '0';
                document.getElementById('dashboardBerat').textContent = '0';
            }
        }
        
        async function loadDashboardPrestasiChart() {
            try {
                const response = await fetch('/admin/grafik-prestasi');
                const data = await response.json();
                
                if (dashboardPrestasiChart) {
                    dashboardPrestasiChart.destroy();
                }
                
                const ctx = document.getElementById('dashboardPrestasiChart').getContext('2d');
                
                // Handle case when all data is 0
                const hasData = data.akademik > 0 || data.non_akademik > 0;
                
                if (hasData) {
                    dashboardPrestasiChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Akademik', 'Non-Akademik'],
                            datasets: [{
                                data: [data.akademik, data.non_akademik],
                                backgroundColor: [
                                    'rgba(34, 197, 94, 0.8)',
                                    'rgba(59, 130, 246, 0.8)'
                                ],
                                borderColor: [
                                    'rgb(34, 197, 94)',
                                    'rgb(59, 130, 246)'
                                ],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        padding: 15,
                                        font: {
                                            size: 11
                                        }
                                    }
                                }
                            }
                        }
                    });
                } else {
                    // Show "no data" message
                    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
                    ctx.font = '14px Poppins';
                    ctx.fillStyle = '#9CA3AF';
                    ctx.textAlign = 'center';
                    ctx.fillText('Tidak ada data', ctx.canvas.width / 2, ctx.canvas.height / 2);
                }
                
                document.getElementById('dashboardAkademik').textContent = data.akademik || 0;
                document.getElementById('dashboardNonAkademik').textContent = data.non_akademik || 0;
                
            } catch (error) {
                console.error('Error loading dashboard prestasi chart:', error);
                document.getElementById('dashboardAkademik').textContent = '0';
                document.getElementById('dashboardNonAkademik').textContent = '0';
            }
        }
        

        
        // Grafik Modal Functions
        let pelanggaranChart;
        
        function openGrafikModal() {
            document.getElementById('grafikModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            toggleFilterInputsModal();
            loadGrafikData();
        }
        
        function closeGrafikModal() {
            document.getElementById('grafikModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        function updateGrafikModal() {
            loadGrafikData();
        }
        
        function toggleFilterInputsModal() {
            const periode = document.getElementById('periodeFilterModal').value;
            const bulanFilter = document.getElementById('bulanFilterModal');
            const tahunFilter = document.getElementById('tahunFilterModal');
            
            if (periode === 'bulan') {
                bulanFilter.style.display = 'block';
                tahunFilter.style.display = 'block';
            } else if (periode === 'tahun') {
                bulanFilter.style.display = 'none';
                tahunFilter.style.display = 'block';
            } else {
                bulanFilter.style.display = 'none';
                tahunFilter.style.display = 'none';
            }
        }
        
        function getChartTitleModal(periode, bulan, tahun) {
            if (periode === 'bulan') {
                const bulanNama = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                return `Kategori Pelanggaran ${bulanNama[bulan]} ${tahun}`;
            } else if (periode === 'tahun') {
                return `Kategori Pelanggaran Tahun ${tahun}`;
            } else {
                return 'Kategori Pelanggaran Semua Data';
            }
        }
        
        function getTotalLabelModal(periode, bulan, tahun) {
            if (periode === 'bulan') {
                const bulanNama = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                return `Total ${bulanNama[bulan]} ${tahun}`;
            } else if (periode === 'tahun') {
                return `Total Tahun ${tahun}`;
            } else {
                return 'Total';
            }
        }
        
        function exportCurrentViewModal() {
            const periode = document.getElementById('periodeFilterModal').value;
            const bulan = document.getElementById('bulanFilterModal').value;
            const tahun = document.getElementById('tahunFilterModal').value;
            
            let url = '/admin/export-pelanggaran?';
            url += `periode=${periode}`;
            if (periode === 'bulan') {
                url += `&bulan=${bulan}&tahun=${tahun}`;
            } else if (periode === 'tahun') {
                url += `&tahun=${tahun}`;
            }
            
            window.open(url, '_blank');
        }
        
        async function loadGrafikData() {
            const periode = document.getElementById('periodeFilterModal').value;
            const bulan = document.getElementById('bulanFilterModal').value;
            const tahun = document.getElementById('tahunFilterModal').value;
            
            let url = '/admin/grafik-pelanggaran?';
            if (periode === 'bulan') {
                url += `bulan=${bulan}&tahun=${tahun}`;
            } else if (periode === 'tahun') {
                url += `tahun=${tahun}`;
            }
            
            try {
                const response = await fetch(url);
                const data = await response.json();
                
                // Update chart
                if (pelanggaranChart) {
                    pelanggaranChart.destroy();
                }
                
                const ctx = document.getElementById('pelanggaranChart').getContext('2d');
                pelanggaranChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Pelanggaran Ringan (1-5 Poin)', 'Pelanggaran Sedang (6-15 Poin)', 'Pelanggaran Berat (16+ Poin)'],
                        datasets: [{
                            data: [data.ringan, data.sedang, data.berat],
                            backgroundColor: [
                                'rgba(234, 179, 8, 0.8)',
                                'rgba(251, 146, 60, 0.8)',
                                'rgba(239, 68, 68, 0.8)'
                            ],
                            borderColor: [
                                'rgb(234, 179, 8)',
                                'rgb(251, 146, 60)',
                                'rgb(239, 68, 68)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: getChartTitleModal(periode, bulan, tahun)
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
                
                // Update summary
                document.getElementById('totalTahun').textContent = data.total;
                document.getElementById('pelanggaranRingan').textContent = data.ringan;
                document.getElementById('pelanggaranSedang').textContent = data.sedang;
                document.getElementById('pelanggaranBerat').textContent = data.berat;
                
                // Update total label
                document.getElementById('totalLabelModal').textContent = getTotalLabelModal(periode, bulan, tahun);
                
            } catch (error) {
                console.error('Error loading grafik data:', error);
            }
        }
        
        // Close modal when clicking outside
        document.getElementById('grafikModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeGrafikModal();
            }
        });
        
        // Detail Modal Functions
        function openDetailModal() {
            document.getElementById('detailPelanggaranModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            loadDetailData();
        }
        
        function closeDetailModal() {
            document.getElementById('detailPelanggaranModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        async function loadDetailData() {
            const tahun = document.getElementById('tahunDetailFilter').value;
            const bulan = document.getElementById('bulanDetailFilter').value;
            
            try {
                const response = await fetch(`/admin/detail-pelanggaran?tahun=${tahun}&bulan=${bulan}`);
                const data = await response.json();
                
                const detailContent = document.getElementById('detailContent');
                detailContent.innerHTML = '';
                
                if (data.pelanggaran && data.pelanggaran.length > 0) {
                    data.pelanggaran.forEach(p => {
                        const div = document.createElement('div');
                        div.className = 'bg-gray-50 rounded-lg p-4 border';
                        div.innerHTML = `
                            <div class="flex justify-between items-start mb-2">
                                <h5 class="font-semibold text-gray-800">${p.siswa_nama}</h5>
                                <div class="flex gap-2">
                                    <span class="px-2 py-1 text-xs rounded-full ${
                                        p.status === 'selesai' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'
                                    }">${p.status === 'selesai' ? 'Selesai' : 'Dalam Progress'}</span>
                                    <span class="text-xs text-gray-500">${new Date(p.created_at).toLocaleDateString('id-ID')}</span>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 mb-1">${p.jenis_pelanggaran}</p>
                            <span class="px-2 py-1 text-xs rounded-full ${
                                p.poin <= 5 ? 'bg-yellow-100 text-yellow-800' :
                                p.poin <= 15 ? 'bg-orange-100 text-orange-800' :
                                'bg-red-100 text-red-800'
                            }">${p.poin} Poin</span>
                        `;
                        detailContent.appendChild(div);
                    });
                } else {
                    detailContent.innerHTML = '<div class="text-center text-gray-500 py-8">Tidak ada data pelanggaran</div>';
                }
            } catch (error) {
                console.error('Error loading detail data:', error);
            }
        }
        
        // Status Modal Functions
        let currentStatus = '';
        
        function openStatusModal(status) {
            currentStatus = status;
            document.getElementById('statusModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            const title = status === 'selesai' ? 'Kasus Selesai' : 'Kasus Dalam Proses';
            document.getElementById('statusModalTitle').textContent = title;
            
            loadStatusData();
        }
        

        
        function openDalamProsesModal() {
            document.getElementById('statusModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            document.getElementById('statusModalTitle').textContent = 'Kasus Dalam Proses';
            loadDalamProsesData();
        }
        
        async function loadDalamProsesData() {
            const statusContent = document.getElementById('statusContent');
            statusContent.innerHTML = `
                <div class="grid grid-cols-1 gap-6">
                    <!-- Prestasi Section -->
                    <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                        <h4 class="font-semibold text-green-800 mb-3 flex items-center">
                            <i class="fas fa-trophy mr-2"></i>Prestasi - Menunggu Verifikasi
                        </h4>
                        <div id="prestasiMenunggu" class="space-y-2"></div>
                    </div>
                    
                    <!-- Pelanggaran Sections -->
                    <div class="bg-red-50 rounded-lg p-4 border border-red-200">
                        <h4 class="font-semibold text-red-800 mb-3 flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Pelanggaran - Proses Lengkap
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-orange-50 rounded-lg p-3 border border-orange-200">
                                <h5 class="font-medium text-orange-800 mb-2 text-sm flex items-center">
                                    <i class="fas fa-hourglass-half mr-1"></i>Menunggu Verifikasi
                                </h5>
                                <div id="pelanggaranMenunggu" class="space-y-2"></div>
                            </div>
                            <div class="bg-yellow-50 rounded-lg p-3 border border-yellow-200">
                                <h5 class="font-medium text-yellow-800 mb-2 text-sm flex items-center">
                                    <i class="fas fa-gavel mr-1"></i>Sudah Diverifikasi
                                </h5>
                                <div id="pelanggaranDiverifikasi" class="space-y-2"></div>
                            </div>
                            <div class="bg-purple-50 rounded-lg p-3 border border-purple-200">
                                <h5 class="font-medium text-purple-800 mb-2 text-sm flex items-center">
                                    <i class="fas fa-tasks mr-1"></i>Sedang Pelaksanaan
                                </h5>
                                <div id="pelanggaranPelaksanaan" class="space-y-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Load prestasi data
            await loadPrestasiMenungguData();
            
            // Load pelanggaran data for each stage
            await Promise.all([
                loadPelanggaranMenungguData(),
                loadSectionData('pending', 'pelanggaranDiverifikasi'),
                loadPelaksanaanData('pelanggaranPelaksanaan')
            ]);
        }
        
        async function loadPrestasiMenungguData() {
            const container = document.getElementById('prestasiMenunggu');
            
            try {
                const response = await fetch('/admin/get-prestasi-verifikasi');
                const data = await response.json();
                
                if (data.prestasi && data.prestasi.length > 0) {
                    data.prestasi.forEach(p => {
                        const div = document.createElement('div');
                        div.className = 'bg-white rounded p-3 border text-sm';
                        div.innerHTML = `
                            <div class="font-medium text-gray-800">${p.siswa.nama}</div>
                            <div class="text-green-600">${p.prestasi.nama}</div>
                            <div class="text-xs text-gray-500 mt-1">${new Date(p.created_at).toLocaleDateString('id-ID')}</div>
                        `;
                        container.appendChild(div);
                    });
                } else {
                    container.innerHTML = '<div class="text-center text-gray-500 text-sm">Tidak ada data</div>';
                }
            } catch (error) {
                console.error('Error loading prestasi data:', error);
                container.innerHTML = '<div class="text-center text-red-500 text-sm">Error loading data</div>';
            }
        }
        
        async function loadPelanggaranMenungguData() {
            const container = document.getElementById('pelanggaranMenunggu');
            
            try {
                const response = await fetch(`/admin/detail-pelanggaran?status=menunggu_verifikasi`);
                const data = await response.json();
                
                if (data.pelanggaran && data.pelanggaran.length > 0) {
                    const filtered = data.pelanggaran.filter(p => p.status === 'menunggu_verifikasi');
                    if (filtered.length > 0) {
                        filtered.forEach(p => {
                            const div = document.createElement('div');
                            div.className = 'bg-white rounded p-2 border text-xs';
                            div.innerHTML = `
                                <div class="font-medium text-gray-800">${p.siswa_nama}</div>
                                <div class="text-red-600">${p.jenis_pelanggaran}</div>
                                <div class="text-gray-500 mt-1">${new Date(p.created_at).toLocaleDateString('id-ID')}</div>
                            `;
                            container.appendChild(div);
                        });
                    } else {
                        container.innerHTML = '<div class="text-center text-gray-500 text-xs">Tidak ada data</div>';
                    }
                } else {
                    container.innerHTML = '<div class="text-center text-gray-500 text-xs">Tidak ada data</div>';
                }
            } catch (error) {
                console.error('Error loading pelanggaran data:', error);
                container.innerHTML = '<div class="text-center text-red-500 text-xs">Error loading data</div>';
            }
        }
        
        async function loadSectionData(status, containerId) {
            try {
                const response = await fetch(`/admin/detail-pelanggaran?status=${status}`);
                const data = await response.json();
                const container = document.getElementById(containerId);
                
                if (data.pelanggaran && data.pelanggaran.length > 0) {
                    const filteredData = data.pelanggaran.filter(p => p.status === status);
                    if (filteredData.length > 0) {
                        filteredData.forEach(p => {
                            const div = document.createElement('div');
                            div.className = 'bg-white rounded p-3 border text-sm';
                            div.innerHTML = `
                                <div class="font-medium text-gray-800">${p.siswa_nama}</div>
                                <div class="text-gray-600 text-xs">${p.jenis_pelanggaran}</div>
                                <div class="text-xs text-gray-500 mt-1">${new Date(p.created_at).toLocaleDateString('id-ID')}</div>
                            `;
                            container.appendChild(div);
                        });
                    } else {
                        container.innerHTML = '<div class="text-center text-gray-500 text-sm">Tidak ada data</div>';
                    }
                } else {
                    container.innerHTML = '<div class="text-center text-gray-500 text-sm">Tidak ada data</div>';
                }
            } catch (error) {
                console.error('Error loading section data:', error);
                document.getElementById(containerId).innerHTML = '<div class="text-center text-red-500 text-sm">Error loading data</div>';
            }
        }
        
        async function loadPelaksanaanData(containerId) {
            try {
                const response = await fetch('/admin/get-pelaksanaan-sanksi-data');
                const data = await response.json();
                const container = document.getElementById(containerId);
                
                if (data.pelaksanaan_sanksi && data.pelaksanaan_sanksi.length > 0) {
                    data.pelaksanaan_sanksi.forEach(p => {
                        const div = document.createElement('div');
                        div.className = 'bg-white rounded p-3 border text-sm';
                        div.innerHTML = `
                            <div class="font-medium text-gray-800">${p.siswa.nama}</div>
                            <div class="text-gray-600 text-xs">${p.jenis_sanksi}</div>
                            <div class="text-xs text-gray-500 mt-1">${new Date(p.created_at).toLocaleDateString('id-ID')}</div>
                        `;
                        container.appendChild(div);
                    });
                } else {
                    container.innerHTML = '<div class="text-center text-gray-500 text-sm">Tidak ada data</div>';
                }
            } catch (error) {
                console.error('Error loading pelaksanaan data:', error);
                document.getElementById(containerId).innerHTML = '<div class="text-center text-red-500 text-sm">Error loading data</div>';
            }
        }
        
        function closeStatusModal() {
            document.getElementById('statusModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        async function loadStatusData() {
            const tahun = document.getElementById('tahunStatusFilter').value;
            const bulan = document.getElementById('bulanStatusFilter').value;
            
            try {
                const response = await fetch(`/admin/detail-pelanggaran?tahun=${tahun}&bulan=${bulan}&status=${currentStatus}`);
                const data = await response.json();
                
                const statusContent = document.getElementById('statusContent');
                statusContent.innerHTML = '';
                
                if (data.pelanggaran && data.pelanggaran.length > 0) {
                    const filteredData = data.pelanggaran.filter(p => p.status === currentStatus);
                    if (filteredData.length > 0) {
                        filteredData.forEach(p => {
                            const div = document.createElement('div');
                            div.className = 'bg-gray-50 rounded-lg p-4 border';
                            div.innerHTML = `
                                <div class="flex justify-between items-start mb-2">
                                    <h5 class="font-semibold text-gray-800">${p.siswa_nama}</h5>
                                    <div class="flex gap-2">
                                        <span class="px-2 py-1 text-xs rounded-full ${
                                            p.status === 'selesai' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'
                                        }">${p.status === 'selesai' ? 'Selesai' : 'Dalam Progress'}</span>
                                        <span class="text-xs text-gray-500">${new Date(p.created_at).toLocaleDateString('id-ID')}</span>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 mb-1">${p.jenis_pelanggaran}</p>
                                <span class="px-2 py-1 text-xs rounded-full ${
                                    p.poin <= 5 ? 'bg-yellow-100 text-yellow-800' :
                                    p.poin <= 15 ? 'bg-orange-100 text-orange-800' :
                                    'bg-red-100 text-red-800'
                                }">${p.poin} Poin</span>
                            `;
                            statusContent.appendChild(div);
                        });
                    } else {
                        statusContent.innerHTML = '<div class="text-center text-gray-500 py-8">Tidak ada data pelanggaran</div>';
                    }
                } else {
                    statusContent.innerHTML = '<div class="text-center text-gray-500 py-8">Tidak ada data pelanggaran</div>';
                }
            } catch (error) {
                console.error('Error loading status data:', error);
            }
        }
        

        
        // Close status modal when clicking outside
        document.getElementById('statusModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeStatusModal();
            }
        });
        
        // Close detail modal when clicking outside
        document.getElementById('detailPelanggaranModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDetailModal();
            }
        });
        
        // Prestasi Modal Functions
        let prestasiChart;
        
        function openPrestasiModal() {
            document.getElementById('prestasiModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            switchPrestasiTab('list'); // Default to list tab
        }
        
        function closePrestasiModal() {
            document.getElementById('prestasiModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        function switchPrestasiTab(tab) {
            const listTab = document.getElementById('listTab');
            const chartTab = document.getElementById('chartTab');
            const listContent = document.getElementById('prestasiListContent');
            const chartContent = document.getElementById('prestasiChartContent');
            
            if (tab === 'list') {
                listTab.className = 'px-4 py-2 text-sm font-medium text-amber-600 border-b-2 border-amber-600';
                chartTab.className = 'px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent';
                listContent.classList.remove('hidden');
                chartContent.classList.add('hidden');
            } else {
                listTab.className = 'px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent';
                chartTab.className = 'px-4 py-2 text-sm font-medium text-amber-600 border-b-2 border-amber-600';
                listContent.classList.add('hidden');
                chartContent.classList.remove('hidden');
                toggleFilterInputsPrestasi();
                loadGrafikPrestasi();
            }
        }
        
        function toggleFilterInputsPrestasi() {
            const periode = document.getElementById('periodeFilterPrestasi').value;
            const bulanFilter = document.getElementById('bulanFilterPrestasi');
            const tahunFilter = document.getElementById('tahunFilterPrestasi');
            
            if (periode === 'bulan') {
                bulanFilter.style.display = 'block';
                tahunFilter.style.display = 'block';
            } else if (periode === 'tahun') {
                bulanFilter.style.display = 'none';
                tahunFilter.style.display = 'block';
            } else {
                bulanFilter.style.display = 'none';
                tahunFilter.style.display = 'none';
            }
        }
        
        function updateGrafikPrestasi() {
            loadGrafikPrestasi();
        }
        
        function exportCurrentViewPrestasi() {
            const periode = document.getElementById('periodeFilterPrestasi').value;
            const bulan = document.getElementById('bulanFilterPrestasi').value;
            const tahun = document.getElementById('tahunFilterPrestasi').value;
            
            let url = '/admin/export-prestasi?';
            url += `periode=${periode}`;
            if (periode === 'bulan') {
                url += `&bulan=${bulan}&tahun=${tahun}`;
            } else if (periode === 'tahun') {
                url += `&tahun=${tahun}`;
            }
            
            window.open(url, '_blank');
        }
        
        async function loadGrafikPrestasi() {
            const periode = document.getElementById('periodeFilterPrestasi').value;
            const bulan = document.getElementById('bulanFilterPrestasi').value;
            const tahun = document.getElementById('tahunFilterPrestasi').value;
            
            let url = '/admin/grafik-prestasi?';
            if (periode === 'bulan') {
                url += `bulan=${bulan}&tahun=${tahun}`;
            } else if (periode === 'tahun') {
                url += `tahun=${tahun}`;
            }
            
            try {
                const response = await fetch(url);
                const data = await response.json();
                
                // Update chart
                if (prestasiChart) {
                    prestasiChart.destroy();
                }
                
                const ctx = document.getElementById('prestasiChart').getContext('2d');
                prestasiChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Prestasi Akademik', 'Prestasi Non-Akademik'],
                        datasets: [{
                            data: [data.akademik, data.non_akademik],
                            backgroundColor: [
                                'rgba(34, 197, 94, 0.8)',
                                'rgba(59, 130, 246, 0.8)'
                            ],
                            borderColor: [
                                'rgb(34, 197, 94)',
                                'rgb(59, 130, 246)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: getChartTitlePrestasi(periode, bulan, tahun)
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
                
                // Update summary
                document.getElementById('totalPrestasi').textContent = data.total;
                document.getElementById('prestasiAkademikCount').textContent = data.akademik;
                document.getElementById('prestasiNonAkademikCount').textContent = data.non_akademik;
                
                // Update total label
                document.getElementById('totalLabelPrestasi').textContent = getTotalLabelPrestasi(periode, bulan, tahun);
                
            } catch (error) {
                console.error('Error loading prestasi data:', error);
            }
        }
        
        function getChartTitlePrestasi(periode, bulan, tahun) {
            if (periode === 'bulan') {
                const bulanNama = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                return `Grafik Prestasi ${bulanNama[bulan]} ${tahun}`;
            } else if (periode === 'tahun') {
                return `Grafik Prestasi Tahun ${tahun}`;
            } else {
                return 'Grafik Prestasi Semua Data';
            }
        }
        
        function getTotalLabelPrestasi(periode, bulan, tahun) {
            if (periode === 'bulan') {
                const bulanNama = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                return `Total ${bulanNama[bulan]} ${tahun}`;
            } else if (periode === 'tahun') {
                return `Total Tahun ${tahun}`;
            } else {
                return 'Total';
            }
        }
        

        

        
        // Close prestasi modal when clicking outside
        document.getElementById('prestasiModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePrestasiModal();
            }
        });
        
        // Tidak Terverifikasi Modal Functions
        function openTidakTerverifikasiModal() {
            document.getElementById('statusModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            document.getElementById('statusModalTitle').textContent = 'Data Tidak Terverifikasi / Tertolak';
            loadTidakTerverifikasiData();
        }
        
        async function loadTidakTerverifikasiData() {
            const statusContent = document.getElementById('statusContent');
            statusContent.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                        <h4 class="font-semibold text-green-800 mb-3 flex items-center">
                            <i class="fas fa-trophy mr-2"></i>Prestasi Ditolak
                        </h4>
                        <div id="prestasiDitolak" class="space-y-2"></div>
                    </div>
                    <div class="bg-red-50 rounded-lg p-4 border border-red-200">
                        <h4 class="font-semibold text-red-800 mb-3 flex items-center">
                            <i class="fas fa-times-circle mr-2"></i>Pelanggaran Ditolak
                        </h4>
                        <div id="pelanggaranDitolak" class="space-y-2"></div>
                    </div>
                </div>
            `;
            
            try {
                const response = await fetch('/admin/get-tidak-terverifikasi');
                const data = await response.json();
                
                // Load prestasi ditolak
                const prestasiContainer = document.getElementById('prestasiDitolak');
                if (data.prestasi && data.prestasi.length > 0) {
                    data.prestasi.forEach(p => {
                        const div = document.createElement('div');
                        div.className = 'bg-white rounded p-3 border text-sm';
                        div.innerHTML = `
                            <div class="font-medium text-gray-800">${p.siswa.nama}</div>
                            <div class="text-green-600">${p.prestasi.nama}</div>
                            <div class="text-xs text-red-600 mt-1">Alasan: ${p.alasan_tolak || 'Tidak ada alasan'}</div>
                            <div class="text-xs text-gray-500 mt-1">${new Date(p.created_at).toLocaleDateString('id-ID')}</div>
                        `;
                        prestasiContainer.appendChild(div);
                    });
                } else {
                    prestasiContainer.innerHTML = '<div class="text-center text-gray-500 text-sm">Tidak ada data</div>';
                }
                
                // Load pelanggaran ditolak
                const pelanggaranContainer = document.getElementById('pelanggaranDitolak');
                if (data.pelanggaran && data.pelanggaran.length > 0) {
                    data.pelanggaran.forEach(p => {
                        const div = document.createElement('div');
                        div.className = 'bg-white rounded p-3 border text-sm';
                        div.innerHTML = `
                            <div class="font-medium text-gray-800">${p.siswa.nama}</div>
                            <div class="text-red-600">${p.jenis_pelanggaran.nama_pelanggaran}</div>
                            <div class="text-xs text-red-600 mt-1">Alasan: ${p.alasan_tolak || 'Tidak ada alasan'}</div>
                            <div class="text-xs text-gray-500 mt-1">${new Date(p.created_at).toLocaleDateString('id-ID')}</div>
                        `;
                        pelanggaranContainer.appendChild(div);
                    });
                } else {
                    pelanggaranContainer.innerHTML = '<div class="text-center text-gray-500 text-sm">Tidak ada data</div>';
                }
                
            } catch (error) {
                console.error('Error loading tidak terverifikasi data:', error);
                statusContent.innerHTML = '<div class="text-center text-red-500 text-sm">Error loading data</div>';
            }
        }
        
        // User Management Functions
        function toggleUserDropdown() {
            document.getElementById('userDropdown').classList.toggle('hidden');
        }
        
        function openUserModal() {
            document.getElementById('userModal').classList.remove('hidden');
            document.getElementById('userDropdown').classList.add('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        function closeUserModal() {
            document.getElementById('userModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        // Close user modal when clicking outside
        document.getElementById('userModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeUserModal();
            }
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('#userDropdown') && !e.target.closest('button[onclick="toggleUserDropdown()"]')) {
                document.getElementById('userDropdown').classList.add('hidden');
            }
        });
        

        
        // FAB Functions
        function toggleFAB() {
            const fabMenu = document.getElementById('fabMenu');
            const fabIcon = document.getElementById('fabIcon');
            
            fabMenu.classList.toggle('hidden');
            
            if (fabMenu.classList.contains('hidden')) {
                fabIcon.className = 'fas fa-plus text-xl';
            } else {
                fabIcon.className = 'fas fa-times text-xl';
            }
        }
        
        // Close FAB when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.fixed.bottom-6.right-6')) {
                document.getElementById('fabMenu').classList.add('hidden');
                document.getElementById('fabIcon').className = 'fas fa-plus text-xl';
            }
        });
        
        // Navbar dropdown functions
        function togglePelanggaranDropdown() {
            document.getElementById('pelanggaranDropdown').classList.toggle('hidden');
        }
        
        function togglePrestasiDropdown() {
            document.getElementById('prestasiDropdown').classList.toggle('hidden');
        }
        
        function toggleNavUserDropdown() {
            document.getElementById('navUserDropdown').classList.toggle('hidden');
        }
        
        function toggleMobileMenu() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        }
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('[onclick="togglePelanggaranDropdown()"]') && !e.target.closest('#pelanggaranDropdown')) {
                document.getElementById('pelanggaranDropdown').classList.add('hidden');
            }
            if (!e.target.closest('[onclick="togglePrestasiDropdown()"]') && !e.target.closest('#prestasiDropdown')) {
                document.getElementById('prestasiDropdown').classList.add('hidden');
            }
            if (!e.target.closest('[onclick="toggleNavUserDropdown()"]') && !e.target.closest('#navUserDropdown')) {
                document.getElementById('navUserDropdown').classList.add('hidden');
            }
        });
        
        // Prestasi Detail Modal Functions
        function openPrestasiDetailModal(siswaId) {
            document.getElementById('prestasiDetailModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            loadPrestasiDetailData(siswaId);
        }
        
        function closePrestasiDetailModal() {
            document.getElementById('prestasiDetailModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        async function loadPrestasiDetailData(siswaId) {
            try {
                // Get siswa data from the existing data in the page
                const siswaCards = document.querySelectorAll('[onclick*="openPrestasiDetailModal"]');
                let siswaData = null;
                
                // Find the clicked siswa data from the page
                @php
                    $siswaBerprestasiJson = App\Models\Siswa::where('poin_prestasi', '>', 0)->with(['prestasiSiswa' => function($q) {
                        $q->where('status', 'diverifikasi')->with('prestasi');
                    }])->get();
                @endphp
                
                const allSiswaData = @json($siswaBerprestasiJson);
                siswaData = allSiswaData.find(s => s.id == siswaId);
                
                if (siswaData) {
                    document.getElementById('prestasiDetailTitle').textContent = `Detail Prestasi - ${siswaData.nama}`;
                    document.getElementById('prestasiDetailSubtitle').textContent = `${siswaData.nis} - ${siswaData.kelas} - ${siswaData.jurusan}`;
                    
                    const content = document.getElementById('prestasiDetailContent');
                    content.innerHTML = `
                        <div class="bg-gradient-to-r from-amber-50 to-yellow-50 rounded-lg p-4 border border-amber-200 mb-4">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-800">${siswaData.nama}</h4>
                                    <p class="text-sm text-gray-600">${siswaData.nis} - ${siswaData.kelas} - ${siswaData.jurusan}</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-bold text-green-600">${siswaData.poin_prestasi}</div>
                                    <div class="text-sm text-gray-500">Total Poin</div>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <h5 class="text-lg font-semibold text-gray-800 mb-3">Riwayat Prestasi:</h5>
                            ${siswaData.prestasi_siswa && siswaData.prestasi_siswa.length > 0 ? 
                                siswaData.prestasi_siswa.map(prestasi => `
                                    <div class="bg-white rounded-lg p-4 border border-gray-200 shadow-sm">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <h6 class="font-medium text-gray-800 mb-1">${prestasi.prestasi.nama}</h6>
                                                <div class="text-sm text-gray-600 mb-2">
                                                    <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs mr-2">
                                                        ${prestasi.prestasi.kategori}
                                                    </span>
                                                    <span class="inline-block bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs">
                                                        ${prestasi.prestasi.tingkat}
                                                    </span>
                                                </div>
                                                <p class="text-sm text-gray-500">${prestasi.prestasi.deskripsi || 'Tidak ada deskripsi'}</p>
                                            </div>
                                            <div class="text-right ml-4">
                                                <div class="text-lg font-semibold text-green-600">+${prestasi.prestasi.poin_pengurangan}</div>
                                                <div class="text-xs text-gray-400">${new Date(prestasi.created_at).toLocaleDateString('id-ID')}</div>
                                                <div class="text-xs text-green-600 mt-1">
                                                    <i class="fas fa-check-circle mr-1"></i>Diverifikasi
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `).join('') : 
                                '<div class="text-center py-8 text-gray-500">Belum ada riwayat prestasi</div>'
                            }
                        </div>
                    `;
                } else {
                    document.getElementById('prestasiDetailContent').innerHTML = '<div class="text-center py-8 text-red-500">Data siswa tidak ditemukan</div>';
                }
            } catch (error) {
                console.error('Error loading prestasi detail:', error);
                document.getElementById('prestasiDetailContent').innerHTML = '<div class="text-center py-8 text-red-500">Error loading data</div>';
            }
        }
        
        // Close prestasi detail modal when clicking outside
        document.getElementById('prestasiDetailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePrestasiDetailModal();
            }
        });
    </script>

</body>
</html>