<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\JenisPelanggaran;
use App\Models\Pelanggaran;
use App\Models\Prestasi;
use App\Models\PrestasiSiswa;
use App\Models\LaporanRequest;
use DateTime;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    
    public function siswa(Request $request)
    {
        $search = $request->get('search');
        $jurusan = $request->get('jurusan');
        $sort = $request->get('sort');
        $limit = 15;
        
        $baseQuery = Siswa::query();
        
        if ($jurusan) {
            $baseQuery->where('jurusan', $jurusan);
        }
        
        if ($search) {
            $baseQuery->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nis', 'like', '%' . $search . '%')
                  ->orWhere('kelas', 'like', '%' . $search . '%');
            });
            
            $allResults = $baseQuery->orderBy('id')->get()->sortBy(function($item) use ($search) {
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
            // Count first before applying limit
            $filteredTotal = $baseQuery->count();
            
            // Apply sorting and limit
            if ($sort === 'nama_asc') {
                $siswa = $baseQuery->orderBy('nama', 'asc')->limit($limit)->get();
            } elseif ($sort === 'nama_desc') {
                $siswa = $baseQuery->orderBy('nama', 'desc')->limit($limit)->get();
            } else {
                $siswa = $baseQuery->orderBy('poin_pelanggaran', 'desc')->orderBy('id')->limit($limit)->get();
            }
        }
        
        $totalSiswa = Siswa::count();
        
        // Detect if request is from kesiswaan or kepsek
        $isKesiswaan = $request->route()->getName() === 'kesiswaan.siswa';
        $isKepsek = $request->route()->getName() === 'kepsek.siswa';
        
        return view('admin.siswa', compact('siswa', 'totalSiswa', 'filteredTotal', 'search', 'jurusan', 'sort', 'isKesiswaan', 'isKepsek'));
    }
    
    public function loadMoreSiswa(Request $request)
    {
        $offset = $request->get('offset', 0);
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
            
            $siswa = $allResults->skip($offset)->take($limit);
            $totalFiltered = $allResults->count();
            $hasMore = ($offset + $limit) < $totalFiltered;
        } else {
            $totalFiltered = $query->count();
            // Apply sorting
            if ($sort === 'nama_asc') {
                $siswa = $query->orderBy('nama', 'asc')->skip($offset)->take($limit)->get();
            } elseif ($sort === 'nama_desc') {
                $siswa = $query->orderBy('nama', 'desc')->skip($offset)->take($limit)->get();
            } else {
                $siswa = $query->orderBy('poin_pelanggaran', 'desc')->orderBy('id')->skip($offset)->take($limit)->get();
            }
            $hasMore = ($offset + $limit) < $totalFiltered;
        }
        
        return response()->json([
            'siswa' => $siswa,
            'hasMore' => $hasMore,
            'total' => $totalFiltered,
            'offset' => $offset,
            'limit' => $limit
        ]);
    }
    
    public function pelanggaran()
    {
        $jenisPelanggaran = JenisPelanggaran::orderBy('kategori')->orderBy('poin')->get();
        $totalPelanggaran = Pelanggaran::count();
        $pelanggaranAktif = Pelanggaran::whereIn('status', ['menunggu_verifikasi', 'pending', 'dalam_sanksi'])->count() + \App\Models\PelaksanaanSanksi::where('status', 'dalam_proses')->count();
        $pelanggaranMenunggu = Pelanggaran::where('status', 'menunggu_verifikasi')->count();
        $pelanggaranSelesai = Pelanggaran::where('status', 'selesai')->count() + \App\Models\PelaksanaanSanksi::where('status', 'selesai')->count();
        
        return view('admin.pelanggaran', compact('jenisPelanggaran', 'totalPelanggaran', 'pelanggaranAktif', 'pelanggaranSelesai', 'pelanggaranMenunggu'));
    }
    
    public function prestasi()
    {
        $prestasi = Prestasi::orderBy('kategori')->orderBy('tingkat')->orderBy('poin_pengurangan', 'desc')->get();
        $totalPrestasi = Prestasi::count();
        $prestasiAkademik = Prestasi::where('kategori', 'akademik')->count();
        $prestasiNonAkademik = Prestasi::where('kategori', 'non-akademik')->count();
        
        return view('admin.prestasi', compact('prestasi', 'totalPrestasi', 'prestasiAkademik', 'prestasiNonAkademik'));
    }
    
    public function kelolaSiswa(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'tipe' => 'required|in:pelanggaran,prestasi',
            'jenis_pelanggaran_id' => 'nullable|exists:jenis_pelanggaran,id',
            'prestasi_id' => 'nullable|exists:prestasi,id',
            'catatan' => 'nullable|string|max:500',
            'bukti_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        // Manual validation untuk memastikan field yang tepat diisi
        $redirectRoute = auth()->user()->role === 'kesiswaan' ? 'kesiswaan.siswa' : 'admin.siswa';
        
        if ($request->tipe === 'pelanggaran' && !$request->jenis_pelanggaran_id) {
            return redirect()->route($redirectRoute)->with('error', 'Pilih jenis pelanggaran!');
        }
        
        if ($request->tipe === 'prestasi' && !$request->prestasi_id) {
            return redirect()->route($redirectRoute)->with('error', 'Pilih jenis prestasi!');
        }
        
        $siswa = Siswa::findOrFail($request->siswa_id);
        
        if ($request->tipe === 'pelanggaran') {
            $jenisPelanggaran = JenisPelanggaran::findOrFail($request->jenis_pelanggaran_id);
            
            // Handle upload bukti gambar
            $buktiGambar = null;
            if ($request->hasFile('bukti_gambar')) {
                $file = $request->file('bukti_gambar');
                $filename = time() . '_' . $siswa->nis . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/bukti_pelanggaran'), $filename);
                $buktiGambar = 'storage/bukti_pelanggaran/' . $filename;
            }
            
            // Simpan record pelanggaran dengan status menunggu verifikasi
            Pelanggaran::create([
                'siswa_id' => $siswa->id,
                'jenis_pelanggaran_id' => $jenisPelanggaran->id,
                'user_id' => auth()->id(),
                'pengadu_id' => auth()->id(),
                'tanggal_pelanggaran' => now(),
                'keterangan' => $request->catatan,
                'bukti_gambar' => $buktiGambar,
                'status' => 'menunggu_verifikasi'
            ]);
            
            return redirect()->route($redirectRoute)->with('success', 'Laporan pelanggaran berhasil dikirim untuk ' . $siswa->nama . '. Menunggu verifikasi admin.');
            
        } else {
            $prestasi = Prestasi::findOrFail($request->prestasi_id);
            
            // Handle upload bukti gambar untuk prestasi
            $buktiGambar = null;
            if ($request->hasFile('bukti_gambar')) {
                $file = $request->file('bukti_gambar');
                $filename = time() . '_prestasi_' . $siswa->nis . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/bukti_prestasi'), $filename);
                $buktiGambar = 'storage/bukti_prestasi/' . $filename;
            }
            
            // Simpan record prestasi dengan status menunggu verifikasi
            \App\Models\PrestasiSiswa::create([
                'siswa_id' => $siswa->id,
                'prestasi_id' => $prestasi->id,
                'user_id' => auth()->id(),
                'pengadu_id' => auth()->id(),
                'tanggal_prestasi' => now(),
                'keterangan' => $request->catatan,
                'bukti_gambar' => $buktiGambar,
                'status' => 'menunggu_verifikasi'
            ]);
            
            return redirect()->route($redirectRoute)->with('success', 'Laporan prestasi berhasil dikirim untuk ' . $siswa->nama . '. Menunggu verifikasi admin.');
        }
    }
    
    public function sanksi()
    {
        // Ambil siswa yang memiliki pelanggaran dengan status 'pending' (sudah terverifikasi tapi belum diproses sanksi)
        $siswaSanksi = Siswa::whereHas('pelanggaran', function($query) {
                $query->where('status', 'pending');
            })
            ->with(['pelanggaran' => function($query) {
                $query->whereIn('status', ['pending', 'dalam_sanksi'])
                      ->with(['jenisPelanggaran', 'pengadu', 'user', 'verifikator']);
            }])
            ->orderBy('poin_pelanggaran', 'desc')
            ->get();
            
        $totalSiswaSanksi = $siswaSanksi->count();
        $sanksiRingan = $siswaSanksi->whereBetween('poin_pelanggaran', [1, 5])->count();
        $sanksiSedang = $siswaSanksi->whereBetween('poin_pelanggaran', [6, 15])->count();
        $sanksiBerat = $siswaSanksi->where('poin_pelanggaran', '>=', 16)->count();
        
        return view('admin.sanksi', compact('siswaSanksi', 'totalSiswaSanksi', 'sanksiRingan', 'sanksiSedang', 'sanksiBerat'));
    }
    
    public function prosesSanksi(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id'
        ]);
        
        $siswa = Siswa::findOrFail($request->siswa_id);
        
        // Tentukan jenis sanksi berdasarkan poin
        $poin = $siswa->poin_pelanggaran;
        if ($poin >= 1 && $poin <= 5) {
            $jenisSanksi = 'Sanksi Ringan';
            $deskripsi = 'Dicatat dan konseling';
        } elseif ($poin >= 6 && $poin <= 10) {
            $jenisSanksi = 'Sanksi Sedang';
            $deskripsi = 'Peringatan lisan';
        } elseif ($poin >= 11 && $poin <= 15) {
            $jenisSanksi = 'Sanksi Sedang';
            $deskripsi = 'Peringatan tertulis dengan perjanjian';
        } elseif ($poin >= 16 && $poin <= 20) {
            $jenisSanksi = 'Sanksi Berat';
            $deskripsi = 'Panggilan orang tua dengan perjanjian di atas materai';
        } elseif ($poin >= 21 && $poin <= 25) {
            $jenisSanksi = 'Sanksi Berat';
            $deskripsi = 'Perjanjian orang tua dengan perjanjian di atas materai';
        } elseif ($poin >= 26 && $poin <= 30) {
            $jenisSanksi = 'Sanksi Berat';
            $deskripsi = 'Skors 3 hari';
        } elseif ($poin >= 31 && $poin <= 35) {
            $jenisSanksi = 'Sanksi Berat';
            $deskripsi = 'Skors 7 hari';
        } elseif ($poin >= 36 && $poin <= 40) {
            $jenisSanksi = 'Sanksi Berat';
            $deskripsi = 'Diserahkan kepada ortu untuk dibina dalam jangka waktu 2 minggu';
        } elseif ($poin >= 41 && $poin <= 89) {
            $jenisSanksi = 'Sanksi Berat';
            $deskripsi = 'Diserahkan dan dibina ortu jangka waktu 1 bulan';
        } else {
            $jenisSanksi = 'Sanksi Berat';
            $deskripsi = 'Dikembalikan kepada orang tua (Drop Out dari sekolah)';
        }
        
        // Buat record pelaksanaan sanksi
        \App\Models\PelaksanaanSanksi::create([
            'siswa_id' => $siswa->id,
            'jenis_sanksi' => $jenisSanksi,
            'deskripsi_sanksi' => $deskripsi,
            'tanggal_mulai' => now(),
            'status' => 'dalam_proses',
            'user_id' => auth()->id()
        ]);
        
        // Update status pelanggaran menjadi dalam_sanksi
        Pelanggaran::where('siswa_id', $siswa->id)
                  ->where('status', 'pending')
                  ->update(['status' => 'dalam_sanksi']);
        
        $redirectRoute = auth()->user()->role === 'kesiswaan' ? 'kesiswaan.pelaksanaan-sanksi' : 'admin.pelaksanaan-sanksi';
        return redirect()->route($redirectRoute)->with('success', 'Sanksi untuk ' . $siswa->nama . ' telah dimulai dan masuk ke pelaksanaan sanksi.');
    }
    
    public function getSiswa()
    {
        $siswa = Siswa::orderBy('nama')->get();
        return response()->json($siswa);
    }
    
    public function tambahPelanggaran(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'jenis_pelanggaran_id' => 'required|exists:jenis_pelanggaran,id',
            'keterangan' => 'nullable|string|max:500',
            'bukti_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        $siswa = Siswa::findOrFail($request->siswa_id);
        $jenisPelanggaran = JenisPelanggaran::findOrFail($request->jenis_pelanggaran_id);
        
        // Handle upload bukti gambar
        $buktiGambar = null;
        if ($request->hasFile('bukti_gambar')) {
            $file = $request->file('bukti_gambar');
            $filename = time() . '_' . $siswa->nis . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/bukti_pelanggaran'), $filename);
            $buktiGambar = 'storage/bukti_pelanggaran/' . $filename;
        }
        
        // Simpan record pelanggaran dengan status menunggu verifikasi
        Pelanggaran::create([
            'siswa_id' => $siswa->id,
            'jenis_pelanggaran_id' => $jenisPelanggaran->id,
            'user_id' => auth()->id(),
            'pengadu_id' => auth()->id(),
            'tanggal_pelanggaran' => now(),
            'keterangan' => $request->keterangan,
            'bukti_gambar' => $buktiGambar,
            'status' => 'menunggu_verifikasi'
        ]);
        
        $redirectRoute = auth()->user()->role === 'kesiswaan' ? 'kesiswaan.pelanggaran' : 'admin.pelanggaran';
        return redirect()->route($redirectRoute)->with('success', 'Laporan pelanggaran berhasil dikirim untuk ' . $siswa->nama . '. Menunggu verifikasi admin.');
    }
    
    public function hapusPelanggaran(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id'
        ]);
        
        $siswa = Siswa::findOrFail($request->siswa_id);
        
        // Hapus semua pelanggaran siswa
        Pelanggaran::where('siswa_id', $siswa->id)->delete();
        
        // Reset poin pelanggaran siswa ke 0
        $siswa->poin_pelanggaran = 0;
        $siswa->save();
        
        $redirectRoute = auth()->user()->role === 'kesiswaan' ? 'kesiswaan.sanksi' : 'admin.sanksi';
        return redirect()->route($redirectRoute)->with('success', 'Semua pelanggaran ' . $siswa->nama . ' telah dihapus dan poin direset ke 0.');
    }
    
    public function getSiswaPelanggaran($siswaId)
    {
        $siswa = Siswa::findOrFail($siswaId);
        $pelanggaran = Pelanggaran::where('siswa_id', $siswaId)
            ->with('jenisPelanggaran')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json([
            'siswa' => $siswa,
            'pelanggaran' => $pelanggaran
        ]);
    }
    
    public function grafikPelanggaran(Request $request)
    {
        $tahun = $request->get('tahun', now()->year);
        $bulan = $request->get('bulan', now()->month);
        
        // Hitung pelanggaran berdasarkan kategori poin dengan left join (only selesai)
        $ringan = Pelanggaran::whereYear('pelanggaran.created_at', $tahun)
            ->whereMonth('pelanggaran.created_at', $bulan)
            ->where('pelanggaran.status', 'selesai')
            ->leftJoin('jenis_pelanggaran', 'pelanggaran.jenis_pelanggaran_id', '=', 'jenis_pelanggaran.id')
            ->where(function($query) {
                $query->whereBetween('jenis_pelanggaran.poin', [1, 5])
                      ->orWhereNull('jenis_pelanggaran.poin');
            })
            ->count();
            
        $sedang = Pelanggaran::whereYear('pelanggaran.created_at', $tahun)
            ->whereMonth('pelanggaran.created_at', $bulan)
            ->where('pelanggaran.status', 'selesai')
            ->leftJoin('jenis_pelanggaran', 'pelanggaran.jenis_pelanggaran_id', '=', 'jenis_pelanggaran.id')
            ->whereBetween('jenis_pelanggaran.poin', [6, 15])
            ->count();
            
        $berat = Pelanggaran::whereYear('pelanggaran.created_at', $tahun)
            ->whereMonth('pelanggaran.created_at', $bulan)
            ->where('pelanggaran.status', 'selesai')
            ->leftJoin('jenis_pelanggaran', 'pelanggaran.jenis_pelanggaran_id', '=', 'jenis_pelanggaran.id')
            ->where('jenis_pelanggaran.poin', '>=', 16)
            ->count();
        
        // Ambil tanggal-tanggal yang ada pelanggaran
        $tanggal = Pelanggaran::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->selectRaw('DAY(created_at) as day')
            ->distinct()
            ->orderBy('day')
            ->pluck('day')
            ->toArray();
        
        $total = $ringan + $sedang + $berat;
        
        return response()->json([
            'ringan' => $ringan,
            'sedang' => $sedang,
            'berat' => $berat,
            'total' => $total,
            'tanggal' => $tanggal
        ]);
    }
    
    public function grafikPrestasi(Request $request)
    {
        $tahun = $request->get('tahun', now()->year);
        $bulan = $request->get('bulan', now()->month);
        
        // Hitung prestasi berdasarkan kategori
        $akademik = PrestasiSiswa::whereYear('prestasi_siswa.created_at', $tahun)
            ->whereMonth('prestasi_siswa.created_at', $bulan)
            ->leftJoin('prestasi', 'prestasi_siswa.prestasi_id', '=', 'prestasi.id')
            ->where('prestasi.kategori', 'akademik')
            ->where('prestasi_siswa.status', 'diverifikasi')
            ->count();
            
        $nonAkademik = PrestasiSiswa::whereYear('prestasi_siswa.created_at', $tahun)
            ->whereMonth('prestasi_siswa.created_at', $bulan)
            ->leftJoin('prestasi', 'prestasi_siswa.prestasi_id', '=', 'prestasi.id')
            ->where('prestasi.kategori', 'non-akademik')
            ->where('prestasi_siswa.status', 'diverifikasi')
            ->count();
        
        $total = $akademik + $nonAkademik;
        
        return response()->json([
            'akademik' => $akademik,
            'non_akademik' => $nonAkademik,
            'total' => $total
        ]);
    }
    
    public function detailPelanggaran(Request $request)
    {
        $tahun = $request->get('tahun', now()->year);
        $bulan = $request->get('bulan');
        $status = $request->get('status');
        
        $query = Pelanggaran::whereYear('pelanggaran.created_at', $tahun)
            ->leftJoin('jenis_pelanggaran', 'pelanggaran.jenis_pelanggaran_id', '=', 'jenis_pelanggaran.id')
            ->leftJoin('siswa', 'pelanggaran.siswa_id', '=', 'siswa.id')
            ->select(
                'pelanggaran.created_at',
                'pelanggaran.status',
                'siswa.nama as siswa_nama',
                'jenis_pelanggaran.nama_pelanggaran as jenis_pelanggaran',
                'jenis_pelanggaran.poin'
            )
            ->orderBy('pelanggaran.created_at', 'desc');
            
        if ($bulan) {
            $query->whereMonth('pelanggaran.created_at', $bulan);
        }
        
        if ($status) {
            $query->where('pelanggaran.status', $status);
        }
        
        $pelanggaran = $query->get();
        
        return response()->json([
            'pelanggaran' => $pelanggaran
        ]);
    }
    
    public function getJenisPelanggaran()
    {
        $jenisPelanggaran = JenisPelanggaran::orderBy('kategori')->orderBy('poin')->get();
        return response()->json($jenisPelanggaran);
    }
    
    public function users(Request $request)
    {
        $search = $request->get('search');
        $role = $request->get('role');
        $verified = $request->get('verified');
        
        $query = \App\Models\User::query();
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('username', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        
        if ($role) {
            $query->where('role', $role);
        }
        
        if ($verified !== null) {
            $query->where('is_verified', $verified);
        }
        
        $users = $query->orderBy('created_at', 'desc')->get();
        
        return view('admin.users', compact('users', 'search', 'role', 'verified'));
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
        
        // Count tidak terverifikasi untuk stats
        $pelanggaranDitolak = Pelanggaran::where('status', 'ditolak')->count();
        $prestasiDitolak = PrestasiSiswa::where('status', 'ditolak')->count();
        $totalTidakTerverifikasi = $pelanggaranDitolak + $prestasiDitolak;
        
        $view = auth()->user()->role === 'kesiswaan' ? 'kesiswaan.laporan' : 'admin.laporan';
        return view($view, compact('laporanPelanggaran', 'laporanPrestasi', 'totalLaporan', 'totalTidakTerverifikasi'));
    }
    
    public function verifikasiLaporan(Request $request)
    {
        $validated = $request->validate([
            'laporan_id' => 'required',
            'tipe' => 'required|in:pelanggaran,prestasi',
            'action' => 'required|in:terima,tolak',
            'alasan_tolak' => 'nullable|string|max:500'
        ]);
        
        if ($request->tipe === 'pelanggaran') {
            $pelanggaran = Pelanggaran::with(['siswa', 'jenisPelanggaran'])->findOrFail($request->laporan_id);
            
            if ($request->action === 'terima') {
                // Update status menjadi pending (masuk ke sanksi)
                $pelanggaran->status = 'pending';
                $pelanggaran->verifikator_id = auth()->id();
                $pelanggaran->tanggal_verifikasi = now();
                $pelanggaran->save();
                
                // Hitung ulang total poin siswa dari pelanggaran yang sudah diverifikasi (pending + dalam_sanksi)
                $totalPoin = Pelanggaran::where('siswa_id', $pelanggaran->siswa_id)
                    ->whereIn('status', ['pending', 'dalam_sanksi'])
                    ->join('jenis_pelanggaran', 'pelanggaran.jenis_pelanggaran_id', '=', 'jenis_pelanggaran.id')
                    ->sum('jenis_pelanggaran.poin');
                
                // Update poin siswa
                $pelanggaran->siswa->poin_pelanggaran = $totalPoin;
                $pelanggaran->siswa->save();
                
                $redirectRoute = auth()->user()->role === 'kesiswaan' ? 'kesiswaan.laporan' : 'admin.laporan';
                return redirect()->route($redirectRoute)->with('success', 'Laporan pelanggaran ' . $pelanggaran->siswa->nama . ' telah diverifikasi dan masuk ke sistem sanksi.');
            } else {
                // Update status menjadi ditolak dengan alasan
                $pelanggaran->status = 'ditolak';
                $pelanggaran->alasan_tolak = $request->alasan_tolak;
                $pelanggaran->verifikator_id = auth()->id();
                $pelanggaran->tanggal_verifikasi = now();
                $pelanggaran->save();
                
                $redirectRoute = auth()->user()->role === 'kesiswaan' ? 'kesiswaan.laporan' : 'admin.laporan';
                return redirect()->route($redirectRoute)->with('success', 'Laporan pelanggaran ' . $pelanggaran->siswa->nama . ' telah ditolak.');
            }
        } else {
            $prestasiSiswa = PrestasiSiswa::with(['siswa', 'prestasi'])->findOrFail($request->laporan_id);
            
            if ($request->action === 'terima') {
                // Update status menjadi diverifikasi
                $prestasiSiswa->status = 'diverifikasi';
                $prestasiSiswa->verifikator_id = auth()->id();
                $prestasiSiswa->tanggal_verifikasi = now();
                $prestasiSiswa->save();
                
                // Tambah poin prestasi ke siswa
                $prestasiSiswa->siswa->poin_prestasi += $prestasiSiswa->prestasi->poin_pengurangan;
                $prestasiSiswa->siswa->save();
                
                $redirectRoute = auth()->user()->role === 'kesiswaan' ? 'kesiswaan.laporan' : 'admin.laporan';
                return redirect()->route($redirectRoute)->with('success', 'Laporan prestasi ' . $prestasiSiswa->siswa->nama . ' telah diverifikasi. Poin prestasi bertambah ' . $prestasiSiswa->prestasi->poin_pengurangan . '.');
            } else {
                // Update status menjadi ditolak dengan alasan
                $prestasiSiswa->status = 'ditolak';
                $prestasiSiswa->alasan_tolak = $request->alasan_tolak;
                $prestasiSiswa->verifikator_id = auth()->id();
                $prestasiSiswa->tanggal_verifikasi = now();
                $prestasiSiswa->save();
                
                $redirectRoute = auth()->user()->role === 'kesiswaan' ? 'kesiswaan.laporan' : 'admin.laporan';
                return redirect()->route($redirectRoute)->with('success', 'Laporan prestasi ' . $prestasiSiswa->siswa->nama . ' telah ditolak.');
            }
        }
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
        
        // Detect if request is from kesiswaan
        $isKesiswaan = $request->route()->getName() === 'kesiswaan.guru';
        
        return view('admin.guru', compact('guru', 'totalGuru', 'isKesiswaan'));
    }
    
    public function loadMoreGuru(Request $request)
    {
        $offset = $request->get('offset', 0);
        $limit = 15;
        
        $guru = \App\Models\Guru::orderByRaw("CASE 
            WHEN jabatan = 'kepala_sekolah' THEN 1 
            WHEN jabatan = 'kesiswaan' THEN 2 
            WHEN jabatan = 'guru_bk' THEN 3 
            ELSE 4 
        END")
        ->orderBy('nama')
        ->skip($offset)
        ->take($limit)
        ->get();
        $totalGuru = \App\Models\Guru::count();
        $hasMore = ($offset + $limit) < $totalGuru;
        
        return response()->json([
            'guru' => $guru,
            'hasMore' => $hasMore,
            'total' => $totalGuru,
            'offset' => $offset,
            'limit' => $limit
        ]);
    }
    
    public function showGuru($id)
    {
        $guru = \App\Models\Guru::findOrFail($id);
        return response()->json($guru);
    }
    
    public function deleteGuru($id)
    {
        $guru = \App\Models\Guru::findOrFail($id);
        $guru->delete();
        return response()->json(['success' => true]);
    }
    
    public function exportPelanggaran(Request $request)
    {
        $periode = $request->get('periode', 'bulan');
        $bulan = $request->get('bulan', now()->month);
        $tahun = $request->get('tahun', now()->year);
        
        $query = \App\Models\Pelanggaran::with(['siswa', 'jenisPelanggaran']);
        
        if ($periode === 'bulan') {
            $query->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun);
            $title = 'Laporan Pelanggaran ' . DateTime::createFromFormat('!m', $bulan)->format('F') . ' ' . $tahun;
        } elseif ($periode === 'tahun') {
            $query->whereYear('created_at', $tahun);
            $title = 'Laporan Pelanggaran Tahun ' . $tahun;
        } else {
            $title = 'Laporan Pelanggaran Semua Data';
        }
        
        $pelanggaran = $query->orderBy('created_at', 'desc')->get();
        
        $pdf = \PDF::loadView('admin.export-pelanggaran', compact('pelanggaran', 'title'));
        
        return $pdf->download('laporan-pelanggaran-' . now()->format('Y-m-d') . '.pdf');
    }
    
    public function exportPrestasi(Request $request)
    {
        $periode = $request->get('periode', 'bulan');
        $bulan = $request->get('bulan', now()->month);
        $tahun = $request->get('tahun', now()->year);
        
        $query = \App\Models\PrestasiSiswa::with(['siswa', 'prestasi'])->where('status', 'diverifikasi');
        
        if ($periode === 'bulan') {
            $query->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun);
            $title = 'Laporan Prestasi ' . DateTime::createFromFormat('!m', $bulan)->format('F') . ' ' . $tahun;
        } elseif ($periode === 'tahun') {
            $query->whereYear('created_at', $tahun);
            $title = 'Laporan Prestasi Tahun ' . $tahun;
        } else {
            $title = 'Laporan Prestasi Semua Data';
        }
        
        $prestasi = $query->orderBy('created_at', 'desc')->get();
        
        $pdf = \PDF::loadView('admin.export-prestasi', compact('prestasi', 'title'));
        
        return $pdf->download('laporan-prestasi-' . now()->format('Y-m-d') . '.pdf');
    }
    
    public function tambahPrestasi(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'jenis_prestasi_id' => 'required|exists:prestasi,id',
            'keterangan' => 'nullable|string|max:500',
            'bukti_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        $siswa = Siswa::findOrFail($request->siswa_id);
        $prestasi = Prestasi::findOrFail($request->jenis_prestasi_id);
        
        // Handle upload bukti gambar
        $buktiGambar = null;
        if ($request->hasFile('bukti_gambar')) {
            $file = $request->file('bukti_gambar');
            $filename = time() . '_prestasi_' . $siswa->nis . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/bukti_prestasi'), $filename);
            $buktiGambar = 'storage/bukti_prestasi/' . $filename;
        }
        
        // Simpan record prestasi dengan status menunggu verifikasi
        PrestasiSiswa::create([
            'siswa_id' => $siswa->id,
            'prestasi_id' => $prestasi->id,
            'user_id' => auth()->id(),
            'pengadu_id' => auth()->id(),
            'tanggal_prestasi' => now(),
            'keterangan' => $request->keterangan,
            'bukti_gambar' => $buktiGambar,
            'status' => 'menunggu_verifikasi'
        ]);
        
        $redirectRoute = auth()->user()->role === 'kesiswaan' ? 'kesiswaan.prestasi' : 'admin.prestasi';
        return redirect()->route($redirectRoute)->with('success', 'Laporan prestasi berhasil dikirim untuk ' . $siswa->nama . '. Menunggu verifikasi admin.');
    }
    
    public function createGuruUser(Request $request)
    {
        $validated = $request->validate([
            'guru_id' => 'required|exists:guru,id',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);
        
        $guru = \App\Models\Guru::findOrFail($request->guru_id);
        
        // Cek apakah guru sudah memiliki user
        if ($guru->user_id) {
            return redirect()->route('admin.guru')->with('error', 'Guru ' . $guru->nama . ' sudah memiliki akun user!');
        }
        
        // Tentukan role berdasarkan apakah wali kelas atau bukan
        $role = $guru->wali_kelas ? 'wali_kelas' : 'guru';
        
        // Buat user baru
        $user = \App\Models\User::create([
            'name' => $guru->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $role
        ]);
        
        // Update guru dengan user_id
        $guru->user_id = $user->id;
        $guru->save();
        
        $roleText = $guru->wali_kelas ? 'wali kelas ' . $guru->wali_kelas : 'guru';
        return redirect()->route('admin.guru')->with('success', 'Akun user berhasil dibuat untuk ' . $roleText . ' ' . $guru->nama . ' dengan username: ' . $request->username);
    }
    
    public function createSiswaUser(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);
        
        $siswa = Siswa::findOrFail($request->siswa_id);
        
        // Cek apakah siswa sudah memiliki user
        if ($siswa->user_id) {
            return redirect()->route('admin.siswa')->with('error', 'Siswa ' . $siswa->nama . ' sudah memiliki akun user!');
        }
        
        // Buat user baru
        $user = \App\Models\User::create([
            'name' => $siswa->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'siswa'
        ]);
        
        // Update siswa dengan user_id
        $siswa->user_id = $user->id;
        $siswa->save();
        
        return redirect()->route('admin.siswa')->with('success', 'Akun user berhasil dibuat untuk siswa ' . $siswa->nama . ' dengan username: ' . $request->username);
    }
    
    public function pelaksanaanSanksi()
    {
        $pelaksanaanSanksi = \App\Models\PelaksanaanSanksi::with('siswa')
            ->orderBy('created_at', 'desc')
            ->get();
            
        $sanksiDalamProses = \App\Models\PelaksanaanSanksi::where('status', 'dalam_proses')->count();
        $sanksiSelesai = \App\Models\PelaksanaanSanksi::where('status', 'selesai')->count();
        
        return view('admin.pelaksanaan-sanksi', compact('pelaksanaanSanksi', 'sanksiDalamProses', 'sanksiSelesai'));
    }
    
    public function selesaiSanksi(Request $request)
    {
        $validated = $request->validate([
            'sanksi_id' => 'required|exists:pelaksanaan_sanksi,id',
            'bukti_pelaksanaan' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string|max:500'
        ]);
        
        $sanksi = \App\Models\PelaksanaanSanksi::findOrFail($request->sanksi_id);
        
        // Handle upload bukti pelaksanaan
        $buktiPelaksanaan = null;
        if ($request->hasFile('bukti_pelaksanaan')) {
            $file = $request->file('bukti_pelaksanaan');
            $filename = time() . '_sanksi_' . $sanksi->siswa->nis . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/bukti_sanksi'), $filename);
            $buktiPelaksanaan = 'storage/bukti_sanksi/' . $filename;
        }
        
        // Update sanksi menjadi selesai
        $sanksi->update([
            'status' => 'selesai',
            'tanggal_selesai' => now(),
            'bukti_pelaksanaan' => $buktiPelaksanaan,
            'catatan' => $request->catatan
        ]);
        
        // Update status pelanggaran menjadi selesai dan reset poin siswa
        Pelanggaran::where('siswa_id', $sanksi->siswa_id)
                  ->where('status', 'dalam_sanksi')
                  ->update(['status' => 'selesai']);
        
        $sanksi->siswa->poin_pelanggaran = 0;
        $sanksi->siswa->save();
        
        $redirectRoute = auth()->user()->role === 'kesiswaan' ? 'kesiswaan.pelaksanaan-sanksi' : 'admin.pelaksanaan-sanksi';
        return redirect()->route($redirectRoute)->with('success', 'Sanksi untuk ' . $sanksi->siswa->nama . ' telah selesai dilaksanakan.');
    }
    
    public function getPelaksanaanSanksiData()
    {
        $pelaksanaanSanksi = \App\Models\PelaksanaanSanksi::with('siswa')
            ->where('status', 'dalam_proses')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json([
            'pelaksanaan_sanksi' => $pelaksanaanSanksi
        ]);
    }
    
    public function getPrestasiVerifikasi()
    {
        $prestasi = PrestasiSiswa::where('status', 'menunggu_verifikasi')
            ->with(['siswa', 'prestasi', 'user', 'pengadu'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json([
            'prestasi' => $prestasi
        ]);
    }
    
    public function getPrestasiSelesai()
    {
        $prestasi = PrestasiSiswa::where('status', 'diverifikasi')
            ->with(['siswa', 'prestasi', 'user', 'pengadu'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json([
            'prestasi' => $prestasi
        ]);
    }
    
    public function getGuruWithoutAccount()
    {
        $guru = \App\Models\Guru::whereNull('user_id')
            ->whereNull('wali_kelas')
            ->orderBy('nama')
            ->get(['id', 'nama', 'nip', 'jabatan']);
            
        return response()->json($guru);
    }
    
    public function getWaliKelasWithoutAccount()
    {
        $waliKelas = \App\Models\Guru::whereNull('user_id')
            ->whereNotNull('wali_kelas')
            ->orderBy('nama')
            ->get(['id', 'nama', 'nip', 'wali_kelas']);
            
        return response()->json($waliKelas);
    }
    
    public function getSiswaWithoutAccount()
    {
        $siswa = Siswa::whereNull('user_id')
            ->orderBy('nama')
            ->get(['id', 'nama', 'nis', 'kelas']);
            
        return response()->json($siswa);
    }
    
    public function checkSingleRoleAccounts()
    {
        $kepalaSekolahExists = \App\Models\User::where('role', 'kepala_sekolah')->exists();
        $kesiswaanExists = \App\Models\User::where('role', 'kesiswaan')->exists();
        
        // Get names from pengajar table
        $kepalaSekolahName = null;
        $kesiswaanName = null;
        
        if (!$kepalaSekolahExists) {
            $kepalaSekolah = \App\Models\Guru::where('jabatan', 'kepala_sekolah')->first();
            $kepalaSekolahName = $kepalaSekolah ? $kepalaSekolah->nama : null;
        }
        
        if (!$kesiswaanExists) {
            $kesiswaan = \App\Models\Guru::where('jabatan', 'kesiswaan')->first();
            $kesiswaanName = $kesiswaan ? $kesiswaan->nama : null;
        }
        
        return response()->json([
            'kepala_sekolah_exists' => $kepalaSekolahExists,
            'kesiswaan_exists' => $kesiswaanExists,
            'kepala_sekolah_name' => $kepalaSekolahName,
            'kesiswaan_name' => $kesiswaanName
        ]);
    }
    
    public function getTidakTerverifikasi()
    {
        $pelanggaranDitolak = Pelanggaran::where('status', 'ditolak')
            ->with(['siswa', 'jenisPelanggaran', 'user', 'pengadu', 'verifikator'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        $prestasiDitolak = PrestasiSiswa::where('status', 'ditolak')
            ->with(['siswa', 'prestasi', 'user', 'pengadu', 'verifikator'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json([
            'pelanggaran' => $pelanggaranDitolak,
            'prestasi' => $prestasiDitolak
        ]);
    }
    
    public function selesai()
    {
        return view('admin.selesai');
    }
    

    
    public function deleteUser($id)
    {
        $user = \App\Models\User::findOrFail($id);
        
        // Prevent deleting admin accounts
        if ($user->role === 'admin') {
            return response()->json(['error' => 'Cannot delete admin account'], 403);
        }
        
        // Update related records to remove user_id reference
        if ($user->role === 'guru') {
            \App\Models\Guru::where('user_id', $user->id)->update(['user_id' => null]);
        } elseif ($user->role === 'siswa') {
            \App\Models\Siswa::where('user_id', $user->id)->update(['user_id' => null]);
        }
        
        $user->delete();
        
        return response()->json(['success' => true]);
    }
    
    public function searchGuru(Request $request)
    {
        $search = $request->get('search');
        
        if (!$search) {
            return response()->json(['guru' => [], 'total' => 0]);
        }
        
        $guru = \App\Models\Guru::where(function($query) use ($search) {
            $query->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nip', 'like', '%' . $search . '%')
                  ->orWhere('mata_pelajaran', 'like', '%' . $search . '%');
        })
        ->orderByRaw("CASE 
            WHEN jabatan = 'kepala_sekolah' THEN 1 
            WHEN jabatan = 'kesiswaan' THEN 2 
            WHEN jabatan = 'guru_bk' THEN 3 
            ELSE 4 
        END")
        ->orderBy('nama')
        ->get();
        
        return response()->json([
            'guru' => $guru,
            'total' => $guru->count()
        ]);
    }
    
    public function filterSiswaPrestasi(Request $request)
    {
        $search = $request->get('search');
        
        $query = Siswa::where('poin_prestasi', '>', 0)
            ->with(['prestasiSiswa' => function($q) {
                $q->where('status', 'diverifikasi');
            }]);
        
        if ($search && trim($search) !== '') {
            $searchTerm = trim($search);
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('nis', 'LIKE', '%' . $searchTerm . '%');
            });
        }
        
        $siswa = $query->orderBy('poin_prestasi', 'desc')->get();
        
        return response()->json([
            'siswa' => $siswa,
            'search_term' => $search,
            'count' => $siswa->count()
        ]);
    }
    
    public function orangTua(Request $request)
    {
        $siswa = Siswa::with('orangTua')->orderBy('nama')->get();
        $totalSiswa = $siswa->count();
        $siswaWithOrangTua = $siswa->whereNotNull('orang_tua')->count();
        $siswaWithoutOrangTua = $totalSiswa - $siswaWithOrangTua;
        
        $isKesiswaan = $request->route()->getName() === 'kesiswaan.orang-tua';
        
        return view('admin.orang-tua', compact('siswa', 'totalSiswa', 'siswaWithOrangTua', 'siswaWithoutOrangTua', 'isKesiswaan'));
    }
    
    public function kelolaOrangTua(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'pekerjaan_ibu' => 'nullable|string|max:255',
        ]);
        
        $siswa = Siswa::findOrFail($request->siswa_id);
        
        // Update alamat siswa sama dengan orang tua
        $siswa->update(['alamat' => $validated['alamat']]);
        
        \App\Models\OrangTua::updateOrCreate(
            ['siswa_id' => $siswa->id],
            $validated
        );
        
        $redirectRoute = auth()->user()->role === 'kesiswaan' ? 'kesiswaan.orang-tua' : 'admin.orang-tua';
        return redirect()->route($redirectRoute)->with('success', 'Data orang tua ' . $siswa->nama . ' berhasil disimpan.');
    }
    
    public function getOrangTua($siswaId)
    {
        $siswa = Siswa::with('orangTua')->findOrFail($siswaId);
        return response()->json($siswa);
    }
    
    public function getSiswaDetail($siswaId)
    {
        $siswa = Siswa::with('orangTua')->findOrFail($siswaId);
        return response()->json($siswa);
    }
    
    public function getOrangTuaWithoutAccount()
    {
        $orangTua = \App\Models\OrangTua::with('siswa')
            ->whereDoesntHave('siswa.user', function($query) {
                $query->where('role', 'orang_tua');
            })
            ->orderBy('nama_ayah')
            ->get(['id', 'siswa_id', 'nama_ayah', 'nama_ibu']);
            
        return response()->json($orangTua);
    }
    
    public function getSiswaWithAccount()
    {
        $siswa = Siswa::whereNotNull('user_id')
            ->whereNull('orang_tua_user_id')
            ->with('orangTua')
            ->orderBy('nama')
            ->get(['id', 'nama', 'nis', 'kelas']);
            
        return response()->json($siswa);
    }
    
    public function verifikasiUser()
    {
        $unverifiedUsers = \App\Models\User::where('is_verified', false)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('admin.verifikasi-user', compact('unverifiedUsers'));
    }
    
    public function approveUser(Request $request)
    {
        $user = \App\Models\User::findOrFail($request->user_id);
        $user->update([
            'is_verified' => true,
            'verified_at' => now(),
            'verified_by' => auth()->id()
        ]);
        
        return redirect()->route('admin.verifikasi-user')->with('success', 'User ' . $user->name . ' berhasil diverifikasi!');
    }
    
    public function rejectUser(Request $request)
    {
        $user = \App\Models\User::findOrFail($request->user_id);
        $user->delete();
        
        return redirect()->route('admin.verifikasi-user')->with('success', 'User ' . $user->name . ' berhasil ditolak dan dihapus!');
    }
    
    public function checkUsername($username)
    {
        $exists = \App\Models\User::where('username', $username)->exists();
        return response()->json(['available' => !$exists]);
    }
    
    public function backup()
    {
        return view('admin.backup');
    }
    
    public function downloadBackup()
    {
        $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        $tempFile = storage_path('app/' . $filename);
        
        // Ensure directory exists
        $directory = dirname($tempFile);
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        
        // Use full path to mysqldump for Windows XAMPP
        $mysqldumpPath = 'C:\xampp\mysql\bin\mysqldump.exe';
        if (!file_exists($mysqldumpPath)) {
            $mysqldumpPath = 'mysqldump'; // fallback to system PATH
        }
        
        $command = sprintf(
            '"%s" --user=%s --password=%s --host=%s --single-transaction --routines --triggers %s > "%s"',
            $mysqldumpPath,
            config('database.connections.mysql.username'),
            config('database.connections.mysql.password'),
            config('database.connections.mysql.host'),
            config('database.connections.mysql.database'),
            $tempFile
        );
        
        exec($command, $output, $returnCode);
        
        if ($returnCode === 0 && file_exists($tempFile) && filesize($tempFile) > 0) {
            // Record backup history
            \App\Models\BackupHistory::create([
                'filename' => $filename,
                'type' => 'manual',
                'file_size' => filesize($tempFile),
                'created_by' => auth()->user()->name,
                'created_at' => now()
            ]);
            
            return response()->download($tempFile)->deleteFileAfterSend(true);
        }
        
        // Clean up failed backup file
        if (file_exists($tempFile)) {
            unlink($tempFile);
        }
        
        return redirect()->route('admin.backup')->with('error', 'Gagal membuat backup database. Pastikan MySQL tersedia dan konfigurasi database benar.');
    }
    
    public function updateBackupSettings(Request $request)
    {
        $request->validate([
            'backup_frequency' => 'required|in:daily,weekly,monthly',
            'backup_time' => 'required|date_format:H:i',
            'keep_backups' => 'required|integer|min:1|max:30'
        ]);
        
        // Handle checkbox properly - if checked it will be '1', if unchecked it won't be in request
        $autoBackupEnabled = $request->has('auto_backup_enabled') && $request->input('auto_backup_enabled') === '1';
        
        $settings = \App\Models\BackupSetting::getSettings();
        $settings->update([
            'auto_backup_enabled' => $autoBackupEnabled,
            'backup_frequency' => $request->backup_frequency,
            'backup_time' => $request->backup_time,
            'keep_backups' => $request->keep_backups
        ]);
        
        $status = $autoBackupEnabled ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('admin.backup')->with('success', "Pengaturan backup berhasil disimpan. Backup otomatis {$status}.");
    }
    
    public function getBackupHistory()
    {
        try {
            $backups = \App\Models\BackupHistory::orderBy('created_at', 'desc')->get();
            
            return response()->json($backups->map(function($backup) {
                return [
                    'filename' => $backup->filename,
                    'type' => $backup->type,
                    'file_size' => $backup->file_size,
                    'created_by' => $backup->created_by,
                    'created_at' => $backup->created_at->setTimezone('Asia/Jakarta')->format('d/m/Y H:i:s')
                ];
            }));
        } catch (\Exception $e) {
            \Log::error('Error loading backup history: ' . $e->getMessage());
            return response()->json([]);
        }
    }
    
    public function downloadBackupFile($filename)
    {
        // Check if file exists in backup history
        $backup = \App\Models\BackupHistory::where('filename', $filename)->first();
        if (!$backup) {
            return redirect()->route('admin.backup')->with('error', 'File backup tidak ditemukan.');
        }
        
        $filepath = $backup->type === 'automatic' 
            ? storage_path('app/backups/' . $filename)
            : storage_path('app/' . $filename);
        
        if (file_exists($filepath)) {
            return response()->download($filepath);
        }
        
        return redirect()->route('admin.backup')->with('error', 'File backup tidak ditemukan.');
    }
    
    public function deleteBackup(Request $request)
    {
        $request->validate([
            'filename' => 'required|string',
            'password' => 'required|string'
        ]);
        
        // Verify admin password
        if (!\Hash::check($request->password, auth()->user()->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password admin salah!'
            ]);
        }
        
        // Find backup in history
        $backup = \App\Models\BackupHistory::where('filename', $request->filename)->first();
        if (!$backup) {
            return response()->json([
                'success' => false,
                'message' => 'File backup tidak ditemukan dalam riwayat.'
            ]);
        }
        
        // Determine file path
        $filepath = $backup->type === 'automatic' 
            ? storage_path('app/backups/' . $request->filename)
            : storage_path('app/' . $request->filename);
        
        // Delete physical file
        if (file_exists($filepath)) {
            unlink($filepath);
        }
        
        // Delete from backup history
        $backup->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Backup berhasil dihapus.'
        ]);
    }
    
    public function verifikasiLaporanRequest()
    {
        $requests = LaporanRequest::where('status', 'pending')
                                 ->with(['siswa', 'user'])
                                 ->orderBy('created_at', 'desc')
                                 ->get();
        
        return view('admin.verifikasi-laporan', compact('requests'));
    }
    
    public function approveLaporan($id)
    {
        $request = LaporanRequest::findOrFail($id);
        $request->update([
            'status' => 'approved',
            'verifikator_id' => auth()->id(),
            'verified_at' => now()
        ]);
        
        return redirect()->back()->with('success', 'Request laporan disetujui.');
    }
    
    public function rejectLaporan(Request $request, $id)
    {
        $laporanRequest = LaporanRequest::findOrFail($id);
        $laporanRequest->update([
            'status' => 'rejected',
            'verifikator_id' => auth()->id(),
            'verified_at' => now(),
            'alasan_tolak' => $request->alasan_tolak
        ]);
        
        return redirect()->back()->with('success', 'Request laporan ditolak.');
    }
    
    public function inputBk()
    {
        $guruBk = \App\Models\Guru::where('jabatan', 'guru_bk')
                                  ->whereNotNull('user_id')
                                  ->get();
        $siswaList = \App\Models\Siswa::orderBy('nama')->get();
        $kelasList = \App\Models\Siswa::distinct()->pluck('kelas')->sort()->values();
        
        return view('admin.input-bk', compact('guruBk', 'siswaList', 'kelasList'));
    }
    
    public function storeBk(Request $request)
    {
        $request->validate([
            'guru_bk_id' => 'required|exists:guru,id',
            'siswa_id' => 'required|exists:siswa,id',
            'alasan' => 'required|string|max:500',
            'jadwal_bk' => 'required|date|after:now'
        ]);
        
        $guruBk = \App\Models\Guru::findOrFail($request->guru_bk_id);
        $siswa = \App\Models\Siswa::findOrFail($request->siswa_id);
        
        // Pastikan guru yang dipilih adalah guru BK dan punya akun
        if ($guruBk->jabatan !== 'guru_bk' || !$guruBk->user_id) {
            return redirect()->back()->with('error', 'Guru yang dipilih bukan guru BK atau belum memiliki akun!');
        }
        
        // Buat sesi BK
        $bkSession = \App\Models\BkSession::create([
            'siswa_id' => $request->siswa_id,
            'guru_bk_id' => $request->guru_bk_id,
            'jenis' => 'panggilan_bk',
            'alasan' => $request->alasan,
            'status' => 'dijadwalkan',
            'jadwal_bk' => $request->jadwal_bk
        ]);
        
        // Buat notifikasi untuk siswa
        if ($siswa->user_id) {
            \App\Models\BkNotification::create([
                'user_id' => $siswa->user_id,
                'bk_session_id' => $bkSession->id,
                'title' => 'Panggilan BK',
                'message' => "Anda dipanggil untuk sesi BK pada " . date('d/m/Y H:i', strtotime($request->jadwal_bk)) . " dengan " . $guruBk->nama,
                'type' => 'panggilan'
            ]);
        }
        
        // Buat notifikasi untuk guru BK
        \App\Models\BkNotification::create([
            'user_id' => $guruBk->user_id,
            'bk_session_id' => $bkSession->id,
            'title' => 'Siswa Dipanggil BK',
            'message' => "Admin telah menjadwalkan sesi BK dengan {$siswa->nama} pada " . date('d/m/Y H:i', strtotime($request->jadwal_bk)),
            'type' => 'panggilan'
        ]);
        
        return redirect()->route('admin.input-bk')->with('success', "Siswa {$siswa->nama} berhasil dipanggil untuk sesi BK dengan {$guruBk->nama}");
    }
}