<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimAudit;
use App\Models\Pegawai;

class TimAuditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timAudits = TimAudit::with('anggota')->get();
        return view('dashboard.tim_audit.index', compact('timAudits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pegawais = Pegawai::all();
        return view('dashboard.tim_audit.create', compact('pegawais'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_tim' => 'required|string|max:255',
            'bidang' => 'required|string|max:255',
            'anggota' => 'required|array',
            'anggota.*' => 'exists:pegawai,id',
        ]);

        $timAudit = TimAudit::create([
            'nama_tim' => $request->nama_tim,
            'bidang' => $request->bidang,
        ]);

        $timAudit->anggota()->attach($request->anggota);

        return redirect()->route('tim_audit.index')
            ->with('success', 'Tim Audit berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $timAudit = TimAudit::with('anggota')->findOrFail($id);
        return view('dashboard.tim_audit.show', compact('timAudit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $timAudit = TimAudit::with('anggota')->findOrFail($id);
        $pegawais = Pegawai::all();
        return view('dashboard.tim_audit.edit', compact('timAudit', 'pegawais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_tim' => 'required|string|max:255',
            'bidang' => 'required|string|max:255',
            'anggota' => 'required|array',
            'anggota.*' => 'exists:pegawai,id',
        ]);

        $timAudit = TimAudit::findOrFail($id);
        $timAudit->update([
            'nama_tim' => $request->nama_tim,
            'bidang' => $request->bidang,
        ]);

        $timAudit->anggota()->sync($request->anggota);

        return redirect()->route('tim_audit.index')
            ->with('success', 'Tim Audit berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $timAudit = TimAudit::findOrFail($id);
        $timAudit->anggota()->detach();
        $timAudit->delete();

        return redirect()->route('tim_audit.index')
            ->with('success', 'Tim Audit berhasil dihapus.');
    }
}
