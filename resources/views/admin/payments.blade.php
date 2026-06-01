@extends('layouts.app')

@section('content')
@include('admin.sidebar')

<div class="admin-main">
    <div class="admin-content">
        <div class="page-header">
            <h1><i class="fas fa-money-bill-wave"></i> Manajemen Pembayaran</h1>
            <p>Kelola verifikasi bukti pembayaran dari client</p>
        </div>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value">{{ $payments->count() }}</div>
                <div class="stat-label">Total Transaksi</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $pendingCount ?? 0 }}</div>
                <div class="stat-label">Menunggu Verifikasi</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</div>
                <div class="stat-label">Total Revenue</div>
            </div>
        </div>

        <!-- Payments Table -->
        <div class="data-table">
            <table>
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Client</th>
                        <th>Project</th>
                        <th>Amount (Rp)</th>
                        <th>Bukti Transfer</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->invoice_number }}</td>
                        <td>{{ $payment->brief->user->name ?? '-' }}</td>
                        <td>{{ $payment->brief->project_name }}</td>
                        <td>{{ number_format($payment->amount, 0, ',', '.') }}</td>
                        <td>
                            @if($payment->payment_proof)
                                <a href="{{ asset('storage/' . $payment->payment_proof) }}" target="_blank" class="btn-link">
                                    <i class="fas fa-image"></i> Lihat
                                </a>
                            @else
                                <span class="text-muted">Belum upload</span>
                            @endif
                        </td>
                        <td>
                            @if($payment->status == 'paid')
                                <span class="status-badge status-success">✓ Lunas</span>
                            @elseif($payment->status == 'pending')
                                <span class="status-badge status-warning">⏳ Menunggu Verifikasi</span>
                            @else
                                <span class="status-badge status-danger">⚠️ Belum Dibayar</span>
                            @endif
                        </td>
                        <td class="actions">
                            @if($payment->status == 'pending')
                                <form action="{{ route('admin.payment.verify', $payment->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn-verify" onclick="return confirm('Verifikasi pembayaran ini?')">
                                        <i class="fas fa-check-circle"></i> Verifikasi
                                    </button>
                                </form>
                                <form action="{{ route('admin.payment.reject', $payment->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn-reject" onclick="return confirm('Tolak pembayaran ini?')">
                                        <i class="fas fa-times-circle"></i> Tolak
                                    </button>
                                </form>
                            @elseif($payment->status == 'paid')
                                <span class="text-success">Terverifikasi</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data pembayaran</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .admin-main {
    margin-left: 280px;
    min-height: 100vh;
    padding-top:20px;
}
    
    .admin-content {
        padding: 32px;
    }
    
    .page-header h1 {
        font-family: var(--font-display);
        font-size: 1.8rem;
        margin-bottom: 8px;
    }
    
    .page-header p {
        color: var(--text-secondary);
        margin-bottom: 24px;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        margin-bottom: 32px;
    }
    
    .stat-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 24px;
        text-align: center;
    }
    
    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--accent);
    }
    
    .stat-label {
        font-size: 0.8rem;
        color: var(--text-secondary);
        margin-top: 8px;
    }
    
    .data-table {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow-x: auto;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    th, td {
        padding: 16px;
        text-align: left;
        border-bottom: 1px solid var(--border);
    }
    
    th {
        background: rgba(59, 130, 255, 0.05);
        font-weight: 600;
    }
    
    tr:last-child td {
        border-bottom: none;
    }
    
    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-block;
    }
    
    .status-success {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }
    
    .status-warning {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }
    
    .status-danger {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }
    
    .btn-link {
        color: var(--accent);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .btn-link:hover {
        text-decoration: underline;
    }
    
    .btn-verify {
        background: #10b981;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.75rem;
        margin-right: 8px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .btn-reject {
        background: #ef4444;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .text-center {
        text-align: center;
    }
    
    .text-muted {
        color: var(--text-secondary);
    }
    
    .text-success {
        color: #10b981;
        font-size: 0.75rem;
    }
    
    .actions {
        white-space: nowrap;
    }
    
    @media (max-width: 768px) {
        .admin-main {
            margin-left: 0;
        }
        .admin-content {
            padding: 20px;
        }
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        th, td {
            padding: 12px;
            font-size: 0.8rem;
        }
        .btn-verify, .btn-reject {
            padding: 4px 10px;
            font-size: 0.7rem;
        }
        .actions {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }
    }
</style>
@endsection