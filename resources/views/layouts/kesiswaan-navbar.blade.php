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
                    <p class="text-xs md:text-sm text-gray-600">{{ $subtitle ?? 'Dashboard Kesiswaan' }}</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center gap-2">
                <a href="{{ route('kesiswaan.index') }}" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-1.5 rounded-lg font-medium transition-all duration-200 border border-gray-200 text-sm {{ request()->routeIs('kesiswaan.index') ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}">
                    <i class="fas fa-home mr-1"></i>Dashboard
                </a>
                <div class="relative">
                    <button onclick="togglePelanggaranDropdown()" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-1.5 rounded-lg font-medium transition-all duration-200 border border-gray-200 text-sm">
                        <i class="fas fa-exclamation-triangle mr-1"></i>Pelanggaran <i class="fas fa-chevron-down ml-1"></i>
                    </button>
                    <div id="pelanggaranDropdown" class="hidden absolute top-full right-0 mt-1 w-40 bg-white rounded-lg shadow-xl border border-gray-200" style="z-index: 9999999; position: fixed;">
                        <div class="flex flex-col">
                            <a href="{{ route('kesiswaan.pelanggaran') }}" class="px-3 py-2 hover:bg-gray-50 transition-colors text-xs border-b">
                                <i class="fas fa-exclamation-triangle text-gray-600 text-xs mr-2"></i>Pelanggaran
                            </a>
                            <a href="{{ route('kesiswaan.laporan') }}" class="px-3 py-2 hover:bg-gray-50 transition-colors text-xs border-b">
                                <i class="fas fa-clipboard-list text-gray-600 text-xs mr-2"></i>Laporan
                            </a>
                            <a href="{{ route('kesiswaan.sanksi') }}" class="px-3 py-2 hover:bg-gray-50 transition-colors text-xs border-b">
                                <i class="fas fa-gavel text-gray-600 text-xs mr-2"></i>Sanksi
                            </a>
                            <a href="{{ route('kesiswaan.pelaksanaan-sanksi') }}" class="px-3 py-2 hover:bg-gray-50 rounded-b-lg transition-colors text-xs">
                                <i class="fas fa-tasks text-gray-600 text-xs mr-2"></i>Pelaksanaan
                            </a>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <button onclick="togglePrestasiDropdown()" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-1.5 rounded-lg font-medium transition-all duration-200 border border-gray-200 text-sm">
                        <i class="fas fa-trophy mr-1"></i>Prestasi <i class="fas fa-chevron-down ml-1"></i>
                    </button>
                    <div id="prestasiDropdown" class="hidden absolute top-full right-0 mt-1 w-40 bg-white rounded-lg shadow-xl border border-gray-200" style="z-index: 9999999; position: fixed;">
                        <div class="flex flex-col">
                            <a href="{{ route('kesiswaan.laporan') }}#prestasi-section" class="px-3 py-2 hover:bg-gray-50 transition-colors text-xs border-b">
                                <i class="fas fa-clipboard-list text-gray-600 text-xs mr-2"></i>Laporan
                            </a>
                            <a href="{{ route('kesiswaan.prestasi') }}" class="px-3 py-2 hover:bg-gray-50 rounded-b-lg transition-colors text-xs">
                                <i class="fas fa-trophy text-gray-600 text-xs mr-2"></i>Prestasi
                            </a>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <button onclick="toggleKelolaDropdown()" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-1.5 rounded-lg font-medium transition-all duration-200 border border-gray-200 text-sm">
                        <i class="fas fa-users-cog mr-1"></i>Kelola <i class="fas fa-chevron-down ml-1"></i>
                    </button>
                    <div id="kelolaDropdown" class="hidden absolute top-full right-0 mt-1 w-40 bg-white rounded-lg shadow-xl border border-gray-200" style="z-index: 9999999; position: fixed;">
                        <div class="flex flex-col">
                            <a href="{{ route('kesiswaan.guru') }}" class="px-3 py-2 hover:bg-gray-50 transition-colors text-xs border-b">
                                <i class="fas fa-chalkboard-teacher text-gray-600 text-xs mr-2"></i>Pengajar
                            </a>
                            <a href="{{ route('kesiswaan.siswa') }}" class="px-3 py-2 hover:bg-gray-50 rounded-b-lg transition-colors text-xs">
                                <i class="fas fa-user-graduate text-gray-600 text-xs mr-2"></i>Siswa
                            </a>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <button onclick="toggleProfileDropdown()" class="flex items-center gap-2 bg-gray-50 hover:bg-gray-100 px-2 py-1.5 rounded-lg border text-sm transition-colors">
                        <div class="w-6 h-6 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i class="fas fa-clipboard-list text-white text-xs"></i>
                        </div>
                        <span class="text-xs text-gray-700">Kesiswaan</span>
                        <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                    </button>
                    <div id="profileDropdown" class="hidden absolute top-full right-0 mt-1 w-40 bg-white rounded-lg shadow-xl border border-gray-200 z-50">
                        <div class="flex flex-col">
                            <a href="{{ route('profile.edit') }}" class="px-3 py-2 hover:bg-gray-50 transition-colors text-xs border-b">
                                <i class="fas fa-user text-gray-600 text-xs mr-2"></i>Profile
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
                <a href="{{ route('kesiswaan.index') }}" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-2 rounded-lg font-medium text-center transition-all duration-200 border border-gray-200 text-sm {{ request()->routeIs('kesiswaan.index') ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}">
                    <i class="fas fa-home mr-2"></i>Dashboard
                </a>
                <a href="{{ route('kesiswaan.pelaksanaan-sanksi') }}" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-2 rounded-lg font-medium text-center transition-all duration-200 border border-gray-200 text-sm">
                    <i class="fas fa-tasks mr-2"></i>Pelaksanaan
                </a>
                <a href="{{ route('kesiswaan.sanksi') }}" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-2 rounded-lg font-medium text-center transition-all duration-200 border border-gray-200 text-sm">
                    <i class="fas fa-gavel mr-2"></i>Sanksi
                </a>
                <a href="{{ route('kesiswaan.laporan') }}" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-2 rounded-lg font-medium text-center transition-all duration-200 border border-gray-200 text-sm {{ request()->routeIs('kesiswaan.laporan') ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}">
                    <i class="fas fa-clipboard-list mr-2"></i>Laporan
                </a>
                <button onclick="showLogoutModal()" class="w-full bg-red-50 hover:bg-red-100 text-red-700 hover:text-red-800 px-3 py-2 rounded-lg font-medium text-center transition-all duration-200 border border-red-200 text-sm">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </button>
            </div>
        </div>
    </div>
</nav>

<script>
    function togglePelanggaranDropdown() {
        const dropdown = document.getElementById('pelanggaranDropdown');
        const prestasiDropdown = document.getElementById('prestasiDropdown');
        
        prestasiDropdown.classList.add('hidden');
        dropdown.classList.toggle('hidden');
        
        if (!dropdown.classList.contains('hidden')) {
            const button = dropdown.previousElementSibling;
            const rect = button.getBoundingClientRect();
            dropdown.style.top = (rect.bottom + window.scrollY) + 'px';
            dropdown.style.right = (window.innerWidth - rect.right) + 'px';
        }
    }

    function togglePrestasiDropdown() {
        const dropdown = document.getElementById('prestasiDropdown');
        const pelanggaranDropdown = document.getElementById('pelanggaranDropdown');
        
        pelanggaranDropdown.classList.add('hidden');
        dropdown.classList.toggle('hidden');
        
        if (!dropdown.classList.contains('hidden')) {
            const button = dropdown.previousElementSibling;
            const rect = button.getBoundingClientRect();
            dropdown.style.top = (rect.bottom + window.scrollY) + 'px';
            dropdown.style.right = (window.innerWidth - rect.right) + 'px';
        }
    }

    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
    }
    
    function toggleKelolaDropdown() {
        const dropdown = document.getElementById('kelolaDropdown');
        dropdown.classList.toggle('hidden');
        
        if (!dropdown.classList.contains('hidden')) {
            const button = dropdown.previousElementSibling;
            const rect = button.getBoundingClientRect();
            dropdown.style.top = (rect.bottom + window.scrollY) + 'px';
            dropdown.style.right = (window.innerWidth - rect.right) + 'px';
        }
    }
    
    function toggleProfileDropdown() {
        document.getElementById('profileDropdown').classList.toggle('hidden');
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        const pelanggaranDropdown = document.getElementById('pelanggaranDropdown');
        const prestasiDropdown = document.getElementById('prestasiDropdown');
        const kelolaDropdown = document.getElementById('kelolaDropdown');
        const profileDropdown = document.getElementById('profileDropdown');
        
        if (!event.target.closest('.relative')) {
            pelanggaranDropdown.classList.add('hidden');
            prestasiDropdown.classList.add('hidden');
            kelolaDropdown.classList.add('hidden');
            profileDropdown.classList.add('hidden');
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
                    
                    <p class="text-gray-700 mb-6">Apakah Anda yakin ingin logout dari dashboard kesiswaan?</p>
                    
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