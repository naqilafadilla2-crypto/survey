<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\survei;
use App\Models\pegawai;
use App\Models\konten_survei;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Menampilkan dashboard admin
     */
    public function dashboard(Request $request)
    {
        // Ambil semua konten survei untuk dropdown filter
        $kontenSurveis = konten_survei::all();
        
        // Filter berdasarkan konten survei jika dipilih
        $kontenId = $request->get('konten_id');
        
        // Statistik umum
        $totalSurveiQuery = survei::query();
        if ($kontenId) {
            $totalSurveiQuery->where('konten_survei_id', $kontenId);
        }
        $totalSurvei = $totalSurveiQuery->count();
        
        $totalPegawai = pegawai::count();
        $kontenAktif = konten_survei::where('is_active', true)->count();
        $totalPertanyaan = Question::count();

        // Daftar semua survei dengan pagination
        $surveisQuery = survei::with(['pegawai', 'kontenSurvei']);
        if ($kontenId) {
            $surveisQuery->where('konten_survei_id', $kontenId);
        }
        $surveis = $surveisQuery->orderBy('created_at', 'desc')
            ->paginate(15);

        // Statistik per direktorat (hanya untuk survei yang difilter)
        $statistikDirektoratQuery = pegawai::join('surveis', 'pegawais.id', '=', 'surveis.pegawai_id')
            ->select('pegawais.direktorat', DB::raw('COUNT(*) as total'));
        if ($kontenId) {
            $statistikDirektoratQuery->where('surveis.konten_survei_id', $kontenId);
        }
        $statistikDirektorat = $statistikDirektoratQuery->groupBy('pegawais.direktorat')
            ->get();

        // Statistik per status pegawai (hanya untuk survei yang difilter)
        $statistikStatusQuery = pegawai::join('surveis', 'pegawais.id', '=', 'surveis.pegawai_id')
            ->select('pegawais.status_pegawai', DB::raw('COUNT(*) as total'));
        if ($kontenId) {
            $statistikStatusQuery->where('surveis.konten_survei_id', $kontenId);
        }
        $statistikStatus = $statistikStatusQuery->groupBy('pegawais.status_pegawai')
            ->get();

        return view('admin.dashboard', compact(
            'totalSurvei',
            'totalPegawai',
            'kontenAktif',
            'totalPertanyaan',
            'surveis',
            'statistikDirektorat',
            'statistikStatus',
            'kontenSurveis',
            'kontenId'
        ));
    }

    /**
     * Menampilkan detail survei
     */
    public function showSurvei($id)
    {
        $survei = survei::with('pegawai')->findOrFail($id);

        // Ambil pertanyaan untuk konten survei ini
        $questions = Question::where('konten_survei_id', $survei->konten_survei_id)
            ->orderBy('kategori')
            ->orderBy('id')
            ->get()
            ->groupBy('kategori');

        // Hitung rata-rata hanya dari pertanyaan numerik
        $totalSkor = 0;
        $totalPertanyaan = 0;
        $questionIndex = 1;

        foreach ($questions->flatten() as $question) {
            $type = $question->type ?? 'scale';
            if ($type === 'text') {
                $questionIndex++;
                continue;
            }

            $nilai = $survei->{'q' . $questionIndex};
            if (!is_null($nilai)) {
                $totalSkor += $nilai;
                $totalPertanyaan++;
            }
            $questionIndex++;
        }

        $rataRata = $totalPertanyaan > 0
            ? round($totalSkor / $totalPertanyaan, 2)
            : 0;

        return view('admin.show-survei', [
            'survei'    => $survei,
            'rataRata'  => $rataRata,
            'questions' => $questions,
        ]);
    }

    /**
     * Menghapus survei
     */
    public function destroySurvei($id)
    {
        $survei = survei::findOrFail($id);
        $survei->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Survei berhasil dihapus!');
    }

    /**
     * Export data (opsional - bisa ditambahkan nanti)
     */
    public function export()
    {
        // Implementasi export bisa ditambahkan di sini
        return redirect()->route('admin.dashboard')
            ->with('info', 'Fitur export sedang dalam pengembangan.');
    }
}
