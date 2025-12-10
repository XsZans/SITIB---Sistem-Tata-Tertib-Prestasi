<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Siswa' }} - Sistem Tata Tertib & Prestasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
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
<body class="bg-gray-50">
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
                        <h1 class="text-xs md:text-lg font-bold text-gray-800">Sistem Tata Tertib & Prestasi</h1>
                        <p class="text-xs md:text-sm text-gray-600">{{ $subtitle ?? 'Dashboard Siswa' }}</p>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center gap-2">
                    <a href="{{ route('siswa.dashboard') }}" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-1.5 rounded-lg font-medium transition-all duration-200 border border-gray-200 text-sm {{ request()->routeIs('siswa.dashboard') ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}">
                        <i class="fas fa-home mr-1"></i>Dashboard
                    </a>
                    <a href="{{ route('siswa.prestasi') }}" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-1.5 rounded-lg font-medium transition-all duration-200 border border-gray-200 text-sm {{ request()->routeIs('siswa.prestasi') ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}">
                        <i class="fas fa-trophy mr-1"></i>Prestasi
                    </a>
                    <a href="{{ route('siswa.pelanggaran') }}" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-1.5 rounded-lg font-medium transition-all duration-200 border border-gray-200 text-sm {{ request()->routeIs('siswa.pelanggaran') ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}">
                        <i class="fas fa-exclamation-triangle mr-1"></i>Pelanggaran
                    </a>
                    <a href="{{ route('siswa.bk') }}" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-1.5 rounded-lg font-medium transition-all duration-200 border border-gray-200 text-sm {{ request()->routeIs('siswa.bk') ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}">
                        <i class="fas fa-comments mr-1"></i>BK
                    </a>
                    <div class="relative">
                        <button onclick="toggleProfileDropdown()" class="flex items-center gap-2 bg-gray-50 hover:bg-gray-100 px-2 py-1.5 rounded-lg border text-sm transition-colors">
                            <div class="w-6 h-6 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center flex-shrink-0 shadow-sm">
                                <i class="fas fa-user text-white text-xs"></i>
                            </div>
                            <span class="text-xs text-gray-700">{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                        </button>
                        <div id="profileDropdown" class="hidden absolute top-full right-0 mt-1 w-40 bg-white rounded-lg shadow-xl border border-gray-200 z-50">
                            <div class="flex flex-col">
                                <a href="{{ route('siswa.profile') }}" class="px-3 py-2 hover:bg-gray-50 transition-colors text-xs border-b">
                                    <i class="fas fa-user text-gray-600 text-xs mr-2"></i>Profil Saya
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
                    <a href="{{ route('siswa.dashboard') }}" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-2 rounded-lg font-medium text-center transition-all duration-200 border border-gray-200 text-sm {{ request()->routeIs('siswa.dashboard') ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}">
                        <i class="fas fa-home mr-2"></i>Dashboard
                    </a>
                    <a href="{{ route('siswa.prestasi') }}" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-2 rounded-lg font-medium text-center transition-all duration-200 border border-gray-200 text-sm {{ request()->routeIs('siswa.prestasi') ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}">
                        <i class="fas fa-trophy mr-2"></i>Prestasi
                    </a>
                    <a href="{{ route('siswa.pelanggaran') }}" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-2 rounded-lg font-medium text-center transition-all duration-200 border border-gray-200 text-sm {{ request()->routeIs('siswa.pelanggaran') ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Pelanggaran
                    </a>
                    <a href="{{ route('siswa.bk') }}" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-2 rounded-lg font-medium text-center transition-all duration-200 border border-gray-200 text-sm {{ request()->routeIs('siswa.bk') ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}">
                        <i class="fas fa-comments mr-2"></i>BK
                    </a>
                    <a href="{{ route('siswa.profile') }}" class="bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-gray-800 px-3 py-2 rounded-lg font-medium text-center transition-all duration-200 border border-gray-200 text-sm">
                        <i class="fas fa-user mr-2"></i>Profil Saya
                    </a>
                    <button onclick="showLogoutModal()" class="w-full bg-red-50 hover:bg-red-100 text-red-700 hover:text-red-800 px-3 py-2 rounded-lg font-medium text-center transition-all duration-200 border border-red-200 text-sm">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 max-w-6xl mt-6">

    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('hidden');
        }
        
        function toggleProfileDropdown() {
            document.getElementById('profileDropdown').classList.toggle('hidden');
        }
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('#profileDropdown') && !e.target.closest('button[onclick="toggleProfileDropdown()"]')) {
                document.getElementById('profileDropdown').classList.add('hidden');
            }
        });
        
        // Initialize AOS
        AOS.init();
        
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
                        
                        <p class="text-gray-700 mb-6">Apakah Anda yakin ingin logout dari dashboard siswa?</p>
                        
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