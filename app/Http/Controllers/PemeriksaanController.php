<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemeriksaan;
use App\Models\JadwalAudit;

class PemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemeriksaan = Pemeriksaan::with('jadwalAudit')->latest()->paginate(10);
        return view('dashboard.pemeriksaan.index', compact('pemeriksaan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jadwalAudits = JadwalAudit::all();
        return view('dashboard.pemeriksaan.create', compact('jadwalAudits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jadwal_audit_id' => 'required|exists:jadwal_audit,id',
            'jabatan_pemeriksa' => 'required|in:pengendali teknis,ketua tim,anggota',
            'tanggal' => 'required|date',
            'hasil_temuan' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        Pemeriksaan::create($request->all());

        return redirect()->route('pemeriksaan.index')
            ->with('success', 'Data pemeriksaan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemeriksaan $pemeriksaan)
    {
        $pemeriksaan->load('jadwalAudit');
        return view('dashboard.pemeriksaan.show', compact('pemeriksaan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemeriksaan $pemeriksaan)
    {
        $jadwalAudits = JadwalAudit::all();
        return view('dashboard.pemeriksaan.edit', compact('pemeriksaan', 'jadwalAudits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemeriksaan $pemeriksaan)
    {
        $request->validate([
            'jadwal_audit_id' => 'required|exists:jadwal_audit,id',
            'jabatan_pemeriksa' => 'required|in:pengendali teknis,ketua tim,anggota',
            'tanggal' => 'required|date',
            'hasil_temuan' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $pemeriksaan->update($request->all());

        return redirect()->route('pemeriksaan.index')
            ->with('success', 'Data pemeriksaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemeriksaan $pemeriksaan)
    {
        $pemeriksaan->delete();

        return redirect()->route('pemeriksaan.index')
            ->with('success', 'Data pemeriksaan berhasil dihapus.');
    }
}
