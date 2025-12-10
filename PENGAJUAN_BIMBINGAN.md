# Fitur Pengajuan Bimbingan Siswa

## Fitur Baru

### 1. Siswa Dapat Mengajukan Bimbingan
- Form pengajuan dengan data otomatis (Nama, NIS)
- Pilihan Guru BK yang dituju (dropdown)
- Pilihan tujuan bimbingan dari dropdown
- Opsi "Lainnya" untuk tujuan custom
- Pilihan jam bimbingan
- Alasan pengajuan (max 500 karakter)

### 2. Notifikasi ke BK dan Admin
- Notifikasi otomatis ke Guru BK yang dipilih
- Notifikasi otomatis ke Admin
- Berisi informasi lengkap pengajuan

### 3. Approval System
- BK/Admin dapat menyetujui atau menolak
- Jika disetujui, input jadwal bimbingan
- Notifikasi ke siswa tentang status pengajuan

## Database Changes

### Migration: `add_tujuan_jam_to_bk_sessions_table`
```php
- tujuan_bimbingan: string nullable
- jam_bimbingan: time nullable
```

## Tujuan Bimbingan

Dropdown berisi pilihan:
1. Masalah Akademik
2. Masalah Pribadi
3. Masalah Sosial
4. Masalah Keluarga
5. Karir dan Masa Depan
6. Kesehatan Mental
7. Lainnya (dengan input custom)

## Jam Bimbingan

Pilihan jam:
- 08:00 - 09:00
- 09:00 - 10:00
- 10:00 - 11:00
- 11:00 - 12:00
- 13:00 - 14:00
- 14:00 - 15:00
- 15:00 - 16:00

## Alur Sistem

### 1. Siswa Mengajukan Bimbingan
```
Siswa → Klik "Ajukan Bimbingan"
↓
Isi Form:
- Nama (auto)
- NIS (auto)
- Guru BK (dropdown - pilih guru BK yang dituju)
- Tujuan Bimbingan (dropdown)
- Tujuan Lainnya (jika pilih "Lainnya")
- Alasan (textarea)
- Jam Bimbingan (dropdown)
↓
Submit → Notifikasi ke BK & Admin
```

### 2. BK/Admin Menerima Notifikasi
```
BK/Admin → Dashboard
↓
Lihat "Pengajuan Bimbingan dari Siswa"
↓
Informasi:
- Nama & NIS siswa
- Tujuan bimbingan
- Alasan
- Jam yang diminta
- Tanggal pengajuan
```

### 3. BK/Admin Approve/Reject
```
Approve:
- Klik "Setujui"
- Input jadwal bimbingan (YYYY-MM-DD HH:MM)
- Notifikasi ke siswa: "Pengajuan disetujui. Jadwal: [tanggal]"

Reject:
- Klik "Tolak"
- Notifikasi ke siswa: "Pengajuan ditolak"
```

## File yang Dibuat/Diubah

### Migration
- `database/migrations/2025_11_24_234415_add_tujuan_jam_to_bk_sessions_table.php` (baru)

### Models
- `app/Models/BkSession.php` (diubah)
  - Tambah: `tujuan_bimbingan`, `jam_bimbingan` ke fillable

### Controllers
- `app/Http/Controllers/SiswaController.php` (diubah)
  - Tambah: `ajukanBimbingan()` method

- `app/Http/Controllers/BkController.php` (diubah)
  - Tambah: `approvePengajuan()` method
  - Tambah: `rejectPengajuan()` method
  - Tambah: `getPengajuan()` method

### Views
- `resources/views/siswa/bk.blade.php` (diubah)
  - Tambah: Tombol "Ajukan Bimbingan"
  - Tambah: Modal form pengajuan
  - Tambah: JavaScript untuk handle form

- `resources/views/bk/dashboard.blade.php` (diubah)
  - Tambah: Section "Pengajuan Bimbingan dari Siswa"
  - Tambah: JavaScript untuk load dan handle pengajuan

### Routes
- `routes/web.php` (diubah)
  - Tambah: `siswa.ajukan-bimbingan`
  - Tambah: `bk.approve-pengajuan`
  - Tambah: `bk.reject-pengajuan`
  - Tambah: `bk.pengajuan`

## Cara Menggunakan

### Untuk Siswa:
1. Login sebagai siswa
2. Buka menu "Bimbingan Konseling"
3. Klik tombol "Ajukan Bimbingan"
4. Isi form:
   - Pilih tujuan bimbingan
   - Jika pilih "Lainnya", isi tujuan custom
   - Isi alasan (max 500 karakter)
   - Pilih jam bimbingan
5. Klik "Ajukan"
6. Tunggu approval dari BK/Admin

### Untuk BK/Admin:
1. Login sebagai BK/Admin
2. Buka Dashboard BK
3. Lihat section "Pengajuan Bimbingan dari Siswa"
4. Review informasi pengajuan
5. Klik "Setujui" atau "Tolak"
6. Jika setujui, input jadwal bimbingan

## Validasi

### Form Siswa:
- Guru BK: required
- Tujuan bimbingan: required
- Tujuan lainnya: required jika pilih "Lainnya"
- Alasan: required, max 500 karakter
- Jam bimbingan: required

### Approval BK:
- Jadwal bimbingan: required, harus tanggal masa depan

## Status
✅ **Fitur pengajuan bimbingan siswa telah berhasil diimplementasikan**
