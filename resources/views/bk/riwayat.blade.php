<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Bimbingan - BK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 50%, #cbd5e1 100%); min-height: 100vh; }
    </style>
</head>
<body class="gradient-bg">

    @include('layouts.bk-navbar', ['title' => 'Riwayat Bimbingan', 'subtitle' => 'Semua Riwayat Sesi BK'])

    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <form method="GET" class="flex flex-col md:flex-row gap-3">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama atau NIS..." class="flex-1 border border-gray-300 rounded-lg px-4 py-2">
                <select name="status" class="border border-gray-300 rounded-lg px-4 py-2">
                    <option value="">Semua Status</option>
                    <option value="selesai" {{ $status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="dibatalkan" {{ $status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg">
                    <i class="fas fa-search mr-2"></i>Cari
                </button>
                <a href="{{ route('bk.riwayat') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg text-center">
                    <i class="fas fa-redo mr-2"></i>Reset
                </a>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4">Semua Riwayat ({{ $riwayatSessions->total() }})</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                @forelse($riwayatSessions as $session)
                <div class="border border-gray-200 rounded-lg p-3 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="font-semibold text-sm text-gray-800 truncate flex-1">{{ $session->siswa->nama }}</h3>
                        @if($session->status == 'selesai')
                            <span class="bg-green-100 text-green-700 text-xs px-2 py-0.5 rounded-full ml-2">Selesai</span>
                        @else
                            <span class="bg-red-100 text-red-700 text-xs px-2 py-0.5 rounded-full ml-2">Batal</span>
                        @endif
                    </div>
                    <p class="text-xs text-gray-600 mb-1"><i class="fas fa-id-card mr-1"></i>{{ $session->siswa->nis }}</p>
                    <p class="text-xs text-gray-600 mb-1"><i class="fas fa-graduation-cap mr-1"></i>{{ $session->siswa->kelas }}</p>
                    <p class="text-xs text-gray-600 mb-2"><i class="fas fa-calendar mr-1"></i>{{ $session->jadwal_bk ? \Carbon\Carbon::parse($session->jadwal_bk)->format('d/m/Y H:i') : '-' }}</p>
                    <p class="text-xs text-gray-500 line-clamp-2 mb-2">{{ Str::limit($session->alasan, 60) }}</p>
                    @if($session->status == 'selesai' && $session->hasil_bk)
                        <p class="text-xs text-blue-600 italic line-clamp-1"><i class="fas fa-check-circle mr-1"></i>{{ Str::limit($session->hasil_bk, 40) }}</p>
                    @endif
                    <p class="text-xs text-gray-400 mt-2">{{ \Carbon\Carbon::parse($session->updated_at)->diffForHumans() }}</p>
                </div>
                @empty
                <div class="col-span-full text-center text-gray-500 py-8">
                    <i class="fas fa-history text-4xl mb-2"></i>
                    <p>Tidak ada riwayat ditemukan</p>
                </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $riwayatSessions->links() }}
            </div>
        </div>
    </div>

</body>
</html>
