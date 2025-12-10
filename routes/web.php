<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.index');
            case 'kesiswaan':
                return redirect()->route('kesiswaan.index');
            case 'kepala_sekolah':
                return redirect()->route('kepsek.index');
            case 'wali_kelas':
                return redirect()->route('wali_kelas.index');
            case 'guru':
                return redirect()->route('guru.index');
            case 'bk':
                return redirect()->route('bk.index');
            case 'siswa':
                return redirect()->route('siswa.index');
            case 'orang_tua':
                return redirect()->route('orang_tua.dashboard');
            default:
                return view('welcome');
        }
    }
    return view('welcome');
});

// Custom Auth Routes
Route::get('/custom-login', [AuthController::class, 'showLogin'])->name('custom.login');
Route::post('/custom-login', [AuthController::class, 'login'])->name('custom.login.post');
Route::get('/custom-logout', [AuthController::class, 'logout'])->name('custom.logout');

// Public API routes for registration
Route::get('/api/get-guru-without-account', [AdminController::class, 'getGuruWithoutAccount']);
Route::get('/api/get-wali-kelas-without-account', [AdminController::class, 'getWaliKelasWithoutAccount']);
Route::get('/api/get-siswa-without-account', [AdminController::class, 'getSiswaWithoutAccount']);
Route::get('/api/get-siswa-with-account', [AdminController::class, 'getSiswaWithAccount']);
Route::get('/api/check-single-role-accounts', [AdminController::class, 'checkSingleRoleAccounts']);
Route::get('/api/check-username/{username}', [AdminController::class, 'checkUsername']);

// Admin Routes
Route::middleware(['custom.auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/siswa', [AdminController::class, 'siswa'])->name('admin.siswa');
    Route::get('/admin/load-more-siswa', [AdminController::class, 'loadMoreSiswa'])->name('admin.load-more-siswa');
    Route::post('/admin/kelola-siswa', [AdminController::class, 'kelolaSiswa'])->name('admin.kelola-siswa');
    Route::get('/admin/pelanggaran', [AdminController::class, 'pelanggaran'])->name('admin.pelanggaran');
    Route::get('/admin/prestasi', [AdminController::class, 'prestasi'])->name('admin.prestasi');
    Route::get('/admin/sanksi', [AdminController::class, 'sanksi'])->name('admin.sanksi');
    Route::post('/admin/proses-sanksi', [AdminController::class, 'prosesSanksi'])->name('admin.proses-sanksi');
    Route::get('/admin/get-jenis-pelanggaran', [AdminController::class, 'getJenisPelanggaran'])->name('admin.get-jenis-pelanggaran');
    Route::get('/admin/get-siswa', [AdminController::class, 'getSiswa'])->name('admin.get-siswa');
    Route::get('/admin/siswa/{siswa}/pelanggaran', [AdminController::class, 'getSiswaPelanggaran'])->name('admin.siswa.pelanggaran');
    Route::get('/admin/grafik-pelanggaran', [AdminController::class, 'grafikPelanggaran'])->name('admin.grafik-pelanggaran');
    Route::get('/admin/grafik-prestasi', [AdminController::class, 'grafikPrestasi'])->name('admin.grafik-prestasi');
    Route::get('/admin/detail-pelanggaran', [AdminController::class, 'detailPelanggaran'])->name('admin.detail-pelanggaran');
    Route::post('/admin/tambah-pelanggaran', [AdminController::class, 'tambahPelanggaran'])->name('admin.tambah-pelanggaran');
    Route::post('/admin/hapus-pelanggaran', [AdminController::class, 'hapusPelanggaran'])->name('admin.hapus-pelanggaran');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
    Route::post('/admin/verifikasi-laporan', [AdminController::class, 'verifikasiLaporan'])->name('admin.verifikasi-laporan');
    Route::get('/admin/guru', [AdminController::class, 'guru'])->name('admin.guru');
    Route::get('/admin/guru/{id}', [AdminController::class, 'showGuru'])->name('admin.guru.show');
    Route::delete('/admin/guru/{id}', [AdminController::class, 'deleteGuru'])->name('admin.guru.delete');
    Route::get('/admin/load-more-guru', [AdminController::class, 'loadMoreGuru'])->name('admin.load-more-guru');
    Route::get('/admin/search-guru', [AdminController::class, 'searchGuru'])->name('admin.search-guru');
    Route::get('/admin/filter-siswa-prestasi', [AdminController::class, 'filterSiswaPrestasi'])->name('admin.filter-siswa-prestasi');
    Route::post('/admin/create-guru-user', [AdminController::class, 'createGuruUser'])->name('admin.create-guru-user');
    Route::post('/admin/create-siswa-user', [AdminController::class, 'createSiswaUser'])->name('admin.create-siswa-user');
Route::get('/admin/pelaksanaan-sanksi', [AdminController::class, 'pelaksanaanSanksi'])->name('admin.pelaksanaan-sanksi');
Route::post('/admin/selesai-sanksi', [AdminController::class, 'selesaiSanksi'])->name('admin.selesai-sanksi');
Route::get('/admin/get-pelaksanaan-sanksi-data', [AdminController::class, 'getPelaksanaanSanksiData'])->name('admin.get-pelaksanaan-sanksi-data');
Route::get('/admin/get-prestasi-verifikasi', [AdminController::class, 'getPrestasiVerifikasi'])->name('admin.get-prestasi-verifikasi');
Route::get('/admin/get-prestasi-selesai', [AdminController::class, 'getPrestasiSelesai'])->name('admin.get-prestasi-selesai');
Route::get('/admin/get-tidak-terverifikasi', [AdminController::class, 'getTidakTerverifikasi'])->name('admin.get-tidak-terverifikasi');
Route::get('/admin/selesai', [AdminController::class, 'selesai'])->name('admin.selesai');




    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/admin/export-pelanggaran', [AdminController::class, 'exportPelanggaran'])->name('admin.export-pelanggaran');
    Route::get('/admin/get-guru-without-account', [AdminController::class, 'getGuruWithoutAccount'])->name('admin.get-guru-without-account');
    Route::get('/admin/get-wali-kelas-without-account', [AdminController::class, 'getWaliKelasWithoutAccount'])->name('admin.get-wali-kelas-without-account');
    Route::get('/admin/get-siswa-without-account', [AdminController::class, 'getSiswaWithoutAccount'])->name('admin.get-siswa-without-account');
    Route::get('/admin/get-siswa-with-account', [AdminController::class, 'getSiswaWithAccount'])->name('admin.get-siswa-with-account');
    Route::get('/admin/check-single-role-accounts', [AdminController::class, 'checkSingleRoleAccounts'])->name('admin.check-single-role-accounts');
    Route::get('/admin/verifikasi-user', [AdminController::class, 'verifikasiUser'])->name('admin.verifikasi-user');
    Route::post('/admin/approve-user', [AdminController::class, 'approveUser'])->name('admin.approve-user');
    Route::post('/admin/reject-user', [AdminController::class, 'rejectUser'])->name('admin.reject-user');
    Route::get('/admin/backup', [AdminController::class, 'backup'])->name('admin.backup');
    Route::get('/admin/download-backup', [AdminController::class, 'downloadBackup'])->name('admin.download-backup');
    Route::post('/admin/update-backup-settings', [AdminController::class, 'updateBackupSettings'])->name('admin.update-backup-settings');
    Route::get('/admin/get-backup-history', [AdminController::class, 'getBackupHistory'])->name('admin.get-backup-history');
    Route::get('/admin/download-backup-file/{filename}', [AdminController::class, 'downloadBackupFile'])->name('admin.download-backup-file');
    Route::post('/admin/delete-backup', [AdminController::class, 'deleteBackup'])->name('admin.delete-backup');
    Route::get('/admin/verifikasi-laporan-request', [AdminController::class, 'verifikasiLaporanRequest'])->name('admin.verifikasi-laporan-request');
    Route::post('/admin/approve-laporan/{id}', [AdminController::class, 'approveLaporan'])->name('admin.approve-laporan');
    Route::post('/admin/reject-laporan/{id}', [AdminController::class, 'rejectLaporan'])->name('admin.reject-laporan');
    Route::get('/admin/input-bk', [AdminController::class, 'inputBk'])->name('admin.input-bk');
    Route::post('/admin/store-bk', [AdminController::class, 'storeBk'])->name('admin.store-bk');

    Route::get('/admin/export-prestasi', [AdminController::class, 'exportPrestasi'])->name('admin.export-prestasi');
    Route::post('/admin/tambah-prestasi', [AdminController::class, 'tambahPrestasi'])->name('admin.tambah-prestasi');
    Route::get('/kesiswaan/export-prestasi', [AdminController::class, 'exportPrestasi'])->name('kesiswaan.export-prestasi');
    Route::post('/kesiswaan/tambah-prestasi', [AdminController::class, 'tambahPrestasi'])->name('kesiswaan.tambah-prestasi');
    Route::get('/admin/orang-tua', [AdminController::class, 'orangTua'])->name('admin.orang-tua');
    Route::post('/admin/kelola-orang-tua', [AdminController::class, 'kelolaOrangTua'])->name('admin.kelola-orang-tua');
    Route::get('/admin/get-orang-tua/{siswa}', [AdminController::class, 'getOrangTua'])->name('admin.get-orang-tua');
});

// Kepala Sekolah Routes
Route::middleware(['custom.auth'])->group(function () {
    Route::get('/kepsek', [\App\Http\Controllers\KepsekController::class, 'index'])->name('kepsek.index');
    Route::get('/kepsek/siswa', [AdminController::class, 'siswa'])->name('kepsek.siswa');
    Route::get('/kepsek/load-more-siswa', [AdminController::class, 'loadMoreSiswa'])->name('kepsek.load-more-siswa');
    Route::get('/kepsek/siswa/{siswa}/pelanggaran', [AdminController::class, 'getSiswaPelanggaran'])->name('kepsek.siswa.pelanggaran');
});

// Kesiswaan Routes
Route::middleware(['custom.auth'])->group(function () {
    Route::get('/kesiswaan', [\App\Http\Controllers\KesiswaanController::class, 'index'])->name('kesiswaan.index');
    Route::get('/kesiswaan/siswa', [AdminController::class, 'siswa'])->name('kesiswaan.siswa');
    Route::get('/kesiswaan/pelanggaran', [AdminController::class, 'pelanggaran'])->name('kesiswaan.pelanggaran');
    Route::get('/kesiswaan/prestasi', [AdminController::class, 'prestasi'])->name('kesiswaan.prestasi');
    Route::get('/kesiswaan/sanksi', [AdminController::class, 'sanksi'])->name('kesiswaan.sanksi');
    Route::get('/kesiswaan/laporan', [AdminController::class, 'laporan'])->name('kesiswaan.laporan');
    Route::get('/kesiswaan/guru', [AdminController::class, 'guru'])->name('kesiswaan.guru');
    Route::get('/kesiswaan/pelaksanaan-sanksi', [AdminController::class, 'pelaksanaanSanksi'])->name('kesiswaan.pelaksanaan-sanksi');
    Route::get('/kesiswaan/load-more-siswa', [AdminController::class, 'loadMoreSiswa'])->name('kesiswaan.load-more-siswa');
    Route::post('/kesiswaan/kelola-siswa', [AdminController::class, 'kelolaSiswa'])->name('kesiswaan.kelola-siswa');
    Route::get('/kesiswaan/load-more-guru', [AdminController::class, 'loadMoreGuru'])->name('kesiswaan.load-more-guru');
    Route::get('/kesiswaan/search-guru', [AdminController::class, 'searchGuru'])->name('kesiswaan.search-guru');
    Route::get('/kesiswaan/guru/{id}', [AdminController::class, 'showGuru'])->name('kesiswaan.guru.show');
    Route::get('/kesiswaan/siswa/{siswa}/pelanggaran', [AdminController::class, 'getSiswaPelanggaran'])->name('kesiswaan.siswa.pelanggaran');
    Route::get('/kesiswaan/grafik-prestasi', [AdminController::class, 'grafikPrestasi'])->name('kesiswaan.grafik-prestasi');
    Route::get('/kesiswaan/filter-siswa-prestasi', [AdminController::class, 'filterSiswaPrestasi'])->name('kesiswaan.filter-siswa-prestasi');
    Route::get('/kesiswaan/orang-tua', [AdminController::class, 'orangTua'])->name('kesiswaan.orang-tua');
    Route::post('/kesiswaan/kelola-orang-tua', [AdminController::class, 'kelolaOrangTua'])->name('kesiswaan.kelola-orang-tua');
    Route::get('/kesiswaan/get-orang-tua/{siswa}', [AdminController::class, 'getOrangTua'])->name('kesiswaan.get-orang-tua');
    Route::post('/kesiswaan/verifikasi-laporan', [AdminController::class, 'verifikasiLaporan'])->name('kesiswaan.verifikasi-laporan');
    Route::post('/kesiswaan/tambah-pelanggaran', [AdminController::class, 'tambahPelanggaran'])->name('kesiswaan.tambah-pelanggaran');
    Route::post('/kesiswaan/proses-sanksi', [AdminController::class, 'prosesSanksi'])->name('kesiswaan.proses-sanksi');
    Route::post('/kesiswaan/hapus-pelanggaran', [AdminController::class, 'hapusPelanggaran'])->name('kesiswaan.hapus-pelanggaran');

    Route::post('/kesiswaan/selesai-sanksi', [AdminController::class, 'selesaiSanksi'])->name('kesiswaan.selesai-sanksi');
    Route::get('/kesiswaan/grafik-pelanggaran', [AdminController::class, 'grafikPelanggaran'])->name('kesiswaan.grafik-pelanggaran');
    Route::get('/kesiswaan/detail-pelanggaran', [AdminController::class, 'detailPelanggaran'])->name('kesiswaan.detail-pelanggaran');
    Route::get('/kesiswaan/get-jenis-pelanggaran', [AdminController::class, 'getJenisPelanggaran'])->name('kesiswaan.get-jenis-pelanggaran');
    Route::get('/kesiswaan/get-siswa', [AdminController::class, 'getSiswa'])->name('kesiswaan.get-siswa');
    Route::get('/kesiswaan/get-pelaksanaan-sanksi-data', [AdminController::class, 'getPelaksanaanSanksiData'])->name('kesiswaan.get-pelaksanaan-sanksi-data');
    Route::get('/kesiswaan/get-prestasi-verifikasi', [AdminController::class, 'getPrestasiVerifikasi'])->name('kesiswaan.get-prestasi-verifikasi');
    Route::get('/kesiswaan/get-prestasi-selesai', [AdminController::class, 'getPrestasiSelesai'])->name('kesiswaan.get-prestasi-selesai');
    Route::get('/kesiswaan/get-tidak-terverifikasi', [AdminController::class, 'getTidakTerverifikasi'])->name('kesiswaan.get-tidak-terverifikasi');
    Route::get('/kesiswaan/export-pelanggaran', [AdminController::class, 'exportPelanggaran'])->name('kesiswaan.export-pelanggaran');
    Route::get('/kesiswaan/get-tidak-terverifikasi', [AdminController::class, 'getTidakTerverifikasi'])->name('kesiswaan.get-tidak-terverifikasi');
    Route::get('/kesiswaan/selesai', [AdminController::class, 'selesai'])->name('kesiswaan.selesai');
    Route::get('/kesiswaan/verifikasi-laporan-request', [AdminController::class, 'verifikasiLaporanRequest'])->name('kesiswaan.verifikasi-laporan-request');
    Route::post('/kesiswaan/approve-laporan/{id}', [AdminController::class, 'approveLaporan'])->name('kesiswaan.approve-laporan');
    Route::post('/kesiswaan/reject-laporan/{id}', [AdminController::class, 'rejectLaporan'])->name('kesiswaan.reject-laporan');

});

// Siswa Routes
Route::middleware(['custom.auth'])->group(function () {
    Route::get('/siswa', [SiswaController::class, 'dashboard'])->name('siswa.index');
    Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/siswa/pelanggaran', [SiswaController::class, 'pelanggaran'])->name('siswa.pelanggaran');
    Route::get('/siswa/prestasi', [SiswaController::class, 'prestasi'])->name('siswa.prestasi');
    Route::get('/siswa/profile', [SiswaController::class, 'profile'])->name('siswa.profile');
    Route::get('/siswa/export-laporan', [SiswaController::class, 'exportLaporan'])->name('siswa.export-laporan');
    Route::get('/siswa/export-bk', [SiswaController::class, 'exportBk'])->name('siswa.export-bk');
    Route::get('/siswa/bk', [SiswaController::class, 'bk'])->name('siswa.bk');
    Route::post('/siswa/bk/respon/{id}', [SiswaController::class, 'responBk'])->name('siswa.respon-bk');
    Route::post('/siswa/ajukan-bimbingan', [SiswaController::class, 'ajukanBimbingan'])->name('siswa.ajukan-bimbingan');
    Route::post('/siswa/bk/notification/{id}/read', [SiswaController::class, 'markBkNotificationRead'])->name('siswa.bk.notification.read');
    Route::get('/siswa/export-bk', [SiswaController::class, 'exportBk'])->name('siswa.export-bk');
});

// Wali Kelas Routes
Route::middleware(['custom.auth'])->group(function () {
    Route::get('/wali-kelas', [\App\Http\Controllers\WaliKelasController::class, 'index'])->name('wali_kelas.index');
    Route::get('/wali-kelas/siswa', [\App\Http\Controllers\WaliKelasController::class, 'siswa'])->name('wali_kelas.siswa');
    Route::get('/wali-kelas/profile', [\App\Http\Controllers\WaliKelasController::class, 'profile'])->name('wali_kelas.profile');
    Route::get('/wali-kelas/export-laporan', [\App\Http\Controllers\WaliKelasController::class, 'exportLaporan'])->name('wali_kelas.export-laporan');
    Route::get('/wali-kelas/export-laporan-kelas', [\App\Http\Controllers\WaliKelasController::class, 'exportLaporanKelas'])->name('wali_kelas.export-laporan-kelas');
    Route::post('/wali-kelas/store-pelanggaran', [\App\Http\Controllers\WaliKelasController::class, 'storePelanggaran'])->name('wali_kelas.store-pelanggaran');
    Route::get('/wali-kelas/get-jenis-pelanggaran', [\App\Http\Controllers\WaliKelasController::class, 'getJenisPelanggaran'])->name('wali_kelas.get-jenis-pelanggaran');
    Route::get('/wali-kelas/laporan-tersimpan', [\App\Http\Controllers\WaliKelasController::class, 'laporanTersimpan'])->name('wali_kelas.laporan-tersimpan');
    Route::get('/wali-kelas/download-laporan/{filename}', [\App\Http\Controllers\WaliKelasController::class, 'downloadLaporan'])->name('wali_kelas.download-laporan');
});

// Guru Routes
Route::middleware(['custom.auth'])->group(function () {
    Route::get('/guru', [\App\Http\Controllers\GuruController::class, 'index'])->name('guru.index');
    Route::get('/guru/profile', [\App\Http\Controllers\GuruController::class, 'profile'])->name('guru.profile');
    Route::get('/guru/export-laporan', [\App\Http\Controllers\GuruController::class, 'exportLaporan'])->name('guru.export-laporan');
    Route::post('/guru/input-pelanggaran', [\App\Http\Controllers\GuruController::class, 'inputPelanggaran'])->name('guru.input-pelanggaran');
    Route::get('/guru/jenis-pelanggaran/{kategori_id}', [\App\Http\Controllers\GuruController::class, 'getJenisPelanggaran'])->name('guru.jenis-pelanggaran');
    Route::get('/guru/laporan', [\App\Http\Controllers\GuruController::class, 'laporan'])->name('guru.laporan');
    Route::post('/guru/request-laporan', [\App\Http\Controllers\GuruController::class, 'requestLaporan'])->name('guru.request-laporan');
    Route::get('/guru/download-laporan/{id}', [\App\Http\Controllers\GuruController::class, 'downloadLaporan'])->name('guru.download-laporan');
    Route::get('/guru/storage', [\App\Http\Controllers\GuruController::class, 'storage'])->name('guru.storage');
    Route::get('/guru/storage/download/{id}', [\App\Http\Controllers\GuruController::class, 'autoDownloadReport'])->name('guru.storage.download');
});

// Orang Tua Routes
Route::middleware(['custom.auth'])->group(function () {
    Route::get('/orang-tua', [\App\Http\Controllers\OrangTuaController::class, 'index'])->name('orang_tua.dashboard');
    Route::get('/orang-tua/pelanggaran', [\App\Http\Controllers\OrangTuaController::class, 'pelanggaran'])->name('orang_tua.pelanggaran');
    Route::get('/orang-tua/prestasi', [\App\Http\Controllers\OrangTuaController::class, 'prestasi'])->name('orang_tua.prestasi');
    Route::get('/orang-tua/selesai', [\App\Http\Controllers\OrangTuaController::class, 'selesai'])->name('orang_tua.selesai');
    Route::get('/orang-tua/export-laporan', [\App\Http\Controllers\OrangTuaController::class, 'exportLaporan'])->name('orang_tua.export-laporan');
});

Route::get('/dashboard', function () {
    if (Auth::check()) {
        $user = Auth::user();
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.index');
            case 'kesiswaan':
                return redirect()->route('kesiswaan.index');
            case 'kepala_sekolah':
                return redirect()->route('kepsek.index');
            case 'wali_kelas':
                return redirect()->route('wali_kelas.index');
            case 'guru':
                return redirect()->route('guru.index');
            case 'bk':
                return redirect()->route('bk.index');
            case 'siswa':
                return redirect()->route('siswa.index');
            case 'orang_tua':
                return redirect()->route('orang_tua.dashboard');
            default:
                return redirect()->route('login');
        }
    }
    return redirect()->route('login');
})->middleware(['custom.auth', 'verified'])->name('dashboard');

Route::middleware('custom.auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// BK Routes
Route::middleware(['custom.auth'])->group(function () {
    Route::get('/bk', [\App\Http\Controllers\BkController::class, 'index'])->name('bk.index');
    Route::get('/bk/input', [\App\Http\Controllers\BkController::class, 'inputBk'])->name('bk.input');
    Route::post('/bk/store', [\App\Http\Controllers\BkController::class, 'storeBk'])->name('bk.store');
    Route::get('/bk/notifications', [\App\Http\Controllers\BkController::class, 'notifications'])->name('bk.notifications');
    Route::get('/bk/pengajuan', [\App\Http\Controllers\BkController::class, 'getPengajuan'])->name('bk.pengajuan');
    Route::post('/bk/confirm/{id}', [\App\Http\Controllers\BkController::class, 'confirmSession'])->name('bk.confirm');
    Route::post('/bk/complete/{id}', [\App\Http\Controllers\BkController::class, 'completeSession'])->name('bk.complete');
    Route::post('/bk/reject/{id}', [\App\Http\Controllers\BkController::class, 'rejectSession'])->name('bk.reject');
    Route::post('/bk/approve-pengajuan/{id}', [\App\Http\Controllers\BkController::class, 'approvePengajuan'])->name('bk.approve-pengajuan');
    Route::post('/bk/reject-pengajuan/{id}', [\App\Http\Controllers\BkController::class, 'rejectPengajuan'])->name('bk.reject-pengajuan');
    Route::get('/bk/export-laporan', [\App\Http\Controllers\BkController::class, 'exportLaporan'])->name('bk.export-laporan');
    Route::post('/bk/notification/{id}/read', [\App\Http\Controllers\BkController::class, 'markNotificationRead'])->name('bk.notification.read');
    Route::get('/bk/get-siswa', [\App\Http\Controllers\BkController::class, 'getSiswa'])->name('bk.get-siswa');
    Route::get('/bk/riwayat', [\App\Http\Controllers\BkController::class, 'riwayat'])->name('bk.riwayat');
});

require __DIR__.'/auth.php';
