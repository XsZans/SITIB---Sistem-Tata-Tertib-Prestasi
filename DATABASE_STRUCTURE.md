# Struktur Database SiTib (Sistem Tata Tertib)

## Tabel yang Dibuat

### 1. users
Tabel untuk menyimpan data pengguna sistem
- `id` (Primary Key)
- `name` (Nama lengkap)
- `username` (Username unik)
- `email` (Email unik)
- `password` (Password terenkripsi)
- `role` (admin, guru_bk, wali_kelas, guru)
- `email_verified_at`
- `remember_token`
- `created_at`, `updated_at`

### 2. siswa
Tabel untuk menyimpan data siswa
- `id` (Primary Key)
- `nis` (Nomor Induk Siswa - unik)
- `nama` (Nama siswa)
- `kelas` (Kelas siswa)
- `jurusan` (Jurusan siswa)
- `poin_pelanggaran` (Total poin pelanggaran)
- `created_at`, `updated_at`

### 3. jenis_pelanggaran
Tabel untuk menyimpan jenis-jenis pelanggaran
- `id` (Primary Key)
- `nama_pelanggaran` (Nama pelanggaran)
- `deskripsi` (Deskripsi pelanggaran)
- `poin` (Poin pelanggaran)
- `kategori` (ringan, sedang, berat)
- `created_at`, `updated_at`

### 4. pelanggaran
Tabel untuk menyimpan data pelanggaran siswa
- `id` (Primary Key)
- `siswa_id` (Foreign Key ke tabel siswa)
- `jenis_pelanggaran_id` (Foreign Key ke tabel jenis_pelanggaran)
- `user_id` (Foreign Key ke tabel users - guru yang mencatat)
- `tanggal_pelanggaran` (Tanggal pelanggaran)
- `keterangan` (Keterangan tambahan)
- `status` (pending, diproses, selesai)
- `created_at`, `updated_at`

### 5. sanksi
Tabel untuk menyimpan sanksi pelanggaran
- `id` (Primary Key)
- `pelanggaran_id` (Foreign Key ke tabel pelanggaran)
- `jenis_sanksi` (Jenis sanksi)
- `deskripsi_sanksi` (Deskripsi sanksi)
- `tanggal_sanksi` (Tanggal pemberian sanksi)
- `status_sanksi` (belum_dilaksanakan, sedang_dilaksanakan, selesai)
- `created_at`, `updated_at`

## Relasi Antar Tabel

1. **users** → **pelanggaran** (One to Many)
   - Satu user dapat mencatat banyak pelanggaran

2. **siswa** → **pelanggaran** (One to Many)
   - Satu siswa dapat memiliki banyak pelanggaran

3. **jenis_pelanggaran** → **pelanggaran** (One to Many)
   - Satu jenis pelanggaran dapat digunakan untuk banyak pelanggaran

4. **pelanggaran** → **sanksi** (One to Many)
   - Satu pelanggaran dapat memiliki banyak sanksi

## Data Default

### Users Default:
- **Admin**: username: `admin`, password: `admin123`
- **Guru BK**: username: `guru_bk`, password: `gurubk123`
- **Wali Kelas**: username: `wali_kelas`, password: `walikelas123`
- **Guru**: username: `guru`, password: `guru123`

### Jenis Pelanggaran:
- **Ringan** (1-10 poin): Terlambat, tidak mengerjakan tugas, dll
- **Sedang** (11-25 poin): Bolos, menyontek, tidak sopan, dll
- **Berat** (26+ poin): Berkelahi, membawa barang terlarang, dll

### Sample Siswa:
- 10 siswa dari berbagai kelas dan jurusan

## Cara Setup Database

1. **Buat Database**:
   ```sql
   CREATE DATABASE pelanggaran_ujikom;
   ```

2. **Jalankan Migrations**:
   ```bash
   php artisan migrate
   ```

3. **Jalankan Seeders**:
   ```bash
   php artisan db:seed
   ```

4. **Atau gunakan script otomatis**:
   - Jalankan `setup_database.bat` (Windows)
   - Atau jalankan `database_setup.sql` di phpMyAdmin

## Konfigurasi .env

Pastikan konfigurasi database di file `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pelanggaran_ujikom
DB_USERNAME=root
DB_PASSWORD=
```