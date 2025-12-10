<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - {{ $siswa->nama }}</title>
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
    </style>
</head>
<body class="gradient-bg">
    @include('layouts.siswa-navbar', ['title' => 'Dashboard Siswa', 'subtitle' => 'Sistem Tata Tertib & Prestasi'])

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
        <main class="bg-white/95 backdrop-blur-sm rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-10 mb-8" data-aos="fade-up" data-aos-duration="800">

            <!-- Welcome Section -->
            <div class="text-center mb-8 md:mb-16" data-aos="fade-up" data-aos-delay="200">
                <div class="inline-block bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-4 md:px-6 py-1.5 md:py-2 rounded-full text-xs md:text-sm font-semibold mb-3 md:mb-4 shadow-lg">
                    DASHBOARD SISWA
                </div>
                <h2 class="text-2xl md:text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-3 md:mb-4">
                    Selamat Datang, {{ $siswa->nama }}!
                </h2>
                <p class="text-gray-600 max-w-3xl mx-auto text-sm md:text-lg leading-relaxed px-2">
                    Pantau perkembangan tata tertib dan prestasi Anda melalui dashboard ini
                </p>
                <div class="flex items-center justify-center gap-2 mt-4 md:mt-6">
                    <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                    <span class="text-blue-600 text-sm font-medium">System Online</span>
                </div>
            </div>

            <!-- Data Card -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100 mb-8" data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-user text-white text-lg"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Data Siswa</h3>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-user text-blue-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Nama Lengkap</p>
                            <p class="font-semibold text-gray-800">{{ $siswa->nama }}</p>
                        </div>
                    </div>
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-id-card text-green-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">NIS</p>
                            <p class="font-semibold text-gray-800">{{ $siswa->nis }}</p>
                        </div>
                    </div>
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-school text-purple-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Kelas & Jurusan</p>
                            <p class="font-semibold text-gray-800">{{ $siswa->kelas }} - {{ $siswa->jurusan }}</p>
                        </div>
                    </div>
                    <div class="pt-2">
                        <a href="{{ route('siswa.export-laporan') }}" class="inline-block bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-2 rounded-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 text-sm">
                            <i class="fas fa-download mr-2"></i>Download Laporan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8 md:mb-16" data-aos="fade-up" data-aos-delay="400">
                <div class="bg-gradient-to-br from-red-50 to-red-100 border border-red-200 rounded-xl md:rounded-2xl p-4 md:p-6 text-center">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-exclamation-triangle text-white text-lg md:text-2xl"></i>
                    </div>
                    <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Total Pelanggaran</p>
                    <p class="text-xl md:text-2xl font-bold text-red-700">{{ $totalPelanggaran }}</p>
                    <a href="{{ route('siswa.pelanggaran') }}" class="mt-2 bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-xs transition-colors inline-block">
                        <i class="fas fa-eye mr-1"></i>Lihat
                    </a>
                </div>
                
                <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl md:rounded-2xl p-4 md:p-6 text-center">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-trophy text-white text-lg md:text-2xl"></i>
                    </div>
                    <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Total Prestasi</p>
                    <p class="text-xl md:text-2xl font-bold text-green-700">{{ $totalPrestasi }}</p>
                    <a href="{{ route('siswa.prestasi') }}" class="mt-2 bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-lg text-xs transition-colors inline-block">
                        <i class="fas fa-eye mr-1"></i>Lihat
                    </a>
                </div>
                
                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 border border-yellow-200 rounded-xl md:rounded-2xl p-4 md:p-6 text-center">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-clock text-white text-lg md:text-2xl"></i>
                    </div>
                    <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Dalam Proses</p>
                    <p class="text-xl md:text-2xl font-bold text-yellow-700">
                        <span class="text-red-600">{{ $pelanggaranDalamProses }}</span>/<span class="text-green-600">{{ $prestasiDalamProses }}</span>
                    </p>
                </div>
                
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl md:rounded-2xl p-4 md:p-6 text-center">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-chart-line text-white text-lg md:text-2xl"></i>
                    </div>
                    <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Status</p>
                    <p class="text-lg md:text-xl font-bold {{ $siswa->poin_pelanggaran > $siswa->poin_prestasi ? 'text-red-700' : 'text-blue-700' }}">
                        {{ $siswa->poin_pelanggaran > $siswa->poin_prestasi ? 'Perlu Perbaikan' : 'Baik' }}
                    </p>
                </div>
            </div>

        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });
    </script>
</body>
</html>