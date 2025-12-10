<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Pelanggaran;
use App\Models\PrestasiSiswa;
use App\Models\BkSession;
use App\Models\BkNotification;
use App\Models\Guru;
use Barryvdh\DomPDF\Facade\Pdf;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $siswa = Siswa::where('user_id', auth()->id())->first();
        
        if (!$siswa) {
            return redirect()->route('login')->with('error', 'Data siswa tidak ditemukan.');
        }
        
        $totalPelanggaran = Pelanggaran::where('siswa_id', $siswa->id)->where('status', '!=', 'ditolak')->count();
        $totalPrestasi = PrestasiSiswa::where('siswa_id', $siswa->id)->where('status', 'diverifikasi')->count();
        $poinPelanggaran = $siswa->poin_pelanggaran;
        $poinPrestasi = $siswa->poin_prestasi ?? 0;
        
        return view('siswa.dashboard', compact('siswa', 'totalPelanggaran', 'totalPrestasi', 'poinPelanggaran', 'poinPrestasi'));
    }
    
    public function prestasi()
    {
        $siswa = Siswa::where('user_id', auth()->id())->first();
        
        if (!$siswa) {
            return redirect()->route('login')->with('error', 'Data siswa tidak ditemukan.');
        }
        
        $prestasi = PrestasiSiswa::where('siswa_id', $siswa->id)
            ->where('status', '!=', 'ditolak')
            ->with(['prestasi', 'user', 'verifikator'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('siswa.prestasi', compact('siswa', 'prestasi'));
    }
    
    public function pelanggaran()
    {
        $siswa = Siswa::where('user_id', auth()->id())->first();
        
        if (!$siswa) {
            return redirect()->route('login')->with('error', 'Data siswa tidak ditemukan.');
        }
        
        $pelanggaran = Pelanggaran::where('siswa_id', $siswa->id)
            ->where('status', '!=', 'ditolak')
            ->with(['jenisPelanggaran', 'user', 'verifikator'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        // Cek apakah ada sanksi selesai untuk siswa ini
        $adaSanksiSelesai = \App\Models\PelaksanaanSanksi::where('siswa_id', $siswa->id)
            ->where('status', 'selesai')
            ->exists();
            
        foreach ($pelanggaran as $p) {
            $p->sanksi_selesai = $adaSanksiSelesai;
        }
            
        return view('siswa.pelanggaran', compact('siswa', 'pelanggaran'));
    }
    
    public function profile()
    {
        $siswa = Siswa::where('user_id', auth()->id())->with('orangTua')->first();
        
        if (!$siswa) {
            return redirect()->route('login')->with('error', 'Data siswa tidak ditemukan.');
        }
        
        return view('siswa.profile', compact('siswa'));
    }
    
    public function exportLaporan()
    {
        $siswa = Siswa::where('user_id', auth()->id())->first();
        
        if (!$siswa) {
            return redirect()->route('login')->with('error', 'Data siswa tidak ditemukan.');
        }
        
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
        
        $pdf = Pdf::loadView('siswa.export-laporan', compact('siswa', 'pelanggaran', 'prestasi', 'sanksi'));
        return $pdf->download('laporan-siswa-' . $siswa->nama . '.pdf');
    }
    
    public function bk()
    {
        $siswa = Siswa::where('user_id', auth()->id())->first();
        
        if (!$siswa) {
            return redirect()->route('login')->with('error', 'Data siswa tidak ditemukan.');
        }
        
        $bkSessions = BkSession::where('siswa_id', $siswa->id)
            ->with('guruBk')
            ->orderBy('created_at', 'desc')
            ->get();
            
        $notifications = BkNotification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->whereHas('bkSession', function($query) {
                $query->where('jenis', 'panggilan_bk');
            })
            ->with('bkSession.guruBk')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $guruBkList = Guru::whereHas('user', function($query) {
            $query->where('role', 'bk');
        })->get();
            
        return view('siswa.bk', compact('siswa', 'bkSessions', 'notifications', 'guruBkList'));
    }
    
    public function ajukanBimbingan(Request $request)
    {
        try {
            $request->validate([
                'guru_bk_id' => 'required|exists:guru,id',
                'tujuan_bimbingan' => 'required|string',
                'tujuan_lainnya' => 'nullable|string|max:200',
                'alasan' => 'required|string|max:500',
                'tanggal_bimbingan' => 'required|date',
                'jam_bimbingan' => 'required'
            ]);
        
        $siswa = Siswa::where('user_id', auth()->id())->first();
        
        if (!$siswa) {
            return response()->json(['error' => 'Data siswa tidak ditemukan'], 404);
        }
        
        $guruBk = Guru::findOrFail($request->guru_bk_id);
        
        $tujuan = $request->tujuan_bimbingan === 'Lainnya' ? $request->tujuan_lainnya : $request->tujuan_bimbingan;
        
        $bkSession = BkSession::create([
            'siswa_id' => $siswa->id,
            'guru_bk_id' => $request->guru_bk_id,
            'jenis' => 'pengajuan_siswa',
            'tujuan_bimbingan' => $tujuan,
            'alasan' => $request->alasan,
            'jadwal_bk' => $request->tanggal_bimbingan . ' ' . $request->jam_bimbingan,
            'jam_bimbingan' => $request->jam_bimbingan,
            'status' => 'pending',
            'respon_siswa' => 'menunggu'
        ]);
        
        // Notifikasi ke BK
        BkNotification::create([
            'user_id' => $guruBk->user_id,
            'bk_session_id' => $bkSession->id,
            'title' => 'Pengajuan Bimbingan Baru',
            'message' => "Siswa {$siswa->nama} ({$siswa->nis}) mengajukan bimbingan. Tujuan: {$tujuan}",
            'type' => 'pengajuan'
        ]);
        
        // Notifikasi ke Admin
        $admin = \App\Models\User::where('role', 'admin')->first();
        if ($admin) {
            BkNotification::create([
                'user_id' => $admin->id,
                'bk_session_id' => $bkSession->id,
                'title' => 'Pengajuan Bimbingan Baru',
                'message' => "Siswa {$siswa->nama} ({$siswa->nis}) mengajukan bimbingan. Tujuan: {$tujuan}",
                'type' => 'pengajuan'
            ]);
        }
        
            return response()->json(['success' => true, 'message' => 'Pengajuan bimbingan berhasil dikirim']);
        } catch (\Exception $e) {
            \Log::error('Error ajukan bimbingan: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
    
    public function responBk(Request $request, $id)
    {
        $request->validate([
            'respon' => 'required|in:diterima,ditolak',
            'alasan' => 'required_if:respon,ditolak|string|max:500'
        ]);
        
        $siswa = Siswa::where('user_id', auth()->id())->first();
        
        if (!$siswa) {
            return response()->json(['error' => 'Data siswa tidak ditemukan'], 404);
        }
        
        $bkSession = BkSession::where('id', $id)
            ->where('siswa_id', $siswa->id)
            ->firstOrFail();
        
        $bkSession->update([
            'respon_siswa' => $request->respon,
            'alasan_siswa' => $request->alasan ?? null
        ]);
        
        // Load relasi setelah update
        $bkSession->load('guruBk');
        
        // Kirim notifikasi ke guru BK
        if ($bkSession->guruBk && $bkSession->guruBk->user_id) {
            $message = $request->respon === 'diterima' 
                ? "Siswa {$siswa->nama} menerima panggilan BK" 
                : "Siswa {$siswa->nama} menolak panggilan BK. Alasan: " . ($request->alasan ?? '-');
            
            BkNotification::create([
                'user_id' => $bkSession->guruBk->user_id,
                'bk_session_id' => $bkSession->id,
                'title' => $request->respon === 'diterima' ? 'Panggilan BK Diterima' : 'Panggilan BK Ditolak',
                'message' => $message,
                'type' => 'respon_siswa'
            ]);
        }
        
        return response()->json(['success' => true, 'message' => 'Respon berhasil dikirim']);
    }
    
    public function markBkNotificationRead($id)
    {
        $notification = BkNotification::where('user_id', auth()->id())->findOrFail($id);
        $notification->update(['is_read' => true]);
        
        return response()->json(['success' => true]);
    }

    public function exportBk()
    {
        $siswa = Siswa::where('user_id', auth()->id())->first();
        
        if (!$siswa) {
            return redirect()->route('login')->with('error', 'Data siswa tidak ditemukan.');
        }
        
        $bkSessions = BkSession::where('siswa_id', $siswa->id)
            ->with('guruBk')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $pdf = Pdf::loadView('siswa.export-bk', compact('siswa', 'bkSessions'));
        return $pdf->download('laporan-bk-' . $siswa->nama . '.pdf');
    }
}