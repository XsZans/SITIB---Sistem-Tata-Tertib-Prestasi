@include('layouts.siswa-navbar', ['title' => 'Dashboard', 'subtitle' => 'Dashboard Siswa'])

<style>
.typing-text {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1f2937;
    display: inline-block;
}

.cursor {
    color: #1f2937;
    animation: blink 1s infinite;
}

@keyframes blink {
    0%, 50% { opacity: 1; }
    51%, 100% { opacity: 0; }
}
</style>

<div class="container mx-auto px-4 py-8 max-w-6xl">
    <!-- Welcome Section -->
    <div class="text-center mb-8" data-aos="fade-up">
        <div class="typing-text">
            <span id="typed-text"></span>
        </div>
    </div>
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8" data-aos="fade-up">
        <div class="glass-card rounded-2xl p-6 text-center hover-lift">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $totalPelanggaran }}</h3>
            <p class="text-gray-600">Total Pelanggaran</p>
        </div>
        
        <div class="glass-card rounded-2xl p-6 text-center hover-lift">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-trophy text-green-600 text-2xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $totalPrestasi }}</h3>
            <p class="text-gray-600">Total Prestasi</p>
        </div>
        
        <div class="glass-card rounded-2xl p-6 text-center hover-lift">
            <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-minus-circle text-orange-600 text-2xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $poinPelanggaran }}</h3>
            <p class="text-gray-600">Poin Pelanggaran</p>
        </div>
        
        <div class="glass-card rounded-2xl p-6 text-center hover-lift">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-star text-blue-600 text-2xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $poinPrestasi }}</h3>
            <p class="text-gray-600">Poin Prestasi</p>
        </div>
    </div>

    <!-- Profile Card -->
    <div class="glass-card rounded-2xl p-8 mb-8" data-aos="fade-up" data-aos-delay="200">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Profil Siswa</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div class="flex items-center">
                    <i class="fas fa-id-card text-blue-600 w-5 mr-3"></i>
                    <div>
                        <span class="text-sm text-gray-600">NIS:</span>
                        <span class="font-medium text-gray-800 ml-2">{{ $siswa->nis }}</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-user text-blue-600 w-5 mr-3"></i>
                    <div>
                        <span class="text-sm text-gray-600">Nama:</span>
                        <span class="font-medium text-gray-800 ml-2">{{ $siswa->nama }}</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-venus-mars text-blue-600 w-5 mr-3"></i>
                    <div>
                        <span class="text-sm text-gray-600">Jenis Kelamin:</span>
                        <span class="font-medium text-gray-800 ml-2">{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                    </div>
                </div>
            </div>
            <div class="space-y-4">
                <div class="flex items-center">
                    <i class="fas fa-school text-blue-600 w-5 mr-3"></i>
                    <div>
                        <span class="text-sm text-gray-600">Kelas:</span>
                        <span class="font-medium text-gray-800 ml-2">{{ $siswa->kelas }}</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-graduation-cap text-blue-600 w-5 mr-3"></i>
                    <div>
                        <span class="text-sm text-gray-600">Jurusan:</span>
                        <span class="font-medium text-gray-800 ml-2">{{ $siswa->jurusan }}</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-map-marker-alt text-blue-600 w-5 mr-3"></i>
                    <div>
                        <span class="text-sm text-gray-600">Alamat:</span>
                        <span class="font-medium text-gray-800 ml-2">{{ $siswa->alamat }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6" data-aos="fade-up" data-aos-delay="400">
        <a href="{{ route('siswa.prestasi') }}" class="glass-card rounded-2xl p-6 hover-lift block">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-trophy text-green-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Lihat Prestasi</h3>
                    <p class="text-gray-600 text-sm">Riwayat prestasi yang telah diraih</p>
                </div>
            </div>
        </a>
        
        <a href="{{ route('siswa.pelanggaran') }}" class="glass-card rounded-2xl p-6 hover-lift block">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Lihat Pelanggaran</h3>
                    <p class="text-gray-600 text-sm">Riwayat pelanggaran dan sanksi</p>
                </div>
            </div>
        </a>
        
        <a href="{{ route('siswa.export-laporan') }}" class="glass-card rounded-2xl p-6 hover-lift block">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-file-pdf text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Export PDF</h3>
                    <p class="text-gray-600 text-sm">Unduh laporan dalam format PDF</p>
                </div>
            </div>
        </a>
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
    
    // Typing effect
    const text = "Halo Selamat Datang {{ $siswa->nama }}";
    const typedTextElement = document.getElementById('typed-text');
    let index = 0;
    let isDeleting = false;
    
    function typeWriter() {
        const currentText = text.substring(0, index);
        typedTextElement.innerHTML = currentText + '<span class="cursor">|</span>';
        
        if (!isDeleting && index < text.length) {
            index++;
            setTimeout(typeWriter, 100);
        } else if (isDeleting && index > 0) {
            index--;
            setTimeout(typeWriter, 50);
        } else if (!isDeleting && index === text.length) {
            setTimeout(() => {
                isDeleting = true;
                typeWriter();
            }, 2000);
        } else if (isDeleting && index === 0) {
            isDeleting = false;
            setTimeout(typeWriter, 500);
        }
    }
    
    typeWriter();
</script>

</body>
</html>