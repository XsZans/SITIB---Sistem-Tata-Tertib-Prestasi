<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Prestasi Anak - SiTib</title>
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

    @include('layouts.orang-tua-navbar', ['title' => 'Data Prestasi Anak', 'subtitle' => 'Riwayat Prestasi Anak'])

    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Header -->
        <div class="glass-card rounded-2xl shadow-xl p-6 mb-8" data-aos="fade-up">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Data Prestasi Anak</h1>
                    <p class="text-gray-600">Riwayat prestasi yang diraih anak</p>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold text-green-600">{{ $prestasi->count() }}</div>
                    <div class="text-sm text-gray-600">Total Prestasi</div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="glass-card rounded-2xl shadow-xl p-6 mb-8" data-aos="fade-up" data-aos-delay="100">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">Filter Data</h3>
                <div class="flex gap-2">
                    <a href="{{ route('orang_tua.prestasi') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ !request('status') ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        <i class="fas fa-list mr-1"></i>Semua
                    </a>
                    <a href="{{ route('orang_tua.prestasi', ['status' => 'diverifikasi']) }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request('status') == 'diverifikasi' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        <i class="fas fa-check-circle mr-1"></i>Diverifikasi
                    </a>
                </div>
            </div>
        </div>

        <!-- Prestasi Table -->
        <div class="glass-card rounded-2xl shadow-xl overflow-hidden" data-aos="fade-up" data-aos-delay="200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Daftar Prestasi</h2>
                    @if(request('status'))
                        <span class="text-sm text-gray-600">Filter: {{ ucfirst(request('status')) }}</span>
                    @endif
                </div>
            </div>
            
            @if($prestasi->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Prestasi</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelapor</th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($prestasi as $index => $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-alt text-gray-400 mr-2"></i>
                                    <div class="text-sm text-gray-900">{{ $item->tanggal_prestasi ? $item->tanggal_prestasi->format('d/m/Y') : $item->created_at->format('d/m/Y') }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                    {{ $item->prestasi->nama ?? 'Tidak diketahui' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $item->keterangan }}">
                                    {{ $item->keterangan ?: '-' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i class="fas fa-user-tie text-gray-400 mr-2"></i>
                                    <div class="text-sm text-gray-900">{{ $item->user->name ?? 'Tidak diketahui' }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($item->status == 'menunggu_verifikasi')
                                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i>Menunggu
                                    </span>
                                @elseif($item->status == 'diverifikasi')
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>Diverifikasi
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i>Ditolak
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="p-12 text-center">
                <div class="text-gray-500">
                    <i class="fas fa-trophy text-6xl mb-4 text-yellow-500"></i>
                    <p class="text-xl font-medium mb-2">Belum ada prestasi</p>
                    <p class="text-sm">Anak Anda belum memiliki catatan prestasi. Semangat untuk meraih prestasi!</p>
                </div>
            </div>
            @endif
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
    </script>

</body>
</html>