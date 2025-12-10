<?php

namespace App\Observers;

use App\Models\Pelanggaran;
use App\Models\Siswa;

class PelanggaranObserver
{
    /**
     * Handle the Pelanggaran "created" event.
     */
    public function created(Pelanggaran $pelanggaran): void
    {
        $this->updateJumlahPelanggaran($pelanggaran->siswa_id);
    }

    /**
     * Handle the Pelanggaran "updated" event.
     */
    public function updated(Pelanggaran $pelanggaran): void
    {
        $this->updateJumlahPelanggaran($pelanggaran->siswa_id);
    }

    /**
     * Handle the Pelanggaran "deleted" event.
     */
    public function deleted(Pelanggaran $pelanggaran): void
    {
        $this->updateJumlahPelanggaran($pelanggaran->siswa_id);
    }

    /**
     * Update jumlah pelanggaran untuk siswa
     */
    private function updateJumlahPelanggaran($siswaId)
    {
        $siswa = Siswa::find($siswaId);
        if ($siswa) {
            $jumlahPelanggaran = Pelanggaran::where('siswa_id', $siswaId)
                ->whereIn('status', ['diverifikasi', 'menunggu_verifikasi'])
                ->count();
                
            $siswa->update(['jumlah_pelanggaran' => $jumlahPelanggaran]);
        }
    }
}