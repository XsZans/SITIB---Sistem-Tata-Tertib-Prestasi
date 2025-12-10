<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guru;

class GuruSeeder extends Seeder
{
    public function run()
    {
        $guru = [
            // 1. Kepala Sekolah (Paling Atas)
            ['nama' => 'Dr. Hendra Wijaya, M.Pd', 'nip' => '197501012000011001', 'mata_pelajaran' => 'Manajemen Sekolah', 'jabatan' => 'kepala_sekolah', 'wali_kelas' => null],
            
            // 2. Kesiswaan (Nomor 2)
            ['nama' => 'Dra. Sri Mulyani, M.Pd', 'nip' => '197802152001012002', 'mata_pelajaran' => 'Kesiswaan', 'jabatan' => 'kesiswaan', 'wali_kelas' => null],
            
            // 3. Guru BK (3 orang - setelah Kesiswaan)
            ['nama' => 'Drs. Bambang Sutrisno, M.Pd', 'nip' => '198003202002011003', 'mata_pelajaran' => 'Bimbingan Konseling', 'jabatan' => 'guru_bk', 'wali_kelas' => null],
            ['nama' => 'Siti Fatimah, S.Pd', 'nip' => '198204102003012004', 'mata_pelajaran' => 'Bimbingan Konseling', 'jabatan' => 'guru_bk', 'wali_kelas' => null],
            ['nama' => 'Ahmad Syaiful, S.Pd', 'nip' => '198405252004011005', 'mata_pelajaran' => 'Bimbingan Konseling', 'jabatan' => 'guru_bk', 'wali_kelas' => null],
            
            // 4. Wali Kelas - Semua Kelas X (Kelas 10)
            ['nama' => 'Budi Santoso, S.Kom', 'nip' => '198501012020011001', 'mata_pelajaran' => 'Pemrograman Web', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'X PPLG 1'],
            ['nama' => 'Siti Nurhaliza, S.T', 'nip' => '198702152021012002', 'mata_pelajaran' => 'Basis Data', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'X PPLG 2'],
            ['nama' => 'Ahmad Fauzi, S.E', 'nip' => '198903202022011003', 'mata_pelajaran' => 'Akuntansi Dasar', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'X AKT 1'],
            ['nama' => 'Dewi Sartika, S.E', 'nip' => '199004102023012004', 'mata_pelajaran' => 'Perpajakan', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'X AKT 2'],
            ['nama' => 'Rudi Hermawan, S.Kep', 'nip' => '199105252024011005', 'mata_pelajaran' => 'Anatomi Fisiologi', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'X ANM 1'],
            ['nama' => 'Maya Sari, S.Kep', 'nip' => '199206182025012006', 'mata_pelajaran' => 'Keperawatan Dasar', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'X ANM 2'],
            ['nama' => 'Eko Prasetyo, S.Sos', 'nip' => '199307122026011007', 'mata_pelajaran' => 'Pemasaran Digital', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'X PMS 1'],
            ['nama' => 'Rina Wati, S.Sn', 'nip' => '199408052027012008', 'mata_pelajaran' => 'Desain Grafis', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'X DKV 1'],
            
            // 5. Wali Kelas - Semua Kelas XI (Kelas 11)
            ['nama' => 'Agus Setiawan, S.Kom', 'nip' => '199701012030011011', 'mata_pelajaran' => 'Pemrograman Mobile', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'XI PPLG 1'],
            ['nama' => 'Indah Permata, S.T', 'nip' => '199802152031012012', 'mata_pelajaran' => 'Jaringan Komputer', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'XI PPLG 2'],
            ['nama' => 'Hadi Purnomo, S.E', 'nip' => '199903202032011013', 'mata_pelajaran' => 'Akuntansi Keuangan', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'XI AKT 1'],
            ['nama' => 'Ratna Sari, S.E', 'nip' => '200004102033012014', 'mata_pelajaran' => 'Audit', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'XI AKT 2'],
            ['nama' => 'Yudi Pratama, S.Kep', 'nip' => '200105252034011015', 'mata_pelajaran' => 'Keperawatan Medikal', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'XI ANM 1'],
            ['nama' => 'Sari Dewi, S.Kep', 'nip' => '200206182035012016', 'mata_pelajaran' => 'Keperawatan Bedah', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'XI ANM 2'],
            ['nama' => 'Rizki Ananda, S.Sos', 'nip' => '200307122036011017', 'mata_pelajaran' => 'E-Commerce', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'XI PMS 1'],
            ['nama' => 'Dina Kartika, S.Sn', 'nip' => '200408052037012018', 'mata_pelajaran' => 'Animasi 2D', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'XI DKV 1'],
            
            // 6. Wali Kelas - Semua Kelas XII (Kelas 12)
            ['nama' => 'Fajar Nugroho, S.Kom', 'nip' => '200509282038011019', 'mata_pelajaran' => 'Proyek Akhir', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'XII PPLG 1'],
            ['nama' => 'Wulan Dari, S.T', 'nip' => '200610142039012020', 'mata_pelajaran' => 'Sistem Informasi', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'XII PPLG 2'],
            ['nama' => 'Bayu Aji, S.E', 'nip' => '200711252040011021', 'mata_pelajaran' => 'Praktik Kerja Lapangan', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'XII AKT 1'],
            ['nama' => 'Fitri Handayani, S.E', 'nip' => '200812302041012022', 'mata_pelajaran' => 'Kewirausahaan', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'XII AKT 2'],
            ['nama' => 'Andi Wijaya, S.Kep', 'nip' => '200901152042011023', 'mata_pelajaran' => 'Praktik Klinik', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'XII ANM 1'],
            ['nama' => 'Nita Sari, S.Kep', 'nip' => '201002202043012024', 'mata_pelajaran' => 'Manajemen Keperawatan', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'XII ANM 2'],
            ['nama' => 'Dedi Kurniawan, S.Sos', 'nip' => '201103052044011025', 'mata_pelajaran' => 'Strategi Pemasaran', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'XII PMS 1'],
            ['nama' => 'Lia Amelia, S.Sn', 'nip' => '201204102045012026', 'mata_pelajaran' => 'Portfolio Design', 'jabatan' => 'wali_kelas', 'wali_kelas' => 'XII DKV 1'],
            
            // 7. Guru Mata Pelajaran Umum
            ['nama' => 'Doni Setiawan, S.Pd', 'nip' => '199509282028011009', 'mata_pelajaran' => 'Matematika', 'jabatan' => 'guru', 'wali_kelas' => null],
            ['nama' => 'Lina Marlina, S.Pd', 'nip' => '199610142029012010', 'mata_pelajaran' => 'Bahasa Indonesia', 'jabatan' => 'guru', 'wali_kelas' => null],
            ['nama' => 'Tono Supriyanto, S.Pd', 'nip' => '199711192046011027', 'mata_pelajaran' => 'Bahasa Inggris', 'jabatan' => 'guru', 'wali_kelas' => null],
            ['nama' => 'Siska Rahayu, S.Pd', 'nip' => '199812242047012028', 'mata_pelajaran' => 'Pendidikan Agama Islam', 'jabatan' => 'guru', 'wali_kelas' => null],
            ['nama' => 'Joko Widodo, S.Pd', 'nip' => '199901082048011029', 'mata_pelajaran' => 'Pendidikan Pancasila', 'jabatan' => 'guru', 'wali_kelas' => null],
            ['nama' => 'Ani Suryani, S.Pd', 'nip' => '200002132049012030', 'mata_pelajaran' => 'Sejarah Indonesia', 'jabatan' => 'guru', 'wali_kelas' => null],
            
            // 8. Guru Mata Pelajaran Kejuruan Tambahan
            ['nama' => 'Reza Pratama, S.Kom', 'nip' => '200103182050011031', 'mata_pelajaran' => 'Algoritma Pemrograman', 'jabatan' => 'guru', 'wali_kelas' => null],
            ['nama' => 'Sari Indah, S.T', 'nip' => '200204232051012032', 'mata_pelajaran' => 'Sistem Operasi', 'jabatan' => 'guru', 'wali_kelas' => null],
            ['nama' => 'Andi Rahman, S.E', 'nip' => '200305282052011033', 'mata_pelajaran' => 'Ekonomi Bisnis', 'jabatan' => 'guru', 'wali_kelas' => null],
            ['nama' => 'Maya Putri, S.E', 'nip' => '200406122053012034', 'mata_pelajaran' => 'Manajemen Keuangan', 'jabatan' => 'guru', 'wali_kelas' => null],
            ['nama' => 'Budi Hartono, S.Kep', 'nip' => '200507172054011035', 'mata_pelajaran' => 'Farmakologi', 'jabatan' => 'guru', 'wali_kelas' => null],
            ['nama' => 'Dewi Lestari, S.Kep', 'nip' => '200608222055012036', 'mata_pelajaran' => 'Gizi Kesehatan', 'jabatan' => 'guru', 'wali_kelas' => null],
            ['nama' => 'Hendra Wijaya, S.Sos', 'nip' => '200709272056011037', 'mata_pelajaran' => 'Komunikasi Bisnis', 'jabatan' => 'guru', 'wali_kelas' => null],
            ['nama' => 'Rina Sari, S.Sn', 'nip' => '200810012057012038', 'mata_pelajaran' => 'Fotografi Digital', 'jabatan' => 'guru', 'wali_kelas' => null],
            ['nama' => 'Agus Salim, S.Pd', 'nip' => '200911062058011039', 'mata_pelajaran' => 'Fisika Terapan', 'jabatan' => 'guru', 'wali_kelas' => null],
            ['nama' => 'Fitri Handayani, S.Pd', 'nip' => '201012112059012040', 'mata_pelajaran' => 'Kimia Dasar', 'jabatan' => 'guru', 'wali_kelas' => null],
            ['nama' => 'Dedi Kurniawan, S.Pd', 'nip' => '201101162060011041', 'mata_pelajaran' => 'Pendidikan Jasmani', 'jabatan' => 'guru', 'wali_kelas' => null],
            ['nama' => 'Siti Nurjanah, S.Pd', 'nip' => '201202212061012042', 'mata_pelajaran' => 'Seni Budaya', 'jabatan' => 'guru', 'wali_kelas' => null],
        ];

        foreach ($guru as $data) {
            Guru::create($data);
        }
    }
}