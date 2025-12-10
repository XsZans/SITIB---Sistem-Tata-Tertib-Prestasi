<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Orang Tua - Sistem Tata Tertib & Prestasi</title>
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

    @if($isKesiswaan ?? false)
        @include('layouts.kesiswaan-navbar', ['title' => 'Kelola Orang Tua', 'subtitle' => 'Data Orang Tua Siswa'])
    @else
        @include('layouts.admin-navbar', ['title' => 'Kelola Orang Tua', 'subtitle' => 'Data Orang Tua Siswa'])
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
        
        <main class="glass-card rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-8 mb-8" data-aos="fade-up">

            <!-- Header -->
            <div class="text-center mb-8 md:mb-12" data-aos="fade-up" data-aos-delay="200">
                <div class="inline-block p-3 md:p-4 bg-gradient-to-br from-yellow-500 to-amber-600 rounded-xl md:rounded-2xl mb-4 md:mb-6 shadow-lg">
                    <i class="fas fa-users text-white text-2xl md:text-3xl"></i>
                </div>
                <h2 class="text-2xl md:text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-3 md:mb-4">
                    Kelola Data Orang Tua
                </h2>
                <p class="text-gray-600 max-w-3xl mx-auto text-sm md:text-lg leading-relaxed">
                    Kelola data orang tua siswa untuk komunikasi dan koordinasi
                </p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-8 md:mb-12" data-aos="fade-up" data-aos-delay="300">
                
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl md:rounded-2xl p-4 md:p-6 hover-lift text-center">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-users text-white text-lg md:text-2xl"></i>
                    </div>
                    <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Total Siswa</p>
                    <p class="text-xl md:text-2xl font-bold text-blue-700">{{ $totalSiswa }}</p>
                </div>
                
                <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl md:rounded-2xl p-4 md:p-6 hover-lift text-center">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-check-circle text-white text-lg md:text-2xl"></i>
                    </div>
                    <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Data Lengkap</p>
                    <p class="text-xl md:text-2xl font-bold text-green-700">{{ $siswaWithOrangTua }}</p>
                </div>
                
                <div class="bg-gradient-to-br from-red-50 to-red-100 border border-red-200 rounded-xl md:rounded-2xl p-4 md:p-6 hover-lift text-center">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-exclamation-triangle text-white text-lg md:text-2xl"></i>
                    </div>
                    <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Belum Lengkap</p>
                    <p class="text-xl md:text-2xl font-bold text-red-700">{{ $siswaWithoutOrangTua }}</p>
                </div>
            </div>

            <!-- Siswa List -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" data-aos="fade-up" data-aos-delay="400">
                @foreach($siswa as $s)
                <div class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-2">
                        <h4 class="font-semibold text-gray-800 text-sm">{{ $s->nama }}</h4>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $s->orangTua ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $s->orangTua ? 'Lengkap' : 'Belum' }}
                        </span>
                    </div>
                    <p class="text-gray-600 text-xs mb-3">{{ $s->nis }} - {{ $s->kelas }}</p>
                    <div class="flex justify-between items-center">
                        <div class="text-xs text-gray-500">
                            @if($s->orangTua)
                                <div>Ayah: {{ $s->orangTua->nama_ayah }}</div>
                                <div>Ibu: {{ $s->orangTua->nama_ibu }}</div>
                            @else
                                <div class="text-red-500">Data belum lengkap</div>
                            @endif
                        </div>
                        <button onclick="openOrangTuaModal({{ $s->id }})" class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded text-xs transition-colors">
                            <i class="fas fa-{{ $s->orangTua ? 'edit' : 'plus' }} mr-1"></i>{{ $s->orangTua ? 'Edit' : 'Tambah' }}
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

        </main>
    </div>

    <!-- Modal Orang Tua -->
    <div id="orangTuaModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 id="modalTitle" class="text-2xl font-bold text-gray-800">Data Orang Tua</h3>
                    <button onclick="closeOrangTuaModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            
            <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
                <form id="orangTuaForm" method="POST" action="{{ route($isKesiswaan ? 'kesiswaan.kelola-orang-tua' : 'admin.kelola-orang-tua') }}">
                    @csrf
                    <input type="hidden" id="siswaId" name="siswa_id">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ayah</label>
                        <input type="text" id="namaAyah" name="nama_ayah" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ibu</label>
                        <input type="text" id="namaIbu" name="nama_ibu" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">No. HP</label>
                        <input type="text" id="noHp" name="no_hp" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                        <textarea id="alamat" name="alamat" required rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan Ayah</label>
                        <input type="text" id="pekerjaanAyah" name="pekerjaan_ayah" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan Ibu</label>
                        <input type="text" id="pekerjaanIbu" name="pekerjaan_ibu" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div class="flex gap-3">
                        <button type="button" onclick="closeOrangTuaModal()" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg font-medium transition-colors">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });
        
        async function openOrangTuaModal(siswaId) {
            document.getElementById('orangTuaModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            try {
                const response = await fetch(`{{ $isKesiswaan ? '/kesiswaan' : '/admin' }}/get-orang-tua/${siswaId}`);
                const data = await response.json();
                
                document.getElementById('modalTitle').textContent = `Data Orang Tua - ${data.nama}`;
                document.getElementById('siswaId').value = siswaId;
                
                if (data.orang_tua) {
                    document.getElementById('namaAyah').value = data.orang_tua.nama_ayah || '';
                    document.getElementById('namaIbu').value = data.orang_tua.nama_ibu || '';
                    document.getElementById('noHp').value = data.orang_tua.no_hp || '';
                    document.getElementById('alamat').value = data.orang_tua.alamat || '';
                    document.getElementById('pekerjaanAyah').value = data.orang_tua.pekerjaan_ayah || '';
                    document.getElementById('pekerjaanIbu').value = data.orang_tua.pekerjaan_ibu || '';
                } else {
                    document.getElementById('orangTuaForm').reset();
                    document.getElementById('siswaId').value = siswaId;
                }
            } catch (error) {
                console.error('Error loading data:', error);
            }
        }
        
        function closeOrangTuaModal() {
            document.getElementById('orangTuaModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            document.getElementById('orangTuaForm').reset();
        }
        
        document.getElementById('orangTuaModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeOrangTuaModal();
            }
        });
    </script>

</body>
</html>