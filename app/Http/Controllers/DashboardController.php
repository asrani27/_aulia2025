<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\TimAudit;
use App\Models\JadwalAudit;
use App\Models\Pemeriksaan;
use App\Models\TindakLanjut;

class DashboardController extends Controller
{
    public function index()
    {
        // Get counts for each module
        $data = [
            'totalUsers' => User::count(),
            'totalPegawai' => Pegawai::count(),
            'totalTimAudit' => TimAudit::count(),
            'totalJadwalAudit' => JadwalAudit::count(),
            'totalPemeriksaan' => Pemeriksaan::count(),
            'totalTindakLanjut' => TindakLanjut::count(),
            
            // Get recent data
            'recentPegawai' => Pegawai::latest()->take(5)->get(),
            'recentJadwalAudit' => JadwalAudit::latest()->take(5)->get(),
            'recentPemeriksaan' => Pemeriksaan::latest()->take(5)->get(),
            'recentTindakLanjut' => TindakLanjut::latest()->take(5)->get(),
            
            // Get statistics for tindak lanjut
            'tindakLanjutBelumDiproses' => TindakLanjut::where('status', 'B')->count(),
            'tindakLanjutDalamProses' => TindakLanjut::where('status', 'DP')->count(),
            'tindakLanjutSelesai' => TindakLanjut::where('status', 'S')->count(),
            
            // Get upcoming audits
            'upcomingAudits' => JadwalAudit::where('tgl_audit', '>=', now())
                ->orderBy('tgl_audit', 'asc')
                ->take(3)
                ->get(),
        ];
        
        return view('dashboard.index', $data);
    }
}
