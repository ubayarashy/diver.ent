@extends('layouts.app')

@section('content')
@include('admin.sidebar')

<div class="admin-main">
    <div class="admin-content">
        {{-- Header Section --}}
        <div class="page-header reveal">
            <div class="header-left">
              
                <h1 class="section-title" style="font-size: 2.2rem;">Manajemen User</h1>
            </div>
            <div class="header-right">
                <a href="{{ route('admin.users.create') }}" class="btn-primary">
                    <i class="fas fa-plus"></i>
                    <span>Tambah User</span>
                </a>
            </div>
        </div>

        {{-- Alert Messages --}}
        @if(session('success'))
            <div class="alert alert-success reveal">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
                <button type="button" class="alert-close" onclick="this.parentElement.remove()">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger reveal">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
                <button type="button" class="alert-close" onclick="this.parentElement.remove()">&times;</button>
            </div>
        @endif

        {{-- Stats Cards --}}
        <div class="stats-grid reveal">
            <div class="stat-card card-premium">
                <div class="stat-icon total-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <div class="stat-value">{{ $stats['total'] }}</div>
                    <div class="stat-label">Total User</div>
                </div>
            </div>
            <div class="stat-card card-premium">
                <div class="stat-icon client-icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stat-info">
                    <div class="stat-value">{{ $stats['clients'] }}</div>
                    <div class="stat-label">Client</div>
                </div>
            </div>
            <div class="stat-card card-premium">
                <div class="stat-icon admin-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="stat-info">
                    <div class="stat-value">{{ $stats['admins'] }}</div>
                    <div class="stat-label">Admin</div>
                </div>
            </div>
            <div class="stat-card card-premium">
                <div class="stat-icon team-icon">
                    <i class="fas fa-user-friends"></i>
                </div>
                <div class="stat-info">
                    <div class="stat-value">{{ $stats['teams'] }}</div>
                    <div class="stat-label">Team</div>
                </div>
            </div>
        </div>

        {{-- Filter & Search --}}
        <div class="filter-section card-premium reveal">
            <form method="GET" action="{{ route('admin.users') }}" class="filter-form">
                <div class="filter-group">
                    <label for="role" class="filter-label">
                        <i class="fas fa-filter"></i> Filter Role
                    </label>
                    <select name="role" id="role" class="filter-select">
                        <option value="all">Semua Role</option>
                        <option value="client" {{ request('role') == 'client' ? 'selected' : '' }}>Client</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="team" {{ request('role') == 'team' ? 'selected' : '' }}>Team</option>
                    </select>
                </div>
                <div class="filter-group search-group">
                    <label for="search" class="filter-label">
                        <i class="fas fa-search"></i> Cari User
                    </label>
                    <div class="search-wrapper">
                        <input type="text" name="search" id="search" placeholder="Cari nama atau email..." class="filter-input" value="{{ request('search') }}">
                        <button type="submit" class="btn-filter">
                            <i class="fas fa-search"></i> Cari
                        </button>
                        @if(request('search') || request('role') != 'all')
                            <a href="{{ route('admin.users') }}" class="btn-filter btn-reset">
                                <i class="fas fa-sync-alt"></i> Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        {{-- Users Table --}}
        <div class="data-table-wrapper reveal">
            <div class="data-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-user">User</th>
                            <th class="col-email">Email</th>
                            <th class="col-phone">Telepon</th>
                            <th class="col-role">Role</th>
                            <th class="col-date">Member Sejak</th>
                            <th class="col-actions">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr class="table-row">
                            <td class="col-user" data-label="User">
                                <div class="user-info">
                                    <div class="user-avatar">
                                        @if($user->profile_photo)
                                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}">
                                        @else
                                            <span class="avatar-initial">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                                        @endif
                                    </div>
                                    <div class="user-details">
                                        <div class="user-name">{{ $user->name }}</div>
                                        <div class="user-id">ID: {{ $user->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="col-email" data-label="Email">
                                <span class="email-text">{{ $user->email }}</span>
                            </td>
                            <td class="col-phone" data-label="Telepon">
                                <span class="phone-text">{{ $user->phone ?? '-' }}</span>
                            </td>
                            <td class="col-role" data-label="Role">
                                @if($user->role == 'admin')
                                    <span class="role-badge role-admin">
                                        <i class="fas fa-shield-alt"></i> Admin
                                    </span>
                                @elseif($user->role == 'team')
                                    <span class="role-badge role-team">
                                        <i class="fas fa-users"></i> Team
                                    </span>
                                @else
                                    <span class="role-badge role-client">
                                        <i class="fas fa-user"></i> Client
                                    </span>
                                @endif
                            </td>
                            <td class="col-date" data-label="Member Sejak">
                                <div class="date-wrapper">
                                    <i class="far fa-calendar-alt"></i>
                                    <span>{{ $user->created_at ? $user->created_at->format('d/m/Y') : '-' }}</span>
                                </div>
                            </td>
                            <td class="col-actions" data-label="Aksi">
                                <div class="action-buttons">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-action btn-edit" title="Edit User">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($user->id != auth()->id())
                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" onsubmit="return confirmDelete('{{ $user->name }}')" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Hapus User">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-user-slash"></i>
                                </div>
                                <p>Tidak ada data user</p>
                                <span class="empty-hint">Coba ubah filter atau kata kunci pencarian</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="pagination-wrapper reveal">
            {{ $users->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<style>
/* ===== diver.ent Admin Styling ===== */

.admin-main {
    margin-left: var(--sidebar-width, 280px);
    margin-top: var(--header-height, 70px);
    padding: 2rem;
    min-height: calc(100vh - var(--header-height, 70px));
    background: var(--bg);
}

.admin-content {
    max-width: 1400px;
    margin: 0 auto;
}

/* Page Header */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1.5rem;
}

.header-left .section-tag {
    margin-bottom: 0.75rem;
}

.header-left .section-title {
    font-size: clamp(1.5rem, 4vw, 2.2rem);
    margin-bottom: 0;
    background: linear-gradient(135deg, var(--text) 0%, var(--accent) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Alert Styles */
.alert {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 1.25rem;
    border-radius: var(--radius-md);
    margin-bottom: 1.5rem;
    position: relative;
    animation: slideDown 0.3s ease;
    background: var(--surface);
    border-left: 4px solid;
}

.alert-success {
    border-left-color: #10b981;
    color: #10b981;
}

.alert-success span {
    color: var(--text);
}

.alert-danger {
    border-left-color: #ef4444;
    color: #ef4444;
}

.alert-danger span {
    color: var(--text);
}

.alert-close {
    margin-left: auto;
    background: none;
    border: none;
    font-size: 1.25rem;
    cursor: pointer;
    color: var(--text-muted);
    transition: color 0.2s;
}

.alert-close:hover {
    color: var(--text);
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.5rem;
}

.stat-icon {
    width: 52px;
    height: 52px;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.total-icon {
    background: rgba(0, 210, 255, 0.12);
    color: var(--accent);
}

.client-icon {
    background: rgba(16, 185, 129, 0.12);
    color: #10b981;
}

.admin-icon {
    background: rgba(239, 68, 68, 0.12);
    color: #ef4444;
}

.team-icon {
    background: rgba(245, 158, 11, 0.12);
    color: #f59e0b;
}

.stat-info {
    flex: 1;
}

.stat-value {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text);
    line-height: 1.2;
    font-family: var(--font-display);
}

.stat-label {
    font-size: 0.7rem;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 500;
}

/* Filter Section */
.filter-section {
    padding: 1.5rem;
    margin-bottom: 2rem;
}

.filter-form {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
    align-items: flex-end;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.filter-label {
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--accent);
}

.filter-label i {
    font-size: 0.7rem;
    margin-right: 4px;
}

.filter-select {
    padding: 0.6rem 2rem 0.6rem 1rem;
    background: var(--surface-alt);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    color: var(--text);
    font-size: 0.85rem;
    cursor: pointer;
    font-family: var(--font-body);
    transition: all 0.2s;
}

.filter-select:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px var(--accent-glow);
}

.search-group {
    flex: 1;
}

.search-wrapper {
    display: flex;
    gap: 0.75rem;
    align-items: center;
    flex-wrap: wrap;
}

.filter-input {
    flex: 1;
    min-width: 200px;
    padding: 0.6rem 1rem;
    background: var(--surface-alt);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    color: var(--text);
    font-size: 0.85rem;
    font-family: var(--font-body);
    transition: all 0.2s;
}

.filter-input:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px var(--accent-glow);
}

.filter-input::placeholder {
    color: var(--text-muted);
}

.btn-filter {
    background: var(--accent);
    color: #0A192F;
    border: none;
    padding: 0.6rem 1.25rem;
    border-radius: var(--radius-sm);
    font-size: 0.8rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-filter:hover {
    transform: translateY(-2px);
    filter: brightness(1.05);
}

.btn-reset {
    background: var(--surface-alt);
    color: var(--text-secondary);
    border: 1px solid var(--border);
}

.btn-reset:hover {
    background: var(--border);
    color: var(--text);
    transform: translateY(-2px);
}

/* Table Styles - FIXED ALIGNMENT */
.data-table-wrapper {
    background: var(--surface);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    overflow: hidden;
    margin-bottom: 1.5rem;
}

.data-table {
    overflow-x: auto;
    width: 100%;
}

.table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    table-layout: fixed;
}

/* Column Widths - Fixed for alignment */
.col-user {
    width: 22%;
}
.col-email {
    width: 23%;
}
.col-phone {
    width: 15%;
}
.col-role {
    width: 12%;
}
.col-date {
    width: 13%;
}
.col-actions {
    width: 15%;
}

.table th {
    text-align: left;
    padding: 1rem 1.25rem;
    background: var(--surface-alt);
    font-weight: 600;
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--accent);
    border-bottom: 2px solid var(--border);
    white-space: nowrap;
}

.table td {
    padding: 1rem 1.25rem;
    border-bottom: 1px solid var(--border-light);
    font-size: 0.85rem;
    color: var(--text);
    vertical-align: middle;
    height: 80px; /* Fixed height for consistency */
}

/* Hover effect */
.table tr:hover td {
    background: rgba(0, 210, 255, 0.03);
}

/* User Cell */
.user-info {
    display: flex;
    align-items: center;
    gap: 0.875rem;
}

.user-avatar {
    width: 44px;
    height: 44px;
    background: linear-gradient(135deg, var(--accent), var(--accent-hover));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    overflow: hidden;
}

.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-initial {
    font-size: 1rem;
    font-weight: 700;
    color: #0A192F;
}

.user-details {
    display: flex;
    flex-direction: column;
    gap: 0.125rem;
    overflow: hidden;
}

.user-name {
    font-weight: 600;
    color: var(--text);
    font-family: var(--font-display);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.user-id {
    font-size: 0.65rem;
    color: var(--text-muted);
    font-family: monospace;
}

/* Email & Phone Cells */
.email-text {
    font-family: monospace;
    font-size: 0.8rem;
    color: var(--text-secondary);
    word-break: break-all;
    display: inline-block;
    max-width: 100%;
}

.phone-text {
    font-family: monospace;
    font-size: 0.8rem;
    color: var(--text-secondary);
}

/* Date Cell - FIXED */
.date-wrapper {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
}

.date-wrapper i {
    color: var(--text-muted);
    font-size: 0.8rem;
    width: 16px;
}

.date-wrapper span {
    font-size: 0.75rem;
}

/* Role Badges */
.role-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 0.25rem 0.75rem;
    border-radius: 100px;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    white-space: nowrap;
}

.role-badge i {
    font-size: 0.65rem;
}

.role-admin {
    background: rgba(239, 68, 68, 0.12);
    color: #ef4444;
}

.role-team {
    background: rgba(16, 185, 129, 0.12);
    color: #10b981;
}

.role-client {
    background: rgba(0, 210, 255, 0.12);
    color: var(--accent);
}

/* Action Buttons - FIXED */
.action-buttons {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.btn-action {
    width: 34px;
    height: 34px;
    border-radius: var(--radius-sm);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.2s;
    border: none;
    cursor: pointer;
    font-size: 0.85rem;
}

.delete-form {
    display: inline-block;
    margin: 0;
    padding: 0;
}

.btn-edit {
    background: rgba(245, 158, 11, 0.12);
    color: #f59e0b;
}

.btn-edit:hover {
    background: #f59e0b;
    color: #0A192F;
    transform: scale(1.05);
}

.btn-delete {
    background: rgba(239, 68, 68, 0.12);
    color: #ef4444;
}

.btn-delete:hover {
    background: #ef4444;
    color: white;
    transform: scale(1.05);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem 1.5rem !important;
}

.empty-icon {
    font-size: 3rem;
    color: var(--text-muted);
    margin-bottom: 1rem;
    opacity: 0.5;
}

.empty-state p {
    color: var(--text-secondary);
    font-weight: 500;
    margin-bottom: 0.25rem;
}

.empty-hint {
    font-size: 0.7rem;
    color: var(--text-muted);
}

/* Pagination */
.pagination-wrapper {
    margin-top: 1.5rem;
    display: flex;
    justify-content: center;
}

.pagination-wrapper nav {
    display: flex;
    gap: 0.5rem;
}

.pagination-wrapper .pagination {
    display: flex;
    gap: 0.5rem;
    list-style: none;
    margin: 0;
    padding: 0;
}

.pagination-wrapper .page-item .page-link {
    padding: 0.5rem 0.9rem;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    color: var(--text);
    font-size: 0.8rem;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-block;
}

.pagination-wrapper .page-item.active .page-link {
    background: var(--accent);
    border-color: var(--accent);
    color: #0A192F;
}

.pagination-wrapper .page-item .page-link:hover {
    background: var(--accent);
    border-color: var(--accent);
    color: #0A192F;
    transform: translateY(-2px);
}

/* Animations */
@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 992px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
}

@media (max-width: 768px) {
    .admin-main {
        margin-left: 0;
        padding: 1rem;
    }
    
    .page-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .stat-card {
        padding: 1rem;
    }
    
    .stat-value {
        font-size: 1.5rem;
    }
    
    .filter-form {
        flex-direction: column;
        align-items: stretch;
    }
    
    .filter-group {
        width: 100%;
    }
    
    .search-wrapper {
        flex-direction: column;
    }
    
    .filter-input {
        width: 100%;
    }
    
    .btn-filter {
        width: 100%;
        justify-content: center;
    }
    
    /* Mobile table - reset to card style */
    .table,
    .table thead,
    .table tbody,
    .table th,
    .table td,
    .table tr {
        display: block;
    }
    
    .table thead {
        display: none;
    }
    
    .table tr {
        margin-bottom: 1rem;
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        background: var(--surface);
    }
    
    .table td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 1rem;
        text-align: right;
        border-bottom: 1px solid var(--border-light);
        height: auto;
    }
    
    .table td:last-child {
        border-bottom: none;
    }
    
    .table td::before {
        content: attr(data-label);
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--accent);
        text-align: left;
    }
    
    .user-info {
        justify-content: flex-end;
    }
    
    .action-buttons {
        justify-content: flex-end;
    }
    
    .role-badge {
        white-space: normal;
    }
}

/* Sidebar integration */
.admin-sidebar {
    position: fixed;
    left: 0;
    top: var(--header-height);
    width: var(--sidebar-width);
    height: calc(100vh - var(--header-height));
    background: var(--surface);
    border-right: 1px solid var(--border);
    overflow-y: auto;
    z-index: 99;
}

@media (max-width: 768px) {
    .admin-sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }
    
    .admin-sidebar.open {
        transform: translateX(0);
    }
}
</style>

<script>
// Confirm delete with sweet alert style
function confirmDelete(userName) {
    return confirm(`Yakin ingin menghapus user "${userName}"? Tindakan ini tidak dapat dibatalkan.`);
}

// Theme persistence
document.addEventListener('DOMContentLoaded', function() {
    const theme = localStorage.getItem('theme') || 'dark';
    document.documentElement.setAttribute('data-theme', theme);
});
</script>
@endsection