<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pelanggaran - SiTib</title>
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
    </style>
</head>
<body class="gradient-bg">

    @if(Auth::user()->role === 'admin')
        @include('layouts.admin-navbar', ['title' => 'Kelola Pelanggaran', 'subtitle' => 'Data Pelanggaran & Sanksi'])
    @else
        @include('layouts.kesiswaan-navbar', ['title' => 'Kelola Pelanggaran', 'subtitle' => 'Data Pelanggaran & Sanksi'])
    @endif
    
    <!-- Quick Action Bar -->
    <div class="bg-white shadow-sm border-b border-gray-200 py-3">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">Aksi Cepat</h2>
                <button onclick="openPelanggaranModal()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors shadow-sm">
                    <i class="fas fa-plus mr-2"></i>Catat Pelanggaran
                </button>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-4 md:py-8 max-w-6xl">
        
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center" data-aos="fade-down">
            <i class="fas fa-check-circle mr-3 text-green-600"></i>
            <div>
                <strong>Berhasil!</strong> {{ session('success') }}
            </div>
            <button onclick="this.parentElement.style.display='none'" class="ml-auto text-green-600 hover:text-green-800">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif
        
        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center" data-aos="fade-down">
            <i class="fas fa-exclamation-circle mr-3 text-red-600"></i>
            <div>
                <strong>Error!</strong> {{ session('error') }}
            </div>
            <button onclick="this.parentElement.style.display='none'" class="ml-auto text-red-600 hover:text-red-800">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-6" data-aos="fade-up">
            <div class="bg-gradient-to-br from-red-50 to-red-100 border border-red-200 rounded-xl p-4 hover-lift text-center">
                <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                    <i class="fas fa-exclamation-triangle text-white text-lg"></i>
                </div>
                <p class="text-sm text-gray-600 font-medium mb-1">Total Pelanggaran</p>
                <p class="text-2xl font-bold text-red-700">{{ $totalPelanggaran }}</p>
            </div>
            
            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 border border-yellow-200 rounded-xl p-4 hover-lift text-center">
                <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                    <i class="fas fa-clock text-white text-lg"></i>
                </div>
                <p class="text-sm text-gray-600 font-medium mb-1">Dalam Proses</p>
                <p class="text-2xl font-bold text-yellow-700">{{ $pelanggaranAktif }}</p>
            </div>
            
            <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl p-4 hover-lift text-center">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                    <i class="fas fa-check-circle text-white text-lg"></i>
                </div>
                <p class="text-sm text-gray-600 font-medium mb-1">Selesai</p>
                <p class="text-2xl font-bold text-green-700">{{ $pelanggaranSelesai }}</p>
            </div>
        </div>
        
        <!-- Waiting Verification Card -->
        <div class="grid grid-cols-1 gap-4 md:gap-6 mb-6" data-aos="fade-up">
            <div class="bg-gradient-to-br from-orange-50 to-orange-100 border border-orange-200 rounded-xl p-4 hover-lift text-center">
                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                    <i class="fas fa-hourglass-half text-white text-lg"></i>
                </div>
                <p class="text-sm text-gray-600 font-medium mb-1">Menunggu Verifikasi</p>
                <p class="text-2xl font-bold text-orange-700">{{ $pelanggaranMenunggu }}</p>
                <a href="{{ route('admin.laporan') }}" class="inline-block mt-2 px-3 py-1 bg-orange-600 hover:bg-orange-700 text-white text-xs rounded-lg transition-colors">
                    <i class="fas fa-eye mr-1"></i>Lihat Laporan
                </a>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-6" data-aos="fade-up">
            @php
                $totalKepribadian = $jenisPelanggaran->where('kategori', 'I')->count();
                $totalKerajinan = $jenisPelanggaran->where('kategori', 'II')->count();
                $totalKerapian = $jenisPelanggaran->where('kategori', 'III')->count();
            @endphp
            
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-4 hover-lift text-center">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                    <i class="fas fa-user-tie text-white text-lg"></i>
                </div>
                <p class="text-sm text-gray-600 font-medium mb-1">Kategori I - Kepribadian</p>
                <p class="text-2xl font-bold text-blue-700">{{ $totalKepribadian }}</p>
                <p class="text-xs text-gray-500">Jenis Pelanggaran</p>
            </div>
            
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 rounded-xl p-4 hover-lift text-center">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                    <i class="fas fa-clock text-white text-lg"></i>
                </div>
                <p class="text-sm text-gray-600 font-medium mb-1">Kategori II - Kerajinan</p>
                <p class="text-2xl font-bold text-purple-700">{{ $totalKerajinan }}</p>
                <p class="text-xs text-gray-500">Jenis Pelanggaran</p>
            </div>
            
            <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 border border-indigo-200 rounded-xl p-4 hover-lift text-center">
                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                    <i class="fas fa-tshirt text-white text-lg"></i>
                </div>
                <p class="text-sm text-gray-600 font-medium mb-1">Kategori III - Kerapian</p>
                <p class="text-2xl font-bold text-indigo-700">{{ $totalKerapian }}</p>
                <p class="text-xs text-gray-500">Jenis Pelanggaran</p>
            </div>
        </div>

        <!-- Grafik Pelanggaran -->
        <main id="grafik" class="glass-card rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-8 mb-8" data-aos="fade-up">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Grafik Pelanggaran</h2>
                    <p class="text-gray-600">Statistik pelanggaran per bulan dan tahun</p>
                </div>
                <button onclick="exportCurrentView()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <i class="fas fa-file-pdf mr-2"></i>Export PDF
                </button>
            </div>
            
            <!-- Filter -->
            <div class="mb-6 flex justify-between items-center">
                <div class="flex gap-4">
                    <select id="periodeFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" onchange="toggleFilterInputs()">
                        <option value="bulan">Bulan</option>
                        <option value="tahun">Tahun</option>
                        <option value="all">Semua Data</option>
                    </select>
                    
                    <select id="bulanFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $i == now()->month ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                    
                    <select id="tahunFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                        @for($i = now()->year; $i >= now()->year - 5; $i--)
                            <option value="{{ $i }}" {{ $i == now()->year ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                    
                    <button onclick="updateGrafik()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors">
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
                    <h4 id="totalLabel" class="font-semibold text-gray-800 mb-2">Total Bulan Ini</h4>
                    <p id="totalBulan" class="text-2xl font-bold text-gray-700">0</p>
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
        </main>

        <!-- Jenis Pelanggaran -->
        <main class="glass-card rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-8 mb-8" data-aos="fade-up">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Jenis Pelanggaran</h2>
                <p class="text-gray-600">Daftar pelanggaran berdasarkan kategori dan poin</p>
            </div>

            <!-- Kategori Pelanggaran -->
            @php
                $kategoris = $jenisPelanggaran->groupBy('kategori');
            @endphp

            @foreach($kategoris as $kategori => $items)
            <div class="mb-8">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-exclamation text-white text-sm"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">{{ ucfirst($kategori) }}</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($items as $jenis)
                    <div class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-2">
                            <h4 class="font-semibold text-gray-800 text-sm">{{ $jenis->nama_pelanggaran }}</h4>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                @if($jenis->poin <= 5) bg-yellow-100 text-yellow-800
                                @elseif($jenis->poin <= 15) bg-orange-100 text-orange-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $jenis->poin }} Poin
                            </span>
                        </div>
                        <p class="text-gray-600 text-xs mb-3">{{ $jenis->deskripsi }}</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <span class="text-xs text-gray-500">Kategori: {{ ucfirst($jenis->kategori) }}</span>
                                <span class="px-2 py-1 text-xs font-medium rounded-full 
                                    @if($jenis->poin <= 5) bg-green-100 text-green-700
                                    @elseif($jenis->poin <= 15) bg-yellow-100 text-yellow-700
                                    @else bg-red-100 text-red-700 @endif">
                                    @if($jenis->poin <= 5) Ringan
                                    @elseif($jenis->poin <= 15) Sedang
                                    @else Berat @endif
                                </span>
                            </div>
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded text-xs transition-colors">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </main>

        <!-- Sanksi & Hukuman -->
        <main class="glass-card rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-8 mb-8" data-aos="fade-up" data-aos-delay="200">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Sanksi & Hukuman</h2>
                <p class="text-gray-600">Tingkatan sanksi berdasarkan akumulasi poin pelanggaran</p>
            </div>

            <!-- Sanksi Ringan -->
            <div class="mb-6">
                <h3 class="text-lg font-bold text-green-700 mb-4 flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>Sanksi Ringan (1-5 Poin)
                </h3>
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <p class="text-green-800 font-medium">• Dicatat dan konseling</p>
                </div>
            </div>

            <!-- Sanksi Sedang -->
            <div class="mb-6">
                <h3 class="text-lg font-bold text-yellow-700 mb-4 flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Sanksi Sedang (6-15 Poin)
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <h4 class="font-semibold text-yellow-800 mb-2">6-10 Poin</h4>
                        <p class="text-yellow-700">• Peringatan lisan</p>
                    </div>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <h4 class="font-semibold text-yellow-800 mb-2">11-15 Poin</h4>
                        <p class="text-yellow-700">• Peringatan tertulis dengan perjanjian</p>
                    </div>
                </div>
            </div>

            <!-- Sanksi Berat -->
            <div class="mb-6">
                <h3 class="text-lg font-bold text-red-700 mb-4 flex items-center">
                    <i class="fas fa-ban mr-2"></i>Sanksi Berat (16-100 Poin)
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <h4 class="font-semibold text-red-800 mb-2">16-20 Poin</h4>
                        <p class="text-red-700 text-sm">• Panggilan orang tua dengan perjanjian di atas materai</p>
                    </div>
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <h4 class="font-semibold text-red-800 mb-2">21-25 Poin</h4>
                        <p class="text-red-700 text-sm">• Perjanjian orang tua dengan perjanjian di atas materai</p>
                    </div>
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <h4 class="font-semibold text-red-800 mb-2">26-30 Poin</h4>
                        <p class="text-red-700 text-sm">• Skors 3 hari</p>
                    </div>
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <h4 class="font-semibold text-red-800 mb-2">31-35 Poin</h4>
                        <p class="text-red-700 text-sm">• Skors 7 hari</p>
                    </div>
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <h4 class="font-semibold text-red-800 mb-2">36-40 Poin</h4>
                        <p class="text-red-700 text-sm">• Diserahkan kepada ortu untuk dibina dalam jangka waktu 2 minggu</p>
                    </div>
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <h4 class="font-semibold text-red-800 mb-2">41-89 Poin</h4>
                        <p class="text-red-700 text-sm">• Diserahkan dan dibina ortu jangka waktu 1 bulan</p>
                    </div>
                    <div class="bg-red-200 border border-red-400 rounded-lg p-4">
                        <h4 class="font-semibold text-red-900 mb-2">90-100 Poin</h4>
                        <p class="text-red-900 text-sm font-bold">• Dikembalikan kepada orang tua (Drop Out dari sekolah)</p>
                        <p class="text-red-800 text-xs mt-1">Siswa dikeluarkan dari sekolah secara permanen</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Tambah Pelanggaran -->
    <div id="pelanggaranModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-bold text-gray-800">Catat Pelanggaran Siswa</h3>
                    <button onclick="closePelanggaranModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            
            <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
                <!-- Filter & Search -->
                <div class="mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input type="text" id="searchSiswa" placeholder="Cari nama atau NIS..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                        <select id="filterJurusan" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                            <option value="">Semua Jurusan</option>
                            <option value="PPLG">PPLG</option>
                            <option value="AKT">AKT</option>
                            <option value="ANM">ANM</option>
                            <option value="PMS">PMS</option>
                            <option value="DKV">DKV</option>
                        </select>
                        <select id="filterKelas" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                            <option value="">Semua Kelas</option>
                            <option value="X">Kelas X</option>
                            <option value="XI">Kelas XI</option>
                            <option value="XII">Kelas XII</option>
                        </select>
                    </div>
                </div>
                
                <!-- Form Pelanggaran -->
                <form id="pelanggaranForm" method="POST" action="{{ route('admin.tambah-pelanggaran') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="selectedSiswaId" name="siswa_id">
                    
                    <!-- Pilih Siswa -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Siswa</label>
                        <div id="siswaList" class="max-h-60 overflow-y-auto border border-gray-300 rounded-lg">
                            <!-- Siswa akan dimuat di sini -->
                        </div>
                        <div id="selectedSiswaInfo" class="mt-2 p-3 bg-blue-50 border border-blue-200 rounded-lg hidden">
                            <p class="text-sm text-blue-800">Siswa terpilih: <span id="selectedSiswaName" class="font-semibold"></span></p>
                        </div>
                    </div>
                    
                    <!-- Kategori Pelanggaran -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Pelanggaran</label>
                        <select id="kategori_pelanggaran_form" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" onchange="filterJenisPelanggaranForm()">
                            <option value="">Pilih Kategori</option>
                            @foreach(App\Models\JenisPelanggaran::getKategoriOptions() as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Jenis Pelanggaran -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Pelanggaran</label>
                        <select name="jenis_pelanggaran_id" id="jenis_pelanggaran_form" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" disabled>
                            <option value="">Pilih kategori terlebih dahulu</option>
                        </select>
                    </div>
                    
                    <!-- Bukti Gambar -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bukti Gambar <span class="text-gray-500">(Opsional)</span></label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-red-400 transition-colors">
                            <input type="file" name="bukti_gambar" id="bukti_gambar_pelanggaran" accept="image/*" class="hidden">
                            <div id="uploadAreaPelanggaran" class="cursor-pointer" onclick="document.getElementById('bukti_gambar_pelanggaran').click()">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                <p class="text-gray-600 mb-1">Klik untuk upload bukti gambar</p>
                                <p class="text-sm text-gray-500">Format: JPG, PNG (Max: 2MB)</p>
                            </div>
                            <div id="previewAreaPelanggaran" class="hidden">
                                <img id="imagePreviewPelanggaran" class="max-w-full h-32 object-cover rounded-lg mx-auto mb-2">
                                <p id="fileNamePelanggaran" class="text-sm text-gray-600 mb-2"></p>
                                <button type="button" onclick="removeImagePelanggaran()" class="text-red-500 hover:text-red-700 text-sm">
                                    <i class="fas fa-trash mr-1"></i>Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Catatan -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                        <textarea name="keterangan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                    </div>
                    
                    <!-- Buttons -->
                    <div class="flex gap-3">
                        <button type="button" onclick="closePelanggaranModal()" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg font-medium transition-colors">
                            Batal
                        </button>
                        <button type="submit" id="submitPelanggaranBtn" class="flex-1 bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg font-medium transition-colors">
                            Catat Pelanggaran
                        </button>
                    </div>
                </form>
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
        
        let allSiswa = [];
        let selectedSiswa = null;
        
        // Load siswa data
        async function loadSiswa() {
            try {
                const response = await fetch('/admin/get-siswa');
                allSiswa = await response.json();
                filterSiswa();
            } catch (error) {
                console.error('Error loading siswa:', error);
            }
        }
        
        // Filter siswa
        function filterSiswa() {
            const search = document.getElementById('searchSiswa').value.toLowerCase();
            const jurusan = document.getElementById('filterJurusan').value;
            const kelas = document.getElementById('filterKelas').value;
            
            let filtered = allSiswa.filter(siswa => {
                const matchSearch = siswa.nama.toLowerCase().includes(search) || siswa.nis.includes(search);
                
                // Match jurusan - check both short and long form
                let matchJurusan = true;
                if (jurusan) {
                    const jurMap = {
                        'PPLG': 'Pengembangan Perangkat Lunak dan Gim',
                        'AKT': 'Akuntansi',
                        'ANM': 'Animasi',
                        'PMS': 'Pemasaran',
                        'DKV': 'Desain Komunikasi Visual'
                    };
                    matchJurusan = siswa.jurusan.includes(jurMap[jurusan]) || siswa.kelas.includes(jurusan);
                }
                
                // Match kelas - check tingkat (X=10, XI=11, XII=12)
                let matchKelas = true;
                if (kelas) {
                    const kelasMap = {
                        'X': '10',
                        'XI': '11', 
                        'XII': '12'
                    };
                    matchKelas = siswa.kelas.includes(kelasMap[kelas]);
                }
                
                return matchSearch && matchJurusan && matchKelas;
            });
            
            displaySiswa(filtered);
        }
        
        // Display siswa list
        function displaySiswa(siswaList) {
            const container = document.getElementById('siswaList');
            container.innerHTML = '';
            
            if (siswaList.length === 0) {
                container.innerHTML = '<p class="p-4 text-gray-500 text-center">Tidak ada siswa ditemukan</p>';
                return;
            }
            
            siswaList.forEach(siswa => {
                const div = document.createElement('div');
                div.className = 'p-3 border-b border-gray-200 hover:bg-gray-50 cursor-pointer transition-colors';
                div.onclick = () => selectSiswa(siswa);
                div.innerHTML = `
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-semibold text-gray-800">${siswa.nama}</p>
                            <p class="text-sm text-gray-600">${siswa.nis} - ${siswa.kelas} - ${siswa.jurusan}</p>
                        </div>
                        <div class="text-right">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full ${
                                siswa.poin_pelanggaran === 0 ? 'bg-green-100 text-green-800' :
                                siswa.poin_pelanggaran <= 5 ? 'bg-yellow-100 text-yellow-800' :
                                siswa.poin_pelanggaran <= 15 ? 'bg-orange-100 text-orange-800' :
                                'bg-red-100 text-red-800'
                            }">
                                ${siswa.poin_pelanggaran} Poin
                            </span>
                        </div>
                    </div>
                `;
                container.appendChild(div);
            });
        }
        
        // Select siswa
        function selectSiswa(siswa) {
            selectedSiswa = siswa;
            document.getElementById('selectedSiswaId').value = siswa.id;
            document.getElementById('selectedSiswaName').textContent = `${siswa.nama} (${siswa.nis}) - ${siswa.kelas}`;
            document.getElementById('selectedSiswaInfo').classList.remove('hidden');
            
            // Highlight selected
            document.querySelectorAll('#siswaList > div').forEach(div => {
                div.classList.remove('bg-blue-50', 'border-blue-200');
                div.classList.add('hover:bg-gray-50');
            });
            event.target.closest('div').classList.add('bg-blue-50', 'border-blue-200');
            event.target.closest('div').classList.remove('hover:bg-gray-50');
        }
        
        // Modal functions - openPelanggaranModal is defined above
        
        function closePelanggaranModal() {
            document.getElementById('pelanggaranModal').classList.add('hidden');
            document.getElementById('pelanggaranForm').reset();
            document.getElementById('selectedSiswaInfo').classList.add('hidden');
            document.body.style.overflow = 'auto';
            selectedSiswa = null;
            removeImagePelanggaran();
            
            // Reset submit button
            const submitBtn = document.getElementById('submitPelanggaranBtn');
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Catat Pelanggaran';
            submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
        }
        
        // Event listeners
        document.getElementById('searchSiswa').addEventListener('input', filterSiswa);
        document.getElementById('filterJurusan').addEventListener('change', filterSiswa);
        document.getElementById('filterKelas').addEventListener('change', filterSiswa);
        
        // Image upload handling
        document.getElementById('bukti_gambar_pelanggaran').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    showValidationError('Ukuran file terlalu besar. Maksimal 2MB.');
                    e.target.value = '';
                    return;
                }
                
                if (!file.type.startsWith('image/')) {
                    showValidationError('File harus berupa gambar.');
                    e.target.value = '';
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreviewPelanggaran').src = e.target.result;
                    document.getElementById('fileNamePelanggaran').textContent = file.name;
                    document.getElementById('uploadAreaPelanggaran').classList.add('hidden');
                    document.getElementById('previewAreaPelanggaran').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
        
        function removeImagePelanggaran() {
            document.getElementById('bukti_gambar_pelanggaran').value = '';
            document.getElementById('uploadAreaPelanggaran').classList.remove('hidden');
            document.getElementById('previewAreaPelanggaran').classList.add('hidden');
        }
        
        // Close modal when clicking outside
        document.getElementById('pelanggaranModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePelanggaranModal();
            }
        });
        
        // Filter jenis pelanggaran by category in form
        const allPelanggaranForm = @json($jenisPelanggaran);
        
        function filterJenisPelanggaranForm() {
            const kategori = document.getElementById('kategori_pelanggaran_form').value;
            const jenisSelect = document.getElementById('jenis_pelanggaran_form');
            
            jenisSelect.innerHTML = '<option value="">Pilih jenis pelanggaran</option>';
            
            if (kategori) {
                jenisSelect.disabled = false;
                const filteredPelanggaran = allPelanggaranForm.filter(p => p.kategori === kategori);
                
                if (filteredPelanggaran.length > 0) {
                    filteredPelanggaran.forEach(p => {
                        const option = document.createElement('option');
                        option.value = p.id;
                        option.textContent = `${p.nama_pelanggaran} (${p.poin} poin)`;
                        jenisSelect.appendChild(option);
                    });
                } else {
                    jenisSelect.innerHTML = '<option value="">Tidak ada pelanggaran dalam kategori ini</option>';
                }
            } else {
                jenisSelect.disabled = true;
                jenisSelect.innerHTML = '<option value="">Pilih kategori terlebih dahulu</option>';
            }
        }
        
        // Chart
        let pelanggaranChart;
        
        async function loadGrafikData() {
            const periode = document.getElementById('periodeFilter').value;
            const bulan = document.getElementById('bulanFilter').value;
            const tahun = document.getElementById('tahunFilter').value;
            
            let url = '/admin/grafik-pelanggaran?';
            if (periode === 'bulan') {
                url += `bulan=${bulan}&tahun=${tahun}`;
            } else if (periode === 'tahun') {
                url += `tahun=${tahun}`;
            }
            
            try {
                const response = await fetch(url);
                const data = await response.json();
                
                if (pelanggaranChart) {
                    pelanggaranChart.destroy();
                }
                
                const ctx = document.getElementById('pelanggaranChart').getContext('2d');
                const hasData = data.ringan > 0 || data.sedang > 0 || data.berat > 0;
                
                if (hasData) {
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
                                    text: getChartTitle(periode, bulan, tahun)
                                },
                                legend: {
                                    position: 'bottom'
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
                
                document.getElementById('totalBulan').textContent = data.total || 0;
                document.getElementById('pelanggaranRingan').textContent = data.ringan || 0;
                document.getElementById('pelanggaranSedang').textContent = data.sedang || 0;
                document.getElementById('pelanggaranBerat').textContent = data.berat || 0;
                
                // Update total label
                document.getElementById('totalLabel').textContent = getTotalLabel(periode, bulan, tahun);
                
            } catch (error) {
                console.error('Error loading grafik data:', error);
            }
        }
        
        function updateGrafik() {
            loadGrafikData();
        }
        
        function toggleFilterInputs() {
            const periode = document.getElementById('periodeFilter').value;
            const bulanFilter = document.getElementById('bulanFilter');
            const tahunFilter = document.getElementById('tahunFilter');
            
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
        
        function getChartTitle(periode, bulan, tahun) {
            if (periode === 'bulan') {
                const bulanNama = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                return `Kategori Pelanggaran ${bulanNama[bulan]} ${tahun}`;
            } else if (periode === 'tahun') {
                return `Kategori Pelanggaran Tahun ${tahun}`;
            } else {
                return 'Kategori Pelanggaran Semua Data';
            }
        }
        
        function getTotalLabel(periode, bulan, tahun) {
            if (periode === 'bulan') {
                const bulanNama = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                return `Total ${bulanNama[bulan]} ${tahun}`;
            } else if (periode === 'tahun') {
                return `Total Tahun ${tahun}`;
            } else {
                return 'Total';
            }
        }
        
        function exportCurrentView() {
            const periode = document.getElementById('periodeFilter').value;
            const bulan = document.getElementById('bulanFilter').value;
            const tahun = document.getElementById('tahunFilter').value;
            
            let url = '/admin/export-pelanggaran?';
            url += `periode=${periode}`;
            if (periode === 'bulan') {
                url += `&bulan=${bulan}&tahun=${tahun}`;
            } else if (periode === 'tahun') {
                url += `&tahun=${tahun}`;
            }
            
            window.open(url, '_blank');
        }
        
        // Load chart on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleFilterInputs();
            loadGrafikData();
            
            // Auto hide notifications after 1.5 seconds
            const notifications = document.querySelectorAll('.bg-green-100, .bg-red-100');
            notifications.forEach(notification => {
                setTimeout(() => {
                    notification.style.transition = 'opacity 0.5s ease-out';
                    notification.style.opacity = '0';
                    setTimeout(() => {
                        notification.style.display = 'none';
                    }, 500);
                }, 1500);
            });
        });
        
        // Modal functions
        function openPelanggaranModal() {
            document.getElementById('pelanggaranModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            loadSiswa();
        }
        
        // Prevent double submission
        document.getElementById('pelanggaranForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitPelanggaranBtn');
            if (submitBtn.disabled) {
                e.preventDefault();
                return false;
            }
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
            submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
        });
        
        // Validation error functions
        function showValidationError(message) {
            document.getElementById('validationErrorMessage').textContent = message;
            document.getElementById('validationErrorModal').classList.remove('hidden');
        }
        
        function closeValidationError() {
            document.getElementById('validationErrorModal').classList.add('hidden');
        }

    </script>

    <!-- Validation Error Modal -->
    <div id="validationErrorModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Validasi Error</h3>
                <p id="validationErrorMessage" class="text-gray-600"></p>
            </div>
            
            <button type="button" onclick="closeValidationError()" class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                Tutup
            </button>
        </div>
    </div>

</body>
</html>