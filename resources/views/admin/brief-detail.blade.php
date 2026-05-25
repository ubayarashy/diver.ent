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
                        <span class="detail-value">
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
                        <span class="detail-value">Rp {{ number_format($brief->budget, 0, ',', '.') }}</span>
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
                <a href="{{ $brief->reference_link }}" target="_blank" class="reference-link">
                    <i class="fas fa-external-link-alt"></i> {{ $brief->reference_link }}
                </a>
            </div>
            @endif

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

<style>
.admin-main {
    margin-left: 280px;
    min-height: 100vh;
    padding-top: 80px;
}

.admin-content {
    padding: 32px;
    max-width: 900px;
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

.detail-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.detail-label {
    font-size: 0.7rem;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.detail-value {
    font-size: 0.9rem;
    font-weight: 500;
}

.category-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.cat-tag {
    background: rgba(59, 130, 255, 0.1);
    color: var(--accent);
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
}

.detail-description {
    background: var(--bg);
    padding: 20px;
    border-radius: 12px;
    font-size: 0.9rem;
    line-height: 1.7;
    color: var(--text-secondary);
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

.detail-actions {
    padding: 24px;
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
}

.btn-wa, .btn-delete {
    padding: 12px 24px;
    border-radius: 40px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
}

.btn-wa {
    background: #25D366;
    color: white;
}

.btn-delete {
    background: #ef4444;
    color: white;
}

.status-select {
    background: var(--surface-alt);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 8px 16px;
    font-size: 0.85rem;
    cursor: pointer;
}

@media (max-width: 768px) {
    .admin-main {
        margin-left: 0;
    }
    .admin-content {
        padding: 20px;
    }
    .detail-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
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