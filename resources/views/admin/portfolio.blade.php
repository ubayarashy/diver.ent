@extends('layouts.app')

@section('content')
@include('admin.sidebar')

<div class="admin-main">
    <div class="admin-content">
        <div class="page-header">
            <div class="header-left">
                <h1><i class="fas fa-folder-open"></i> Manajemen Portfolio</h1>
            </div>
            <div class="header-right">
                <a href="{{ route('admin.portfolio.create') }}" class="btn-primary">
                    <i class="fas fa-plus"></i> Tambah Portfolio
                </a>0
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Order</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($portfolios ?? [] as $index => $item)
                    <tr id="portfolio-row-{{ $item->id }}">
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" width="50" height="50" style="object-fit: cover; border-radius: 8px;">
                            @else
                                <div style="width:50px;height:50px;background:#333;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ $item->title }}</td>
                        <td>
                            <span class="badge-category">{{ $item->label ?? $item->category }}</span>
                        </td>
                        <td>
                            @if($item->status == 'published')
                                <span class="badge-success">Published</span>
                            @else
                                <span class="badge-draft">Draft</span>
                            @endif
                        </td>
                        <td>{{ $item->order ?? 0 }}</td>
                        <td>
                            <a href="{{ route('admin.portfolio.edit', $item->id) }}" class="btn-edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button onclick="deletePortfolio({{ $item->id }}, '{{ addslashes($item->title) }}')" class="btn-delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px;">
                            <i class="fas fa-folder-open" style="font-size: 48px; opacity: 0.3;"></i>
                            <p style="margin-top: 16px;">Belum ada portfolio. Silakan tambah portfolio baru.</p>
                            <a href="{{ route('admin.portfolio.create') }}" class="btn-primary" style="margin-top: 16px; display: inline-flex;">
                                <i class="fas fa-plus"></i> Tambah Portfolio
                            </a>
                        </td>
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
    padding-top: 20px;
}

.admin-content {
    padding: 32px;
}

.page-header {
    margin-bottom: 32px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 20px;
}

.header-left h1 {
    font-family: var(--font-display);
    font-size: 1.8rem;
    font-weight: 800;
    margin-bottom: 8px;
}

.header-left p {
    color: var(--text-secondary);
}

.header-right {
    display: flex;
    gap: 12px;
}

.table-container {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow-x: auto;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th,
.data-table td {
    padding: 16px;
    text-align: left;
    border-bottom: 1px solid var(--border);
}

.data-table th {
    background: var(--surface-alt);
    font-weight: 600;
}

.badge-success {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.badge-draft {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.badge-category {
    background: rgba(59, 130, 255, 0.1);
    color: var(--accent);
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.btn-edit, .btn-delete {
    background: none;
    border: none;
    padding: 8px 12px;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-edit {
    color: var(--accent);
}

.btn-edit:hover {
    background: rgba(59, 130, 255, 0.1);
    transform: scale(1.05);
}

.btn-delete {
    color: #ef4444;
}

.btn-delete:hover {
    background: rgba(239, 68, 68, 0.1);
    transform: scale(1.05);
}

.btn-primary {
    background: var(--accent);
    color: #000;
    padding: 10px 20px;
    border-radius: 40px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    transition: all 0.3s;
    border: none;
    cursor: pointer;
}

.btn-primary:hover {
    transform: translateY(-2px);
    filter: brightness(0.95);
    box-shadow: 0 4px 12px rgba(59, 130, 255, 0.3);
}

.alert-success {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
    padding: 12px 20px;
    border-radius: 12px;
    margin-bottom: 20px;
    border-left: 3px solid #10b981;
    animation: slideIn 0.3s ease;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .admin-main {
        margin-left: 0;
    }
    .admin-content {
        padding: 20px;
    }
    
    .page-header {
        flex-direction: column;
    }
    
    .header-right {
        width: 100%;
    }
    
    .btn-primary {
        width: 100%;
        justify-content: center;
    }
    
    .data-table th,
    .data-table td {
        padding: 12px;
        font-size: 0.85rem;
    }
}
</style>

<script>
    function deletePortfolio(id, title) {
        if (confirm(`Apakah Anda yakin ingin menghapus portfolio "${title}"?`)) {
            // Tampilkan loading state pada tombol
            const btn = event.target.closest('.btn-delete');
            const originalHtml = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            btn.disabled = true;
            
            fetch(`/admin/portfolios/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Hapus baris tabel
                    const row = document.getElementById(`portfolio-row-${id}`);
                    if (row) {
                        row.remove();
                    }
                    
                    // Cek apakah masih ada data di tabel
                    const tbody = document.querySelector('.data-table tbody');
                    if (tbody.children.length === 0) {
                        // Tampilkan pesan kosong
                        tbody.innerHTML = `
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 40px;">
                                    <i class="fas fa-folder-open" style="font-size: 48px; opacity: 0.3;"></i>
                                    <p style="margin-top: 16px;">Belum ada portfolio. Silakan tambah portfolio baru.</p>
                                    <a href="{{ route('admin.portfolio.create') }}" class="btn-primary" style="margin-top: 16px; display: inline-flex;">
                                        <i class="fas fa-plus"></i> Tambah Portfolio
                                    </a>
                                </td>
                            </tr>
                        `;
                    }
                    
                    // Tampilkan pesan sukses
                    showAlert('success', 'Portfolio berhasil dihapus!');
                } else {
                    alert('Gagal menghapus portfolio: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus portfolio');
            })
            .finally(() => {
                btn.innerHTML = originalHtml;
                btn.disabled = false;
            });
        }
    }
    
    function showAlert(type, message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type}`;
        alertDiv.innerHTML = message;
        const pageHeader = document.querySelector('.page-header');
        pageHeader.insertAdjacentElement('afterend', alertDiv);
        setTimeout(() => {
            alertDiv.remove();
        }, 3000);
    }
</script>

@endsection