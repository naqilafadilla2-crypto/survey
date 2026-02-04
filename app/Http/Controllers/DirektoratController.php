<?php

namespace App\Http\Controllers;

use App\Models\Direktorat;
use Illuminate\Http\Request;

class DirektoratController extends Controller
{
    public function index()
    {
        $direktorats = Direktorat::paginate(15);
        return view('admin.direktorats.index', compact('direktorats'));
    }

    public function create()
    {
        return view('admin.direktorats.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:direktorats,nama',
        ]);

        Direktorat::create([
            'nama' => $request->nama,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.direktorats.index')->with('success', 'Direktorat berhasil ditambahkan.');
    }

    public function show(Direktorat $direktorat)
    {
        return view('admin.direktorats.show', compact('direktorat'));
    }

    public function edit(Direktorat $direktorat)
    {
        return view('admin.direktorats.edit', compact('direktorat'));
    }

    public function update(Request $request, Direktorat $direktorat)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:direktorats,nama,' . $direktorat->id,
        ]);

        $direktorat->update([
            'nama' => $request->nama,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.direktorats.index')->with('success', 'Direktorat berhasil diupdate.');
    }

    public function destroy(Direktorat $direktorat)
    {
        $direktorat->delete();
        return redirect()->route('admin.direktorats.index')->with('success', 'Direktorat berhasil dihapus.');
    }
}
