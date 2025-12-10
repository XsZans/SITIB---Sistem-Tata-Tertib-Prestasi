<!-- Navbar -->
<nav class="bg-white/95 backdrop-blur-sm shadow-lg relative" style="z-index: 9999;" data-aos="fade-down">
    <div class="container mx-auto px-4 max-w-6xl relative" style="overflow: visible;">
        <div class="flex items-center justify-between py-3">
            <!-- Logo & Brand -->
            <div class="flex items-center gap-2 md:gap-3">
                <div class="w-8 h-8 md:w-10 md:h-10 flex items-center justify-center">
                    <img src="{{ asset('assets/img/logo.jpg') }}" alt="Logo SMK" class="w-8 h-8 md:w-10 md:h-10 object-contain rounded-lg">
                </div>
                <div>
                    <h1 class="text-xs md:text-lg font-bold text-gray-800">{{ $title ?? 'Sistem Tata Tertib & Prestasi' }}</h1>
                    <p class="text-xs md:text-sm text-gray-600">{{ $subtitle ?? 'Dashboard Administrator' }}</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center gap-2">
                <a href="{{ route('admin.index') }}" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-1.5 rounded-lg font-medium transition-all duration-200 border border-gray-200 text-sm {{ request()->routeIs('admin.index') ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}">
                    <i class="fas fa-home mr-1"></i>Dashboard
                </a>
                <div class="relative">
                    <button onclick="togglePelanggaranDropdown()" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-1.5 rounded-lg font-medium transition-all duration-200 border border-gray-200 text-sm">
                        <i class="fas fa-exclamation-triangle mr-1"></i>Pelanggaran <i class="fas fa-chevron-down ml-1"></i>
                    </button>
                    <div id="pelanggaranDropdown" class="hidden absolute top-full left-0 mt-1 w-40 bg-white rounded-lg shadow-xl border border-gray-200 z-50">
                        <div class="flex flex-col">
                            <a href="{{ route('admin.pelanggaran') }}" class="px-3 py-2 hover:bg-gray-50 transition-colors text-xs border-b">
                                <i class="fas fa-exclamation-triangle text-gray-600 text-xs mr-2"></i>Pelanggaran
                            </a>
                            <a href="{{ route('admin.laporan') }}" class="px-3 py-2 hover:bg-gray-50 transition-colors text-xs border-b">
                                <i class="fas fa-clipboard-list text-gray-600 text-xs mr-2"></i>Laporan
                            </a>
                            <a href="{{ route('admin.sanksi') }}" class="px-3 py-2 hover:bg-gray-50 transition-colors text-xs border-b">
                                <i class="fas fa-gavel text-gray-600 text-xs mr-2"></i>Sanksi
                            </a>
                            <a href="{{ route('admin.pelaksanaan-sanksi') }}" class="px-3 py-2 hover:bg-gray-50 rounded-b-lg transition-colors text-xs">
                                <i class="fas fa-tasks text-gray-600 text-xs mr-2"></i>Pelaksanaan
                            </a>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <button onclick="togglePrestasiDropdown()" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-1.5 rounded-lg font-medium transition-all duration-200 border border-gray-200 text-sm">
                        <i class="fas fa-trophy mr-1"></i>Prestasi <i class="fas fa-chevron-down ml-1"></i>
                    </button>
                    <div id="prestasiDropdown" class="hidden absolute top-full left-0 mt-1 w-40 bg-white rounded-lg shadow-xl border border-gray-200 z-50">
                        <div class="flex flex-col">
                            <a href="{{ route('admin.laporan') }}#prestasi-section" class="px-3 py-2 hover:bg-gray-50 transition-colors text-xs border-b">
                                <i class="fas fa-clipboard-list text-gray-600 text-xs mr-2"></i>Laporan
                            </a>
                            <a href="{{ route('admin.prestasi') }}" class="px-3 py-2 hover:bg-gray-50 rounded-b-lg transition-colors text-xs">
                                <i class="fas fa-trophy text-gray-600 text-xs mr-2"></i>Prestasi
                            </a>
                        </div>
                    </div>
                </div>



                <div class="relative">
                    <button onclick="toggleNavUserDropdown()" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-1.5 rounded-lg font-medium transition-all duration-200 border border-gray-200 text-sm">
                        <i class="fas fa-user-cog mr-1"></i>User <i class="fas fa-chevron-down ml-1"></i>
                    </button>
                    <div id="navUserDropdown" class="hidden absolute top-full left-0 mt-1 w-36 bg-white rounded-lg shadow-xl border border-gray-200 z-50">
                        <div class="flex flex-col">
                            <a href="{{ route('admin.users') }}" class="px-3 py-2 hover:bg-gray-50 transition-colors text-xs border-b">
                                <i class="fas fa-users text-gray-600 text-xs mr-2"></i>Kelola User
                            </a>
                            <a href="{{ route('register') }}" class="px-3 py-2 hover:bg-gray-50 transition-colors text-xs border-b">
                                <i class="fas fa-user-plus text-gray-600 text-xs mr-2"></i>Tambah User
                            </a>
                            <a href="{{ route('admin.verifikasi-user') }}" class="px-3 py-2 hover:bg-gray-50 transition-colors text-xs border-b">
                                <i class="fas fa-user-check text-gray-600 text-xs mr-2"></i>Verifikasi User
                            </a>
                            <a href="{{ route('admin.input-bk') }}" class="px-3 py-2 hover:bg-gray-50 rounded-b-lg transition-colors text-xs">
                                <i class="fas fa-comments text-gray-600 text-xs mr-2"></i>Input BK
                            </a>

                        </div>
                    </div>
                </div>
                <div class="relative">
                    <button onclick="toggleProfileDropdown()" class="flex items-center gap-2 bg-gray-50 hover:bg-gray-100 px-2 py-1.5 rounded-lg border text-sm transition-colors">
                        <div class="w-6 h-6 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i class="fas fa-crown text-white text-xs"></i>
                        </div>
                        <span class="text-xs text-gray-700">Admin</span>
                        <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                    </button>
                    <div id="profileDropdown" class="hidden absolute top-full right-0 mt-1 w-40 bg-white rounded-lg shadow-xl border border-gray-200 z-50">
                        <div class="flex flex-col">
                            <a href="{{ route('profile.edit') }}" class="px-3 py-2 hover:bg-gray-50 transition-colors text-xs border-b">
                                <i class="fas fa-user text-gray-600 text-xs mr-2"></i>Profile
                            </a>
                            <a href="{{ route('admin.backup') }}" class="px-3 py-2 hover:bg-gray-50 rounded-b-lg transition-colors text-xs">
                                <i class="fas fa-database text-gray-600 text-xs mr-2"></i>Backup Data
                            </a>
                        </div>
                    </div>
                </div>
                <button onclick="showLogoutModal()" class="bg-red-50 hover:bg-red-100 text-red-700 hover:text-red-800 px-3 py-1.5 rounded-lg font-medium transition-all duration-200 border border-red-200 text-sm">
                    <i class="fas fa-sign-out-alt mr-1"></i>Logout
                </button>
            </div>

            <!-- Mobile Menu Button -->
            <button class="md:hidden text-gray-700 hover:text-blue-600" onclick="toggleMobileMenu()">
                <i class="fas fa-bars text-lg"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden pb-3">
            <div class="flex flex-col gap-2">
                <a href="{{ route('admin.index') }}" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-2 rounded-lg font-medium text-center transition-all duration-200 border border-gray-200 text-sm {{ request()->routeIs('admin.index') ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}">
                    <i class="fas fa-home mr-2"></i>Dashboard
                </a>
                <a href="{{ route('admin.pelaksanaan-sanksi') }}" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-2 rounded-lg font-medium text-center transition-all duration-200 border border-gray-200 text-sm">
                    <i class="fas fa-tasks mr-2"></i>Pelaksanaan
                </a>
                <a href="{{ route('admin.sanksi') }}" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-2 rounded-lg font-medium text-center transition-all duration-200 border border-gray-200 text-sm">
                    <i class="fas fa-gavel mr-2"></i>Sanksi
                </a>
                <a href="{{ route('admin.laporan') }}" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-2 rounded-lg font-medium text-center transition-all duration-200 border border-gray-200 text-sm {{ request()->routeIs('admin.laporan') ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}">
                    <i class="fas fa-clipboard-list mr-2"></i>Laporan
                </a>
                <a href="{{ route('admin.guru') }}" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-2 rounded-lg font-medium text-center transition-all duration-200 border border-gray-200 text-sm">
                    <i class="fas fa-chalkboard-teacher mr-2"></i>Pengajar
                </a>
                <a href="{{ route('admin.siswa') }}" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-2 rounded-lg font-medium text-center transition-all duration-200 border border-gray-200 text-sm">
                    <i class="fas fa-user-graduate mr-2"></i>Siswa
                </a>

                <a href="{{ route('register') }}" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-2 rounded-lg font-medium text-center transition-all duration-200 border border-gray-200 text-sm">
                    <i class="fas fa-user-plus mr-2"></i>User
                </a>
                <button onclick="showLogoutModal()" class="w-full bg-red-50 hover:bg-red-100 text-red-700 hover:text-red-800 px-3 py-2 rounded-lg font-medium text-center transition-all duration-200 border border-red-200 text-sm">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Floating Action Button -->
<div class="fixed bottom-6 right-6 z-50">
    <button onclick="toggleFab()" id="fabButton" class="w-12 h-12 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-full shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
        <i class="fas fa-plus text-lg" id="fabIcon"></i>
    </button>
    
    <!-- FAB Menu -->
    <div id="fabMenu" class="absolute bottom-16 right-0 hidden space-y-2">
        <div class="flex items-center gap-2">
            <span class="bg-black text-white px-2 py-1 rounded text-xs whitespace-nowrap">Reward</span>
            <a href="{{ route('admin.prestasi') }}" class="w-10 h-10 bg-green-600 hover:bg-green-700 text-white rounded-full shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                <i class="fas fa-trophy text-sm"></i>
            </a>
        </div>
        <div class="flex items-center gap-2">
            <span class="bg-black text-white px-2 py-1 rounded text-xs whitespace-nowrap">Sanksi</span>
            <a href="{{ route('admin.sanksi') }}" class="w-10 h-10 bg-orange-600 hover:bg-orange-700 text-white rounded-full shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                <i class="fas fa-gavel text-sm"></i>
            </a>
        </div>
        <div class="flex items-center gap-2">
            <span class="bg-black text-white px-2 py-1 rounded text-xs whitespace-nowrap">Laporan</span>
            <a href="{{ route('admin.laporan') }}" class="w-10 h-10 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                <i class="fas fa-clipboard-check text-sm"></i>
            </a>
        </div>
        <div class="flex items-center gap-2">
            <span class="bg-black text-white px-2 py-1 rounded text-xs whitespace-nowrap">Siswa</span>
            <a href="{{ route('admin.siswa') }}" class="w-10 h-10 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                <i class="fas fa-users text-sm"></i>
            </a>
        </div>
        <div class="flex items-center gap-2">
            <span class="bg-black text-white px-2 py-1 rounded text-xs whitespace-nowrap">Guru</span>
            <a href="{{ route('admin.guru') }}" class="w-10 h-10 bg-purple-600 hover:bg-purple-700 text-white rounded-full shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                <i class="fas fa-chalkboard-teacher text-sm"></i>
            </a>
        </div>
        <div class="flex items-center gap-2">
            <span class="bg-black text-white px-2 py-1 rounded text-xs whitespace-nowrap">Orang Tua</span>
            <a href="{{ route('admin.orang-tua') }}" class="w-10 h-10 bg-pink-600 hover:bg-pink-700 text-white rounded-full shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                <i class="fas fa-users text-sm"></i>
            </a>
        </div>
        <div class="flex items-center gap-2">
            <span class="bg-black text-white px-2 py-1 rounded text-xs whitespace-nowrap">Tidak Terverifikasi</span>
            <a href="{{ route('admin.laporan') }}#tidak-terverifikasi-section" class="w-10 h-10 bg-red-600 hover:bg-red-700 text-white rounded-full shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                <i class="fas fa-times-circle text-sm"></i>
            </a>
        </div>
    </div>
</div>

<script>
    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.toggle('hidden');
    }
    
    function toggleNavUserDropdown() {
        document.getElementById('navUserDropdown').classList.toggle('hidden');
    }
    

    
    function togglePelanggaranDropdown() {
        document.getElementById('pelanggaranDropdown').classList.toggle('hidden');
    }
    
    function togglePrestasiDropdown() {
        document.getElementById('prestasiDropdown').classList.toggle('hidden');
    }
    
    function toggleProfileDropdown() {
        document.getElementById('profileDropdown').classList.toggle('hidden');
    }
    

    
    function openNavUserModal() {
        if (typeof openUserModal === 'function') {
            openUserModal();
        }
        document.getElementById('navUserDropdown').classList.add('hidden');
    }
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('#navUserDropdown') && !e.target.closest('button[onclick="toggleNavUserDropdown()"]')) {
            document.getElementById('navUserDropdown').classList.add('hidden');
        }

        if (!e.target.closest('#pelanggaranDropdown') && !e.target.closest('button[onclick="togglePelanggaranDropdown()"]')) {
            document.getElementById('pelanggaranDropdown').classList.add('hidden');
        }
        if (!e.target.closest('#prestasiDropdown') && !e.target.closest('button[onclick="togglePrestasiDropdown()"]')) {
            document.getElementById('prestasiDropdown').classList.add('hidden');
        }
        if (!e.target.closest('#profileDropdown') && !e.target.closest('button[onclick="toggleProfileDropdown()"]')) {
            document.getElementById('profileDropdown').classList.add('hidden');
        }

    });
    
    // FAB Functions
    let fabOpen = false;
    
    function toggleFab() {
        const fabMenu = document.getElementById('fabMenu');
        const fabIcon = document.getElementById('fabIcon');
        
        if (fabOpen) {
            fabMenu.classList.add('hidden');
            fabIcon.classList.remove('fa-times');
            fabIcon.classList.add('fa-plus');
            fabOpen = false;
        } else {
            fabMenu.classList.remove('hidden');
            fabIcon.classList.remove('fa-plus');
            fabIcon.classList.add('fa-times');
            fabOpen = true;
        }
    }
    
    // Close FAB when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('#fabButton') && !e.target.closest('#fabMenu') && fabOpen) {
            toggleFab();
        }
    });
    
    // Logout Modal Functions
    function showLogoutModal() {
        const modal = document.createElement('div');
        modal.id = 'logoutModal';
        modal.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4';
        modal.innerHTML = `
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-sign-out-alt text-red-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Konfirmasi Logout</h3>
                            <p class="text-sm text-gray-600">Anda akan keluar dari sistem</p>
                        </div>
                    </div>
                    
                    <p class="text-gray-700 mb-6">Apakah Anda yakin ingin logout dari dashboard admin?</p>
                    
                    <div class="flex gap-3">
                        <button onclick="closeLogoutModal()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg transition-colors">
                            Batal
                        </button>
                        <button onclick="confirmLogout()" class="flex-1 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        document.body.appendChild(modal);
        document.body.style.overflow = 'hidden';
        
        // Close when clicking outside
        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeLogoutModal();
        });
    }
    
    function closeLogoutModal() {
        const modal = document.getElementById('logoutModal');
        if (modal) {
            modal.remove();
            document.body.style.overflow = 'auto';
        }
    }
    
    function confirmLogout() {
        window.location.href = '{{ route('custom.logout') }}';
    }
</script>