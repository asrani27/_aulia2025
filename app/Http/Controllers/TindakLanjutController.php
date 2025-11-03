<?php

namespace App\Http\Controllers;

use App\Models\TindakLanjut;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;

class TindakLanjutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tindakLanjuts = TindakLanjut::with('pemeriksaan.jadwalAudit')->latest()->paginate(10);
        return view('dashboard.tindak_lanjut.index', compact('tindakLanjuts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pemeriksaans = Pemeriksaan::with('jadwalAudit')->get();
        return view('dashboard.tindak_lanjut.create', compact('pemeriksaans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pemeriksaan_id' => 'required|exists:pemeriksaan,id',
            'tanggal' => 'required|date',
            'uraian' => 'required|string',
            'tindak_lanjut' => 'required|string',
            'status' => 'required|in:B,DP,S',
            'keterangan' => 'nullable|string',
            'rekomendasi_saran' => 'nullable|string',
        ]);

        TindakLanjut::create($request->all());

        return redirect()->route('tindak_lanjut.index')
            ->with('success', 'Tindak lanjut berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TindakLanjut $tindakLanjut)
    {
        $tindakLanjut->load('pemeriksaan.jadwalAudit');
        return view('dashboard.tindak_lanjut.show', compact('tindakLanjut'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TindakLanjut $tindakLanjut)
    {
        $pemeriksaans = Pemeriksaan::with('jadwalAudit')->get();
        return view('dashboard.tindak_lanjut.edit', compact('tindakLanjut', 'pemeriksaans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TindakLanjut $tindakLanjut)
    {
        $request->validate([
            'pemeriksaan_id' => 'required|exists:pemeriksaan,id',
            'tanggal' => 'required|date',
            'uraian' => 'required|string',
            'tindak_lanjut' => 'required|string',
            'status' => 'required|in:S,DP,B',
            'keterangan' => 'nullable|string',
            'rekomendasi_saran' => 'nullable|string',
        ]);

        $tindakLanjut->update($request->all());

        return redirect()->route('tindak_lanjut.index')
            ->with('success', 'Tindak lanjut berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TindakLanjut $tindakLanjut)
    {
        $tindakLanjut->delete();

        return redirect()->route('tindak_lanjut.index')
            ->with('success', 'Tindak lanjut berhasil dihapus.');
    }
}
