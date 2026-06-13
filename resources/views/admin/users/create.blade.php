@extends('layouts.app')

@section('content')
@include('admin.sidebar')

<div class="admin-main">
    <div class="admin-content">
        <div class="page-header">
            <div class="header-left">
                <h1><i class="fas fa-user-plus"></i> Tambah User</h1>
                <p>Tambahkan user baru ke sistem</p>
            </div>
            <div class="header-right">
                <a href="{{ route('admin.users') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-card">
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Lengkap <span class="required">*</span></label>
                        <input type="text" name="name" class="form-input" value="{{ old('name') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Email <span class="required">*</span></label>
                        <input type="email" name="email" class="form-input" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="tel" name="phone" class="form-input" value="{{ old('phone') }}" placeholder="Contoh: 08123456789">
                    </div>

                    <div class="form-group">
                        <label>Role <span class="required">*</span></label>
                        <select name="role" class="form-input" required>
                            <option value="">Pilih Role</option>
                            <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>Client</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="team" {{ old('role') == 'team' ? 'selected' : '' }}>Team</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Password <span class="required">*</span></label>
                        <input type="password" name="password" class="form-input" required>
                        <small class="form-text">Minimal 6 karakter</small>
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password <span class="required">*</span></label>
                        <input type="password" name="password_confirmation" class="form-input" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Foto Profil</label>
                    <input type="file" name="profile_photo" class="form-input" accept="image/*">
                    <small class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save">
                        <i class="fas fa-save"></i> Simpan User
                    </button>
                    <a href="{{ route('admin.users') }}" class="btn-cancel">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.admin-main {
    margin-left: var(--sidebar-width);
    margin-top: var(--header-height);
    padding: 32px;
    min-height: calc(100vh - var(--header-height));
}

.admin-content {
    max-width: 800px;
    margin: 0 auto;
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
    margin-bottom: 8px;
}

.page-header h1 i {
    color: #2563eb;
    margin-right: 12px;
}

.btn-secondary {
    background: #6b7280;
    color: #fff;
    padding: 10px 20px;
    border-radius: 12px;
    text-decoration: none;
    font-size: 0.85rem;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.form-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 32px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    font-size: 0.85rem;
}

.required {
    color: #ef4444;
}

.form-input {
    width: 100%;
    padding: 12px 16px;
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 12px;
    color: var(--text);
}

.form-text {
    display: block;
    margin-top: 6px;
    font-size: 0.7rem;
    color: var(--text-secondary);
}

.form-actions {
    display: flex;
    gap: 16px;
    margin-top: 24px;
}

.btn-save {
    background: linear-gradient(135deg, #10b981, #059669);
    color: #fff;
    border: none;
    padding: 12px 24px;
    border-radius: 12px;
    cursor: pointer;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-cancel {
    background: #ef4444;
    color: #fff;
    padding: 12px 24px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
}

.alert {
    padding: 16px 20px;
    border-radius: 12px;
    margin-bottom: 24px;
}

.alert-danger {
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.3);
    color: #ef4444;
}

@media (max-width: 768px) {
    .admin-main {
        margin-left: 0;
        padding: 20px;
    }
    .form-row {
        grid-template-columns: 1fr;
        gap: 0;
    }
    .form-card {
        padding: 20px;
    }
}
</style>
@endsection