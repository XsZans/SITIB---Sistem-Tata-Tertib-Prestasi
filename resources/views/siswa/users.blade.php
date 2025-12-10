<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - SiTib Admin</title>
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

    @include('layouts.admin-navbar', ['title' => 'Kelola User', 'subtitle' => 'Manajemen Akun Pengguna'])

    <div class="container mx-auto px-4 py-8 max-w-6xl">
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-lg" data-aos="fade-down">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3 text-green-600"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <!-- Header -->
        <div class="glass-card rounded-2xl shadow-xl p-6 mb-8" data-aos="fade-up">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Kelola User</h1>
                    <p class="text-gray-600">Manajemen semua akun pengguna sistem</p>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold text-blue-600">{{ $users->count() }}</div>
                    <div class="text-sm text-gray-600">Total User</div>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="glass-card rounded-2xl shadow-xl overflow-hidden" data-aos="fade-up" data-aos-delay="200">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Daftar User</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Password</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibuat</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $index => $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->username }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span class="bg-gray-100 px-2 py-1 rounded text-xs font-mono">password123</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full 
                                    @if($user->role == 'admin') bg-red-100 text-red-800
                                    @elseif($user->role == 'kesiswaan') bg-blue-100 text-blue-800
                                    @elseif($user->role == 'guru') bg-green-100 text-green-800
                                    @elseif($user->role == 'wali_kelas') bg-yellow-100 text-yellow-800
                                    @elseif($user->role == 'kepala_sekolah') bg-purple-100 text-purple-800
                                    @elseif($user->role == 'guru_bk') bg-pink-100 text-pink-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    @if($user->role == 'guru_bk') Guru BK
                                    @elseif($user->role == 'wali_kelas') Wali Kelas
                                    @elseif($user->role == 'kepala_sekolah') Kepala Sekolah
                                    @else {{ ucfirst($user->role) }}
                                    @endif
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div>{{ $user->created_at->format('d/m/Y') }}</div>
                                <div class="text-xs text-gray-500">{{ $user->created_at->format('H:i') }}</div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="text-gray-500">
                                    <i class="fas fa-users text-4xl mb-4"></i>
                                    <p class="text-lg font-medium">Belum ada user</p>
                                    <p class="text-sm">User yang terdaftar akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Role Statistics -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8" data-aos="fade-up" data-aos-delay="400">
            @php
                $roleStats = $users->groupBy('role')->map->count();
                $roles = [
                    'admin' => ['name' => 'Admin', 'color' => 'red', 'icon' => 'user-shield'],
                    'kesiswaan' => ['name' => 'Kesiswaan', 'color' => 'blue', 'icon' => 'user-tie'],
                    'guru' => ['name' => 'Guru', 'color' => 'green', 'icon' => 'chalkboard-teacher'],
                    'wali_kelas' => ['name' => 'Wali Kelas', 'color' => 'yellow', 'icon' => 'user-graduate'],
                    'kepala_sekolah' => ['name' => 'Kepala Sekolah', 'color' => 'purple', 'icon' => 'crown'],
                    'guru_bk' => ['name' => 'Guru BK', 'color' => 'pink', 'icon' => 'heart']
                ];
            @endphp
            
            @foreach($roles as $roleKey => $roleData)
                @if($roleStats->get($roleKey, 0) > 0)
                <div class="bg-{{ $roleData['color'] }}-50 border border-{{ $roleData['color'] }}-200 rounded-xl p-4 text-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-{{ $roleData['color'] }}-500 to-{{ $roleData['color'] }}-600 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-{{ $roleData['icon'] }} text-white"></i>
                    </div>
                    <p class="text-xs text-gray-600 font-medium mb-1">{{ $roleData['name'] }}</p>
                    <p class="text-xl font-bold text-{{ $roleData['color'] }}-700">{{ $roleStats->get($roleKey, 0) }}</p>
                </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- AOS Animation Script -->
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