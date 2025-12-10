<?php

namespace App\Http\Controllers;

use App\Models\BkSession;
use App\Models\BkNotification;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class BkController extends Controller
{
    public function index()
    {
        $guru = Auth::user()->guru;
        $pendingSessions = BkSession::where('guru_bk_id', $guru->id)
            ->where('status', 'pending')
            ->with('siswa')
            ->count();
        
        $todaySessions = BkSession::where('guru_bk_id', $guru->id)
            ->whereDate('jadwal_bk', today())
            ->where('status', 'dijadwalkan')
            ->count();
        
        $completedSessions = BkSession::where('guru_bk_id', $guru->id)
            ->where('status', 'selesai')
            ->count();

        $riwayatSessions = BkSession::where('guru_bk_id', $guru->id)
            ->whereIn('status', ['selesai', 'dibatalkan'])
            ->with('siswa')
            ->orderBy('updated_at', 'desc')
            ->limit(20)
            ->get();

        return view('bk.dashboard', compact('pendingSessions', 'todaySessions', 'completedSessions', 'riwayatSessions'));
    }

    public function inputBk(Request $request)
    {
        $search = $request->get('search');
        $kelas = $request->get('kelas');
        $jurusan = $request->get('jurusan');
        
        $query = Siswa::with('user');
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nis', 'like', '%' . $search . '%');
            });
        }
        
        if ($kelas) {
            $query->where('kelas', 'like', '%' . $kelas . '%');
        }
        
        if ($jurusan) {
            $query->where('jurusan', $jurusan);
        }
        
        $siswaList = $query->orderBy('nama')->get();
        $kelasList = Siswa::select('kelas')->distinct()->orderBy('kelas')->pluck('kelas');
        $jurusanList = Siswa::select('jurusan')->distinct()->orderBy('jurusan')->pluck('jurusan');
        
        return view('bk.input', compact('siswaList', 'kelasList', 'jurusanList', 'search', 'kelas', 'jurusan'));
    }

    public function storeBk(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'alasan' => 'required|string',
            'jadwal_bk' => 'required|date|after:now'
        ]);

        $guru = Auth::user()->guru;
        
        $siswa = Siswa::with('user')->findOrFail($request->siswa_id);
        
        if (!$siswa->user_id) {
            return redirect()->back()->with('error', 'Siswa belum memiliki akun user.');
        }
        
        $bkSession = BkSession::create([
            'siswa_id' => $request->siswa_id,
            'guru_bk_id' => $guru->id,
            'jenis' => 'panggilan_bk',
            'alasan' => $request->alasan,
            'status' => 'dijadwalkan',
            'jadwal_bk' => $request->jadwal_bk
        ]);

        // Buat notifikasi untuk siswa yang dipanggil
        BkNotification::create([
            'user_id' => $siswa->user_id,
            'bk_session_id' => $bkSession->id,
            'title' => 'Panggilan BK',
            'message' => "Anda dipanggil untuk sesi BK pada " . date('d/m/Y H:i', strtotime($request->jadwal_bk)) . ". Alasan: {$request->alasan}",
            'type' => 'panggilan'
        ]);

        return redirect()->route('bk.index')->with('success', 'Panggilan BK berhasil dibuat');
    }

    public function notifications()
    {
        $guru = Auth::user()->guru;
        $notifications = BkNotification::where('user_id', Auth::id())
            ->with(['bkSession.siswa'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('bk.notifications', compact('notifications'));
    }

    public function confirmSession(Request $request, $id)
    {
        $bkSession = BkSession::with('siswa')->findOrFail($id);
        
        $request->validate([
            'jadwal_bk' => 'required|date|after:now',
            'catatan_bk' => 'nullable|string'
        ]);

        $bkSession->update([
            'status' => 'dijadwalkan',
            'jadwal_bk' => $request->jadwal_bk,
            'catatan_bk' => $request->catatan_bk
        ]);

        // Kirim notifikasi konfirmasi ke siswa
        if ($bkSession->siswa && $bkSession->siswa->user_id) {
            BkNotification::create([
                'user_id' => $bkSession->siswa->user_id,
                'bk_session_id' => $bkSession->id,
                'title' => 'Konfirmasi Jadwal BK',
                'message' => "Jadwal BK Anda dikonfirmasi pada " . date('d/m/Y H:i', strtotime($request->jadwal_bk)) . ". Catatan: " . ($request->catatan_bk ?? '-'),
                'type' => 'konfirmasi'
            ]);
        }

        return redirect()->back()->with('success', 'Sesi BK berhasil dikonfirmasi');
    }

    public function completeSession(Request $request, $id)
    {
        $bkSession = BkSession::with('siswa')->findOrFail($id);
        
        $request->validate([
            'hasil_bk' => 'required|string'
        ]);

        $bkSession->update([
            'status' => 'selesai',
            'hasil_bk' => $request->hasil_bk
        ]);

        // Kirim notifikasi selesai ke siswa
        if ($bkSession->siswa && $bkSession->siswa->user_id) {
            BkNotification::create([
                'user_id' => $bkSession->siswa->user_id,
                'bk_session_id' => $bkSession->id,
                'title' => 'Sesi BK Selesai',
                'message' => "Sesi BK Anda telah selesai dilaksanakan. Hasil: " . substr($request->hasil_bk, 0, 100) . (strlen($request->hasil_bk) > 100 ? '...' : ''),
                'type' => 'selesai'
            ]);
        }

        return redirect()->back()->with('success', 'Sesi BK berhasil diselesaikan');
    }

    public function exportLaporan()
    {
        $guru = Auth::user()->guru;
        $sessions = BkSession::where('guru_bk_id', $guru->id)
            ->where('status', 'selesai')
            ->with('siswa')
            ->orderBy('jadwal_bk', 'desc')
            ->get();

        $pdf = Pdf::loadView('bk.laporan-pdf', compact('sessions', 'guru'));
        return $pdf->download('laporan-bk-' . date('Y-m-d') . '.pdf');
    }

    public function markNotificationRead($id)
    {
        $notification = BkNotification::findOrFail($id);
        $notification->update(['is_read' => true]);
        
        return response()->json(['success' => true]);
    }
    

    
    public function rejectSession($id)
    {
        $bkSession = BkSession::with('siswa')->findOrFail($id);
        $bkSession->update(['status' => 'dibatalkan']);
        
        // Kirim notifikasi penolakan ke siswa
        if ($bkSession->siswa && $bkSession->siswa->user_id) {
            BkNotification::create([
                'user_id' => $bkSession->siswa->user_id,
                'bk_session_id' => $bkSession->id,
                'title' => 'Pengajuan BK Ditolak',
                'message' => "Pengajuan BK Anda ditolak oleh guru BK. Silakan hubungi guru BK untuk informasi lebih lanjut.",
                'type' => 'konfirmasi'
            ]);
        }
        
        return response()->json(['success' => true]);
    }
    
    public function approvePengajuan(Request $request, $id)
    {
        try {
            $request->validate([
                'jadwal_bk' => 'required|date'
            ]);
            
            $bkSession = BkSession::with('siswa')->findOrFail($id);
            $bkSession->update([
                'status' => 'dijadwalkan',
                'jadwal_bk' => $request->jadwal_bk
            ]);
            
            // Notifikasi ke siswa
            if ($bkSession->siswa && $bkSession->siswa->user_id) {
                BkNotification::create([
                    'user_id' => $bkSession->siswa->user_id,
                    'bk_session_id' => $bkSession->id,
                    'title' => 'Pengajuan Bimbingan Disetujui',
                    'message' => "Pengajuan bimbingan Anda disetujui. Jadwal: " . date('d/m/Y H:i', strtotime($request->jadwal_bk)),
                    'type' => 'konfirmasi'
                ]);
            }
            
            return response()->json(['success' => true, 'message' => 'Pengajuan berhasil disetujui']);
        } catch (\Exception $e) {
            \Log::error('Error approve pengajuan: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    public function rejectPengajuan(Request $request, $id)
    {
        $bkSession = BkSession::with('siswa')->findOrFail($id);
        $bkSession->update(['status' => 'dibatalkan']);
        
        // Notifikasi ke siswa
        if ($bkSession->siswa && $bkSession->siswa->user_id) {
            BkNotification::create([
                'user_id' => $bkSession->siswa->user_id,
                'bk_session_id' => $bkSession->id,
                'title' => 'Pengajuan Bimbingan Ditolak',
                'message' => "Pengajuan bimbingan Anda ditolak. Silakan hubungi guru BK untuk informasi lebih lanjut.",
                'type' => 'konfirmasi'
            ]);
        }
        
        return response()->json(['success' => true]);
    }
    
    public function getPengajuan()
    {
        $guru = Auth::user()->guru;
        $pengajuan = BkSession::where('guru_bk_id', $guru->id)
            ->where('status', 'pending')
            ->where('jenis', 'pengajuan_siswa')
            ->with('siswa')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json($pengajuan);
    }
    
    public function getSiswa(Request $request)
    {
        $search = $request->get('search');
        $kelas = $request->get('kelas');
        $jurusan = $request->get('jurusan');
        
        $query = Siswa::query();
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nis', 'like', '%' . $search . '%');
            });
        }
        
        if ($kelas) {
            $query->where('kelas', 'like', '%' . $kelas . '%');
        }
        
        if ($jurusan) {
            $query->where('jurusan', $jurusan);
        }
        
        $siswa = $query->orderBy('nama')->get(['id', 'nama', 'kelas', 'nis']);
        
        return response()->json($siswa);
    }

    public function riwayat(Request $request)
    {
        $guru = Auth::user()->guru;
        $search = $request->get('search');
        $status = $request->get('status');
        
        $query = BkSession::where('guru_bk_id', $guru->id)
            ->whereIn('status', ['selesai', 'dibatalkan'])
            ->with('siswa');
        
        if ($search) {
            $query->whereHas('siswa', function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nis', 'like', '%' . $search . '%');
            });
        }
        
        if ($status) {
            $query->where('status', $status);
        }
        
        $riwayatSessions = $query->orderBy('updated_at', 'desc')->paginate(24);
        
        return view('bk.riwayat', compact('riwayatSessions', 'search', 'status'));
    }
}