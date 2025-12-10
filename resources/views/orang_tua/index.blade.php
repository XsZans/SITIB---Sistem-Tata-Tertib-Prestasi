@extends('layouts.orang-tua-navbar')

@section('title', 'Dashboard Orang Tua')

@section('content')
<div class="container mx-auto px-4 py-4 md:py-8 max-w-6xl">
    @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-lg" data-aos="fade-down">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-3 text-green-600"></i>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <main class="bg-white/95 backdrop-blur-sm rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-10 mb-8" data-aos="fade-up" data-aos-duration="800">

        <!-- Welcome Section -->
        <div class="text-center mb-8 md:mb-16" data-aos="fade-up" data-aos-delay="200">
            <div class="flex justify-center mb-4 md:mb-6">
                <div class="typing-text">
                    <span id="typed-text"></span>
                </div>
            </div>
            <div class="inline-block bg-gradient-to-r from-green-500 to-emerald-600 text-white px-4 md:px-6 py-1.5 md:py-2 rounded-full text-xs md:text-sm font-semibold mb-3 md:mb-4 shadow-lg">
                DASHBOARD ORANG TUA
            </div>
            <h2 class="text-2xl md:text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-3 md:mb-4">
                Dashboard Orang Tua Sistem Tata Tertib & Prestasi
            </h2>
            <p class="text-gray-600 max-w-3xl mx-auto text-sm md:text-lg leading-relaxed px-2">
                Pantau perkembangan anak Anda dengan mudah melalui dashboard ini
            </p>
            <div class="flex items-center justify-center gap-2 mt-4 md:mt-6">
                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                <span class="text-green-600 text-sm font-medium">System Online</span>
            </div>
        </div>

        <!-- Data Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8" data-aos="fade-up" data-aos-delay="300">
            <!-- Data Orang Tua -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-users text-white text-lg"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Data Orang Tua</h3>
                </div>
                @if($orangTua)
                    <div class="space-y-4">
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-male text-blue-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Nama Ayah</p>
                                <p class="font-semibold text-gray-800">{{ $orangTua->nama_ayah }}</p>
                            </div>
                        </div>
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <div class="w-8 h-8 bg-pink-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-female text-pink-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Nama Ibu</p>
                                <p class="font-semibold text-gray-800">{{ $orangTua->nama_ibu }}</p>
                            </div>
                        </div>
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-map-marker-alt text-green-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Alamat</p>
                                <p class="font-semibold text-gray-800">{{ $orangTua->alamat ?? 'Tidak ada data' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-phone text-yellow-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">No. HP</p>
                                <p class="font-semibold text-gray-800">{{ $orangTua->no_hp ?? 'Tidak ada data' }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-user-slash text-4xl text-gray-400 mb-3"></i>
                        <p class="text-gray-500">Data orang tua tidak ditemukan</p>
                    </div>
                @endif
            </div>

            <!-- Data Anak -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-child text-white text-lg"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Data Anak</h3>
                </div>
                @if($siswa)
                    <div class="space-y-4">
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-user text-green-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Nama Lengkap</p>
                                <p class="font-semibold text-gray-800">{{ $siswa->nama }}</p>
                            </div>
                        </div>
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-id-card text-blue-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">NIS</p>
                                <p class="font-semibold text-gray-800">{{ $siswa->nis }}</p>
                            </div>
                        </div>
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-school text-purple-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Kelas</p>
                                <p class="font-semibold text-gray-800">{{ $siswa->kelas }}</p>
                            </div>
                        </div>
                        <div class="pt-2">
                            <a href="{{ route('orang_tua.export-laporan') }}" class="inline-block bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-4 py-2 rounded-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 text-sm">
                                <i class="fas fa-download mr-2"></i>Download Laporan
                            </a>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-child text-4xl text-gray-400 mb-3"></i>
                        <p class="text-gray-500">Data anak tidak ditemukan</p>
                    </div>
                @endif
            </div>
        </div>

        @if($siswa)
        <!-- Stats Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8 md:mb-16" data-aos="fade-up" data-aos-delay="400">
            <a href="{{ route('orang_tua.pelanggaran') }}" class="bg-gradient-to-br from-red-50 to-red-100 border border-red-200 rounded-xl md:rounded-2xl p-4 md:p-6 text-center hover-lift cursor-pointer transition-all">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                    <i class="fas fa-exclamation-triangle text-white text-lg md:text-2xl"></i>
                </div>
                <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Total Pelanggaran</p>
                <p class="text-xl md:text-2xl font-bold text-red-700">{{ $pelanggaranCount }}</p>
            </a>
            
            <a href="{{ route('orang_tua.prestasi') }}" class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl md:rounded-2xl p-4 md:p-6 text-center hover-lift cursor-pointer transition-all">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                    <i class="fas fa-trophy text-white text-lg md:text-2xl"></i>
                </div>
                <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Total Prestasi</p>
                <p class="text-xl md:text-2xl font-bold text-green-700">{{ $prestasiCount }}</p>
            </a>
            
            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 border border-yellow-200 rounded-xl md:rounded-2xl p-4 md:p-6 text-center">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                    <i class="fas fa-clock text-white text-lg md:text-2xl"></i>
                </div>
                <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Dalam Proses</p>
                <p class="text-xl md:text-2xl font-bold text-yellow-700">
                    <span class="text-green-600">{{ $prestasiCount - $prestasiSelesai }}</span>/<span class="text-red-600">{{ $pelanggaranCount - $pelanggaranSelesai }}</span>
                </p>
            </div>
            
            <a href="{{ route('orang_tua.selesai') }}" class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl md:rounded-2xl p-4 md:p-6 text-center hover-lift cursor-pointer transition-all">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 shadow-lg">
                    <i class="fas fa-check-circle text-white text-lg md:text-2xl"></i>
                </div>
                <p class="text-xs md:text-sm text-gray-600 font-medium mb-1">Selesai</p>
                <p class="text-xl md:text-2xl font-bold text-blue-700">{{ $pelanggaranSelesai + $prestasiSelesai }}</p>
            </a>
        </div>
        @endif

    </main>
</div>

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

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true,
        offset: 50
    });
    
    // Typing effect
    const text = "Halo Selamat Datang {{ Auth::user()->name }}";
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
@endsection