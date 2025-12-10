# Fitur Pengajuan Bimbingan Siswa ke BK

## Deskripsi
Fitur ini memungkinkan siswa untuk mengajukan bimbingan konseling kepada guru BK. Pengajuan akan diterima dan dapat dikelola oleh guru BK.

## Cara Kerja

### 1. Siswa Mengajukan Bimbingan
- Siswa login ke sistem
- Masuk ke menu **Bimbingan Konseling** (route: `/siswa/bk`)
- Klik tombol **"Ajukan Bimbingan"**
- Isi form pengajuan:
  - Pilih Guru BK
  - Pilih Tujuan Bimbingan (Masalah Akademik, Pribadi, Sosial, Keluarga, Karir, Kesehatan Mental, atau Lainnya)
  - Isi Alasan (maksimal 500 karakter)
  - Pilih Tanggal Bimbingan
  - Pilih Jam Bimbingan (07:00 - 16:00 WIB)
- Klik **"Ajukan"**

### 2. Notifikasi Dikirim
Setelah siswa mengajukan bimbingan, sistem akan:
- Membuat record BkSession dengan status `pending`
- Mengirim notifikasi ke Guru BK yang dipilih
- Mengirim notifikasi ke Admin

### 3. Guru BK Menerima Pengajuan
- Guru BK login ke sistem
- Masuk ke menu **Notifikasi** (route: `/bk/notifications`)
- Melihat pengajuan bimbingan dari siswa
- Dapat melakukan:
  - **Konfirmasi**: Menyetujui pengajuan dan mengatur jadwal
  - **Tolak**: Menolak pengajuan

### 4. Konfirmasi Jadwal
Jika guru BK menyetujui:
- Status berubah menjadi `dijadwalkan`
- Siswa menerima notifikasi konfirmasi
- Jadwal bimbingan tercatat di sistem

### 5. Pelaksanaan Bimbingan
- Guru BK melakukan sesi bimbingan
- Setelah selesai, guru BK mengisi hasil bimbingan
- Status berubah menjadi `selesai`
- Siswa menerima notifikasi bahwa sesi telah selesai

## Database

### Tabel: bk_sessions
- `id`: Primary key
- `siswa_id`: Foreign key ke tabel siswa
- `guru_bk_id`: Foreign key ke tabel guru
- `jenis`: Enum ('pengajuan_siswa', 'panggilan_bk')
- `tujuan_bimbingan`: Tujuan bimbingan (hanya untuk pengajuan_siswa)
- `jam_bimbingan`: Jam bimbingan yang diajukan
- `alasan`: Alasan pengajuan
- `catatan_bk`: Catatan dari guru BK
- `status`: Enum ('pending', 'dijadwalkan', 'selesai', 'dibatalkan')
- `respon_siswa`: Respon siswa terhadap panggilan BK
- `alasan_siswa`: Alasan siswa jika menolak
- `jadwal_bk`: Jadwal yang dikonfirmasi
- `hasil_bk`: Hasil sesi bimbingan

### Tabel: bk_notifications
- `id`: Primary key
- `user_id`: Foreign key ke tabel users
- `bk_session_id`: Foreign key ke tabel bk_sessions
- `title`: Judul notifikasi
- `message`: Isi notifikasi
- `type`: Tipe notifikasi (pengajuan, panggilan, konfirmasi, selesai, respon_siswa)
- `is_read`: Status baca notifikasi

## Routes

### Siswa
- `GET /siswa/bk` - Halaman bimbingan konseling siswa
- `POST /siswa/ajukan-bimbingan` - Mengajukan bimbingan
- `POST /siswa/bk/respon/{id}` - Merespon panggilan BK
- `POST /siswa/bk/notification/{id}/read` - Tandai notifikasi dibaca

### Guru BK
- `GET /bk/notifications` - Halaman notifikasi BK
- `GET /bk/pengajuan` - API untuk mendapatkan pengajuan
- `POST /bk/approve-pengajuan/{id}` - Menyetujui pengajuan
- `POST /bk/reject-pengajuan/{id}` - Menolak pengajuan
- `POST /bk/confirm/{id}` - Konfirmasi jadwal
- `POST /bk/complete/{id}` - Selesaikan sesi
- `POST /bk/notification/{id}/read` - Tandai notifikasi dibaca

## Controllers

### SiswaController
- `bk()` - Menampilkan halaman bimbingan konseling
- `ajukanBimbingan()` - Proses pengajuan bimbingan
- `responBk()` - Merespon panggilan BK
- `markBkNotificationRead()` - Tandai notifikasi dibaca

### BkController
- `notifications()` - Menampilkan halaman notifikasi
- `getPengajuan()` - Mendapatkan daftar pengajuan
- `approvePengajuan()` - Menyetujui pengajuan
- `rejectPengajuan()` - Menolak pengajuan
- `confirmSession()` - Konfirmasi jadwal
- `completeSession()` - Selesaikan sesi
- `markNotificationRead()` - Tandai notifikasi dibaca

## Models

### BkSession
- Relasi: belongsTo Siswa, belongsTo Guru (guruBk), hasMany BkNotification

### BkNotification
- Relasi: belongsTo User, belongsTo BkSession

## Fitur Tambahan
- Validasi tanggal (tidak bisa memilih tanggal yang sudah lewat)
- Validasi jam operasional (07:00 - 16:00 WIB)
- Notifikasi real-time untuk siswa dan guru BK
- Riwayat bimbingan lengkap
- Status tracking (pending, dijadwalkan, selesai, dibatalkan)

## Status Pengajuan
1. **Pending**: Menunggu konfirmasi dari guru BK
2. **Dijadwalkan**: Sudah dikonfirmasi dan dijadwalkan
3. **Selesai**: Sesi bimbingan telah selesai
4. **Dibatalkan**: Pengajuan ditolak oleh guru BK
