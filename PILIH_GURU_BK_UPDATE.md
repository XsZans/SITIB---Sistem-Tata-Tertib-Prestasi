# Update: Pilihan Guru BK di Pengajuan Bimbingan

## Fitur Tambahan

### Siswa Dapat Memilih Guru BK yang Dituju
- Dropdown berisi daftar semua Guru BK yang tersedia
- Siswa dapat memilih Guru BK spesifik untuk bimbingan
- Notifikasi akan dikirim ke Guru BK yang dipilih

## Perubahan yang Dibuat

### 1. Controller - SiswaController.php
```php
// Method bk() - Tambah query guru BK
$guruBkList = Guru::whereHas('user', function($query) {
    $query->where('role', 'bk');
})->get();

// Method ajukanBimbingan() - Validasi guru_bk_id
$request->validate([
    'guru_bk_id' => 'required|exists:guru,id',
    ...
]);
```

### 2. View - siswa/bk.blade.php
```html
<!-- Dropdown Guru BK -->
<select id="guru_bk_id" required>
    <option value="">Pilih Guru BK</option>
    @foreach($guruBkList as $guruBk)
    <option value="{{ $guruBk->id }}">{{ $guruBk->nama }}</option>
    @endforeach
</select>
```

### 3. JavaScript - Validasi & Submit
```javascript
const guruBkId = document.getElementById('guru_bk_id').value;

// Validasi
if (!guruBkId || !tujuan || !alasan || !jam) {
    alert('Semua field harus diisi');
    return;
}

// Submit
body: JSON.stringify({
    guru_bk_id: guruBkId,
    ...
})
```

## Alur Sistem

### 1. Siswa Mengajukan Bimbingan
```
Siswa → Klik "Ajukan Bimbingan"
↓
Isi Form:
- Nama (auto)
- NIS (auto)
- Guru BK (dropdown) ← BARU
- Tujuan Bimbingan
- Alasan
- Jam Bimbingan
↓
Submit → Notifikasi ke Guru BK yang dipilih & Admin
```

### 2. Notifikasi Dikirim ke Guru BK yang Dipilih
```
Pengajuan → guru_bk_id = [ID Guru BK yang dipilih]
↓
Notifikasi ke:
1. Guru BK yang dipilih (user_id dari guru tersebut)
2. Admin
```

### 3. Guru BK Menerima Notifikasi
```
Guru BK Login → Dashboard
↓
Lihat "Pengajuan Bimbingan dari Siswa"
↓
Hanya muncul pengajuan yang ditujukan ke guru BK tersebut
```

## Keuntungan Fitur Ini

### 1. Fleksibilitas untuk Siswa
- Siswa dapat memilih Guru BK yang mereka percaya
- Siswa dapat memilih Guru BK yang sesuai dengan masalah mereka

### 2. Distribusi Beban Kerja
- Pengajuan terdistribusi ke beberapa Guru BK
- Tidak semua pengajuan masuk ke satu Guru BK

### 3. Spesialisasi
- Jika ada Guru BK dengan spesialisasi tertentu
- Siswa dapat memilih sesuai kebutuhan

## Validasi

### Form Siswa:
- **Guru BK**: required, must exist in guru table
- Tujuan bimbingan: required
- Tujuan lainnya: required jika pilih "Lainnya"
- Alasan: required, max 500 karakter
- Jam bimbingan: required

### Backend:
```php
$request->validate([
    'guru_bk_id' => 'required|exists:guru,id',
    'tujuan_bimbingan' => 'required|string',
    'tujuan_lainnya' => 'required_if:tujuan_bimbingan,Lainnya|string|max:200',
    'alasan' => 'required|string|max:500',
    'jam_bimbingan' => 'required'
]);
```

## File yang Diubah

### Controllers
- `app/Http/Controllers/SiswaController.php`
  - Method `bk()`: Tambah query `$guruBkList`
  - Method `ajukanBimbingan()`: Tambah validasi `guru_bk_id`

### Views
- `resources/views/siswa/bk.blade.php`
  - Tambah dropdown Guru BK
  - Update JavaScript validasi
  - Update request body

### Documentation
- `PENGAJUAN_BIMBINGAN.md` (updated)
- `PILIH_GURU_BK_UPDATE.md` (new)

## Cara Menggunakan

### Untuk Siswa:
1. Login sebagai siswa
2. Buka menu "Bimbingan Konseling"
3. Klik tombol "Ajukan Bimbingan"
4. **Pilih Guru BK yang dituju** ← BARU
5. Isi form lainnya
6. Klik "Ajukan"
7. Notifikasi akan dikirim ke Guru BK yang dipilih

### Untuk Guru BK:
1. Login sebagai Guru BK
2. Buka Dashboard BK
3. Lihat "Pengajuan Bimbingan dari Siswa"
4. **Hanya muncul pengajuan yang ditujukan ke Anda**
5. Review dan approve/reject

## Status
✅ **Fitur pilihan Guru BK telah berhasil ditambahkan**
