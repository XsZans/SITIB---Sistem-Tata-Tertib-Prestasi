<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kesiswaan - SiTib</title>
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

    @include('layouts.kesiswaan-navbar', ['title' => 'SiTib Kesiswaan Panel', 'subtitle' => 'Dashboard Kesiswaan'])

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
                <div class="inline-block bg-gradient-to-r from-orange-500 to-red-600 text-white px-4 md:px-6 py-1.5 md:py-2 rounded-full text-xs md:text-sm font-semibold mb-3 md:mb-4 shadow-lg">
                    KESISWAAN PANEL
                </div>
                <h2 class="text-2xl md:text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-3 md:mb-4">
                    Dashboard Kesiswaan SiTib
                </h2>
                <p class="text-gray-600 max-w-3xl mx-auto text-sm md:text-lg leading-relaxed px-2">
                    Kelola sistem tata tertib sekolah dengan akses penuh sebagai kesiswaan
                </p>
                <div class="flex items-center justify-center gap-2 mt-4 md:mt-6">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-green-600 text-sm font-medium">System Online</span>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8" data-aos="fade-up" data-aos-delay="300">
                <!-- Pelanggaran Chart -->
                <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100 cursor-pointer hover:shadow-2xl transition-shadow" onclick="window.location.href='{{ route('kesiswaan.pelanggaran') }}#grafik'">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Grafik Pelanggaran</h3>
                            <p class="text-gray-600 text-sm">Statistik pelanggaran bulan ini</p>
                        </div>
                        <a href="{{ route('kesiswaan.pelanggaran') }}#grafik" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-xs transition-colors">
                            <i class="fas fa-chart-bar mr-1"></i>Lihat Detail
                        </a>
                    </div>
                    <div class="flex justify-center mb-4 pointer-events-none">
                        <div style="width: 280px; height: 280px;">
                            <canvas id="dashboardPelanggaranChart"></canvas>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3 text-center pointer-events-none">
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
                <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100 cursor-pointer hover:shadow-2xl transition-shadow" onclick="window.location.href='{{ route('kesiswaan.prestasi') }}#grafik'">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Grafik Prestasi</h3>
                            <p class="text-gray-600 text-sm">Statistik prestasi bulan ini</p>
                        </div>
                        <a href="{{ route('kesiswaan.prestasi') }}#grafik" class="bg-amber-600 hover:bg-amber-700 text-white px-3 py-2 rounded-lg text-xs transition-colors">
                            <i class="fas fa-chart-bar mr-1"></i>Lihat Detail
                        </a>
                    </div>
                    <div class="flex justify-center mb-4 pointer-events-none">
                        <div style="width: 280px; height: 280px;">
                            <canvas id="dashboardPrestasiChart"></canvas>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 text-center pointer-events-none">
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
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8 md:mb-16" data-aos="fade-up" data-aos-delay="400">
                
                <button onclick="openDalamProsesModal()" class="bg-gradient-to-br from-yellow-50 to-yellow-100 border border-yellow-200 rounded-xl md:rounded-2xl p-4 md:p-6 hover-lift text-center flex flex-col justify-center h-full w-full cursor-pointer transition-all">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-clock text-white text-lg md:text-2xl"></i>
                    </div>
                    <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Dalam Proses</p>
                    @php
                        $prestasiCount = App\Models\PrestasiSiswa::where('status', 'menunggu_verifikasi')->count();
                        $pelanggaranCount = App\Models\Pelanggaran::whereIn('status', ['menunggu_verifikasi', 'pending', 'dalam_sanksi'])->count() + App\Models\PelaksanaanSanksi::where('status', 'dalam_proses')->count();
                    @endphp
                    <p class="text-xl md:text-2xl font-bold text-yellow-700">{{ $prestasiCount + $pelanggaranCount }}</p>
                </button>
                
                <a href="{{ route('kesiswaan.verifikasi-laporan-request') }}" class="bg-gradient-to-br from-indigo-50 to-indigo-100 border border-indigo-200 rounded-xl md:rounded-2xl p-4 md:p-6 hover-lift text-center flex flex-col justify-center h-full cursor-pointer transition-all">
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
                
                <button onclick="openSelesaiModal()" class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl md:rounded-2xl p-4 md:p-6 hover-lift text-center flex flex-col justify-center h-full w-full cursor-pointer transition-all">
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
                    <p class="text-xl md:text-2xl font-bold text-green-700">{{ $prestasiSelesai + $pelanggaranSelesai }}</p>
                </button>
                
                <button onclick="openTidakTerverifikasiModal()" class="bg-gradient-to-br from-gray-50 to-gray-100 border border-gray-200 rounded-xl md:rounded-2xl p-4 md:p-6 hover-lift text-center flex flex-col justify-center h-full w-full cursor-pointer transition-all">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-gray-500 to-gray-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-times-circle text-white text-lg md:text-2xl"></i>
                    </div>
                    <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Tidak Terverifikasi</p>
                    @php
                        $pelanggaranDitolak = App\Models\Pelanggaran::where('status', 'ditolak')->count();
                        $prestasiDitolak = App\Models\PrestasiSiswa::where('status', 'ditolak')->count();
                    @endphp
                    <p class="text-xl md:text-2xl font-bold text-gray-700">{{ $prestasiDitolak + $pelanggaranDitolak }}</p>
                </button>
            </div>

            <!-- Menu Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8 md:mb-16" data-aos="fade-up" data-aos-delay="500">
                
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
                    <a href="{{ route('kesiswaan.siswa') }}" class="inline-block bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 whitespace-nowrap">
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
                    <a href="{{ route('kesiswaan.pelanggaran') }}" class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 whitespace-nowrap">
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
                    <a href="{{ route('kesiswaan.guru') }}" class="inline-block bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 whitespace-nowrap">
                        <i class="fas fa-arrow-right mr-2"></i>Kelola
                    </a>
                </div>

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
                    <a href="{{ route('kesiswaan.prestasi') }}" class="inline-block bg-gradient-to-r from-yellow-600 to-yellow-700 hover:from-yellow-700 hover:to-yellow-800 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 whitespace-nowrap">
                        <i class="fas fa-arrow-right mr-2"></i>Kelola
                    </a>
                </div>
            </div>

        </main>
    </div>

    <!-- Copy all modals from admin -->
    <!-- Modal Grafik Pelanggaran -->
    <div id="grafikModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-6xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Grafik Pelanggaran</h3>
                        <p class="text-gray-600">Statistik pelanggaran per bulan dan tahun</p>
                    </div>
                    <button onclick="closeGrafikModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
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
                <div class="bg-gray-50 rounded-lg p-4 mb-6 flex justify-center">
                    <div style="width: 300px; height: 300px;">
                        <canvas id="pelanggaranChart"></canvas>
                    </div>
                </div>
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

    <!-- Modal Status -->
    <div id="statusModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-6xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 id="statusModalTitle" class="text-2xl font-bold text-gray-800">Detail Status</h3>
                        <p class="text-gray-600">Daftar data berdasarkan status</p>
                    </div>
                    <button onclick="closeStatusModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div id="statusContent" class="space-y-4"></div>
            </div>
        </div>
    </div>

    <!-- Modal Prestasi -->
    <div id="prestasiModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-6xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Siswa Berprestasi</h3>
                        <p class="text-gray-600">Daftar siswa yang memiliki poin prestasi</p>
                    </div>
                    <button onclick="closePrestasiModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div id="prestasiContent" class="space-y-4">
                    @php
                        $siswaBerprestasi = App\Models\Siswa::where('poin_prestasi', '>', 0)->get();
                    @endphp
                    @forelse($siswaBerprestasi as $siswa)
                        <div class="bg-gradient-to-r from-amber-50 to-yellow-50 rounded-lg p-4 border border-amber-200">
                            <div class="flex justify-between items-start mb-2">
                                <h5 class="font-semibold text-gray-800">{{ $siswa->nama }}</h5>
                                <div class="flex gap-2">
                                    <span class="px-2 py-1 text-xs rounded-full bg-amber-100 text-amber-800">
                                        {{ $siswa->nis }}
                                    </span>
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                        {{ $siswa->poin_prestasi }} Poin Prestasi
                                    </span>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 mb-1">{{ $siswa->kelas }} - {{ $siswa->jurusan }}</p>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-trophy text-amber-500"></i>
                                <span class="text-sm text-amber-700 font-medium">Siswa Berprestasi</span>
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
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });
        
        // Typing effect
        const text = "Halo Selamat Datang {{ Auth::user()->name ?? 'Kesiswaan' }}";
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
        
        // Modal functions
        let pelanggaranChart;
        function openGrafikModal() { document.getElementById('grafikModal').classList.remove('hidden'); document.body.style.overflow = 'hidden'; toggleFilterInputsModal(); loadGrafikData(); }
        function closeGrafikModal() { document.getElementById('grafikModal').classList.add('hidden'); document.body.style.overflow = 'auto'; }
        function updateGrafikModal() { loadGrafikData(); }
        function toggleFilterInputsModal() { const periode = document.getElementById('periodeFilterModal').value; const bulanFilter = document.getElementById('bulanFilterModal'); const tahunFilter = document.getElementById('tahunFilterModal'); if (periode === 'bulan') { bulanFilter.style.display = 'block'; tahunFilter.style.display = 'block'; } else if (periode === 'tahun') { bulanFilter.style.display = 'none'; tahunFilter.style.display = 'block'; } else { bulanFilter.style.display = 'none'; tahunFilter.style.display = 'none'; } }
        function getChartTitleModal(periode, bulan, tahun) { if (periode === 'bulan') { const bulanNama = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']; return `Kategori Pelanggaran ${bulanNama[bulan]} ${tahun}`; } else if (periode === 'tahun') { return `Kategori Pelanggaran Tahun ${tahun}`; } else { return 'Kategori Pelanggaran Semua Data'; } }
        function getTotalLabelModal(periode, bulan, tahun) { if (periode === 'bulan') { const bulanNama = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']; return `Total ${bulanNama[bulan]} ${tahun}`; } else if (periode === 'tahun') { return `Total Tahun ${tahun}`; } else { return 'Total'; } }
        async function loadGrafikData() { const periode = document.getElementById('periodeFilterModal').value; const bulan = document.getElementById('bulanFilterModal').value; const tahun = document.getElementById('tahunFilterModal').value; let url = '/admin/grafik-pelanggaran?'; if (periode === 'bulan') { url += `bulan=${bulan}&tahun=${tahun}`; } else if (periode === 'tahun') { url += `tahun=${tahun}`; } try { const response = await fetch(url); const data = await response.json(); if (pelanggaranChart) { pelanggaranChart.destroy(); } const ctx = document.getElementById('pelanggaranChart').getContext('2d'); pelanggaranChart = new Chart(ctx, { type: 'pie', data: { labels: ['Pelanggaran Ringan (1-5 Poin)', 'Pelanggaran Sedang (6-15 Poin)', 'Pelanggaran Berat (16+ Poin)'], datasets: [{ data: [data.ringan, data.sedang, data.berat], backgroundColor: ['rgba(234, 179, 8, 0.8)', 'rgba(251, 146, 60, 0.8)', 'rgba(239, 68, 68, 0.8)'], borderColor: ['rgb(234, 179, 8)', 'rgb(251, 146, 60)', 'rgb(239, 68, 68)'], borderWidth: 2 }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { title: { display: true, text: getChartTitleModal(periode, bulan, tahun) }, legend: { position: 'bottom' } } } }); document.getElementById('totalTahun').textContent = data.total; document.getElementById('pelanggaranRingan').textContent = data.ringan; document.getElementById('pelanggaranSedang').textContent = data.sedang; document.getElementById('pelanggaranBerat').textContent = data.berat; document.getElementById('totalLabelModal').textContent = getTotalLabelModal(periode, bulan, tahun); } catch (error) { console.error('Error loading grafik data:', error); } }
        function openSelesaiModal() { document.getElementById('statusModal').classList.remove('hidden'); document.body.style.overflow = 'hidden'; document.getElementById('statusModalTitle').textContent = 'Data Selesai'; loadSelesaiData(); }
        function openDalamProsesModal() { document.getElementById('statusModal').classList.remove('hidden'); document.body.style.overflow = 'hidden'; document.getElementById('statusModalTitle').textContent = 'Kasus Dalam Proses'; loadDalamProsesData(); }
        function openPrestasiModal() { document.getElementById('prestasiModal').classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
        function closePrestasiModal() { document.getElementById('prestasiModal').classList.add('hidden'); document.body.style.overflow = 'auto'; }
        function openTidakTerverifikasiModal() { document.getElementById('statusModal').classList.remove('hidden'); document.body.style.overflow = 'hidden'; document.getElementById('statusModalTitle').textContent = 'Data Tidak Terverifikasi / Tertolak'; loadTidakTerverifikasiData(); }
        function closeStatusModal() { document.getElementById('statusModal').classList.add('hidden'); document.body.style.overflow = 'auto'; }
        async function loadSelesaiData() { const statusContent = document.getElementById('statusContent'); statusContent.innerHTML = `<div class="grid grid-cols-1 md:grid-cols-2 gap-6"><div class="bg-green-50 rounded-lg p-4 border border-green-200"><h4 class="font-semibold text-green-800 mb-3 flex items-center"><i class="fas fa-trophy mr-2"></i>Prestasi Selesai</h4><div id="prestasiSelesai" class="space-y-2"></div></div><div class="bg-red-50 rounded-lg p-4 border border-red-200"><h4 class="font-semibold text-red-800 mb-3 flex items-center"><i class="fas fa-check-circle mr-2"></i>Pelanggaran Selesai</h4><div id="pelanggaranSelesai" class="space-y-2"></div></div></div>`; try { const prestasiResponse = await fetch('/admin/get-prestasi-selesai'); const prestasiData = await prestasiResponse.json(); const prestasiContainer = document.getElementById('prestasiSelesai'); if (prestasiData.prestasi && prestasiData.prestasi.length > 0) { prestasiData.prestasi.forEach(p => { const div = document.createElement('div'); div.className = 'bg-white rounded p-3 border text-sm'; div.innerHTML = `<div class="font-medium text-gray-800">${p.siswa.nama}</div><div class="text-green-600">${p.prestasi.nama}</div><div class="text-xs text-gray-500 mt-1">${new Date(p.created_at).toLocaleDateString('id-ID')}</div>`; prestasiContainer.appendChild(div); }); } else { prestasiContainer.innerHTML = '<div class="text-center text-gray-500 text-sm">Tidak ada data</div>'; } const pelanggaranResponse = await fetch(`/admin/detail-pelanggaran?status=selesai`); const pelanggaranData = await pelanggaranResponse.json(); const pelanggaranContainer = document.getElementById('pelanggaranSelesai'); if (pelanggaranData.pelanggaran && pelanggaranData.pelanggaran.length > 0) { const filteredPelanggaran = pelanggaranData.pelanggaran.filter(p => p.status === 'selesai'); if (filteredPelanggaran.length > 0) { filteredPelanggaran.forEach(p => { const div = document.createElement('div'); div.className = 'bg-white rounded p-3 border text-sm'; div.innerHTML = `<div class="font-medium text-gray-800">${p.siswa_nama}</div><div class="text-red-600">${p.jenis_pelanggaran}</div><div class="text-xs text-gray-500 mt-1">${new Date(p.created_at).toLocaleDateString('id-ID')}</div>`; pelanggaranContainer.appendChild(div); }); } else { pelanggaranContainer.innerHTML = '<div class="text-center text-gray-500 text-sm">Tidak ada data</div>'; } } else { pelanggaranContainer.innerHTML = '<div class="text-center text-gray-500 text-sm">Tidak ada data</div>'; } } catch (error) { statusContent.innerHTML = '<div class="text-center text-red-500 text-sm">Error loading data</div>'; } }
        async function loadDalamProsesData() { const statusContent = document.getElementById('statusContent'); statusContent.innerHTML = `<div class="grid grid-cols-1 gap-6"><div class="bg-green-50 rounded-lg p-4 border border-green-200"><h4 class="font-semibold text-green-800 mb-3 flex items-center"><i class="fas fa-trophy mr-2"></i>Prestasi - Menunggu Verifikasi</h4><div id="prestasiMenunggu" class="space-y-2"></div></div><div class="bg-red-50 rounded-lg p-4 border border-red-200"><h4 class="font-semibold text-red-800 mb-3 flex items-center"><i class="fas fa-exclamation-triangle mr-2"></i>Pelanggaran - Proses Lengkap</h4><div class="grid grid-cols-1 md:grid-cols-3 gap-4"><div class="bg-orange-50 rounded-lg p-3 border border-orange-200"><h5 class="font-medium text-orange-800 mb-2 text-sm flex items-center"><i class="fas fa-hourglass-half mr-1"></i>Menunggu Verifikasi</h5><div id="pelanggaranMenunggu" class="space-y-2"></div></div><div class="bg-yellow-50 rounded-lg p-3 border border-yellow-200"><h5 class="font-medium text-yellow-800 mb-2 text-sm flex items-center"><i class="fas fa-gavel mr-1"></i>Sudah Diverifikasi</h5><div id="pelanggaranDiverifikasi" class="space-y-2"></div></div><div class="bg-purple-50 rounded-lg p-3 border border-purple-200"><h5 class="font-medium text-purple-800 mb-2 text-sm flex items-center"><i class="fas fa-tasks mr-1"></i>Sedang Pelaksanaan</h5><div id="pelanggaranPelaksanaan" class="space-y-2"></div></div></div></div></div>`; await loadPrestasiMenungguData(); await Promise.all([loadPelanggaranMenungguData(), loadSectionData('pending', 'pelanggaranDiverifikasi'), loadPelaksanaanData('pelanggaranPelaksanaan')]); }
        async function loadPrestasiMenungguData() { const container = document.getElementById('prestasiMenunggu'); try { const response = await fetch('/admin/get-prestasi-verifikasi'); const data = await response.json(); if (data.prestasi && data.prestasi.length > 0) { data.prestasi.forEach(p => { const div = document.createElement('div'); div.className = 'bg-white rounded p-3 border text-sm'; div.innerHTML = `<div class="font-medium text-gray-800">${p.siswa.nama}</div><div class="text-green-600">${p.prestasi.nama}</div><div class="text-xs text-gray-500 mt-1">${new Date(p.created_at).toLocaleDateString('id-ID')}</div>`; container.appendChild(div); }); } else { container.innerHTML = '<div class="text-center text-gray-500 text-sm">Tidak ada data</div>'; } } catch (error) { container.innerHTML = '<div class="text-center text-red-500 text-sm">Error loading data</div>'; } }
        async function loadPelanggaranMenungguData() { const container = document.getElementById('pelanggaranMenunggu'); try { const response = await fetch(`/admin/detail-pelanggaran?status=menunggu_verifikasi`); const data = await response.json(); if (data.pelanggaran && data.pelanggaran.length > 0) { const filtered = data.pelanggaran.filter(p => p.status === 'menunggu_verifikasi'); if (filtered.length > 0) { filtered.forEach(p => { const div = document.createElement('div'); div.className = 'bg-white rounded p-2 border text-xs'; div.innerHTML = `<div class="font-medium text-gray-800">${p.siswa_nama}</div><div class="text-red-600">${p.jenis_pelanggaran}</div><div class="text-gray-500 mt-1">${new Date(p.created_at).toLocaleDateString('id-ID')}</div>`; container.appendChild(div); }); } else { container.innerHTML = '<div class="text-center text-gray-500 text-xs">Tidak ada data</div>'; } } else { container.innerHTML = '<div class="text-center text-gray-500 text-xs">Tidak ada data</div>'; } } catch (error) { container.innerHTML = '<div class="text-center text-red-500 text-xs">Error loading data</div>'; } }
        async function loadSectionData(status, containerId) { try { const response = await fetch(`/admin/detail-pelanggaran?status=${status}`); const data = await response.json(); const container = document.getElementById(containerId); if (data.pelanggaran && data.pelanggaran.length > 0) { const filteredData = data.pelanggaran.filter(p => p.status === status); if (filteredData.length > 0) { filteredData.forEach(p => { const div = document.createElement('div'); div.className = 'bg-white rounded p-3 border text-sm'; div.innerHTML = `<div class="font-medium text-gray-800">${p.siswa_nama}</div><div class="text-gray-600 text-xs">${p.jenis_pelanggaran}</div><div class="text-xs text-gray-500 mt-1">${new Date(p.created_at).toLocaleDateString('id-ID')}</div>`; container.appendChild(div); }); } else { container.innerHTML = '<div class="text-center text-gray-500 text-sm">Tidak ada data</div>'; } } else { container.innerHTML = '<div class="text-center text-gray-500 text-sm">Tidak ada data</div>'; } } catch (error) { document.getElementById(containerId).innerHTML = '<div class="text-center text-red-500 text-sm">Error loading data</div>'; } }
        async function loadPelaksanaanData(containerId) { try { const response = await fetch('/admin/get-pelaksanaan-sanksi-data'); const data = await response.json(); const container = document.getElementById(containerId); if (data.pelaksanaan_sanksi && data.pelaksanaan_sanksi.length > 0) { data.pelaksanaan_sanksi.forEach(p => { const div = document.createElement('div'); div.className = 'bg-white rounded p-3 border text-sm'; div.innerHTML = `<div class="font-medium text-gray-800">${p.siswa.nama}</div><div class="text-gray-600 text-xs">${p.jenis_sanksi}</div><div class="text-xs text-gray-500 mt-1">${new Date(p.created_at).toLocaleDateString('id-ID')}</div>`; container.appendChild(div); }); } else { container.innerHTML = '<div class="text-center text-gray-500 text-sm">Tidak ada data</div>'; } } catch (error) { document.getElementById(containerId).innerHTML = '<div class="text-center text-red-500 text-sm">Error loading data</div>'; } }
        async function loadTidakTerverifikasiData() { const statusContent = document.getElementById('statusContent'); statusContent.innerHTML = `<div class="grid grid-cols-1 md:grid-cols-2 gap-6"><div class="bg-green-50 rounded-lg p-4 border border-green-200"><h4 class="font-semibold text-green-800 mb-3 flex items-center"><i class="fas fa-trophy mr-2"></i>Prestasi Ditolak</h4><div id="prestasiDitolak" class="space-y-2"></div></div><div class="bg-red-50 rounded-lg p-4 border border-red-200"><h4 class="font-semibold text-red-800 mb-3 flex items-center"><i class="fas fa-times-circle mr-2"></i>Pelanggaran Ditolak</h4><div id="pelanggaranDitolak" class="space-y-2"></div></div></div>`; try { const response = await fetch('/admin/get-tidak-terverifikasi'); const data = await response.json(); const prestasiContainer = document.getElementById('prestasiDitolak'); if (data.prestasi && data.prestasi.length > 0) { data.prestasi.forEach(p => { const div = document.createElement('div'); div.className = 'bg-white rounded p-3 border text-sm'; div.innerHTML = `<div class="font-medium text-gray-800">${p.siswa.nama}</div><div class="text-green-600">${p.prestasi.nama}</div><div class="text-xs text-red-600 mt-1">Alasan: ${p.alasan_tolak || 'Tidak ada alasan'}</div><div class="text-xs text-gray-500 mt-1">${new Date(p.created_at).toLocaleDateString('id-ID')}</div>`; prestasiContainer.appendChild(div); }); } else { prestasiContainer.innerHTML = '<div class="text-center text-gray-500 text-sm">Tidak ada data</div>'; } const pelanggaranContainer = document.getElementById('pelanggaranDitolak'); if (data.pelanggaran && data.pelanggaran.length > 0) { data.pelanggaran.forEach(p => { const div = document.createElement('div'); div.className = 'bg-white rounded p-3 border text-sm'; div.innerHTML = `<div class="font-medium text-gray-800">${p.siswa.nama}</div><div class="text-red-600">${p.jenis_pelanggaran.nama_pelanggaran}</div><div class="text-xs text-red-600 mt-1">Alasan: ${p.alasan_tolak || 'Tidak ada alasan'}</div><div class="text-xs text-gray-500 mt-1">${new Date(p.created_at).toLocaleDateString('id-ID')}</div>`; pelanggaranContainer.appendChild(div); }); } else { pelanggaranContainer.innerHTML = '<div class="text-center text-gray-500 text-sm">Tidak ada data</div>'; } } catch (error) { statusContent.innerHTML = '<div class="text-center text-red-500 text-sm">Error loading data</div>'; } }
        document.getElementById('grafikModal')?.addEventListener('click', function(e) { if (e.target === this) closeGrafikModal(); });
        document.getElementById('statusModal')?.addEventListener('click', function(e) { if (e.target === this) closeStatusModal(); });
        document.getElementById('prestasiModal')?.addEventListener('click', function(e) { if (e.target === this) closePrestasiModal(); });

    </script>

</body>
</html>