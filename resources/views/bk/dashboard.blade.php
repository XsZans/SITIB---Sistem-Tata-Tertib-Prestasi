<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard BK - Sistem Bimbingan Konseling</title>
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

        @keyframes slide-in-left {
            from { transform: translateX(-100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .animate-slide-in-left { animation: slide-in-left 0.3s ease-out; }
    </style>
</head>
<body class="gradient-bg">

    @include('layouts.bk-navbar', ['title' => 'Dashboard BK', 'subtitle' => 'Sistem Bimbingan Konseling'])

<!-- Notifikasi Popup -->
<div id="notifPopup" class="hidden fixed top-20 left-4 z-50 w-80 bg-white rounded-lg shadow-xl border border-gray-200 animate-slide-in-left">
    <div class="p-4">
        <div class="flex justify-between items-start mb-2">
            <h4 class="font-semibold text-gray-800 text-sm">Notifikasi Terbaru</h4>
            <button onclick="closeNotifPopup()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="notifContent" class="cursor-pointer hover:bg-gray-50 p-2 rounded transition" onclick="goToNotifications()">
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard BK</h1>
        <div class="flex space-x-3">
            <a href="{{ route('bk.input') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                Input BK
            </a>
            <a href="{{ route('bk.export-laporan') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                Export Laporan
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-yellow-100 p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-500 text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold text-gray-700">Menunggu Konfirmasi</h2>
                    <p class="text-2xl font-bold text-yellow-600">{{ $pendingSessions }}</p>
                </div>
            </div>
        </div>

        <div class="bg-blue-100 p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-500 text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold text-gray-700">Jadwal Hari Ini</h2>
                    <p class="text-2xl font-bold text-blue-600">{{ $todaySessions }}</p>
                </div>
            </div>
        </div>

        <div class="bg-green-100 p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-500 text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold text-gray-700">Selesai</h2>
                    <p class="text-2xl font-bold text-green-600">{{ $completedSessions }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengajuan Bimbingan -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h2 class="text-xl font-bold mb-4">Pengajuan Bimbingan dari Siswa</h2>
        <div id="pengajuan-container">
            <!-- Pengajuan will be loaded here -->
        </div>
    </div>

    <!-- Riwayat Bimbingan -->
    <div class="bg-white rounded-lg shadow p-6 cursor-pointer hover:shadow-xl transition-shadow" onclick="window.location.href='{{ route('bk.riwayat') }}'">
        <h2 class="text-xl font-bold mb-4">Riwayat Bimbingan</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 pointer-events-none">
            @forelse($riwayatSessions->take(8) as $session)
            <div class="border border-gray-200 rounded-lg p-3">
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
                <p>Belum ada riwayat bimbingan</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Modal Jadwal -->
<div id="jadwalModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <h3 class="text-lg font-semibold mb-4">Konfirmasi Jadwal Bimbingan</h3>
            <p class="text-sm text-gray-600 mb-3">Jadwal sesuai dengan yang diajukan siswa:</p>
            <input type="datetime-local" id="jadwalInput" readonly class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-4 bg-gray-100 cursor-not-allowed">
            <div class="flex justify-end space-x-3">
                <button onclick="closeJadwalModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Batal</button>
                <button onclick="submitJadwal()" id="submitJadwalBtn" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Setujui</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Tolak -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <h3 class="text-lg font-semibold mb-4">Konfirmasi Penolakan</h3>
            <p class="text-gray-600 mb-4">Yakin ingin menolak pengajuan bimbingan ini?</p>
            <div class="flex justify-end space-x-3">
                <button onclick="closeRejectModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Batal</button>
                <button onclick="confirmReject()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Tolak</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    loadPengajuan();
    loadNotifications();
});

function loadPengajuan() {
    fetch('{{ route("bk.pengajuan") }}')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('pengajuan-container');
            container.innerHTML = '';
            
            if (data.length === 0) {
                container.innerHTML = '<p class="text-gray-500 text-center">Tidak ada pengajuan bimbingan</p>';
            } else {
                data.forEach(pengajuan => {
                    const item = document.createElement('div');
                    item.className = 'border border-gray-200 rounded-lg p-4 mb-3';
                    const jadwalSiswa = pengajuan.jadwal_bk ? new Date(pengajuan.jadwal_bk).toISOString().slice(0, 16) : '';
                    item.innerHTML = `
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="font-semibold">${pengajuan.siswa.nama} - ${pengajuan.siswa.nis}</h3>
                                <p class="text-sm text-gray-600 mt-1"><strong>Tujuan:</strong> ${pengajuan.tujuan_bimbingan || '-'}</p>
                                <p class="text-sm text-gray-600"><strong>Alasan:</strong> ${pengajuan.alasan}</p>
                                <p class="text-sm text-gray-600"><strong>Jadwal yang diajukan:</strong> ${pengajuan.jadwal_bk ? new Date(pengajuan.jadwal_bk).toLocaleString('id-ID') : '-'}</p>
                                <p class="text-xs text-gray-500 mt-2">Diajukan: ${new Date(pengajuan.created_at).toLocaleString('id-ID')}</p>
                            </div>
                            <div class="flex flex-col gap-2 ml-4">
                                <button onclick="approvePengajuan(${pengajuan.id}, '${jadwalSiswa}')" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm whitespace-nowrap">
                                    <i class="fas fa-check mr-1"></i>Setujui
                                </button>
                                <button onclick="rejectPengajuan(${pengajuan.id})" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm whitespace-nowrap">
                                    <i class="fas fa-times mr-1"></i>Tolak
                                </button>
                            </div>
                        </div>
                    `;
                    container.appendChild(item);
                });
            }
        });
}

let currentPengajuanId = null;

function approvePengajuan(id, jadwalSiswa = '') {
    currentPengajuanId = id;
    document.getElementById('jadwalInput').value = jadwalSiswa;
    document.getElementById('jadwalModal').classList.remove('hidden');
}

function closeJadwalModal() {
    document.getElementById('jadwalModal').classList.add('hidden');
    document.getElementById('submitJadwalBtn').disabled = false;
    document.getElementById('submitJadwalBtn').innerHTML = 'Setujui';
    currentPengajuanId = null;
}

function submitJadwal() {
    const jadwal = document.getElementById('jadwalInput').value;
    if (!jadwal) {
        showToast('Jadwal tidak valid', 'error');
        return;
    }
    
    const btn = document.getElementById('submitJadwalBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Memproses...';
    
    fetch(`{{ url('/bk/approve-pengajuan') }}/${currentPengajuanId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ jadwal_bk: jadwal })
    })
    .then(response => {
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            throw new Error('Server tidak mengembalikan JSON');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showToast('Pengajuan berhasil disetujui', 'success');
            closeJadwalModal();
            setTimeout(() => location.reload(), 1500);
        } else {
            throw new Error(data.message || 'Gagal menyetujui');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Terjadi kesalahan saat menyetujui', 'error');
        btn.disabled = false;
        btn.innerHTML = 'Setujui';
    });
}

function rejectPengajuan(id) {
    currentPengajuanId = id;
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
    currentPengajuanId = null;
}

function confirmReject() {
    fetch(`{{ url('/bk/reject-pengajuan') }}/${currentPengajuanId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('Pengajuan berhasil ditolak', 'success');
            closeRejectModal();
            setTimeout(() => loadPengajuan(), 1000);
        }
    })
    .catch(() => showToast('Terjadi kesalahan', 'error'));
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

function loadNotifications() {
    fetch('{{ route("bk.notifications") }}')
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const notifications = doc.querySelectorAll('.notification-item');
            
            if (notifications.length > 0) {
                showLatestNotification(notifications[0]);
            }
        });
}

function showLatestNotification(notifElement) {
    const title = notifElement.querySelector('h3')?.textContent || 'Notifikasi';
    const message = notifElement.querySelector('p')?.textContent || '';
    const time = notifElement.querySelector('.text-gray-500')?.textContent || '';
    
    const content = document.getElementById('notifContent');
    content.innerHTML = `
        <div class="text-sm">
            <p class="font-medium text-gray-800 mb-1">${title}</p>
            <p class="text-gray-600 text-xs line-clamp-2">${message}</p>
            <p class="text-gray-400 text-xs mt-1">${time}</p>
        </div>
    `;
    
    document.getElementById('notifPopup').classList.remove('hidden');
    setTimeout(() => closeNotifPopup(), 10000);
}

function closeNotifPopup() {
    document.getElementById('notifPopup').classList.add('hidden');
}

function goToNotifications() {
    window.location.href = '{{ route("bk.notifications") }}';
}
</script>
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