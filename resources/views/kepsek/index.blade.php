<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kepala Sekolah - SiTib</title>
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

    @include('layouts.kepsek-navbar', ['title' => 'SiTib Kepala Sekolah', 'subtitle' => 'Dashboard Kepala Sekolah'])

    <div class="container mx-auto px-4 py-4 md:py-8 max-w-6xl">
        
        <!-- Welcome Section -->
        <main class="glass-card rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-8 mb-8" data-aos="fade-up">
            <div class="text-center mb-6">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Dashboard Kepala Sekolah</h2>
                <p class="text-gray-600">Monitoring dan supervisi sistem tata tertib sekolah</p>
            </div>
        </main>

        <!-- Grafik Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8" data-aos="fade-up">
            
            <!-- Grafik Pelanggaran -->
            <div class="glass-card rounded-2xl shadow-xl p-6">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Grafik Pelanggaran</h3>
                    <p class="text-gray-600">Statistik pelanggaran siswa</p>
                </div>
                
                <!-- Filter Pelanggaran -->
                <div class="mb-6 flex gap-4">
                    <select id="periodePelanggaran" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 text-sm" onchange="togglePelanggaranInputs()">
                        <option value="bulan">Bulan</option>
                        <option value="tahun">Tahun</option>
                        <option value="all">Semua Data</option>
                    </select>
                    
                    <select id="bulanPelanggaran" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 text-sm">
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $i == now()->month ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                    
                    <select id="tahunPelanggaran" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 text-sm">
                        @for($i = now()->year; $i >= now()->year - 5; $i--)
                            <option value="{{ $i }}" {{ $i == now()->year ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                    
                    <button onclick="updatePelanggaranChart()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors text-sm">
                        <i class="fas fa-sync mr-2"></i>Update
                    </button>
                </div>
                
                <!-- Chart Pelanggaran -->
                <div class="bg-gray-50 rounded-lg p-4 mb-6 flex justify-center">
                    <div style="width: 280px; height: 280px;">
                        <canvas id="pelanggaranChart"></canvas>
                    </div>
                </div>
                
                <!-- Summary Pelanggaran -->
                <div class="grid grid-cols-3 gap-3 text-center">
                    <div class="bg-yellow-50 rounded-lg p-3">
                        <div class="text-lg font-bold text-yellow-700" id="pelanggaranRingan">0</div>
                        <div class="text-xs text-yellow-600">Ringan</div>
                    </div>
                    <div class="bg-orange-50 rounded-lg p-3">
                        <div class="text-lg font-bold text-orange-700" id="pelanggaranSedang">0</div>
                        <div class="text-xs text-orange-600">Sedang</div>
                    </div>
                    <div class="bg-red-50 rounded-lg p-3">
                        <div class="text-lg font-bold text-red-700" id="pelanggaranBerat">0</div>
                        <div class="text-xs text-red-600">Berat</div>
                    </div>
                </div>
                <button onclick="exportPelanggaranPDF()" class="w-full mt-4 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <i class="fas fa-file-pdf mr-2"></i>Export PDF
                </button>
            </div>

            <!-- Grafik Prestasi -->
            <div class="glass-card rounded-2xl shadow-xl p-6">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Grafik Prestasi</h3>
                    <p class="text-gray-600">Statistik prestasi siswa</p>
                </div>
                
                <!-- Filter Prestasi -->
                <div class="mb-6 flex gap-4">
                    <select id="periodePrestasi" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-sm" onchange="togglePrestasiInputs()">
                        <option value="bulan">Bulan</option>
                        <option value="tahun">Tahun</option>
                        <option value="all">Semua Data</option>
                    </select>
                    
                    <select id="bulanPrestasi" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-sm">
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $i == now()->month ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                    
                    <select id="tahunPrestasi" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-sm">
                        @for($i = now()->year; $i >= now()->year - 5; $i--)
                            <option value="{{ $i }}" {{ $i == now()->year ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                    
                    <button onclick="updatePrestasiChart()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors text-sm">
                        <i class="fas fa-sync mr-2"></i>Update
                    </button>
                </div>
                
                <!-- Chart Prestasi -->
                <div class="bg-gray-50 rounded-lg p-4 mb-6 flex justify-center">
                    <div style="width: 280px; height: 280px;">
                        <canvas id="prestasiChart"></canvas>
                    </div>
                </div>
                
                <!-- Summary Prestasi -->
                <div class="grid grid-cols-2 gap-3 text-center">
                    <div class="bg-green-50 rounded-lg p-3">
                        <div class="text-lg font-bold text-green-700" id="prestasiAkademik">0</div>
                        <div class="text-xs text-green-600">Akademik</div>
                    </div>
                    <div class="bg-blue-50 rounded-lg p-3">
                        <div class="text-lg font-bold text-blue-700" id="prestasiNonAkademik">0</div>
                        <div class="text-xs text-blue-600">Non-Akademik</div>
                    </div>
                </div>
                <button onclick="exportPrestasiPDF()" class="w-full mt-4 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <i class="fas fa-file-pdf mr-2"></i>Export PDF
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8" data-aos="fade-up">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-4 hover-lift text-center cursor-pointer" onclick="window.location.href='{{ route('kepsek.siswa') }}'">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                    <i class="fas fa-users text-white text-lg"></i>
                </div>
                <p class="text-xs text-gray-600 font-medium mb-1">Total Siswa</p>
                <p class="text-xl font-bold text-blue-700">{{ App\Models\Siswa::count() }}</p>
                <p class="text-xs text-blue-600 mt-1 font-medium">Klik untuk lihat detail</p>
            </div>
            
            <div class="bg-gradient-to-br from-red-50 to-red-100 border border-red-200 rounded-xl p-4 hover-lift text-center">
                <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                    <i class="fas fa-exclamation-triangle text-white text-lg"></i>
                </div>
                <p class="text-xs text-gray-600 font-medium mb-1">Pelanggaran</p>
                <p class="text-xl font-bold text-red-700">{{ App\Models\Pelanggaran::count() }}</p>
            </div>
            
            <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl p-4 hover-lift text-center">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                    <i class="fas fa-trophy text-white text-lg"></i>
                </div>
                <p class="text-xs text-gray-600 font-medium mb-1">Prestasi</p>
                <p class="text-xl font-bold text-green-700">{{ App\Models\PrestasiSiswa::where('status', 'diverifikasi')->count() }}</p>
            </div>
            
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 rounded-xl p-4 hover-lift text-center">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                    <i class="fas fa-chalkboard-teacher text-white text-lg"></i>
                </div>
                <p class="text-xs text-gray-600 font-medium mb-1">Guru</p>
                <p class="text-xl font-bold text-purple-700">{{ App\Models\Guru::count() }}</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });
        
        let pelanggaranChart, prestasiChart;
        
        // Pelanggaran Chart Functions
        function togglePelanggaranInputs() {
            const periode = document.getElementById('periodePelanggaran').value;
            const bulanFilter = document.getElementById('bulanPelanggaran');
            const tahunFilter = document.getElementById('tahunPelanggaran');
            
            if (periode === 'bulan') {
                bulanFilter.style.display = 'block';
                tahunFilter.style.display = 'block';
            } else if (periode === 'tahun') {
                bulanFilter.style.display = 'none';
                tahunFilter.style.display = 'block';
            } else {
                bulanFilter.style.display = 'none';
                tahunFilter.style.display = 'none';
            }
        }
        
        async function loadPelanggaranData() {
            const periode = document.getElementById('periodePelanggaran').value;
            const bulan = document.getElementById('bulanPelanggaran').value;
            const tahun = document.getElementById('tahunPelanggaran').value;
            
            let url = '/admin/grafik-pelanggaran?';
            if (periode === 'bulan') {
                url += `bulan=${bulan}&tahun=${tahun}`;
            } else if (periode === 'tahun') {
                url += `tahun=${tahun}`;
            }
            
            try {
                const response = await fetch(url);
                const data = await response.json();
                
                if (pelanggaranChart) {
                    pelanggaranChart.destroy();
                }
                
                const ctx = document.getElementById('pelanggaranChart').getContext('2d');
                const hasData = data.ringan > 0 || data.sedang > 0 || data.berat > 0;
                
                if (hasData) {
                    pelanggaranChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Ringan (1-5)', 'Sedang (6-15)', 'Berat (16+)'],
                            datasets: [{
                                data: [data.ringan, data.sedang, data.berat],
                                backgroundColor: [
                                    'rgba(234, 179, 8, 0.8)',
                                    'rgba(251, 146, 60, 0.8)',
                                    'rgba(239, 68, 68, 0.8)'
                                ],
                                borderColor: [
                                    'rgb(234, 179, 8)',
                                    'rgb(251, 146, 60)',
                                    'rgb(239, 68, 68)'
                                ],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }
                    });
                } else {
                    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
                    ctx.font = '14px Poppins';
                    ctx.fillStyle = '#9CA3AF';
                    ctx.textAlign = 'center';
                    ctx.fillText('Tidak ada data', ctx.canvas.width / 2, ctx.canvas.height / 2);
                }
                
                document.getElementById('pelanggaranRingan').textContent = data.ringan || 0;
                document.getElementById('pelanggaranSedang').textContent = data.sedang || 0;
                document.getElementById('pelanggaranBerat').textContent = data.berat || 0;
                
            } catch (error) {
                console.error('Error loading pelanggaran data:', error);
            }
        }
        
        function updatePelanggaranChart() {
            loadPelanggaranData();
        }
        
        // Prestasi Chart Functions
        function togglePrestasiInputs() {
            const periode = document.getElementById('periodePrestasi').value;
            const bulanFilter = document.getElementById('bulanPrestasi');
            const tahunFilter = document.getElementById('tahunPrestasi');
            
            if (periode === 'bulan') {
                bulanFilter.style.display = 'block';
                tahunFilter.style.display = 'block';
            } else if (periode === 'tahun') {
                bulanFilter.style.display = 'none';
                tahunFilter.style.display = 'block';
            } else {
                bulanFilter.style.display = 'none';
                tahunFilter.style.display = 'none';
            }
        }
        
        async function loadPrestasiData() {
            const periode = document.getElementById('periodePrestasi').value;
            const bulan = document.getElementById('bulanPrestasi').value;
            const tahun = document.getElementById('tahunPrestasi').value;
            
            let url = '/admin/grafik-prestasi?';
            if (periode === 'bulan') {
                url += `bulan=${bulan}&tahun=${tahun}`;
            } else if (periode === 'tahun') {
                url += `tahun=${tahun}`;
            }
            
            try {
                const response = await fetch(url);
                const data = await response.json();
                
                if (prestasiChart) {
                    prestasiChart.destroy();
                }
                
                const ctx = document.getElementById('prestasiChart').getContext('2d');
                const hasData = data.akademik > 0 || data.non_akademik > 0;
                
                if (hasData) {
                    prestasiChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Akademik', 'Non-Akademik'],
                            datasets: [{
                                data: [data.akademik, data.non_akademik],
                                backgroundColor: [
                                    'rgba(34, 197, 94, 0.8)',
                                    'rgba(59, 130, 246, 0.8)'
                                ],
                                borderColor: [
                                    'rgb(34, 197, 94)',
                                    'rgb(59, 130, 246)'
                                ],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        padding: 15,
                                        font: {
                                            size: 11
                                        }
                                    }
                                }
                            }
                        }
                    });
                } else {
                    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
                    ctx.font = '14px Poppins';
                    ctx.fillStyle = '#9CA3AF';
                    ctx.textAlign = 'center';
                    ctx.fillText('Tidak ada data', ctx.canvas.width / 2, ctx.canvas.height / 2);
                }
                
                document.getElementById('prestasiAkademik').textContent = data.akademik || 0;
                document.getElementById('prestasiNonAkademik').textContent = data.non_akademik || 0;
                
            } catch (error) {
                console.error('Error loading prestasi data:', error);
            }
        }
        
        function updatePrestasiChart() {
            loadPrestasiData();
        }
        
        function exportPelanggaranPDF() {
            const periode = document.getElementById('periodePelanggaran').value;
            const bulan = document.getElementById('bulanPelanggaran').value;
            const tahun = document.getElementById('tahunPelanggaran').value;
            
            let url = '/admin/export-pelanggaran?';
            url += `periode=${periode}`;
            if (periode === 'bulan') {
                url += `&bulan=${bulan}&tahun=${tahun}`;
            } else if (periode === 'tahun') {
                url += `&tahun=${tahun}`;
            }
            
            window.open(url, '_blank');
        }
        
        function exportPrestasiPDF() {
            alert('Export prestasi akan segera tersedia');
        }
        
        // Load charts on page load
        document.addEventListener('DOMContentLoaded', function() {
            togglePelanggaranInputs();
            togglePrestasiInputs();
            loadPelanggaranData();
            loadPrestasiData();
        });
    </script>

</body>
</html>