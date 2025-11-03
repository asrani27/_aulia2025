<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the pegawai.
     */
    public function index()
    {
        $pegawais = Pegawai::latest()->paginate(10);
        return view('dashboard.pegawai.index', compact('pegawais'));
    }

    /**
     * Show the form for creating a new pegawai.
     */
    public function create()
    {
        return view('dashboard.pegawai.create');
    }

    /**
     * Store a newly created pegawai in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'tgl_lahir' => ['required', 'date'],
            'jkel' => ['required', 'in:L,P'],
            'pangkat' => ['required', 'string', 'max:255'],
            'golongan' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'telp' => ['required', 'string', 'max:20'],
            'alamat' => ['required', 'string'],
        ]);

        Pegawai::create([
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'jkel' => $request->jkel,
            'pangkat' => $request->pangkat,
            'golongan' => $request->golongan,
            'jabatan' => $request->jabatan,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified pegawai.
     */
    public function edit(Pegawai $pegawai)
    {
        return view('dashboard.pegawai.edit', compact('pegawai'));
    }

    /**
     * Update the specified pegawai in storage.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'tgl_lahir' => ['required', 'date'],
            'jkel' => ['required', 'in:L,P'],
            'pangkat' => ['required', 'string', 'max:255'],
            'golongan' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'telp' => ['required', 'string', 'max:20'],
            'alamat' => ['required', 'string'],
        ]);

        $pegawai->update([
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'jkel' => $request->jkel,
            'pangkat' => $request->pangkat,
            'golongan' => $request->golongan,
            'jabatan' => $request->jabatan,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil diperbarui!');
    }

    /**
     * Remove the specified pegawai from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        return redirect()->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil dihapus!');
    }
}
