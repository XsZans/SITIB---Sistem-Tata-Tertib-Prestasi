# Update Dashboard Wali Kelas

## Perubahan yang Dibuat

### 1. Total Pelanggaran Hanya dari Kelas Wali Kelas
- **File**: `app/Http/Controllers/WaliKelasController.php`
- **Perubahan**: Query total pelanggaran diubah untuk hanya menghitung pelanggaran dari siswa kelas wali kelas tersebut
- **Status**: ✅ Selesai

### 2. Indikator Pelanggaran di Sebelah Nama Siswa
- **File**: 
  - `resources/views/wali_kelas/index.blade.php`
  - `resources/views/wali_kelas/siswa.blade.php`
- **Perubahan**: Menambahkan indikator (jumlah) di sebelah nama siswa yang pernah melakukan pelanggaran
- **Optimasi**: Menggunakan kolom `jumlah_pelanggaran` untuk performa yang lebih baik
- **Status**: ✅ Selesai

### 3. Storage untuk PDF Laporan yang Sudah Di-approve
- **File**: `app/Http/Controllers/WaliKelasController.php`
- **Perubahan**: 
  - Menambahkan penyimpanan PDF ke storage sebelum di-download
  - Membuat method `laporanTersimpan()` dan `downloadLaporan()`
- **View**: `resources/views/wali_kelas/laporan-tersimpan.blade.php`
- **Route**: Menambahkan route untuk melihat dan download laporan tersimpan
- **Status**: ✅ Selesai

### 4. Database Optimasi
- **Migration**: `2025_11_20_095255_add_jumlah_pelanggaran_to_siswa_table.php`
- **Observer**: `app/Observers/PelanggaranObserver.php`
- **Seeder**: `database/seeders/UpdateJumlahPelanggaranSeeder.php`
- **Perubahan**: 
  - Menambahkan kolom `jumlah_pelanggaran` pada tabel siswa
  - Membuat observer untuk auto-update jumlah pelanggaran
  - Seeder untuk update data yang sudah ada
- **Status**: ✅ Selesai

## Fitur Baru

### 1. Halaman Laporan Tersimpan
- **URL**: `/wali-kelas/laporan-tersimpan`
- **Fitur**: 
  - Melihat daftar PDF laporan yang sudah dibuat
  - Download laporan yang sudah tersimpan
  - Filter berdasarkan kelas wali kelas

### 2. Auto Storage PDF
- **Lokasi**: `storage/app/laporan_wali_kelas/`
- **Format**: `laporan-{kelas}-{tanggal}.pdf`
- **Fitur**: Otomatis menyimpan setiap PDF yang di-export

### 3. Optimasi Query
- **Kolom Baru**: `jumlah_pelanggaran` di tabel siswa
- **Observer**: Auto-update ketika ada perubahan pelanggaran
- **Benefit**: Mengurangi query database untuk performa yang lebih baik

## Cara Menggunakan

### 1. Melihat Indikator Pelanggaran
- Buka dashboard wali kelas
- Lihat daftar siswa, yang pernah melanggar akan ada angka (jumlah) di sebelah nama

### 2. Mengakses Laporan Tersimpan
- Dari dashboard wali kelas
- Klik "Export" → "Laporan Tersimpan"
- Atau gunakan FAB menu (tombol + di kanan bawah)

### 3. Download Laporan Tersimpan
- Masuk ke halaman "Laporan Tersimpan"
- Klik tombol "Download" pada file yang diinginkan

## File yang Diubah/Ditambah

### Controllers
- `app/Http/Controllers/WaliKelasController.php` (diubah)

### Views
- `resources/views/wali_kelas/index.blade.php` (diubah)
- `resources/views/wali_kelas/siswa.blade.php` (diubah)
- `resources/views/wali_kelas/laporan-tersimpan.blade.php` (baru)

### Models
- `app/Models/Siswa.php` (diubah)

### Database
- `database/migrations/2025_11_20_095255_add_jumlah_pelanggaran_to_siswa_table.php` (baru)
- `database/seeders/UpdateJumlahPelanggaranSeeder.php` (baru)

### Observers
- `app/Observers/PelanggaranObserver.php` (baru)

### Providers
- `app/Providers/AppServiceProvider.php` (diubah)

### Routes
- `routes/web.php` (diubah)

### Storage
- `storage/app/laporan_wali_kelas/` (direktori baru)
- `public/storage/laporan_wali_kelas/` (direktori baru)

## Status
✅ **Semua fitur telah berhasil diimplementasikan dan siap digunakan**