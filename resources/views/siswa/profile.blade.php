@include('layouts.siswa-navbar', ['title' => 'Profil Saya', 'subtitle' => 'Informasi data pribadi'])

<div class="container mx-auto px-4 py-8 max-w-6xl">
    <!-- Profil Siswa -->
    <div class="glass-card rounded-2xl p-8 mb-8" data-aos="fade-up">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Data Pribadi</h2>
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
                <div class="flex items-center">
                    <i class="fas fa-birthday-cake text-blue-600 w-5 mr-3"></i>
                    <div>
                        <span class="text-sm text-gray-600">TTL:</span>
                        <span class="font-medium text-gray-800 ml-2">
                            {{ $siswa->tempat_lahir }}, {{ $siswa->tanggal_lahir ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d M Y') : '-' }}
                        </span>
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

    <!-- Data Orang Tua -->
    @if($siswa->orangTua)
    <div class="glass-card rounded-2xl p-8 mb-8" data-aos="fade-up" data-aos-delay="200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Data Orang Tua</h2>
            @if($siswa->orang_tua_user_id)
                <span class="px-3 py-1 text-sm bg-green-100 text-green-800 rounded-full font-medium">
                    <i class="fas fa-users-check mr-1"></i>Akun Terdaftar
                </span>
            @else
                <span class="px-3 py-1 text-sm bg-orange-100 text-orange-800 rounded-full font-medium">
                    <i class="fas fa-user-clock mr-1"></i>Belum Terdaftar
                </span>
            @endif
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div class="flex items-center">
                    <i class="fas fa-male text-yellow-600 w-5 mr-3"></i>
                    <div>
                        <span class="text-sm text-gray-600">Nama Ayah:</span>
                        <span class="font-medium text-gray-800 ml-2">{{ $siswa->orangTua->nama_ayah }}</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-female text-yellow-600 w-5 mr-3"></i>
                    <div>
                        <span class="text-sm text-gray-600">Nama Ibu:</span>
                        <span class="font-medium text-gray-800 ml-2">{{ $siswa->orangTua->nama_ibu }}</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-phone text-yellow-600 w-5 mr-3"></i>
                    <div>
                        <span class="text-sm text-gray-600">No. HP:</span>
                        <span class="font-medium text-gray-800 ml-2">{{ $siswa->orangTua->no_hp }}</span>
                    </div>
                </div>
            </div>
            <div class="space-y-4">
                <div class="flex items-center">
                    <i class="fas fa-briefcase text-yellow-600 w-5 mr-3"></i>
                    <div>
                        <span class="text-sm text-gray-600">Pekerjaan Ayah:</span>
                        <span class="font-medium text-gray-800 ml-2">{{ $siswa->orangTua->pekerjaan_ayah }}</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-briefcase text-yellow-600 w-5 mr-3"></i>
                    <div>
                        <span class="text-sm text-gray-600">Pekerjaan Ibu:</span>
                        <span class="font-medium text-gray-800 ml-2">{{ $siswa->orangTua->pekerjaan_ibu }}</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-home text-yellow-600 w-5 mr-3"></i>
                    <div>
                        <span class="text-sm text-gray-600">Alamat:</span>
                        <span class="font-medium text-gray-800 ml-2">{{ $siswa->orangTua->alamat }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" data-aos="fade-up" data-aos-delay="400">
        <div class="glass-card rounded-2xl p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Statistik Pelanggaran</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Total Poin:</span>
                    <span class="font-bold text-red-600">{{ $siswa->poin_pelanggaran }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-red-600 h-2 rounded-full" style="width: {{ min(($siswa->poin_pelanggaran / 100) * 100, 100) }}%"></div>
                </div>
            </div>
        </div>
        
        <div class="glass-card rounded-2xl p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Statistik Prestasi</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Total Poin:</span>
                    <span class="font-bold text-green-600">{{ $siswa->poin_prestasi ?? 0 }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-600 h-2 rounded-full" style="width: {{ min((($siswa->poin_prestasi ?? 0) / 50) * 100, 100) }}%"></div>
                </div>
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
</script>

</body>
</html>