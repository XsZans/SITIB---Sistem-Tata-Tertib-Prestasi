# Update Sistem BK - Respon Siswa

## Perubahan yang Dibuat

### 1. Menghapus Fitur Ajukan BK dari Siswa
- **Sebelumnya**: Siswa bisa mengajukan sesi BK sendiri
- **Sekarang**: Hanya BK yang bisa memanggil siswa

### 2. Sistem Terima/Tolak Panggilan BK
- **Fitur Baru**: Siswa bisa menerima atau menolak panggilan BK
- **Alasan**: Jika menolak, siswa harus memberikan alasan

### 3. Notifikasi ke BK
- **Fitur**: BK menerima notifikasi ketika siswa merespon panggilan
- **Isi**: Status (diterima/ditolak) dan alasan jika ditolak

## Database Changes

### Migration: `add_respon_siswa_to_bk_sessions_table`
```php
- respon_siswa: enum('menunggu', 'diterima', 'ditolak') default 'menunggu'
- alasan_siswa: text nullable
```

## File yang Diubah

### Controllers
- `app/Http/Controllers/SiswaController.php`
  - Menghapus: `ajukanBk()`
  - Menambah: `responBk($id)` - untuk terima/tolak panggilan

- `app/Http/Controllers/BkController.php`
  - Menghapus: `getPengajuan()`
  - Mengupdate: `notifications()` - untuk menerima notifikasi respon siswa

### Models
- `app/Models/BkSession.php`
  - Menambah: `respon_siswa`, `alasan_siswa` ke fillable

### Views
- `resources/views/siswa/bk.blade.php` (dibuat ulang)
  - Menghapus: Tombol "Ajukan BK"
  - Menghapus: Modal ajukan BK
  - Menambah: Tombol "Terima" dan "Tolak" di notifikasi
  - Menambah: Modal respon dengan form alasan untuk penolakan

- `resources/views/bk/input.blade.php`
  - Menghapus: Section "Pengajuan BK dari Siswa"
  - Menghapus: JavaScript untuk load pengajuan

### Routes
- `routes/web.php`
  - Menghapus: `siswa.ajukan-bk`
  - Menambah: `siswa.respon-bk`

## Alur Sistem Baru

### 1. BK Memanggil Siswa
```
BK → Input BK → Pilih Siswa → Buat Panggilan
↓
Notifikasi ke Siswa (respon_siswa: 'menunggu')
```

### 2. Siswa Menerima Panggilan
```
Siswa → Lihat Notifikasi → Klik "Terima"
↓
Update: respon_siswa = 'diterima'
↓
Notifikasi ke BK: "Siswa [nama] menerima panggilan BK"
```

### 3. Siswa Menolak Panggilan
```
Siswa → Lihat Notifikasi → Klik "Tolak" → Isi Alasan
↓
Update: respon_siswa = 'ditolak', alasan_siswa = [alasan]
↓
Notifikasi ke BK: "Siswa [nama] menolak panggilan BK. Alasan: [alasan]"
```

## Cara Menggunakan

### Untuk Siswa:
1. Login sebagai siswa
2. Buka menu "Bimbingan Konseling"
3. Jika ada panggilan BK, akan muncul di bagian "Panggilan BK"
4. Klik "Terima" untuk menerima atau "Tolak" untuk menolak
5. Jika menolak, wajib mengisi alasan penolakan

### Untuk Guru BK:
1. Login sebagai guru BK
2. Buka menu "Input BK" untuk memanggil siswa
3. Notifikasi respon siswa akan muncul di dashboard dan halaman notifikasi
4. Notifikasi menampilkan status (diterima/ditolak) dan alasan jika ditolak

## Status
✅ **Sistem respon siswa telah berhasil diimplementasikan dan siap digunakan**
