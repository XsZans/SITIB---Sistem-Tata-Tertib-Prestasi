<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Siswa - Sistem Tata Tertib</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 50%, #cbd5e1 100%); min-height: 100vh; }
        .glass-card { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); }
    </style>
</head>
<body class="gradient-bg">

    @include('layouts.guru-navbar', ['title' => 'Laporan Siswa', 'subtitle' => 'Request & Download Laporan'])

    <div class="container mx-auto px-4 py-8 max-w-6xl">
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
        @endif

        <!-- Request Laporan -->
        <div class="glass-card rounded-2xl shadow-xl p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Request Laporan Siswa</h2>
            
            <form action="{{ route('guru.request-laporan') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Siswa</label>
                        <select name="siswa_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Siswa</option>
                            @foreach(App\Models\Siswa::orderBy('nama')->get() as $siswa)
                            <option value="{{ $siswa->id }}">{{ $siswa->nama }} - {{ $siswa->nis }} ({{ $siswa->kelas }})</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                        <select name="periode" id="periode" onchange="togglePeriodeInputs()" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="semua">Semua Data</option>
                            <option value="bulan">Per Bulan</option>
                            <option value="tahun">Per Tahun</option>
                        </select>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div id="bulanInput" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bulan</label>
                        <select name="bulan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $i == now()->month ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                            @endfor
                        </select>
                    </div>
                    
                    <div id="tahunInput" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                        <select name="tahun" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @for($i = now()->year; $i >= now()->year - 5; $i--)
                            <option value="{{ $i }}" {{ $i == now()->year ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
                    <i class="fas fa-paper-plane mr-2"></i>Request Laporan
                </button>
            </form>
        </div>

        <!-- History Request -->
        <div class="glass-card rounded-2xl shadow-xl p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">History Request Laporan</h2>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Siswa</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Periode</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Tanggal Request</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $request)
                        <tr class="border-b border-gray-200">
                            <td class="px-4 py-3">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $request->siswa->nama }}</p>
                                    <p class="text-xs text-gray-500">{{ $request->siswa->nis }} - {{ $request->siswa->kelas }}</p>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                @if($request->periode === 'bulan')
                                    {{ DateTime::createFromFormat('!m', $request->bulan)->format('F') }} {{ $request->tahun }}
                                @elseif($request->periode === 'tahun')
                                    Tahun {{ $request->tahun }}
                                @else
                                    Semua Data
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-600">{{ $request->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3">
                                @if($request->status === 'pending')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                                @elseif($request->status === 'approved')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Disetujui</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($request->status === 'approved')
                                    <a href="{{ route('guru.download-laporan', $request->id) }}" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs">
                                        <i class="fas fa-download mr-1"></i>Download
                                    </a>
                                @elseif($request->status === 'rejected')
                                    <span class="text-red-600 text-xs">{{ $request->alasan_tolak }}</span>
                                @else
                                    <span class="text-gray-500 text-xs">Menunggu verifikasi</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">Belum ada request laporan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function togglePeriodeInputs() {
            const periode = document.getElementById('periode').value;
            const bulanInput = document.getElementById('bulanInput');
            const tahunInput = document.getElementById('tahunInput');
            
            if (periode === 'bulan') {
                bulanInput.classList.remove('hidden');
                tahunInput.classList.remove('hidden');
            } else if (periode === 'tahun') {
                bulanInput.classList.add('hidden');
                tahunInput.classList.remove('hidden');
            } else {
                bulanInput.classList.add('hidden');
                tahunInput.classList.add('hidden');
            }
        }
    </script>

</body>
</html>