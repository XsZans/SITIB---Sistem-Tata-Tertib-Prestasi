<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\OrangTua;
use App\Models\Pelanggaran;
use App\Models\PrestasiSiswa;
use Barryvdh\DomPDF\Facade\Pdf;

class OrangTuaController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $siswa = Siswa::where('orang_tua_user_id', $user->id)->first();
        $orangTua = null;
        $pelanggaranCount = 0;
        $prestasiCount = 0;
        $pelanggaranSelesai = 0;
        $prestasiSelesai = 0;

        if ($siswa) {
            $orangTua = OrangTua::where('siswa_id', $siswa->id)->first();
            $pelanggaranCount = Pelanggaran::where('siswa_id', $siswa->id)->where('status', '!=', 'ditolak')->count();
            $prestasiCount = PrestasiSiswa::where('siswa_id', $siswa->id)->where('status', '!=', 'ditolak')->count();
            $pelanggaranSelesai = Pelanggaran::where('siswa_id', $siswa->id)->where('status', 'selesai')->whereNotNull('verifikator_id')->count();
            $prestasiSelesai = PrestasiSiswa::where('siswa_id', $siswa->id)->where('status', 'diverifikasi')->whereNotNull('verifikator_id')->count();
        }

        return view('orang_tua.index', compact('orangTua', 'siswa', 'pelanggaranCount', 'prestasiCount', 'pelanggaranSelesai', 'prestasiSelesai'));
    }

    public function pelanggaran(Request $request)
    {
        $user = auth()->user();
        $siswa = Siswa::where('orang_tua_user_id', $user->id)->first();
        $pelanggaran = collect();

        if ($siswa) {
            $query = Pelanggaran::where('siswa_id', $siswa->id)
                ->where('status', '!=', 'ditolak')
                ->with(['siswa', 'user', 'jenisPelanggaran']);
            
            if ($request->status) {
                $query->where('status', $request->status);
            }
            
            $pelanggaran = $query->orderBy('created_at', 'desc')->get();
        }

        return view('orang_tua.pelanggaran', compact('pelanggaran'));
    }

    public function prestasi(Request $request)
    {
        $user = auth()->user();
        $siswa = Siswa::where('orang_tua_user_id', $user->id)->first();
        $prestasi = collect();

        if ($siswa) {
            $query = PrestasiSiswa::where('siswa_id', $siswa->id)
                ->where('status', '!=', 'ditolak')
                ->with(['siswa', 'user', 'prestasi']);
            
            if ($request->status) {
                $query->where('status', $request->status);
            }
            
            $prestasi = $query->orderBy('created_at', 'desc')->get();
        }

        return view('orang_tua.prestasi', compact('prestasi'));
    }

    public function selesai()
    {
        $user = auth()->user();
        $siswa = Siswa::where('orang_tua_user_id', $user->id)->first();
        $pelanggaranSelesai = collect();
        $prestasiSelesai = collect();

        if ($siswa) {
            $pelanggaranSelesai = Pelanggaran::where('siswa_id', $siswa->id)
                ->where('status', 'selesai')
                ->whereNotNull('verifikator_id')
                ->with(['siswa', 'user', 'jenisPelanggaran', 'verifikator'])
                ->orderBy('created_at', 'desc')
                ->get();
            
            $prestasiSelesai = PrestasiSiswa::where('siswa_id', $siswa->id)
                ->where('status', 'diverifikasi')
                ->whereNotNull('verifikator_id')
                ->with(['siswa', 'user', 'prestasi', 'verifikator'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('orang_tua.selesai', compact('pelanggaranSelesai', 'prestasiSelesai', 'siswa'));
    }

    public function exportLaporan()
    {
        $user = auth()->user();
        $siswa = Siswa::where('orang_tua_user_id', $user->id)->first();
        $pelanggaran = collect();
        $prestasi = collect();
        $sanksi = collect();

        if ($siswa) {
            $pelanggaran = Pelanggaran::where('siswa_id', $siswa->id)
                ->whereIn('status', ['selesai'])
                ->whereNotNull('verifikator_id')
                ->with(['siswa', 'user', 'jenisPelanggaran', 'verifikator'])
                ->orderBy('created_at', 'desc')
                ->get();
            $prestasi = PrestasiSiswa::where('siswa_id', $siswa->id)
                ->where('status', 'diverifikasi')
                ->whereNotNull('verifikator_id')
                ->with(['siswa', 'user', 'prestasi', 'verifikator'])
                ->orderBy('created_at', 'desc')
                ->get();
            $sanksi = \App\Models\PelaksanaanSanksi::where('siswa_id', $siswa->id)
                ->where('status', 'selesai')
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $pdf = Pdf::loadView('orang_tua.export-laporan', compact('siswa', 'pelanggaran', 'prestasi', 'sanksi'));
        return $pdf->download('laporan-anak-' . ($siswa ? $siswa->nama : 'unknown') . '.pdf');
    }
}