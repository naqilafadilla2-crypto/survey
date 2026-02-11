<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\survei;
use App\Models\konten_survei;
use App\Models\pegawai;
use App\Models\Question;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

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

            $direktoratStats[] = [
                'nama'          => ucwords(str_replace('_', ' ', $dir)),
                'total_pegawai' => $totalPegawaiDirektorat,
                'total_survei'  => $totalSurveiDirektorat,
            ];
        }

        // =============================
        // TREND JUMLAH SURVEI BULANAN (6 BULAN)
        // =============================
        $monthlyTrend = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);

            $count = survei::when($kontenId, fn ($q) =>
                $q->where('konten_survei_id', $kontenId)
            )->when($modeFilter, fn ($q) =>
                $q->where('mode', $modeFilter)
            )
            ->whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->count();

            $monthlyTrend[] = [
                'month' => $month->format('M Y'),
                'count' => $count,
            ];
        }

        return view('admin.laporan.index', compact(
            'totalSurvei',
            'totalPegawai',
            'kontenAktif',
            'totalPertanyaan',
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
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('admin.laporan.export-pdf', [
            'surveis'     => $surveis,
            'kontenLabel' => $kontenLabel,
        ]);

        return $pdf->download(
            'laporan-survei-' . now()->format('Y-m-d-H-i-s') . '.pdf'
        );
    }

    /**
     * Export laporan ke Excel (.xlsx) dengan kolom rapi dan lebar otomatis
     */
    public function exportExcel(Request $request)
    {
        $kontenId = $request->get('konten_id');
        $modeFilter = $request->get('mode');

        if ($kontenId) {
            $konten = konten_survei::find($kontenId);
        }

        $surveis = survei::with(['pegawai', 'kontenSurvei'])
            ->when($kontenId, fn ($q) =>
                $q->where('konten_survei_id', $kontenId)
            )->when($modeFilter, fn ($q) =>
                $q->where('mode', $modeFilter)
            )
            ->orderBy('created_at', 'desc')
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan Survei');

        // Header (baris 1)
        $headers = [
            'A1' => 'No',
            'B1' => 'Mode',
            'C1' => 'Nama Pegawai',
            'D1' => 'Direktorat',
            'E1' => 'Divisi',
            'F1' => 'Status Pegawai',
            'G1' => 'Lama Bekerja',
            'H1' => 'Konten Survei',
            'I1' => 'Tanggal',
        ];
        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        // Gaya header: tebal, background abu-abu
        $headerRange = 'A1:I1';
        $sheet->getStyle($headerRange)->getFont()->setBold(true);
        $sheet->getStyle($headerRange)->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB('E5E7EB');
        $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Data
        $row = 2;
        foreach ($surveis as $index => $survei) {
            $pegawai = $survei->pegawai;
            $konten = $survei->kontenSurvei;
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $survei->mode === 'public' ? 'Public' : 'Internal');
            $sheet->setCellValue('C' . $row, $pegawai->nama ?? '-');
            $sheet->setCellValue('D' . $row, ucwords(str_replace('_', ' ', $pegawai->direktorat ?? '-')));
            $sheet->setCellValue('E' . $row, $pegawai->divisi ?? '-');
            $sheet->setCellValue('F' . $row, $pegawai->status_pegawai ?? '-');
            $sheet->setCellValue('G' . $row, ucwords(str_replace('_', ' ', $pegawai->lama_bekerja ?? '-')));
            $sheet->setCellValue('H' . $row, $konten->judul ?? '-');
            // Tanggal: simpan sebagai nilai Excel lalu format tampilan (kolom I auto-size agar tidak #####)
            $sheet->setCellValue('I' . $row, ExcelDate::PHPToExcel($survei->created_at));
            $sheet->getStyle('I' . $row)->getNumberFormat()->setFormatCode('dd/mm/yyyy hh:mm');
            $row++;
        }

        // Auto-size kolom agar teks tidak terpotong
        foreach (range('A', 'I') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        // Kolom Tanggal: lebar minimum agar format dd/mm/yyyy hh:mm tidak tampil #####
        $sheet->getColumnDimension('I')->setWidth(20);

        // Border ringan untuk tabel
        $dataRange = 'A1:I' . ($row - 1);
        $sheet->getStyle($dataRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        $filename = 'laporan-survei-' . now()->format('Y-m-d-H-i-s') . '.xlsx';

        $writer = new Xlsx($spreadsheet);
        $tempFile = storage_path('app/temp_' . $filename);
        $writer->save($tempFile);

        $response = response()->download($tempFile, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);

        return $response;
    }
}
