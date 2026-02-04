<?php

namespace App\Http\Controllers;

use App\Models\pegawai;
use App\Models\Direktorat;
use App\Models\StatusPegawai;
use App\Models\LamaBekerja;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawais = pegawai::paginate(15);
        return view('admin.pegawais.index', compact('pegawais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $direktorats = Direktorat::where('is_active', true)->get();
        $statusPegawais = StatusPegawai::where('is_active', true)->get();
        $lamaBekerjas = LamaBekerja::where('is_active', true)->get();

        return view('admin.pegawais.create', compact('direktorats', 'statusPegawais', 'lamaBekerjas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'direktorat' => 'required|string|max:100',
            'divisi' => 'required|string|max:100',
            'status_pegawai' => 'required|string|max:50',
            'lama_bekerja' => 'required|string|max:50',
        ]);

        pegawai::create($request->all());

        return redirect()->route('admin.pegawais.index')->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pegawai = pegawai::findOrFail($id);
        return view('admin.pegawais.show', compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pegawai = pegawai::findOrFail($id);
        $direktorats = Direktorat::where('is_active', true)->get();
        $statusPegawais = StatusPegawai::where('is_active', true)->get();
        $lamaBekerjas = LamaBekerja::where('is_active', true)->get();

        return view('admin.pegawais.edit', compact('pegawai', 'direktorats', 'statusPegawais', 'lamaBekerjas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'direktorat' => 'required|string|max:100',
            'divisi' => 'required|string|max:100',
            'status_pegawai' => 'required|string|max:50',
            'lama_bekerja' => 'required|string|max:50',
        ]);

        $pegawai = pegawai::findOrFail($id);
        $pegawai->update($request->all());

        return redirect()->route('admin.pegawais.index')->with('success', 'Data pegawai berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pegawai = pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('admin.pegawais.index')->with('success', 'Data pegawai berhasil dihapus.');
    }
}
