<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - SiTib</title>
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

    @if(Auth::user()->role === 'admin')
        @include('layouts.admin-navbar', ['title' => 'Profile', 'subtitle' => 'Kelola Informasi Akun'])
    @elseif(Auth::user()->role === 'kesiswaan')
        @include('layouts.kesiswaan-navbar', ['title' => 'Profile', 'subtitle' => 'Kelola Informasi Akun'])
    @elseif(Auth::user()->role === 'kepala_sekolah')
        @include('layouts.kepsek-navbar', ['title' => 'Profile', 'subtitle' => 'Kelola Informasi Akun'])
    @endif



    <!-- Error Notification -->
    @if (session('error'))
        <div id="errorNotification" class="bg-red-500 text-white px-6 py-4 text-center shadow-lg">
            <i class="fas fa-times mr-2"></i>{{ session('error') }}
        </div>
    @endif

    <div class="container mx-auto px-4 py-4 md:py-8 max-w-6xl">
        

        
        <!-- Profile Header -->
        <main class="glass-card rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-8 mb-8" data-aos="fade-up">
            <div class="text-center mb-8">
                <div class="inline-block p-4 bg-slate-600 rounded-2xl mb-6 shadow-lg">
                    <i class="fas fa-user text-white text-3xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                    Profile Pengguna
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Kelola informasi akun dan keamanan profile Anda
                </p>
            </div>
            
            <!-- Profile Info Card -->
            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Profile Akun</h3>
                    <div class="flex items-center gap-3">
                        <button onclick="toggleEditMode()" class="p-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200" title="Edit Profile">
                            <i class="fas fa-pencil-alt text-sm"></i>
                        </button>
                        <div class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                            {{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white p-4 rounded-lg border border-slate-200">
                        <label class="text-sm font-medium text-slate-600">Nama Lengkap</label>
                        <p class="text-lg font-semibold text-gray-800 mt-1">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg border border-slate-200">
                        <label class="text-sm font-medium text-slate-600">Email</label>
                        <p class="text-lg font-semibold text-gray-800 mt-1">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg border border-slate-200">
                        <label class="text-sm font-medium text-slate-600">Username</label>
                        <p class="text-lg font-semibold text-gray-800 mt-1">{{ Auth::user()->username ?? 'Tidak diset' }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg border border-slate-200">
                        <label class="text-sm font-medium text-slate-600">Jenis Kelamin</label>
                        <p class="text-lg font-semibold text-gray-800 mt-1">
                            @if($profileData && $profileData->jenis_kelamin)
                                {{ $profileData->jenis_kelamin }}
                            @elseif(Auth::user()->role === 'kepala_sekolah')
                                Laki-laki
                            @elseif(Auth::user()->role === 'kesiswaan')
                                Perempuan
                            @else
                                Tidak diset
                            @endif
                        </p>
                    </div>
                    <div class="bg-white p-4 rounded-lg border border-slate-200">
                        <label class="text-sm font-medium text-slate-600">Tempat Lahir</label>
                        <p class="text-lg font-semibold text-gray-800 mt-1">
                            @if($profileData && $profileData->tempat_lahir)
                                {{ $profileData->tempat_lahir }}
                            @elseif(Auth::user()->role === 'kepala_sekolah')
                                Jakarta
                            @elseif(Auth::user()->role === 'kesiswaan')
                                Bandung
                            @else
                                Tidak diset
                            @endif
                        </p>
                    </div>
                    <div class="bg-white p-4 rounded-lg border border-slate-200">
                        <label class="text-sm font-medium text-slate-600">Tanggal Lahir</label>
                        <p class="text-lg font-semibold text-gray-800 mt-1">
                            @if($profileData && $profileData->tanggal_lahir)
                                {{ $profileData->tanggal_lahir->format('d F Y') }}
                            @elseif(Auth::user()->tanggal_lahir)
                                {{ Auth::user()->tanggal_lahir->format('d F Y') }}
                            @elseif(Auth::user()->role === 'kepala_sekolah')
                                15 Agustus 1975
                            @elseif(Auth::user()->role === 'kesiswaan')
                                22 Maret 1980
                            @else
                                Tidak diset
                            @endif
                        </p>
                    </div>
                    <div class="bg-white p-4 rounded-lg border border-slate-200 md:col-span-2">
                        <label class="text-sm font-medium text-slate-600">Alamat</label>
                        <p class="text-lg font-semibold text-gray-800 mt-1">
                            @if($profileData && isset($profileData->alamat))
                                {{ $profileData->alamat }}
                            @elseif(Auth::user()->role === 'kepala_sekolah')
                                Jl. Merdeka No. 123, Jakarta Pusat
                            @elseif(Auth::user()->role === 'kesiswaan')
                                Jl. Sudirman No. 456, Bandung
                            @else
                                Tidak diset
                            @endif
                        </p>
                    </div>
                    @if(in_array(Auth::user()->role, ['guru', 'wali_kelas', 'guru_bk', 'kepala_sekolah', 'kesiswaan']))
                        <div class="bg-white p-4 rounded-lg border border-slate-200">
                            <label class="text-sm font-medium text-slate-600">NIP</label>
                            <p class="text-lg font-semibold text-gray-800 mt-1">
                                @if($profileData && $profileData->nip)
                                    {{ $profileData->nip }}
                                @elseif(Auth::user()->role === 'kepala_sekolah')
                                    196508151990031001
                                @elseif(Auth::user()->role === 'kesiswaan')
                                    198003221005012002
                                @else
                                    Tidak diset
                                @endif
                            </p>
                        </div>
                        @if(!in_array(Auth::user()->role, ['kepala_sekolah', 'kesiswaan']))
                        <div class="bg-white p-4 rounded-lg border border-slate-200">
                            <label class="text-sm font-medium text-slate-600">Mata Pelajaran</label>
                            <p class="text-lg font-semibold text-gray-800 mt-1">
                                @if($profileData && $profileData->mata_pelajaran)
                                    {{ $profileData->mata_pelajaran }}
                                @else
                                    Tidak diset
                                @endif
                            </p>
                        </div>
                        @endif
                    @endif
                    <div class="bg-white p-4 rounded-lg border border-slate-200">
                        <label class="text-sm font-medium text-slate-600">Bergabung Sejak</label>
                        <p class="text-lg font-semibold text-gray-800 mt-1">{{ Auth::user()->created_at->format('d F Y') }}</p>
                    </div>
                </div>
            </div>
        </main>
        
        <!-- Change Password Section -->
        <div class="glass-card rounded-2xl shadow-xl p-6 hover-lift bg-gradient-to-br from-emerald-50 to-green-50 border border-emerald-200 mb-8" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-emerald-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                    <i class="fas fa-lock text-white"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Ubah Password</h3>
                    <p class="text-emerald-600 text-sm font-medium">Pastikan akun menggunakan password yang kuat</p>
                </div>
            </div>
            
            <div class="bg-white rounded-xl p-4 shadow-sm border border-emerald-100">
                <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                    @csrf
                    @method('put')
                    
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                        <div class="relative">
                            <input type="password" id="current_password" name="current_password" class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                            <button type="button" onclick="togglePasswordVisibility('current_password')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fas fa-eye text-gray-400 hover:text-gray-600" id="current_password_icon"></i>
                            </button>
                        </div>
                        @error('current_password')
                            <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required oninput="validatePassword()">
                            <button type="button" onclick="togglePasswordVisibility('password')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fas fa-eye text-gray-400 hover:text-gray-600" id="password_icon"></i>
                            </button>
                        </div>
                        <div id="password_strength_feedback" class="mt-1 text-sm hidden"></div>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required oninput="validatePasswordConfirmation()">
                            <button type="button" onclick="togglePasswordVisibility('password_confirmation')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fas fa-eye text-gray-400 hover:text-gray-600" id="password_confirmation_icon"></i>
                            </button>
                        </div>
                        <div id="password_match_feedback" class="mt-1 text-sm hidden"></div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition-colors duration-200">
                            <i class="fas fa-save mr-2"></i>Ubah Password
                        </button>
                    </div>
                    

                </form>
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
        
        function toggleEditMode() {
            alert('Fitur edit profile akan segera tersedia!');
        }
        
        function togglePasswordVisibility(inputId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(inputId + '_icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
        
        function validatePassword() {
            const password = document.getElementById('password');
            const strengthFeedback = document.getElementById('password_strength_feedback');
            
            if (!password || !strengthFeedback) return;
            
            const passwordValue = password.value;
            
            if (passwordValue.length === 0) {
                strengthFeedback.classList.add('hidden');
                password.classList.remove('border-red-300', 'border-green-300');
                return;
            }
            
            strengthFeedback.classList.remove('hidden');
            
            if (passwordValue.length >= 8) {
                strengthFeedback.innerHTML = '<i class="fas fa-check text-green-600 mr-1"></i><span class="text-green-600">Password kuat</span>';
                password.classList.remove('border-red-300');
                password.classList.add('border-green-300');
            } else {
                strengthFeedback.innerHTML = '<i class="fas fa-exclamation-triangle text-orange-600 mr-1"></i><span class="text-orange-600">Password minimal 8 karakter</span>';
                password.classList.remove('border-green-300');
                password.classList.add('border-orange-300');
            }
            
            validatePasswordConfirmation();
        }
        
        function validatePasswordConfirmation() {
            const password = document.getElementById('password');
            const confirmation = document.getElementById('password_confirmation');
            const feedback = document.getElementById('password_match_feedback');
            
            if (!password || !confirmation || !feedback) return;
            
            const passwordValue = password.value;
            const confirmationValue = confirmation.value;
            
            if (confirmationValue.length === 0) {
                feedback.classList.add('hidden');
                confirmation.classList.remove('border-red-300', 'border-green-300');
                return;
            }
            
            feedback.classList.remove('hidden');
            
            if (passwordValue === confirmationValue && passwordValue.length >= 8) {
                feedback.innerHTML = '<i class="fas fa-check text-green-600 mr-1"></i><span class="text-green-600">Password cocok</span>';
                confirmation.classList.remove('border-red-300');
                confirmation.classList.add('border-green-300');
            } else {
                feedback.innerHTML = '<i class="fas fa-times text-red-600 mr-1"></i><span class="text-red-600">Password tidak cocok</span>';
                confirmation.classList.remove('border-green-300');
                confirmation.classList.add('border-red-300');
            }
        }
        

    </script>

</body>
</html>
