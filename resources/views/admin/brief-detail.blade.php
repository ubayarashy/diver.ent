@extends('layouts.app')

@section('content')
@include('admin.sidebar')

<div class="admin-main">
    <div class="admin-content">
        <div class="detail-header">
            <a href="{{ route('admin.briefs') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h1>Detail Brief</h1>
            <p>Informasi lengkap dari client</p>
        </div>

        <div class="detail-card">
            <div class="detail-section">
                <h3><i class="fas fa-user"></i> Informasi Client</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">Nama</span>
                        <span class="detail-value">{{ $brief->user->name ?? 'Unknown' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Email</span>
                        <span class="detail-value">{{ $brief->user->email ?? '-' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tanggal Kirim</span>
                        <span class="detail-value">{{ $brief->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Status</span>
                        <span class="detail-value status-field">
                            <select id="statusSelect" data-id="{{ $brief->id }}" class="status-select">
                                <option value="pending" {{ $brief->status == 'pending' ? 'selected' : '' }}>⏳ Menunggu</option>
                                <option value="contacted" {{ $brief->status == 'contacted' ? 'selected' : '' }}>📞 Akan Dihubungi</option>
                                <option value="approved" {{ $brief->status == 'approved' ? 'selected' : '' }}>✅ Disetujui</option>
                                <option value="rejected" {{ $brief->status == 'rejected' ? 'selected' : '' }}>❌ Ditolak</option>
                            </select>
                        </span>
                    </div>
                </div>
            </div>

            <div class="detail-section">
                <h3><i class="fas fa-briefcase"></i> Detail Proyek</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">Nama Proyek</span>
                        <span class="detail-value">{{ $brief->project_name }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Kategori Layanan</span>
                        <span class="detail-value">
                            <div class="category-tags">
                                @foreach($brief->categories as $cat)
                                <span class="cat-tag">{{ $cat }}</span>
                                @endforeach
                            </div>
                        </span>
                    </div>
                    @if($brief->budget)
                    <div class="detail-item">
                        <span class="detail-label">Budget</span>
                        <span class="detail-value highlight-value">Rp {{ number_format($brief->budget, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    @if($brief->timeline)
                    <div class="detail-item">
                        <span class="detail-label">Timeline</span>
                        <span class="detail-value">{{ $brief->timeline }}</span>
                    </div>
                    @endif
                </div>
            </div>

            @if($brief->description)
            <div class="detail-section">
                <h3><i class="fas fa-file-alt"></i> Deskripsi Proyek</h3>
                <div class="detail-description">
                    {{ $brief->description }}
                </div>
            </div>
            @endif

            @if($brief->reference_link)
            <div class="detail-section">
                <h3><i class="fas fa-link"></i> Referensi</h3>
                <div class="detail-value">
                    <a href="{{ $brief->reference_link }}" target="_blank" class="reference-link">
                        <i class="fas fa-external-link-alt"></i> {{ $brief->reference_link }}
                    </a>
                </div>
            </div>
            @endif

            @php
                $payment = App\Models\Payment::where('brief_id', $brief->id)->first();
            @endphp
            
            <div class="detail-section">
                <h3><i class="fas fa-money-bill-wave"></i> Informasi Pembayaran</h3>
                @if($payment)
                    <div class="payment-info">
                        <div class="detail-grid">
                            <div class="detail-item">
                                <span class="detail-label">Invoice Number</span>
                                <span class="detail-value">{{ $payment->invoice_number ?? '-' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Jumlah Pembayaran</span>
                                <span class="detail-value highlight-value">Rp {{ number_format($payment->amount ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Status Pembayaran</span>
                                <span class="detail-value">
                                    @if($payment->status == 'paid')
                                        <span class="status-badge status-success">✓ Lunas</span>
                                    @elseif($payment->status == 'pending')
                                        <span class="status-badge status-warning">⏳ Menunggu Verifikasi</span>
                                    @else
                                        <span class="status-badge status-danger">⚠️ Belum Dibayar</span>
                                    @endif
                                </span>
                            </div>
                            @if($payment->paid_at)
                            <div class="detail-item">
                                <span class="detail-label">Tanggal Bayar</span>
                                <span class="detail-value">{{ $payment->paid_at->format('d M Y H:i') }}</span>
                            </div>
                            @endif
                        </div>
                        
                        @if($payment->payment_proof)
                        <div class="payment-proof-section">
                            <label class="detail-label">Bukti Pembayaran</label>
                            <div class="payment-proof-wrapper">
                                <a href="{{ asset('storage/' . $payment->payment_proof) }}" target="_blank" class="btn-proof">
                                    <i class="fas fa-image"></i> Lihat Bukti Pembayaran
                                </a>
                            </div>
                        </div>
                        @endif
                        
                        @if($payment->status == 'pending')
                        <div class="payment-actions">
                            <form action="{{ route('admin.payment.verify', $payment->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn-verify-payment" onclick="return confirm('Verifikasi pembayaran ini?')">
                                    <i class="fas fa-check-circle"></i> Verifikasi Pembayaran
                                </button>
                            </form>
                            <form action="{{ route('admin.payment.reject', $payment->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn-reject-payment" onclick="return confirm('Tolak pembayaran ini?')">
                                    <i class="fas fa-times-circle"></i> Tolak Pembayaran
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                @else
                    <div class="no-payment">
                        <p>Belum ada informasi pembayaran untuk brief ini.</p>
                        @if($brief->status == 'approved')
                        <p class="hint">Status brief sudah "Disetujui". Client dapat melakukan pembayaran melalui halaman Payments mereka.</p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="detail-actions">
                <a href="https://wa.me/{{ $brief->user->phone ?? '' }}?text=Halo%20{{ urlencode($brief->user->name ?? '') }}%2C%20saya%20dari%20diver.ent.%20Brief%20Anda%20untuk%20project%20%22{{ urlencode($brief->project_name) }}%22%20telah%20kami%20terima." target="_blank" class="btn-wa">
                    <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
                </a>
                <button onclick="deleteBrief({{ $brief->id }})" class="btn-delete">
                    <i class="fas fa-trash"></i> Hapus Brief
                </button>
            </div>
        </div>
    </div>
</div>

<div id="logout-modal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.7); backdrop-filter: blur(8px); z-index: 1000; justify-content: center; align-items: center;">
    <div style="background: var(--surface); border: 1px solid var(--border); border-radius: 20px; padding: 32px; max-width: 400px; width: 90%; text-align: center;">
        <i class="fas fa-question-circle" style="font-size: 48px; color: var(--accent); margin-bottom: 16px;"></i>
        <h3>Konfirmasi Keluar</h3>
        <p>Apakah Anda yakin ingin keluar?</p>
        <div style="display: flex; gap: 12px;">
            <button onclick="closeLogoutModal()" class="btn-outline">Batal</button>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-primary">Keluar</button>
            </form>
        </div>
    </div>
</div>

<style>
.admin-main {
    margin-left: 280px;
    min-height: 100vh;
    padding-top:10px;
}

.admin-content{
    max-width: 1400px;
    margin: 0 auto;
    padding: 32px;
}

.detail-header {
    margin-bottom: 32px;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: var(--text-secondary);
    text-decoration: none;
    margin-bottom: 16px;
    transition: color 0.3s;
}

.btn-back:hover {
    color: var(--accent);
}

.detail-header h1 {
    font-family: var(--font-display);
    font-size: 1.8rem;
    font-weight: 800;
    margin-bottom: 8px;
}

.detail-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    overflow: hidden;
}

.detail-section {
    padding: 24px;
    border-bottom: 1px solid var(--border);
}

.detail-section:last-child {
    border-bottom: none;
}

.detail-section h3 {
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 20px;
    color: var(--accent);
}

/* Susunan Grid Utama */
.detail-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 8px; /* Jarak antara Label dan Kotak isi */
}

/* Style Label (Teks Polos Bersih di Atas Kotak) */
.detail-label {
    font-size: 0.75rem;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 700;
    padding-left: 4px;
}

/* Style VALUE (Kotak Isian Berwarna Gelap Sesuai Request) */
.detail-value {
    background: rgba(255, 255, 255, 0.03); /* Kotak background gelap */
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 14px 18px;
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--text);
    min-height: 50px;
    display: flex;
    align-items: center;
    box-sizing: border-box;
}

.highlight-value {
    color: var(--accent);
}

.category-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

.cat-tag {
    background: rgba(59, 130, 255, 0.12);
    color: var(--accent);
    padding: 4px 12px;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 600;
}

.detail-description {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid var(--border);
    padding: 20px;
    border-radius: 12px;
    font-size: 0.95rem;
    line-height: 1.7;
    color: var(--text);
    min-height: 80px;
}

.reference-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: var(--accent);
    text-decoration: none;
    word-break: break-all;
}

.reference-link:hover {
    text-decoration: underline;
}

/* Status Dropdown agar presisi di dalam kotak */
.status-field {
    padding: 0 14px !important;
}

.status-select {
    width: 100%;
    height: 48px;
    background: transparent !important;
    border: none !important;
    color: var(--text);
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    outline: none;
}

/* Payment Section Styles */
.payment-info {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.payment-proof-section {
    margin-top: 16px;
    padding-top: 16px;
    border-top: 1px solid var(--border);
}

.payment-proof-wrapper {
    margin-top: 8px;
}

.btn-proof {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--accent);
    color: #000;
    padding: 10px 20px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 700;
    font-size: 0.8rem;
    transition: transform 0.2s;
}

.btn-proof:hover {
    transform: translateY(-2px);
}

.payment-actions {
    display: flex;
    gap: 12px;
    margin-top: 16px;
    padding-top: 16px;
    border-top: 1px solid var(--border);
}

.btn-verify-payment {
    background: #10b981;
    color: white;
    border: none;
    padding: 10px 24px;
    border-radius: 40px;
    cursor: pointer;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-reject-payment {
    background: #ef4444;
    color: white;
    border: none;
    padding: 10px 24px;
    border-radius: 40px;
    cursor: pointer;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.status-badge {
    font-size: 0.85rem;
    font-weight: 700;
}

.status-success { color: #10b981; }
.status-warning { color: #f59e0b; }
.status-danger { color: #ef4444; }

.no-payment {
    background: rgba(255, 255, 255, 0.02);
    border: 1px dashed var(--border);
    padding: 24px;
    border-radius: 12px;
    text-align: center;
    color: var(--text-secondary);
}

.no-payment .hint {
    font-size: 0.8rem;
    margin-top: 8px;
}

.detail-actions {
    padding: 24px;
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
}

.btn-wa, .btn-delete {
    padding: 12px 28px;
    border-radius: 40px;
    border: none;
    font-weight: 700;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    transition: all 0.2s ease;
}

.btn-wa {
    background: #25D366;
    color: white;
}

.btn-wa:hover {
    box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
    transform: translateY(-2px);
}

.btn-delete {
    background: #ef4444;
    color: white;
}

.btn-delete:hover {
    box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .admin-main { margin-left: 0; }
    .admin-content { padding: 20px; }
    .detail-grid { grid-template-columns: 1fr; gap: 16px; }
    .payment-actions { flex-direction: column; }
    .btn-verify-payment, .btn-reject-payment { width: 100%; justify-content: center; }
}

.status-select option {
    background-color: var(--surface) !important; /* Mengikuti warna background gelap/terang website */
    color: var(--text) !important;           /* Mengikuti warna teks tema */
    padding: 10px;
}
</style>

<script>
    // Update status via AJAX
    const statusSelect = document.getElementById('statusSelect');
    if (statusSelect) {
        statusSelect.addEventListener('change', async function() {
            const id = this.dataset.id;
            const status = this.value;
            
            const response = await fetch(`/admin/briefs/${id}/status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: status })
            });
            
            const data = await response.json();
            if (data.success) {
                showToast(data.message);
                setTimeout(() => location.reload(), 1000);
            }
        });
    }
    
    function deleteBrief(id) {
        if (confirm('Apakah Anda yakin ingin menghapus brief ini?')) {
            fetch(`/admin/briefs/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      window.location.href = '{{ route("admin.briefs") }}';
                  }
              });
        }
    }
    
    function showToast(message) {
        const toast = document.createElement('div');
        toast.style.cssText = `
            position: fixed; bottom: 20px; right: 20px;
            background: #10b981; color: white; padding: 12px 20px;
            border-radius: 12px; z-index: 9999;
            animation: fadeIn 0.3s ease;
        `;
        toast.innerHTML = message;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }
</script>
@endsection