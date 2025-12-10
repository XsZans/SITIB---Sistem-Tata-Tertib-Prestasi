<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Input BK - Sistem Bimbingan Konseling</title>
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

    @include('layouts.bk-navbar', ['title' => 'Input BK', 'subtitle' => 'Sistem Bimbingan Konseling'])
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Input BK</h1>
        <a href="{{ route('bk.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
            Kembali
        </a>
    </div>
    
    <!-- Filter dan Search -->
    <div class="glass-card rounded-lg shadow p-4 mb-6">
        <div class="flex items-center mb-3">
            <i class="fas fa-filter text-blue-600 mr-2"></i>
            <h3 class="text-lg font-semibold text-gray-800">Filter & Pencarian Siswa</h3>
        </div>
        <form id="filter-form" method="GET" action="{{ route('bk.input') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Cari Siswa</label>
                <div class="relative">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Nama atau NIS siswa..." 
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                <select name="kelas" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Kelas</option>
                    @foreach($kelasList as $kelasItem)
                    <option value="{{ $kelasItem }}" {{ $kelas === $kelasItem ? 'selected' : '' }}>{{ $kelasItem }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
                <select name="jurusan" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Jurusan</option>
                    @foreach($jurusanList as $jurusanItem)
                    <option value="{{ $jurusanItem }}" {{ $jurusan === $jurusanItem ? 'selected' : '' }}>{{ $jurusanItem }}</option>
                    @endforeach
                </select>
            </div>
        </form>
        <div class="flex gap-2 mt-4">
            <button type="submit" form="filter-form" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                <i class="fas fa-search mr-1"></i>Cari
            </button>
            <a href="{{ route('bk.input') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors">
                <i class="fas fa-refresh mr-1"></i>Reset
            </a>
        </div>
    </div>

    @if($search || $kelas || $jurusan)
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
        <div class="flex items-center">
            <i class="fas fa-info-circle text-blue-600 mr-2"></i>
            <span class="text-blue-800">
                Menampilkan {{ $siswaList->count() }} siswa
                @if($search) dengan pencarian "{{ $search }}" @endif
                @if($kelas) di kelas {{ $kelas }} @endif
                @if($jurusan) jurusan {{ $jurusan }} @endif
            </span>
        </div>
    </div>
    @endif
    
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('bk.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="siswa_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Pilih Siswa ({{ $siswaList->count() }} siswa ditemukan)
                </label>
                <select name="siswa_id" id="siswa_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Pilih Siswa --</option>
                    @forelse($siswaList as $siswa)
                        <option value="{{ $siswa->id }}">{{ $siswa->nama }} - {{ $siswa->kelas }} ({{ $siswa->nis }})</option>
                    @empty
                        <option value="" disabled>Tidak ada siswa ditemukan</option>
                    @endforelse
                </select>
                @error('siswa_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="alasan" class="block text-sm font-medium text-gray-700 mb-2">
                    Alasan Panggilan BK
                </label>
                <textarea name="alasan" id="alasan" rows="4" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan alasan panggilan BK..." required></textarea>
                @error('alasan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jadwal_bk" class="block text-sm font-medium text-gray-700 mb-2">
                    Jadwal BK
                </label>
                <input type="datetime-local" name="jadwal_bk" id="jadwal_bk" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('jadwal_bk')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('bk.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                    Batal
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg">
                    Buat Panggilan BK
                </button>
            </div>
        </form>
    </div>


</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum datetime to now
    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    document.getElementById('jadwal_bk').min = now.toISOString().slice(0, 16);
    
    // Auto submit form when filter changes
    const filterForm = document.getElementById('filter-form');
    const kelasSelect = document.querySelector('select[name="kelas"]');
    const jurusanSelect = document.querySelector('select[name="jurusan"]');
    
    if (kelasSelect && filterForm) {
        kelasSelect.addEventListener('change', function() {
            filterForm.submit();
        });
    }
    
    if (jurusanSelect && filterForm) {
        jurusanSelect.addEventListener('change', function() {
            filterForm.submit();
        });
    }
});


</script>

</body>
</html>