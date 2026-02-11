<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Test data
echo "=== TEST DETAIL JAWABAN SURVEI ===\n\n";

// Ambil survei terakhir
$survei = \App\Models\survei::with('pegawai')->latest()->first();

if (!$survei) {
    echo "❌ Tidak ada survei dalam database!\n";
    exit;
}

echo "✓ Survei ditemukan: ID {$survei->id}\n";
echo "  Konten: " . $survei->kontenSurvei->judul . "\n";
echo "  Pegawai: " . $survei->pegawai->nama . "\n";
echo "  Mode: " . $survei->mode . "\n\n";

// Get questions dengan ordering yang sama dengan controller
$questions = \App\Models\Question::where('konten_survei_id', $survei->konten_survei_id)
    ->orderBy('kategori')
    ->orderBy('id')
    ->get();

echo "✓ Total questions: " . $questions->count() . "\n\n";

// Parse answers
$answers = is_string($survei->answers) ? json_decode($survei->answers, true) : $survei->answers;
if (!is_array($answers)) {
    $answers = [];
}

echo "=== DETAIL JAWABAN ===\n\n";

$questionIndex = 0;
foreach ($questions as $question) {
    $questionIndex++;
    $key = 'q' . $questionIndex;
    $type = $question->type ?? 'scale';
    
    echo "Q{$questionIndex}: {$question->pertanyaan}\n";
    echo "  Tipe: {$type}\n";
    echo "  Kategori: {$question->kategori}\n";
    
    if ($type === 'scale') {
        $nilai = $survei->{$key} ?? null;
        echo "  Jawaban: {$nilai}/5\n";
    } elseif ($type === 'text') {
        $jawaban = $answers[$key] ?? null;
        echo "  Jawaban: " . ($jawaban ? substr($jawaban, 0, 50) . "..." : "-") . "\n";
    } elseif ($type === 'choice') {
        $jawaban = $answers[$key] ?? null;
        echo "  Jawaban (Single Select): " . ($jawaban ?? "-") . "\n";
    } elseif ($type === 'multiple') {
        $jawaban = $answers[$key] ?? [];
        if (is_array($jawaban) && count($jawaban) > 0) {
            echo "  Jawaban (Multiple): " . implode(", ", $jawaban) . "\n";
        } elseif (is_string($jawaban) && $jawaban !== '') {
            echo "  Jawaban (Multiple/String): " . $jawaban . "\n";
        } else {
            echo "  Jawaban (Multiple): -\n";
        }
    }
    echo "\n";
}

echo "✓ Test selesai - semua jawaban harus menampilkan nilai, bukan '- / 5'\n";
