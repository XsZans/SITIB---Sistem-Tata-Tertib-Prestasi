# Fix Validasi BK Siswa

## Perubahan yang Dibuat

### 1. Validasi Status Selesai
- **Kondisi**: Jika status BK = 'selesai'
- **Aksi**: Tampilkan tombol "Tandai Dibaca" saja
- **Tidak ada**: Tombol Terima/Tolak

### 2. Validasi Status Belum Selesai
- **Kondisi**: Jika status BK != 'selesai' dan respon_siswa = 'menunggu'
- **Aksi**: Tampilkan tombol "Terima" dan "Tolak"

### 3. Filter Notifikasi
- **Perubahan**: Hanya menampilkan notifikasi panggilan BK (jenis = 'panggilan_bk')
- **Tujuan**: Menghindari notifikasi yang tidak relevan

### 4. Update Data Lama
- **Seeder**: `UpdateBkSessionsResponSeeder`
- **Aksi**: Update semua BK sessions yang respon_siswa = null menjadi 'menunggu'

### 5. Tampilan Respon di Riwayat
- **Fitur**: Menampilkan respon siswa (diterima/ditolak) di riwayat BK
- **Isi**: Status respon dan alasan jika ditolak

## Logika Validasi

```php
if (status === 'selesai') {
    // Tampilkan tombol "Tandai Dibaca"
} elseif (respon_siswa === 'menunggu') {
    // Tampilkan tombol "Terima" dan "Tolak"
} else {
    // Tampilkan status respon (sudah diterima/ditolak)
}
```

## File yang Diubah

### Views
- `resources/views/siswa/bk.blade.php`
  - Menambah validasi status selesai
  - Menambah function markAsRead
  - Menambah tampilan respon di riwayat

### Controllers
- `app/Http/Controllers/SiswaController.php`
  - Menambah filter notifikasi hanya panggilan BK

### Seeders
- `database/seeders/UpdateBkSessionsResponSeeder.php` (baru)
  - Update data lama yang respon_siswa = null

## Cara Kerja

### Untuk Siswa:
1. **Panggilan Baru** (status != selesai, respon = menunggu)
   - Tampil tombol: "Terima" dan "Tolak"

2. **Panggilan Selesai** (status = selesai)
   - Tampil tombol: "Tandai Dibaca"
   - Setelah diklik, notifikasi hilang

3. **Sudah Direspon** (respon != menunggu)
   - Tampil status: "Anda telah menerima/menolak panggilan ini"
   - Tidak ada tombol aksi

## Status
✅ **Validasi BK siswa telah diperbaiki dan data lama telah diupdate**
