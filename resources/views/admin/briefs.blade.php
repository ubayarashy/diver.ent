@extends('layouts.app')

@section('content')
@include('admin.sidebar')

<div class="admin-main">
    <div class="admin-content">
        <div class="page-header">
            <div>
                <h1><i class="fas fa-file-alt"></i> Brief Client</h1>
                <p>Kelola semua brief dari client</p>
            </div>
            <div class="page-actions">
              
            </div>
        </div>

        <!-- Statistik Brief -->
        <div class="stats-brief">
            <div class="stat-brief-card">
                <div class="stat-brief-icon"><i class="fas fa-inbox"></i></div>
                <div class="stat-brief-info">
                    <span class="stat-brief-value">{{ $stats['total'] }}</span>
                    <span class="stat-brief-label">Total Brief</span>
                </div>
            </div>
            <div class="stat-brief-card pending">
                <div class="stat-brief-icon"><i class="fas fa-clock"></i></div>
                <div class="stat-brief-info">
                    <span class="stat-brief-value">{{ $stats['pending'] }}</span>
                    <span class="stat-brief-label">Menunggu</span>
                </div>
            </div>
            <div class="stat-brief-card contacted">
                <div class="stat-brief-icon"><i class="fas fa-phone-alt"></i></div>
                <div class="stat-brief-info">
                    <span class="stat-brief-value">{{ $stats['contacted'] }}</span>
                    <span class="stat-brief-label">Akan Dihubungi</span>
                </div>
            </div>
            <div class="stat-brief-card approved">
                <div class="stat-brief-icon"><i class="fas fa-check-circle"></i></div>
                <div class="stat-brief-info">
                    <span class="stat-brief-value">{{ $stats['approved'] }}</span>
                    <span class="stat-brief-label">Disetujui</span>
                </div>
            </div>
            <div class="stat-brief-card rejected">
                <div class="stat-brief-icon"><i class="fas fa-times-circle"></i></div>
                <div class="stat-brief-info">
                    <span class="stat-brief-value">{{ $stats['rejected'] }}</span>
                    <span class="stat-brief-label">Ditolak</span>
                </div>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="filter-section">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Cari brief...">
            </div>
            <div class="filter-status">
                <select id="statusFilter" class="status-filter">
                    <option value="all">Semua Status</option>
                    <option value="pending">Menunggu</option>
                    <option value="contacted">Akan Dihubungi</option>
                    <option value="approved">Disetujui</option>
                    <option value="rejected">Ditolak</option>
                </select>
            </div>
        </div>

        <!-- Tabel Brief -->
        <div class="brief-table-container">
            <table class="brief-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Project</th>
                        <th>Kategori</th>
                        <th>Budget</th>
                        <th>Tanggal</th>
                        <th>Contact</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="briefTableBody">
                    @foreach($briefs as $brief)
                    <tr data-status="{{ $brief->status }}">
                        <td>#{{ $brief->id }}</td>
                        <td>
                            <div class="client-info">
                                <strong>{{ $brief->user->name ?? 'Unknown' }}</strong>
                                <small>{{ $brief->user->email ?? '-' }}</small>
                                <small>{{ $brief->contact ?? '-' }}</small>
                            </div>
                        </td>
                        <td class="project-name">{{ $brief->project_name }}</td>
                        <td>
                            <div class="category-tags">
                                @foreach($brief->categories as $cat)
                                <span class="cat-tag">{{ $cat }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td>
                            @if($brief->budget)
                                {{ number_format($brief->budget, 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $brief->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $brief->contact ?? '-' }}</td>
                        <td>
                            <select class="status-select" data-id="{{ $brief->id }}" data-status="{{ $brief->status }}">
                                <option value="pending" {{ $brief->status == 'pending' ? 'selected' : '' }}>⏳ Menunggu</option>
                                <option value="contacted" {{ $brief->status == 'contacted' ? 'selected' : '' }}>📞 Akan Dihubungi</option>
                                <option value="approved" {{ $brief->status == 'approved' ? 'selected' : '' }}>✅ Disetujui</option>
                                <option value="rejected" {{ $brief->status == 'rejected' ? 'selected' : '' }}>❌ Ditolak</option>
                            </select>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-view" onclick="viewBrief({{ $brief->id }})" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-wa" onclick="whatsappClient('{{ $brief->user->email ?? '' }}', '{{ $brief->project_name }}')" title="Hubungi WA">
                                    <i class="fab fa-whatsapp"></i>
                                </button>
                                <button class="btn-delete" onclick="deleteBrief({{ $brief->id }})" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                         </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($briefs->hasPages())
        <div class="pagination-container">
            <div class="pagination-info">
                Menampilkan {{ $briefs->firstItem() }} - {{ $briefs->lastItem() }} dari {{ $briefs->total() }} data
            </div>
            <div class="pagination">
                {{-- Previous Page Link --}}
                @if ($briefs->onFirstPage())
                    <span class="page-link disabled"><i class="fas fa-chevron-left"></i></span>
                @else
                    <a href="{{ $briefs->previousPageUrl() }}" class="page-link"><i class="fas fa-chevron-left"></i></a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($briefs->getUrlRange(1, $briefs->lastPage()) as $page => $url)
                    @if ($page == $briefs->currentPage())
                        <span class="page-link active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($briefs->hasMorePages())
                    <a href="{{ $briefs->nextPageUrl() }}" class="page-link"><i class="fas fa-chevron-right"></i></a>
                @else
                    <span class="page-link disabled"><i class="fas fa-chevron-right"></i></span>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

<style>
.admin-main {
    margin-left: 280px;
    min-height: 100vh;
    padding-top:10px;
}


.admin-content {
    padding: 32px;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
    flex-wrap: wrap;
    gap: 16px;
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

.btn-export {
    background: var(--surface-alt);
    border: 1px solid var(--border);
    padding: 10px 20px;
    border-radius: 40px;
    text-decoration: none;
    color: var(--text);
    font-weight: 500;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-export:hover {
    background: var(--accent);
    border-color: var(--accent);
    color: #000;
}

/* Stats Brief */
.stats-brief {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 20px;
    margin-bottom: 32px;
}

.stat-brief-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 16px;
    transition: all 0.3s;
}

.stat-brief-card:hover {
    transform: translateY(-2px);
    border-color: var(--accent);
}

.stat-brief-icon {
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

.stat-brief-card.pending .stat-brief-icon { background: rgba(245,158,11,0.1); color: #f59e0b; }
.stat-brief-card.contacted .stat-brief-icon { background: rgba(59,130,255,0.1); color: var(--accent); }
.stat-brief-card.approved .stat-brief-icon { background: rgba(16,185,129,0.1); color: #10b981; }
.stat-brief-card.rejected .stat-brief-icon { background: rgba(239,68,68,0.1); color: #ef4444; }

.stat-brief-info {
    display: flex;
    flex-direction: column;
}

.stat-brief-value {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--text);
}

.stat-brief-label {
    font-size: 0.75rem;
    color: var(--text-secondary);
}

/* Filter Section */
.filter-section {
    display: flex;
    gap: 16px;
    margin-bottom: 24px;
    flex-wrap: wrap;
}

.search-box {
    flex: 1;
    display: flex;
    align-items: center;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 40px;
    padding: 10px 18px;
}

.search-box i {
    color: var(--text-secondary);
    margin-right: 10px;
}

.search-box input {
    flex: 1;
    background: none;
    border: none;
    color: var(--text);
    outline: none;
}

.status-filter {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 40px;
    padding: 10px 18px;
    color: var(--text);
    cursor: pointer;
}

/* Tabel */
.brief-table-container {
    overflow-x: auto;
    border-radius: 16px;
    border: 1px solid var(--border);
}

.brief-table {
    width: 100%;
    border-collapse: collapse;
    background: var(--surface);
}

.brief-table th,
.brief-table td {
    padding: 16px;
    text-align: left;
    border-bottom: 1px solid var(--border);
}

.brief-table th {
    background: var(--surface-alt);
    font-weight: 600;
    font-size: 0.85rem;
}

.brief-table tr:hover td {
    background: rgba(59, 130, 255, 0.02);
}

.client-info {
    display: flex;
    flex-direction: column;
}

.client-info strong {
    font-size: 0.9rem;
}

.client-info small {
    font-size: 0.7rem;
    color: var(--text-secondary);
}

.project-name {
    font-weight: 500;
}

.category-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

.cat-tag {
    background: rgba(59, 130, 255, 0.1);
    color: var(--accent);
    padding: 2px 8px;
    border-radius: 20px;
    font-size: 0.7rem;
}

.status-select {
    background: var(--surface-alt);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 6px 12px;
    color: var(--text);
    font-size: 0.75rem;
    cursor: pointer;
}

.action-buttons {
    display: flex;
    gap: 8px;
}

.action-buttons button {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-view {
    background: rgba(59, 130, 255, 0.1);
    color: var(--accent);
}

.btn-view:hover {
    background: var(--accent);
    color: #000;
}

.btn-wa {
    background: rgba(37, 211, 102, 0.1);
    color: #25D366;
}

.btn-wa:hover {
    background: #25D366;
    color: #fff;
}

.btn-delete {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
}

.btn-delete:hover {
    background: #ef4444;
    color: #fff;
}

/* Pagination */
.pagination-container {
    margin-top: 30px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 16px;
}

.pagination-info {
    font-size: 0.8rem;
    color: var(--text-secondary);
    text-align: center;
}

.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

.page-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
    padding: 0 12px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 10px;
    color: var(--text-secondary);
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.3s ease;
    cursor: pointer;
}

.page-link:hover {
    background: var(--accent);
    border-color: var(--accent);
    color: #000;
    transform: translateY(-2px);
}

.page-link.active {
    background: var(--accent);
    border-color: var(--accent);
    color: #000;
}

.page-link.disabled {
    opacity: 0.5;
    cursor: not-allowed;
    pointer-events: none;
}

.page-link i {
    font-size: 0.8rem;
}

/* Responsive */
@media (max-width: 1024px) {
    .stats-brief {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .admin-main {
        margin-left: 0;
    }
    .admin-content {
        padding: 20px;
    }
    .stats-brief {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }
    .brief-table th,
    .brief-table td {
        padding: 12px;
        font-size: 0.8rem;
    }
    .page-link {
        min-width: 35px;
        height: 35px;
        padding: 0 8px;
        font-size: 0.75rem;
    }
    .action-buttons button {
        width: 28px;
        height: 28px;
    }
}

@media (max-width: 480px) {
    .stats-brief {
        grid-template-columns: 1fr;
    }
    .filter-section {
        flex-direction: column;
    }
    .pagination {
        gap: 4px;
    }
    .page-link {
        min-width: 30px;
        height: 30px;
        padding: 0 6px;
        font-size: 0.7rem;
    }
}
</style>

<script>
    // Filter by status and search
    const statusFilter = document.getElementById('statusFilter');
    const searchInput = document.getElementById('searchInput');
    const tableRows = document.querySelectorAll('#briefTableBody tr');
    
    function filterTable() {
        const status = statusFilter.value;
        const search = searchInput.value.toLowerCase();
        
        tableRows.forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            const projectName = row.querySelector('.project-name')?.innerText.toLowerCase() || '';
            const clientName = row.querySelector('.client-info strong')?.innerText.toLowerCase() || '';
            
            const matchStatus = status === 'all' || rowStatus === status;
            const matchSearch = projectName.includes(search) || clientName.includes(search);
            
            row.style.display = (matchStatus && matchSearch) ? '' : 'none';
        });
    }
    
    statusFilter.addEventListener('change', filterTable);
    searchInput.addEventListener('keyup', filterTable);
    
    // Update status via AJAX
    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', async function() {
            const id = this.dataset.id;
            const status = this.value;
            
            try {
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
                    showToast(data.message, 'success');
                    setTimeout(() => location.reload(), 1000);
                }
            } catch (error) {
                showToast('Gagal mengupdate status', 'error');
            }
        });
    });
    
    // View brief detail
    function viewBrief(id) {
        window.location.href = `/admin/briefs/${id}`;
    }
    
    // WhatsApp client
    function whatsappClient(email, project) {
        const message = `Halo, saya dari diver.ent. Kami telah menerima brief Anda untuk project "${project}". Apakah ada yang bisa kami bantu?`;
        window.open(`https://wa.me/?text=${encodeURIComponent(message)}`, '_blank');
    }
    
    // Delete brief
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
                      showToast(data.message, 'success');
                      setTimeout(() => location.reload(), 1000);
                  }
              });
        }
    }
    
    function showToast(message, type) {
        const toast = document.createElement('div');
        toast.style.cssText = `
            position: fixed; bottom: 20px; right: 20px;
            background: ${type === 'success' ? '#10b981' : '#ef4444'};
            color: white; padding: 12px 20px;
            border-radius: 12px; z-index: 9999;
            animation: fadeIn 0.3s ease;
        `;
        toast.innerHTML = message;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }
</script>
@endsection