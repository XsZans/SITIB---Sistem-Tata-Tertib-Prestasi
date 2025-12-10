@include('layouts.siswa-navbar', ['title' => 'Pelanggaran Saya', 'subtitle' => 'Riwayat pelanggaran dan sanksi'])

<div class="container mx-auto px-4 py-8 max-w-6xl">
    <main class="glass-card rounded-2xl shadow-xl p-8 mb-8" data-aos="fade-up">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Riwayat Pelanggaran</h2>
            <p class="text-gray-600">Catatan pelanggaran yang pernah dilakukan</p>
        </div>

        @if($pelanggaran->count() > 0)
            <div class="grid gap-6">
                @foreach($pelanggaran as $p)
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300">
                    <!-- Header -->
                    <div class="bg-gradient-to-r {{ $p->jenisPelanggaran->poin <= 5 ? 'from-yellow-50 to-yellow-100' : ($p->jenisPelanggaran->poin <= 15 ? 'from-orange-50 to-orange-100' : 'from-red-50 to-red-100') }} px-6 py-4 border-b border-gray-100">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $p->jenisPelanggaran->nama_pelanggaran }}</h3>
                                <div class="flex items-center gap-3 text-sm">
                                    <span class="px-2 py-1 bg-white/70 rounded-lg font-medium text-gray-700">
                                        @php
                                            $kategoriMap = [
                                                'I' => 'Kerapihan & Kerajinan',
                                                'II' => 'Kehadiran & Ketepatan',
                                                'III' => 'Sikap & Perilaku',
                                                'IV' => 'Keamanan & Ketertiban',
                                                'V' => 'Pelanggaran Berat'
                                            ];
                                        @endphp
                                        <i class="fas fa-tag mr-1"></i>{{ $kategoriMap[$p->jenisPelanggaran->kategori] ?? $p->jenisPelanggaran->kategori }}
                                    </span>
                                    <span class="px-2 py-1 bg-white/70 rounded-lg font-medium text-gray-700">
                                        <i class="fas fa-calendar mr-1"></i>{{ $p->created_at->format('d M Y') }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex flex-col items-end gap-2">
                                <span class="px-3 py-1 text-sm font-bold rounded-full text-white
                                    {{ $p->jenisPelanggaran->poin <= 5 ? 'bg-yellow-500' : 
                                       ($p->jenisPelanggaran->poin <= 15 ? 'bg-orange-500' : 'bg-red-500') }}">
                                    {{ $p->jenisPelanggaran->poin }} Poin
                                </span>
                                @php
                                    if ($p->status == 'selesai' || $p->sanksi_selesai) {
                                        $statusClass = 'bg-green-100 text-green-800';
                                        $statusIcon = 'fas fa-check';
                                        $statusText = 'Selesai';
                                    } elseif ($p->status == 'dalam_sanksi') {
                                        $statusClass = 'bg-blue-100 text-blue-800';
                                        $statusIcon = 'fas fa-clock';
                                        $statusText = 'Dalam Sanksi';
                                    } elseif ($p->status == 'pending') {
                                        $statusClass = 'bg-yellow-100 text-yellow-800';
                                        $statusIcon = 'fas fa-hourglass-half';
                                        $statusText = 'Menunggu Sanksi';
                                    } else {
                                        $statusClass = 'bg-gray-100 text-gray-800';
                                        $statusIcon = 'fas fa-clock';
                                        $statusText = ucfirst(str_replace('_', ' ', $p->status));
                                    }
                                @endphp
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusClass }}">
                                    <i class="{{ $statusIcon }} mr-1"></i>{{ $statusText }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-6">
                        <div class="bg-blue-50 border-l-4 border-blue-400 rounded-r-lg p-4 mb-4">
                            <h4 class="text-sm font-semibold text-blue-800 mb-1">
                                <i class="fas fa-sticky-note mr-1"></i>Catatan Pelapor:
                            </h4>
                            <p class="text-sm text-blue-700">{{ $p->keterangan ?: '-' }}</p>
                        </div>
                        
                        <!-- Footer Info -->
                        <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-user-tie mr-2"></i>
                                <span>Dilaporkan oleh: <strong>{{ $p->user->name ?? 'Sistem' }}</strong></span>
                            </div>
                            @if($p->verifikator)
                                <div class="flex items-center text-sm text-green-600">
                                    <i class="fas fa-user-check mr-2"></i>
                                    <span>Diverifikasi: <strong>{{ $p->verifikator->name }}</strong></span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check text-green-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Tidak Ada Pelanggaran</h3>
                <p class="text-gray-600">Selamat! Anda memiliki catatan yang bersih</p>
            </div>
        @endif
    </main>
</div>

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