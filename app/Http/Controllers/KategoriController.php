<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Tampilkan daftar semua kategori
     */
    public function index()
    {
        $kategoris = Kategori::orderBy('urutan')->paginate(10);
        return view('admin.kategoris.index', compact('kategoris'));
    }

    /**
     * Tampilkan form tambah kategori
     */
    public function create()
    {
        return view('admin.kategoris.create');
    }

    /**
     * Simpan kategori baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kategoris,nama',
            'deskripsi' => 'nullable|string',
            'urutan' => 'nullable|integer|min:0'
        ]);

        // Set urutan default
        if (!$validated['urutan']) {
            $validated['urutan'] = Kategori::max('urutan') + 1 ?? 1;
        }

        Kategori::create($validated);

        return redirect()->route('admin.kategoris.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit kategori
     */
    public function edit(Kategori $kategori)
    {
        return view('admin.kategoris.edit', compact('kategori'));
    }

    /**
     * Update kategori
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kategoris,nama,' . $kategori->id,
            'deskripsi' => 'nullable|string',
            'urutan' => 'nullable|integer|min:0'
        ]);

        $kategori->update($validated);

        return redirect()->route('admin.kategoris.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Hapus kategori
     */
    public function destroy(Kategori $kategori)
    {
        // Cek apakah ada pertanyaan yang menggunakan kategori ini
        if ($kategori->questions()->exists()) {
            return redirect()->route('admin.kategoris.index')
                ->with('error', 'Tidak dapat menghapus kategori yang masih digunakan oleh pertanyaan!');
        }

        $kategori->delete();

        return redirect()->route('admin.kategoris.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}
