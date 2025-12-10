<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisPelanggaran;

class JenisPelanggaranLengkapSeeder extends Seeder
{
    public function run()
    {
        JenisPelanggaran::query()->delete();
        
        $pelanggaran = [
            // I. KEPRIBADIAN (SIKAP)
            ['nama_pelanggaran' => 'Membuat keributan/kegaduhan dalam kelas saat pelajaran', 'deskripsi' => 'Mengganggu proses belajar mengajar', 'poin' => 10, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Masuk/keluar sekolah tidak melalui gerbang', 'deskripsi' => 'Melanggar aturan akses sekolah', 'poin' => 20, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Berkata tidak jujur/tidak sopan/kasar', 'deskripsi' => 'Perilaku tidak sopan', 'poin' => 10, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Mengotori barang milik sekolah/guru/teman', 'deskripsi' => 'Merusak kebersihan fasilitas', 'poin' => 10, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Merusak/menghilangkan barang milik sekolah/guru/teman', 'deskripsi' => 'Merusak properti', 'poin' => 50, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Mencuri barang milik sekolah/guru/teman', 'deskripsi' => 'Tindak pencurian', 'poin' => 50, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Makan/minum di kelas saat pelajaran', 'deskripsi' => 'Melanggar tata tertib kelas', 'poin' => 5, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Mengaktifkan HP di kelas saat pelajaran', 'deskripsi' => 'Mengganggu konsentrasi belajar', 'poin' => 5, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Membuang sampah sembarangan', 'deskripsi' => 'Tidak menjaga kebersihan', 'poin' => 5, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Membawa teman dari luar sekolah', 'deskripsi' => 'Melanggar aturan tamu', 'poin' => 10, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Membawa benda tidak terkait pelajaran', 'deskripsi' => 'Membawa barang terlarang ringan', 'poin' => 5, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Bertengkar dengan teman', 'deskripsi' => 'Konflik antar siswa', 'poin' => 15, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Memalsu tanda tangan', 'deskripsi' => 'Pemalsuan dokumen', 'poin' => 40, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Menggelapkan SPP', 'deskripsi' => 'Penyalahgunaan uang sekolah', 'poin' => 40, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Membentuk organisasi tanpa izin', 'deskripsi' => 'Kegiatan tidak resmi', 'poin' => 15, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Berbuat asusila', 'deskripsi' => 'Perilaku tidak senonoh', 'poin' => 50, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Membawa rokok', 'deskripsi' => 'Membawa barang terlarang', 'poin' => 25, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Merokok di sekolah', 'deskripsi' => 'Melanggar aturan kawasan bebas rokok', 'poin' => 40, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Merokok di luar sekolah berseragam', 'deskripsi' => 'Mencemarkan nama sekolah', 'poin' => 40, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Membawa konten pornografi', 'deskripsi' => 'Membawa materi tidak pantas', 'poin' => 75, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Memperjualbelikan konten terlarang', 'deskripsi' => 'Distribusi materi terlarang', 'poin' => 75, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Membawa senjata tajam', 'deskripsi' => 'Membawa barang berbahaya', 'poin' => 40, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Memperjualbelikan senjata', 'deskripsi' => 'Distribusi barang berbahaya', 'poin' => 75, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Mengancam dengan senjata', 'deskripsi' => 'Intimidasi dengan kekerasan', 'poin' => 75, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Melukai dengan senjata', 'deskripsi' => 'Kekerasan fisik', 'poin' => 75, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Membawa narkoba/minuman terlarang', 'deskripsi' => 'Membawa zat terlarang', 'poin' => 75, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Menggunakan narkoba di sekolah', 'deskripsi' => 'Penyalahgunaan narkoba', 'poin' => 100, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Mengedarkan narkoba', 'deskripsi' => 'Distribusi narkoba', 'poin' => 100, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Perkelahian internal sekolah', 'deskripsi' => 'Kekerasan antar siswa internal', 'poin' => 75, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Perkelahian dengan sekolah lain', 'deskripsi' => 'Tawuran antar sekolah', 'poin' => 100, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Mengancam guru/kepala sekolah', 'deskripsi' => 'Intimidasi terhadap pendidik', 'poin' => 75, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Memukul guru/kepala sekolah', 'deskripsi' => 'Kekerasan terhadap pendidik', 'poin' => 100, 'kategori' => 'I'],
            ['nama_pelanggaran' => 'Dikembalikan kepada orang tua (Drop Out)', 'deskripsi' => 'Siswa dengan total poin pelanggaran 90-100 dikembalikan kepada orang tua dan dikeluarkan dari sekolah', 'poin' => 100, 'kategori' => 'I'],
            
            // II. KERAJINAN
            ['nama_pelanggaran' => 'Terlambat 1x', 'deskripsi' => 'Keterlambatan pertama', 'poin' => 2, 'kategori' => 'II'],
            ['nama_pelanggaran' => 'Terlambat 2x', 'deskripsi' => 'Keterlambatan kedua', 'poin' => 3, 'kategori' => 'II'],
            ['nama_pelanggaran' => 'Terlambat 3x atau lebih', 'deskripsi' => 'Keterlambatan berulang', 'poin' => 5, 'kategori' => 'II'],
            ['nama_pelanggaran' => 'Terlambat karena alasan palsu', 'deskripsi' => 'Keterlambatan dengan kebohongan', 'poin' => 5, 'kategori' => 'II'],
            ['nama_pelanggaran' => 'Keluar saat pelajaran tidak kembali', 'deskripsi' => 'Meninggalkan kelas tanpa izin', 'poin' => 25, 'kategori' => 'II'],
            ['nama_pelanggaran' => 'Pulang tanpa izin', 'deskripsi' => 'Meninggalkan sekolah tanpa izin', 'poin' => 10, 'kategori' => 'II'],
            ['nama_pelanggaran' => 'Sakit tanpa surat', 'deskripsi' => 'Tidak masuk tanpa keterangan resmi', 'poin' => 2, 'kategori' => 'II'],
            ['nama_pelanggaran' => 'Izin tanpa surat', 'deskripsi' => 'Tidak masuk tanpa surat izin', 'poin' => 2, 'kategori' => 'II'],
            ['nama_pelanggaran' => 'Alpa', 'deskripsi' => 'Tidak masuk tanpa keterangan', 'poin' => 5, 'kategori' => 'II'],
            ['nama_pelanggaran' => 'Membolos', 'deskripsi' => 'Tidak mengikuti pelajaran', 'poin' => 5, 'kategori' => 'II'],
            ['nama_pelanggaran' => 'Surat keterangan palsu', 'deskripsi' => 'Pemalsuan surat izin', 'poin' => 10, 'kategori' => 'II'],
            ['nama_pelanggaran' => 'Keluar kelas tanpa izin', 'deskripsi' => 'Meninggalkan kelas saat pelajaran', 'poin' => 5, 'kategori' => 'II'],
            ['nama_pelanggaran' => 'Tidak mengerjakan tugas', 'deskripsi' => 'Tidak menyelesaikan kewajiban akademik', 'poin' => 5, 'kategori' => 'II'],
            ['nama_pelanggaran' => 'Tidak membawa buku pelajaran', 'deskripsi' => 'Tidak menyiapkan perlengkapan belajar', 'poin' => 3, 'kategori' => 'II'],
            ['nama_pelanggaran' => 'Tidur saat pelajaran', 'deskripsi' => 'Tidak fokus dalam pembelajaran', 'poin' => 5, 'kategori' => 'II'],
            
            // III. KERAPIAN
            ['nama_pelanggaran' => 'Seragam tidak rapi', 'deskripsi' => 'Pakaian tidak sesuai aturan', 'poin' => 5, 'kategori' => 'III'],
            ['nama_pelanggaran' => 'Seragam ketat/rok pendek', 'deskripsi' => 'Ukuran pakaian tidak sesuai', 'poin' => 5, 'kategori' => 'III'],
            ['nama_pelanggaran' => 'Tidak memakai topi upacara', 'deskripsi' => 'Kelengkapan upacara tidak lengkap', 'poin' => 5, 'kategori' => 'III'],
            ['nama_pelanggaran' => 'Salah memakai seragam', 'deskripsi' => 'Kombinasi seragam salah', 'poin' => 5, 'kategori' => 'III'],
            ['nama_pelanggaran' => 'Tidak memakai ikat pinggang', 'deskripsi' => 'Kelengkapan seragam kurang', 'poin' => 5, 'kategori' => 'III'],
            ['nama_pelanggaran' => 'Sepatu tidak sesuai', 'deskripsi' => 'Alas kaki tidak sesuai aturan', 'poin' => 5, 'kategori' => 'III'],
            ['nama_pelanggaran' => 'Tidak memakai kaos kaki', 'deskripsi' => 'Kelengkapan kaki tidak lengkap', 'poin' => 5, 'kategori' => 'III'],
            ['nama_pelanggaran' => 'Tidak memakai kaos dalam', 'deskripsi' => 'Kelengkapan dalam tidak sesuai', 'poin' => 5, 'kategori' => 'III'],
            ['nama_pelanggaran' => 'Memakai topi non-sekolah', 'deskripsi' => 'Aksesoris tidak sesuai aturan', 'poin' => 10, 'kategori' => 'III'],
            ['nama_pelanggaran' => 'Perhiasan berlebihan (putri)', 'deskripsi' => 'Aksesoris berlebihan', 'poin' => 10, 'kategori' => 'III'],
            ['nama_pelanggaran' => 'Memakai perhiasan (putra)', 'deskripsi' => 'Aksesoris tidak sesuai gender', 'poin' => 10, 'kategori' => 'III'],
            ['nama_pelanggaran' => 'Potongan rambut tidak sesuai', 'deskripsi' => 'Model rambut melanggar aturan', 'poin' => 15, 'kategori' => 'III'],
            ['nama_pelanggaran' => 'Rambut dicat/diwarna', 'deskripsi' => 'Warna rambut tidak natural', 'poin' => 15, 'kategori' => 'III'],
            ['nama_pelanggaran' => 'Bertato', 'deskripsi' => 'Memiliki tato di badan', 'poin' => 100, 'kategori' => 'III'],
            ['nama_pelanggaran' => 'Kuku dicat', 'deskripsi' => 'Pewarnaan kuku tidak sesuai', 'poin' => 20, 'kategori' => 'III'],
        ];

        foreach ($pelanggaran as $item) {
            JenisPelanggaran::create($item);
        }
    }
}