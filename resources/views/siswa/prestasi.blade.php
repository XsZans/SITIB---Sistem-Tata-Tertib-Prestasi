@include('layouts.siswa-navbar', ['title' => 'Prestasi Saya', 'subtitle' => 'Riwayat prestasi yang telah diraih'])

<div class="container mx-auto px-4 py-8 max-w-6xl">
    <main class="glass-card rounded-2xl shadow-xl p-8 mb-8" data-aos="fade-up">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Riwayat Prestasi</h2>
            <p class="text-gray-600">Prestasi yang telah Anda raih</p>
        </div>

        @if($prestasi->count() > 0)
            <div class="space-y-4">
                @foreach($prestasi as $p)
                <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ $p->prestasi->nama }}</h3>
                            <p class="text-sm text-gray-600">{{ $p->prestasi->kategori }} - {{ $p->prestasi->tingkat }}</p>
                        </div>
                        <div class="text-right">
                            <span class="px-3 py-1 text-sm font-semibold rounded-full 
                                {{ $p->status == 'diverifikasi' ? 'bg-green-100 text-green-800' : 
                                   ($p->status == 'menunggu_verifikasi' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst(str_replace('_', ' ', $p->status)) }}
                            </span>
                            <p class="text-xs text-gray-500 mt-1">+{{ $p->prestasi->poin_pengurangan }} poin</p>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 mb-3">{{ $p->prestasi->deskripsi }}</p>
                    
                    <div class="flex justify-between items-center text-sm text-gray-500">
                        <span><i class="fas fa-calendar mr-1"></i>{{ $p->created_at->format('d M Y') }}</span>
                        @if($p->keterangan)
                            <span class="italic">{{ $p->keterangan }}</span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-trophy text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Prestasi</h3>
                <p class="text-gray-600">Prestasi Anda akan muncul di sini setelah diverifikasi</p>
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