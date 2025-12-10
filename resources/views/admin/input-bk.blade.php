<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Input BK - SiTib Admin</title>
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

    @include('layouts.admin-navbar', ['title' => 'Input BK', 'subtitle' => 'Panggil Siswa untuk Sesi BK'])

    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Header -->
        <div class="glass-card rounded-2xl shadow-xl p-6 mb-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Input BK</h1>
                    <p class="text-gray-600">Panggil siswa untuk sesi bimbingan konseling</p>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold text-purple-600">{{ $guruBk->count() }}</div>
                    <div class="text-sm text-gray-600">Guru BK Tersedia</div>
                </div>
            </div>
        </div>

        <!-- Form Input BK -->
        <div class="glass-card rounded-2xl shadow-xl p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Panggil Siswa untuk Sesi BK</h2>
            
            <form action="{{ route('admin.store-bk') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="guru_bk_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Pilih Guru BK <span class="text-red-500">*</span>
                        </label>
                        <select name="guru_bk_id" id="guru_bk_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                            <option value="">-- Pilih Guru BK --</option>
                            @foreach($guruBk as $guru)
                                <option value="{{ $guru->id }}">{{ $guru->nama }} - {{ $guru->nip }}</option>
                            @endforeach
                        </select>
                        @error('guru_bk_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="siswa_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Pilih Siswa <span class="text-red-500">*</span>
                        </label>
                        
                        <!-- Filter Controls -->
                        <div class="mb-3 flex gap-2">
                            <input type="text" id="searchSiswa" placeholder="Cari nama siswa..." class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <select id="filterKelas" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                                <option value="">Semua Kelas</option>
                                @foreach($kelasList as $kelas)
                                    <option value="{{ $kelas }}">{{ $kelas }}</option>
                                @endforeach
                            </select>
                            <button type="button" onclick="resetFilter()" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-2 rounded-lg text-sm">
                                <i class="fas fa-refresh"></i>
                            </button>
                        </div>
                        
                        <select name="siswa_id" id="siswa_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach($siswaList as $siswa)
                                <option value="{{ $siswa->id }}" data-nama="{{ strtolower($siswa->nama) }}" data-kelas="{{ $siswa->kelas }}">{{ $siswa->nama }} - {{ $siswa->kelas }}</option>
                            @endforeach
                        </select>
                        @error('siswa_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label for="alasan" class="block text-sm font-medium text-gray-700 mb-2">
                        Alasan Panggilan BK <span class="text-red-500">*</span>
                    </label>
                    <textarea name="alasan" id="alasan" rows="4" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Masukkan alasan mengapa siswa dipanggil untuk sesi BK..." required></textarea>
                    @error('alasan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="jadwal_bk" class="block text-sm font-medium text-gray-700 mb-2">
                        Jadwal BK <span class="text-red-500">*</span>
                    </label>
                    <input type="datetime-local" name="jadwal_bk" id="jadwal_bk" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    @error('jadwal_bk')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3 mt-8">
                    <a href="{{ route('admin.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                        Batal
                    </a>
                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg">
                        <i class="fas fa-paper-plane mr-2"></i>Panggil untuk BK
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Card -->
        <div class="glass-card rounded-2xl shadow-xl p-6 mt-8">
            <div class="flex items-start space-x-4">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-info text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Informasi Input BK</h3>
                    <ul class="text-gray-600 space-y-1 text-sm">
                        <li>• Admin dapat memanggil siswa untuk sesi BK dengan guru BK tertentu</li>
                        <li>• Siswa akan menerima notifikasi panggilan BK</li>
                        <li>• Guru BK akan menerima notifikasi ada siswa yang dipanggil</li>
                        <li>• Jadwal BK harus diisi untuk koordinasi waktu</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Set minimum datetime to now
        document.addEventListener('DOMContentLoaded', function() {
            const now = new Date();
            now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
            document.getElementById('jadwal_bk').min = now.toISOString().slice(0, 16);
        });
        
        // Filter siswa
        function filterSiswa() {
            const searchText = document.getElementById('searchSiswa').value.toLowerCase();
            const filterKelas = document.getElementById('filterKelas').value;
            const select = document.getElementById('siswa_id');
            const options = select.querySelectorAll('option');
            
            options.forEach(option => {
                if (option.value === '') {
                    option.style.display = 'block';
                    return;
                }
                
                const nama = option.dataset.nama || '';
                const kelas = option.dataset.kelas || '';
                
                const matchNama = nama.includes(searchText);
                const matchKelas = filterKelas === '' || kelas === filterKelas;
                
                if (matchNama && matchKelas) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
        }
        
        function resetFilter() {
            document.getElementById('searchSiswa').value = '';
            document.getElementById('filterKelas').value = '';
            filterSiswa();
        }
        
        // Event listeners
        document.getElementById('searchSiswa').addEventListener('input', filterSiswa);
        document.getElementById('filterKelas').addEventListener('change', filterSiswa);
    </script>

</body>
</html>