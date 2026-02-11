<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\konten_survei;

class KontenSurveiController extends Controller
{
    /**
     * Menampilkan daftar konten survei
     */
    public function index()
    {
        $kontenSurveis = konten_survei::orderBy('tahun', 'desc')->get();
        return view('admin.konten-survei.index', compact('kontenSurveis'));
    }

    /**
     * Menampilkan form create konten survei
     */
    public function create()
    {
        return view('admin.konten-survei.create');
    }

    /**
     * Menyimpan konten survei baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'pendahuluan' => 'nullable|string',
            'indikator' => 'nullable|string',
            'deskripsi_survei' => 'nullable|string',
            'tujuan_1' => 'required|string',
            'tujuan_2' => 'nullable|string',
            'tujuan_3' => 'nullable|string',
            'penutup' => 'required|string',
            'tahun' => 'required|integer|min:2000|max:2100',
            'is_active' => 'nullable|boolean',
        ]);

        // Set default value untuk is_active jika tidak ada
        if (!isset($validated['is_active'])) {
            $validated['is_active'] = false;
        }

        konten_survei::create($validated);

        return redirect()->route('admin.konten-survei.index')
            ->with('success', 'Konten survei berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit konten survei
     */
    public function edit($id)
    {
        $kontenSurvei = konten_survei::findOrFail($id);
        return view('admin.konten-survei.edit', compact('kontenSurvei'));
    }

    /**
     * Update konten survei
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'pendahuluan' => 'nullable|string',
            'indikator' => 'nullable|string',
            'deskripsi_survei' => 'nullable|string',
            'tujuan_1' => 'required|string',
            'tujuan_2' => 'nullable|string',
            'tujuan_3' => 'nullable|string',
            'penutup' => 'required|string',
            'tahun' => 'required|integer|min:2000|max:2100',
            'is_active' => 'nullable|boolean',
        ]);

        // Set default value untuk is_active jika tidak ada
        if (!isset($validated['is_active'])) {
            $validated['is_active'] = false;
        }

        $kontenSurvei = konten_survei::findOrFail($id);
        $kontenSurvei->update($validated);

        return redirect()->route('admin.konten-survei.index')
            ->with('success', 'Konten survei berhasil diperbarui!');
    }

    /**
     * Toggle status aktif/nonaktif konten survei
     */
    public function toggleStatus($id)
    {
        $kontenSurvei = konten_survei::findOrFail($id);
        $kontenSurvei->update(['is_active' => !$kontenSurvei->is_active]);

        $status = $kontenSurvei->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('admin.konten-survei.index')
            ->with('success', "Konten survei '{$kontenSurvei->judul}' berhasil {$status}!");
    }

    /**
     * Hapus konten survei
     */
    public function destroy($id)
    {
        $kontenSurvei = konten_survei::findOrFail($id);
        
        // Hapus semua survei terkait terlebih dahulu
        $kontenSurvei->surveis()->delete();
        
        $kontenSurvei->delete();

        return redirect()->route('admin.konten-survei.index')
            ->with('success', 'Konten survei dan semua data survei terkait berhasil dihapus!');
    }
}
