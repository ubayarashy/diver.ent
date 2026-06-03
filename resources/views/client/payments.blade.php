@extends('layouts.app')

@section('content')
@include('partials.client.navbar-sidebar')

<div class="app-main">
    <div class="app-content">
        <div class="page-header">
            <div class="page-title">
                <h1><i class="fas fa-money-bill-wave"></i> Pembayaran</h1>
                <p>Kelola invoice dan pembayaran kerjasama Anda</p>
            </div>
        </div>

        <!-- Stats Summary -->
        <div class="stats-summary">
            <div class="stat-card">
                <i class="fas fa-file-invoice"></i>
                <div class="stat-value">{{ $approvedBriefs->count() ?? 0 }}</div>
                <div class="stat-label">Total Invoice</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-hourglass-half"></i>
                <div class="stat-value">{{ $totalUnpaid ?? 0 }}</div>
                <div class="stat-label">Menunggu Pembayaran</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-check-circle"></i>
                <div class="stat-value">Rp {{ number_format($totalPaid ?? 0, 0, ',', '.') }}</div>
                <div class="stat-label">Total Dibayar</div>
            </div>
        </div>

        @if(isset($approvedBriefs) && $approvedBriefs->count() > 0)
            <div class="invoices-list">
                <h3><i class="fas fa-history"></i> Daftar Invoice</h3>
                
                @foreach($approvedBriefs as $brief)
                @php
                    $payment = $brief->payment;
                    $statusColor = 'warning';
                    $statusText = 'Belum Dibayar';
                    if ($payment) {
                        if ($payment->status == 'paid') {
                            $statusColor = 'success';
                            $statusText = 'Lunas';
                        } elseif ($payment->status == 'pending') {
                            $statusColor = 'info';
                            $statusText = 'Menunggu Verifikasi';
                        }
                    }
                @endphp
                <div class="invoice-card">
                    <div class="invoice-header">
                        <div class="invoice-info">
                            <div class="invoice-number">{{ $payment->invoice_number ?? 'Menunggu Pembayaran' }}</div>
                            <div class="invoice-project">{{ $brief->project_name }}</div>
                            <div class="invoice-date">{{ $brief->created_at->format('d M Y') }}</div>
                        </div>
                        <div class="invoice-amount">
                            Rp {{ number_format($brief->budget ?? 0, 0, ',', '.') }}
                        </div>
                        <div class="invoice-status">
                            <span class="status-badge status-{{ $statusColor }}">{{ $statusText }}</span>
                        </div>
                    </div>
                    
                    <div class="invoice-actions">
                        @if(!$payment || $payment->status != 'paid')
                        <button class="btn-pay" onclick="openPaymentModal({{ $brief->id }}, {{ $brief->budget ?? 0 }})">
                            <i class="fas fa-upload"></i> Upload Bukti Pembayaran
                        </button>
                        @endif
                        
                        @if($payment && $payment->payment_proof)
                        <button class="btn-view-proof" onclick="viewProof('{{ asset('storage/' . $payment->payment_proof) }}')">
                            <i class="fas fa-image"></i> Lihat Bukti Pembayaran
                        </button>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @else
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
        @endif

        <!-- Bank Information -->
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

<!-- Payment Modal (Upload) -->
<div id="paymentModal" class="payment-modal">
    <div class="payment-modal-content">
        <div class="payment-modal-header">
            <h3>Upload Bukti Pembayaran</h3>
            <button class="close-modal" onclick="closePaymentModal()">&times;</button>
        </div>
        <form id="paymentForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="brief_id" name="brief_id">
            <div class="form-group">
                <label>Jumlah Pembayaran</label>
                <input type="text" id="amount" name="amount" class="form-input" readonly>
            </div>
            <div class="form-group">
                <label>Upload Bukti Transfer</label>
                <input type="file" name="payment_proof" accept="image/*" required>
                <small>Format: JPG, PNG (Max 2MB)</small>
            </div>
            <div class="payment-modal-footer">
                <button type="button" class="btn-cancel" onclick="closePaymentModal()">Batal</button>
                <button type="submit" class="btn-submit">Upload</button>
            </div>
        </form>
    </div>
</div>

<!-- Preview Modal (Lihat Bukti) - POPUP TIDAK PINDAH TAB -->
<div id="previewModal" class="preview-modal">
    <div class="preview-modal-content">
        <div class="preview-modal-header">
            <h3><i class="fas fa-receipt"></i> Bukti Pembayaran</h3>
            <button class="close-preview" onclick="closePreviewModal()">&times;</button>
        </div>
        <div class="preview-image-container">
            <img id="previewImage" src="" alt="Bukti Pembayaran">
        </div>
        <div class="preview-modal-footer">
            <button class="btn-download" onclick="downloadImage()">
                <i class="fas fa-download"></i> Download
            </button>
            <button class="btn-close-preview" onclick="closePreviewModal()">
                <i class="fas fa-times"></i> Tutup
            </button>
        </div>
    </div>
</div>

<style>
    .app-main {
        margin-left: 300px;
        min-height: 100vh;
        padding-top: 10px;
    }

    .app-content {
        padding: 40px;
        max-width: 1000px;
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

    .stats-summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 24px;
        text-align: center;
        transition: all 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        border-color: var(--accent);
    }

    .stat-card i {
        font-size: 2rem;
        color: var(--accent);
        margin-bottom: 12px;
    }

    .stat-card .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--accent);
    }

    .stat-card .stat-label {
        font-size: 0.8rem;
        color: var(--text-secondary);
    }

    .invoices-list h3 {
        margin-bottom: 20px;
        font-size: 1.2rem;
    }

    .invoice-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 24px;
        margin-bottom: 20px;
        transition: all 0.3s;
    }

    .invoice-card:hover {
        border-color: var(--accent);
    }

    .invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 16px;
    }

    .invoice-number {
        font-weight: 700;
        font-size: 0.85rem;
        color: var(--accent);
    }

    .invoice-project {
        font-weight: 600;
        font-size: 1rem;
    }

    .invoice-date {
        font-size: 0.7rem;
        color: var(--text-secondary);
    }

    .invoice-amount {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--accent);
        flex: 1;
    }

    .invoice-status {
        flex: 1;
    }

    .invoice-info {
        flex: 1;
    }    

    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .status-warning {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    .status-success {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .status-info {
        background: rgba(59, 130, 255, 0.1);
        color: #3b82f6;
    }

    /* ============ TOMBOL YANG DIPERBAIKI ============ */
    .invoice-actions {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid var(--border);
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn-pay {
        background: linear-gradient(135deg, var(--accent), var(--accent-hover));
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-pay:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(59, 130, 255, 0.3);
    }

    /* Tombol Lihat Bukti - LEBIH BESAR & MENARIK */
    .btn-view-proof {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-view-proof:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }

    /* Preview Modal - POPUP */
    .preview-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        backdrop-filter: blur(8px);
        z-index: 1001;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    .preview-modal-content {
        background: var(--surface);
        border-radius: 24px;
        width: 90%;
        max-width: 800px;
        max-height: 90vh;
        overflow: hidden;
        animation: zoomIn 0.3s ease;
        cursor: default;
    }

    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .preview-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 24px;
        border-bottom: 1px solid var(--border);
    }

    .preview-modal-header h3 {
        font-size: 1.2rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .close-preview {
        background: none;
        border: none;
        font-size: 1.8rem;
        cursor: pointer;
        color: var(--text-secondary);
        transition: all 0.2s;
        line-height: 1;
    }

    .close-preview:hover {
        color: #ef4444;
        transform: rotate(90deg);
    }

    .preview-image-container {
        padding: 24px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #0f0f0f;
        max-height: 60vh;
        overflow: auto;
    }

    .preview-image-container img {
        max-width: 100%;
        max-height: 55vh;
        object-fit: contain;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .preview-modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding: 16px 24px;
        border-top: 1px solid var(--border);
    }

    .btn-download {
        background: linear-gradient(135deg, var(--accent), var(--accent-hover));
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 40px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
    }

    .btn-download:hover {
        transform: translateY(-2px);
    }

    .btn-close-preview {
        background: transparent;
        border: 1px solid var(--border);
        color: var(--text-secondary);
        padding: 10px 20px;
        border-radius: 40px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
    }

    .btn-close-preview:hover {
        border-color: #ef4444;
        color: #ef4444;
    }

    /* Payment Modal */
    .payment-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(8px);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .payment-modal-content {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 24px;
        width: 90%;
        max-width: 450px;
        padding: 28px;
    }

    .payment-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .payment-modal-header h3 {
        font-size: 1.3rem;
        font-weight: 700;
    }

    .close-modal {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: var(--text-secondary);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .form-input {
        width: 100%;
        padding: 12px;
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 12px;
        color: var(--text);
    }

    .payment-modal-footer {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        margin-top: 24px;
    }

    .btn-cancel {
        background: transparent;
        border: 1px solid var(--border);
        padding: 10px 20px;
        border-radius: 40px;
        cursor: pointer;
    }

    .btn-submit {
        background: var(--accent);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 40px;
        font-weight: 600;
        cursor: pointer;
    }

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

    .bank-info-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 24px;
        padding: 28px;
        margin-top: 32px;
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
        font-family: monospace;
        font-size: 0.85rem;
        color: var(--text-secondary);
    }

    .bank-owner {
        font-size: 0.8rem;
        color: var(--accent);
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .app-main {
            margin-left: 0;
            padding-top: 70px;
        }
        .app-content {
            padding: 20px;
        }
        .stats-summary {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
        .invoice-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .bank-item {
            flex-wrap: wrap;
        }
        .bank-owner {
            width: 100%;
            margin-left: 64px;
        }
        .empty-state {
            padding: 40px 20px;
        }
        .btn-pay, .btn-view-proof {
            padding: 10px 18px;
            font-size: 0.8rem;
        }
        .preview-modal-content {
            width: 95%;
        }
        .preview-modal-header h3 {
            font-size: 1rem;
        }
    }
</style>

<script>
    let currentBriefId = null;
    let currentImageUrl = null;

    function openPaymentModal(briefId, amount) {
        currentBriefId = briefId;
        document.getElementById('brief_id').value = briefId;
        document.getElementById('amount').value = 'Rp ' + new Intl.NumberFormat('id-ID').format(amount);
        document.getElementById('paymentModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closePaymentModal() {
        document.getElementById('paymentModal').style.display = 'none';
        document.body.style.overflow = 'auto';
        document.getElementById('paymentForm').reset();
    }

    // Fungsi untuk lihat bukti - TAMPIL DI POPUP, BUKAN TAB BARU
    function viewProof(imageUrl) {
        currentImageUrl = imageUrl;
        const previewImg = document.getElementById('previewImage');
        previewImg.src = imageUrl;
        document.getElementById('previewModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closePreviewModal() {
        document.getElementById('previewModal').style.display = 'none';
        document.body.style.overflow = 'auto';
        document.getElementById('previewImage').src = '';
    }

    function downloadImage() {
        if (currentImageUrl) {
            const link = document.createElement('a');
            link.href = currentImageUrl;
            link.download = 'bukti_pembayaran.jpg';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }

    // Tutup preview modal dengan klik ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (document.getElementById('previewModal').style.display === 'flex') {
                closePreviewModal();
            }
            if (document.getElementById('paymentModal').style.display === 'flex') {
                closePaymentModal();
            }
        }
    });

    document.getElementById('paymentForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const fileInput = document.querySelector('input[name="payment_proof"]');
        if (!fileInput.files.length) {
            alert('Silakan pilih file bukti pembayaran');
            return;
        }
        
        const formData = new FormData();
        formData.append('payment_proof', fileInput.files[0]);
        formData.append('amount', document.getElementById('amount').value.replace(/[^0-9]/g, ''));
        formData.append('_token', '{{ csrf_token() }}');
        
        const submitBtn = document.querySelector('.btn-submit');
        submitBtn.disabled = true;
        submitBtn.textContent = 'Mengirim...';
        
        try {
            const response = await fetch('/client/payment/upload/' + currentBriefId, {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert('Gagal upload: ' + (data.message || 'Terjadi kesalahan'));
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan: ' + error.message);
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Upload';
        }
    });

    document.getElementById('paymentModal').addEventListener('click', (e) => {
        if (e.target === document.getElementById('paymentModal')) {
            closePaymentModal();
        }
    });

    document.getElementById('previewModal').addEventListener('click', (e) => {
        if (e.target === document.getElementById('previewModal')) {
            closePreviewModal();
        }
    });
</script>
@endsection