<?php

namespace App\Http\Controllers;

use App\Models\StatusPegawai;
use Illuminate\Http\Request;

class StatusPegawaiController extends Controller
{
    public function index()
    {
        $statusPegawais = StatusPegawai::paginate(15);
        return view('admin.status-pegawais.index', compact('statusPegawais'));
    }

    public function create()
    {
        return view('admin.status-pegawais.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:status_pegawais,nama',
        ]);

        StatusPegawai::create([
            'nama' => $request->nama,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.status-pegawais.index')->with('success', 'Status Pegawai berhasil ditambahkan.');
    }

    public function show(StatusPegawai $statusPegawai)
    {
        return view('admin.status-pegawais.show', compact('statusPegawai'));
    }

    public function edit(StatusPegawai $statusPegawai)
    {
        return view('admin.status-pegawais.edit', compact('statusPegawai'));
    }

    public function update(Request $request, StatusPegawai $statusPegawai)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:status_pegawais,nama,' . $statusPegawai->id,
        ]);

        $statusPegawai->update([
            'nama' => $request->nama,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.status-pegawais.index')->with('success', 'Status Pegawai berhasil diupdate.');
    }

    public function destroy(StatusPegawai $statusPegawai)
    {
        $statusPegawai->delete();
        return redirect()->route('admin.status-pegawais.index')->with('success', 'Status Pegawai berhasil dihapus.');
    }
}
