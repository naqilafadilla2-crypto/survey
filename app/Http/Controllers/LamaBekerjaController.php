<?php

namespace App\Http\Controllers;

use App\Models\LamaBekerja;
use Illuminate\Http\Request;

class LamaBekerjaController extends Controller
{
    public function index()
    {
        $lamaBekerjas = LamaBekerja::paginate(15);
        return view('admin.lama-bekerjas.index', compact('lamaBekerjas'));
    }

    public function create()
    {
        return view('admin.lama-bekerjas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:lama_bekerjas,nama',
        ]);

        LamaBekerja::create([
            'nama' => $request->nama,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.lama-bekerjas.index')->with('success', 'Lama Bekerja berhasil ditambahkan.');
    }

    public function show(LamaBekerja $lamaBekerja)
    {
        return view('admin.lama-bekerjas.show', compact('lamaBekerja'));
    }

    public function edit(LamaBekerja $lamaBekerja)
    {
        return view('admin.lama-bekerjas.edit', compact('lamaBekerja'));
    }

    public function update(Request $request, LamaBekerja $lamaBekerja)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:lama_bekerjas,nama,' . $lamaBekerja->id,
        ]);

        $lamaBekerja->update([
            'nama' => $request->nama,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.lama-bekerjas.index')->with('success', 'Lama Bekerja berhasil diupdate.');
    }

    public function destroy(LamaBekerja $lamaBekerja)
    {
        $lamaBekerja->delete();
        return redirect()->route('admin.lama-bekerjas.index')->with('success', 'Lama Bekerja berhasil dihapus.');
    }
}
