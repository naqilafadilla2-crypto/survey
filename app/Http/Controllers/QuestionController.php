<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\konten_survei;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    /**
     * Display a listing of konten_survei for question management selection.
     */
    public function selectKonten()
    {
        $kontenSurveis = konten_survei::orderBy('tahun', 'desc')->get();
        return view('admin.questions.select-konten', compact('kontenSurveis'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(konten_survei $konten_survei)
    {
        $questions = Question::where('konten_survei_id', $konten_survei->id)
            ->orderBy('kategori')
            ->orderBy('id')
            ->get()
            ->groupBy('kategori');

        return view('admin.questions.index', compact('questions', 'konten_survei'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(konten_survei $konten_survei)
    {
        $kategoris = Kategori::orderBy('urutan')->get();
        return view('admin.questions.create', compact('konten_survei', 'kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, konten_survei $konten_survei)
    {
        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'kategori' => 'required|string',
            'type' => 'required|in:scale,choice,multiple,text',
            'options' => 'array',
            'options.*' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $options = collect($request->input('options', []))
            ->map(fn ($opt) => trim($opt))
            ->filter()
            ->values()
            ->all();

        // Jika tipe choice atau multiple, minimal harus ada 2 opsi
        if (($validated['type'] === 'choice' || $validated['type'] === 'multiple') && count($options) < 2) {
            return back()
                ->withErrors(['options' => 'Minimal isi 2 opsi untuk tipe pertanyaan pilihan.'])
                ->withInput();
        }

        // Handle upload foto
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('questions', 'public');
        }

        Question::create([
            'pertanyaan' => $validated['pertanyaan'],
            'kategori' => $validated['kategori'],
            'type' => $validated['type'],
            'options' => ($validated['type'] === 'choice' || $validated['type'] === 'multiple') ? $options : null,
            'foto' => $fotoPath,
            'konten_survei_id' => $konten_survei->id,
        ]);

        return redirect()->route('admin.konten-survei.questions.index', $konten_survei)
            ->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(konten_survei $konten_survei, Question $question)
    {
        // Ensure the question belongs to the konten_survei
        if ($question->konten_survei_id !== $konten_survei->id) {
            abort(404);
        }

        $kategoris = Kategori::orderBy('urutan')->get();
        return view('admin.questions.edit', compact('question', 'konten_survei', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, konten_survei $konten_survei, Question $question)
    {
        // Ensure the question belongs to the konten_survei
        if ($question->konten_survei_id !== $konten_survei->id) {
            abort(404);
        }

        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'kategori' => 'required|string',
            'type' => 'required|in:scale,choice,multiple,text',
            'options' => 'array',
            'options.*' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $options = collect($request->input('options', []))
            ->map(fn ($opt) => trim($opt))
            ->filter()
            ->values()
            ->all();

        if (($validated['type'] === 'choice' || $validated['type'] === 'multiple') && count($options) < 2) {
            return back()
                ->withErrors(['options' => 'Minimal isi 2 opsi untuk tipe pertanyaan pilihan.'])
                ->withInput();
        }

        // Handle upload foto
        $updateData = [
            'pertanyaan' => $validated['pertanyaan'],
            'kategori' => $validated['kategori'],
            'type' => $validated['type'],
            'options' => ($validated['type'] === 'choice' || $validated['type'] === 'multiple') ? $options : null,
        ];

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($question->foto && Storage::disk('public')->exists($question->foto)) {
                Storage::disk('public')->delete($question->foto);
            }
            // Simpan foto baru
            $updateData['foto'] = $request->file('foto')->store('questions', 'public');
        } elseif ($request->has('hapus_foto')) {
            // Hapus foto jika checkbox dicentang
            if ($question->foto && Storage::disk('public')->exists($question->foto)) {
                Storage::disk('public')->delete($question->foto);
            }
            $updateData['foto'] = null;
        }

        $question->update($updateData);

        return redirect()->route('admin.konten-survei.questions.index', $konten_survei)
            ->with('success', 'Pertanyaan berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(konten_survei $konten_survei, Question $question)
    {
        // Ensure the question belongs to the konten_survei
        if ($question->konten_survei_id !== $konten_survei->id) {
            abort(404);
        }

        // Hapus foto jika ada
        if ($question->foto && Storage::disk('public')->exists($question->foto)) {
            Storage::disk('public')->delete($question->foto);
        }

        $question->delete();

        return redirect()->route('admin.konten-survei.questions.index', $konten_survei)
            ->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
