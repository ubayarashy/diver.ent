@extends('layouts.app')

@section('content')
@include('partials.client.sidebar')
@include('partials.client.navbar')

<div class="client-main">
    <div class="client-content">
        <div class="page-header">
            <div class="page-title">
                <h1><i class="fas fa-money-bill-wave"></i> Pembayaran</h1>
                <p>Informasi pembayaran akan muncul setelah kerjasama disetujui</p>
            </div>
        </div>

        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-credit-card"></i>
            </div>
            <h3>Belum Ada Invoice</h3>
            <p>Invoice akan muncul setelah admin menyetujui brief kerjasama Anda.</p>
            <a href="{{ route('client.create-project') }}" class="btn-primary">
                <i class="fas fa-handshake"></i> Ayo Kerjasama
            </a>
        </div>

        <div class="bank-info-card">
            <div class="bank-header">
                <i class="fas fa-university"></i>
                <h4>Informasi Rekening</h4>
            </div>
            <div class="bank-list">
                <div class="bank-item">
                    <div class="bank-icon"><i class="fas fa-building-columns"></i></div>
                    <div class="bank-details">
                        <div class="bank-name">BCA</div>
                        <div class="bank-number">123 456 7890</div>
                    </div>
                    <div class="bank-owner">a.n diver.ent</div>
                </div>
                <div class="bank-item">
                    <div class="bank-icon"><i class="fas fa-building-columns"></i></div>
                    <div class="bank-details">
                        <div class="bank-name">Mandiri</div>
                        <div class="bank-number">987 654 3210</div>
                    </div>
                    <div class="bank-owner">a.n diver.ent</div>
                </div>
                <div class="bank-item">
                    <div class="bank-icon"><i class="fas fa-building-columns"></i></div>
                    <div class="bank-details">
                        <div class="bank-name">BRI</div>
                        <div class="bank-number">567 890 1234</div>
                    </div>
                    <div class="bank-owner">a.n diver.ent</div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .client-main {
        flex: 1;
        margin-left: 300px;
        min-height: 100vh;
    }

    .client-content {
        padding: 40px;
        max-width: 900px;
    }

    .page-header {
        margin-bottom: 32px;
    }

    .page-title h1 {
        font-family: var(--font-display);
        font-size: 2rem;
        font-weight: 800;
        letter-spacing: -1px;
        margin-bottom: 8px;
    }

    .page-title p {
        color: var(--text-secondary);
        font-size: 0.9rem;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 24px;
        margin-bottom: 32px;
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: 20px;
        color: var(--accent);
        opacity: 0.5;
    }

    .empty-state h3 {
        font-family: var(--font-display);
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .empty-state p {
        color: var(--text-secondary);
        margin-bottom: 24px;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--accent), var(--accent-hover));
        color: #fff;
        border: none;
        padding: 12px 28px;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(59, 130, 255, 0.3);
    }

    /* Bank Info Card */
    .bank-info-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 24px;
        padding: 28px;
    }

    .bank-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--border);
    }

    .bank-header i {
        font-size: 1.3rem;
        color: var(--accent);
    }

    .bank-header h4 {
        font-family: var(--font-display);
        font-size: 1.1rem;
        font-weight: 700;
        margin: 0;
    }

    .bank-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .bank-item {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 16px;
        background: var(--bg);
        border-radius: 16px;
        transition: all 0.3s ease;
    }

    .bank-item:hover {
        transform: translateX(6px);
        border-left: 3px solid var(--accent);
    }

    .bank-icon {
        width: 48px;
        height: 48px;
        background: rgba(59, 130, 255, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: var(--accent);
    }

    .bank-details {
        flex: 1;
    }

    .bank-name {
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 4px;
    }

    .bank-number {
        font-family: 'Courier New', monospace;
        font-size: 0.85rem;
        color: var(--text-secondary);
        letter-spacing: 1px;
    }

    .bank-owner {
        font-size: 0.8rem;
        color: var(--accent);
        font-weight: 500;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .client-main {
            margin-left: 0;
            padding-top: 70px;
        }

        .client-content {
            padding: 20px;
        }

        .bank-item {
            flex-wrap: wrap;
            gap: 12px;
        }

        .bank-owner {
            width: 100%;
            margin-left: 64px;
        }

        .empty-state {
            padding: 40px 20px;
        }

        .empty-icon {
            font-size: 3rem;
        }

        .empty-state h3 {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 480px) {
        .bank-item {
            flex-direction: column;
            text-align: center;
        }

        .bank-owner {
            margin-left: 0;
        }

        .bank-icon {
            margin: 0 auto;
        }
    }
</style>
@endsection