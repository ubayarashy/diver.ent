@extends('layouts.app')

@section('content')
@include('partials.client.sidebar')
@include('partials.client.navbar')

@php
    $verifiedStatuses = ['diverifikasi', 'lunas', 'paid', 'verified'];
@endphp

<div class="client-main">
    <div class="client-content">
        <div class="page-header">
            <div class="page-title">
                <h1><i class="fas fa-money-bill-wave"></i> Pembayaran</h1>
                <p>Kelola tagihan dan unggah bukti transfer pembayaran Anda</p>
            </div>
        </div>

        @if(session('success'))
        <div class="alert-success" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif

        @if(empty($invoices) || count($invoices) === 0)
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
        @else
        <div class="invoice-list">
            @foreach($invoices as $invoice)
            @php
                $isVerified = in_array($invoice->status, $verifiedStatuses, true);
                $proofUrl = $invoice->payment_proof_url;
                $hasProof = $invoice->hasPaymentProofFile();
                $showViewProof = $hasProof && $proofUrl && !$isVerified;
            @endphp
            <article class="invoice-card">
                <div class="invoice-card-header">
                    <div>
                        <span class="invoice-number">{{ $invoice->number }}</span>
                        <h3 class="invoice-title">{{ $invoice->description }}</h3>
                    </div>
                    <span class="invoice-status status-{{ $invoice->status }}">
                        @if($isVerified)
                            <i class="fas fa-check-circle"></i> Lunas
                        @elseif($hasProof)
                            <i class="fas fa-clock"></i> Menunggu Verifikasi
                        @else
                            <i class="fas fa-exclamation-circle"></i> Belum Dibayar
                        @endif
                    </span>
                </div>
                <div class="invoice-meta">
                    <div>
                        <span class="meta-label">Jatuh Tempo</span>
                        <span class="meta-value">{{ \Carbon\Carbon::parse($invoice->due_date)->format('d M Y') }}</span>
                    </div>
                    <div>
                        <span class="meta-label">Total Tagihan</span>
                        <span class="meta-value amount">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                @if(!$isVerified)
                <div class="invoice-upload-section">
                    <p class="upload-label"><i class="fas fa-receipt"></i> Bukti Pembayaran</p>
                    <form
                        action="{{ route('client.payments.upload-proof', $invoice->id) }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="upload-form"
                        id="upload-form-{{ $invoice->id }}"
                    >
                        @csrf
                        <input
                            type="file"
                            name="payment_proof"
                            id="payment-proof-{{ $invoice->id }}"
                            accept="image/*"
                            class="upload-input-hidden"
                            @if(!$hasProof) required @endif
                        >
                        <div class="upload-actions">
                            <div class="upload-actions-left">
                                <label for="payment-proof-{{ $invoice->id }}" class="btn-upload">
                                    <i class="fas fa-cloud-upload-alt"></i> Upload
                                </label>
                                <button type="submit" class="btn-upload-submit" hidden aria-hidden="true">Submit</button>
                            </div>
                            @if($showViewProof)
                            <button
                                type="button"
                                class="btn-view-proof"
                                data-proof-url="{{ $proofUrl }}"
                                aria-label="Lihat bukti pembayaran {{ $invoice->number }}"
                            >
                                Lihat Bukti Pembayaran
                            </button>
                            @endif
                        </div>
                        <p class="upload-hint">Format JPG/PNG, maks. 2MB</p>
                    </form>
                </div>
                @endif
            </article>
            @endforeach
        </div>
        @endif

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

{{-- Modal bukti pembayaran (di luar kartu agar tidak terpotong) --}}
<div class="proof-modal-backdrop" id="proof-payment-modal" aria-hidden="true">
    <div class="proof-modal" role="dialog" aria-modal="true" aria-labelledby="proof-modal-title">
        <button type="button" class="proof-modal-close" id="proof-modal-close" aria-label="Tutup">&times;</button>
        <h3 id="proof-modal-title">Bukti Pembayaran</h3>
        <img src="" alt="Bukti Pembayaran" id="proof-modal-image" class="proof-modal-image">
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

    .alert-success {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 18px;
        margin-bottom: 24px;
        border-radius: 12px;
        background: rgba(16, 185, 129, 0.12);
        border: 1px solid rgba(16, 185, 129, 0.35);
        color: #34d399;
        font-size: 0.9rem;
        font-weight: 500;
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

    /* Invoice List */
    .invoice-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin-bottom: 32px;
    }

    .invoice-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 24px;
        padding: 24px 28px;
    }

    .invoice-card-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--border);
    }

    .invoice-number {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--accent);
    }

    .invoice-title {
        font-family: var(--font-display);
        font-size: 1.05rem;
        font-weight: 700;
        margin-top: 6px;
    }

    .invoice-status {
        font-size: 0.8rem;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 50px;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .invoice-status.status-lunas,
    .invoice-status.status-diverifikasi,
    .invoice-status.status-paid,
    .invoice-status.status-verified {
        background: rgba(16, 185, 129, 0.12);
        color: #34d399;
    }

    .invoice-status.status-pending {
        background: rgba(245, 158, 11, 0.12);
        color: #fbbf24;
    }

    .invoice-meta {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 20px;
    }

    .meta-label {
        display: block;
        font-size: 0.75rem;
        color: var(--text-secondary);
        margin-bottom: 4px;
    }

    .meta-value {
        font-weight: 600;
        font-size: 0.95rem;
    }

    .meta-value.amount {
        color: var(--accent);
    }

    /* Upload section */
    .invoice-upload-section {
        padding-top: 20px;
        border-top: 1px solid var(--border);
    }

    .upload-label {
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 14px;
        color: var(--text-secondary);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .upload-input-hidden {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        border: 0;
    }

    .upload-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .upload-actions-left {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
    }

    .btn-upload,
    .btn-upload-submit {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 22px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.25s ease;
        border: none;
        font-family: inherit;
    }

    .btn-upload {
        background: linear-gradient(135deg, var(--accent), var(--accent-hover));
        color: #07111f;
    }

    .btn-upload:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 210, 255, 0.25);
    }

    .btn-upload-submit {
        background: transparent;
        border: 1px solid var(--border);
        color: var(--text);
    }

    .btn-upload-submit:hover {
        border-color: var(--accent);
        color: var(--accent);
    }

    .btn-view-proof {
        background: transparent;
        border: 2px solid #1e3a8a;
        color: #93c5fd;
        padding: 10px 20px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.25s ease;
        font-family: inherit;
        margin-left: auto;
    }

    .btn-view-proof:hover {
        background: rgba(30, 58, 138, 0.25);
        color: #bfdbfe;
    }

    .upload-hint {
        margin-top: 10px;
        font-size: 0.75rem;
        color: var(--text-secondary);
    }

    /* Proof modal */
    .proof-modal-backdrop {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 2000;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: rgba(0, 0, 0, 0.75);
        backdrop-filter: blur(4px);
    }

    .proof-modal-backdrop.is-open {
        display: flex;
    }

    .proof-modal {
        position: relative;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 28px 24px 24px;
        max-width: 520px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
    }

    .proof-modal-close {
        position: absolute;
        top: 12px;
        right: 14px;
        width: 36px;
        height: 36px;
        border: none;
        background: var(--bg);
        color: var(--text);
        font-size: 1.5rem;
        line-height: 1;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s ease;
    }

    .proof-modal-close:hover {
        background: rgba(239, 68, 68, 0.15);
        color: #f87171;
    }

    .proof-modal h3 {
        font-family: var(--font-display);
        font-size: 1.15rem;
        font-weight: 700;
        margin-bottom: 16px;
        padding-right: 36px;
    }

    .proof-modal-image {
        width: 100%;
        border-radius: 12px;
        border: 1px solid var(--border);
        object-fit: contain;
        max-height: 65vh;
        background: var(--bg);
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

        .invoice-meta {
            grid-template-columns: 1fr;
        }

        .upload-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .upload-actions-left {
            justify-content: flex-start;
        }

        .btn-view-proof {
            margin-left: 0;
            width: 100%;
            justify-content: center;
            text-align: center;
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

        .invoice-card-header {
            flex-direction: column;
        }
    }
</style>

@push('scripts')
<script>
(function () {
    const modal = document.getElementById('proof-payment-modal');
    const modalImage = document.getElementById('proof-modal-image');
    const closeBtn = document.getElementById('proof-modal-close');

    if (!modal || !modalImage || !closeBtn) return;

    function openProofModal(url) {
        modalImage.src = url;
        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeProofModal() {
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        modalImage.src = '';
        document.body.style.overflow = '';
    }

    document.querySelectorAll('.btn-view-proof').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const url = btn.getAttribute('data-proof-url');
            if (url) openProofModal(url);
        });
    });

    closeBtn.addEventListener('click', closeProofModal);

    modal.addEventListener('click', function (e) {
        if (e.target === modal) closeProofModal();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal.classList.contains('is-open')) {
            closeProofModal();
        }
    });

    document.querySelectorAll('.upload-input-hidden').forEach(function (input) {
        input.addEventListener('change', function () {
            if (input.files && input.files.length > 0) {
                input.form.requestSubmit();
            }
        });
    });
})();
</script>
@endpush
@endsection
