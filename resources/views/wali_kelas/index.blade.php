<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Wali Kelas - {{ $guru->wali_kelas }}</title>
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

    @include('layouts.wali-kelas-navbar', ['title' => 'Sistem Tata Tertib & Prestasi', 'subtitle' => 'Dashboard Wali Kelas'])

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
                <div class="inline-block bg-gradient-to-r from-purple-500 to-indigo-600 text-white px-4 md:px-6 py-1.5 md:py-2 rounded-full text-xs md:text-sm font-semibold mb-3 md:mb-4 shadow-lg">
                    WALI KELAS PANEL
                </div>
                <h2 class="text-2xl md:text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-3 md:mb-4">
                    Dashboard Wali Kelas {{ $guru->wali_kelas }}
                </h2>
                <p class="text-gray-600 max-w-3xl mx-auto text-sm md:text-lg leading-relaxed px-2">
                    Kelola dan pantau siswa kelas {{ $guru->wali_kelas }} dengan mudah
                </p>
                <div class="flex items-center justify-center gap-2 mt-4 md:mt-6">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-green-600 text-sm font-medium">System Online</span>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-8 md:mb-16" data-aos="fade-up" data-aos-delay="400">
                
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl md:rounded-2xl p-4 md:p-6 hover-lift text-center">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-users text-white text-lg md:text-2xl"></i>
                    </div>
                    <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Total Siswa</p>
                    <p class="text-xl md:text-2xl font-bold text-blue-700">{{ $totalSiswa }}</p>
                </div>
                
                <div class="bg-gradient-to-br from-red-50 to-red-100 border border-red-200 rounded-xl md:rounded-2xl p-4 md:p-6 hover-lift text-center">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-exclamation-triangle text-white text-lg md:text-2xl"></i>
                    </div>
                    <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Total Pelanggaran</p>
                    <p class="text-xl md:text-2xl font-bold text-red-700">{{ $totalPelanggaran }}</p>
                </div>
                
                <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl md:rounded-2xl p-4 md:p-6 hover-lift text-center">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-trophy text-white text-lg md:text-2xl"></i>
                    </div>
                    <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Total Prestasi</p>
                    <p class="text-xl md:text-2xl font-bold text-green-700">{{ $totalPrestasi }}</p>
                </div>
            </div>

            <!-- Menu Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-8 md:mb-16" data-aos="fade-up" data-aos-delay="500">
                
                <!-- Kelola Siswa -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl md:rounded-2xl p-6 md:p-8 hover-lift text-center flex flex-col justify-between h-full">
                    <div>
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-4 md:mb-6 shadow-lg">
                            <i class="fas fa-users text-white text-2xl md:text-3xl"></i>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Kelola Siswa</h3>
                        <p class="text-gray-600 text-sm md:text-base leading-relaxed mb-4 md:mb-6">
                            Lihat dan kelola data siswa kelas {{ $guru->wali_kelas }}
                        </p>
                    </div>
                    <a href="{{ route('wali_kelas.siswa') }}" class="inline-block bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 whitespace-nowrap">
                        <i class="fas fa-arrow-right mr-2"></i>Kelola
                    </a>
                </div>

                <!-- Export Laporan -->
                <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl md:rounded-2xl p-6 md:p-8 hover-lift text-center flex flex-col justify-between h-full">
                    <div>
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-4 md:mb-6 shadow-lg">
                            <i class="fas fa-file-pdf text-white text-2xl md:text-3xl"></i>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Export Laporan</h3>
                        <p class="text-gray-600 text-sm md:text-base leading-relaxed mb-4 md:mb-6">
                            Unduh laporan kelas dalam format PDF
                        </p>
                    </div>
                    <div class="relative">
                        <button onclick="toggleExportDropdown()" class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 whitespace-nowrap">
                            <i class="fas fa-arrow-right mr-2"></i>Export
                        </button>
                        <div id="exportDropdown" class="hidden absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-200 z-50">
                            <button onclick="openExportModal()" class="w-full px-4 py-3 text-left hover:bg-gray-50 rounded-t-lg transition-colors">
                                <i class="fas fa-user mr-2 text-green-600"></i>Laporan Siswa
                            </button>
                            <button onclick="openExportKelasModal()" class="w-full px-4 py-3 text-left hover:bg-gray-50 transition-colors">
                                <i class="fas fa-users mr-2 text-green-600"></i>Laporan Kelas
                            </button>
                            <a href="{{ route('wali_kelas.laporan-tersimpan') }}" class="w-full px-4 py-3 text-left hover:bg-gray-50 rounded-b-lg transition-colors block">
                                <i class="fas fa-folder mr-2 text-green-600"></i>Laporan Tersimpan
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Profile -->
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 rounded-xl md:rounded-2xl p-6 md:p-8 hover-lift text-center flex flex-col justify-between h-full">
                    <div>
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-4 md:mb-6 shadow-lg">
                            <i class="fas fa-user text-white text-2xl md:text-3xl"></i>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Profile</h3>
                        <p class="text-gray-600 text-sm md:text-base leading-relaxed mb-4 md:mb-6">
                            Lihat dan edit informasi profile Anda
                        </p>
                    </div>
                    <a href="{{ route('wali_kelas.profile') }}" class="inline-block bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 whitespace-nowrap">
                        <i class="fas fa-arrow-right mr-2"></i>Profile
                    </a>
                </div>
            </div>

            <!-- Siswa List -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100" data-aos="fade-up" data-aos-delay="600">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Siswa Kelas {{ $guru->wali_kelas }}</h3>
                        <p class="text-gray-600 text-sm">Daftar siswa dan poin mereka</p>
                    </div>
                    @if($siswaKelas->count() > 0)
                    <a href="{{ route('wali_kelas.siswa') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-xs transition-colors">
                        <i class="fas fa-users mr-1"></i>Lihat Semua
                    </a>
                    @endif
                </div>
                
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poin</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($siswaKelas->take(5) as $siswa)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ $siswa->nis }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                    {{ $siswa->nama }}
                                    @if($siswa->jumlah_pelanggaran > 0)
                                        <span class="ml-1 text-red-600 font-bold">({{ $siswa->jumlah_pelanggaran }})</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $siswa->jurusan }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="flex gap-1">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            {{ $siswa->poin_pelanggaran }}
                                        </span>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $siswa->poin_prestasi ?? 0 }}
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-users text-4xl text-gray-300 mb-2"></i>
                                        <span>Tidak ada siswa di kelas ini</span>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($siswaKelas->count() > 5)
                <div class="mt-4 text-center text-sm text-gray-500">
                    Menampilkan 5 dari {{ $siswaKelas->count() }} siswa
                </div>
                @endif
            </div>

        </main>
    </div>

    <!-- Export Modal -->
    <div id="exportModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Export Laporan Siswa</h3>
                    <p class="text-gray-600 text-sm">Unduh laporan siswa dalam format PDF</p>
                </div>
                <button onclick="closeExportModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form action="{{ route('wali_kelas.export-laporan') }}" method="GET">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Filter Siswa</label>
                        <select name="siswa_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="">Semua Siswa Kelas</option>
                            @foreach($siswaKelas as $siswa)
                            <option value="{{ $siswa->id }}">{{ $siswa->nama }} - {{ $siswa->nis }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                        <select name="periode" id="periode" onchange="togglePeriodeInputs()" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="semua">Semua Data</option>
                            <option value="bulan">Per Bulan</option>
                            <option value="tahun">Per Tahun</option>
                        </select>
                    </div>
                    
                    <div id="bulanInput" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bulan</label>
                        <select name="bulan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $i == now()->month ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                            @endfor
                        </select>
                    </div>
                    
                    <div id="tahunInput" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                        <select name="tahun" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            @for($i = now()->year; $i >= now()->year - 5; $i--)
                            <option value="{{ $i }}" {{ $i == now()->year ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                
                <div class="flex gap-3 mt-6">
                    <button type="button" onclick="closeExportModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white rounded-lg transition-all duration-300 shadow-lg">
                        <i class="fas fa-download mr-2"></i>Export PDF
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Export Kelas Modal -->
    <div id="exportKelasModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Export Laporan Kelas</h3>
                    <p class="text-gray-600 text-sm">Unduh laporan seluruh kelas dalam format PDF</p>
                </div>
                <button onclick="closeExportKelasModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form action="{{ route('wali_kelas.export-laporan-kelas') }}" method="GET">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                        <select name="periode" id="periodeKelas" onchange="togglePeriodeInputsKelas()" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="semua">Semua Data</option>
                            <option value="bulan">Per Bulan</option>
                            <option value="tahun">Per Tahun</option>
                        </select>
                    </div>
                    
                    <div id="bulanInputKelas" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bulan</label>
                        <select name="bulan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $i == now()->month ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                            @endfor
                        </select>
                    </div>
                    
                    <div id="tahunInputKelas" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                        <select name="tahun" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            @for($i = now()->year; $i >= now()->year - 5; $i--)
                            <option value="{{ $i }}" {{ $i == now()->year ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                
                <div class="flex gap-3 mt-6">
                    <button type="button" onclick="closeExportKelasModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white rounded-lg transition-all duration-300 shadow-lg">
                        <i class="fas fa-download mr-2"></i>Export PDF
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Floating Action Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <div class="relative">
            <button onclick="toggleFAB()" class="w-14 h-14 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center transform hover:scale-110">
                <i id="fabIcon" class="fas fa-plus text-xl"></i>
            </button>
            
            <!-- FAB Menu -->
            <div id="fabMenu" class="hidden absolute bottom-16 right-0 bg-white rounded-lg shadow-xl border border-gray-200 p-2 min-w-48">
                <a href="{{ route('wali_kelas.siswa') }}" class="flex items-center gap-3 px-3 py-2 hover:bg-gray-50 rounded-lg transition-colors text-sm">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-blue-600 text-sm"></i>
                    </div>
                    <span class="text-gray-700">Kelola Siswa</span>
                </a>
                <button onclick="openExportModal()" class="w-full flex items-center gap-3 px-3 py-2 hover:bg-gray-50 rounded-lg transition-colors text-sm text-left">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-file-pdf text-green-600 text-sm"></i>
                    </div>
                    <span class="text-gray-700">Export Laporan</span>
                </button>
                <a href="{{ route('wali_kelas.laporan-tersimpan') }}" class="flex items-center gap-3 px-3 py-2 hover:bg-gray-50 rounded-lg transition-colors text-sm">
                    <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-folder text-orange-600 text-sm"></i>
                    </div>
                    <span class="text-gray-700">Laporan Tersimpan</span>
                </a>
                <a href="{{ route('wali_kelas.profile') }}" class="flex items-center gap-3 px-3 py-2 hover:bg-gray-50 rounded-lg transition-colors text-sm">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user text-purple-600 text-sm"></i>
                    </div>
                    <span class="text-gray-700">Profile</span>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });
        
        // Typing effect
        const text = "Halo Selamat Datang {{ $guru->nama }}";
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
        
        function toggleExportDropdown() {
            document.getElementById('exportDropdown').classList.toggle('hidden');
        }
        
        function openExportModal() {
            document.getElementById('exportModal').classList.remove('hidden');
            document.getElementById('exportDropdown').classList.add('hidden');
        }
        
        function closeExportModal() {
            document.getElementById('exportModal').classList.add('hidden');
        }
        
        function openExportKelasModal() {
            document.getElementById('exportKelasModal').classList.remove('hidden');
            document.getElementById('exportDropdown').classList.add('hidden');
        }
        
        function closeExportKelasModal() {
            document.getElementById('exportKelasModal').classList.add('hidden');
        }
        
        function togglePeriodeInputs() {
            const periode = document.getElementById('periode').value;
            const bulanInput = document.getElementById('bulanInput');
            const tahunInput = document.getElementById('tahunInput');
            
            if (periode === 'bulan') {
                bulanInput.classList.remove('hidden');
                tahunInput.classList.remove('hidden');
            } else if (periode === 'tahun') {
                bulanInput.classList.add('hidden');
                tahunInput.classList.remove('hidden');
            } else {
                bulanInput.classList.add('hidden');
                tahunInput.classList.add('hidden');
            }
        }
        
        function togglePeriodeInputsKelas() {
            const periode = document.getElementById('periodeKelas').value;
            const bulanInput = document.getElementById('bulanInputKelas');
            const tahunInput = document.getElementById('tahunInputKelas');
            
            if (periode === 'bulan') {
                bulanInput.classList.remove('hidden');
                tahunInput.classList.remove('hidden');
            } else if (periode === 'tahun') {
                bulanInput.classList.add('hidden');
                tahunInput.classList.remove('hidden');
            } else {
                bulanInput.classList.add('hidden');
                tahunInput.classList.add('hidden');
            }
        }
        
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
    </script>

    <!-- Close modal when clicking outside -->
    <script>
        document.getElementById('exportModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeExportModal();
            }
        });
        
        document.getElementById('exportKelasModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeExportKelasModal();
            }
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('#exportDropdown') && !e.target.closest('button[onclick="toggleExportDropdown()"]')) {
                document.getElementById('exportDropdown').classList.add('hidden');
            }
        });
    </script>

</body>
</html>