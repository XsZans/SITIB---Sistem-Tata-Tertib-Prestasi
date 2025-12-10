<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelaksanaan Sanksi - SiTib</title>
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

    @include('layouts.admin-navbar', ['title' => 'Pelaksanaan Sanksi', 'subtitle' => 'Monitor Pelaksanaan Sanksi Siswa'])

    <div class="container mx-auto px-4 py-4 md:py-8 max-w-6xl">
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-lg" data-aos="fade-down">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3 text-green-600"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-6" data-aos="fade-up">
            <div class="bg-gradient-to-br from-orange-50 to-orange-100 border border-orange-200 rounded-xl p-4 hover-lift text-center">
                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                    <i class="fas fa-clock text-white text-lg"></i>
                </div>
                <p class="text-sm text-gray-600 font-medium mb-1">Sanksi Dalam Proses</p>
                <p class="text-2xl font-bold text-orange-700">{{ $sanksiDalamProses }}</p>
            </div>
            
            <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl p-4 hover-lift text-center">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                    <i class="fas fa-check-circle text-white text-lg"></i>
                </div>
                <p class="text-sm text-gray-600 font-medium mb-1">Sanksi Selesai</p>
                <p class="text-2xl font-bold text-green-700">{{ $sanksiSelesai }}</p>
            </div>
        </div>

        <!-- Sanksi Table -->
        <main class="glass-card rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-8 mb-8" data-aos="fade-up">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-gavel mr-2"></i>Daftar Pelaksanaan Sanksi
                </h2>
            </div>
            
            @if($pelaksanaanSanksi->count() > 0)
                <div class="space-y-4">
                    @foreach($pelaksanaanSanksi as $sanksi)
                    <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover-lift">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="flex-1">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-{{ $sanksi->status == 'selesai' ? 'green' : 'orange' }}-500 to-{{ $sanksi->status == 'selesai' ? 'green' : 'orange' }}-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-{{ $sanksi->status == 'selesai' ? 'check' : 'clock' }} text-white"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-2">
                                            <h4 class="text-lg font-bold text-gray-800">{{ $sanksi->siswa->nama }}</h4>
                                            <span class="px-3 py-1 text-sm font-bold rounded-full {{ $sanksi->status == 'selesai' ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800' }}">
                                                {{ $sanksi->status == 'selesai' ? 'Selesai' : 'Dalam Proses' }}
                                            </span>
                                        </div>
                                        <div class="flex flex-wrap items-center gap-2 mb-3">
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                                {{ $sanksi->siswa->nis }}
                                            </span>
                                            <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">
                                                {{ $sanksi->siswa->kelas }}
                                            </span>
                                        </div>
                                        <div class="mb-3">
                                            <h5 class="font-semibold text-gray-700 mb-1">{{ $sanksi->jenis_sanksi }}</h5>
                                            <p class="text-sm text-gray-600">{{ $sanksi->deskripsi_sanksi }}</p>
                                        </div>
                                        <div class="text-sm text-gray-600 mb-2">
                                            <div class="flex items-center gap-4">
                                                <span><i class="fas fa-calendar-start mr-1"></i>Mulai: {{ $sanksi->tanggal_mulai->format('d/m/Y') }}</span>
                                                @if($sanksi->tanggal_selesai)
                                                    <span><i class="fas fa-calendar-check mr-1"></i>Selesai: {{ $sanksi->tanggal_selesai->format('d/m/Y') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        @if($sanksi->catatan)
                                            <p class="text-sm text-gray-500 italic">Catatan: {{ $sanksi->catatan }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex flex-col items-center gap-3">
                                @if($sanksi->status == 'dalam_proses')
                                    <button onclick="openSelesaiModal('{{ $sanksi->id }}', '{{ $sanksi->siswa->nama }}', '{{ $sanksi->jenis_sanksi }}')" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                        <i class="fas fa-check mr-2"></i>Selesai
                                    </button>
                                @else
                                    @if($sanksi->bukti_pelaksanaan)
                                        <button onclick="showImage('{{ asset($sanksi->bukti_pelaksanaan) }}', 'Bukti Pelaksanaan Sanksi')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                            <i class="fas fa-eye mr-2"></i>Lihat Bukti
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-gavel text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak ada sanksi dalam pelaksanaan</h3>
                    <p class="text-gray-500">Semua sanksi sudah selesai dilaksanakan</p>
                </div>
            @endif
        </main>
    </div>

    <!-- Modal Selesai Sanksi -->
    <div id="selesaiModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Selesaikan Sanksi</h3>
                    <button onclick="closeSelesaiModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="selesaiForm" method="POST" action="{{ route('admin.selesai-sanksi') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="sanksi_id" name="sanksi_id">
                    
                    <div class="mb-4">
                        <p class="text-gray-600" id="sanksiInfo">Menyelesaikan sanksi untuk siswa</p>
                    </div>
                    
                    <!-- Bukti Pelaksanaan -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Bukti Pelaksanaan Sanksi <span class="text-red-500">*</span>
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-green-400 transition-colors">
                            <input type="file" name="bukti_pelaksanaan" id="bukti_pelaksanaan" accept="image/*" class="hidden" required>
                            <div id="uploadAreaSelesai" class="cursor-pointer" onclick="document.getElementById('bukti_pelaksanaan').click()">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                <p class="text-gray-600 mb-1">Klik untuk upload bukti pelaksanaan</p>
                                <p class="text-sm text-gray-500">Format: JPG, PNG (Max: 2MB)</p>
                            </div>
                            <div id="previewAreaSelesai" class="hidden">
                                <img id="imagePreviewSelesai" class="max-w-full h-32 object-cover rounded-lg mx-auto mb-2">
                                <p id="fileNameSelesai" class="text-sm text-gray-600 mb-2"></p>
                                <button type="button" onclick="removeImageSelesai()" class="text-red-500 hover:text-red-700 text-sm">
                                    <i class="fas fa-trash mr-1"></i>Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Catatan -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                        <textarea name="catatan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Tambahkan catatan pelaksanaan sanksi..."></textarea>
                    </div>
                    
                    <!-- Buttons -->
                    <div class="flex gap-3">
                        <button type="button" onclick="closeSelesaiModal()" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg font-medium transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg font-medium transition-colors">
                            Selesaikan Sanksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 id="imageTitle" class="text-2xl font-bold text-gray-800">Bukti Pelaksanaan</h3>
                    <button onclick="closeImageModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="p-6 text-center">
                <img id="modalImage" src="" class="max-w-full max-h-96 object-contain mx-auto" alt="Bukti Pelaksanaan">
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
        
        function openSelesaiModal(sanksiId, namaSiswa, jenisSanksi) {
            document.getElementById('selesaiModal').classList.remove('hidden');
            document.getElementById('sanksi_id').value = sanksiId;
            document.getElementById('sanksiInfo').textContent = `Menyelesaikan sanksi "${jenisSanksi}" untuk siswa ${namaSiswa}`;
            document.body.style.overflow = 'hidden';
        }
        
        function closeSelesaiModal() {
            document.getElementById('selesaiModal').classList.add('hidden');
            document.getElementById('selesaiForm').reset();
            document.body.style.overflow = 'auto';
            removeImageSelesai();
        }
        
        function showImage(src, title) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageTitle').textContent = title;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        // Image upload handling
        document.getElementById('bukti_pelaksanaan').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    showValidationError('Ukuran file terlalu besar. Maksimal 2MB.');
                    e.target.value = '';
                    return;
                }
                
                if (!file.type.startsWith('image/')) {
                    showValidationError('File harus berupa gambar.');
                    e.target.value = '';
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreviewSelesai').src = e.target.result;
                    document.getElementById('fileNameSelesai').textContent = file.name;
                    document.getElementById('uploadAreaSelesai').classList.add('hidden');
                    document.getElementById('previewAreaSelesai').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
        
        function removeImageSelesai() {
            document.getElementById('bukti_pelaksanaan').value = '';
            document.getElementById('uploadAreaSelesai').classList.remove('hidden');
            document.getElementById('previewAreaSelesai').classList.add('hidden');
        }
        
        // Close modals when clicking outside
        document.getElementById('selesaiModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeSelesaiModal();
            }
        });
        
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });
        
        // Validation error functions
        function showValidationError(message) {
            document.getElementById('validationErrorMessage').textContent = message;
            document.getElementById('validationErrorModal').classList.remove('hidden');
        }
        
        function closeValidationError() {
            document.getElementById('validationErrorModal').classList.add('hidden');
        }
    </script>

    <!-- Validation Error Modal -->
    <div id="validationErrorModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Validasi Error</h3>
                <p id="validationErrorMessage" class="text-gray-600"></p>
            </div>
            
            <button type="button" onclick="closeValidationError()" class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                Tutup
            </button>
        </div>
    </div>

</body>
</html>