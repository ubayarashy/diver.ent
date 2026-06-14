@extends('layouts.app')
@section('content')
@include('partials.client.navbar-sidebar')

<div class="app-main">
    <div class="app-content">
        <div class="page-header">
            <h1>Pembayaran</h1>
            <p>Kelola invoice dan pembayaran kerjasama Anda</p>
        </div>

        <div class="stats-summary">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-file-invoice"></i></div>
                <div class="stat-value">{{ $approvedBriefs->count() ?? 0 }}</div>
                <div class="stat-label">Total Invoice</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-hourglass-half"></i></div>
                <div class="stat-value">{{ $totalUnpaid ?? 0 }}</div>
                <div class="stat-label">Menunggu Pembayaran</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                <div class="stat-value">Rp {{ number_format($totalPaid ?? 0, 0, ',', '.') }}</div>
                <div class="stat-label">Total Dibayar</div>
            </div>
        </div>

        @if(isset($approvedBriefs) && $approvedBriefs->count() > 0)
            <div class="invoices-section">
                <div class="section-header">
                    <h3>Daftar Invoice</h3>
                </div>
                <div class="invoices-list">
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
                            <div class="invoice-amount">Rp {{ number_format($brief->budget ?? 0, 0, ',', '.') }}</div>
                            <div class="invoice-status">
                                <span class="status-badge status-{{ $statusColor }}">{{ $statusText }}</span>
                            </div>
                        </div>
                        <div class="invoice-actions">
                            @if(!$payment || $payment->status != 'paid')
                            <button class="btn-pay" onclick="openPaymentModal({{ $brief->id }}, {{ $brief->budget ?? 0 }})">Upload Bukti Pembayaran</button>
                            @endif
                            @if($payment && $payment->payment_proof)
                            <button class="btn-view-proof" onclick="viewProof('{{ asset('storage/' . $payment->payment_proof) }}')">Lihat Bukti Pembayaran</button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon"><i class="fas fa-credit-card"></i></div>
                <h3>Belum Ada Invoice</h3>
                <p>Invoice akan muncul setelah admin menyetujui brief kerjasama Anda.</p>
                <a href="{{ route('client.create-project') }}" class="btn-primary">Ayo Kerjasama</a>
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

<div id="paymentModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Upload Bukti Pembayaran</h3>
            <button class="modal-close" onclick="closePaymentModal()">&times;</button>
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
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closePaymentModal()">Batal</button>
                <button type="submit" class="btn-primary">Upload</button>
            </div>
        </form>
    </div>
</div>

<div id="previewModal" class="modal preview-modal">
    <div class="modal-content preview-content">
        <div class="modal-header">
            <h3>Bukti Pembayaran</h3>
            <button class="modal-close" onclick="closePreviewModal()">&times;</button>
        </div>
        <div class="preview-image-container">
            <img id="previewImage" src="" alt="Bukti Pembayaran">
        </div>
        <div class="modal-footer preview-footer">
            <button class="btn-download" onclick="downloadImage()">Download</button>
            <button class="btn-secondary" onclick="closePreviewModal()">Tutup</button>
        </div>
    </div>
</div>

<style>
.app-main {
    margin-left: 280px;
    min-height: 80vh;
    background: var(--bg);
    padding-top: 10px;
}

.app-content {
    max-width: 1000px;
    margin: 0 auto;
    padding: 40px 48px;
}

.page-header {
    margin-bottom: 32px;
}

.page-header h1 {
    font-family: var(--font-display);
    font-size: 1.8rem;
    font-weight: 700;
    letter-spacing: -0.02em;
    margin-bottom: 8px;
}

.page-header p {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.stats-summary {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 40px;
}

.stat-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 24px;
    text-align: center;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-3px);
    border-color: var(--accent);
}

.stat-icon {
    font-size: 1.8rem;
    margin-bottom: 12px;
    color: var(--accent);
}

.stat-value {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 4px;
    font-family: monospace;
    letter-spacing: 0.5px;
}

.stat-label {
    font-size: 0.8rem;
    color: var(--text-secondary);
}

.section-header {
    margin-bottom: 20px;
}

.section-header h3 {
    font-size: 1.1rem;
    font-weight: 600;
}

.invoices-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
    margin-bottom: 32px;
}

.invoice-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 20px 24px;
    transition: all 0.3s ease;
}

.invoice-card:hover {
    border-color: var(--accent);
    transform: translateY(-2px);
}

.invoice-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 16px;
}

.invoice-info {
    flex: 3;
}

.invoice-number {
    font-size: 0.7rem;
    color: var(--accent);
    font-weight: 500;
    margin-bottom: 4px;
}

.invoice-project {
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 4px;
}

.invoice-date {
    font-size: 0.65rem;
    color: var(--text-secondary);
}

.invoice-amount {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--accent);
    flex: 1;
    text-align: right;
    font-family: monospace;
    letter-spacing: 0.5px;
    white-space: nowrap;
}

.invoice-status {
    flex: 1;
    text-align: right;
}

.status-badge {
    padding: 4px 12px;
    border-radius: 30px;
    font-size: 0.7rem;
    font-weight: 600;
    display: inline-block;
    white-space: nowrap;
}

.status-warning {
    background: rgba(245, 158, 11, 0.12);
    color: #f59e0b;
}

.status-success {
    background: rgba(16, 185, 129, 0.12);
    color: #10b981;
}

.status-info {
    background: rgba(59, 130, 255, 0.12);
    color: var(--accent);
}

.invoice-actions {
    margin-top: 16px;
    padding-top: 16px;
    border-top: 1px solid var(--border);
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.btn-pay, .btn-view-proof, .btn-primary, .btn-secondary {
    padding: 10px 22px;
    border-radius: 40px;
    font-weight: 600;
    font-size: 0.8rem;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border: none;
}

.btn-pay {
    background: var(--accent);
    color: #000;
}

.btn-pay:hover {
    transform: translateY(-2px);
    opacity: 0.9;
}

.btn-view-proof {
    background: #10b981;
    color: #fff;
}

.btn-view-proof:hover {
    transform: translateY(-2px);
    opacity: 0.9;
}

.btn-primary {
    background: var(--accent);
    color: #000;
}

.btn-primary:hover {
    transform: translateY(-2px);
    opacity: 0.9;
}

.btn-secondary {
    background: transparent;
    border: 1px solid var(--border);
    color: var(--text);
}

.btn-secondary:hover {
    border-color: var(--accent);
    color: var(--accent);
}

.btn-download {
    background: var(--accent);
    color: #000;
    padding: 10px 22px;
    border-radius: 40px;
    font-weight: 600;
    font-size: 0.8rem;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-download:hover {
    transform: translateY(-2px);
    opacity: 0.9;
}

.empty-state {
    text-align: center;
    padding: 60px 24px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    margin-bottom: 32px;
}

.empty-icon {
    font-size: 3.5rem;
    margin-bottom: 16px;
    color: var(--text-secondary);
    opacity: 0.4;
}

.empty-state h3 {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 8px;
}

.empty-state p {
    color: var(--text-secondary);
    font-size: 0.85rem;
    margin-bottom: 24px;
}

.bank-info-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 24px;
}

.bank-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--border);
}

.bank-header i {
    font-size: 1.2rem;
    color: var(--accent);
}

.bank-header h4 {
    font-size: 1rem;
    font-weight: 600;
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
    padding: 14px 16px;
    background: var(--bg);
    border-radius: 16px;
    transition: all 0.3s ease;
}

.bank-item:hover {
    transform: translateX(4px);
    border-left: 3px solid var(--accent);
}

.bank-icon {
    width: 44px;
    height: 44px;
    background: rgba(59, 130, 255, 0.08);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    color: var(--accent);
}

.bank-details {
    flex: 1;
}

.bank-name {
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 4px;
}

.bank-number {
    font-family: monospace;
    font-size: 0.8rem;
    color: var(--text-secondary);
}

.bank-owner {
    font-size: 0.75rem;
    color: var(--accent);
}

.modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(6px);
    z-index: 1000;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 24px;
    width: 90%;
    max-width: 450px;
    overflow: hidden;
}

.preview-content {
    max-width: 800px;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 24px;
    border-bottom: 1px solid var(--border);
}

.modal-header h3 {
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: var(--text-secondary);
    transition: color 0.2s;
    line-height: 1;
}

.modal-close:hover {
    color: #ef4444;
}

.form-group {
    padding: 0 24px;
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    font-size: 0.85rem;
}

.form-input {
    width: 100%;
    padding: 12px 14px;
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 12px;
    color: var(--text);
    font-size: 0.9rem;
}

.form-input:focus {
    outline: none;
    border-color: var(--accent);
}

.form-group small {
    display: block;
    margin-top: 6px;
    font-size: 0.65rem;
    color: var(--text-secondary);
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    padding: 20px 24px;
    border-top: 1px solid var(--border);
}

.preview-image-container {
    padding: 24px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #0a0a0a;
    max-height: 60vh;
    overflow: auto;
}

.preview-image-container img {
    max-width: 100%;
    max-height: 55vh;
    object-fit: contain;
    border-radius: 12px;
}

.preview-footer {
    justify-content: space-between;
}

@media (max-width: 992px) {
    .app-main {
        margin-left: 0;
    }
    .app-content {
        padding: 32px 24px;
    }
}

@media (max-width: 768px) {
    .app-content {
        padding: 24px 20px;
    }
    .stats-summary {
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
    }
    .invoice-header {
        flex-direction: column;
        align-items: stretch;
    }
    .invoice-amount {
        text-align: left;
        margin-top: 4px;
    }
    .invoice-status {
        text-align: left;
    }
    .bank-item {
        flex-wrap: wrap;
    }
    .bank-owner {
        margin-left: 60px;
    }
    .modal-content {
        width: 95%;
    }
    .btn-pay, .btn-view-proof {
        padding: 8px 18px;
        font-size: 0.75rem;
    }
}

.reveal {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.7s ease, transform 0.7s ease;
}

.reveal.active {
    opacity: 1;
    transform: translateY(0);
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

    function viewProof(imageUrl) {
        currentImageUrl = imageUrl;
        document.getElementById('previewImage').src = imageUrl;
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

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (document.getElementById('previewModal').style.display === 'flex') closePreviewModal();
            if (document.getElementById('paymentModal').style.display === 'flex') closePaymentModal();
        }
    });

    document.getElementById('paymentModal').addEventListener('click', (e) => {
        if (e.target === document.getElementById('paymentModal')) closePaymentModal();
    });

    document.getElementById('previewModal').addEventListener('click', (e) => {
        if (e.target === document.getElementById('previewModal')) closePreviewModal();
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
        
        const submitBtn = document.querySelector('#paymentForm .btn-primary');
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
            alert('Terjadi kesalahan: ' + error.message);
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Upload';
        }
    });

    const reveals = document.querySelectorAll('.reveal');
    function reveal() {
        reveals.forEach(el => {
            const windowHeight = window.innerHeight;
            const revealTop = el.getBoundingClientRect().top;
            const revealPoint = 100;
            if (revealTop < windowHeight - revealPoint) el.classList.add('active');
        });
    }
    window.addEventListener('scroll', reveal);
    window.addEventListener('load', reveal);
</script>
@endsection