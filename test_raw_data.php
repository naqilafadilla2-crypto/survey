<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$survei = \App\Models\survei::with('pegawai')->latest('id')->first();

if (!$survei) {
    echo "❌ Tidak ada survei!\n";
    exit;
}

echo "=== RAW DATABASE VALUE ===\n";
echo "Survei ID: " . $survei->id . "\n";
echo "Answers (raw): " . json_encode($survei->answers) . "\n\n";

echo "=== Q COLUMNS ===\n";
for ($i = 1; $i <= 5; $i++) {
    $col = 'q' . $i;
    $val = $survei->{$col} ?? "NULL";
    echo "q{$i}: {$val}\n";
}

echo "\n=== PARSED ANSWERS ===\n";
$answers = is_string($survei->answers) ? json_decode($survei->answers, true) : $survei->answers;
if (is_array($answers)) {
    echo json_encode($answers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
} else {
    echo "Not an array or NULL\n";
}
