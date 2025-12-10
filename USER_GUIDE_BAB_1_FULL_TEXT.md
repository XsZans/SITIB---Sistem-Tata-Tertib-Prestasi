# BAB 1: PENDAHULUAN
## User Guide - Sistem Informasi Pelanggaran Siswa

---

## 📄 SLIDE 2: TENTANG APLIKASI

### DESKRIPSI APLIKASI

Sistem Informasi Pelanggaran Siswa adalah aplikasi berbasis web yang dirancang khusus untuk membantu sekolah dalam mengelola dan memonitor pelanggaran serta prestasi siswa secara digital, terintegrasi, dan real-time.

Aplikasi ini menggantikan sistem pencatatan manual yang rentan terhadap kehilangan data dan kesulitan dalam pembuatan laporan. Dengan sistem digital ini, semua data tersimpan dengan aman dan dapat diakses kapan saja oleh pihak yang berwenang.

---

### TUJUAN PENGEMBANGAN

**1. Meningkatkan Efisiensi Administrasi**
   - Mempercepat proses pencatatan pelanggaran dan prestasi siswa
   - Mengurangi penggunaan kertas (paperless)
   - Mempermudah pencarian dan pengolahan data

**2. Transparansi Informasi**
   - Orang tua dapat memantau perkembangan anak secara real-time
   - Siswa dapat melihat riwayat pelanggaran dan prestasi mereka
   - Kepala sekolah mendapat laporan komprehensif

**3. Meningkatkan Kedisiplinan Siswa**
   - Sistem poin yang jelas dan terukur
   - Notifikasi otomatis kepada orang tua
   - Tracking pelanggaran berulang

**4. Mendukung Bimbingan Konseling**
   - Identifikasi siswa yang memerlukan bimbingan khusus
   - Dokumentasi sesi konseling
   - Follow-up yang terstruktur

---

### MANFAAT UNTUK SEKOLAH

✅ **Pengelolaan Data Terpusat**  
Semua data pelanggaran dan prestasi tersimpan dalam satu sistem yang terintegrasi

✅ **Laporan Otomatis**  
Generate laporan harian, mingguan, bulanan, atau per semester dengan sekali klik

✅ **Notifikasi Real-Time**  
Orang tua langsung mendapat notifikasi saat anak melakukan pelanggaran

✅ **Backup Otomatis**  
Data di-backup secara otomatis untuk mencegah kehilangan data

✅ **Multi-User Access**  
7 level pengguna dengan hak akses yang berbeda sesuai kebutuhan

✅ **Monitoring Komprehensif**  
Dashboard statistik untuk monitoring kondisi kedisiplinan sekolah

---

### TEKNOLOGI YANG DIGUNAKAN

**Backend Framework:**  
Laravel 11.x (PHP Framework)

**Frontend:**  
Blade Template Engine, Tailwind CSS, JavaScript

**Database:**  
MySQL / MariaDB

**Library Tambahan:**
- DomPDF (Export PDF)
- Chart.js (Grafik & Statistik)
- DataTables (Tabel Interaktif)

**Server Requirements:**
- PHP 8.2 atau lebih tinggi
- MySQL 5.7+ / MariaDB 10.3+
- Apache / Nginx Web Server

---

## 📄 SLIDE 3: FITUR UTAMA APLIKASI

### FITUR-FITUR UNGGULAN

---

### 1️⃣ MANAJEMEN PELANGGARAN SISWA

**📋 Pencatatan Pelanggaran**
- Input pelanggaran dengan kategori (Ringan, Sedang, Berat)
- Upload bukti foto/dokumen pelanggaran
- Pencatatan pengadu (guru/wali kelas/BK)
- Tanggal dan waktu kejadian
- Lokasi kejadian
- Kronologi lengkap

**⚖️ Sistem Poin Pelanggaran**
- Setiap jenis pelanggaran memiliki poin tertentu
- Akumulasi poin otomatis
- Alert jika poin mencapai batas tertentu
- Riwayat poin per siswa

**✅ Verifikasi Pelanggaran**
- Pelanggaran perlu diverifikasi oleh Kesiswaan
- Status: Pending, Disetujui, Ditolak
- Alasan penolakan jika ditolak
- Notifikasi ke pengadu

---

### 2️⃣ MANAJEMEN PRESTASI SISWA

**🏆 Pencatatan Prestasi**
- Input prestasi akademik dan non-akademik
- Tingkat prestasi (Kelas, Sekolah, Kecamatan, Kabupaten, Provinsi, Nasional, Internasional)
- Juara/peringkat yang diraih
- Upload sertifikat/piagam
- Tanggal perolehan prestasi

**⭐ Sistem Poin Prestasi**
- Poin prestasi berdasarkan tingkat dan juara
- Akumulasi poin prestasi
- Kompensasi poin pelanggaran dengan prestasi
- Leaderboard siswa berprestasi

---

### 3️⃣ MANAJEMEN SANKSI

**📝 Jenis Sanksi**
- Teguran lisan
- Teguran tertulis
- Panggilan orang tua
- Skorsing
- Sanksi khusus lainnya

**📊 Pelaksanaan Sanksi**
- Tracking pelaksanaan sanksi
- Upload bukti pelaksanaan sanksi
- Status: Belum Dilaksanakan, Sedang Dilaksanakan, Selesai
- Catatan pelaksanaan

---

### 4️⃣ BIMBINGAN KONSELING (BK)

**👥 Sesi Bimbingan**
- Penjadwalan sesi BK
- Undangan ke siswa
- Respon siswa (Hadir/Tidak Hadir)
- Catatan hasil bimbingan
- Follow-up bimbingan

**🔔 Notifikasi BK**
- Notifikasi undangan ke siswa
- Notifikasi ke orang tua
- Reminder sesi BK
- Notifikasi hasil bimbingan

---

### 5️⃣ NOTIFIKASI & KOMUNIKASI

**📧 Notifikasi Email**
- Notifikasi pelanggaran ke orang tua
- Notifikasi prestasi ke orang tua
- Notifikasi undangan BK
- Notifikasi verifikasi akun

**📱 Notifikasi In-App**
- Notifikasi real-time di aplikasi
- Badge notifikasi yang belum dibaca
- Riwayat notifikasi

---

### 6️⃣ LAPORAN & STATISTIK

**📈 Dashboard Statistik**
- Grafik pelanggaran per bulan
- Grafik prestasi per bulan
- Top 10 siswa bermasalah
- Top 10 siswa berprestasi
- Statistik per kelas
- Statistik per jenis pelanggaran

**📄 Export Laporan**
- Export ke PDF
- Laporan per siswa
- Laporan per kelas
- Laporan per periode
- Laporan per jenis pelanggaran
- Laporan prestasi

---

### 7️⃣ MANAJEMEN USER & DATA

**👤 Multi-Role User**
- Admin (Full Access)
- Guru BK (Bimbingan & Konseling)
- Wali Kelas (Kelola Kelas)
- Kesiswaan (Verifikasi)
- Kepala Sekolah (Monitoring)
- Siswa (View Only)
- Orang Tua (Monitoring Anak)

**🗄️ Manajemen Data Master**
- Data Siswa (NIS, Nama, Kelas, dll)
- Data Guru (NIP, Nama, Jabatan, Wali Kelas)
- Data Orang Tua (Nama, Kontak, Alamat)
- Jenis Pelanggaran & Poin
- Jenis Prestasi & Poin
- Jenis Sanksi

**💾 Backup & Restore**
- Backup otomatis terjadwal
- Backup manual
- Restore database
- Riwayat backup

---

### 8️⃣ KEAMANAN & VERIFIKASI

**🔐 Sistem Keamanan**
- Login dengan username & password
- Verifikasi email
- Reset password via email
- Session timeout otomatis
- Role-based access control

**✔️ Verifikasi User**
- Registrasi user baru perlu verifikasi admin
- Verifikasi email wajib
- Approval akun oleh admin

---

## 📄 SLIDE 4: PERSYARATAN SISTEM

### PERSYARATAN PERANGKAT & BROWSER

---

### 💻 PERANGKAT YANG DIDUKUNG

**Desktop/Laptop:**
- Windows 10/11
- macOS 10.14 atau lebih baru
- Linux (Ubuntu, Fedora, dll)
- RAM minimal: 4GB
- Resolusi layar minimal: 1366 x 768 px
- Resolusi layar optimal: 1920 x 1080 px (Full HD)

**Tablet:**
- iPad (iOS 13+)
- Android Tablet (Android 8.0+)
- Resolusi minimal: 1024 x 768 px

**Smartphone:**
- iPhone (iOS 13+)
- Android (Android 8.0+)
- Responsive design untuk layar kecil

---

### 🌐 BROWSER YANG DIDUKUNG

**Browser yang Direkomendasikan:**

✅ **Google Chrome** (Versi 90 atau lebih baru)  
   - Performa terbaik
   - Update otomatis
   - Kompatibilitas penuh

✅ **Mozilla Firefox** (Versi 88 atau lebih baru)  
   - Performa baik
   - Privacy-focused
   - Kompatibilitas penuh

✅ **Microsoft Edge** (Versi 90 atau lebih baru)  
   - Berbasis Chromium
   - Terintegrasi dengan Windows
   - Kompatibilitas penuh

✅ **Safari** (Versi 14 atau lebih baru)  
   - Untuk pengguna macOS/iOS
   - Performa baik di perangkat Apple

⚠️ **Tidak Disarankan:**
- Internet Explorer (sudah tidak didukung)
- Browser versi lama

---

### 🌍 KONEKSI INTERNET

**Kecepatan Internet Minimal:**
- Download: 2 Mbps
- Upload: 1 Mbps

**Kecepatan Internet Optimal:**
- Download: 10 Mbps atau lebih
- Upload: 5 Mbps atau lebih

**Catatan:**
- Koneksi stabil diperlukan untuk upload file
- Koneksi lambat dapat menyebabkan timeout
- Gunakan WiFi untuk performa terbaik

---

### 📧 PERSYARATAN AKUN

**Email Aktif:**
- Setiap user harus memiliki email aktif
- Email digunakan untuk:
  - Verifikasi akun
  - Reset password
  - Notifikasi pelanggaran/prestasi
  - Komunikasi dari sekolah

**Format Email yang Valid:**
- contoh@gmail.com
- contoh@yahoo.com
- contoh@sekolah.sch.id

**Catatan Penting:**
- Pastikan email dapat menerima email dari aplikasi
- Cek folder spam jika email tidak masuk
- Gunakan email yang aktif dan sering dicek

---

### 📱 PERSYARATAN TAMBAHAN

**Untuk Upload File:**
- Format gambar: JPG, JPEG, PNG
- Format dokumen: PDF
- Ukuran maksimal: 2 MB per file
- Pastikan file tidak corrupt

**Untuk Export/Download:**
- Browser harus mengizinkan download
- Pastikan ada ruang penyimpanan cukup
- Pop-up blocker harus dinonaktifkan untuk export PDF

**Untuk Notifikasi:**
- Izinkan notifikasi dari browser (opsional)
- Pastikan email notification tidak masuk spam
- Cek pengaturan email secara berkala

---

### ⚙️ PENGATURAN BROWSER YANG DISARANKAN

**JavaScript:**
✅ Harus diaktifkan (wajib)

**Cookies:**
✅ Harus diaktifkan (wajib untuk login)

**Pop-up Blocker:**
⚠️ Nonaktifkan untuk domain aplikasi (untuk export PDF)

**Cache:**
💡 Clear cache jika mengalami masalah tampilan

**Zoom Level:**
💡 Gunakan 100% untuk tampilan optimal

---

### 🔧 TROUBLESHOOTING AWAL

**Jika Halaman Tidak Muncul:**
1. Refresh browser (F5 atau Ctrl+R)
2. Clear cache browser
3. Coba browser lain
4. Cek koneksi internet

**Jika Tidak Bisa Login:**
1. Pastikan username dan password benar
2. Pastikan akun sudah diverifikasi admin
3. Cek email untuk verifikasi
4. Gunakan fitur "Lupa Password" jika perlu

**Jika Upload File Gagal:**
1. Pastikan ukuran file < 2MB
2. Pastikan format file sesuai (JPG/PNG/PDF)
3. Coba compress file terlebih dahulu
4. Cek koneksi internet

---

### 📞 BANTUAN TEKNIS

**Jika Mengalami Masalah:**

1. **Cek FAQ** (Bab 8 user guide ini)
2. **Hubungi Admin Sistem**
   - Email: [admin@sekolah.sch.id]
   - Telepon: [0xxx-xxxx-xxxx]
   - WhatsApp: [08xx-xxxx-xxxx]

3. **Jam Operasional Bantuan:**
   - Senin - Jumat: 07.00 - 15.00 WIB
   - Sabtu: 07.00 - 12.00 WIB
   - Minggu & Libur: Tutup

4. **Informasi yang Perlu Disiapkan:**
   - Username Anda
   - Role/jabatan Anda
   - Screenshot error (jika ada)
   - Deskripsi masalah yang dialami
   - Browser dan versi yang digunakan

---

### ✅ CHECKLIST KESIAPAN

Sebelum mulai menggunakan aplikasi, pastikan:

- [ ] Perangkat memenuhi spesifikasi minimal
- [ ] Browser versi terbaru sudah terinstall
- [ ] Koneksi internet stabil
- [ ] Email aktif sudah disiapkan
- [ ] Username dan password sudah diterima
- [ ] Akun sudah diverifikasi oleh admin
- [ ] Email verifikasi sudah diklik
- [ ] Sudah membaca user guide ini

**Jika semua checklist sudah ✅, Anda siap menggunakan aplikasi!**

---

## 🎯 RINGKASAN BAB 1

Pada Bab 1 ini, Anda telah mempelajari:

1. ✅ Identitas dan informasi dasar aplikasi
2. ✅ Tujuan dan manfaat aplikasi untuk sekolah
3. ✅ Fitur-fitur lengkap yang tersedia (8 kategori fitur utama)
4. ✅ Persyaratan sistem dan perangkat yang dibutuhkan
5. ✅ Persiapan sebelum menggunakan aplikasi

**Selanjutnya:** Bab 2 akan membahas cara memulai aplikasi, login, registrasi, dan verifikasi akun.

---

**Catatan:** Dokumen ini akan terus diperbarui seiring dengan perkembangan aplikasi. Pastikan Anda selalu menggunakan versi user guide terbaru.

---

**Versi Dokumen:** 1.0  
**Terakhir Diperbarui:** Januari 2025  
**Halaman:** 1-4 dari 36
