<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bimbingan Konseling - Sistem Tata Tertib</title>
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
        .toast-warning { background: #f59e0b; color: white; }
    </style>
</head>
<body class="gradient-bg">

    @include('layouts.siswa-navbar', ['title' => 'Bimbingan Konseling', 'subtitle' => 'Dashboard Siswa'])
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Bimbingan Konseling</h1>
        <div class="flex gap-3">
            <a href="{{ route('siswa.export-bk') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-download mr-2"></i>Export BK
            </a>
            <button onclick="showAjukanModal()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-plus mr-2"></i>Ajukan Bimbingan
            </button>
        </div>
    </div>

    <!-- Notifikasi Panggilan BK -->
    @if($notifications->count() > 0)
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
        <h2 class="text-lg font-semibold text-yellow-800 mb-3">Panggilan BK</h2>
        @foreach($notifications as $notification)
        <div class="bg-white p-4 rounded border mb-3">
            <div class="flex justify-between items-start mb-3">
                <div class="flex-1">
                    <h3 class="font-medium text-lg">{{ $notification->title }}</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ $notification->message }}</p>
                    <p class="text-xs text-gray-500 mt-2">{{ $notification->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @if($notification->bkSession)
                @if($notification->bkSession->status === 'selesai')
                    <div class="mt-3 p-2 rounded bg-gray-100 text-gray-800">
                        <p class="text-sm font-medium">Sesi BK telah selesai</p>
                        <button onclick="markAsRead({{ $notification->id }})" class="mt-2 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                            <i class="fas fa-check mr-1"></i>Tandai Dibaca
                        </button>
                    </div>
                @elseif($notification->bkSession->respon_siswa === 'menunggu')
                    <div class="flex gap-2 mt-3">
                        <button onclick="showResponModal({{ $notification->bkSession->id }}, 'diterima')" class="flex-1 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-colors">
                            <i class="fas fa-check mr-1"></i>Terima
                        </button>
                        <button onclick="showResponModal({{ $notification->bkSession->id }}, 'ditolak')" class="flex-1 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors">
                            <i class="fas fa-times mr-1"></i>Tolak
                        </button>
                    </div>
                @else
                    <div class="mt-3 p-2 rounded {{ $notification->bkSession->respon_siswa === 'diterima' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        <p class="text-sm font-medium">
                            {{ $notification->bkSession->respon_siswa === 'diterima' ? 'Anda telah menerima panggilan ini' : 'Anda telah menolak panggilan ini' }}
                        </p>
                        @if($notification->bkSession->alasan_siswa)
                        <p class="text-xs mt-1">Alasan: {{ $notification->bkSession->alasan_siswa }}</p>
                        @endif
                    </div>
                @endif
            @endif
        </div>
        @endforeach
    </div>
    @endif

    <!-- Riwayat BK -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold">Riwayat Bimbingan Konseling</h2>
        </div>
        
        @if($bkSessions->count() > 0)
            @foreach($bkSessions as $session)
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="px-3 py-1 rounded-full text-sm font-medium
                                @if($session->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($session->status === 'dijadwalkan') bg-blue-100 text-blue-800
                                @elseif($session->status === 'selesai') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                @if($session->status === 'pending') Menunggu Konfirmasi
                                @elseif($session->status === 'dijadwalkan') Dijadwalkan
                                @elseif($session->status === 'selesai') Selesai
                                @else Dibatalkan
                                @endif
                            </span>
                            @if($session->respon_siswa !== 'menunggu')
                            <span class="px-3 py-1 rounded-full text-sm font-medium {{ $session->respon_siswa === 'diterima' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $session->respon_siswa === 'diterima' ? 'Diterima' : 'Ditolak' }}
                            </span>
                            @endif
                        </div>
                        
                        <h3 class="font-semibold text-gray-800">Guru BK: {{ $session->guruBk->nama }}</h3>
                        <p class="text-gray-600 mt-1"><strong>Alasan:</strong> {{ $session->alasan }}</p>
                        
                        @if($session->respon_siswa !== 'menunggu')
                        <div class="mt-2 p-2 rounded {{ $session->respon_siswa === 'diterima' ? 'bg-green-50' : 'bg-red-50' }}">
                            <p class="text-sm {{ $session->respon_siswa === 'diterima' ? 'text-green-800' : 'text-red-800' }}">
                                <strong>Respon Anda:</strong> {{ $session->respon_siswa === 'diterima' ? 'Diterima' : 'Ditolak' }}
                            </p>
                            @if($session->alasan_siswa)
                            <p class="text-xs {{ $session->respon_siswa === 'diterima' ? 'text-green-700' : 'text-red-700' }} mt-1">
                                Alasan: {{ $session->alasan_siswa }}
                            </p>
                            @endif
                        </div>
                        @endif
                        
                        @if($session->jadwal_bk)
                        <p class="text-gray-600 mt-1">
                            <strong>Jadwal:</strong> {{ date('d/m/Y H:i', strtotime($session->jadwal_bk)) }}
                        </p>
                        @endif
                        
                        @if($session->catatan_bk)
                        <p class="text-gray-600 mt-1"><strong>Catatan BK:</strong> {{ $session->catatan_bk }}</p>
                        @endif
                        
                        @if($session->hasil_bk)
                        <div class="mt-3 p-3 bg-green-50 rounded">
                            <p class="text-sm font-medium text-green-800">Hasil BK:</p>
                            <p class="text-green-700">{{ $session->hasil_bk }}</p>
                        </div>
                        @endif
                        
                        <p class="text-sm text-gray-500 mt-2">
                            Dibuat: {{ $session->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="p-8 text-center text-gray-500">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <p>Belum ada riwayat bimbingan konseling</p>
            </div>
        @endif
    </div>
</div>

<!-- Modal Ajukan Bimbingan -->
<div id="ajukanModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg p-6 w-full max-w-md max-h-[90vh] overflow-y-auto">
            <h3 class="text-lg font-semibold mb-4">Ajukan Bimbingan Konseling</h3>
            <form id="ajukanForm">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                    <input type="text" value="{{ $siswa->nama }}" readonly class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">NIS</label>
                    <input type="text" value="{{ $siswa->nis }}" readonly class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Guru BK <span class="text-red-500">*</span>
                    </label>
                    <select id="guru_bk_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Guru BK</option>
                        @foreach($guruBkList as $guruBk)
                        <option value="{{ $guruBk->id }}">{{ $guruBk->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tujuan Bimbingan <span class="text-red-500">*</span>
                    </label>
                    <select id="tujuan_bimbingan" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Tujuan Bimbingan</option>
                        <option value="Masalah Akademik">Masalah Akademik</option>
                        <option value="Masalah Pribadi">Masalah Pribadi</option>
                        <option value="Masalah Sosial">Masalah Sosial</option>
                        <option value="Masalah Keluarga">Masalah Keluarga</option>
                        <option value="Karir dan Masa Depan">Karir dan Masa Depan</option>
                        <option value="Kesehatan Mental">Kesehatan Mental</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div id="tujuanLainnyaContainer" class="mb-4 hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tujuan Lainnya <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="tujuan_lainnya" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Sebutkan tujuan bimbingan..." maxlength="200">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Alasan <span class="text-red-500">*</span>
                    </label>
                    <textarea id="alasan_ajukan" rows="4" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Jelaskan alasan Anda membutuhkan bimbingan..." required maxlength="500"></textarea>
                    <p class="text-xs text-gray-500 mt-1">Maksimal 500 karakter</p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Bimbingan <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="tanggal_bimbingan" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required min="{{ date('Y-m-d') }}">
                    <p class="text-xs text-gray-500 mt-1">Pilih tanggal untuk bimbingan</p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Jam Bimbingan <span class="text-red-500">*</span>
                    </label>
                    <select id="jam_bimbingan" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Jam Bimbingan</option>
                        <option value="07:00:00">07:00 - 08:00 WIB</option>
                        <option value="08:00:00">08:00 - 09:00 WIB</option>
                        <option value="09:00:00">09:00 - 10:00 WIB</option>
                        <option value="10:00:00">10:00 - 11:00 WIB</option>
                        <option value="11:00:00">11:00 - 12:00 WIB</option>
                        <option value="12:00:00">12:00 - 13:00 WIB</option>
                        <option value="13:00:00">13:00 - 14:00 WIB</option>
                        <option value="14:00:00">14:00 - 15:00 WIB</option>
                        <option value="15:00:00">15:00 - 16:00 WIB</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Jam operasional: 07:00 - 16:00 WIB</p>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeAjukanModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                        Batal
                    </button>
                    <button type="submit" id="ajukanBtn" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Ajukan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Respon BK -->
<div id="responModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <h3 class="text-lg font-semibold mb-4" id="responTitle"></h3>
            <form id="responForm">
                <input type="hidden" id="sessionId">
                <input type="hidden" id="responType">
                <div id="alasanContainer" class="mb-4 hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Alasan Penolakan <span class="text-red-500">*</span>
                    </label>
                    <textarea id="alasan" rows="4" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Jelaskan alasan Anda menolak panggilan BK..." maxlength="500"></textarea>
                    <p class="text-xs text-gray-500 mt-1">Maksimal 500 karakter</p>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeResponModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                        Batal
                    </button>
                    <button type="submit" id="submitBtn" class="px-4 py-2 text-white rounded">
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showAjukanModal() {
    document.getElementById('ajukanModal').classList.remove('hidden');
}

function closeAjukanModal() {
    document.getElementById('ajukanModal').classList.add('hidden');
    document.getElementById('ajukanForm').reset();
    document.getElementById('tujuanLainnyaContainer').classList.add('hidden');
}

document.getElementById('tujuan_bimbingan').addEventListener('change', function() {
    const container = document.getElementById('tujuanLainnyaContainer');
    if (this.value === 'Lainnya') {
        container.classList.remove('hidden');
    } else {
        container.classList.add('hidden');
    }
});

document.getElementById('ajukanForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const guruBkId = document.getElementById('guru_bk_id').value;
    const tujuan = document.getElementById('tujuan_bimbingan').value;
    const tujuanLainnya = document.getElementById('tujuan_lainnya').value;
    const alasan = document.getElementById('alasan_ajukan').value;
    const tanggal = document.getElementById('tanggal_bimbingan').value;
    const jam = document.getElementById('jam_bimbingan').value;
    
    if (!guruBkId || !tujuan || !alasan || !tanggal || !jam) {
        showToast('Semua field harus diisi', 'error');
        return;
    }
    
    if (tujuan === 'Lainnya' && !tujuanLainnya.trim()) {
        showToast('Tujuan lainnya harus diisi', 'error');
        return;
    }
    
    const btn = document.getElementById('ajukanBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Mengirim...';
    
    fetch('{{ route("siswa.ajukan-bimbingan") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            guru_bk_id: guruBkId,
            tujuan_bimbingan: tujuan,
            tujuan_lainnya: tujuanLainnya,
            alasan: alasan,
            tanggal_bimbingan: tanggal,
            jam_bimbingan: jam
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            setTimeout(() => location.reload(), 1500);
        } else {
            showToast(data.error || 'Terjadi kesalahan', 'error');
            btn.disabled = false;
            btn.innerHTML = 'Ajukan';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Terjadi kesalahan saat mengirim pengajuan', 'error');
        btn.disabled = false;
        btn.innerHTML = 'Ajukan';
    });
});

function showResponModal(sessionId, respon) {
    const modal = document.getElementById('responModal');
    const title = document.getElementById('responTitle');
    const alasanContainer = document.getElementById('alasanContainer');
    const alasanTextarea = document.getElementById('alasan');
    const submitBtn = document.getElementById('submitBtn');
    
    document.getElementById('sessionId').value = sessionId;
    document.getElementById('responType').value = respon;
    alasanTextarea.value = '';
    submitBtn.disabled = false;
    
    if (respon === 'diterima') {
        title.textContent = 'Terima Panggilan BK';
        alasanContainer.classList.add('hidden');
        submitBtn.className = 'bg-green-500 hover:bg-green-600 px-4 py-2 text-white rounded';
        submitBtn.textContent = 'Terima';
    } else {
        title.textContent = 'Tolak Panggilan BK';
        alasanContainer.classList.remove('hidden');
        submitBtn.className = 'bg-red-500 hover:bg-red-600 px-4 py-2 text-white rounded';
        submitBtn.textContent = 'Tolak';
    }
    
    modal.classList.remove('hidden');
}

function closeResponModal() {
    const modal = document.getElementById('responModal');
    const form = document.getElementById('responForm');
    const submitBtn = document.getElementById('submitBtn');
    
    modal.classList.add('hidden');
    form.reset();
    submitBtn.disabled = false;
    submitBtn.textContent = 'Kirim';
}

document.getElementById('responForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const sessionId = document.getElementById('sessionId').value;
    const respon = document.getElementById('responType').value;
    const alasan = document.getElementById('alasan').value;
    
    if (respon === 'ditolak' && !alasan.trim()) {
        showToast('Alasan penolakan harus diisi', 'error');
        return;
    }
    
    console.log('Sending response:', { sessionId, respon, alasan });
    
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Mengirim...';
    
    fetch(`{{ url('/siswa/bk/respon') }}/${sessionId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            respon: respon,
            alasan: alasan || null
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            setTimeout(() => location.reload(), 1500);
        } else {
            showToast(data.error || 'Terjadi kesalahan', 'error');
            submitBtn.disabled = false;
            submitBtn.innerHTML = respon === 'diterima' ? 'Terima' : 'Tolak';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Terjadi kesalahan saat mengirim respon', 'error');
        submitBtn.disabled = false;
        submitBtn.innerHTML = respon === 'diterima' ? 'Terima' : 'Tolak';
    });
});

function markAsRead(notificationId) {
    fetch(`{{ url('/siswa/bk/notification') }}/${notificationId}/read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Terjadi kesalahan saat menandai notifikasi', 'error');
    });
}

function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `
        <div class="flex items-center gap-3">
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} text-xl"></i>
            <span>${message}</span>
        </div>
    `;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
}
</script>

</body>
</html>
