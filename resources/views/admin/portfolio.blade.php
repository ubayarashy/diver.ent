@extends('layouts.app')

@section('content')
@include('admin.sidebar')

<div class="admin-main">
    <div class="admin-content">
        <div class="page-header">
            <h1><i class="fas fa-folder-open"></i> Manajemen Portfolio</h1>
            <p>Kelola portfolio yang ditampilkan di landing page</p>
        </div>

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
                    <tr>
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
                            <button onclick="deletePortfolio({{ $item->id }})" class="btn-delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px;">
                            <i class="fas fa-folder-open" style="font-size: 48px; opacity: 0.3;"></i>
                            <p>Belum ada portfolio. Silakan tambah portfolio baru.</p>
                            <a href="{{ route('admin.portfolio.create') }}" class="btn-primary">+ Tambah Portfolio</a>
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
    padding-top: 80px;
}

.admin-content {
    padding: 32px;
}

.page-header {
    margin-bottom: 32px;
}

.page-header h1 {
    font-family: var(--font-display);
    font-size: 1.8rem;
    font-weight: 800;
    margin-bottom: 8px;
}

.page-header p {
    color: var(--text-secondary);
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
}

.badge-draft {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
}

.badge-category {
    background: rgba(59, 130, 255, 0.1);
    color: var(--accent);
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
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
}

.btn-delete {
    color: #ef4444;
}

.btn-delete:hover {
    background: rgba(239, 68, 68, 0.1);
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
}

@media (max-width: 768px) {
    .admin-main {
        margin-left: 0;
    }
    .admin-content {
        padding: 20px;
    }
}
</style>

<script>
    function deletePortfolio(id) {
        if (confirm('Apakah Anda yakin ingin menghapus portfolio ini?')) {
            fetch(`/admin/portfolio/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      location.reload();
                  }
              });
        }
    }
</script>
@endsection