<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Prestasi - SiTib</title>
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
        @include('layouts.admin-navbar', ['title' => 'Kelola Prestasi', 'subtitle' => 'Data Prestasi SMK Bakti Nusantara 666'])
    @else
        @include('layouts.kesiswaan-navbar', ['title' => 'Kelola Prestasi', 'subtitle' => 'Data Prestasi SMK Bakti Nusantara 666'])
    @endif

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
        
        <main class="glass-card rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-8 mb-8" data-aos="fade-up">

            <!-- Header -->
            <div class="text-center mb-8 md:mb-12" data-aos="fade-up" data-aos-delay="200">
                <div class="inline-block p-3 md:p-4 bg-gradient-to-br from-yellow-500 to-amber-600 rounded-xl md:rounded-2xl mb-4 md:mb-6 shadow-lg">
                    <i class="fas fa-trophy text-white text-2xl md:text-3xl"></i>
                </div>
                <h2 class="text-2xl md:text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-3 md:mb-4">
                    Kelola Prestasi Siswa
                </h2>
                <p class="text-gray-600 max-w-3xl mx-auto text-sm md:text-lg leading-relaxed">
                    Kelola data prestasi akademik dan non-akademik siswa dengan sistem poin pengurangan
                </p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-8 md:mb-12" data-aos="fade-up" data-aos-delay="300">
                
                <div class="bg-gradient-to-br from-yellow-50 to-amber-100 border border-yellow-200 rounded-xl md:rounded-2xl p-4 md:p-6 hover-lift text-center">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-yellow-500 to-amber-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-trophy text-white text-lg md:text-2xl"></i>
                    </div>
                    <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Total Prestasi</p>
                    <p class="text-xl md:text-2xl font-bold text-yellow-700">{{ $totalPrestasi }}</p>
                </div>
                
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl md:rounded-2xl p-4 md:p-6 hover-lift text-center">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-graduation-cap text-white text-lg md:text-2xl"></i>
                    </div>
                    <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Prestasi Akademik</p>
                    <p class="text-xl md:text-2xl font-bold text-blue-700">{{ $prestasiAkademik }}</p>
                </div>
                
                <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl md:rounded-2xl p-4 md:p-6 hover-lift text-center">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-medal text-white text-lg md:text-2xl"></i>
                    </div>
                    <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Prestasi Non-Akademik</p>
                    <p class="text-xl md:text-2xl font-bold text-green-700">{{ $prestasiNonAkademik }}</p>
                </div>
            </div>

            <!-- Grafik Prestasi -->
            <div id="grafik" class="glass-card rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-8 mb-8" data-aos="fade-up" data-aos-delay="350">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Grafik Prestasi</h2>
                        <p class="text-gray-600">Statistik prestasi per bulan dan tahun</p>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="exportCurrentView()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            <i class="fas fa-file-pdf mr-2"></i>Export PDF
                        </button>
                        <button onclick="openPrestasiModal()" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            <i class="fas fa-plus mr-2"></i>Catat Prestasi
                        </button>
                    </div>
                </div>
                
                <!-- Filter -->
                <div class="mb-6 flex justify-between items-center">
                    <div class="flex gap-4">
                        <select id="periodeFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" onchange="toggleFilterInputs()">
                            <option value="bulan">Bulan</option>
                            <option value="tahun">Tahun</option>
                            <option value="all">Semua Data</option>
                        </select>
                        
                        <select id="bulanFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ $i == now()->month ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                </option>
                            @endfor
                        </select>
                        
                        <select id="tahunFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            @for($i = now()->year; $i >= now()->year - 5; $i--)
                                <option value="{{ $i }}" {{ $i == now()->year ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        
                        <button onclick="updateGrafik()" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition-colors">
                            <i class="fas fa-sync mr-2"></i>Update
                        </button>
                    </div>
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
                        <h4 id="totalLabel" class="font-semibold text-gray-800 mb-2">Total Bulan Ini</h4>
                        <p id="totalBulan" class="text-2xl font-bold text-gray-700">0</p>
                    </div>
                    <div class="bg-green-50 rounded-lg p-4 text-center">
                        <h4 class="font-semibold text-green-800 mb-2">Prestasi Akademik</h4>
                        <p id="prestasiAkademikChart" class="text-2xl font-bold text-green-700">0</p>
                    </div>
                    <div class="bg-blue-50 rounded-lg p-4 text-center">
                        <h4 class="font-semibold text-blue-800 mb-2">Prestasi Non-Akademik</h4>
                        <p id="prestasiNonAkademikChart" class="text-2xl font-bold text-blue-700">0</p>
                    </div>
                </div>
            </div>

            <!-- Siswa Berprestasi Section -->
            <div class="glass-card rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-8 mb-8" data-aos="fade-up" data-aos-delay="375">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Siswa Berprestasi</h2>
                        <p class="text-gray-600">Daftar siswa dengan prestasi terbaik</p>
                    </div>
                </div>
                
                @php
                    $siswaBerprestasi = App\Models\Siswa::where('poin_prestasi', '>', 0)->with(['prestasiSiswa' => function($q) {
                        $q->where('status', 'diverifikasi')->with('prestasi');
                    }])->orderBy('poin_prestasi', 'desc')->get();
                @endphp
                
                @if($siswaBerprestasi->count() > 0)
                    <div id="siswaPrestasiContainer">
                        @foreach($siswaBerprestasi->take(6) as $siswa)
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
                        @endforeach
                        
                        @if($siswaBerprestasi->count() > 6)
                            <div class="text-center mt-4">
                                <button onclick="toggleShowAllSiswa()" id="showMoreBtn" class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                                    <i class="fas fa-chevron-down mr-2"></i>Lihat Semua ({{ $siswaBerprestasi->count() }})
                                </button>
                            </div>
                            
                            <div id="allSiswaContainer" class="hidden mt-4">
                                @foreach($siswaBerprestasi->skip(6) as $siswa)
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
                                @endforeach
                            </div>
                        @endif
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-trophy text-amber-600 text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Belum Ada Siswa Berprestasi</h4>
                        <p class="text-gray-600">Siswa dengan poin prestasi akan muncul di sini</p>
                    </div>
                @endif
            </div>

            <!-- Header dengan tombol tambah -->
            <div class="flex justify-between items-center mb-6" data-aos="fade-up" data-aos-delay="400">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Daftar Prestasi</h3>
                    <p class="text-gray-600">Kelola prestasi siswa berdasarkan kategori</p>
                </div>
            </div>

            <!-- Prestasi Cards -->
            <div data-aos="fade-up" data-aos-delay="400">
                @php
                    $kategoris = $prestasi->groupBy('kategori');
                @endphp

                @foreach($kategoris as $kategori => $items)
                <div class="mb-8">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-gradient-to-br from-{{ $kategori == 'akademik' ? 'blue' : 'green' }}-500 to-{{ $kategori == 'akademik' ? 'blue' : 'emerald' }}-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-{{ $kategori == 'akademik' ? 'graduation-cap' : 'medal' }} text-white text-sm"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 capitalize">Prestasi {{ $kategori }}</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($items as $item)
                        <div class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="font-semibold text-gray-800 text-sm">{{ $item->nama }}</h4>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    +{{ $item->poin_pengurangan }} Poin
                                </span>
                            </div>
                            @if($item->deskripsi)
                                <p class="text-gray-600 text-xs mb-3">{{ $item->deskripsi }}</p>
                            @endif
                            <div class="flex justify-between items-center">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs text-gray-500">Kategori: {{ ucfirst($item->kategori) }}</span>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-{{ $item->kategori == 'akademik' ? 'blue' : 'purple' }}-100 text-{{ $item->kategori == 'akademik' ? 'blue' : 'purple' }}-700 capitalize">
                                        {{ $item->tingkat }}
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
            </div>

        </main>
    </div>

    <!-- Modal Tambah Prestasi -->
    <div id="prestasiModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-bold text-gray-800">Catat Prestasi Siswa</h3>
                    <button onclick="closePrestasiModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            
            <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
                <!-- Filter & Search -->
                <div class="mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" id="searchSiswa" placeholder="Cari nama atau NIS..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <select id="filterJurusan" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <option value="">Semua Jurusan</option>
                            <option value="Pemasaran">Pemasaran</option>
                            <option value="Animasi">Animasi</option>
                            <option value="Desain Komunikasi Visual">Desain Komunikasi Visual</option>
                            <option value="Pengembangan Perangkat Lunak dan Gim">Pengembangan Perangkat Lunak dan Gim</option>
                            <option value="Akuntansi">Akuntansi</option>
                        </select>
                    </div>
                </div>
                
                <!-- Form Prestasi -->
                <form id="prestasiForm" method="POST" action="@if(Auth::user()->role === 'admin'){{ route('admin.tambah-prestasi') }}@else{{ route('kesiswaan.tambah-prestasi') }}@endif" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="selectedSiswaId" name="siswa_id">
                    
                    <!-- Pilih Siswa -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Siswa</label>
                        <div id="siswaList" class="max-h-60 overflow-y-auto border border-gray-300 rounded-lg">
                            <!-- Siswa akan dimuat di sini -->
                        </div>
                        <div id="selectedSiswaInfo" class="mt-2 p-3 bg-yellow-50 border border-yellow-200 rounded-lg hidden">
                            <p class="text-sm text-yellow-800">Siswa terpilih: <span id="selectedSiswaName" class="font-semibold"></span></p>
                        </div>
                    </div>
                    
                    <!-- Kategori Prestasi -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Prestasi</label>
                        <select id="kategori_prestasi_form" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" onchange="filterJenisPrestasiForm()">
                            <option value="">Pilih Kategori</option>
                            <option value="akademik">Akademik</option>
                            <option value="non-akademik">Non-Akademik</option>
                        </select>
                    </div>
                    
                    <!-- Jenis Prestasi -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Prestasi</label>
                        <select name="jenis_prestasi_id" id="jenis_prestasi_form" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" disabled>
                            <option value="">Pilih kategori terlebih dahulu</option>
                        </select>
                    </div>
                    
                    <!-- Bukti Gambar -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bukti Gambar <span class="text-gray-500">(Opsional)</span></label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-yellow-400 transition-colors">
                            <input type="file" name="bukti_gambar" id="bukti_gambar_prestasi" accept="image/*" class="hidden">
                            <div id="uploadAreaPrestasi" class="cursor-pointer" onclick="document.getElementById('bukti_gambar_prestasi').click()">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                <p class="text-gray-600 mb-1">Klik untuk upload bukti gambar</p>
                                <p class="text-sm text-gray-500">Format: JPG, PNG (Max: 2MB)</p>
                            </div>
                            <div id="previewAreaPrestasi" class="hidden">
                                <img id="imagePreviewPrestasi" class="max-w-full h-32 object-cover rounded-lg mx-auto mb-2">
                                <p id="fileNamePrestasi" class="text-sm text-gray-600 mb-2"></p>
                                <button type="button" onclick="removeImagePrestasi()" class="text-red-500 hover:text-red-700 text-sm">
                                    <i class="fas fa-trash mr-1"></i>Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Catatan -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                        <textarea name="keterangan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                    </div>
                    
                    <!-- Buttons -->
                    <div class="flex gap-3">
                        <button type="button" onclick="closePrestasiModal()" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg font-medium transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 bg-yellow-600 hover:bg-yellow-700 text-white py-2 px-4 rounded-lg font-medium transition-colors">
                            Catat Prestasi
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
            
            let filtered = allSiswa.filter(siswa => {
                const matchSearch = siswa.nama.toLowerCase().includes(search) || siswa.nis.includes(search);
                const matchJurusan = !jurusan || siswa.jurusan.includes(jurusan);
                return matchSearch && matchJurusan;
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
                div.classList.remove('bg-yellow-50', 'border-yellow-200');
                div.classList.add('hover:bg-gray-50');
            });
            event.target.closest('div').classList.add('bg-yellow-50', 'border-yellow-200');
            event.target.closest('div').classList.remove('hover:bg-gray-50');
        }
        
        // Modal functions
        function openPrestasiModal() {
            document.getElementById('prestasiModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            loadSiswa();
        }
        
        function closePrestasiModal() {
            document.getElementById('prestasiModal').classList.add('hidden');
            document.getElementById('prestasiForm').reset();
            document.getElementById('selectedSiswaInfo').classList.add('hidden');
            document.body.style.overflow = 'auto';
            selectedSiswa = null;
            removeImagePrestasi();
        }
        
        // Event listeners
        document.getElementById('searchSiswa').addEventListener('input', filterSiswa);
        document.getElementById('filterJurusan').addEventListener('change', filterSiswa);
        
        // Image upload handling
        document.getElementById('bukti_gambar_prestasi').addEventListener('change', function(e) {
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
                    document.getElementById('imagePreviewPrestasi').src = e.target.result;
                    document.getElementById('fileNamePrestasi').textContent = file.name;
                    document.getElementById('uploadAreaPrestasi').classList.add('hidden');
                    document.getElementById('previewAreaPrestasi').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
        
        function removeImagePrestasi() {
            document.getElementById('bukti_gambar_prestasi').value = '';
            document.getElementById('uploadAreaPrestasi').classList.remove('hidden');
            document.getElementById('previewAreaPrestasi').classList.add('hidden');
        }
        
        // Close modal when clicking outside
        document.getElementById('prestasiModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePrestasiModal();
            }
        });
        
        // Chart functionality
        let prestasiChart;
        
        async function loadGrafikData() {
            const periode = document.getElementById('periodeFilter').value;
            const bulan = document.getElementById('bulanFilter').value;
            const tahun = document.getElementById('tahunFilter').value;
            
            // Determine the correct route based on user role
            const baseUrl = @if(Auth::user()->role === 'admin') '/admin/grafik-prestasi' @else '/kesiswaan/grafik-prestasi' @endif;
            let url = baseUrl + '?';
            if (periode === 'bulan') {
                url += `bulan=${bulan}&tahun=${tahun}`;
            } else if (periode === 'tahun') {
                url += `tahun=${tahun}`;
            }
            
            try {
                const response = await fetch(url);
                const data = await response.json();
                
                if (prestasiChart) {
                    prestasiChart.destroy();
                }
                
                const ctx = document.getElementById('prestasiChart').getContext('2d');
                const hasData = data.akademik > 0 || data.non_akademik > 0;
                
                if (hasData) {
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
                document.getElementById('prestasiAkademikChart').textContent = data.akademik || 0;
                document.getElementById('prestasiNonAkademikChart').textContent = data.non_akademik || 0;
                
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
                return `Kategori Prestasi ${bulanNama[bulan]} ${tahun}`;
            } else if (periode === 'tahun') {
                return `Kategori Prestasi Tahun ${tahun}`;
            } else {
                return 'Kategori Prestasi Semua Data';
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
        
        // Filter jenis prestasi by category in form
        const allPrestasiForm = @json($prestasi);
        
        function filterJenisPrestasiForm() {
            const kategori = document.getElementById('kategori_prestasi_form').value;
            const jenisSelect = document.getElementById('jenis_prestasi_form');
            
            jenisSelect.innerHTML = '<option value="">Pilih jenis prestasi</option>';
            
            if (kategori) {
                jenisSelect.disabled = false;
                const filteredPrestasi = allPrestasiForm.filter(p => p.kategori === kategori);
                
                if (filteredPrestasi.length > 0) {
                    filteredPrestasi.forEach(p => {
                        const option = document.createElement('option');
                        option.value = p.id;
                        option.textContent = `${p.nama} (${p.poin_pengurangan} poin)`;
                        jenisSelect.appendChild(option);
                    });
                } else {
                    jenisSelect.innerHTML = '<option value="">Tidak ada prestasi dalam kategori ini</option>';
                }
            } else {
                jenisSelect.disabled = true;
                jenisSelect.innerHTML = '<option value="">Pilih kategori terlebih dahulu</option>';
            }
        }
        
        function exportCurrentView() {
            const periode = document.getElementById('periodeFilter').value;
            const bulan = document.getElementById('bulanFilter').value;
            const tahun = document.getElementById('tahunFilter').value;
            
            // Determine the correct route based on user role
            const baseUrl = @if(Auth::user()->role === 'admin') '/admin/export-prestasi' @else '/kesiswaan/export-prestasi' @endif;
            let url = baseUrl + '?';
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
        
        // Siswa Berprestasi Functions
        function toggleShowAllSiswa() {
            const allContainer = document.getElementById('allSiswaContainer');
            const btn = document.getElementById('showMoreBtn');
            
            if (allContainer.classList.contains('hidden')) {
                allContainer.classList.remove('hidden');
                btn.innerHTML = '<i class="fas fa-chevron-up mr-2"></i>Sembunyikan';
            } else {
                allContainer.classList.add('hidden');
                btn.innerHTML = '<i class="fas fa-chevron-down mr-2"></i>Lihat Semua ({{ $siswaBerprestasi->count() }})';
            }
        }
        
        function openPrestasiDetailModal(siswaId) {
            // Create modal if not exists
            if (!document.getElementById('prestasiDetailModal')) {
                const modal = document.createElement('div');
                modal.id = 'prestasiDetailModal';
                modal.className = 'fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4';
                modal.innerHTML = `
                    <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 id="prestasiDetailTitle" class="text-2xl font-bold text-gray-800">Detail Prestasi Siswa</h3>
                                    <p id="prestasiDetailSubtitle" class="text-gray-600">Riwayat lengkap prestasi siswa</p>
                                </div>
                                <button onclick="closePrestasiDetailModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
                            <div id="prestasiDetailContent" class="space-y-4">
                                <!-- Content will be loaded here -->
                            </div>
                        </div>
                    </div>
                `;
                document.body.appendChild(modal);
                
                // Add click outside to close
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        closePrestasiDetailModal();
                    }
                });
            }
            
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
                const allSiswaData = @json($siswaBerprestasi);
                const siswaData = allSiswaData.find(s => s.id == siswaId);
                
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