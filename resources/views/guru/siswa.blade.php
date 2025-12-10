<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Siswa - Dashboard Guru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
    </style>
</head>
<body class="gradient-bg">

    @include('layouts.guru-navbar', ['title' => 'Sistem Tata Tertib & Prestasi', 'subtitle' => 'Kelola Siswa'])

    <div class="container mx-auto px-4 py-8 max-w-7xl">
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3 text-green-600"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg shadow-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-3 text-red-600"></i>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        </div>
        @endif

        <!-- Main Content -->
        <main class="glass-card rounded-2xl shadow-xl p-6 mb-8">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Kelola Siswa</h2>
                    <p class="text-gray-600">Lihat dan kelola data siswa sekolah</p>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="mb-6 flex flex-col md:flex-row gap-4">
                <form method="GET" class="flex-1 flex gap-2">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, NIS, atau kelas..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <select name="sort" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <option value="">Urutkan</option>
                        <option value="nama_asc" {{ $sort == 'nama_asc' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="nama_desc" {{ $sort == 'nama_desc' ? 'selected' : '' }}>Nama Z-A</option>
                        <option value="poin_desc" {{ $sort == 'poin_desc' ? 'selected' : '' }}>Poin Tertinggi</option>
                    </select>
                    <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Students Table -->
            <div class="overflow-x-auto">
                <table class="w-full bg-white rounded-lg shadow">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poin</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($siswa as $s)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $s->nis }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $s->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $s->kelas }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $s->jurusan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex gap-1">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        {{ $s->poin_pelanggaran }}
                                    </span>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $s->poin_prestasi ?? 0 }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="openPelanggaranModal({{ $s->id }}, '{{ $s->nama }}')" class="text-red-600 hover:text-red-900 mr-3">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>Input Pelanggaran
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-users text-4xl text-gray-300 mb-2"></i>
                                    <span>Tidak ada data siswa</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Modal Input Pelanggaran -->
    <div id="pelanggaranModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Input Pelanggaran</h3>
                    <p id="siswaName" class="text-gray-600 text-sm"></p>
                </div>
                <button onclick="closePelanggaranModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form action="{{ route('guru.store-pelanggaran') }}" method="POST">
                @csrf
                <input type="hidden" id="siswaId" name="siswa_id">
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Pelanggaran</label>
                        <select id="kategori" onchange="loadJenisPelanggaran()" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <option value="">Pilih Kategori</option>
                            <option value="I-Kepribadian">I-Kepribadian</option>
                            <option value="II-Kerajinan">II-Kerajinan</option>
                            <option value="III-Kerapian">III-Kerapian</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Pelanggaran</label>
                        <select name="jenis_pelanggaran_id" id="jenisPelanggaran" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" disabled>
                            <option value="">Pilih kategori terlebih dahulu</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan (Opsional)</label>
                        <textarea name="keterangan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Keterangan tambahan..."></textarea>
                    </div>
                </div>
                
                <div class="flex gap-3 mt-6">
                    <button type="button" onclick="closePelanggaranModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-lg transition-all duration-300 shadow-lg">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openPelanggaranModal(siswaId, siswaName) {
            document.getElementById('pelanggaranModal').classList.remove('hidden');
            document.getElementById('siswaId').value = siswaId;
            document.getElementById('siswaName').textContent = 'Siswa: ' + siswaName;
        }
        
        function closePelanggaranModal() {
            document.getElementById('pelanggaranModal').classList.add('hidden');
            document.getElementById('kategori').value = '';
            document.getElementById('jenisPelanggaran').innerHTML = '<option value="">Pilih kategori terlebih dahulu</option>';
            document.getElementById('jenisPelanggaran').disabled = true;
        }
        
        async function loadJenisPelanggaran() {
            const kategori = document.getElementById('kategori').value;
            const jenisPelanggaranSelect = document.getElementById('jenisPelanggaran');
            
            if (!kategori) {
                jenisPelanggaranSelect.innerHTML = '<option value="">Pilih kategori terlebih dahulu</option>';
                jenisPelanggaranSelect.disabled = true;
                return;
            }
            
            try {
                const response = await fetch(`{{ route('guru.get-jenis-pelanggaran') }}?kategori=${kategori}`);
                const data = await response.json();
                
                jenisPelanggaranSelect.innerHTML = '<option value="">Pilih jenis pelanggaran</option>';
                
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = `${item.nama_pelanggaran} (${item.poin} poin)`;
                    jenisPelanggaranSelect.appendChild(option);
                });
                
                jenisPelanggaranSelect.disabled = false;
            } catch (error) {
                console.error('Error loading jenis pelanggaran:', error);
            }
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