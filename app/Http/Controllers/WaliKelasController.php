<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Pelanggaran;
use App\Models\PrestasiSiswa;
use App\Models\JenisPelanggaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class WaliKelasController extends Controller
{
    public function index()
    {
        $guru = Guru::where('user_id', auth()->id())->first();
        
        if (!$guru || !$guru->wali_kelas) {
            return redirect()->route('login')->with('error', 'Akses ditolak. Anda bukan wali kelas.');
        }
        
        // Konversi format wali_kelas ke format kelas siswa
        $siswaKelas = $this->getSiswaByWaliKelas($guru->wali_kelas);
        
        $totalSiswa = $siswaKelas->count();
        $totalPelanggaran = Pelanggaran::whereIn('siswa_id', $siswaKelas->pluck('id'))
            ->whereIn('status', ['diverifikasi', 'menunggu_verifikasi'])
            ->count();
        $totalPrestasi = PrestasiSiswa::whereIn('siswa_id', $siswaKelas->pluck('id'))->where('status', 'diverifikasi')->count();
        
        return view('wali_kelas.index', compact('guru', 'siswaKelas', 'totalSiswa', 'totalPelanggaran', 'totalPrestasi'));
    }
    
    public function siswa(Request $request)
    {
        $guru = Guru::where('user_id', auth()->id())->first();
        
        if (!$guru || !$guru->wali_kelas) {
            return redirect()->route('login')->with('error', 'Akses ditolak.');
        }
        
        $search = $request->get('search');
        $sort = $request->get('sort');
        
        // Gunakan method yang sama untuk mendapatkan siswa
        $siswaIds = $this->getSiswaByWaliKelas($guru->wali_kelas)->pluck('id');
        $query = Siswa::whereIn('id', $siswaIds);
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nis', 'like', '%' . $search . '%');
            });
        }
        
        if ($sort === 'nama_asc') {
            $siswa = $query->orderBy('nama', 'asc')->get();
        } elseif ($sort === 'nama_desc') {
            $siswa = $query->orderBy('nama', 'desc')->get();
        } else {
            $siswa = $query->orderBy('poin_pelanggaran', 'desc')->get();
        }
        
        return view('wali_kelas.siswa', compact('guru', 'siswa', 'search', 'sort'));
    }
    
    public function profile()
    {
        $guru = Guru::where('user_id', auth()->id())->first();
        
        if (!$guru) {
            return redirect()->route('login')->with('error', 'Data guru tidak ditemukan.');
        }
        
        return view('wali_kelas.profile', compact('guru'));
    }
    
    public function exportLaporan(Request $request)
    {
        $guru = Guru::where('user_id', auth()->id())->first();
        
        if (!$guru || !$guru->wali_kelas) {
            return redirect()->route('login')->with('error', 'Akses ditolak.');
        }
        
        $siswa_id = $request->get('siswa_id');
        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun', now()->year);
        $periode = $request->get('periode', 'semua');
        
        // Gunakan method yang sama untuk mendapatkan siswa
        $siswaList = $this->getSiswaByWaliKelas($guru->wali_kelas);
        
        if ($siswa_id) {
            $siswaList = $siswaList->where('id', $siswa_id);
        }
        
        $pelanggaranQuery = Pelanggaran::whereIn('siswa_id', $siswaList->pluck('id'))
            ->whereIn('status', ['selesai'])
            ->with(['siswa', 'jenisPelanggaran', 'verifikator']);
            
        $prestasiQuery = PrestasiSiswa::whereIn('siswa_id', $siswaList->pluck('id'))
            ->where('status', 'diverifikasi')
            ->with(['siswa', 'prestasi', 'verifikator']);
        
        if ($periode === 'bulan' && $bulan) {
            $pelanggaranQuery->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun);
            $prestasiQuery->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun);
        } elseif ($periode === 'tahun') {
            $pelanggaranQuery->whereYear('created_at', $tahun);
            $prestasiQuery->whereYear('created_at', $tahun);
        }
        
        $pelanggaran = $pelanggaranQuery->orderBy('created_at', 'desc')->get();
        $prestasi = $prestasiQuery->orderBy('created_at', 'desc')->get();
        
        $title = 'Laporan Kelas ' . $guru->wali_kelas;
        if ($siswa_id) {
            $siswaName = $siswaList->first()->nama ?? 'Unknown';
            $title = 'Laporan ' . $siswaName;
        }
        
        $pdf = Pdf::loadView('wali_kelas.export-laporan', compact('guru', 'siswaList', 'pelanggaran', 'prestasi', 'title', 'periode', 'bulan', 'tahun'));
        
        $filename = 'laporan-' . strtolower(str_replace(' ', '-', $guru->wali_kelas)) . '-' . now()->format('Y-m-d') . '.pdf';
        
        // Simpan PDF ke storage
        $storagePath = 'laporan_wali_kelas/' . $filename;
        \Storage::put($storagePath, $pdf->output());
        
        return $pdf->download($filename);
    }
    
    public function exportLaporanKelas(Request $request)
    {
        $guru = Guru::where('user_id', auth()->id())->first();
        
        if (!$guru || !$guru->wali_kelas) {
            return redirect()->route('login')->with('error', 'Akses ditolak.');
        }
        
        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun', now()->year);
        $periode = $request->get('periode', 'semua');
        
        $siswaList = $this->getSiswaByWaliKelas($guru->wali_kelas);
        
        $pelanggaranQuery = Pelanggaran::whereIn('siswa_id', $siswaList->pluck('id'))
            ->with(['siswa', 'jenisPelanggaran']);
            
        $prestasiQuery = PrestasiSiswa::whereIn('siswa_id', $siswaList->pluck('id'))
            ->where('status', 'diverifikasi')
            ->with(['siswa', 'prestasi']);
        
        if ($periode === 'bulan' && $bulan) {
            $pelanggaranQuery->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun);
            $prestasiQuery->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun);
        } elseif ($periode === 'tahun') {
            $pelanggaranQuery->whereYear('created_at', $tahun);
            $prestasiQuery->whereYear('created_at', $tahun);
        }
        
        $pelanggaran = $pelanggaranQuery->orderBy('created_at', 'desc')->get();
        $prestasi = $prestasiQuery->orderBy('created_at', 'desc')->get();
        
        $title = 'Laporan Kelas ' . $guru->wali_kelas;
        
        $pdf = Pdf::loadView('wali_kelas.export-laporan-kelas', compact('guru', 'siswaList', 'pelanggaran', 'prestasi', 'title', 'periode', 'bulan', 'tahun'));
        
        $filename = 'laporan-kelas-' . strtolower(str_replace(' ', '-', $guru->wali_kelas)) . '-' . now()->format('Y-m-d') . '.pdf';
        
        // Simpan PDF ke storage
        $storagePath = 'laporan_wali_kelas/' . $filename;
        \Storage::put($storagePath, $pdf->output());
        
        return $pdf->download($filename);
    }
    
    public function storePelanggaran(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'jenis_pelanggaran_id' => 'required|exists:jenis_pelanggaran,id',
            'keterangan' => 'nullable|string|max:500'
        ]);
        
        $guru = Guru::where('user_id', auth()->id())->first();
        
        if (!$guru || !$guru->wali_kelas) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }
        
        // Cek apakah siswa ada di kelas wali kelas ini
        $siswa = Siswa::where('id', $request->siswa_id)
                     ->where('kelas', $guru->wali_kelas)
                     ->first();
        
        if (!$siswa) {
            return redirect()->back()->with('error', 'Siswa tidak ditemukan di kelas Anda.');
        }
        
        $jenisPelanggaran = JenisPelanggaran::find($request->jenis_pelanggaran_id);
        
        // Buat pelanggaran baru
        $pelanggaran = Pelanggaran::create([
            'siswa_id' => $request->siswa_id,
            'jenis_pelanggaran_id' => $request->jenis_pelanggaran_id,
            'user_id' => auth()->id(),
            'pengadu_id' => auth()->id(),
            'tanggal_pelanggaran' => now()->toDateString(),
            'keterangan' => $request->keterangan,
            'status' => 'menunggu_verifikasi'
        ]);
        
        return redirect()->back()->with('success', 'Pelanggaran berhasil ditambahkan dan menunggu verifikasi.');
    }
    
    public function getJenisPelanggaran(Request $request)
    {
        $kategori = $request->get('kategori');
        
        if (!$kategori) {
            return response()->json([]);
        }
        
        $jenisPelanggaran = JenisPelanggaran::where('kategori', $kategori)
                                          ->orderBy('nama_pelanggaran')
                                          ->get(['id', 'nama_pelanggaran', 'poin']);
        
        return response()->json($jenisPelanggaran);
    }
    
    public function laporanTersimpan()
    {
        $guru = Guru::where('user_id', auth()->id())->first();
        
        if (!$guru || !$guru->wali_kelas) {
            return redirect()->route('login')->with('error', 'Akses ditolak.');
        }
        
        $files = Storage::files('laporan_wali_kelas');
        $laporanFiles = [];
        
        foreach ($files as $file) {
            $filename = basename($file);
            // Filter hanya file yang sesuai dengan kelas wali kelas ini
            $kelasSlug = strtolower(str_replace(' ', '-', $guru->wali_kelas));
            if (strpos($filename, $kelasSlug) !== false) {
                $laporanFiles[] = [
                    'filename' => $filename,
                    'path' => $file,
                    'size' => Storage::size($file),
                    'created_at' => Storage::lastModified($file)
                ];
            }
        }
        
        // Urutkan berdasarkan tanggal terbaru
        usort($laporanFiles, function($a, $b) {
            return $b['created_at'] - $a['created_at'];
        });
        
        return view('wali_kelas.laporan-tersimpan', compact('guru', 'laporanFiles'));
    }
    
    public function downloadLaporan($filename)
    {
        $guru = Guru::where('user_id', auth()->id())->first();
        
        if (!$guru || !$guru->wali_kelas) {
            return redirect()->route('login')->with('error', 'Akses ditolak.');
        }
        
        $kelasSlug = strtolower(str_replace(' ', '-', $guru->wali_kelas));
        if (strpos($filename, $kelasSlug) === false) {
            return redirect()->back()->with('error', 'File tidak ditemukan atau tidak memiliki akses.');
        }
        
        $filePath = 'laporan_wali_kelas/' . $filename;
        
        if (!Storage::exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
        
        return Storage::download($filePath);
    }

    /**
     * Mendapatkan siswa berdasarkan wali_kelas dengan format yang sama
     * Format: "XII PPLG 1"
     */
    private function getSiswaByWaliKelas($waliKelas)
    {
        return Siswa::where('kelas', $waliKelas)->get();
    }
}