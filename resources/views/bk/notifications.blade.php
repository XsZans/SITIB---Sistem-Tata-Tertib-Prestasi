<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Notifikasi BK - Sistem Bimbingan Konseling</title>
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

        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 16px 24px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 9999;
            animation: slideIn 0.3s ease-out;
            max-width: 400px;
        }

        @keyframes slideIn {
            from { transform: translateX(400px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .toast-success { background: #10b981; color: white; }
        .toast-error { background: #ef4444; color: white; }
    </style>
</head>
<body class="gradient-bg">

    @include('layouts.bk-navbar', ['title' => 'Notifikasi BK', 'subtitle' => 'Sistem Bimbingan Konseling'])
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Notifikasi BK</h1>
        <a href="{{ route('bk.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow">
        @if($notifications->count() > 0)
            @foreach($notifications as $notification)
                <div class="notification-item border-b border-gray-200 p-4 {{ !$notification->is_read ? 'bg-blue-50' : '' }}">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2">
                                <h3 class="font-semibold text-gray-800">{{ $notification->title }}</h3>
                                @if(!$notification->is_read)
                                    <span class="bg-blue-500 text-white text-xs px-2 py-1 rounded-full">Baru</span>
                                @endif
                            </div>
                            <p class="text-gray-600 mt-1">{{ $notification->message }}</p>
                            <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                <span>{{ $notification->created_at->diffForHumans() }}</span>
                                @if($notification->bkSession)
                                    <span>Siswa: {{ $notification->bkSession->siswa->nama }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            @if($notification->type === 'pengajuan' && $notification->bkSession->status === 'pending')
                                <button onclick="showConfirmModal({{ $notification->bk_session_id }}, '{{ $notification->bkSession->jadwal_bk ? date('Y-m-d\TH:i', strtotime($notification->bkSession->jadwal_bk)) : '' }}')" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                                    Konfirmasi
                                </button>
                            @elseif($notification->bkSession->status === 'dijadwalkan')
                                <button onclick="showCompleteModal({{ $notification->bk_session_id }})" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                    Selesaikan
                                </button>
                            @endif
                            @if(!$notification->is_read)
                                <button onclick="markAsRead({{ $notification->id }})" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded text-sm">
                                    Tandai Dibaca
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="p-8 text-center text-gray-500">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5-5-5h5v-12"></path>
                </svg>
                <p>Tidak ada notifikasi</p>
            </div>
        @endif
    </div>
</div>

<!-- Modal Konfirmasi -->
<div id="confirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <h3 class="text-lg font-semibold mb-4">Konfirmasi Jadwal BK</h3>
            <form id="confirmForm">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jadwal BK</label>
                    <input type="datetime-local" id="jadwal_bk" readonly class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100 cursor-not-allowed" required>
                    <p class="text-xs text-gray-500 mt-1">Jadwal sesuai pengajuan siswa</p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                    <textarea id="catatan_bk" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2"></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeConfirmModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                        Batal
                    </button>
                    <button type="submit" id="confirmBtn" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Selesaikan -->
<div id="completeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <h3 class="text-lg font-semibold mb-4">Selesaikan Sesi BK</h3>
            <form id="completeForm">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Hasil BK <span class="text-red-500">*</span></label>
                    <textarea id="hasil_bk" rows="4" class="w-full border border-gray-300 rounded-lg px-3 py-2" placeholder="Masukkan hasil sesi BK..." required></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeCompleteModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                        Batal
                    </button>
                    <button type="submit" id="completeBtn" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Selesaikan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let currentSessionId = null;

function showConfirmModal(sessionId, jadwalSiswa = '') {
    currentSessionId = sessionId;
    document.getElementById('jadwal_bk').value = jadwalSiswa;
    document.getElementById('catatan_bk').value = '';
    document.getElementById('confirmModal').classList.remove('hidden');
}

function closeConfirmModal() {
    document.getElementById('confirmModal').classList.add('hidden');
    document.getElementById('confirmBtn').disabled = false;
    document.getElementById('confirmBtn').innerHTML = 'Konfirmasi';
    currentSessionId = null;
}

function showCompleteModal(sessionId) {
    currentSessionId = sessionId;
    document.getElementById('hasil_bk').value = '';
    document.getElementById('completeModal').classList.remove('hidden');
}

function closeCompleteModal() {
    document.getElementById('completeModal').classList.add('hidden');
    document.getElementById('completeBtn').disabled = false;
    document.getElementById('completeBtn').innerHTML = 'Selesaikan';
    currentSessionId = null;
}

document.getElementById('confirmForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const jadwal = document.getElementById('jadwal_bk').value;
    const catatan = document.getElementById('catatan_bk').value;
    const btn = document.getElementById('confirmBtn');
    
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Memproses...';
    
    fetch(`{{ url('/bk/confirm') }}/${currentSessionId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            jadwal_bk: jadwal,
            catatan_bk: catatan
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('Jadwal BK berhasil dikonfirmasi', 'success');
            closeConfirmModal();
            setTimeout(() => location.reload(), 1500);
        } else {
            showToast('Gagal mengkonfirmasi jadwal', 'error');
            btn.disabled = false;
            btn.innerHTML = 'Konfirmasi';
        }
    })
    .catch(error => {
        showToast('Terjadi kesalahan', 'error');
        btn.disabled = false;
        btn.innerHTML = 'Konfirmasi';
    });
});

document.getElementById('completeForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const hasil = document.getElementById('hasil_bk').value;
    const btn = document.getElementById('completeBtn');
    
    if (!hasil.trim()) {
        showToast('Hasil BK harus diisi', 'error');
        return;
    }
    
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Memproses...';
    
    fetch(`{{ url('/bk/complete') }}/${currentSessionId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            hasil_bk: hasil
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('Sesi BK berhasil diselesaikan', 'success');
            closeCompleteModal();
            setTimeout(() => location.reload(), 1500);
        } else {
            showToast('Gagal menyelesaikan sesi', 'error');
            btn.disabled = false;
            btn.innerHTML = 'Selesaikan';
        }
    })
    .catch(error => {
        showToast('Terjadi kesalahan', 'error');
        btn.disabled = false;
        btn.innerHTML = 'Selesaikan';
    });
});

function markAsRead(notificationId) {
    fetch(`{{ url('/bk/notification') }}/${notificationId}/read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('Notifikasi ditandai sebagai dibaca', 'success');
            setTimeout(() => location.reload(), 1000);
        }
    })
    .catch(error => {
        showToast('Terjadi kesalahan', 'error');
    });
}

function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `
        <div class="flex items-center gap-3">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} text-xl"></i>
            <span>${message}</span>
        </div>
    `;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
}
</script>

</body>
</html>