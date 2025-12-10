<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Backup Data - SiTib Admin</title>
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

    @include('layouts.admin-navbar', ['title' => 'Backup Data', 'subtitle' => 'Cadangkan Data Sistem'])

    <div class="container mx-auto px-4 py-8 max-w-4xl">
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-lg" data-aos="fade-down">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3 text-green-600"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg shadow-lg" data-aos="fade-down">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-3 text-red-600"></i>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        </div>
        @endif

        <!-- Header -->
        <div class="glass-card rounded-2xl shadow-xl p-6 mb-8" data-aos="fade-up">
            <div class="flex items-center">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-database text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Backup Data</h1>
                    <p class="text-gray-600">Cadangkan seluruh data sistem untuk keamanan</p>
                </div>
            </div>
        </div>

        <!-- Manual Backup -->
        <div class="glass-card rounded-2xl shadow-xl p-8 mb-8" data-aos="fade-up" data-aos-delay="200">
            <div class="text-center mb-8">
                <div class="w-24 h-24 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shield-alt text-white text-3xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Backup Manual</h2>
                <p class="text-gray-600">Unduh backup lengkap database sistem dalam format SQL</p>
            </div>

            <div class="text-center">
                <button onclick="downloadManualBackup()" class="inline-block bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105" id="manualBackupBtn">
                    <i class="fas fa-download mr-3"></i>Download Backup Database
                </button>
            </div>
        </div>

        <!-- Auto Backup Settings -->
        <div class="glass-card rounded-2xl shadow-xl p-8 mb-8" data-aos="fade-up" data-aos-delay="300">
            <div class="flex items-center mb-6">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-clock text-white text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Backup Otomatis</h2>
                    <p class="text-gray-600">Atur jadwal backup otomatis harian, mingguan, atau bulanan</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.update-backup-settings') }}" id="backupSettingsForm">
                @csrf
                @php $settings = \App\Models\BackupSetting::getSettings(); @endphp
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="flex items-center mb-4">
                            <input type="checkbox" name="auto_backup_enabled" value="1" {{ $settings->auto_backup_enabled ? 'checked' : '' }} class="mr-3 w-5 h-5 text-blue-600" id="autoBackupCheckbox">
                            <span class="text-lg font-medium text-gray-800">Aktifkan Backup Otomatis</span>
                        </label>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Frekuensi Backup</label>
                            <select name="backup_frequency" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                <option value="daily" {{ $settings->backup_frequency == 'daily' ? 'selected' : '' }}>Harian</option>
                                <option value="weekly" {{ $settings->backup_frequency == 'weekly' ? 'selected' : '' }}>Mingguan</option>
                                <option value="monthly" {{ $settings->backup_frequency == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Waktu Backup</label>
                            <input type="time" name="backup_time" value="{{ $settings->backup_time }}" min="07:00" max="16:00" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                            <p class="text-xs text-gray-500 mt-1">Jam operasional: 07:00 - 16:00 WIB</p>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Backup Tersimpan</label>
                            <input type="number" name="keep_backups" value="{{ $settings->keep_backups }}" min="1" max="30" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                            <p class="text-xs text-gray-500 mt-1">Berapa file backup yang akan disimpan sebelum file lama dihapus</p>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                        <i class="fas fa-save mr-2"></i>Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>

        <!-- Backup History -->
        <div class="glass-card rounded-2xl shadow-xl p-8" data-aos="fade-up" data-aos-delay="400">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-history mr-2"></i>Riwayat Backup
                </h2>
                <div class="flex gap-2">
                    <button onclick="filterBackups('all')" id="filterAll" class="px-3 py-1 text-sm rounded-lg bg-blue-600 text-white">Semua</button>
                    <button onclick="filterBackups('manual')" id="filterManual" class="px-3 py-1 text-sm rounded-lg bg-gray-200 text-gray-700">Manual</button>
                    <button onclick="filterBackups('automatic')" id="filterAutomatic" class="px-3 py-1 text-sm rounded-lg bg-gray-200 text-gray-700">Otomatis</button>
                </div>
            </div>
            
            <div id="backupHistoryList" class="space-y-3">
                <div class="text-center py-4 text-gray-500">
                    <i class="fas fa-spinner fa-spin mr-2"></i>Memuat riwayat backup...
                </div>
            </div>
        </div>

        <!-- Warning -->
        <div class="glass-card rounded-2xl shadow-xl p-6 mt-8" data-aos="fade-up" data-aos-delay="500">
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-triangle text-yellow-600 text-xl mr-3 mt-1"></i>
                    <div>
                        <h4 class="text-yellow-800 font-semibold mb-2">Peringatan Penting</h4>
                        <ul class="text-yellow-700 text-sm space-y-1">
                            <li>• Backup otomatis memerlukan task scheduler atau cron job</li>
                            <li>• Simpan file backup di tempat yang aman</li>
                            <li>• Jangan bagikan file backup kepada pihak yang tidak berwenang</li>
                            <li>• Pastikan ruang disk cukup untuk menyimpan backup</li>
                            <li>• Penghapusan backup memerlukan password admin untuk keamanan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Backup Modal -->
    <div id="deleteBackupModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-trash text-red-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Hapus Backup</h3>
                        <p class="text-sm text-gray-600">Konfirmasi penghapusan backup</p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <p class="text-gray-700 mb-2">Anda akan menghapus backup:</p>
                    <p class="font-mono text-sm bg-gray-100 p-2 rounded" id="backupFilename"></p>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Admin</label>
                    <input type="password" id="adminPassword" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Masukkan password admin">
                    <p class="text-xs text-red-600 mt-1 hidden" id="passwordError">Password tidak boleh kosong</p>
                </div>
                
                <div class="flex gap-3">
                    <button onclick="closeDeleteModal()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg transition-colors">
                        Batal
                    </button>
                    <button onclick="confirmDeleteBackup()" class="flex-1 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors" id="deleteConfirmBtn">
                        <i class="fas fa-trash mr-2"></i>Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Modal -->
    <div id="messageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full">
            <div class="p-6 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center" id="messageIcon">
                    <i class="text-2xl" id="messageIconClass"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2" id="messageTitle"></h3>
                <p class="text-gray-600 mb-6" id="messageText"></p>
                <button onclick="closeMessageModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                    OK
                </button>
            </div>
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
        
        let allBackups = [];
        let currentFilter = 'all';
        
        // Load backup history
        async function loadBackupHistory() {
            try {
                const response = await fetch('/admin/get-backup-history');
                allBackups = await response.json();
                displayBackups(allBackups);
            } catch (error) {
                console.error('Error loading backups:', error);
                document.getElementById('backupHistoryList').innerHTML = `
                    <div class="text-center py-4 text-red-500">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Gagal memuat riwayat backup
                    </div>
                `;
            }
        }
        
        function displayBackups(backups) {
            const container = document.getElementById('backupHistoryList');
            
            if (backups.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-folder-open text-4xl mb-3"></i>
                        <p>Belum ada riwayat backup</p>
                    </div>
                `;
                return;
            }
            
            container.innerHTML = backups.map(backup => {
                const typeIcon = backup.type === 'manual' ? 'fa-hand-paper' : 'fa-robot';
                const typeColor = backup.type === 'manual' ? 'text-green-600' : 'text-blue-600';
                const typeBadge = backup.type === 'manual' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800';
                
                return `
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas ${typeIcon} ${typeColor} text-xl mr-3"></i>
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="font-medium text-gray-800">${backup.filename}</span>
                                    <span class="px-2 py-1 text-xs rounded-full ${typeBadge}">${backup.type === 'manual' ? 'Manual' : 'Otomatis'}</span>
                                </div>
                                <div class="text-sm text-gray-500">
                                    ${backup.created_at} • ${formatFileSize(backup.file_size)}
                                    ${backup.created_by ? ' • ' + backup.created_by : ''}
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <a href="/admin/download-backup-file/${backup.filename}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm transition-colors">
                                <i class="fas fa-download mr-1"></i>Download
                            </a>
                            <button onclick="deleteBackup('${backup.filename}')" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-sm transition-colors">
                                <i class="fas fa-trash mr-1"></i>Hapus
                            </button>
                        </div>
                    </div>
                `;
            }).join('');
        }
        
        function filterBackups(type) {
            currentFilter = type;
            
            // Update button styles
            document.querySelectorAll('[id^="filter"]').forEach(btn => {
                btn.className = 'px-3 py-1 text-sm rounded-lg bg-gray-200 text-gray-700';
            });
            document.getElementById('filter' + type.charAt(0).toUpperCase() + type.slice(1)).className = 'px-3 py-1 text-sm rounded-lg bg-blue-600 text-white';
            
            // Filter and display backups
            const filteredBackups = type === 'all' ? allBackups : allBackups.filter(backup => backup.type === type);
            displayBackups(filteredBackups);
        }
        
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
        
        // Download manual backup with auto refresh
        async function downloadManualBackup() {
            const btn = document.getElementById('manualBackupBtn');
            const originalText = btn.innerHTML;
            
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Membuat Backup...';
            btn.disabled = true;
            
            try {
                // Create a temporary link to download
                const link = document.createElement('a');
                link.href = '/admin/download-backup';
                link.download = '';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                
                // Wait a bit then refresh history
                setTimeout(() => {
                    loadBackupHistory();
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }, 2000);
            } catch (error) {
                console.error('Error downloading backup:', error);
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        }
        
        // Handle form submission with auto refresh
        document.getElementById('backupSettingsForm').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            const checkbox = document.getElementById('autoBackupCheckbox');
            
            // Store checkbox state
            const isChecked = checkbox.checked;
            
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
            submitBtn.disabled = true;
            
            // Debug: log checkbox state
            console.log('Checkbox checked:', isChecked);
            console.log('Checkbox value:', checkbox.value);
            
            // Form will submit normally, but we show loading state
        });
        
        let currentDeleteFilename = '';
        
        // Show delete backup modal
        function deleteBackup(filename) {
            currentDeleteFilename = filename;
            document.getElementById('backupFilename').textContent = filename;
            document.getElementById('adminPassword').value = '';
            document.getElementById('passwordError').classList.add('hidden');
            document.getElementById('deleteBackupModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        // Close delete modal
        function closeDeleteModal() {
            document.getElementById('deleteBackupModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            currentDeleteFilename = '';
        }
        
        // Confirm delete backup
        async function confirmDeleteBackup() {
            const password = document.getElementById('adminPassword').value;
            const errorEl = document.getElementById('passwordError');
            const btnEl = document.getElementById('deleteConfirmBtn');
            
            if (!password) {
                errorEl.textContent = 'Password tidak boleh kosong';
                errorEl.classList.remove('hidden');
                return;
            }
            
            errorEl.classList.add('hidden');
            btnEl.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menghapus...';
            btnEl.disabled = true;
            
            try {
                const response = await fetch('/admin/delete-backup', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        filename: currentDeleteFilename,
                        password: password
                    })
                });
                
                const result = await response.json();
                
                closeDeleteModal();
                
                if (result.success) {
                    showMessage('success', 'Berhasil!', 'Backup berhasil dihapus.');
                    loadBackupHistory();
                } else {
                    showMessage('error', 'Gagal!', result.message || 'Gagal menghapus backup');
                }
            } catch (error) {
                console.error('Error deleting backup:', error);
                closeDeleteModal();
                showMessage('error', 'Error!', 'Terjadi kesalahan saat menghapus backup');
            } finally {
                btnEl.innerHTML = '<i class="fas fa-trash mr-2"></i>Hapus';
                btnEl.disabled = false;
            }
        }
        
        // Show message modal
        function showMessage(type, title, message) {
            const modal = document.getElementById('messageModal');
            const icon = document.getElementById('messageIcon');
            const iconClass = document.getElementById('messageIconClass');
            const titleEl = document.getElementById('messageTitle');
            const textEl = document.getElementById('messageText');
            
            if (type === 'success') {
                icon.className = 'w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center bg-green-100';
                iconClass.className = 'fas fa-check text-2xl text-green-600';
            } else {
                icon.className = 'w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center bg-red-100';
                iconClass.className = 'fas fa-times text-2xl text-red-600';
            }
            
            titleEl.textContent = title;
            textEl.textContent = message;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        // Close message modal
        function closeMessageModal() {
            document.getElementById('messageModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        // Close modals when clicking outside
        document.getElementById('deleteBackupModal').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });
        
        document.getElementById('messageModal').addEventListener('click', function(e) {
            if (e.target === this) closeMessageModal();
        });
        
        // Load backups on page load
        document.addEventListener('DOMContentLoaded', loadBackupHistory);
    </script>

</body>
</html>