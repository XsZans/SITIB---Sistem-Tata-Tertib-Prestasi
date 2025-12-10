# Fix Respon BK Siswa

## Masalah yang Diperbaiki

### 1. Error saat Siswa Menerima/Menolak BK
- **Penyebab**: Relasi guruBk tidak di-load dengan benar
- **Solusi**: Load relasi setelah update data

### 2. Validasi Alasan Penolakan
- **Penyebab**: Validasi tidak cukup ketat
- **Solusi**: Tambah trim() dan validasi null

### 3. Form Reset
- **Penyebab**: Form tidak di-reset dengan benar
- **Solusi**: Reset semua field dan button state

## Perubahan yang Dibuat

### 1. Controller - SiswaController.php
```php
// Sebelum
$bkSession = BkSession::where('id', $id)
    ->where('siswa_id', $siswa->id)
    ->with('guruBk.user')
    ->firstOrFail();

// Sesudah
$bkSession = BkSession::where('id', $id)
    ->where('siswa_id', $siswa->id)
    ->firstOrFail();

$bkSession->update([...]);
$bkSession->load('guruBk'); // Load setelah update
```

### 2. JavaScript - Validasi & Loading State
- Tambah validasi `trim()` untuk alasan
- Tambah loading state pada button
- Tambah error handling yang lebih baik
- Tambah console log untuk debugging

### 3. Modal - Reset Form
- Reset textarea value
- Reset button state
- Reset button text

### 4. Textarea - Maxlength
- Tambah maxlength="500"
- Tambah info karakter

## Cara Kerja Sekarang

### 1. Siswa Klik Terima
```
1. Modal terbuka dengan title "Terima Panggilan BK"
2. Tidak ada form alasan
3. Klik "Terima"
4. Button berubah: "Mengirim..." (disabled)
5. Request ke server
6. Notifikasi ke BK: "Siswa [nama] menerima panggilan BK"
7. Reload halaman
```

### 2. Siswa Klik Tolak
```
1. Modal terbuka dengan title "Tolak Panggilan BK"
2. Form alasan muncul (required)
3. Isi alasan (max 500 karakter)
4. Klik "Tolak"
5. Validasi: alasan tidak boleh kosong
6. Button berubah: "Mengirim..." (disabled)
7. Request ke server
8. Notifikasi ke BK: "Siswa [nama] menolak panggilan BK. Alasan: [alasan]"
9. Reload halaman
```

## Testing

### Test Case 1: Terima Panggilan
1. Login sebagai siswa
2. Buka menu BK
3. Klik "Terima" pada notifikasi
4. Klik "Terima" di modal
5. ✅ Harus berhasil dan reload

### Test Case 2: Tolak Tanpa Alasan
1. Login sebagai siswa
2. Buka menu BK
3. Klik "Tolak" pada notifikasi
4. Klik "Tolak" tanpa isi alasan
5. ✅ Harus muncul alert "Alasan penolakan harus diisi"

### Test Case 3: Tolak Dengan Alasan
1. Login sebagai siswa
2. Buka menu BK
3. Klik "Tolak" pada notifikasi
4. Isi alasan
5. Klik "Tolak"
6. ✅ Harus berhasil dan reload

### Test Case 4: Notifikasi ke BK
1. Siswa terima/tolak panggilan
2. Login sebagai BK
3. Buka notifikasi
4. ✅ Harus ada notifikasi respon siswa dengan alasan (jika ditolak)

## Status
✅ **Respon BK siswa telah diperbaiki dan berfungsi dengan baik**
