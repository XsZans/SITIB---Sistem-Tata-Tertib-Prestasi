<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Pelanggaran;
use App\Models\JenisPelanggaran;
use App\Models\LaporanRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::where('user_id', auth()->id())->first();
        
        if (!$guru) {
            return redirect()->route('login')->with('error', 'Data guru tidak ditemukan.');
        }
        
        $totalSiswa = Siswa::count();
        $totalPelanggaran = Pelanggaran::whereNotIn('status', ['ditolak', 'selesai'])->count();
        
        // Cek laporan baru yang diverifikasi
        $newApprovedReports = LaporanRequest::where('user_id', auth()->id())
                                           ->where('status', 'approved')
                                           ->where('verified_at', '>=', now()->subDays(7))
                                           ->count();
        
        return view('guru.index', compact('guru', 'totalSiswa', 'totalPelanggaran', 'newApprovedReports'));
    }
    
    public function siswa(Request $request)
    {
        $guru = Guru::where('user_id', auth()->id())->first();
        
        if (!$guru) {
            return redirect()->route('login')->with('error', 'Data guru tidak ditemukan.');
        }
        
        $search = $request->get('search');
        $sort = $request->get('sort');
        
        $query = Siswa::query();
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nis', 'like', '%' . $search . '%')
                  ->orWhere('kelas', 'like', '%' . $search . '%');
            });
        }
        
        if ($sort === 'nama_asc') {
            $siswa = $query->orderBy('nama', 'asc')->get();
        } elseif ($sort === 'nama_desc') {
            $siswa = $query->orderBy('nama', 'desc')->get();
        } else {
            $siswa = $query->orderBy('poin_pelanggaran', 'desc')->get();
        }
        
        return view('guru.siswa', compact('guru', 'siswa', 'search', 'sort'));
    }
    
    public function profile()
    {
        $guru = Guru::where('user_id', auth()->id())->first();
        
        if (!$guru) {
            return redirect()->route('login')->with('error', 'Data guru tidak ditemukan.');
        }
        
        return view('guru.profile', compact('guru'));
    }
    
    public function exportLaporan(Request $request)
    {
        $guru = Guru::where('user_id', auth()->id())->first();
        
        if (!$guru) {
            return redirect()->route('login')->with('error', 'Data guru tidak ditemukan.');
        }
        
        $siswa_id = $request->get('siswa_id');
        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun', now()->year);
        $periode = $request->get('periode', 'semua');
        
        if (!$siswa_id) {
            return redirect()->back()->with('error', 'Pilih siswa terlebih dahulu.');
        }
        
        $siswa = Siswa::findOrFail($siswa_id);
        
        $pelanggaranQuery = Pelanggaran::where('siswa_id', $siswa_id)
            ->whereIn('status', ['selesai'])
            ->with(['siswa', 'jenisPelanggaran', 'verifikator']);
        
        if ($periode === 'bulan' && $bulan) {
            $pelanggaranQuery->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun);
        } elseif ($periode === 'tahun') {
            $pelanggaranQuery->whereYear('created_at', $tahun);
        }
        
        $pelanggaran = $pelanggaranQuery->orderBy('created_at', 'desc')->get();
        
        $title = 'Laporan ' . $siswa->nama;
        
        $pdf = Pdf::loadView('guru.export-laporan', compact('guru', 'siswa', 'pelanggaran', 'title', 'periode', 'bulan', 'tahun'));
        
        $filename = 'laporan-' . strtolower(str_replace(' ', '-', $siswa->nama)) . '-' . now()->format('Y-m-d') . '.pdf';
        
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
        
        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan.');
        }
        
        $siswa = Siswa::findOrFail($request->siswa_id);
        
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
    
    public function inputPelanggaran(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'jenis_pelanggaran_id' => 'required|exists:jenis_pelanggaran,id',
            'keterangan' => 'nullable|string|max:500'
        ]);
        
        $guru = Guru::where('user_id', auth()->id())->first();
        
        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan.');
        }
        
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
    
    public function getJenisPelanggaran($kategori_id)
    {
        if (!$kategori_id) {
            return response()->json([]);
        }
        
        $jenisPelanggaran = JenisPelanggaran::where('kategori', $kategori_id)
                                          ->orderBy('nama_pelanggaran')
                                          ->get(['id', 'nama_pelanggaran', 'poin'])
                                          ->map(function($item) {
                                              return [
                                                  'id' => $item->id,
                                                  'nama' => $item->nama_pelanggaran,
                                                  'poin' => $item->poin
                                              ];
                                          });
        
        return response()->json($jenisPelanggaran);
    }
    
    public function laporan()
    {
        $guru = Guru::where('user_id', auth()->id())->first();
        
        if (!$guru) {
            return redirect()->route('login')->with('error', 'Data guru tidak ditemukan.');
        }
        
        $requests = LaporanRequest::where('user_id', auth()->id())
                                 ->with(['siswa', 'verifikator'])
                                 ->orderBy('created_at', 'desc')
                                 ->get();
        
        return view('guru.laporan', compact('guru', 'requests'));
    }
    
    public function requestLaporan(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'periode' => 'required|in:semua,bulan,tahun',
            'bulan' => 'nullable|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:' . (now()->year + 1)
        ]);
        
        LaporanRequest::create([
            'siswa_id' => $request->siswa_id,
            'user_id' => auth()->id(),
            'periode' => $request->periode,
            'bulan' => $request->periode === 'bulan' ? $request->bulan : null,
            'tahun' => $request->tahun,
            'status' => 'pending'
        ]);
        
        return redirect()->back()->with('success', 'Request laporan berhasil dikirim dan menunggu verifikasi.');
    }
    
    public function downloadLaporan($id)
    {
        $laporanRequest = LaporanRequest::where('id', $id)
                                       ->where('user_id', auth()->id())
                                       ->where('status', 'approved')
                                       ->with('siswa')
                                       ->firstOrFail();
        
        $siswa = $laporanRequest->siswa;
        
        $pelanggaranQuery = Pelanggaran::where('siswa_id', $siswa->id)
            ->whereIn('status', ['selesai'])
            ->with(['siswa', 'jenisPelanggaran', 'verifikator']);
        
        if ($laporanRequest->periode === 'bulan') {
            $pelanggaranQuery->whereMonth('created_at', $laporanRequest->bulan)
                           ->whereYear('created_at', $laporanRequest->tahun);
        } elseif ($laporanRequest->periode === 'tahun') {
            $pelanggaranQuery->whereYear('created_at', $laporanRequest->tahun);
        }
        
        $pelanggaran = $pelanggaranQuery->orderBy('created_at', 'desc')->get();
        
        $title = 'Laporan ' . $siswa->nama;
        
        $pdf = Pdf::loadView('guru.export-laporan', compact('siswa', 'pelanggaran', 'title', 'laporanRequest'));
        
        $filename = 'laporan-' . strtolower(str_replace(' ', '-', $siswa->nama)) . '-' . now()->format('Y-m-d') . '.pdf';
        
        return $pdf->download($filename);
    }
    
    public function storage()
    {
        $guru = Guru::where('user_id', auth()->id())->first();
        
        if (!$guru) {
            return redirect()->route('login')->with('error', 'Data guru tidak ditemukan.');
        }
        
        // Ambil laporan yang sudah diverifikasi
        $approvedReports = LaporanRequest::where('user_id', auth()->id())
                                        ->where('status', 'approved')
                                        ->with(['siswa', 'verifikator'])
                                        ->orderBy('verified_at', 'desc')
                                        ->get();
        
        return view('guru.storage', compact('guru', 'approvedReports'));
    }
    
    public function autoDownloadReport($id)
    {
        $laporanRequest = LaporanRequest::where('id', $id)
                                       ->where('user_id', auth()->id())
                                       ->where('status', 'approved')
                                       ->with('siswa')
                                       ->firstOrFail();
        
        $siswa = $laporanRequest->siswa;
        
        $pelanggaranQuery = Pelanggaran::where('siswa_id', $siswa->id)
            ->whereIn('status', ['selesai'])
            ->with(['siswa', 'jenisPelanggaran', 'verifikator']);
        
        if ($laporanRequest->periode === 'bulan') {
            $pelanggaranQuery->whereMonth('created_at', $laporanRequest->bulan)
                           ->whereYear('created_at', $laporanRequest->tahun);
        } elseif ($laporanRequest->periode === 'tahun') {
            $pelanggaranQuery->whereYear('created_at', $laporanRequest->tahun);
        }
        
        $pelanggaran = $pelanggaranQuery->orderBy('created_at', 'desc')->get();
        
        $title = 'Laporan ' . $siswa->nama;
        
        $pdf = Pdf::loadView('guru.export-laporan', compact('siswa', 'pelanggaran', 'title', 'laporanRequest'));
        
        $filename = 'laporan-' . strtolower(str_replace(' ', '-', $siswa->nama)) . '-' . $laporanRequest->verified_at->format('Y-m-d') . '.pdf';
        
        return $pdf->download($filename);
    }
}