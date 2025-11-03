<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalAudit;
use App\Models\TimAudit;

class JadwalAuditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwalAudits = JadwalAudit::with('timAudit')->latest()->paginate(10);
        return view('dashboard.jadwal_audit.index', compact('jadwalAudits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $timAudits = TimAudit::all();
        return view('dashboard.jadwal_audit.create', compact('timAudits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tim_audit_id' => 'required|exists:tim_audit,id',
            'tgl_audit' => 'required|date',
            'status' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        JadwalAudit::create($request->all());

        return redirect()->route('jadwal_audit.index')
            ->with('success', 'Jadwal audit berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalAudit $jadwalAudit)
    {
        $jadwalAudit->load('timAudit');
        return view('dashboard.jadwal_audit.show', compact('jadwalAudit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalAudit $jadwalAudit)
    {
        $timAudits = TimAudit::all();
        return view('dashboard.jadwal_audit.edit', compact('jadwalAudit', 'timAudits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalAudit $jadwalAudit)
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tim_audit_id' => 'required|exists:tim_audit,id',
            'tgl_audit' => 'required|date',
            'status' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $jadwalAudit->update($request->all());

        return redirect()->route('jadwal_audit.index')
            ->with('success', 'Jadwal audit berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalAudit $jadwalAudit)
    {
        $jadwalAudit->delete();

        return redirect()->route('jadwal_audit.index')
            ->with('success', 'Jadwal audit berhasil dihapus.');
    }
}
