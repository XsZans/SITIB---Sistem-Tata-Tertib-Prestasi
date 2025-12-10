# USER GUIDE - APLIKASI SISTEM INFORMASI PELANGGARAN SISWA

## 📊 RINGKASAN DOKUMEN
- **Total Slide**: 30-35 slide
- **Total Bab**: 8 bab
- **Format**: Google Docs / PowerPoint
- **Target Pengguna**: Admin, Guru BK, Wali Kelas, Siswa, Orang Tua, Kesiswaan, Kepala Sekolah

---

## 📑 STRUKTUR LENGKAP USER GUIDE

---

### **BAB 1: PENDAHULUAN** (4 slide)

#### Slide 1: Cover & Identitas Aplikasi
- Logo aplikasi
- Nama aplikasi: "Sistem Informasi Pelanggaran Siswa"
- Versi aplikasi
- Tahun pembuatan

#### Slide 2: Tentang Aplikasi
- Deskripsi singkat aplikasi
- Tujuan pengembangan
- Manfaat untuk sekolah
- Teknologi yang digunakan (Laravel Framework)

#### Slide 3: Fitur Utama Aplikasi
- ✅ Pencatatan pelanggaran siswa
- ✅ Pencatatan prestasi siswa
- ✅ Sistem poin pelanggaran & prestasi
- ✅ Manajemen sanksi
- ✅ Bimbingan konseling (BK)
- ✅ Notifikasi untuk orang tua
- ✅ Laporan & statistik
- ✅ Backup otomatis database
- ✅ Multi-role user (7 role)

#### Slide 4: Persyaratan Sistem
- Browser: Chrome, Firefox, Edge (versi terbaru)
- Koneksi internet stabil
- Resolusi layar minimal: 1366x768
- Email aktif untuk verifikasi akun

---

### **BAB 2: MEMULAI APLIKASI** (4 slide)

#### Slide 5: Cara Mengakses Aplikasi
- URL aplikasi: `http://localhost/pelanggaran` (atau sesuai domain)
- Screenshot halaman login
- Langkah-langkah akses pertama kali

#### Slide 6: Halaman Login
- Screenshot halaman login
- Cara login:
  1. Masukkan username
  2. Masukkan password
  3. Klik tombol "Masuk"
- Penjelasan pesan error login

#### Slide 7: Registrasi Akun Baru
- Screenshot halaman registrasi
- Jenis akun yang bisa didaftarkan:
  - Siswa (pilih dari data siswa)
  - Wali Kelas (pilih dari data guru)
  - Orang Tua (pilih siswa yang sudah punya akun)
- Catatan: Akun perlu verifikasi admin

#### Slide 8: Verifikasi Email & Lupa Password
- Cara verifikasi email
- Screenshot email verifikasi
- Cara reset password jika lupa
- Screenshot halaman forgot password

---

### **BAB 3: ROLE & HAK AKSES** (3 slide)

#### Slide 9: Penjelasan Role Pengguna
Tabel role dan akses:

| Role | Hak Akses Utama |
|------|----------------|
| **Admin** | Full akses semua fitur, kelola user, backup |
| **Guru BK** | Input pelanggaran, bimbingan konseling, notifikasi |
| **Wali Kelas** | Input pelanggaran kelas, laporan kelas |
| **Kesiswaan** | Verifikasi pelanggaran & prestasi |
| **Kepala Sekolah** | Monitoring & laporan keseluruhan |
| **Siswa** | Lihat pelanggaran & prestasi sendiri |
| **Orang Tua** | Monitoring anak, notifikasi |

#### Slide 10: Alur Verifikasi Pengguna
- Flowchart proses registrasi → verifikasi admin → aktivasi akun
- Screenshot halaman verifikasi user (admin)

#### Slide 11: Struktur Menu per Role
- Diagram menu untuk setiap role
- Perbedaan akses antar role

---

### **BAB 4: PANDUAN UNTUK ADMIN** (9 slide)

#### Slide 12: Dashboard Admin
- Screenshot dashboard admin
- Penjelasan widget statistik:
  - Total siswa
  - Total pelanggaran
  - Total prestasi
  - Grafik pelanggaran per bulan

#### Slide 13: Kelola Data Siswa
- Cara menambah siswa baru
- Cara edit data siswa
- Cara hapus data siswa
- Screenshot form input siswa
- Field yang harus diisi: NIS, Nama, Kelas, Jenis Kelamin, dll

#### Slide 14: Kelola Data Guru & Wali Kelas
- Cara menambah data guru
- Cara menentukan wali kelas
- Screenshot form input guru
- Field: NIP, Nama, Jabatan, Wali Kelas

#### Slide 15: Kelola Data Orang Tua
- Cara menambah data orang tua
- Menghubungkan orang tua dengan siswa
- Screenshot form input orang tua
- Field: Nama Ayah, Nama Ibu, No. HP, Alamat

#### Slide 16: Registrasi Pengguna Baru
- Cara mendaftarkan user baru (Siswa, Wali Kelas, Orang Tua)
- Screenshot halaman registrasi admin
- Perbedaan registrasi admin vs registrasi publik

#### Slide 17: Verifikasi User & Laporan
- Cara verifikasi user baru
- Cara verifikasi laporan pelanggaran
- Cara verifikasi laporan prestasi
- Screenshot halaman verifikasi

#### Slide 18: Kelola Jenis Pelanggaran & Sanksi
- Cara menambah jenis pelanggaran
- Kategori pelanggaran: Ringan, Sedang, Berat
- Cara menambah sanksi
- Screenshot form jenis pelanggaran

#### Slide 19: Kelola Pelanggaran & Prestasi
- Cara input pelanggaran siswa
- Cara input prestasi siswa
- Upload bukti (foto/dokumen)
- Screenshot form input pelanggaran

#### Slide 20: Backup & Restore Database
- Cara setting backup otomatis
- Cara backup manual
- Cara restore database
- Screenshot halaman backup

---

### **BAB 5: PANDUAN UNTUK GURU BK** (5 slide)

#### Slide 21: Dashboard Guru BK
- Screenshot dashboard BK
- Statistik siswa bermasalah
- Notifikasi bimbingan

#### Slide 22: Input Pelanggaran Siswa
- Cara input pelanggaran
- Pilih siswa, jenis pelanggaran, tanggal
- Upload bukti pelanggaran
- Screenshot form input

#### Slide 23: Bimbingan Konseling (BK Session)
- Cara membuat sesi bimbingan
- Cara mengundang siswa
- Cara input hasil bimbingan
- Screenshot form BK session

#### Slide 24: Notifikasi Orang Tua
- Cara mengirim notifikasi ke orang tua
- Jenis notifikasi
- Screenshot halaman notifikasi

#### Slide 25: Laporan & Riwayat BK
- Cara melihat riwayat bimbingan
- Cara cetak laporan BK
- Export laporan PDF
- Screenshot laporan

---

### **BAB 6: PANDUAN UNTUK WALI KELAS** (4 slide)

#### Slide 26: Dashboard Wali Kelas
- Screenshot dashboard wali kelas
- Statistik siswa di kelas
- Pelanggaran per siswa

#### Slide 27: Input Pelanggaran Siswa Kelas
- Cara input pelanggaran siswa di kelas
- Pilih siswa dari kelas yang diampu
- Screenshot form input

#### Slide 28: Lihat Data Siswa Kelas
- Cara melihat profil siswa
- Riwayat pelanggaran siswa
- Riwayat prestasi siswa
- Screenshot halaman siswa

#### Slide 29: Cetak Laporan Kelas
- Cara membuat laporan kelas
- Filter laporan (per periode, per siswa)
- Export ke PDF
- Screenshot laporan kelas

---

### **BAB 7: PANDUAN UNTUK SISWA & ORANG TUA** (4 slide)

#### Slide 30: Dashboard Siswa
- Screenshot dashboard siswa
- Poin pelanggaran & prestasi
- Riwayat pelanggaran
- Jadwal bimbingan BK

#### Slide 31: Lihat Riwayat Pelanggaran & Prestasi
- Cara melihat detail pelanggaran
- Cara melihat detail prestasi
- Cara merespon undangan BK
- Screenshot halaman riwayat

#### Slide 32: Dashboard Orang Tua
- Screenshot dashboard orang tua
- Monitoring pelanggaran anak
- Notifikasi dari sekolah

#### Slide 33: Monitoring & Cetak Laporan Anak
- Cara melihat detail pelanggaran anak
- Cara melihat prestasi anak
- Cara cetak laporan
- Screenshot laporan orang tua

---

### **BAB 8: FAQ & TROUBLESHOOTING** (3 slide)

#### Slide 34: Pertanyaan Umum (FAQ)
**Q: Bagaimana cara reset password?**
A: Klik "Lupa Password" di halaman login, masukkan email, cek inbox untuk link reset.

**Q: Akun saya belum bisa login setelah registrasi?**
A: Akun perlu diverifikasi admin terlebih dahulu. Hubungi admin sekolah.

**Q: Bagaimana cara upload bukti pelanggaran?**
A: Klik tombol "Pilih File", pilih foto/dokumen (max 2MB), lalu submit.

**Q: Notifikasi tidak masuk ke email orang tua?**
A: Pastikan email orang tua sudah benar dan cek folder spam.

**Q: Bagaimana cara melihat laporan per periode?**
A: Gunakan filter tanggal di halaman laporan, pilih periode, lalu klik "Tampilkan".

#### Slide 35: Solusi Masalah Umum
| Masalah | Solusi |
|---------|--------|
| Tidak bisa login | Cek username/password, pastikan akun sudah diverifikasi |
| Halaman error 404 | Refresh browser atau hubungi admin |
| Upload file gagal | Pastikan ukuran file < 2MB dan format JPG/PNG/PDF |
| Data tidak muncul | Clear cache browser atau logout-login kembali |
| Email verifikasi tidak masuk | Cek spam folder atau minta kirim ulang |

#### Slide 36: Kontak & Dukungan
- **Admin Sistem**: [email/no HP admin]
- **Guru BK**: [email/no HP BK]
- **Kesiswaan**: [email/no HP kesiswaan]
- **Jam Operasional**: Senin-Jumat, 07.00-15.00 WIB
- **Dokumentasi Online**: [link dokumentasi]

---

## 📝 CATATAN TAMBAHAN

### Tips Pembuatan di Google Docs:
1. **Gunakan Template Profesional**
   - Pilih template presentasi yang clean
   - Konsisten dalam penggunaan font & warna
   - Gunakan warna sekolah jika ada

2. **Screenshot Berkualitas**
   - Ambil screenshot dengan resolusi tinggi
   - Crop bagian yang tidak perlu
   - Tambahkan border atau shadow untuk estetika
   - Beri highlight/arrow untuk fokus area penting

3. **Elemen Visual**
   - Gunakan icon untuk setiap fitur
   - Buat flowchart untuk alur proses
   - Gunakan tabel untuk perbandingan
   - Tambahkan diagram untuk struktur

4. **Konten**
   - Gunakan bullet points, hindari paragraf panjang
   - Numbering untuk langkah-langkah
   - Highlight informasi penting dengan warna
   - Tambahkan "Tips" atau "Catatan Penting" box

5. **Navigasi**
   - Buat daftar isi dengan hyperlink
   - Tambahkan nomor halaman
   - Buat index di akhir dokumen

### Format Alternatif:
- **PDF**: Untuk distribusi final
- **Video Tutorial**: Rekam screencast untuk setiap fitur
- **Quick Start Guide**: Versi ringkas 1-2 halaman
- **Cheat Sheet**: Kartu referensi cepat per role

---

## 🎯 CHECKLIST PEMBUATAN

- [ ] Ambil screenshot semua halaman aplikasi
- [ ] Buat flowchart alur proses
- [ ] Siapkan data dummy untuk contoh
- [ ] Buat diagram struktur menu
- [ ] Tulis FAQ berdasarkan pertanyaan umum
- [ ] Review dengan user dari setiap role
- [ ] Proofread typo dan grammar
- [ ] Export ke PDF final
- [ ] Buat versi cetak (jika perlu)

---

**Dibuat oleh**: [Nama Pembuat]  
**Tanggal**: [Tanggal Pembuatan]  
**Versi**: 1.0  
**Aplikasi**: Sistem Informasi Pelanggaran Siswa (Laravel)
