<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pelanggaran - SiTib</title>
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

    @include('layouts.admin-navbar', ['title' => 'Laporan Pelanggaran', 'subtitle' => 'Verifikasi Laporan Pelanggaran'])

    <div class="container mx-auto px-4 py-4 md:py-8 max-w-6xl">
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-lg" data-aos="fade-down">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3 text-green-600"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-6" data-aos="fade-up">
            <div class="bg-gradient-to-br from-orange-50 to-orange-100 border border-orange-200 rounded-xl p-4 hover-lift text-center">
                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                    <i class="fas fa-clock text-white text-lg"></i>
                </div>
                <p class="text-sm text-gray-600 font-medium mb-1">Laporan Menunggu Verifikasi</p>
                <p class="text-2xl font-bold text-orange-700">{{ $totalLaporan }}</p>
            </div>
            <div class="bg-gradient-to-br from-red-50 to-red-100 border border-red-200 rounded-xl p-4 hover-lift text-center">
                <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                    <i class="fas fa-times-circle text-white text-lg"></i>
                </div>
                <p class="text-sm text-gray-600 font-medium mb-1">Laporan Tidak Terverifikasi</p>
                <p class="text-2xl font-bold text-red-700" id="totalTidakTerverifikasi">{{ $totalTidakTerverifikasi ?? 0 }}</p>
            </div>
        </div>

        <!-- Laporan Pelanggaran -->
        <main id="pelanggaran-section" class="glass-card rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-8 mb-8" data-aos="fade-up">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-exclamation-triangle mr-2 text-red-600"></i>Verifikasi Laporan Pelanggaran
                </h2>
                <p class="text-gray-600">Pelanggaran yang menunggu persetujuan admin</p>
            </div>
            @if($laporanPelanggaran->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200 rounded-lg">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">No</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Tanggal</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Siswa</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Jenis Pelanggaran</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Poin</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Pelapor</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Bukti</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($laporanPelanggaran as $index => $laporan)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $laporan->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $laporan->siswa->nama }}</div>
                                    <div class="text-sm text-gray-500">{{ $laporan->siswa->nis }} - {{ $laporan->siswa->kelas }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">{{ $laporan->jenisPelanggaran->kategori }}</span>
                                    <div class="text-sm text-gray-900 mt-1">{{ $laporan->jenisPelanggaran->nama_pelanggaran }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ $laporan->jenisPelanggaran->poin }} Poin</span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $laporan->pengadu->name ?? ($laporan->user->name ?? 'System') }}</div>
                                    <div class="text-sm text-gray-500">{{ $laporan->pengadu->role ?? ($laporan->user->role ?? 'system') }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    @if($laporan->bukti_gambar)
                                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs transition-colors" onclick="showImage('{{ asset($laporan->bukti_gambar) }}')">
                                            <i class="fas fa-image mr-1"></i>Lihat
                                        </button>
                                    @else
                                        <span class="text-gray-500 text-sm">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs transition-colors" onclick="openTerimaModal({{ $laporan->id }}, 'pelanggaran')">
                                            <i class="fas fa-check mr-1"></i>Terima
                                        </button>
                                        <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs transition-colors" onclick="openTolakModal({{ $laporan->id }}, 'pelanggaran')">
                                            <i class="fas fa-times mr-1"></i>Tolak
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-clipboard-check text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak ada laporan pelanggaran yang menunggu verifikasi</h3>
                    <p class="text-gray-500">Semua laporan pelanggaran sudah diverifikasi</p>
                </div>
            @endif
        </main>

        <!-- Laporan Prestasi -->
        <main id="prestasi-section" class="glass-card rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-8 mb-8" data-aos="fade-up">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-trophy mr-2 text-green-600"></i>Verifikasi Laporan Prestasi
                </h2>
                <p class="text-gray-600">Prestasi yang menunggu persetujuan admin</p>
            </div>
            @if($laporanPrestasi->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200 rounded-lg">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">No</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Tanggal</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Siswa</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Jenis Prestasi</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Poin</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Pelapor</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Bukti</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($laporanPrestasi as $index => $laporan)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $laporan->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $laporan->siswa->nama }}</div>
                                    <div class="text-sm text-gray-500">{{ $laporan->siswa->nis }} - {{ $laporan->siswa->kelas }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">{{ $laporan->prestasi->kategori }}</span>
                                    <div class="text-sm text-gray-900 mt-1">{{ $laporan->prestasi->nama }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">{{ $laporan->prestasi->poin_pengurangan }} Poin</span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $laporan->pengadu->name ?? ($laporan->user->name ?? 'System') }}</div>
                                    <div class="text-sm text-gray-500">{{ $laporan->pengadu->role ?? ($laporan->user->role ?? 'system') }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    @if($laporan->bukti_gambar)
                                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs transition-colors" onclick="showImage('{{ asset($laporan->bukti_gambar) }}')">
                                            <i class="fas fa-image mr-1"></i>Lihat
                                        </button>
                                    @else
                                        <span class="text-gray-500 text-sm">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs transition-colors" onclick="openTerimaModal({{ $laporan->id }}, 'prestasi')">
                                            <i class="fas fa-check mr-1"></i>Terima
                                        </button>
                                        <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs transition-colors" onclick="openTolakModal({{ $laporan->id }}, 'prestasi')">
                                            <i class="fas fa-times mr-1"></i>Tolak
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-trophy text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak ada laporan prestasi yang menunggu verifikasi</h3>
                    <p class="text-gray-500">Semua laporan prestasi sudah diverifikasi</p>
                </div>
            @endif
        </main>

        <!-- Laporan Tidak Terverifikasi -->
        <main id="tidak-terverifikasi-section" class="glass-card rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-8 mb-8" data-aos="fade-up">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-times-circle mr-2 text-red-600"></i>Laporan Tidak Terverifikasi
                </h2>
                <p class="text-gray-600">Laporan yang ditolak beserta alasan penolakan</p>
            </div>
            <div id="tidak-terverifikasi-content">
                <div class="text-center py-12">
                    <i class="fas fa-spinner fa-spin text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-500">Memuat data...</p>
                </div>
            </div>
        </main>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-bold text-gray-800">Bukti Pelanggaran</h3>
                    <button onclick="closeImageModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="p-6 text-center">
                <img id="modalImage" src="" class="max-w-full max-h-96 object-contain mx-auto" alt="Bukti Pelanggaran">
            </div>
        </div>
    </div>

    <!-- Terima Modal -->
    <div id="terimaModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Terima Laporan</h3>
                        <p class="text-gray-600 text-sm">Konfirmasi penerimaan laporan</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-700 mb-4">Apakah Anda yakin ingin menerima laporan ini? Laporan yang diterima akan diproses lebih lanjut.</p>
            </div>
            <div class="p-6 border-t border-gray-200 flex gap-3">
                <button type="button" onclick="closeTerimaModal()" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg transition-colors">
                    Batal
                </button>
                <button type="button" onclick="submitTerima()" class="flex-1 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors">
                    <i class="fas fa-check mr-2"></i>Terima Laporan
                </button>
            </div>
        </div>
    </div>

    <!-- Tolak Modal -->
    <div id="tolakModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-times text-red-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Tolak Laporan</h3>
                        <p class="text-gray-600 text-sm">Berikan alasan penolakan</p>
                    </div>
                </div>
            </div>
            <form id="tolakForm" method="POST" action="{{ route('admin.verifikasi-laporan') }}">
                @csrf
                <input type="hidden" name="laporan_id" id="tolakLaporanId">
                <input type="hidden" name="tipe" id="tolakTipeForm">
                <input type="hidden" name="action" value="tolak">
                <div class="p-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan</label>
                    <textarea name="alasan_tolak" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" rows="4" placeholder="Masukkan alasan penolakan..." required></textarea>
                </div>
                <div class="p-6 border-t border-gray-200 flex gap-3">
                    <button type="button" onclick="closeTolakModal()" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-times mr-2"></i>Tolak Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Verification Form -->
    <form id="verifikasiForm" method="POST" action="{{ route('admin.verifikasi-laporan') }}" style="display: none;">
        @csrf
        <input type="hidden" name="laporan_id" id="laporanId">
        <input type="hidden" name="tipe" id="tipeForm">
        <input type="hidden" name="action" id="actionType">
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });
        
        // Load tidak terverifikasi data
        loadTidakTerverifikasi();
        
        function loadTidakTerverifikasi() {
            fetch('{{ route("admin.get-tidak-terverifikasi") }}')
                .then(response => response.json())
                .then(data => {
                    const content = document.getElementById('tidak-terverifikasi-content');
                    
                    if (data.pelanggaran.length === 0 && data.prestasi.length === 0) {
                        content.innerHTML = `
                            <div class="text-center py-12">
                                <i class="fas fa-check-circle text-6xl text-green-400 mb-4"></i>
                                <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak ada laporan yang ditolak</h3>
                                <p class="text-gray-500">Semua laporan telah diverifikasi dengan baik</p>
                            </div>
                        `;
                        return;
                    }
                    
                    let html = '';
                    
                    if (data.pelanggaran.length > 0) {
                        html += `
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                    <i class="fas fa-exclamation-triangle mr-2 text-red-600"></i>Pelanggaran Ditolak
                                </h3>
                                <div class="overflow-x-auto">
                                    <table class="w-full border border-gray-200 rounded-lg">
                                        <thead class="bg-red-50">
                                            <tr>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Tanggal</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Siswa</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Jenis Pelanggaran</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Pelapor</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Alasan Penolakan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                        `;
                        
                        data.pelanggaran.forEach(laporan => {
                            html += `
                                <tr class="hover:bg-red-50">
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">${new Date(laporan.created_at).toLocaleDateString('id-ID')}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">${laporan.siswa.nama}</div>
                                        <div class="text-sm text-gray-500">${laporan.siswa.nis} - ${laporan.siswa.kelas}</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">${laporan.jenis_pelanggaran.kategori}</span>
                                        <div class="text-sm text-gray-900 mt-1">${laporan.jenis_pelanggaran.nama_pelanggaran}</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">${laporan.pengadu?.name || laporan.user?.name || 'System'}</div>
                                        <div class="text-sm text-gray-500">${laporan.pengadu?.role || laporan.user?.role || 'system'}</div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm text-red-700 bg-red-50 p-2 rounded border border-red-200">
                                            ${laporan.alasan_tolak || 'Tidak ada alasan'}
                                        </div>
                                        ${laporan.verifikator ? `<div class="text-xs text-gray-500 mt-1"><i class="fas fa-user-check mr-1"></i>Ditolak oleh: ${laporan.verifikator.name} (${laporan.verifikator.role})</div>` : ''}
                                    </td>
                                </tr>
                            `;
                        });
                        
                        html += `
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        `;
                    }
                    
                    if (data.prestasi.length > 0) {
                        html += `
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                    <i class="fas fa-trophy mr-2 text-green-600"></i>Prestasi Ditolak
                                </h3>
                                <div class="overflow-x-auto">
                                    <table class="w-full border border-gray-200 rounded-lg">
                                        <thead class="bg-red-50">
                                            <tr>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Tanggal</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Siswa</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Jenis Prestasi</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Pelapor</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Alasan Penolakan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                        `;
                        
                        data.prestasi.forEach(laporan => {
                            html += `
                                <tr class="hover:bg-red-50">
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">${new Date(laporan.created_at).toLocaleDateString('id-ID')}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">${laporan.siswa.nama}</div>
                                        <div class="text-sm text-gray-500">${laporan.siswa.nis} - ${laporan.siswa.kelas}</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">${laporan.prestasi.kategori}</span>
                                        <div class="text-sm text-gray-900 mt-1">${laporan.prestasi.nama}</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">${laporan.pengadu?.name || laporan.user?.name || 'System'}</div>
                                        <div class="text-sm text-gray-500">${laporan.pengadu?.role || laporan.user?.role || 'system'}</div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm text-red-700 bg-red-50 p-2 rounded border border-red-200">
                                            ${laporan.alasan_tolak || 'Tidak ada alasan'}
                                        </div>
                                        ${laporan.verifikator ? `<div class="text-xs text-gray-500 mt-1"><i class="fas fa-user-check mr-1"></i>Ditolak oleh: ${laporan.verifikator.name} (${laporan.verifikator.role})</div>` : ''}
                                    </td>
                                </tr>
                            `;
                        });
                        
                        html += `
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        `;
                    }
                    
                    content.innerHTML = html;
                    
                    // Update stats card
                    const totalTidakTerverifikasi = data.pelanggaran.length + data.prestasi.length;
                    document.getElementById('totalTidakTerverifikasi').textContent = totalTidakTerverifikasi;
                })
                .catch(error => {
                    console.error('Error loading tidak terverifikasi data:', error);
                    document.getElementById('tidak-terverifikasi-content').innerHTML = `
                        <div class="text-center py-12">
                            <i class="fas fa-exclamation-triangle text-6xl text-red-400 mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-600 mb-2">Gagal memuat data</h3>
                            <p class="text-gray-500">Terjadi kesalahan saat memuat data laporan yang ditolak</p>
                        </div>
                    `;
                });
        }
        
        function showImage(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        let currentLaporanId = null;
        let currentTipe = null;
        
        function openTerimaModal(laporanId, tipe) {
            currentLaporanId = laporanId;
            currentTipe = tipe;
            document.getElementById('terimaModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        function closeTerimaModal() {
            document.getElementById('terimaModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        function submitTerima() {
            document.getElementById('laporanId').value = currentLaporanId;
            document.getElementById('tipeForm').value = currentTipe;
            document.getElementById('actionType').value = 'terima';
            document.getElementById('verifikasiForm').submit();
        }
        
        function openTolakModal(laporanId, tipe) {
            document.getElementById('tolakLaporanId').value = laporanId;
            document.getElementById('tolakTipeForm').value = tipe;
            document.getElementById('tolakModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        function closeTolakModal() {
            document.getElementById('tolakModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        // Close modal when clicking outside
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });
        
        document.getElementById('terimaModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeTerimaModal();
            }
        });
        
        document.getElementById('tolakModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeTolakModal();
            }
        });
    </script>

</body>
</html>