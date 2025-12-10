<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelaksanaan Sanksi - SiTib</title>
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

    @include('layouts.admin-navbar', ['title' => 'Pelaksanaan Sanksi', 'subtitle' => 'Siswa yang Memerlukan Sanksi'])

    <div class="container mx-auto px-4 py-4 md:py-8 max-w-6xl">
        <main class="glass-card rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-8 mb-8" data-aos="fade-up">

            <!-- Header -->
            <div class="text-center mb-8 md:mb-12" data-aos="fade-up" data-aos-delay="200">
                <div class="inline-block p-3 md:p-4 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl md:rounded-2xl mb-4 md:mb-6 shadow-lg">
                    <i class="fas fa-gavel text-white text-2xl md:text-3xl"></i>
                </div>
                <h2 class="text-2xl md:text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-3 md:mb-4">
                    Pelaksanaan Sanksi
                </h2>
                <p class="text-gray-600 max-w-3xl mx-auto text-sm md:text-lg leading-relaxed">
                    Daftar siswa yang memiliki poin pelanggaran dan perlu menjalani sanksi
                </p>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-8 md:mb-12" data-aos="fade-up" data-aos-delay="300">
                
                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 border border-yellow-200 rounded-xl md:rounded-2xl p-4 md:p-6 hover-lift text-center">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-exclamation-triangle text-white text-lg md:text-2xl"></i>
                    </div>
                    <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Sanksi Ringan</p>
                    <p class="text-xl md:text-2xl font-bold text-yellow-700">{{ $sanksiRingan }}</p>
                    <p class="text-xs text-gray-500 mt-1">1-5 Poin</p>
                </div>
                
                <div class="bg-gradient-to-br from-orange-50 to-orange-100 border border-orange-200 rounded-xl md:rounded-2xl p-4 md:p-6 hover-lift text-center">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-exclamation-circle text-white text-lg md:text-2xl"></i>
                    </div>
                    <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Sanksi Sedang</p>
                    <p class="text-xl md:text-2xl font-bold text-orange-700">{{ $sanksiSedang }}</p>
                    <p class="text-xs text-gray-500 mt-1">6-15 Poin</p>
                </div>
                
                <div class="bg-gradient-to-br from-red-50 to-red-100 border border-red-200 rounded-xl md:rounded-2xl p-4 md:p-6 hover-lift text-center">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                        <i class="fas fa-ban text-white text-lg md:text-2xl"></i>
                    </div>
                    <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Sanksi Berat</p>
                    <p class="text-xl md:text-2xl font-bold text-red-700">{{ $sanksiBerat }}</p>
                    <p class="text-xs text-gray-500 mt-1">≥16 Poin</p>
                </div>
            </div>

            <!-- Informasi Sanksi -->
            <div class="bg-gradient-to-br from-gray-50 to-gray-100 border border-gray-200 rounded-2xl p-6 mb-8" data-aos="fade-up" data-aos-delay="400">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-blue-500 mr-3"></i>
                    Informasi Sanksi
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-xl p-4 border border-yellow-200">
                        <h4 class="font-semibold text-yellow-700 mb-2 flex items-center">
                            <i class="fas fa-exclamation-triangle text-yellow-500 mr-2"></i>
                            Sanksi Ringan (1-5 Poin)
                        </h4>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Teguran lisan</li>
                            <li>• Peringatan tertulis</li>
                        </ul>
                        <p class="text-xs text-gray-500 mt-2 font-medium">Penanggung Jawab: Guru BK</p>
                    </div>
                    <div class="bg-white rounded-xl p-4 border border-orange-200">
                        <h4 class="font-semibold text-orange-700 mb-2 flex items-center">
                            <i class="fas fa-exclamation-circle text-orange-500 mr-2"></i>
                            Sanksi Sedang (6-15 Poin)
                        </h4>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Peringatan tertulis + panggilan orang tua</li>
                            <li>• Skorsing 1-3 hari</li>
                        </ul>
                        <p class="text-xs text-gray-500 mt-2 font-medium">Penanggung Jawab: Guru BK + Kesiswaan</p>
                    </div>
                    <div class="bg-white rounded-xl p-4 border border-red-200">
                        <h4 class="font-semibold text-red-700 mb-2 flex items-center">
                            <i class="fas fa-ban text-red-500 mr-2"></i>
                            Sanksi Berat (≥16 Poin)
                        </h4>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Dikembalikan kepada orang tua + pembinaan 1 bulan (16-90)</li>
                            <li>• Dikeluarkan dari sekolah (>90)</li>
                        </ul>
                        <p class="text-xs text-gray-500 mt-2 font-medium">Penanggung Jawab: Kepala Sekolah + BK + Kesiswaan</p>
                        <div class="mt-3">
                            <a href="{{ route('admin.pelanggaran') }}" class="text-blue-500 hover:text-blue-700 text-xs underline">
                                <i class="fas fa-info-circle mr-1"></i>Lihat Detail Sanksi Lengkap
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Siswa Sanksi Cards -->
            <div class="space-y-4 md:space-y-6" data-aos="fade-up" data-aos-delay="400">
                @forelse($siswaSanksi as $siswa)
                    <div class="bg-white rounded-xl md:rounded-2xl p-4 md:p-6 shadow-lg border border-gray-100 hover-lift">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="flex-1">
                                <div class="flex items-start gap-3 md:gap-4">
                                    <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-{{ $siswa->poin_pelanggaran >= 16 ? 'red' : ($siswa->poin_pelanggaran >= 6 ? 'orange' : 'yellow') }}-500 to-{{ $siswa->poin_pelanggaran >= 16 ? 'red' : ($siswa->poin_pelanggaran >= 6 ? 'orange' : 'yellow') }}-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-user text-white text-sm md:text-base"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1 md:mb-2">
                                            <h4 class="text-base md:text-lg font-bold text-gray-800">{{ $siswa->nama }}</h4>
                                            <span class="px-3 py-1 text-sm font-bold rounded-full {{ $siswa->poin_pelanggaran >= 16 ? 'bg-red-100 text-red-800' : ($siswa->poin_pelanggaran >= 6 ? 'bg-orange-100 text-orange-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                {{ $siswa->poin_pelanggaran }} Poin
                                            </span>
                                        </div>
                                        <div class="flex flex-wrap items-center gap-2 mb-2 md:mb-3">
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                                {{ $siswa->nis }}
                                            </span>
                                            <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">
                                                {{ $siswa->kelas }}
                                            </span>
                                            <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">
                                                {{ $siswa->jurusan }}
                                            </span>
                                        </div>
                                        <div class="flex items-center gap-2 mb-2">
                                            @if($siswa->poin_pelanggaran >= 1 && $siswa->poin_pelanggaran <= 5)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                                    Sanksi Ringan
                                                </span>
                                            @elseif($siswa->poin_pelanggaran >= 6 && $siswa->poin_pelanggaran <= 15)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                                    Sanksi Sedang
                                                </span>
                                            @elseif($siswa->poin_pelanggaran >= 16)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <i class="fas fa-ban mr-1"></i>
                                                    Sanksi Berat
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-600 mb-2">
                                            <strong>Pelanggaran:</strong>
                                            @if($siswa->pelanggaran && $siswa->pelanggaran->count() > 0)
                                                <ul class="mt-1 text-xs space-y-2">
                                                    @foreach($siswa->pelanggaran->take(3) as $p)
                                                        <li class="flex items-center justify-between gap-2">
                                                            <div class="flex-1">
                                                                <span class="text-gray-500">• 
                                                                    @if($p->jenisPelanggaran)
                                                                        {{ $p->jenisPelanggaran->nama_pelanggaran }}
                                                                    @else
                                                                        [ID: {{ $p->jenis_pelanggaran_id ?? 'NULL' }}] Pelanggaran
                                                                    @endif
                                                                </span> 
                                                                @php
                                                                    $poin = $p->jenisPelanggaran ? $p->jenisPelanggaran->poin : 0;
                                                                    $kategori = $p->jenisPelanggaran ? $p->jenisPelanggaran->kategori : null;
                                                                @endphp
                                                                @if($poin <= 5)
                                                                    <span class="text-yellow-600 font-medium">({{ $poin }})</span>
                                                                @elseif($poin <= 15)
                                                                    <span class="text-orange-600 font-medium">({{ $poin }})</span>
                                                                @else
                                                                    <span class="text-red-600 font-medium">({{ $poin }})</span>
                                                                @endif
                                                                @if($kategori)
                                                                    <span class="ml-1 px-1.5 py-0.5 text-xs rounded-full 
                                                                        @if($kategori == 'I') bg-blue-100 text-blue-700
                                                                        @elseif($kategori == 'II') bg-purple-100 text-purple-700
                                                                        @else bg-indigo-100 text-indigo-700 @endif">
                                                                        {{ $kategori }}
                                                                    </span>
                                                                @endif
                                                                <div class="text-xs text-gray-400 mt-1">
                                                                    <i class="fas fa-calendar mr-1"></i>Dilaporkan: {{ $p->created_at->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }} WIB
                                                                    @if($p->pengadu)
                                                                        <br><i class="fas fa-user mr-1"></i>Pengadu: {{ $p->pengadu->name }} ({{ ucfirst($p->pengadu->role) }})
                                                                    @elseif($p->user)
                                                                        <br><i class="fas fa-user mr-1"></i>Pengadu: {{ $p->user->name }} ({{ ucfirst($p->user->role) }})
                                                                    @endif
                                                                    @if($p->verifikator && $p->tanggal_verifikasi)
                                                                        <br><i class="fas fa-check-circle mr-1 text-green-500"></i>Diverifikasi: {{ $p->verifikator->name }} ({{ ucfirst($p->verifikator->role) }}) - {{ $p->tanggal_verifikasi->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }} WIB
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @if($p->bukti_gambar)
                                                                <button onclick="showImage('{{ asset($p->bukti_gambar) }}', '{{ $p->jenisPelanggaran ? $p->jenisPelanggaran->nama_pelanggaran : 'Pelanggaran' }}')" 
                                                                        class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-xs transition-colors">
                                                                    <i class="fas fa-eye mr-1"></i>Lihat Bukti
                                                                </button>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                    @if($siswa->pelanggaran->count() > 3)
                                                        <li class="text-gray-400">• +{{ $siswa->pelanggaran->count() - 3 }} pelanggaran lainnya</li>
                                                    @endif
                                                </ul>
                                            @else
                                                <span class="text-xs text-gray-400 mt-1">Tidak ada data pelanggaran (Total: {{ $siswa->pelanggaran ? $siswa->pelanggaran->count() : 'NULL' }})</span>
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-600 mb-2">
                                            <strong>Jenis Sanksi:</strong>
                                            @if($siswa->poin_pelanggaran >= 1 && $siswa->poin_pelanggaran <= 5)
                                                <span class="text-green-600">Dicatat dan konseling</span>
                                            @elseif($siswa->poin_pelanggaran >= 6 && $siswa->poin_pelanggaran <= 10)
                                                <span class="text-yellow-600">Peringatan lisan</span>
                                            @elseif($siswa->poin_pelanggaran >= 11 && $siswa->poin_pelanggaran <= 15)
                                                <span class="text-yellow-600">Peringatan tertulis dengan perjanjian</span>
                                            @elseif($siswa->poin_pelanggaran >= 16 && $siswa->poin_pelanggaran <= 20)
                                                <span class="text-red-600">Panggilan orang tua dengan perjanjian di atas materai</span>
                                            @elseif($siswa->poin_pelanggaran >= 21 && $siswa->poin_pelanggaran <= 25)
                                                <span class="text-red-600">Perjanjian orang tua dengan perjanjian di atas materai</span>
                                            @elseif($siswa->poin_pelanggaran >= 26 && $siswa->poin_pelanggaran <= 30)
                                                <span class="text-red-600">Skors 3 hari</span>
                                            @elseif($siswa->poin_pelanggaran >= 31 && $siswa->poin_pelanggaran <= 35)
                                                <span class="text-red-600">Skors 7 hari</span>
                                            @elseif($siswa->poin_pelanggaran >= 36 && $siswa->poin_pelanggaran <= 40)
                                                <span class="text-red-600">Diserahkan kepada ortu untuk dibina dalam jangka waktu 2 minggu</span>
                                            @elseif($siswa->poin_pelanggaran >= 41 && $siswa->poin_pelanggaran <= 89)
                                                <span class="text-red-600">Diserahkan dan dibina ortu jangka waktu 1 bulan</span>
                                            @elseif($siswa->poin_pelanggaran >= 90)
                                                <span class="text-red-900 font-bold">Dikembalikan kepada orang tua (Drop Out dari sekolah)</span>
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            @if($siswa->poin_pelanggaran >= 1 && $siswa->poin_pelanggaran <= 5)
                                                <div class="text-xs text-gray-500 mt-1">
                                                    <i class="fas fa-user-tie mr-1"></i>
                                                    Penanggung Jawab: Guru BK
                                                </div>
                                            @elseif($siswa->poin_pelanggaran >= 6 && $siswa->poin_pelanggaran <= 15)
                                                <div class="text-xs text-gray-500 mt-1">
                                                    <i class="fas fa-user-friends mr-1"></i>
                                                    Penanggung Jawab: Guru BK + Kesiswaan
                                                </div>
                                            @elseif($siswa->poin_pelanggaran >= 16)
                                                <div class="text-xs text-gray-500 mt-1">
                                                    <i class="fas fa-users mr-1"></i>
                                                    Penanggung Jawab: Kepala Sekolah + BK + Kesiswaan
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Garis Vertikal Pemisah -->
                            <div class="hidden md:block w-px bg-gray-300 self-stretch mx-4"></div>
                            <div class="flex flex-col items-center gap-3 md:gap-4">
                                <span class="px-3 py-1 text-sm font-bold rounded-full bg-gray-100 text-gray-800">Aksi</span>
                                <div class="flex flex-col gap-2">
                                    <form action="{{ route('admin.proses-sanksi') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                                        <button type="submit" class="w-full bg-gradient-to-r from-orange-600 to-red-700 hover:from-orange-700 hover:to-red-800 text-white px-3 md:px-4 py-2 rounded-lg text-xs md:text-sm font-medium transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                            <i class="fas fa-gavel mr-1 md:mr-2"></i>Proses Sanksi
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.hapus-pelanggaran') }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus semua pelanggaran {{ $siswa->nama }}? Tindakan ini tidak dapat dibatalkan!')">
                                        @csrf
                                        <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                                        <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-3 md:px-4 py-2 rounded-lg text-xs md:text-sm font-medium transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                            <i class="fas fa-trash mr-1 md:mr-2"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-check text-green-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Tidak Ada Siswa yang Perlu Sanksi</h3>
                        <p class="text-gray-600">Semua siswa memiliki catatan yang baik!</p>
                    </div>
                @endforelse
            </div>

        </main>
    </div>

    <!-- Modal Bukti Gambar -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center p-4">
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
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });
        
        function showImage(imageSrc, title) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageTitle').textContent = 'Bukti: ' + title;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        // Close modal when clicking outside
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });
    </script>

</body>
</html>