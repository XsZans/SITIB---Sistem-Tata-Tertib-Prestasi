<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kelola Guru - SiTib Admin</title>
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

    @include('layouts.siswa-navbar', ['title' => 'Data Guru', 'subtitle' => 'Informasi Data Guru & Wali Kelas'])

    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Header -->
        <div class="glass-card rounded-2xl shadow-xl p-6 mb-8" data-aos="fade-up">
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
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Data Guru</h1>
                    <p class="text-gray-600">Informasi data guru dan wali kelas</p>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold text-purple-600">{{ $guru->count() }}</div>
                    <div class="text-sm text-gray-600">Total Guru</div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8" data-aos="fade-up" data-aos-delay="200">
            <div class="glass-card rounded-xl p-6 text-center">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-chalkboard-teacher text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-1">Total Guru</h3>
                <p class="text-2xl font-bold text-purple-600">{{ $guru->count() }}</p>
            </div>
            
            <div class="glass-card rounded-xl p-6 text-center">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-1">Wali Kelas</h3>
                <p class="text-2xl font-bold text-blue-600">{{ $guru->whereNotNull('wali_kelas')->count() }}</p>
            </div>
            
            <div class="glass-card rounded-xl p-6 text-center">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-book text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-1">Mata Pelajaran</h3>
                <p class="text-2xl font-bold text-green-600">{{ $guru->pluck('mata_pelajaran')->unique()->count() }}</p>
            </div>
        </div>

        <!-- Guru Table -->
        <div class="glass-card rounded-2xl shadow-xl overflow-hidden" data-aos="fade-up" data-aos-delay="400">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Daftar Guru</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Guru</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIP</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Wali Kelas</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status User</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="guruTableBody">
                        @forelse($guru as $index => $g)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-white text-xs"></i>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">{{ $g->nama }}</div>
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $g->nip }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                    {{ $g->mata_pelajaran }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                @if($g->wali_kelas)
                                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                        <i class="fas fa-users mr-1"></i>{{ $g->wali_kelas }}
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-500">
                                        -
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                @if($g->user_id)
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1"></i>Ada Akun
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-500">
                                        <i class="fas fa-times mr-1"></i>Belum Ada
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                <button onclick="openGuruDetail({{ $g->id }})" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-xs transition-colors">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="text-gray-500">
                                    <i class="fas fa-chalkboard-teacher text-4xl mb-4"></i>
                                    <p class="text-lg font-medium">Belum ada data guru</p>
                                    <p class="text-sm">Data guru akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Show More Button -->
            <div class="p-6 text-center border-t border-gray-200">
                <div class="text-sm text-gray-700 mb-4" id="guruCounterText">
                    Menampilkan {{ $guru->count() }} dari {{ $totalGuru }} guru
                </div>
                @if($guru->count() < $totalGuru)
                <button id="showMoreGuruBtn" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                    <i class="fas fa-plus mr-2"></i>Tampilkan Lebih Banyak
                </button>
                @endif
            </div>
        </div>

        <!-- Wali Kelas Section -->
        <div class="glass-card rounded-2xl shadow-xl p-6 mt-8" data-aos="fade-up" data-aos-delay="600">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Daftar Wali Kelas per Kelas</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($guru->whereNotNull('wali_kelas')->groupBy('wali_kelas') as $kelas => $walikelas)
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-4">
                    <div class="flex items-center mb-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-door-open text-white text-sm"></i>
                        </div>
                        <h3 class="font-semibold text-blue-800">{{ $kelas }}</h3>
                    </div>
                    @foreach($walikelas as $wali)
                    <div class="flex items-center">
                        <i class="fas fa-user text-blue-600 mr-2"></i>
                        <span class="text-sm text-blue-700">{{ $wali->nama }}</span>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal Detail Guru -->
    <div id="guruDetailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Detail Guru</h3>
                    <button onclick="closeGuruDetail()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div id="guruDetailContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>



    <!-- AOS Animation Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });
        
        // Guru Detail Modal
        async function openGuruDetail(guruId) {
            try {
                const response = await fetch(`/siswa/guru/${guruId}`);
                const guru = await response.json();
                
                const content = `
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h4 class="font-semibold text-gray-800 mb-2">Informasi Pribadi</h4>
                                <div class="space-y-2 text-sm">
                                    <div><span class="font-medium">Nama:</span> ${guru.nama}</div>
                                    <div><span class="font-medium">NIP:</span> ${guru.nip}</div>
                                    <div><span class="font-medium">Jenis Kelamin:</span> ${guru.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}</div>
                                    <div><span class="font-medium">TTL:</span> ${guru.tempat_lahir || '-'}, ${guru.tanggal_lahir ? new Date(guru.tanggal_lahir).toLocaleDateString('id-ID') : '-'}</div>
                                </div>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h4 class="font-semibold text-gray-800 mb-2">Informasi Kerja</h4>
                                <div class="space-y-2 text-sm">
                                    <div><span class="font-medium">Mata Pelajaran:</span> ${guru.mata_pelajaran}</div>
                                    <div><span class="font-medium">Wali Kelas:</span> ${guru.wali_kelas || '-'}</div>
                                    <div><span class="font-medium">Tanggal Masuk:</span> ${guru.tanggal_masuk_kerja ? new Date(guru.tanggal_masuk_kerja).toLocaleDateString('id-ID') : '-'}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                document.getElementById('guruDetailContent').innerHTML = content;
                document.getElementById('guruDetailModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } catch (error) {
                console.error('Error loading guru detail:', error);
                alert('Gagal memuat detail guru');
            }
        }
        
        function closeGuruDetail() {
            document.getElementById('guruDetailModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        

        
        // Close modal when clicking outside
        document.getElementById('guruDetailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeGuruDetail();
            }
        });
        

        
        // Load More Guru functionality
        let currentGuruOffset = {{ $guru->count() }};
        const totalGuru = {{ $totalGuru }};
        
        document.getElementById('showMoreGuruBtn')?.addEventListener('click', function() {
            const btn = this;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Loading...';
            btn.disabled = true;
            
            fetch(`/siswa/load-more-guru?offset=${currentGuruOffset}`)
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('guruTableBody');
                    
                    if (data.guru && data.guru.length > 0) {
                        data.guru.forEach((guru, index) => {
                            const row = `
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">${currentGuruOffset + index + 1}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mr-3">
                                                <i class="fas fa-user text-white text-xs"></i>
                                            </div>
                                            <div class="text-sm font-medium text-gray-900">${guru.nama}</div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">${guru.nip}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                            ${guru.mata_pelajaran}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        ${guru.wali_kelas ? 
                                            `<span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800"><i class="fas fa-users mr-1"></i>${guru.wali_kelas}</span>` :
                                            `<span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-500">-</span>`
                                        }
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        ${guru.user_id ? 
                                            `<span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800"><i class="fas fa-check mr-1"></i>Ada Akun</span>` :
                                            `<span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-500"><i class="fas fa-times mr-1"></i>Belum Ada</span>`
                                        }
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-center">
                                        <button onclick="openGuruDetail(${guru.id})" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-xs transition-colors">
                                            <i class="fas fa-eye"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                            `;
                            const newRow = document.createElement('tr');
                            newRow.innerHTML = row;
                            tbody.appendChild(newRow);
                        });
                        
                        currentGuruOffset += data.guru.length;
                        
                        // Update counter
                        document.getElementById('guruCounterText').textContent = `Menampilkan ${currentGuruOffset} dari ${totalGuru} guru`;
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
    </script>

</body>
</html>