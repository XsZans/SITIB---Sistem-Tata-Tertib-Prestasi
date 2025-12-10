<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\JenisPelanggaran;
use App\Models\Pelanggaran;
use App\Models\Prestasi;
use App\Models\PrestasiSiswa;

class KesiswaanController extends Controller
{
    public function index()
    {
        return view('kesiswaan.index');
    }
    
    public function siswa(Request $request)
    {
        $search = $request->get('search');
        $jurusan = $request->get('jurusan');
        $sort = $request->get('sort');
        $limit = 15;
        
        $query = Siswa::query();
        
        if ($jurusan) {
            $query->where('jurusan', $jurusan);
        }
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nis', 'like', '%' . $search . '%')
                  ->orWhere('kelas', 'like', '%' . $search . '%');
            });
            
            $allResults = $query->orderBy('id')->get()->sortBy(function($item) use ($search) {
                $searchLower = strtolower($search);
                $namaLower = strtolower($item->nama);
                $nisLower = strtolower($item->nis);
                $kelasLower = strtolower($item->kelas);
                
                $posNama = strpos($namaLower, $searchLower);
                if ($posNama !== false) {
                    return $posNama;
                }
                
                $posNis = strpos($nisLower, $searchLower);
                if ($posNis !== false) {
                    return 1000 + $posNis;
                }
                
                $posKelas = strpos($kelasLower, $searchLower);
                if ($posKelas !== false) {
                    return 2000 + $posKelas;
                }
                
                return 9999;
            })->values();
            
            $siswa = $allResults->take($limit);
            $filteredTotal = $allResults->count();
        } else {
            if ($sort === 'nama_asc') {
                $siswa = $query->orderBy('nama', 'asc')->take($limit)->get();
            } elseif ($sort === 'nama_desc') {
                $siswa = $query->orderBy('nama', 'desc')->take($limit)->get();
            } else {
                $siswa = $query->orderBy('poin_pelanggaran', 'desc')->orderBy('id')->take($limit)->get();
            }
            $filteredTotal = $query->count();
        }
        
        $totalSiswa = Siswa::count();
        
        return view('kesiswaan.siswa', compact('siswa', 'totalSiswa', 'filteredTotal', 'search', 'jurusan', 'sort'));
    }
    
    public function pelanggaran()
    {
        $jenisPelanggaran = JenisPelanggaran::orderBy('kategori')->orderBy('poin')->get();
        $totalPelanggaran = Pelanggaran::count();
        $pelanggaranAktif = Pelanggaran::where('status', 'pending')->count();
        $pelanggaranMenunggu = Pelanggaran::where('status', 'menunggu_verifikasi')->count();
        $pelanggaranSelesai = Pelanggaran::where('status', 'selesai')->count();
        
        return view('kesiswaan.pelanggaran', compact('jenisPelanggaran', 'totalPelanggaran', 'pelanggaranAktif', 'pelanggaranSelesai', 'pelanggaranMenunggu'));
    }
    
    public function prestasi()
    {
        $prestasi = Prestasi::orderBy('kategori')->orderBy('tingkat')->orderBy('poin_pengurangan', 'desc')->get();
        $totalPrestasi = Prestasi::count();
        $prestasiAkademik = Prestasi::where('kategori', 'akademik')->count();
        $prestasiNonAkademik = Prestasi::where('kategori', 'non-akademik')->count();
        
        return view('kesiswaan.prestasi', compact('prestasi', 'totalPrestasi', 'prestasiAkademik', 'prestasiNonAkademik'));
    }
    
    public function sanksi()
    {
        $siswaSanksi = Siswa::where('poin_pelanggaran', '>', 0)
            ->with(['pelanggaran.jenisPelanggaran', 'pelanggaran.pengadu', 'pelanggaran.user'])
            ->orderBy('poin_pelanggaran', 'desc')
            ->get();
            
        $totalSiswaSanksi = $siswaSanksi->count();
        $sanksiRingan = $siswaSanksi->whereBetween('poin_pelanggaran', [1, 5])->count();
        $sanksiSedang = $siswaSanksi->whereBetween('poin_pelanggaran', [6, 15])->count();
        $sanksiBerat = $siswaSanksi->where('poin_pelanggaran', '>=', 16)->count();
        
        return view('kesiswaan.sanksi', compact('siswaSanksi', 'totalSiswaSanksi', 'sanksiRingan', 'sanksiSedang', 'sanksiBerat'));
    }
    
    public function laporan()
    {
        $laporanPelanggaran = Pelanggaran::where('status', 'menunggu_verifikasi')
            ->with(['siswa', 'jenisPelanggaran', 'user', 'pengadu'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        $laporanPrestasi = PrestasiSiswa::where('status', 'menunggu_verifikasi')
            ->with(['siswa', 'prestasi', 'user', 'pengadu'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        $totalLaporan = $laporanPelanggaran->count() + $laporanPrestasi->count();
        
        return view('kesiswaan.laporan', compact('laporanPelanggaran', 'laporanPrestasi', 'totalLaporan'));
    }
    
    public function guru(Request $request)
    {
        $limit = 15;
        $guru = \App\Models\Guru::orderByRaw("CASE 
            WHEN jabatan = 'kepala_sekolah' THEN 1 
            WHEN jabatan = 'kesiswaan' THEN 2 
            WHEN jabatan = 'guru_bk' THEN 3 
            ELSE 4 
        END")
        ->orderBy('nama')
        ->take($limit)
        ->get();
        $totalGuru = \App\Models\Guru::count();
        return view('kesiswaan.guru', compact('guru', 'totalGuru'));
    }
    
    public function pelaksanaanSanksi()
    {
        $pelaksanaanSanksi = \App\Models\PelaksanaanSanksi::with('siswa')
            ->orderBy('created_at', 'desc')
            ->get();
            
        $sanksiDalamProses = \App\Models\PelaksanaanSanksi::where('status', 'dalam_proses')->count();
        $sanksiSelesai = \App\Models\PelaksanaanSanksi::where('status', 'selesai')->count();
        
        return view('kesiswaan.pelaksanaan-sanksi', compact('pelaksanaanSanksi', 'sanksiDalamProses', 'sanksiSelesai'));
    }
}