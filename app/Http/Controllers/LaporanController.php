<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimAudit;
use App\Models\JadwalAudit;
use App\Models\Pemeriksaan;
use App\Models\TindakLanjut;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    /**
     * Display the laporan page.
     */
    public function index()
    {
        return view('dashboard.laporan.index');
    }

    /**
     * Generate and export PDF report.
     */
    public function exportPdf(Request $request)
    {
        $request->validate([
            'bulan' => 'nullable|integer|between:1,12',
            'tahun' => 'required|integer|min:2020|max:' . (date('Y') + 1),
            'jenis_laporan' => 'required|in:tim_audit,jadwal_audit,pemeriksaan,tindak_lanjut',
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $jenisLaporan = $request->jenis_laporan;

        // Get data based on report type
        $data = $this->getReportData($jenisLaporan, $bulan, $tahun);

        // For now, return a simple response (PDF generation would require additional packages)
        // In a real implementation, you would use dompdf or similar package
        $periodeText = $bulan ? $this->getMonthName($bulan) . ' ' . $tahun : 'Tahun ' . $tahun;

        return response()->json([
            'message' => 'Laporan ' . $this->getReportTitle($jenisLaporan) . ' periode ' . $periodeText . ' berhasil dibuat',
            'data' => $data,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'jenis_laporan' => $jenisLaporan,
        ]);
    }

    /**
     * Generate Tim Audit PDF report.
     */
    public function timAuditPdf(Request $request)
    {
        // Get all Tim Audit data with their members (no date filtering needed)
        $timAudits = TimAudit::with(['anggota'])
            ->orderBy('nama_tim')
            ->get();

        // Format tanggal untuk laporan (current date)
        $tanggal = date('d-m-Y');

        // Generate PDF using DOMPDF
        $pdf = Pdf::loadView('dashboard.laporan.tim_audit_pdf', compact('timAudits', 'tanggal'));

        // Set custom paper size (longer than A4 landscape)
        // A4 landscape: 297mm x 210mm = 842pts x 595pts
        // Custom: 400mm x 210mm = 1134pts x 595pts (more space for content)
        $pdf->setPaper([0, 0, 1134, 595], 'landscape');

        // Set filename
        $filename = 'Laporan_Tim_Audit_Semua_Data.pdf';

        // Download the PDF
        return $pdf->stream($filename);
    }

    /**
     * Generate Jadwal Audit PDF report.
     */
    public function jadwalAuditPdf(Request $request)
    {
        // Get parameters from both GET and POST
        $bulan = $request->input('bulan') ?: $request->query('bulan');
        $tahun = $request->input('tahun') ?: $request->query('tahun');

        // Validate tahun (required) and bulan (optional)
        $request->merge(['tahun' => $tahun]);
        $request->validate([
            'tahun' => 'required|integer|min:2020|max:' . (date('Y') + 1),
            'bulan' => 'nullable|integer|between:1,12',
        ]);

        // Get Jadwal Audit data for specified period
        $query = JadwalAudit::with(['timAudit'])
            ->whereYear('tgl_audit', $tahun);

        // Add month filter only if bulan is specified
        if ($bulan) {
            $query->whereMonth('tgl_audit', $bulan);
        }

        $jadwalAudits = $query->orderBy('tgl_audit')->get();

        // Format tanggal untuk laporan (current date)
        $tanggal = date('d-m-Y');

        // Generate PDF using DOMPDF
        $pdf = Pdf::loadView('dashboard.laporan.jadwal_audit_pdf', compact('jadwalAudits', 'bulan', 'tahun', 'tanggal'));

        // Set custom paper size (longer than A4 landscape)
        // A4 landscape: 297mm x 210mm = 842pts x 595pts
        // Custom: 400mm x 210mm = 1134pts x 595pts (more space for content)
        $pdf->setPaper([0, 0, 1134, 595], 'landscape');

        // Set filename
        if ($bulan) {
            $filename = 'Laporan_Jadwal_Audit_' . str_pad($bulan, 2, '0', STR_PAD_LEFT) . '_' . $tahun . '.pdf';
        } else {
            $filename = 'Laporan_Jadwal_Audit_Tahun_' . $tahun . '.pdf';
        }

        // Download the PDF
        return $pdf->stream($filename);
    }

    /**
     * Generate Pemeriksaan PDF report.
     */
    public function pemeriksaanPdf(Request $request)
    {
        // Get parameters from both GET and POST
        $bulan = $request->input('bulan') ?: $request->query('bulan');
        $tahun = $request->input('tahun') ?: $request->query('tahun');

        // Validate tahun (required) and bulan (optional)
        $request->merge(['tahun' => $tahun]);
        $request->validate([
            'tahun' => 'required|integer|min:2020|max:' . (date('Y') + 1),
            'bulan' => 'nullable|integer|between:1,12',
        ]);

        // Get Pemeriksaan data for the specified period
        $query = Pemeriksaan::with(['jadwalAudit'])
            ->whereYear('tanggal', $tahun);

        // Add month filter only if bulan is specified
        if ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        }

        $pemeriksaans = $query->orderBy('tanggal')->get();

        // Format tanggal untuk laporan (current date)
        $tanggal = date('d-m-Y');

        // Generate PDF using DOMPDF
        $pdf = Pdf::loadView('dashboard.laporan.pemeriksaan_pdf', compact('pemeriksaans', 'bulan', 'tahun', 'tanggal'));

        // Set custom paper size (longer than A4 landscape)
        // A4 landscape: 297mm x 210mm = 842pts x 595pts
        // Custom: 400mm x 210mm = 1134pts x 595pts (more space for content)
        $pdf->setPaper([0, 0, 1134, 595], 'landscape');

        // Set filename
        if ($bulan) {
            $filename = 'Laporan_Pemeriksaan_' . str_pad($bulan, 2, '0', STR_PAD_LEFT) . '_' . $tahun . '.pdf';
        } else {
            $filename = 'Laporan_Pemeriksaan_Tahun_' . $tahun . '.pdf';
        }

        // Download the PDF
        return $pdf->stream($filename);
    }

    /**
     * Generate Tindak Lanjut PDF report.
     */
    public function tindakLanjutPdf(Request $request)
    {
        // Get parameters from both GET and POST
        $bulan = $request->input('bulan') ?: $request->query('bulan');
        $tahun = $request->input('tahun') ?: $request->query('tahun');

        // Validate tahun (required) and bulan (optional)
        $request->merge(['tahun' => $tahun]);
        $request->validate([
            'tahun' => 'required|integer|min:2020|max:' . (date('Y') + 1),
            'bulan' => 'nullable|integer|between:1,12',
        ]);

        // Get Tindak Lanjut data for the specified period
        $query = TindakLanjut::with(['pemeriksaan.jadwalAudit'])
            ->whereYear('tanggal', $tahun);

        // Add month filter only if bulan is specified
        if ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        }

        $tindakLanjuts = $query->orderBy('tanggal')->get();

        // Format tanggal untuk laporan (current date)
        $tanggal = date('d-m-Y');

        // Generate PDF using DOMPDF
        $pdf = Pdf::loadView('dashboard.laporan.tindak_lanjut_pdf', compact('tindakLanjuts', 'bulan', 'tahun', 'tanggal'));

        $pdf->setPaper('a4', 'landscape');

        // Set filename
        if ($bulan) {
            $filename = 'Laporan_Tindak_Lanjut_' . str_pad($bulan, 2, '0', STR_PAD_LEFT) . '_' . $tahun . '.pdf';
        } else {
            $filename = 'Laporan_Tindak_Lanjut_Tahun_' . $tahun . '.pdf';
        }

        // Download the PDF
        return $pdf->stream($filename);
    }

    /**
     * Get report data based on type and period.
     */
    private function getReportData($jenisLaporan, $bulan, $tahun)
    {
        switch ($jenisLaporan) {
            case 'tim_audit':
                return TimAudit::with(['pegawai'])
                    ->orderBy('nama_tim')
                    ->get();

            case 'jadwal_audit':
                $query = JadwalAudit::with(['timAudit'])
                    ->whereYear('tgl_audit', $tahun);

                if ($bulan) {
                    $query->whereMonth('tgl_audit', $bulan);
                }

                return $query->orderBy('tgl_audit')->get();

            case 'pemeriksaan':
                $query = Pemeriksaan::with(['jadwalAudit'])
                    ->whereYear('tanggal', $tahun);

                if ($bulan) {
                    $query->whereMonth('tanggal', $bulan);
                }

                return $query->orderBy('tanggal')->get();

            case 'tindak_lanjut':
                $query = TindakLanjut::with(['pemeriksaan.jadwalAudit'])
                    ->whereYear('tanggal', $tahun);

                if ($bulan) {
                    $query->whereMonth('tanggal', $bulan);
                }

                return $query->orderBy('tanggal')->get();

            default:
                return collect([]);
        }
    }

    /**
     * Get report title in Indonesian.
     */
    private function getReportTitle($jenisLaporan)
    {
        $titles = [
            'tim_audit' => 'Tim Audit',
            'jadwal_audit' => 'Jadwal Audit',
            'pemeriksaan' => 'Pemeriksaan',
            'tindak_lanjut' => 'Tindak Lanjut',
        ];

        return $titles[$jenisLaporan] ?? 'Laporan';
    }

    /**
     * Get month name in Indonesian.
     */
    private function getMonthName($bulan)
    {
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        return $months[$bulan] ?? '';
    }
}
