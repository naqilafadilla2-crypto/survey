<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\survei;
use App\Models\pegawai;
use App\Models\konten_survei;
use App\Models\Direktorat;
use App\Models\StatusPegawai;
use App\Models\LamaBekerja;

class SurveiController extends Controller
{
    /**
     * Halaman utama survei - menampilkan daftar konten survei yang tersedia
     */
    public function index()
    {
        $kontenSurveis = konten_survei::where('is_active', true)->orderBy('tahun', 'desc')->get();
        return view('survei.index', compact('kontenSurveis'));
    }

    /**
     * Menampilkan form survei
     */
    public function create($kontenId)
    {
        // Ambil konten survei berdasarkan ID
        $kontenSurvei = konten_survei::findOrFail($kontenId);

        // Ambil pertanyaan untuk konten ini dan kelompokkan berdasarkan kategori
        $questions = \App\Models\Question::where('konten_survei_id', $kontenId)
            ->orderBy('kategori')
            ->orderBy('id')
            ->get()
            ->groupBy('kategori');

        // Master data untuk isian pegawai
        $direktorats = Direktorat::where('is_active', true)->orderBy('nama')->get();
        $statusPegawais = StatusPegawai::where('is_active', true)->orderBy('id')->get();
        $lamaBekerjas = LamaBekerja::where('is_active', true)->orderBy('nama')->get();

        return view('survei.create', compact('kontenSurvei', 'questions', 'direktorats', 'statusPegawais', 'lamaBekerjas'));
    }

    /**
     * Menyimpan data survei
     */
    public function store(Request $request)
    {
        // Ambil konten survei
        $kontenSurvei = konten_survei::findOrFail($request->konten_survei_id);
        $questions = \App\Models\Question::where('konten_survei_id', $kontenSurvei->id)->orderBy('id')->get();

        // ================= VALIDASI =================
        $rules = [
            'konten_survei_id' => 'required|exists:konten_surveis,id',
            'mode' => 'required|in:public,internal',
            'saran' => 'nullable|string|max:1000',
        ];

        // For public mode, only status_pegawai and lama_bekerja are required
        if ($request->mode === 'public') {
            $rules['status_pegawai'] = 'required|string|max:50';
            $rules['lama_bekerja'] = 'required|string|max:50';
        } else {
            // For internal mode, all fields are required
            $rules['nama'] = 'required|string|max:100';
            $rules['direktorat'] = 'required|string|max:100';
            $rules['divisi'] = 'required|string|max:100';
            $rules['status_pegawai'] = 'required|string|max:50';
            $rules['lama_bekerja'] = 'required|string|max:50';
        }

        // Tambahkan validasi untuk setiap pertanyaan
        foreach($questions as $index => $question) {
            $key = 'q' . ($index + 1);

            // Default type = scale jika belum di-set (untuk kompatibilitas data lama)
            $type = $question->type ?? 'scale';

            if ($type === 'text') {
                // Isian teks bebas
                $rules[$key . '_text'] = 'required|string|max:1000';
            } else {
                // Skala 1-5 atau pilihan (disimpan sebagai angka index)
                $rules[$key] = 'required|integer|min:1|max:5';
            }
        }

        $validated = $request->validate($rules);

        // ================= SIMPAN / CARI PEGAWAI =================
        if ($request->mode === 'public') {
            // For public mode, create/find employee with only status and lama bekerja
            $pegawai = pegawai::firstOrCreate([
                'status_pegawai' => $validated['status_pegawai'],
                'lama_bekerja' => $validated['lama_bekerja'],
            ]);
        } else {
            // For internal mode, create/find employee with all data
            $pegawai = pegawai::firstOrCreate([
                'nama' => $validated['nama'],
                'direktorat' => $validated['direktorat'],
                'divisi' => $validated['divisi'],
                'status_pegawai' => $validated['status_pegawai'],
                'lama_bekerja' => $validated['lama_bekerja'],
            ]);
        }

        // ================= SIMPAN SURVEI =================
        $answersText = [];

        $surveiData = [
            'pegawai_id' => $pegawai->id,
            'konten_survei_id' => $validated['konten_survei_id'],
            'mode' => $validated['mode'],
            'saran' => $validated['saran'] ?? null,
        ];

        // Tambahkan jawaban pertanyaan (kolom q1–q18 di tabel survei)
        $maxQ = 18;
        foreach($questions as $index => $question) {
            $questionNum = $index + 1;
            if ($questionNum > $maxQ) {
                break;
            }
            $key = 'q' . $questionNum;
            $type = $question->type ?? 'scale';

            if ($type === 'text') {
                $answersText[$key] = $validated[$key . '_text'] ?? null;
            } else {
                $surveiData[$key] = $validated[$key] ?? null;
            }
        }

        if (!empty($answersText)) {
            $surveiData['answers'] = $answersText;
        }

        survei::create($surveiData);

        return redirect()
            ->route('survei.thank-you');
    }

    /**
     * Menampilkan halaman terima kasih setelah submit survei
     */
    public function thankYou()
    {
        return view('survei.thank-you');
    }

    /**
     * Menampilkan hasil survei
     */
    public function show($id)
    {
        $survei = survei::with('pegawai')->findOrFail($id);

        // Ambil pertanyaan untuk konten survei ini dan kelompokkan berdasarkan kategori
        $questions = \App\Models\Question::where('konten_survei_id', $survei->konten_survei_id)
            ->orderBy('kategori')
            ->orderBy('id')
            ->get()
            ->groupBy('kategori');

        // Hitung rata-rata hanya dari pertanyaan numerik (bukan isian teks)
        $totalSkor = 0;
        $totalQuestions = 0;
        foreach ($questions->flatten() as $index => $question) {
            $type = $question->type ?? 'scale';
            if ($type === 'text') {
                continue;
            }

            $nilai = $survei->{'q' . ($index + 1)};
            if (!is_null($nilai)) {
                $totalSkor += $nilai;
                $totalQuestions++;
            }
        }

        $rataRata = $totalQuestions > 0 ? round($totalSkor / $totalQuestions, 2) : 0;

        return view('survei.show', [
            'survei'    => $survei,
            'rataRata'  => $rataRata,
            'questions' => $questions,
        ]);
    }
    
}
