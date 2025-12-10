# Alur Notifikasi BK

## Penjelasan Sistem Notifikasi

Sistem notifikasi BK dirancang untuk memastikan komunikasi yang tepat antara Guru BK dan Siswa.

### 1. Panggilan BK oleh Guru BK

**Alur:**
1. Guru BK membuat panggilan BK untuk siswa tertentu
2. Sistem membuat BkSession dengan status "dijadwalkan"
3. **Notifikasi dikirim ke SISWA yang dipanggil** (bukan ke BK)
4. Siswa menerima notifikasi di halaman BK mereka

**Kode:**
```php
// Di BkController@storeBk
BkNotification::create([
    'user_id' => $siswa->user_id,  // User ID SISWA
    'bk_session_id' => $bkSession->id,
    'title' => 'Panggilan BK',
    'message' => "Anda dipanggil untuk sesi BK pada ...",
    'type' => 'panggilan'
]);
```

### 2. Pengajuan BK oleh Siswa

**Alur:**
1. Siswa mengajukan sesi BK melalui halaman BK
2. Sistem membuat BkSession dengan status "pending"
3. **Notifikasi dikirim ke GURU BK** (bukan ke siswa)
4. Guru BK menerima notifikasi dan dapat melihat di halaman pengajuan

**Kode:**
```php
// Di SiswaController@ajukanBk
BkNotification::create([
    'user_id' => $guruBk->user_id,  // User ID GURU BK
    'bk_session_id' => $bkSession->id,
    'title' => 'Pengajuan BK Baru',
    'message' => "Siswa {$siswa->nama} mengajukan sesi BK...",
    'type' => 'pengajuan'
]);
```

### 3. Konfirmasi Jadwal oleh Guru BK

**Alur:**
1. Guru BK mengkonfirmasi pengajuan siswa dengan jadwal
2. Status BkSession berubah menjadi "dijadwalkan"
3. **Notifikasi dikirim ke SISWA** yang mengajukan
4. Siswa menerima konfirmasi jadwal

**Kode:**
```php
// Di BkController@confirmSession
BkNotification::create([
    'user_id' => $bkSession->siswa->user_id,  // User ID SISWA
    'bk_session_id' => $bkSession->id,
    'title' => 'Konfirmasi Jadwal BK',
    'message' => "Jadwal BK Anda dikonfirmasi pada ...",
    'type' => 'konfirmasi'
]);
```

### 4. Penyelesaian Sesi BK

**Alur:**
1. Guru BK menyelesaikan sesi BK dengan hasil
2. Status BkSession berubah menjadi "selesai"
3. **Notifikasi dikirim ke SISWA**
4. Siswa dapat melihat hasil BK

**Kode:**
```php
// Di BkController@completeSession
BkNotification::create([
    'user_id' => $bkSession->siswa->user_id,  // User ID SISWA
    'bk_session_id' => $bkSession->id,
    'title' => 'Sesi BK Selesai',
    'message' => "Sesi BK Anda telah selesai dilaksanakan...",
    'type' => 'selesai'
]);
```

### 5. Penolakan Pengajuan

**Alur:**
1. Guru BK menolak pengajuan siswa
2. Status BkSession berubah menjadi "dibatalkan"
3. **Notifikasi dikirim ke SISWA**
4. Siswa menerima informasi penolakan

**Kode:**
```php
// Di BkController@rejectSession
BkNotification::create([
    'user_id' => $bkSession->siswa->user_id,  // User ID SISWA
    'bk_session_id' => $bkSession->id,
    'title' => 'Pengajuan BK Ditolak',
    'message' => "Pengajuan BK Anda ditolak...",
    'type' => 'konfirmasi'
]);
```

## Ringkasan Penerima Notifikasi

| Aksi | Pelaku | Penerima Notifikasi |
|------|--------|---------------------|
| Panggilan BK | Guru BK | **Siswa** yang dipanggil |
| Pengajuan BK | Siswa | **Guru BK** |
| Konfirmasi Jadwal | Guru BK | **Siswa** yang mengajukan |
| Selesai Sesi | Guru BK | **Siswa** |
| Tolak Pengajuan | Guru BK | **Siswa** yang mengajukan |

## Validasi yang Ditambahkan

### 1. Validasi User ID Siswa
```php
if (!$siswa->user_id) {
    return redirect()->back()->with('error', 'Siswa belum memiliki akun user.');
}
```

### 2. Validasi Sebelum Membuat Notifikasi
```php
if ($bkSession->siswa && $bkSession->siswa->user_id) {
    BkNotification::create([...]);
}
```

### 3. Eager Loading untuk Performa
```php
$bkSession = BkSession::with('siswa')->findOrFail($id);
```

## Cara Melihat Notifikasi

### Untuk Siswa:
1. Login sebagai siswa
2. Buka menu "Bimbingan Konseling"
3. Notifikasi akan muncul di bagian atas halaman
4. Klik "Tandai Dibaca" untuk menandai notifikasi sudah dibaca

### Untuk Guru BK:
1. Login sebagai guru BK
2. Buka menu "Input BK"
3. Pengajuan dari siswa akan muncul di bagian "Pengajuan BK dari Siswa"
4. Klik "Konfirmasi" atau "Tolak" untuk merespon

## Status
✅ **Sistem notifikasi BK sudah berjalan dengan benar dan notifikasi dikirim ke penerima yang tepat**