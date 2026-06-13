<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pembayaran</title>
    <style>
        body {
            font-family: 'DejaVu Sans', 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #3b82ff;
            padding-bottom: 20px;
        }
        
        .header h1 {
            color: #3b82ff;
            margin: 0;
            font-size: 24px;
        }
        
        .header p {
            margin: 5px 0;
            color: #666;
        }
        
        .info-section {
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        
        .info-grid {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .info-item {
            flex: 1;
        }
        
        .info-label {
            font-weight: bold;
            color: #555;
            font-size: 11px;
            margin-bottom: 5px;
        }
        
        .info-value {
            font-size: 16px;
            font-weight: bold;
            color: #3b82ff;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th {
            background: #3b82ff;
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 11px;
        }
        
        td {
            padding: 8px 10px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 10px;
        }
        
        tr:hover {
            background: #f5f5f5;
        }
        
        .status-badge {
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
            display: inline-block;
        }
        
        .status-success {
            background: #d4edda;
            color: #155724;
        }
        
        .status-warning {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-danger {
            background: #f8d7da;
            color: #721c24;
        }
        
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            text-align: center;
            font-size: 9px;
            color: #999;
        }
        
        .signature {
            margin-top: 40px;
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-muted {
            color: #999;
        }
        
        .amount {
            font-weight: bold;
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Manajemen Pembayaran</h1>
        <p>PT. Creative Digital Agency</p>
        <p>Periode: {{ $exportDate }}</p>
    </div>
    
    <div class="info-section">
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Total Transaksi</div>
                <div class="info-value">{{ $payments->count() }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Menunggu Verifikasi</div>
                <div class="info-value">{{ $pendingCount }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Total Revenue</div>
                <div class="info-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Invoice</th>
                <th>Client</th>
                <th>Project</th>
                <th>Amount</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $index => $payment)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $payment->invoice_number }}</td>
                <td>{{ $payment->brief->user->name ?? '-' }}</td>
                <td>{{ Str::limit($payment->brief->project_name ?? '-', 30) }}</td>
                <td class="amount">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                <td>{{ $payment->created_at ? $payment->created_at->format('d/m/Y') : '-' }}</td>
                <td>
                    @if($payment->status == 'paid')
                        <span class="status-badge status-success">✓ Lunas</span>
                    @elseif($payment->status == 'pending')
                        <span class="status-badge status-warning">⏳ Menunggu Verifikasi</span>
                    @else
                        <span class="status-badge status-danger">⚠️ Belum Dibayar</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-muted">Belum ada data pembayaran</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="signature">
        <p>Mengetahui,</p>
        <p>Admin</p>
        <br><br>
        <p><strong>{{ $adminName }}</strong></p>
    </div>
    
    <div class="footer">
        <p>Dokumen ini dicetak secara otomatis dari sistem pada {{ $exportDate }}</p>
        <p>© {{ date('Y') }} Creative Digital Agency - All rights reserved</p>
    </div>
</body>
</html>