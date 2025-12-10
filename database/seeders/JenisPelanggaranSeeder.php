<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisPelanggaran;

class JenisPelanggaranSeeder extends Seeder
{
    public function run(): void
    {
        $pelanggaran = [
            // I. KEPRIBADIAN (Sikap)
            ['nama_pelanggaran' => 'Membuat keributan / kegaduhan dalam kelas pada saat berlangsungnya pelajaran', 'poin' => 10, 'kategori' => 'I', 'deskripsi' => 'Mengganggu proses belajar mengajar'],
            ['nama_pelanggaran' => 'Masuk dan atau keluar lingkungan sekolah tidak melalui gerbang sekolah', 'poin' => 20, 'kategori' => 'I', 'deskripsi' => 'Melanggar aturan keluar masuk sekolah'],
            ['nama_pelanggaran' => 'Berkata tidak jujur, tidak sopan/kasar', 'poin' => 10, 'kategori' => 'I', 'deskripsi' => 'Berbicara tidak sopan atau berbohong'],
            ['nama_pelanggaran' => 'Mengotori (mencorat-coret) barang milik sekolah, guru, karyawan atau teman', 'poin' => 10, 'kategori' => 'I', 'deskripsi' => 'Merusak atau mengotori properti'],
            ['nama_pelanggaran' => 'Merusak atau menghilangkan barang milik sekolah, guru, karyawan atau teman', 'poin' => 50, 'kategori' => 'I', 'deskripsi' => 'Merusak atau menghilangkan barang milik orang lain'],
            ['nama_pelanggaran' => 'Mengambil (mencuri) barang milik sekolah, guru, karyawan atau teman', 'poin' => 50, 'kategori' => 'I', 'deskripsi' => 'Tindakan pencurian'],
            ['nama_pelanggaran' => 'Makan dan minum di dalam kelas saat berlangsungnya pelajaran', 'poin' => 5, 'kategori' => 'I', 'deskripsi' => 'Makan minum saat pelajaran berlangsung'],
            ['nama_pelanggaran' => 'Mengaktifkan alat komunikasi didalam kelas pada saat pelajaran berlangsung', 'poin' => 5, 'kategori' => 'I', 'deskripsi' => 'Menggunakan HP saat pelajaran'],
            ['nama_pelanggaran' => 'Membuang sampah tidak pada tempatnya', 'poin' => 5, 'kategori' => 'I', 'deskripsi' => 'Membuang sampah sembarangan'],
            ['nama_pelanggaran' => 'Membawa teman selain siswa SMK BN maupun dengan siswa sekolah lain atau pihak lain', 'poin' => 10, 'kategori' => 'I', 'deskripsi' => 'Membawa orang luar ke sekolah'],
            ['nama_pelanggaran' => 'Membawa benda yang tidak ada kaitannya dengan proses belajar mengajar', 'poin' => 5, 'kategori' => 'I', 'deskripsi' => 'Membawa barang tidak relevan'],
            ['nama_pelanggaran' => 'Bertengkar / bertentangan dengan teman di lingkungan sekolah', 'poin' => 15, 'kategori' => 'I', 'deskripsi' => 'Berkelahi dengan teman'],
            ['nama_pelanggaran' => 'Memalsu tandatangan guru, walikelas, kepala sekolah', 'poin' => 40, 'kategori' => 'I', 'deskripsi' => 'Memalsukan tanda tangan'],
            ['nama_pelanggaran' => 'Menggunakan/menggelapkan SPP dari orang tua', 'poin' => 40, 'kategori' => 'I', 'deskripsi' => 'Menggelapkan uang SPP'],
            ['nama_pelanggaran' => 'Membentuk organisasi selain OSIS maupun kegiatan lainnya tanpa seijin Kepala Sekolah', 'poin' => 15, 'kategori' => 'I', 'deskripsi' => 'Membentuk organisasi tanpa izin'],
            ['nama_pelanggaran' => 'Menyalahgunakan Uang SPP', 'poin' => 40, 'kategori' => 'I', 'deskripsi' => 'Menyalahgunakan uang sekolah'],
            ['nama_pelanggaran' => 'Berbuat asusila', 'poin' => 50, 'kategori' => 'I', 'deskripsi' => 'Melakukan perbuatan asusila'],
            ['nama_pelanggaran' => 'Membawa rokok', 'poin' => 25, 'kategori' => 'I', 'deskripsi' => 'Membawa rokok ke sekolah'],
            ['nama_pelanggaran' => 'Merokok / menghisap rokok di sekolah', 'poin' => 40, 'kategori' => 'I', 'deskripsi' => 'Merokok di lingkungan sekolah'],
            ['nama_pelanggaran' => 'Merokok / menghisap rokok di luar sekolah memakai seragam sekolah', 'poin' => 40, 'kategori' => 'I', 'deskripsi' => 'Merokok dengan seragam sekolah'],
            ['nama_pelanggaran' => 'Membawa buku, majalah, kaset terlarang atau HP berisi gambar dan film porno', 'poin' => 75, 'kategori' => 'I', 'deskripsi' => 'Membawa konten pornografi'],
            ['nama_pelanggaran' => 'Memperjual belikan buku, majalah atau kaset terlarang', 'poin' => 75, 'kategori' => 'I', 'deskripsi' => 'Menjual konten terlarang'],
            ['nama_pelanggaran' => 'Membawa senjata tajam tanpa ijin', 'poin' => 40, 'kategori' => 'I', 'deskripsi' => 'Membawa senjata tajam'],
            ['nama_pelanggaran' => 'Memperjual belikan senjata tajam di sekolah', 'poin' => 75, 'kategori' => 'I', 'deskripsi' => 'Menjual senjata tajam'],
            ['nama_pelanggaran' => 'Menggunakan senjata tajam untuk mengancam', 'poin' => 75, 'kategori' => 'I', 'deskripsi' => 'Mengancam dengan senjata'],
            ['nama_pelanggaran' => 'Menggunakan senjata tajam untuk melukai', 'poin' => 75, 'kategori' => 'I', 'deskripsi' => 'Melukai dengan senjata'],
            ['nama_pelanggaran' => 'Membawa obat terlarang / minuman terlarang', 'poin' => 75, 'kategori' => 'I', 'deskripsi' => 'Membawa narkoba/minuman keras'],
            ['nama_pelanggaran' => 'Menggunakan obat / minuman terlarang di dalam lingkungan sekolah', 'poin' => 100, 'kategori' => 'I', 'deskripsi' => 'Menggunakan narkoba di sekolah'],
            ['nama_pelanggaran' => 'Memperjual belikan obat / minuman terlarang di dalam / di luar sekolah', 'poin' => 100, 'kategori' => 'I', 'deskripsi' => 'Mengedarkan narkoba'],
            ['nama_pelanggaran' => 'Perkelahian disebabkan oleh siswa di dalam sekolah (Intern)', 'poin' => 75, 'kategori' => 'I', 'deskripsi' => 'Berkelahi antar siswa internal'],
            ['nama_pelanggaran' => 'Perkelahian disebabkan oleh sekolah lain', 'poin' => 100, 'kategori' => 'I', 'deskripsi' => 'Berkelahi dengan sekolah lain'],
            ['nama_pelanggaran' => 'Perkelahian antar siswa SMK BN 666', 'poin' => 75, 'kategori' => 'I', 'deskripsi' => 'Berkelahi sesama siswa SMK BN'],
            ['nama_pelanggaran' => 'Pelanggaran terhadap Kepala Sekolah, Guru dan Karyawan disertai ancaman', 'poin' => 75, 'kategori' => 'I', 'deskripsi' => 'Mengancam guru/karyawan'],
            ['nama_pelanggaran' => 'Pelanggaran terhadap Kepala Sekolah, Guru dan Karyawan disertai pemukulan', 'poin' => 100, 'kategori' => 'I', 'deskripsi' => 'Memukul guru/karyawan'],

            // II. KERAJINAN
            ['nama_pelanggaran' => 'Terlambat masuk sekolah lebih dari 15 menit (satu kali)', 'poin' => 2, 'kategori' => 'II', 'deskripsi' => 'Keterlambatan pertama'],
            ['nama_pelanggaran' => 'Terlambat masuk sekolah lebih dari 15 menit (dua kali)', 'poin' => 3, 'kategori' => 'II', 'deskripsi' => 'Keterlambatan kedua'],
            ['nama_pelanggaran' => 'Terlambat masuk sekolah lebih dari 15 menit (tiga kali dan selebihnya)', 'poin' => 5, 'kategori' => 'II', 'deskripsi' => 'Keterlambatan berulang'],
            ['nama_pelanggaran' => 'Terlambat masuk karena izin', 'poin' => 2, 'kategori' => 'II', 'deskripsi' => 'Terlambat dengan izin'],
            ['nama_pelanggaran' => 'Terlambat masuk karena diberi tugas guru', 'poin' => 0, 'kategori' => 'II', 'deskripsi' => 'Terlambat karena tugas'],
            ['nama_pelanggaran' => 'Terlambat masuk karena alasan yang dibuat-buat', 'poin' => 5, 'kategori' => 'II', 'deskripsi' => 'Terlambat dengan alasan palsu'],
            ['nama_pelanggaran' => 'Izin keluar saat proses belajar berlangsung dan tidak kembali', 'poin' => 25, 'kategori' => 'II', 'deskripsi' => 'Keluar dan tidak kembali'],
            ['nama_pelanggaran' => 'Pulang tanpa izin', 'poin' => 10, 'kategori' => 'II', 'deskripsi' => 'Pulang tanpa permisi'],
            ['nama_pelanggaran' => 'Tidak masuk karena sakit tanpa keterangan (surat)', 'poin' => 2, 'kategori' => 'II', 'deskripsi' => 'Sakit tanpa surat'],
            ['nama_pelanggaran' => 'Tidak masuk karena izin tanpa keterangan (surat)', 'poin' => 2, 'kategori' => 'II', 'deskripsi' => 'Izin tanpa surat'],
            ['nama_pelanggaran' => 'Tidak masuk karena alpa', 'poin' => 5, 'kategori' => 'II', 'deskripsi' => 'Tidak masuk tanpa keterangan'],
            ['nama_pelanggaran' => 'Tidak mengikuti kegiatan belajar (membolos)', 'poin' => 5, 'kategori' => 'II', 'deskripsi' => 'Membolos pelajaran'],
            ['nama_pelanggaran' => 'Tidak masuk dengan membuat keterangan (surat) palsu', 'poin' => 10, 'kategori' => 'II', 'deskripsi' => 'Surat keterangan palsu'],
            ['nama_pelanggaran' => 'Keluar kelas saat proses belajar mengajar berlangsung tanpa izin', 'poin' => 5, 'kategori' => 'II', 'deskripsi' => 'Keluar kelas tanpa izin'],

            // III. KERAPIAN
            ['nama_pelanggaran' => 'Memakai seragam tidak rapi / tidak dimasukkan', 'poin' => 5, 'kategori' => 'III', 'deskripsi' => 'Seragam tidak rapi'],
            ['nama_pelanggaran' => 'Siswa putri memakai seragam yang ketat / rok pendek', 'poin' => 5, 'kategori' => 'III', 'deskripsi' => 'Seragam tidak sesuai aturan'],
            ['nama_pelanggaran' => 'Tidak memakai perlengkapan upacara bendera (topi)', 'poin' => 5, 'kategori' => 'III', 'deskripsi' => 'Tidak lengkap saat upacara'],
            ['nama_pelanggaran' => 'Salah memakai baju, rok atau celana', 'poin' => 5, 'kategori' => 'III', 'deskripsi' => 'Salah pakai seragam'],
            ['nama_pelanggaran' => 'Salah atau tidak memakai ikat pinggang', 'poin' => 5, 'kategori' => 'III', 'deskripsi' => 'Ikat pinggang tidak sesuai'],
            ['nama_pelanggaran' => 'Memakai sepatu (tidak sesuai ketentuan)', 'poin' => 5, 'kategori' => 'III', 'deskripsi' => 'Sepatu tidak sesuai aturan'],
            ['nama_pelanggaran' => 'Tidak memakai kaos kaki', 'poin' => 5, 'kategori' => 'III', 'deskripsi' => 'Tidak memakai kaos kaki'],
            ['nama_pelanggaran' => 'Salah / tidak memakai kaos dalam', 'poin' => 5, 'kategori' => 'III', 'deskripsi' => 'Kaos dalam tidak sesuai'],
            ['nama_pelanggaran' => 'Memakai topi yang bukan topi sekolah di lingkungan sekolah', 'poin' => 10, 'kategori' => 'III', 'deskripsi' => 'Topi tidak sesuai aturan'],
            ['nama_pelanggaran' => 'Siswa putri memakai perhiasan berlebihan', 'poin' => 10, 'kategori' => 'III', 'deskripsi' => 'Perhiasan berlebihan'],
            ['nama_pelanggaran' => 'Siswa putra memakai perhiasan atau aksesoris (kalung, gelang, dll)', 'poin' => 10, 'kategori' => 'III', 'deskripsi' => 'Siswa putra memakai aksesoris'],
            ['nama_pelanggaran' => 'Potongan rambut putra tidak sesuai dengan ketentuan sekolah', 'poin' => 15, 'kategori' => 'III', 'deskripsi' => 'Rambut tidak sesuai aturan'],
            ['nama_pelanggaran' => 'Rambut dicat / diwarna-warni (putra-putri)', 'poin' => 15, 'kategori' => 'III', 'deskripsi' => 'Rambut diwarnai'],
            ['nama_pelanggaran' => 'Bertato', 'poin' => 100, 'kategori' => 'III', 'deskripsi' => 'Memiliki tato'],
            ['nama_pelanggaran' => 'Kuku dicat', 'poin' => 20, 'kategori' => 'III', 'deskripsi' => 'Kuku dicat/dihias']
        ];

        foreach ($pelanggaran as $item) {
            JenisPelanggaran::create($item);
        }
    }
}