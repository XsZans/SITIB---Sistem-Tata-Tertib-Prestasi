<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru - Sistem Tata Tertib & Prestasi</title>
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

    @include('layouts.guru-navbar', ['title' => 'Sistem Tata Tertib & Prestasi', 'subtitle' => 'Dashboard Guru'])

    <div class="container mx-auto px-4 py-4 md:py-8 max-w-6xl">
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-lg" data-aos="fade-down">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3 text-green-600"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
        @endif
        
        @if($newApprovedReports > 0)
        <div class="mb-6 p-4 bg-blue-100 border border-blue-400 text-blue-700 rounded-lg shadow-lg" data-aos="fade-down">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-folder mr-3 text-blue-600"></i>
                    <span class="font-medium">{{ $newApprovedReports }} laporan baru telah diverifikasi dan siap diunduh!</span>
                </div>
                <a href="{{ route('guru.storage') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                    <i class="fas fa-download mr-1"></i>Lihat Storage
                </a>
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
                    GURU PANEL
                </div>
                <h2 class="text-2xl md:text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-3 md:mb-4">
                    Dashboard Guru Sistem Tata Tertib & Prestasi
                </h2>
                <p class="text-gray-600 max-w-3xl mx-auto text-sm md:text-lg leading-relaxed px-2">
                    Kelola dan pantau pelanggaran siswa dengan mudah
                </p>
                <div class="flex items-center justify-center gap-2 mt-4 md:mt-6">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-green-600 text-sm font-medium">System Online</span>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-8 md:mb-16" data-aos="fade-up" data-aos-delay="400">
                
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
            </div>

            <!-- Menu Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 md:gap-6 mb-8 md:mb-16" data-aos="fade-up" data-aos-delay="500">
                
                <!-- Input Pelanggaran -->
                <div class="bg-gradient-to-br from-red-50 to-red-100 border border-red-200 rounded-xl md:rounded-2xl p-6 md:p-8 hover-lift text-center flex flex-col justify-between h-full">
                    <div>
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-red-500 to-red-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-4 md:mb-6 shadow-lg">
                            <i class="fas fa-plus text-white text-2xl md:text-3xl"></i>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Input Pelanggaran</h3>
                        <p class="text-gray-600 text-sm md:text-base leading-relaxed mb-4 md:mb-6">
                            Catat pelanggaran siswa dengan mudah
                        </p>
                    </div>
                    <button onclick="openInputPelanggaranModal()" class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 whitespace-nowrap">
                        <i class="fas fa-arrow-right mr-2"></i>Input
                    </button>
                </div>

                <!-- Storage Laporan -->
                <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl md:rounded-2xl p-6 md:p-8 hover-lift text-center flex flex-col justify-between h-full relative">
                    @if($newApprovedReports > 0)
                    <div class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-6 h-6 flex items-center justify-center font-bold animate-pulse">
                        {{ $newApprovedReports }}
                    </div>
                    @endif
                    <div>
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-4 md:mb-6 shadow-lg">
                            <i class="fas fa-folder text-white text-2xl md:text-3xl"></i>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Storage Laporan</h3>
                        <p class="text-gray-600 text-sm md:text-base leading-relaxed mb-4 md:mb-6">
                            Laporan terverifikasi siap diunduh
                        </p>
                    </div>
                    <a href="{{ route('guru.storage') }}" class="inline-block bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 whitespace-nowrap">
                        <i class="fas fa-arrow-right mr-2"></i>Storage
                    </a>
                </div>

                <!-- Request Laporan -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl md:rounded-2xl p-6 md:p-8 hover-lift text-center flex flex-col justify-between h-full">
                    <div>
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-4 md:mb-6 shadow-lg">
                            <i class="fas fa-file-pdf text-white text-2xl md:text-3xl"></i>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Request Laporan</h3>
                        <p class="text-gray-600 text-sm md:text-base leading-relaxed mb-4 md:mb-6">
                            Ajukan permintaan laporan siswa
                        </p>
                    </div>
                    <a href="{{ route('guru.laporan') }}" class="inline-block bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 whitespace-nowrap">
                        <i class="fas fa-arrow-right mr-2"></i>Request
                    </a>
                </div>

                <!-- Profile -->
                <div class="bg-gradient-to-br from-orange-50 to-orange-100 border border-orange-200 rounded-xl md:rounded-2xl p-6 md:p-8 hover-lift text-center flex flex-col justify-between h-full">
                    <div>
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-4 md:mb-6 shadow-lg">
                            <i class="fas fa-user text-white text-2xl md:text-3xl"></i>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-2 md:mb-3">Profile</h3>
                        <p class="text-gray-600 text-sm md:text-base leading-relaxed mb-4 md:mb-6">
                            Lihat dan edit informasi profile Anda
                        </p>
                    </div>
                    <a href="{{ route('guru.profile') }}" class="inline-block bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 whitespace-nowrap">
                        <i class="fas fa-arrow-right mr-2"></i>Profile
                    </a>
                </div>
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
            
            <form action="{{ route('guru.export-laporan') }}" method="GET">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Siswa</label>
                        <select name="siswa_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <option value="">Pilih Siswa</option>
                            @foreach(App\Models\Siswa::orderBy('nama')->get() as $siswa)
                            <option value="{{ $siswa->id }}">{{ $siswa->nama }} - {{ $siswa->nis }} ({{ $siswa->kelas }})</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                        <select name="periode" id="periode" onchange="togglePeriodeInputs()" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <option value="semua">Semua Data</option>
                            <option value="bulan">Per Bulan</option>
                            <option value="tahun">Per Tahun</option>
                        </select>
                    </div>
                    
                    <div id="bulanInput" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bulan</label>
                        <select name="bulan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $i == now()->month ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                            @endfor
                        </select>
                    </div>
                    
                    <div id="tahunInput" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                        <select name="tahun" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
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
                    <button type="submit" class="flex-1 px-4 py-2 bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white rounded-lg transition-all duration-300 shadow-lg">
                        <i class="fas fa-download mr-2"></i>Export PDF
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Input Pelanggaran Modal -->
    <div id="inputPelanggaranModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Input Pelanggaran Siswa</h3>
                        <p class="text-gray-600 text-sm">Catat pelanggaran yang dilakukan siswa</p>
                    </div>
                    <button onclick="closeInputPelanggaranModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form action="{{ route('guru.input-pelanggaran') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Siswa *</label>
                            <select name="siswa_id" id="siswaSelect" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                <option value="">Pilih Siswa</option>
                                @foreach(App\Models\Siswa::orderBy('nama')->get() as $siswa)
                                <option value="{{ $siswa->id }}">{{ $siswa->nama }} - {{ $siswa->nis }} ({{ $siswa->kelas }})</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Pelanggaran *</label>
                            <select name="kategori_id" id="kategoriSelect" required onchange="loadJenisPelanggaran()" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                <option value="">Pilih Kategori</option>
                                @foreach(App\Models\KategoriPelanggaran::all() as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Pelanggaran *</label>
                            <select name="jenis_pelanggaran_id" id="jenisPelanggaranSelect" required disabled class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                <option value="">Pilih kategori terlebih dahulu</option>
                            </select>
                        </div>
                        

                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                            <textarea name="keterangan" rows="3" placeholder="Deskripsi detail pelanggaran (opsional)" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"></textarea>
                        </div>
                    </div>
                    
                    <div class="flex gap-3 mt-6">
                        <button type="button" onclick="closeInputPelanggaranModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-lg transition-all duration-300 shadow-lg">
                            <i class="fas fa-save mr-2"></i>Simpan
                        </button>
                    </div>
                </form>
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
        
        function openExportModal() {
            document.getElementById('exportModal').classList.remove('hidden');
        }
        
        function closeExportModal() {
            document.getElementById('exportModal').classList.add('hidden');
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
        
        // Input Pelanggaran Modal Functions
        function openInputPelanggaranModal() {
            document.getElementById('inputPelanggaranModal').classList.remove('hidden');
        }
        
        function closeInputPelanggaranModal() {
            document.getElementById('inputPelanggaranModal').classList.add('hidden');
        }
        
        function loadJenisPelanggaran() {
            const kategoriId = document.getElementById('kategoriSelect').value;
            const jenisPelanggaranSelect = document.getElementById('jenisPelanggaranSelect');
            
            if (kategoriId) {
                fetch(`/guru/jenis-pelanggaran/${kategoriId}`)
                    .then(response => response.json())
                    .then(data => {
                        jenisPelanggaranSelect.innerHTML = '<option value="">Pilih Jenis Pelanggaran</option>';
                        data.forEach(jenis => {
                            jenisPelanggaranSelect.innerHTML += `<option value="${jenis.id}">${jenis.nama} (${jenis.poin} poin)</option>`;
                        });
                        jenisPelanggaranSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        jenisPelanggaranSelect.innerHTML = '<option value="">Error loading data</option>';
                    });
            } else {
                jenisPelanggaranSelect.innerHTML = '<option value="">Pilih kategori terlebih dahulu</option>';
                jenisPelanggaranSelect.disabled = true;
            }
        }
        
        // Check for hash on page load
        window.addEventListener('load', function() {
            if (window.location.hash === '#input-pelanggaran') {
                openInputPelanggaranModal();
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
        
        document.getElementById('inputPelanggaranModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeInputPelanggaranModal();
            }
        });
    </script>

</body>
</html>