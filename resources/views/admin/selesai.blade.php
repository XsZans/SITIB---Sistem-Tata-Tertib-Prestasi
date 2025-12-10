<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Selesai - Sistem Tata Tertib & Prestasi</title>
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

    @if(Auth::user()->role === 'kesiswaan')
        @include('layouts.kesiswaan-navbar', ['title' => 'Sistem Tata Tertib & Prestasi', 'subtitle' => 'Data Selesai'])
    @else
        @include('layouts.admin-navbar', ['title' => 'Sistem Tata Tertib & Prestasi', 'subtitle' => 'Data Selesai'])
    @endif

    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <div class="glass-card rounded-2xl p-6 mb-8" data-aos="fade-up">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Data Selesai</h1>
                    <p class="text-gray-600">Prestasi dan pelanggaran yang telah selesai diproses</p>
                </div>
                <div class="flex gap-3">
                    <select id="tahunFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="{{ now()->year }}">{{ now()->year }}</option>
                        <option value="{{ now()->year - 1 }}">{{ now()->year - 1 }}</option>
                        <option value="{{ now()->year - 2 }}">{{ now()->year - 2 }}</option>
                    </select>
                    <select id="bulanFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Bulan</option>
                        <option value="1" {{ now()->month == 1 ? 'selected' : '' }}>Januari</option>
                        <option value="2" {{ now()->month == 2 ? 'selected' : '' }}>Februari</option>
                        <option value="3" {{ now()->month == 3 ? 'selected' : '' }}>Maret</option>
                        <option value="4" {{ now()->month == 4 ? 'selected' : '' }}>April</option>
                        <option value="5" {{ now()->month == 5 ? 'selected' : '' }}>Mei</option>
                        <option value="6" {{ now()->month == 6 ? 'selected' : '' }}>Juni</option>
                        <option value="7" {{ now()->month == 7 ? 'selected' : '' }}>Juli</option>
                        <option value="8" {{ now()->month == 8 ? 'selected' : '' }}>Agustus</option>
                        <option value="9" {{ now()->month == 9 ? 'selected' : '' }}>September</option>
                        <option value="10" {{ now()->month == 10 ? 'selected' : '' }}>Oktober</option>
                        <option value="11" {{ now()->month == 11 ? 'selected' : '' }}>November</option>
                        <option value="12" {{ now()->month == 12 ? 'selected' : '' }}>Desember</option>
                    </select>
                    <button onclick="loadData()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-search mr-2"></i>Filter
                    </button>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Prestasi Selesai -->
            <div class="glass-card rounded-2xl p-6" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-green-800 flex items-center">
                        <i class="fas fa-trophy mr-2"></i>Prestasi Selesai
                    </h2>
                    <span id="prestasiCount" class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">0</span>
                </div>
                <div id="prestasiContent" class="space-y-3 max-h-96 overflow-y-auto">
                    <!-- Data akan dimuat di sini -->
                </div>
            </div>

            <!-- Pelanggaran Selesai -->
            <div class="glass-card rounded-2xl p-6" data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-red-800 flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>Pelanggaran Selesai
                    </h2>
                    <span id="pelanggaranCount" class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">0</span>
                </div>
                <div id="pelanggaranContent" class="space-y-3 max-h-96 overflow-y-auto">
                    <!-- Data akan dimuat di sini -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });

        // Load data on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadData();
        });

        async function loadData() {
            const tahun = document.getElementById('tahunFilter').value;
            const bulan = document.getElementById('bulanFilter').value;
            
            try {
                // Load prestasi selesai
                const prestasiResponse = await fetch('/admin/get-prestasi-selesai');
                const prestasiData = await prestasiResponse.json();
                const prestasiContainer = document.getElementById('prestasiContent');
                const prestasiCount = document.getElementById('prestasiCount');
                
                if (prestasiData.prestasi && prestasiData.prestasi.length > 0) {
                    let filteredPrestasi = prestasiData.prestasi;
                    
                    // Apply filters
                    if (tahun || bulan) {
                        filteredPrestasi = prestasiData.prestasi.filter(p => {
                            const date = new Date(p.created_at);
                            const matchTahun = !tahun || date.getFullYear() == tahun;
                            const matchBulan = !bulan || (date.getMonth() + 1) == bulan;
                            return matchTahun && matchBulan;
                        });
                    }
                    
                    prestasiCount.textContent = filteredPrestasi.length;
                    
                    if (filteredPrestasi.length > 0) {
                        prestasiContainer.innerHTML = filteredPrestasi.map(p => `
                            <div class="bg-white rounded-lg p-4 border border-green-200 shadow-sm">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-800">${p.siswa.nama}</h4>
                                        <p class="text-green-600 text-sm">${p.prestasi.nama}</p>
                                        <div class="flex gap-2 mt-2">
                                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                                ${p.prestasi.kategori}
                                            </span>
                                            <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800">
                                                ${p.prestasi.tingkat}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-right ml-4">
                                        <div class="text-lg font-semibold text-green-600">+${p.prestasi.poin_pengurangan}</div>
                                        <div class="text-xs text-gray-500">${new Date(p.created_at).toLocaleDateString('id-ID')}</div>
                                    </div>
                                </div>
                            </div>
                        `).join('');
                    } else {
                        prestasiContainer.innerHTML = '<div class="text-center text-gray-500 py-8">Tidak ada data prestasi selesai</div>';
                    }
                } else {
                    prestasiCount.textContent = '0';
                    prestasiContainer.innerHTML = '<div class="text-center text-gray-500 py-8">Tidak ada data prestasi selesai</div>';
                }
                
                // Load pelanggaran selesai
                const pelanggaranResponse = await fetch('/admin/detail-pelanggaran?status=selesai');
                const pelanggaranData = await pelanggaranResponse.json();
                const pelanggaranContainer = document.getElementById('pelanggaranContent');
                const pelanggaranCount = document.getElementById('pelanggaranCount');
                
                if (pelanggaranData.pelanggaran && pelanggaranData.pelanggaran.length > 0) {
                    let filteredPelanggaran = pelanggaranData.pelanggaran.filter(p => p.status === 'selesai');
                    
                    // Apply filters
                    if (tahun || bulan) {
                        filteredPelanggaran = filteredPelanggaran.filter(p => {
                            const date = new Date(p.created_at);
                            const matchTahun = !tahun || date.getFullYear() == tahun;
                            const matchBulan = !bulan || (date.getMonth() + 1) == bulan;
                            return matchTahun && matchBulan;
                        });
                    }
                    
                    pelanggaranCount.textContent = filteredPelanggaran.length;
                    
                    if (filteredPelanggaran.length > 0) {
                        pelanggaranContainer.innerHTML = filteredPelanggaran.map(p => `
                            <div class="bg-white rounded-lg p-4 border border-red-200 shadow-sm">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-800">${p.siswa_nama}</h4>
                                        <p class="text-red-600 text-sm">${p.jenis_pelanggaran}</p>
                                        <div class="mt-2">
                                            <span class="px-2 py-1 text-xs rounded-full ${
                                                p.poin <= 5 ? 'bg-yellow-100 text-yellow-800' :
                                                p.poin <= 15 ? 'bg-orange-100 text-orange-800' :
                                                'bg-red-100 text-red-800'
                                            }">${p.poin} Poin</span>
                                        </div>
                                    </div>
                                    <div class="text-right ml-4">
                                        <div class="text-xs text-gray-500">${new Date(p.created_at).toLocaleDateString('id-ID')}</div>
                                        <div class="text-xs text-green-600 mt-1">
                                            <i class="fas fa-check-circle mr-1"></i>Selesai
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `).join('');
                    } else {
                        pelanggaranContainer.innerHTML = '<div class="text-center text-gray-500 py-8">Tidak ada data pelanggaran selesai</div>';
                    }
                } else {
                    pelanggaranCount.textContent = '0';
                    pelanggaranContainer.innerHTML = '<div class="text-center text-gray-500 py-8">Tidak ada data pelanggaran selesai</div>';
                }
                
            } catch (error) {
                console.error('Error loading data:', error);
                document.getElementById('prestasiContent').innerHTML = '<div class="text-center text-red-500 py-8">Error loading data</div>';
                document.getElementById('pelanggaranContent').innerHTML = '<div class="text-center text-red-500 py-8">Error loading data</div>';
            }
        }
    </script>

</body>
</html>