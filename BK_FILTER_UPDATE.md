# Update Filter & Search BK

## Fitur yang Ditambahkan

### 1. Filter dan Search Siswa di Halaman Input BK
- **File**: `app/Http/Controllers/BkController.php`
- **Method**: `inputBk()` - ditambahkan parameter filter dan search
- **Fitur**:
  - Search berdasarkan nama atau NIS siswa
  - Filter berdasarkan kelas
  - Filter berdasarkan jurusan
  - Auto-submit ketika filter berubah

### 2. UI Filter yang Responsif
- **File**: `resources/views/bk/input.blade.php`
- **Perubahan**:
  - Form filter dengan grid layout responsif
  - Search input dengan icon
  - Dropdown filter kelas dan jurusan
  - Tombol cari dan reset
  - Informasi hasil pencarian

### 3. Method AJAX untuk Get Siswa
- **File**: `app/Http/Controllers/BkController.php`
- **Method**: `getSiswa()` - untuk keperluan AJAX jika diperlukan
- **Route**: `/bk/get-siswa`

## Cara Menggunakan

### 1. Search Siswa
- Ketik nama atau NIS siswa di kolom pencarian
- Klik tombol "Cari" atau tekan Enter

### 2. Filter Kelas
- Pilih kelas dari dropdown
- Form akan otomatis submit dan menampilkan siswa dari kelas tersebut

### 3. Filter Jurusan
- Pilih jurusan dari dropdown
- Form akan otomatis submit dan menampilkan siswa dari jurusan tersebut

### 4. Kombinasi Filter
- Bisa menggunakan kombinasi search + filter kelas + filter jurusan
- Hasil akan menampilkan siswa yang sesuai dengan semua kriteria

### 5. Reset Filter
- Klik tombol "Reset" untuk menghapus semua filter dan kembali ke tampilan semua siswa

## File yang Diubah/Ditambah

### Controllers
- `app/Http/Controllers/BkController.php` (diubah)
  - Method `inputBk()` - ditambahkan filter dan search
  - Method `getSiswa()` - baru untuk AJAX

### Views
- `resources/views/bk/input.blade.php` (diubah)
  - Form filter dan search
  - Informasi hasil pencarian
  - JavaScript auto-submit

### Routes
- `routes/web.php` (diubah)
  - Route `bk.get-siswa` untuk AJAX

## Fitur Teknis

### 1. Query Optimization
- Menggunakan Eloquent query builder dengan kondisi dinamis
- Search menggunakan LIKE dengan wildcard
- Filter menggunakan exact match atau LIKE sesuai kebutuhan

### 2. Auto-Submit
- JavaScript mendeteksi perubahan pada dropdown filter
- Otomatis submit form tanpa perlu klik tombol

### 3. Responsive Design
- Grid layout yang responsif untuk mobile dan desktop
- Form elements yang mudah digunakan di berbagai ukuran layar

### 4. User Experience
- Informasi jumlah siswa yang ditemukan
- Placeholder text yang jelas
- Icon visual untuk memudahkan navigasi

## Status
✅ **Fitur filter dan search BK telah berhasil diimplementasikan dan siap digunakan**