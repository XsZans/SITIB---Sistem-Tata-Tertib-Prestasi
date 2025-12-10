<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Storage Laporan - Dashboard Guru</title>
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

    @include('layouts.guru-navbar', ['title' => 'Storage Laporan', 'subtitle' => 'Dashboard Guru'])

    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Header -->
        <div class="glass-card rounded-2xl shadow-xl p-6 mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Storage Laporan</h1>
                    <p class="text-gray-600">Laporan yang sudah diverifikasi dan siap diunduh</p>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold text-green-600">{{ $approvedReports->count() }}</div>
                    <div class="text-sm text-gray-600">Laporan Tersedia</div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="glass-card rounded-xl p-6 text-center">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-check-circle text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-1">Total Diverifikasi</h3>
                <p class="text-2xl font-bold text-green-600">{{ $approvedReports->count() }}</p>
            </div>
            
            <div class="glass-card rounded-xl p-6 text-center">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-download text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-1">Siap Download</h3>
                <p class="text-2xl font-bold text-blue-600">{{ $approvedReports->count() }}</p>
            </div>
            
            <div class="glass-card rounded-xl p-6 text-center">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-calendar text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-1">Bulan Ini</h3>
                <p class="text-2xl font-bold text-purple-600">{{ $approvedReports->where('verified_at', '>=', now()->startOfMonth())->count() }}</p>
            </div>
        </div>

        <!-- Laporan Table -->
        <div class="glass-card rounded-2xl shadow-xl overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Laporan Terverifikasi</h2>
            </div>
            
            @if($approvedReports->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diverifikasi</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Verifikator</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($approvedReports as $index => $report)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-user text-white text-xs"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $report->siswa->nama }}</div>
                                            <div class="text-sm text-gray-500">{{ $report->siswa->kelas }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        @if($report->periode === 'semua') bg-gray-100 text-gray-800
                                        @elseif($report->periode === 'bulan') bg-blue-100 text-blue-800
                                        @else bg-green-100 text-green-800
                                        @endif">
                                        @if($report->periode === 'semua')
                                            Semua Data
                                        @elseif($report->periode === 'bulan')
                                            {{ DateTime::createFromFormat('!m', $report->bulan)->format('F') }} {{ $report->tahun }}
                                        @else
                                            Tahun {{ $report->tahun }}
                                        @endif
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $report->verified_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $report->verifikator->name ?? '-' }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-center">
                                    <button onclick="autoDownload({{ $report->id }}, '{{ $report->siswa->nama }}')" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                                        <i class="fas fa-download mr-1"></i>Auto Download
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-12 text-center">
                    <div class="text-gray-500">
                        <i class="fas fa-folder-open text-6xl mb-4"></i>
                        <p class="text-xl font-medium mb-2">Belum Ada Laporan Terverifikasi</p>
                        <p class="text-sm">Laporan yang sudah diverifikasi akan muncul di sini</p>
                        <a href="{{ route('guru.laporan') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                            <i class="fas fa-plus mr-1"></i>Request Laporan
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Info Card -->
        <div class="glass-card rounded-2xl shadow-xl p-6 mt-8">
            <div class="flex items-start space-x-4">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-info text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Informasi Storage</h3>
                    <ul class="text-gray-600 space-y-1 text-sm">
                        <li>• Laporan yang sudah diverifikasi admin akan muncul di sini</li>
                        <li>• Klik "Auto Download" untuk langsung mengunduh laporan PDF</li>
                        <li>• Laporan berisi data pelanggaran siswa yang sudah selesai</li>
                        <li>• File PDF akan otomatis terunduh ke perangkat Anda</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        function autoDownload(reportId, siswaName) {
            // Show loading state
            const button = event.target.closest('button');
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Downloading...';
            button.disabled = true;
            
            // Create a temporary link and trigger download
            const link = document.createElement('a');
            link.href = `{{ url('/guru/storage/download') }}/${reportId}`;
            link.download = `laporan-${siswaName.toLowerCase().replace(/\s+/g, '-')}.pdf`;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            // Show success message
            setTimeout(() => {
                button.innerHTML = '<i class="fas fa-check mr-1"></i>Downloaded';
                button.className = 'bg-green-600 text-white px-4 py-2 rounded-lg text-sm';
                
                // Reset button after 3 seconds
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.className = 'bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm transition-colors';
                    button.disabled = false;
                }, 3000);
            }, 1000);
        }
    </script>

</body>
</html>