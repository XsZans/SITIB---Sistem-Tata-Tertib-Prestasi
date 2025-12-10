<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi User - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    @include('layouts.admin-navbar', ['title' => 'Verifikasi User', 'subtitle' => 'Kelola Verifikasi Akun Pengguna'])

    <div class="container mx-auto px-4 py-8">
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
        @endif

        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">User Menunggu Verifikasi</h2>
                <div class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">
                    {{ $unverifiedUsers->count() }} User
                </div>
            </div>

            @if($unverifiedUsers->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Username</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Daftar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($unverifiedUsers as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $user->username }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-2 py-1 text-xs rounded-full {{ 
                                        $user->role == 'guru' ? 'bg-indigo-100 text-indigo-800' : 
                                        ($user->role == 'siswa' ? 'bg-teal-100 text-teal-800' : 
                                        ($user->role == 'orang_tua' ? 'bg-yellow-100 text-yellow-800' : 
                                        ($user->role == 'wali_kelas' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800'))) 
                                    }}">
                                        {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $user->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button onclick="openApproveUserModal({{ $user->id }}, '{{ $user->name }}')" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs transition-colors">
                                            <i class="fas fa-check mr-1"></i>Verifikasi
                                        </button>
                                        <button onclick="openRejectUserModal({{ $user->id }}, '{{ $user->name }}')" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs transition-colors">
                                            <i class="fas fa-times mr-1"></i>Tolak
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Tidak Ada User Menunggu</h3>
                    <p class="text-gray-600">Semua user sudah diverifikasi atau belum ada pendaftaran baru.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Approve User Modal -->
    <div id="approveUserModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user-check text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Verifikasi User</h3>
                <p class="text-gray-600">Apakah Anda yakin ingin memverifikasi user <span id="approveUserName" class="font-semibold"></span>?</p>
            </div>
            
            <form id="approveUserForm" method="POST" action="{{ route('admin.approve-user') }}">
                @csrf
                <input type="hidden" id="approveUserId" name="user_id">
                <div class="flex gap-3">
                    <button type="button" onclick="closeApproveUserModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">
                        Ya, Verifikasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Reject User Modal -->
    <div id="rejectUserModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user-times text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Tolak User</h3>
                <p class="text-gray-600">Apakah Anda yakin ingin menolak dan menghapus user <span id="rejectUserName" class="font-semibold"></span>?</p>
                <p class="text-red-500 text-sm mt-2">Tindakan ini tidak dapat dibatalkan!</p>
            </div>
            
            <form id="rejectUserForm" method="POST" action="{{ route('admin.reject-user') }}">
                @csrf
                <input type="hidden" id="rejectUserId" name="user_id">
                <div class="flex gap-3">
                    <button type="button" onclick="closeRejectUserModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                        Ya, Tolak
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openApproveUserModal(userId, userName) {
            document.getElementById('approveUserId').value = userId;
            document.getElementById('approveUserName').textContent = userName;
            document.getElementById('approveUserModal').classList.remove('hidden');
        }
        
        function closeApproveUserModal() {
            document.getElementById('approveUserModal').classList.add('hidden');
        }
        
        function openRejectUserModal(userId, userName) {
            document.getElementById('rejectUserId').value = userId;
            document.getElementById('rejectUserName').textContent = userName;
            document.getElementById('rejectUserModal').classList.remove('hidden');
        }
        
        function closeRejectUserModal() {
            document.getElementById('rejectUserModal').classList.add('hidden');
        }
    </script>

</body>
</html>