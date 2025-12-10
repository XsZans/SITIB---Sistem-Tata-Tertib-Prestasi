<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verifikasi Laporan - Admin</title>
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

    @include('layouts.admin-navbar', ['title' => 'Verifikasi Laporan', 'subtitle' => 'Kelola Request Laporan'])

    <div class="container mx-auto px-4 py-8 max-w-6xl">
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
        @endif

        <div class="glass-card rounded-2xl shadow-xl p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Request Laporan Pending</h2>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Pemohon</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Siswa</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Periode</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Tanggal Request</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $request)
                        <tr class="border-b border-gray-200">
                            <td class="px-4 py-3">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $request->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ ucfirst($request->user->role) }}</p>
                                </div>
                            </td>
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
                                <div class="flex gap-2">
                                    <button onclick="approveRequest({{ $request->id }})" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs">
                                        <i class="fas fa-check mr-1"></i>Setujui
                                    </button>
                                    <button onclick="openRejectModal({{ $request->id }})" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                        <i class="fas fa-times mr-1"></i>Tolak
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">Tidak ada request pending</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Tolak Request Laporan</h3>
            
            <form id="rejectForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan</label>
                    <textarea name="alasan_tolak" required rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Masukkan alasan penolakan..."></textarea>
                </div>
                
                <div class="flex gap-3">
                    <button type="button" onclick="closeRejectModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                        Tolak Request
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Approve Modal -->
    <div id="approveModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Setujui Request Laporan</h3>
                <p class="text-gray-600">Apakah Anda yakin ingin menyetujui request laporan ini?</p>
            </div>
            
            <div class="flex gap-3">
                <button type="button" onclick="closeApproveModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                    Batal
                </button>
                <button type="button" onclick="confirmApprove()" class="flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">
                    Ya, Setujui
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentRequestId = null;
        
        function approveRequest(id) {
            currentRequestId = id;
            document.getElementById('approveModal').classList.remove('hidden');
        }
        
        function closeApproveModal() {
            document.getElementById('approveModal').classList.add('hidden');
            currentRequestId = null;
        }
        
        function confirmApprove() {
            if (currentRequestId) {
                fetch(`/admin/approve-laporan/${currentRequestId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                }).then(() => location.reload());
            }
        }

        function openRejectModal(id) {
            document.getElementById('rejectForm').action = `/admin/reject-laporan/${id}`;
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>

</body>
</html>