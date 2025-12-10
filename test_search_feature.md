# Test Search Feature - Siswa Berprestasi Modal

## Fitur yang Ditambahkan

### 1. Search Bar
- **Lokasi**: Modal "Siswa Berprestasi" > Tab "Daftar Siswa"
- **Fungsi**: Mencari siswa berdasarkan nama, NIS, kelas, atau jurusan
- **Implementasi**: Real-time search dengan server-side filtering

### 2. Filter Enhancement
- **Filter Tahun**: Filter berdasarkan tahun prestasi
- **Filter Bulan**: Filter berdasarkan bulan prestasi  
- **Filter Kelas**: Filter berdasarkan tingkat kelas (X, XI, XII)
- **Tombol Reset**: Mengembalikan semua filter ke kondisi awal

### 3. Kombinasi Search + Filter
- Search bar dapat dikombinasikan dengan filter lainnya
- Semua parameter dikirim ke server untuk filtering yang akurat

## Cara Menguji

### 1. Akses Dashboard Admin/Kesiswaan
```
http://localhost/ujikom/pelanggaran/admin
atau
http://localhost/ujikom/pelanggaran/kesiswaan
```

### 2. Buka Modal Siswa Berprestasi
- Klik tombol "Lihat" pada card "Siswa Berprestasi"
- Pastikan tab "Daftar Siswa" aktif

### 3. Test Search Bar
- Ketik nama siswa di search bar
- Ketik NIS siswa
- Ketik nama kelas (contoh: "XI", "XII")
- Ketik nama jurusan

### 4. Test Filter
- Pilih tahun dari dropdown
- Pilih bulan dari dropdown
- Pilih kelas dari dropdown
- Klik tombol "Filter"

### 5. Test Reset
- Setelah melakukan filter/search
- Klik tombol "Reset"
- Semua filter harus kembali ke kondisi awal

### 6. Test Kombinasi
- Gunakan search bar + filter tahun
- Gunakan search bar + filter kelas
- Gunakan semua filter sekaligus

## Expected Results

### Search Bar
- ✅ Menampilkan hasil real-time saat mengetik
- ✅ Mencari di semua field: nama, NIS, kelas, jurusan
- ✅ Case-insensitive search
- ✅ Menampilkan "Tidak Ada Data" jika tidak ditemukan

### Filter
- ✅ Filter tahun menampilkan prestasi dari tahun yang dipilih
- ✅ Filter bulan menampilkan prestasi dari bulan yang dipilih
- ✅ Filter kelas menampilkan siswa dari kelas yang dipilih
- ✅ Kombinasi filter bekerja dengan benar

### Reset
- ✅ Semua dropdown kembali ke "Semua..."
- ✅ Search bar dikosongkan
- ✅ Data kembali menampilkan semua siswa berprestasi

### UI/UX
- ✅ Search bar memiliki icon search
- ✅ Placeholder text yang jelas
- ✅ Tombol reset dengan icon yang sesuai
- ✅ Layout responsive

## Technical Implementation

### Frontend (JavaScript)
- `searchSiswaPrestasi()`: Fungsi untuk real-time search
- `filterSiswaPrestasi()`: Fungsi untuk filtering dengan server
- `resetFilterSiswaPrestasi()`: Fungsi untuk reset semua filter
- `displaySiswaPrestasiData()`: Fungsi untuk menampilkan data

### Backend (Laravel)
- Route: `/admin/filter-siswa-prestasi` dan `/kesiswaan/filter-siswa-prestasi`
- Method: `AdminController@filterSiswaPrestasi`
- Parameter: `tahun`, `bulan`, `kelas`, `search`

### Database Query
```php
$query = Siswa::where('poin_prestasi', '>', 0)
    ->with(['prestasiSiswa' => function($q) use ($tahun, $bulan) {
        $q->where('status', 'diverifikasi');
        if ($tahun) $q->whereYear('created_at', $tahun);
        if ($bulan) $q->whereMonth('created_at', $bulan);
    }]);

if ($search) {
    $query->where(function($q) use ($search) {
        $q->where('nama', 'like', '%' . $search . '%')
          ->orWhere('nis', 'like', '%' . $search . '%')
          ->orWhere('kelas', 'like', '%' . $search . '%')
          ->orWhere('jurusan', 'like', '%' . $search . '%');
    });
}
```

## Troubleshooting

### Jika Search Tidak Berfungsi
1. Periksa console browser untuk error JavaScript
2. Pastikan route sudah terdaftar di `web.php`
3. Periksa method `filterSiswaPrestasi` di controller

### Jika Filter Tidak Akurat
1. Periksa parameter yang dikirim ke server
2. Pastikan relasi `prestasiSiswa` sudah benar di model
3. Periksa query database di method controller

### Jika Reset Tidak Berfungsi
1. Periksa fungsi `resetFilterSiswaPrestasi()`
2. Pastikan semua element ID sudah benar
3. Periksa pemanggilan `filterSiswaPrestasi()` setelah reset