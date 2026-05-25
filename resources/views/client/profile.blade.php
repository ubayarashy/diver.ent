@extends('layouts.app')

@section('content')
@include('partials.client.sidebar')
@include('partials.client.navbar')
<div class="client-main">
    <div class="client-content">
        <div class="page-header">
            <div class="page-title">
                <h1><i class="fas fa-user-circle"></i> Profil Saya</h1>
                <p>Kelola informasi akun Anda</p>
            </div>
        </div>

        <div class="profile-card">
            <div class="profile-avatar-wrapper">
                <div class="profile-avatar-large">
                    {{ substr(Auth::user()->name ?? 'U', 0, 2) }}
                </div>
                <div class="profile-avatar-badge">
                    <i class="fas fa-camera"></i>
                </div>
            </div>

            <form id="profileForm" class="profile-form">
                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Nama Lengkap</label>
                        <input type="text" id="name" value="{{ Auth::user()->name ?? '' }}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" id="email" value="{{ Auth::user()->email ?? '' }}" class="form-input">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-phone"></i> Nomor Telepon</label>
                        <input type="tel" id="phone" placeholder="+62 xxx xxx xxx" class="form-input">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-building"></i> Perusahaan</label>
                        <input type="text" id="company" placeholder="Nama perusahaan Anda" class="form-input">
                    </div>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-map-marker-alt"></i> Alamat</label>
                    <input type="text" id="address" placeholder="Alamat lengkap" class="form-input">
                </div>

                <div class="divider"></div>

                <h3 class="section-subtitle"><i class="fas fa-lock"></i> Ganti Password</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label>Password Saat Ini</label>
                        <input type="password" id="current_password" class="form-input">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" id="new_password" class="form-input">
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" id="confirm_password" class="form-input">
                    </div>
                </div>

                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    .client-main {
        flex: 1;
        margin-left: 280px;
        min-height: 100vh;
    }

    .client-content {
        padding: 40px;
        max-width: 800px;
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
    }

    .profile-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 24px;
        padding: 40px;
    }

    .profile-avatar-wrapper {
        position: relative;
        width: fit-content;
        margin: 0 auto 32px;
    }

    .profile-avatar-large {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, var(--accent), var(--accent-hover));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 700;
        color: #fff;
    }

    .profile-avatar-badge {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 32px;
        height: 32px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .profile-avatar-badge:hover {
        border-color: var(--accent);
        color: var(--accent);
    }

    .profile-form {
        margin-top: 20px;
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

    .form-group label i {
        color: var(--accent);
        margin-right: 6px;
    }

    .form-input {
        width: 100%;
        padding: 14px 16px;
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 12px;
        color: var(--text);
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--accent);
    }

    .divider {
        height: 1px;
        background: var(--border);
        margin: 32px 0 24px;
    }

    .section-subtitle {
        font-family: var(--font-display);
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .btn-save {
        width: 100%;
        background: linear-gradient(135deg, var(--accent), var(--accent-hover));
        color: #fff;
        border: none;
        padding: 14px;
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(59, 130, 255, 0.3);
    }

    @media (max-width: 768px) {
        .client-main {
            margin-left: 0;
        }
        .client-content {
            padding: 20px;
        }
        .profile-card {
            padding: 24px;
        }
        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }
    }
</style>

<script>
    document.getElementById('profileForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Profil berhasil diperbarui!');
    });
</script>
@endsection