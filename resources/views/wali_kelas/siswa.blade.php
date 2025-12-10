<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa Kelas {{ $guru->wali_kelas }}</title>
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

    @include('layouts.wali-kelas-navbar', ['title' => 'Sistem Tata Tertib & Prestasi', 'subtitle' => 'Siswa Kelas ' . $guru->wali_kelas, 'guru' => $guru])

    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Header -->
        <div class="glass-card rounded-2xl p-6 mb-8" data-aos="fade-up">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Siswa Kelas {{ $guru->wali_kelas }}</h1>
                    <p class="text-gray-600">Total: {{ $siswa->count() }} siswa</p>
                </div>
                <div class="flex gap-3">
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Cari siswa..." 
                               class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                               value="{{ $search }}">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <select id="sortSelect" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="">Urutkan</option>
                        <option value="nama_asc" {{ $sort === 'nama_asc' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="nama_desc" {{ $sort === 'nama_desc' ? 'selected' : '' }}>Nama Z-A</option>
                        <option value="poin_desc" {{ $sort === 'poin_desc' ? 'selected' : '' }}>Poin Tertinggi</option>
                    </select>
                    <button onclick="openPelanggaranModal()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-plus mr-2"></i>Catat Pelanggaran
                    </button>
                </div>
            </div>
        </div>

        <!-- Siswa Table -->
        <div class="glass-card rounded-2xl p-6" data-aos="fade-up" data-aos-delay="200">
            <div class="overflow-x-auto">
                <table class="w-full bg-white rounded-lg shadow">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-red-600 uppercase tracking-wider">Poin</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-green-600 uppercase tracking-wider">Poin</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($siswa as $s)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $s->nis }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $s->nama }}
                                @if($s->jumlah_pelanggaran > 0)
                                    <span class="ml-1 text-red-600 font-bold">({{ $s->jumlah_pelanggaran }})</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $s->jenis_kelamin === 'L' ? 'Laki-laki' : ($s->jenis_kelamin === 'P' ? 'Perempuan' : '-') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $s->jurusan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    {{ $s->poin_pelanggaran }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $s->poin_prestasi ?? 0 }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <div class="max-w-xs truncate" title="{{ $s->alamat }}">
                                    {{ $s->alamat ?: '-' }}
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-users text-gray-400 text-2xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Tidak Ada Siswa</h3>
                                <p class="text-gray-600">
                                    @if($search)
                                        Tidak ditemukan siswa dengan kata kunci "{{ $search }}"
                                    @else
                                        Belum ada siswa di kelas {{ $guru->wali_kelas }}
                                    @endif
                                </p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Pelanggaran -->
    <div id="pelanggaranModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Tambah Pelanggaran</h3>
                    <button onclick="closePelanggaranModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="pelanggaranForm" method="POST" action="{{ route('wali_kelas.store-pelanggaran') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Siswa</label>
                        <select name="siswa_id" id="siswa_select" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                            <option value="">Pilih Siswa</option>
                            @foreach($siswa as $s)
                            <option value="{{ $s->id }}">{{ $s->nama }} - {{ $s->nis }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Pelanggaran</label>
                        <select id="kategori_select" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" onchange="loadJenisPelanggaran()">
                            <option value="">Pilih Kategori</option>
                            <option value="I">I - Kepribadian</option>
                            <option value="II">II - Kerajinan</option>
                            <option value="III">III - Kerapian</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Pelanggaran</label>
                        <select name="jenis_pelanggaran_id" id="jenis_pelanggaran_select" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required disabled>
                            <option value="">Pilih kategori terlebih dahulu</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                        <textarea name="keterangan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Keterangan pelanggaran..."></textarea>
                    </div>
                    
                    <div class="flex gap-3">
                        <button type="button" onclick="closePelanggaranModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            <i class="fas fa-plus mr-2"></i>Tambah
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
        
        // Search and sort functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            updateUrl();
        });
        
        document.getElementById('sortSelect').addEventListener('change', function() {
            updateUrl();
        });
        
        function updateUrl() {
            const search = document.getElementById('searchInput').value;
            const sort = document.getElementById('sortSelect').value;
            
            const params = new URLSearchParams();
            if (search) params.set('search', search);
            if (sort) params.set('sort', sort);
            
            const url = '{{ route("wali_kelas.siswa") }}' + (params.toString() ? '?' + params.toString() : '');
            window.location.href = url;
        }
        
        // Modal functions
        function openPelanggaranModal() {
            document.getElementById('pelanggaranModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        async function loadJenisPelanggaran() {
            const kategori = document.getElementById('kategori_select').value;
            const jenisSelect = document.getElementById('jenis_pelanggaran_select');
            
            jenisSelect.innerHTML = '<option value="">Pilih Jenis Pelanggaran</option>';
            
            if (!kategori) {
                jenisSelect.disabled = true;
                jenisSelect.innerHTML = '<option value="">Pilih kategori terlebih dahulu</option>';
                return;
            }
            
            jenisSelect.disabled = false;
            
            try {
                const response = await fetch(`/wali-kelas/get-jenis-pelanggaran?kategori=${kategori}`);
                const data = await response.json();
                
                if (data.length > 0) {
                    data.forEach(jp => {
                        const option = document.createElement('option');
                        option.value = jp.id;
                        option.textContent = `${jp.nama_pelanggaran} (${jp.poin} poin)`;
                        jenisSelect.appendChild(option);
                    });
                } else {
                    jenisSelect.innerHTML = '<option value="">Tidak ada pelanggaran dalam kategori ini</option>';
                }
            } catch (error) {
                console.error('Error loading jenis pelanggaran:', error);
                jenisSelect.innerHTML = '<option value="">Error loading data</option>';
            }
        }
        
        function closePelanggaranModal() {
            document.getElementById('pelanggaranModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            document.getElementById('pelanggaranForm').reset();
        }
        
        // Close modal when clicking outside
        document.getElementById('pelanggaranModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePelanggaranModal();
            }
        });
    </script>

</body>
</html>