<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Siswa - SiTib</title>
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
        
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
        }
        
        .loading-spinner {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            text-align: center;
        }
        
        .spinner {
            border: 4px solid #f3f4f6;
            border-top: 4px solid #3b82f6;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="gradient-bg">

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay">
        <div class="loading-spinner">
            <div class="spinner"></div>
            <p class="text-gray-700 font-medium">Mencari data siswa...</p>
        </div>
    </div>

    @include('layouts.admin-navbar', ['title' => 'Kelola Siswa', 'subtitle' => 'Data Siswa SMK Bakti Nusantara 666'])

    <div class="container mx-auto px-4 py-4 md:py-8 max-w-6xl">
        <main class="glass-card rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-8 mb-8" data-aos="fade-up">

            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Data Siswa</h2>
                    <p class="text-gray-600">Kelola data siswa SMK Bakti Nusantara 666</p>
                </div>

            </div>
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Search & Filter -->
            <form method="GET" class="mb-6">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 flex">
                        <div class="relative flex-1">
                            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari siswa..." class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-lg transition-colors border border-blue-600">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <select name="jurusan" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Jurusan</option>
                        <option value="Pemasaran" {{ ($jurusan ?? '') == 'Pemasaran' ? 'selected' : '' }}>Pemasaran</option>
                        <option value="Animasi" {{ ($jurusan ?? '') == 'Animasi' ? 'selected' : '' }}>Animasi</option>
                        <option value="Desain Komunikasi Visual" {{ ($jurusan ?? '') == 'Desain Komunikasi Visual' ? 'selected' : '' }}>Desain Komunikasi Visual</option>
                        <option value="Pengembangan Perangkat Lunak dan Gim" {{ ($jurusan ?? '') == 'Pengembangan Perangkat Lunak dan Gim' ? 'selected' : '' }}>Pengembangan Perangkat Lunak dan Gim</option>
                        <option value="Akuntansi" {{ ($jurusan ?? '') == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                    </select>
                    <select name="sort" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Urutkan</option>
                        <option value="nama_asc" {{ ($sort ?? '') == 'nama_asc' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="nama_desc" {{ ($sort ?? '') == 'nama_desc' ? 'selected' : '' }}>Nama Z-A</option>
                    </select>
                    <button type="button" id="filterBtn" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                        <i class="fas fa-filter mr-2"></i>Filter
                    </button>
                </div>
            </form>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full bg-white rounded-lg shadow">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poin</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="siswaTableBody">
                        @forelse($siswa as $s)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $s->nis }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $s->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $s->kelas }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $s->jurusan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    @if($s->poin_pelanggaran == 0) bg-green-100 text-green-800
                                    @elseif($s->poin_pelanggaran <= 25) bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ $s->poin_pelanggaran }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($s->user_id)
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1"></i>Ada Akun
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-500">
                                        <i class="fas fa-times mr-1"></i>Belum Ada
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex gap-2">
                                    <button onclick="openModal('{{ $s->id }}', '{{ $s->nama }}', '{{ $s->nis }}', '{{ $s->kelas }}')" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-xs transition-colors">
                                        <i class="fas fa-cog mr-1"></i>Kelola
                                    </button>
                                    <button onclick="openDetailModal('{{ $s->id }}', '{{ $s->nama }}', '{{ $s->nis }}', '{{ $s->kelas }}')" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-lg text-xs transition-colors">
                                        <i class="fas fa-eye mr-1"></i>Detail
                                    </button>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data siswa
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Show More Button -->
            <div class="mt-6 text-center">
                <div class="text-sm text-gray-700 mb-4" id="counterText">
                    Menampilkan {{ $siswa->count() }} dari {{ $filteredTotal }} siswa
                    @if(isset($search) || isset($jurusan))
                        ({{ $totalSiswa }} total siswa)
                    @endif
                </div>
                @if($siswa->count() < $filteredTotal)
                <button id="showMoreBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                    <i class="fas fa-plus mr-2"></i>Tampilkan Lebih Banyak
                </button>
                @endif
            </div>

        </main>
    </div>

    <!-- Modal Kelola Siswa -->
    <div id="kelolaModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Kelola Siswa</h3>
                        <p class="text-gray-600" id="siswaInfo">Tambah pelanggaran atau prestasi</p>
                    </div>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <!-- Form -->
                <form id="kelolaForm" method="POST" action="{{ route('admin.kelola-siswa') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="siswa_id" name="siswa_id">
                    
                    <!-- Tipe -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe</label>
                        <div class="flex gap-4">
                            <label class="flex items-center">
                                <input type="radio" name="tipe" value="pelanggaran" class="mr-2" onchange="toggleForm()" checked>
                                <span class="text-red-600 font-medium">Pelanggaran</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="tipe" value="prestasi" class="mr-2" onchange="toggleForm()">
                                <span class="text-green-600 font-medium">Prestasi</span>
                            </label>
                        </div>
                    </div>

                    <!-- Pilihan Pelanggaran -->
                    <div id="pelanggaranSection" class="mb-6">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Pelanggaran</label>
                            <select id="kategori_pelanggaran" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="filterJenisPelanggaran()">
                                <option value="">Pilih Kategori</option>
                                @foreach(App\Models\JenisPelanggaran::getKategoriOptions() as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Pelanggaran</label>
                            <select name="jenis_pelanggaran_id" id="jenis_pelanggaran_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" disabled>
                                <option value="">Pilih kategori terlebih dahulu</option>
                            </select>
                        </div>
                    </div>

                    <!-- Pilihan Prestasi -->
                    <div id="prestasiSection" class="mb-6 hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Prestasi</label>
                        <select name="prestasi_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Pilih Jenis Prestasi</option>
                            @foreach(App\Models\Prestasi::orderBy('kategori')->orderBy('poin_pengurangan', 'desc')->get() as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }} (-{{ $p->poin_pengurangan }} poin)</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Bukti Gambar (hanya untuk pelanggaran) -->
                    <div id="buktiGambarSection" class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Bukti Gambar <span class="text-red-500">*</span>
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
                            <input type="file" name="bukti_gambar" id="bukti_gambar" accept="image/*" class="hidden" required>
                            <div id="uploadArea" class="cursor-pointer" onclick="document.getElementById('bukti_gambar').click()">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                <p class="text-gray-600 mb-1">Klik untuk upload bukti gambar</p>
                                <p class="text-sm text-gray-500">Format: JPG, PNG (Max: 2MB)</p>
                            </div>
                            <div id="previewArea" class="hidden">
                                <img id="imagePreview" class="max-w-full h-32 object-cover rounded-lg mx-auto mb-2">
                                <p id="fileName" class="text-sm text-gray-600 mb-2"></p>
                                <button type="button" onclick="removeImage()" class="text-red-500 hover:text-red-700 text-sm">
                                    <i class="fas fa-trash mr-1"></i>Hapus
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Catatan -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                        <textarea name="catatan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3">
                        <button type="button" onclick="closeModal()" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg font-medium transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium transition-colors">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Detail Siswa -->
    <div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Detail Siswa</h3>
                        <p class="text-gray-600" id="detailSiswaInfo">Catatan pelanggaran siswa</p>
                    </div>
                    <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <!-- Loading -->
                <div id="detailLoading" class="text-center py-8">
                    <div class="spinner mx-auto mb-4"></div>
                    <p class="text-gray-600">Memuat data pelanggaran...</p>
                </div>

                <!-- Content -->
                <div id="detailContent" class="hidden">
                    <!-- Profil Siswa -->
                    <div id="siswaProfile" class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 mb-6 border border-blue-200">
                        <h4 class="text-lg font-bold text-gray-800 mb-4">Profil Siswa</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <i class="fas fa-id-card text-blue-600 w-5 mr-3"></i>
                                    <div>
                                        <span class="text-sm text-gray-600">NIS:</span>
                                        <span id="profileNis" class="font-medium text-gray-800 ml-2">-</span>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-user text-blue-600 w-5 mr-3"></i>
                                    <div>
                                        <span class="text-sm text-gray-600">Nama:</span>
                                        <span id="profileNama" class="font-medium text-gray-800 ml-2">-</span>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-venus-mars text-blue-600 w-5 mr-3"></i>
                                    <div>
                                        <span class="text-sm text-gray-600">Jenis Kelamin:</span>
                                        <span id="profileJenisKelamin" class="font-medium text-gray-800 ml-2">-</span>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-birthday-cake text-blue-600 w-5 mr-3"></i>
                                    <div>
                                        <span class="text-sm text-gray-600">TTL:</span>
                                        <span id="profileTtl" class="font-medium text-gray-800 ml-2">-</span>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <i class="fas fa-school text-blue-600 w-5 mr-3"></i>
                                    <div>
                                        <span class="text-sm text-gray-600">Kelas:</span>
                                        <span id="profileKelas" class="font-medium text-gray-800 ml-2">-</span>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-graduation-cap text-blue-600 w-5 mr-3"></i>
                                    <div>
                                        <span class="text-sm text-gray-600">Jurusan:</span>
                                        <span id="profileJurusan" class="font-medium text-gray-800 ml-2">-</span>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-map-marker-alt text-blue-600 w-5 mr-3"></i>
                                    <div>
                                        <span class="text-sm text-gray-600">Alamat:</span>
                                        <span id="profileAlamat" class="font-medium text-gray-800 ml-2">-</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    <!-- Riwayat Pelanggaran -->
                    <div>
                        <h4 class="text-lg font-bold text-gray-800 mb-4">Riwayat Pelanggaran</h4>
                        <div id="pelanggaranList" class="space-y-4">
                            <!-- Data pelanggaran akan dimuat di sini -->
                        </div>
                    </div>
                </div>
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
        
        let currentOffset = {{ $siswa->count() }};
        const currentSearch = '{{ $search ?? '' }}';
        const currentJurusan = '{{ $jurusan ?? '' }}';
        const currentSort = '{{ $sort ?? '' }}';
        
        document.getElementById('showMoreBtn')?.addEventListener('click', function() {
            const btn = this;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Loading...';
            btn.disabled = true;
            
            const params = new URLSearchParams({
                offset: currentOffset,
                search: currentSearch,
                jurusan: currentJurusan,
                sort: currentSort
            });
            
            fetch(`/siswa/load-more-siswa?${params}`)
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('siswaTableBody');
                    
                    if (data.siswa && data.siswa.length > 0) {
                        data.siswa.forEach(siswa => {
                            let poinClass = 'bg-green-100 text-green-800';
                            if (siswa.poin_pelanggaran > 25) poinClass = 'bg-red-100 text-red-800';
                            else if (siswa.poin_pelanggaran > 0) poinClass = 'bg-yellow-100 text-yellow-800';
                            
                            const row = `
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${siswa.nis}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${siswa.nama}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${siswa.kelas}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${siswa.jurusan}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full ${poinClass}">
                                            ${siswa.poin_pelanggaran}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        ${siswa.user_id ? 
                                            `<span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                                <i class="fas fa-check mr-1"></i>Ada Akun
                                            </span>` :
                                            `<span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-500">
                                                <i class="fas fa-times mr-1"></i>Belum Ada
                                            </span>`
                                        }
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex gap-2">
                                            <button onclick="openModal('${siswa.id}', '${siswa.nama}', '${siswa.nis}', '${siswa.kelas}')" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-xs transition-colors">
                                                <i class="fas fa-cog mr-1"></i>Kelola
                                            </button>
                                            <button onclick="openDetailModal('${siswa.id}', '${siswa.nama}', '${siswa.nis}', '${siswa.kelas}')" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-lg text-xs transition-colors">
                                                <i class="fas fa-eye mr-1"></i>Detail
                                            </button>

                                        </div>
                                    </td>
                            `;
                            const newRow = document.createElement('tr');
                            newRow.innerHTML = row;
                            tbody.appendChild(newRow);
                        });
                        
                        currentOffset += data.siswa.length;
                        
                        // Update counter
                        const counterElement = document.getElementById('counterText');
                        if (counterElement) {
                            const totalSiswa = {{ $totalSiswa }};
                            const filteredTotal = {{ $filteredTotal }};
                            const totalText = (currentSearch || currentJurusan) ? 
                                `Menampilkan ${currentOffset} dari ${filteredTotal} siswa (${totalSiswa} total siswa)` :
                                `Menampilkan ${currentOffset} dari ${filteredTotal} siswa`;
                            counterElement.textContent = totalText;
                        }
                    }
                    
                    if (!data.hasMore) {
                        btn.style.display = 'none';
                    } else {
                        btn.innerHTML = '<i class="fas fa-plus mr-2"></i>Tampilkan Lebih Banyak';
                        btn.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    btn.innerHTML = '<i class="fas fa-plus mr-2"></i>Tampilkan Lebih Banyak';
                    btn.disabled = false;
                });
        });
        
        // Loading overlay functions
        function showLoading() {
            document.getElementById('loadingOverlay').style.display = 'flex';
        }
        
        function hideLoading() {
            document.getElementById('loadingOverlay').style.display = 'none';
        }
        
        // Auto-submit form on input change with debounce
        const searchInput = document.querySelector('input[name="search"]');
        const jurusanSelect = document.querySelector('select[name="jurusan"]');
        const form = document.querySelector('form');
        
        let searchTimeout;
        
        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    showLoading();
                    setTimeout(() => {
                        form.submit();
                    }, 1000);
                }
            });
        }
        
        // Removed auto-submit on jurusan change
        
        // Handle search button
        const searchButton = document.querySelector('button[type="submit"]');
        if (searchButton) {
            searchButton.addEventListener('click', function(e) {
                e.preventDefault();
                showLoading();
                setTimeout(() => {
                    form.submit();
                }, 1000);
            });
        }
        
        // Handle filter button
        const filterBtn = document.getElementById('filterBtn');
        if (filterBtn) {
            filterBtn.addEventListener('click', function() {
                showLoading();
                setTimeout(() => {
                    form.submit();
                }, 1000);
            });
        }
        
        // Modal functions
        function openModal(siswaId, nama, nis, kelas) {
            document.getElementById('kelolaModal').classList.remove('hidden');
            document.getElementById('siswa_id').value = siswaId;
            document.getElementById('siswaInfo').textContent = `${nama} (${nis}) - ${kelas}`;
            document.body.style.overflow = 'hidden';
        }
        
        function closeModal() {
            document.getElementById('kelolaModal').classList.add('hidden');
            document.getElementById('kelolaForm').reset();
            document.body.style.overflow = 'auto';
            toggleForm();
        }
        
        function toggleForm() {
            const tipe = document.querySelector('input[name="tipe"]:checked').value;
            const pelanggaranSection = document.getElementById('pelanggaranSection');
            const prestasiSection = document.getElementById('prestasiSection');
            const buktiGambarSection = document.getElementById('buktiGambarSection');
            const buktiGambarInput = document.getElementById('bukti_gambar');
            
            if (tipe === 'pelanggaran') {
                pelanggaranSection.classList.remove('hidden');
                prestasiSection.classList.add('hidden');
                buktiGambarSection.classList.remove('hidden');
                buktiGambarInput.required = true;
            } else {
                pelanggaranSection.classList.add('hidden');
                prestasiSection.classList.remove('hidden');
                buktiGambarSection.classList.add('hidden');
                buktiGambarInput.required = false;
                removeImage();
            }
        }
        
        // Handle image upload preview
        document.getElementById('bukti_gambar').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB.');
                    e.target.value = '';
                    return;
                }
                
                // Validate file type
                if (!file.type.startsWith('image/')) {
                    alert('File harus berupa gambar.');
                    e.target.value = '';
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('fileName').textContent = file.name;
                    document.getElementById('uploadArea').classList.add('hidden');
                    document.getElementById('previewArea').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
        
        function removeImage() {
            document.getElementById('bukti_gambar').value = '';
            document.getElementById('uploadArea').classList.remove('hidden');
            document.getElementById('previewArea').classList.add('hidden');
        }
        
        // Close modal when clicking outside
        document.getElementById('kelolaModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
        
        // Detail modal functions
        function openDetailModal(siswaId, nama, nis, kelas) {
            document.getElementById('detailModal').classList.remove('hidden');
            document.getElementById('detailSiswaInfo').textContent = `${nama} (${nis}) - ${kelas}`;
            document.getElementById('detailLoading').classList.remove('hidden');
            document.getElementById('detailContent').classList.add('hidden');
            document.body.style.overflow = 'hidden';
            
            // Load siswa and pelanggaran data
            fetch(`/siswa/siswa/${siswaId}/pelanggaran`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('detailLoading').classList.add('hidden');
                    document.getElementById('detailContent').classList.remove('hidden');
                    
                    // Populate siswa profile
                    const siswa = data.siswa;
                    document.getElementById('profileNis').textContent = siswa.nis || '-';
                    document.getElementById('profileNama').textContent = siswa.nama || '-';
                    document.getElementById('profileJenisKelamin').textContent = siswa.jenis_kelamin === 'L' ? 'Laki-laki' : siswa.jenis_kelamin === 'P' ? 'Perempuan' : '-';
                    
                    const ttl = (siswa.tempat_lahir || '') + (siswa.tanggal_lahir ? ', ' + new Date(siswa.tanggal_lahir).toLocaleDateString('id-ID') : '');
                    document.getElementById('profileTtl').textContent = ttl || '-';
                    
                    document.getElementById('profileKelas').textContent = siswa.kelas || '-';
                    document.getElementById('profileJurusan').textContent = siswa.jurusan || '-';
                    document.getElementById('profileAlamat').textContent = siswa.alamat || '-';
                    
                    const pelanggaranList = document.getElementById('pelanggaranList');
                    pelanggaranList.innerHTML = '';
                    
                    if (data.pelanggaran && data.pelanggaran.length > 0) {
                        data.pelanggaran.forEach(p => {
                            const pelanggaranCard = `
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="font-semibold text-gray-800">${p.jenis_pelanggaran?.nama_pelanggaran || 'Pelanggaran'}</h4>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full ${
                                            p.jenis_pelanggaran?.poin <= 5 ? 'bg-yellow-100 text-yellow-800' :
                                            p.jenis_pelanggaran?.poin <= 15 ? 'bg-orange-100 text-orange-800' :
                                            'bg-red-100 text-red-800'
                                        }">
                                            ${p.jenis_pelanggaran?.poin || 0} Poin
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-2">${p.jenis_pelanggaran?.deskripsi || ''}</p>
                                    <div class="flex justify-between items-center text-xs text-gray-500">
                                        <span><i class="fas fa-calendar mr-1"></i>${new Date(p.created_at).toLocaleDateString('id-ID')}</span>
                                        <span class="px-2 py-1 rounded-full ${
                                            p.status === 'selesai' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'
                                        }">
                                            ${p.status === 'selesai' ? 'Selesai' : 'Pending'}
                                        </span>
                                    </div>
                                    ${p.keterangan ? `<p class="text-sm text-gray-600 mt-2 italic">Catatan: ${p.keterangan}</p>` : ''}
                                    ${p.bukti_gambar ? `
                                        <div class="mt-2">
                                            <button onclick="showImage('${p.bukti_gambar}', '${p.jenis_pelanggaran?.nama_pelanggaran || 'Pelanggaran'}')" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs transition-colors">
                                                <i class="fas fa-eye mr-1"></i>Lihat Bukti
                                            </button>
                                        </div>
                                    ` : ''}
                                </div>
                            `;
                            pelanggaranList.innerHTML += pelanggaranCard;
                        });
                    } else {
                        pelanggaranList.innerHTML = `
                            <div class="text-center py-8">
                                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-check text-green-600 text-2xl"></i>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-2">Tidak Ada Pelanggaran</h4>
                                <p class="text-gray-600">Siswa ini memiliki catatan yang bersih!</p>
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('detailLoading').classList.add('hidden');
                    document.getElementById('detailContent').classList.remove('hidden');
                    document.getElementById('pelanggaranList').innerHTML = `
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-800 mb-2">Error</h4>
                            <p class="text-gray-600">Gagal memuat data pelanggaran</p>
                        </div>
                    `;
                });
        }
        
        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        function showImage(imageSrc, title) {
            // Create image modal if not exists
            let imageModal = document.getElementById('imageModal');
            if (!imageModal) {
                imageModal = document.createElement('div');
                imageModal.id = 'imageModal';
                imageModal.className = 'fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center p-4';
                imageModal.innerHTML = `
                    <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
                        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                            <h3 id="imageTitle" class="text-lg font-bold text-gray-800">Bukti Pelanggaran</h3>
                            <button onclick="closeImageModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="p-4 text-center">
                            <img id="modalImage" class="max-w-full max-h-[70vh] object-contain mx-auto rounded-lg" src="" alt="Bukti Pelanggaran">
                        </div>
                    </div>
                `;
                document.body.appendChild(imageModal);
            }
            
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageTitle').textContent = 'Bukti: ' + title;
            imageModal.classList.remove('hidden');
        }
        
        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }
        
        // Close detail modal when clicking outside
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDetailModal();
            }
        });
        
        // Filter jenis pelanggaran by category
        const allPelanggaran = @json(App\Models\JenisPelanggaran::orderBy('kategori')->orderBy('poin')->get());
        
        function filterJenisPelanggaran() {
            const kategori = document.getElementById('kategori_pelanggaran').value;
            const jenisSelect = document.getElementById('jenis_pelanggaran_id');
            
            jenisSelect.innerHTML = '<option value="">Pilih jenis pelanggaran</option>';
            
            if (kategori) {
                jenisSelect.disabled = false;
                const filteredPelanggaran = allPelanggaran.filter(p => p.kategori === kategori);
                
                filteredPelanggaran.forEach(p => {
                    const option = document.createElement('option');
                    option.value = p.id;
                    option.textContent = `${p.nama_pelanggaran} (${p.poin} poin)`;
                    jenisSelect.appendChild(option);
                });
            } else {
                jenisSelect.disabled = true;
                jenisSelect.innerHTML = '<option value="">Pilih kategori terlebih dahulu</option>';
            }
        }
        

    </script>

</body>
</html>