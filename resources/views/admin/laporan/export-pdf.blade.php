<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Survei</title>
    <style>
        @page {
            margin: 20mm;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10pt;
            color: #2d3748;
            line-height: 1.6;
            background: #ffffff;
        }
        
        /* Header */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px 30px;
            margin: -20mm -20mm 25px -20mm;
            text-align: center;
            border-bottom: 4px solid #5a67d8;
        }
        
        .header h1 {
            font-size: 26pt;
            font-weight: bold;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }
        
        .header p {
            font-size: 11pt;
            opacity: 0.95;
            font-weight: 300;
        }
        
        /* Info Section */
        .info-section {
            margin-bottom: 25px;
            padding: 18px 20px;
            background: linear-gradient(to right, #f7fafc 0%, #edf2f7 100%);
            border-left: 4px solid #667eea;
            border-radius: 4px;
        }
        
        .info-grid {
            display: table;
            width: 100%;
        }
        
        .info-item {
            display: table-cell;
            padding: 5px 0;
            vertical-align: top;
        }
        
        .info-item strong {
            color: #667eea;
            font-weight: 700;
            display: inline-block;
            min-width: 140px;
        }
        
        .info-item span {
            color: #4a5568;
        }
        
        /* Summary Cards */
        .summary-section {
            margin-bottom: 25px;
        }
        
        .summary-grid {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        
        .summary-card {
            display: table-cell;
            width: 32%;
            padding: 0 10px;
            vertical-align: top;
        }
        
        .summary-box {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 18px 15px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .summary-box h3 {
            color: #667eea;
            font-size: 9pt;
            font-weight: 600;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .summary-box .value {
            font-size: 28pt;
            font-weight: bold;
            color: #2d3748;
            line-height: 1.2;
            margin-bottom: 5px;
        }
        
        .summary-box .label {
            font-size: 8pt;
            color: #718096;
            margin-top: 5px;
        }
        
        .summary-box.primary {
            border-color: #667eea;
            background: linear-gradient(135deg, #667eea10 0%, #764ba210 100%);
        }
        
        .summary-box.success {
            border-color: #48bb78;
            background: linear-gradient(135deg, #48bb7810 0%, #38a16910 100%);
        }
        
        .summary-box.warning {
            border-color: #ed8936;
            background: linear-gradient(135deg, #ed893610 0%, #dd6b2010 100%);
        }
        
        /* Table */
        .table-wrapper {
            margin-bottom: 25px;
        }
        
        .table-title {
            font-size: 12pt;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 3px solid #667eea;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        th {
            padding: 12px 10px;
            text-align: left;
            font-weight: 700;
            font-size: 8.5pt;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
        }
        
        th.text-center {
            text-align: center;
        }
        
        td {
            padding: 11px 10px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 9pt;
            color: #4a5568;
        }
        
        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        tbody tr:last-child td {
            border-bottom: none;
        }
        
        tbody tr:hover {
            background-color: #edf2f7;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        /* Badge */
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 8.5pt;
            font-weight: 600;
            text-align: center;
        }
        
        .badge-success {
            background-color: #c6f6d5;
            color: #22543d;
            border: 1px solid #9ae6b4;
        }
        
        .badge-warning {
            background-color: #feebc8;
            color: #7c2d12;
            border: 1px solid #fbd38d;
        }
        
        .badge-danger {
            background-color: #fed7d7;
            color: #742a2a;
            border: 1px solid #fc8181;
        }
        
        /* Footer */
        .footer {
            margin-top: 40px;
            padding-top: 15px;
            border-top: 2px solid #e2e8f0;
            text-align: center;
            color: #718096;
            font-size: 8pt;
        }
        
        .footer p {
            margin: 3px 0;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #a0aec0;
        }
        
        .empty-state p {
            font-size: 14pt;
            margin-top: 10px;
        }
        
        /* Utility */
        .page-break {
            page-break-before: always;
        }
        
        .mb-20 {
            margin-bottom: 20px;
        }
        
        .mt-20 {
            margin-top: 20px;
        }
        
        /* Text Formatting */
        .text-muted {
            color: #718096;
        }
        
        .font-bold {
            font-weight: 700;
        }
        
        /* Responsive adjustments for PDF */
        @media print {
            .page-break {
                page-break-before: always;
            }
            
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>Laporan Survei</h1>
        <p>SurveyApp - Sistem Survei Internal</p>
    </div>
    
    <!-- Info Section -->
    <div class="info-section">
        <div class="info-grid">
            <div class="info-item">
                <strong>Konten:</strong>
                <span>{{ $kontenLabel ?? 'Semua Konten' }}</span>
            </div>
        </div>
        <div class="info-grid">
            <div class="info-item">
                <strong>Tanggal Cetak:</strong>
                <span>{{ now()->format('d F Y, H:i:s') }}</span>
            </div>
        </div>
        <div class="info-grid">
            <div class="info-item">
                <strong>Total Respons:</strong>
                <span>{{ count($surveis) }} data survei</span>
            </div>
        </div>
    </div>
    
    @if(count($surveis) > 0)
        <!-- Summary Cards -->
        <div class="summary-section">
            <div class="summary-grid">
                @if(isset($avgSkor))
                <div class="summary-card">
                    <div class="summary-box primary">
                        <h3>Rata-rata Skor</h3>
                        <div class="value">{{ number_format($avgSkor, 2) }}</div>
                        <div class="label">dari skala 5.00</div>
                    </div>
                </div>
                @endif
                
                <div class="summary-card">
                    <div class="summary-box success">
                        <h3>Total Respons</h3>
                        <div class="value">{{ count($surveis) }}</div>
                        <div class="label">respons survei</div>
                    </div>
                </div>
                
                @php
                    $totalUniquePegawai = $surveis->unique('pegawai_id')->count();
                @endphp
                
                <div class="summary-card">
                    <div class="summary-box warning">
                        <h3>Responden</h3>
                        <div class="value">{{ $totalUniquePegawai }}</div>
                        <div class="label">pegawai berpartisipasi</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Data Table -->
        <div class="table-wrapper">
            <div class="table-title">📋 Detail Data Survei</div>
            <table>
                <thead>
                    <tr>
                        <th style="width: 4%;">No</th>
                        <th style="width: 10%;">Mode</th>
                        <th style="width: 20%;">Nama Pegawai</th>
                        <th style="width: 16%;">Direktorat</th>
                        <th style="width: 26%;">Konten Survei</th>
                        <th style="width: 10%;" class="text-center">Skor</th>
                        <th style="width: 14%;" class="text-center">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($surveis as $index => $survei)
                        @php
                            $skor = ($survei->q1 + $survei->q2 + $survei->q3 + $survei->q4 + $survei->q5 +
                                    $survei->q6 + $survei->q7 + $survei->q8 + $survei->q9 + $survei->q10 +
                                    $survei->q11 + $survei->q12 + $survei->q13 + $survei->q14 + $survei->q15 +
                                    $survei->q16 + $survei->q17 + $survei->q18) / 18;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">
                                @if($survei->mode === 'public')
                                    <span class="badge badge-success" style="background-color: #dbeafe; color: #1e40af; border: 1px solid #93c5fd;">Public</span>
                                @else
                                    <span class="badge badge-success" style="background-color: #d1fae5; color: #065f46; border: 1px solid #6ee7b7;">Internal</span>
                                @endif
                            </td>
                            <td class="font-bold">{{ $survei->pegawai->nama ?? 'N/A' }}</td>
                            <td>{{ ucwords(str_replace('_', ' ', $survei->pegawai->direktorat ?? 'N/A')) }}</td>
                            <td>@php
                                $judul = $survei->kontenSurvei->judul ?? 'N/A';
                                echo mb_strlen($judul) > 50 ? mb_substr($judul, 0, 47) . '...' : $judul;
                            @endphp</td>
                            <td class="text-center">
                                <span class="badge 
                                    @if($skor >= 4) badge-success
                                    @elseif($skor >= 3) badge-warning
                                    @else badge-danger
                                    @endif">
                                    {{ number_format($skor, 2) }}
                                </span>
                            </td>
                            <td class="text-center text-muted">{{ $survei->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Statistics Summary -->
        @php
            $allScores = $surveis->map(function($survei) {
                return ($survei->q1 + $survei->q2 + $survei->q3 + $survei->q4 + $survei->q5 +
                       $survei->q6 + $survei->q7 + $survei->q8 + $survei->q9 + $survei->q10 +
                       $survei->q11 + $survei->q12 + $survei->q13 + $survei->q14 + $survei->q15 +
                       $survei->q16 + $survei->q17 + $survei->q18) / 18;
            });
            
            $skorTinggi = $allScores->count() > 0 ? $allScores->max() : 0;
            $skorRendah = $allScores->count() > 0 ? $allScores->min() : 0;
        @endphp
        
        @if($surveis->count() > 0)
        <div class="info-section mt-20">
            <div class="table-title" style="margin-bottom: 12px; border: none; padding: 0;">📊 Ringkasan Statistik</div>
            <div class="info-grid">
                <div class="info-item">
                    <strong>Skor Tertinggi:</strong>
                    <span class="font-bold">{{ number_format($skorTinggi, 2) }}</span>
                </div>
                <div class="info-item">
                    <strong>Skor Terendah:</strong>
                    <span class="font-bold">{{ number_format($skorRendah, 2) }}</span>
                </div>
                <div class="info-item">
                    <strong>Rentang Skor:</strong>
                    <span>{{ number_format($skorRendah, 2) }} - {{ number_format($skorTinggi, 2) }}</span>
                </div>
            </div>
        </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="empty-state">
            <p>📭 Tidak ada data survei untuk periode ini.</p>
        </div>
    @endif
    
    <!-- Footer -->
    <div class="footer">
        <p><strong>Laporan ini dibuat secara otomatis oleh sistem SurveyApp</strong></p>
        <p class="text-muted">Halaman 1 | Dihasilkan pada {{ now()->format('d F Y H:i:s') }}</p>
    </div>
</body>
</html>
