<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\survei;
use App\Models\konten_survei;
use App\Models\pegawai;
use App\Models\Question;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminLaporanController extends Controller
{
    /**
     * Normalisasi direktorat:
     * - lowercase
     * - hapus spasi & underscore
     */
    private function normalizeDirektorat(string $value): string
    {
        return strtolower(str_replace([' ', '_'], '', $value));
    }

    public function index(Request $request)
    {
        // =============================
        // FILTER
        // =============================
        $kontenId   = $request->get('konten_id');
        $modeFilter = $request->get('mode');
        $kontenList = konten_survei::orderBy('judul')->get();

        // =============================
        // STATISTIK GLOBAL
        // =============================
        $totalSurvei = survei::when($kontenId, fn ($q) =>
            $q->where('konten_survei_id', $kontenId)
        )->when($modeFilter, fn ($q) =>
            $q->where('mode', $modeFilter)
        )->count();

        $totalPegawai    = pegawai::count();
        $kontenAktif     = konten_survei::where('is_active', true)->count();
        $totalPertanyaan = Question::count();

        // =============================
        // RATA-RATA SKOR GLOBAL
        // =============================
        $avgSkor = survei::when($kontenId, fn ($q) =>
            $q->where('konten_survei_id', $kontenId)
        )->when($modeFilter, fn ($q) =>
            $q->where('mode', $modeFilter)
        )
        ->selectRaw('
            AVG(
                (q1+q2+q3+q4+q5+q6+q7+q8+q9+q10+
                 q11+q12+q13+q14+q15+q16+q17+q18) / 18
            ) as avg
        ')
        ->value('avg') ?? 0;

        // =============================
        // DATA RESPONS 7 HARI TERAKHIR
        // =============================
        $surveyData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');

            $surveyData[] = survei::whereDate('created_at', $date)
                ->when($kontenId, fn ($q) =>
                    $q->where('konten_survei_id', $kontenId)
                )->when($modeFilter, fn ($q) =>
                    $q->where('mode', $modeFilter)
                )
                ->count();
        }

        // =============================
        // STATISTIK PER KONTEN
        // =============================
        $kontenStats = konten_survei::withCount(['surveis' => function ($q) use ($kontenId, $modeFilter) {
            if ($kontenId) {
                $q->where('konten_survei_id', $kontenId);
            }
            if ($modeFilter) {
                $q->where('mode', $modeFilter);
            }
        }])->get();

        // =============================
        // STATISTIK PER DIREKTORAT (FIX TOTAL)
        // =============================
        $direktoratList = [
            'sumber_daya_dan_administrasi',
            'keuangan',
            'satuan_pemeriksaan_intern',
            'lti_badan_usaha',
            'lti_masyarakat_dan_pemerintah',
            'infrastruktur',
            'wilker_surabaya',
            'wilker_makassar',
            'direktorat_hukum',
        ];

        $direktoratStats = [];

        foreach ($direktoratList as $dir) {

            $dirNorm = $this->normalizeDirektorat($dir);

            // Total pegawai per direktorat
            $totalPegawaiDirektorat = pegawai::whereRaw(
                "REPLACE(REPLACE(LOWER(direktorat),' ',''),'_','') = ?",
                [$dirNorm]
            )->count();

            // Survei per direktorat
            $surveis = survei::whereHas('pegawai', function ($q) use ($dirNorm) {
                    $q->whereRaw(
                        "REPLACE(REPLACE(LOWER(direktorat),' ',''),'_','') = ?",
                        [$dirNorm]
                    );
                })
                ->when($kontenId, fn ($q) =>
                    $q->where('konten_survei_id', $kontenId)
                )->when($modeFilter, fn ($q) =>
                    $q->where('mode', $modeFilter)
                )
                ->get();

            $totalSurveiDirektorat = $surveis->count();

            $avgScoreDirektorat = $totalSurveiDirektorat > 0
                ? round(
                    $surveis->avg(fn ($s) =>
                        (
                            $s->q1 + $s->q2 + $s->q3 + $s->q4 + $s->q5 +
                            $s->q6 + $s->q7 + $s->q8 + $s->q9 + $s->q10 +
                            $s->q11 + $s->q12 + $s->q13 + $s->q14 +
                            $s->q15 + $s->q16 + $s->q17 + $s->q18
                        ) / 18
                    ),
                2)
                : 0;

            $direktoratStats[] = [
                'nama'          => ucwords(str_replace('_', ' ', $dir)),
                'total_pegawai' => $totalPegawaiDirektorat,
                'total_survei'  => $totalSurveiDirektorat,
                'avg_score'     => $avgScoreDirektorat,
            ];
        }

        // =============================
        // TREND SKOR BULANAN (6 BULAN)
        // =============================
        $monthlyTrend = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);

            $avg = survei::when($kontenId, fn ($q) =>
                $q->where('konten_survei_id', $kontenId)
            )->when($modeFilter, fn ($q) =>
                $q->where('mode', $modeFilter)
            )
            ->whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->selectRaw('
                AVG(
                    (q1+q2+q3+q4+q5+q6+q7+q8+q9+q10+
                     q11+q12+q13+q14+q15+q16+q17+q18) / 18
                ) as avg
            ')
            ->value('avg') ?? 0;

            $monthlyTrend[] = [
                'month'     => $month->format('M Y'),
                'avg_score' => round($avg, 2),
            ];
        }

        return view('admin.laporan.index', compact(
            'totalSurvei',
            'totalPegawai',
            'kontenAktif',
            'totalPertanyaan',
            'avgSkor',
            'surveyData',
            'kontenStats',
            'direktoratStats',
            'monthlyTrend',
            'kontenId',
            'kontenList',
            'modeFilter'
        ));
    }

    // =============================
    // EXPORT PDF
    // =============================
    public function export(Request $request)
    {
        $kontenId = $request->get('konten_id');
        $modeFilter = $request->get('mode');
        $kontenLabel = 'Semua Konten';

        if ($kontenId) {
            $konten = konten_survei::find($kontenId);
            $kontenLabel = $konten->judul ?? $kontenLabel;
        }

        $surveis = survei::with(['pegawai', 'kontenSurvei'])
            ->when($kontenId, fn ($q) =>
                $q->where('konten_survei_id', $kontenId)
            )->when($modeFilter, fn ($q) =>
                $q->where('mode', $modeFilter)
            )
            ->get();

        $avgSkor = $surveis->count() > 0
            ? round(
                $surveis->avg(fn ($s) =>
                    (
                        $s->q1 + $s->q2 + $s->q3 + $s->q4 + $s->q5 +
                        $s->q6 + $s->q7 + $s->q8 + $s->q9 + $s->q10 +
                        $s->q11 + $s->q12 + $s->q13 + $s->q14 +
                        $s->q15 + $s->q16 + $s->q17 + $s->q18
                    ) / 18
                ),
            2)
            : 0;

        $pdf = Pdf::loadView('admin.laporan.export-pdf', [
            'surveis'     => $surveis,
            'avgSkor'     => $avgSkor,
            'kontenLabel' => $kontenLabel,
        ]);

        return $pdf->download(
            'laporan-survei-' . now()->format('Y-m-d-H-i-s') . '.pdf'
        );
    }
}
