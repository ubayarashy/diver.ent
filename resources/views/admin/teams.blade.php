@extends('layouts.app')

@section('content')
@include('admin.sidebar')

<div class="admin-main">
    <div class="admin-content">
        <div class="page-header">
            <div class="page-title">
                <h1><i class="fas fa-user-friends"></i> Manajemen Team</h1>
                <p>Kelola tim yang akan mengerjakan project client</p>
            </div>
            <div class="page-actions">
                <a href="{{ route('admin.team-create') }}" class="btn-primary">
                    <i class="fas fa-plus-circle"></i> Tambah Team
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
        @endif

        <!-- Search & Filter -->
        <div class="filter-bar">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchTeam" placeholder="Cari team...">
            </div>
            <div class="stats-info">
                <span><i class="fas fa-users"></i> Total Team: <strong>{{ $teams->count() }}</strong></span>
            </div>
        </div>

        <!-- Teams Table -->
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 60px">No</th>
                        <th>Nama</th>
                        <th style="width: 80px">Avatar</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Bergabung</th>
                        <th style="width: 100px">Aksi</th>
                    </tr>
                </thead>
                <tbody id="teamsTableBody">
                    @forelse($teams as $index => $team)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>
                            <div class="team-name">{{ $team->name }}</div>
                        </td>
                        <td>
                            <div class="team-avatar">{{ strtoupper(substr($team->name, 0, 2)) }}</div>
                        </td>
                        <td>
                            <div class="team-email">{{ $team->email }}</div>
                        </td>
                        <td>
                            <span class="role-badge team">Team Member</span>
                        </td>
                        <td>
                            <div>{{ $team->created_at->format('d-M-Y') }}</div>
                            <small>{{ $team->created_at->format('H:i') }}</small>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.team-edit', $team->id) }}" class="btn-action btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn-action btn-delete" onclick="deleteTeam({{ $team->id }}, '{{ $team->name }}')" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="empty-row">
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fas fa-users"></i>
                                <p>Belum ada team member</p>
                                <a href="{{ route('admin.team-create') }}" class="btn-primary">Tambah Team Sekarang</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal-backdrop" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-trash-alt"></i> Konfirmasi Hapus</h3>
            <button class="modal-close" onclick="closeDeleteModal()">&times;</button>
        </div>
        <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus team <strong id="deleteTeamName"></strong>?</p>
            <p class="text-warning">Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="modal-footer">
            <button class="btn-cancel" onclick="closeDeleteModal()">Batal</button>
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">Hapus</button>
            </form>
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

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 32px;
}

.page-title h1 {
    font-family: var(--font-display);
    font-size: 1.8rem;
    font-weight: 800;
    margin-bottom: 8px;
}

.page-title p {
    color: var(--text-secondary);
}

.btn-primary {
    background: linear-gradient(135deg, var(--accent), var(--accent-hover));
    color: #fff;
    padding: 10px 24px;
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
    box-shadow: 0 4px 15px rgba(59, 130, 255, 0.3);
}

.alert {
    padding: 16px 20px;
    border-radius: 12px;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.alert-success {
    background: rgba(16, 185, 129, 0.1);
    border-left: 4px solid #10b981;
    color: #10b981;
}

.alert-danger {
    background: rgba(239, 68, 68, 0.1);
    border-left: 4px solid #ef4444;
    color: #ef4444;
}

.filter-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 24px;
}

.search-box {
    display: flex;
    align-items: center;
    gap: 12px;
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 40px;
    padding: 10px 20px;
    width: 300px;
}

.search-box input {
    background: none;
    border: none;
    color: var(--text);
    width: 100%;
    outline: none;
}

.search-box i {
    color: var(--text-secondary);
}

.stats-info {
    color: var(--text-secondary);
    font-size: 0.85rem;
}

.stats-info strong {
    color: var(--accent);
}

.table-container {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    overflow-x: auto;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th,
.data-table td {
    padding: 16px 20px;
    text-align: left;
    border-bottom: 1px solid var(--border);
}

.data-table th {
    background: var(--surface-alt);
    font-weight: 700;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--text-secondary);
}

.data-table tr:hover td {
    background: rgba(59, 130, 255, 0.03);
}

.text-center {
    text-align: center;
}

.team-avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--accent), var(--accent-hover));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: #fff;
}

.team-name {
    font-weight: 600;
    margin-bottom: 4px;
}

.team-email {
    font-size: 0.85rem;
    color: var(--text-secondary);
}

.role-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 600;
}

.role-badge.team {
    background: rgba(59, 130, 255, 0.15);
    color: var(--accent);
}

.action-buttons {
    display: flex;
    gap: 8px;
}

.btn-action {
    background: transparent;
    border: 1px solid var(--border);
    width: 34px;
    height: 34px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
}

.btn-action:hover {
    border-color: var(--accent);
}

.btn-edit:hover {
    color: var(--accent);
}

.btn-delete:hover {
    color: #ef4444;
    border-color: #ef4444;
}

.empty-row td {
    padding: 60px 20px !important;
}

.empty-state {
    text-align: center;
    padding: 40px;
}

.empty-state i {
    font-size: 4rem;
    color: var(--text-secondary);
    opacity: 0.5;
    margin-bottom: 16px;
}

.empty-state p {
    color: var(--text-secondary);
    margin-bottom: 20px;
}

.modal-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(8px);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal-content {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    width: 90%;
    max-width: 450px;
    overflow: hidden;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 24px;
    border-bottom: 1px solid var(--border);
}

.modal-header h3 {
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0;
}

.modal-close {
    background: none;
    border: none;
    color: var(--text-secondary);
    font-size: 1.3rem;
    cursor: pointer;
}

.modal-body {
    padding: 24px;
}

.modal-body p {
    margin-bottom: 12px;
}

.text-warning {
    color: #f59e0b;
    font-size: 0.85rem;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    padding: 20px 24px;
    border-top: 1px solid var(--border);
}

.btn-cancel {
    background: transparent;
    border: 1px solid var(--border);
    padding: 8px 20px;
    border-radius: 40px;
    color: var(--text);
    cursor: pointer;
}

.btn-danger {
    background: #ef4444;
    border: none;
    padding: 8px 20px;
    border-radius: 40px;
    color: #fff;
    font-weight: 600;
    cursor: pointer;
}

@media (max-width: 768px) {
    .admin-main {
        margin-left: 0;
    }
    .admin-content {
        padding: 20px;
    }
    .filter-bar {
        flex-direction: column;
        align-items: stretch;
    }
    .search-box {
        width: 100%;
    }
    .data-table th,
    .data-table td {
        padding: 10px 12px;
        font-size: 0.8rem;
    }
}
</style>

<script>
    // Search functionality
    document.getElementById('searchTeam')?.addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('#teamsTableBody tr');
        
        rows.forEach(row => {
            if (row.querySelector('.empty-state')) return;
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
    
    function deleteTeam(id, name) {
        document.getElementById('deleteTeamName').innerText = name;
        document.getElementById('deleteForm').action = `/admin/team/${id}`;
        document.getElementById('deleteModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }
    
    document.getElementById('deleteModal')?.addEventListener('click', (e) => {
        if (e.target === document.getElementById('deleteModal')) {
            closeDeleteModal();
        }
    });
</script>
@endsection