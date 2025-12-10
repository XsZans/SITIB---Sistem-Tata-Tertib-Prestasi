<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Guru</title>
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
    </style>
</head>
<body class="gradient-bg">

    @include('layouts.guru-navbar', ['title' => 'Sistem Tata Tertib & Prestasi', 'subtitle' => 'Profile Guru', 'guru' => $guru])

    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Profile Card -->
        <div class="glass-card rounded-2xl p-8 mb-8" data-aos="fade-up">
            <div class="text-center mb-8">
                <div class="w-24 h-24 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chalkboard-teacher text-orange-600 text-3xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $guru->nama }}</h1>
                <p class="text-orange-600 font-medium">{{ $guru->mata_pelajaran ?? 'Guru' }}</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-id-card text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">NIP</p>
                            <p class="font-semibold text-gray-800">{{ $guru->nip }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-venus-mars text-orange-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Jenis Kelamin</p>
                            <p class="font-semibold text-gray-800">{{ $guru->jenis_kelamin === 'L' ? 'Laki-laki' : ($guru->jenis_kelamin === 'P' ? 'Perempuan' : 'Tidak ada data') }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-book text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Bidang Tugas</p>
                            <p class="font-semibold text-gray-800">{{ $guru->mata_pelajaran ?? 'Tidak ada data' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-school text-purple-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Wali Kelas</p>
                            <p class="font-semibold text-gray-800">{{ $guru->wali_kelas ?? 'Bukan Wali Kelas' }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-briefcase text-yellow-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Jabatan</p>
                            <p class="font-semibold text-gray-800">
                                @php
                                    $jabatanLabels = [
                                        'kepala_sekolah' => 'Kepala Sekolah',
                                        'kesiswaan' => 'Kesiswaan',
                                        'guru_bk' => 'Guru BK',
                                        'wali_kelas' => 'Wali Kelas',
                                        'guru' => 'Guru'
                                    ];
                                @endphp
                                {{ $jabatanLabels[$guru->jabatan] ?? 'Guru' }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-calendar text-teal-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Tempat, Tanggal Lahir</p>
                            <p class="font-semibold text-gray-800">
                                {{ $guru->tempat_lahir ?? 'Tidak ada data' }}, 
                                {{ $guru->tanggal_lahir ? date('d F Y', strtotime($guru->tanggal_lahir)) : 'Tidak ada data' }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-phone text-red-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">No. Telepon</p>
                            <p class="font-semibold text-gray-800">{{ $guru->no_hp ?: '081234567890' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-map-marker-alt text-indigo-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Alamat</p>
                            <p class="font-semibold text-gray-800">{{ $guru->alamat ?: 'Jl. Pendidikan No. 123, Cimahi' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Account Info -->
        <div class="glass-card rounded-2xl p-8" data-aos="fade-up" data-aos-delay="200">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Informasi Akun</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-user text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Username</p>
                        <p class="font-semibold text-gray-800">{{ auth()->user()->username }}</p>
                    </div>
                </div>
                
                <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-shield-alt text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Role</p>
                        <p class="font-semibold text-gray-800">Guru</p>
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
    </script>

</body>
</html>