<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        <!-- Filter Section -->
        <div class="glass-card rounded-2xl shadow-xl p-6 mb-8" data-aos="fade-up" data-aos-delay="100">
            <form method="GET" action="{{ route('admin.users') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari User</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ $search }}" placeholder="Nama, username, atau email..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
                
                <!-- Role Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Filter Role</label>
                    <select name="role" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Role</option>
                        <option value="admin" {{ $role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="kesiswaan" {{ $role == 'kesiswaan' ? 'selected' : '' }}>Kesiswaan</option>
                        <option value="kepala_sekolah" {{ $role == 'kepala_sekolah' ? 'selected' : '' }}>Kepala Sekolah</option>
                        <option value="guru_bk" {{ $role == 'guru_bk' ? 'selected' : '' }}>Guru BK</option>
                        <option value="wali_kelas" {{ $role == 'wali_kelas' ? 'selected' : '' }}>Wali Kelas</option>
                        <option value="guru" {{ $role == 'guru' ? 'selected' : '' }}>Guru</option>
                        <option value="siswa" {{ $role == 'siswa' ? 'selected' : '' }}>Siswa</option>
                        <option value="orang_tua" {{ $role == 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                    </select>
                </div>
                
                <!-- Verification Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Verifikasi</label>
                    <select name="verified" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        <option value="1" {{ $verified === '1' ? 'selected' : '' }}>Terverifikasi</option>
                        <option value="0" {{ $verified === '0' ? 'selected' : '' }}>Belum Verifikasi</option>
                    </select>
                </div>
                
                <!-- Actions -->
                <div class="flex items-end gap-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center">
                        <i class="fas fa-search mr-2"></i>Filter
                    </button>
                    <a href="{{ route('admin.users') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors flex items-center">
                        <i class="fas fa-refresh mr-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Users Table -->
        <div class="glass-card rounded-2xl shadow-xl overflow-hidden" data-aos="fade-up" data-aos-delay="200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Daftar User</h2>
                    @if($search || $role || $verified !== null)
                        <div class="text-sm text-gray-600">
                            Menampilkan {{ $users->count() }} dari {{ \App\Models\User::count() }} total user
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibuat</th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->username ?? '-' }}</td>
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
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->is_verified)
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>Terverifikasi
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i>Menunggu
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div>{{ $user->created_at->format('d/m/Y') }}</div>
                                <div class="text-xs text-gray-500">{{ $user->created_at->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($user->role !== 'admin')
                                <button onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs transition-colors">
                                    <i class="fas fa-trash mr-1"></i>Hapus
                                </button>
                                @else
                                <span class="text-gray-400 text-xs">Protected</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="text-gray-500">
                                    <i class="fas fa-users text-4xl mb-4"></i>
                                    @if($search || $role || $verified !== null)
                                        <p class="text-lg font-medium">Tidak ada user yang sesuai filter</p>
                                        <p class="text-sm">Coba ubah kriteria pencarian atau filter</p>
                                    @else
                                        <p class="text-lg font-medium">Belum ada user</p>
                                        <p class="text-sm">User yang terdaftar akan muncul di sini</p>
                                    @endif
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
                    'guru_bk' => ['name' => 'Guru BK', 'color' => 'pink', 'icon' => 'heart'],
                    'siswa' => ['name' => 'Siswa', 'color' => 'indigo', 'icon' => 'user-graduate'],
                    'orang_tua' => ['name' => 'Orang Tua', 'color' => 'teal', 'icon' => 'users']
                ];
            @endphp
            
            @foreach($roles as $roleKey => $roleData)
                <div class="bg-{{ $roleData['color'] }}-50 border border-{{ $roleData['color'] }}-200 rounded-xl p-4 text-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-{{ $roleData['color'] }}-500 to-{{ $roleData['color'] }}-600 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-{{ $roleData['icon'] }} text-white"></i>
                    </div>
                    <p class="text-xs text-gray-600 font-medium mb-1">{{ $roleData['name'] }}</p>
                    <p class="text-xl font-bold text-{{ $roleData['color'] }}-700">{{ $roleStats->get($roleKey, 0) }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Delete User Modal -->
    <div id="deleteUserModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-trash text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Hapus Akun User</h3>
                <p class="text-gray-600">Apakah Anda yakin ingin menghapus akun <span id="deleteUserName" class="font-semibold"></span>?</p>
                <p class="text-red-500 text-sm mt-2 font-medium">Peringatan: Tindakan ini tidak dapat dibatalkan!</p>
            </div>
            
            <div class="flex gap-3">
                <button type="button" onclick="closeDeleteUserModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                    Batal
                </button>
                <button type="button" onclick="confirmDeleteUser()" class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div id="errorModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Error</h3>
                <p id="errorMessage" class="text-gray-600"></p>
            </div>
            
            <button type="button" onclick="closeErrorModal()" class="w-full px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg">
                Tutup
            </button>
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
        
        let deleteUserId = null;
        let deleteUserName = null;
        
        // Delete user function
        function deleteUser(userId, userName) {
            deleteUserId = userId;
            deleteUserName = userName;
            document.getElementById('deleteUserName').textContent = userName;
            document.getElementById('deleteUserModal').classList.remove('hidden');
        }
        
        function closeDeleteUserModal() {
            document.getElementById('deleteUserModal').classList.add('hidden');
            deleteUserId = null;
            deleteUserName = null;
        }
        
        async function confirmDeleteUser() {
            if (deleteUserId) {
                try {
                    const response = await fetch(`/admin/users/${deleteUserId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        }
                    });
                    
                    if (response.ok) {
                        location.reload();
                    } else {
                        showErrorModal('Gagal menghapus akun user');
                    }
                } catch (error) {
                    console.error('Error deleting user:', error);
                    showErrorModal('Terjadi kesalahan saat menghapus akun');
                }
            }
        }
        
        function showErrorModal(message) {
            document.getElementById('errorMessage').textContent = message;
            document.getElementById('errorModal').classList.remove('hidden');
        }
        
        function closeErrorModal() {
            document.getElementById('errorModal').classList.add('hidden');
        }
    </script>

</body>
</html>