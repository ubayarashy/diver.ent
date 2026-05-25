@extends('layouts.app')

@section('content')

@include('admin.sidebar')

<div class="admin-main">

    <div class="admin-content">

        <div class="page-header">
            <div class="page-title">
                <h1>
                    <i class="fas fa-user-circle"></i>
                    Profile Admin
                </h1>

                <p>Kelola informasi akun Anda</p>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
        @endif

        <div class="profile-layout">

            <!-- LEFT -->

            <div class="profile-side-card">

                <div class="profile-avatar-large">

                    @if($user->profile_photo)

                        <img src="{{ asset('storage/' . $user->profile_photo) }}"
                             alt="Profile">

                    @else

                        {{ strtoupper(substr($user->name, 0, 2)) }}

                    @endif

                </div>

                <h2>{{ $user->name }}</h2>

                <p>{{ $user->email }}</p>

                <div class="admin-badge">
                    Administrator
                </div>

                <div class="profile-meta">

                    <div class="meta-item">
                        <span>Bergabung</span>

                        <strong>
                            {{ $user->created_at->format('d M Y') }}
                        </strong>
                    </div>

                    <div class="meta-item">
                        <span>Role</span>

                        <strong>Administrator</strong>
                    </div>

                </div>

            </div>

            <!-- RIGHT -->

            <div class="profile-form-card">

                <form id="profileForm"
                      method="POST"
                      enctype="multipart/form-data"
                      action="{{ route('admin.profile-update') }}">

                    @csrf

                    <!-- PHOTO -->

                    <div class="photo-upload">

                        <label for="profile_photo">

                            <div class="photo-preview">

                                @if($user->profile_photo)

                                    <img id="preview-image"
                                         src="{{ asset('storage/' . $user->profile_photo) }}">

                                @else

                                    <div id="preview-image">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>

                                @endif

                            </div>

                        </label>

                        <input type="file"
                               id="profile_photo"
                               name="profile_photo"
                               accept="image/*"
                               hidden>

                    </div>

                    <div class="form-grid">

                        <div class="form-group">

                            <label>Nama Lengkap</label>

                            <input type="text"
                                   name="name"
                                   class="form-input"
                                   value="{{ old('name', $user->name) }}"
                                   required>

                        </div>

                        <div class="form-group">

                            <label>Email</label>

                            <input type="email"
                                   name="email"
                                   class="form-input"
                                   value="{{ old('email', $user->email) }}"
                                   required>

                        </div>

                        <div class="form-group">

                            <label>Password Baru</label>

                            <div class="password-wrapper">

                                <input type="password"
                                       id="password"
                                       name="password"
                                       class="form-input"
                                       placeholder="Kosongkan jika tidak diubah">

                                <button type="button"
                                        class="toggle-password"
                                        onclick="togglePassword()">

                                    <i class="fas fa-eye"></i>

                                </button>

                            </div>

                        </div>

                        <div class="form-group">

                            <label>Konfirmasi Password</label>

                            <div class="password-wrapper">

                                <input type="password"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       class="form-input"
                                       placeholder="Ulangi password">

                                <button type="button"
                                        class="toggle-password"
                                        onclick="toggleConfirmPassword()">

                                    <i class="fas fa-eye"></i>

                                </button>

                            </div>

                        </div>

                    </div>

                    <div class="form-actions">

                        <button type="submit"
                                class="btn-submit">

                            <i class="fas fa-save"></i>
                            Simpan Perubahan

                        </button>

                    </div>

                </form>

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
}

.page-header {
    margin-bottom: 32px;
}

.page-title h1 {
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 8px;
}

.page-title p {
    color: var(--text-secondary);
}

/* ALERT */

.alert {
    padding: 16px 20px;
    border-radius: 14px;
    margin-bottom: 24px;
}

.alert-success {
    background: rgba(16,185,129,0.12);
    color: #10b981;
}

.alert-danger {
    background: rgba(239,68,68,0.12);
    color: #ef4444;
}

/* LAYOUT */

.profile-layout {
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 28px;
    align-items: start;
}

/* LEFT */

.profile-side-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 28px;
    padding: 36px 28px;
    position: sticky;
    top: 100px;
    text-align: center;
}

.profile-avatar-large {
    width: 110px;
    height: 110px;
    margin: 0 auto 20px;
    border-radius: 50%;
    overflow: hidden;
    background: linear-gradient(135deg, var(--accent), var(--accent-hover));
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.4rem;
    font-weight: 800;
    color: white;
}

.profile-avatar-large img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-side-card h2 {
    font-size: 1.4rem;
    margin-bottom: 8px;
}

.profile-side-card p {
    color: var(--text-secondary);
    margin-bottom: 20px;
}

.admin-badge {
    display: inline-flex;
    padding: 10px 18px;
    border-radius: 999px;
    background: rgba(59,130,246,0.12);
    color: var(--accent);
    font-size: 0.8rem;
    font-weight: 700;
    margin-bottom: 28px;
}

.profile-meta {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.meta-item {
    padding: 16px;
    background: var(--bg);
    border-radius: 18px;
}

.meta-item span {
    display: block;
    color: var(--text-secondary);
    font-size: 0.8rem;
    margin-bottom: 6px;
}

/* RIGHT */

.profile-form-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 28px;
    padding: 36px;
}

.photo-upload {
    display: flex;
    justify-content: center;
    margin-bottom: 32px;
}

.photo-preview {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    cursor: pointer;
    background: linear-gradient(135deg, var(--accent), var(--accent-hover));
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: 800;
    color: white;
    border: 4px solid var(--border);
}

.photo-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    margin-bottom: 10px;
    font-size: 0.85rem;
    font-weight: 600;
}

.form-input {
    width: 100%;
    padding: 14px 18px;
    border-radius: 16px;
    border: 1px solid var(--border);
    background: var(--bg);
    color: var(--text);
}

.password-wrapper {
    position: relative;
}

.toggle-password {
    position: absolute;
    top: 50%;
    right: 18px;
    transform: translateY(-50%);
    border: none;
    background: none;
    color: var(--text-secondary);
    cursor: pointer;
}

.form-actions {
    margin-top: 32px;
}

.btn-submit {
    width: 100%;
    border: none;
    padding: 16px;
    border-radius: 18px;
    background: linear-gradient(135deg, var(--accent), var(--accent-hover));
    color: white;
    font-weight: 700;
    cursor: pointer;
}

@media (max-width: 992px) {

    .profile-layout {
        grid-template-columns: 1fr;
    }

    .profile-side-card {
        position: relative;
        top: 0;
    }

    .form-grid {
        grid-template-columns: 1fr;
    }
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

// PASSWORD TOGGLE

function togglePassword() {

    const input = document.getElementById('password');

    const icon = document.querySelectorAll('.toggle-password i')[0];

    if (input.type === 'password') {

        input.type = 'text';

        icon.className = 'fas fa-eye-slash';

    } else {

        input.type = 'password';

        icon.className = 'fas fa-eye';
    }
}

function toggleConfirmPassword() {

    const input = document.getElementById('password_confirmation');

    const icon = document.querySelectorAll('.toggle-password i')[1];

    if (input.type === 'password') {

        input.type = 'text';

        icon.className = 'fas fa-eye-slash';

    } else {

        input.type = 'password';

        icon.className = 'fas fa-eye';
    }
}

// PASSWORD VALIDATION

document.getElementById('profileForm')?.addEventListener('submit', function(e){

    const password = document.getElementById('password').value;

    const confirm = document.getElementById('password_confirmation').value;

    if(password !== confirm){

        e.preventDefault();

        alert('Password tidak cocok!');
    }
});

// IMAGE PREVIEW

document.getElementById('profile_photo')?.addEventListener('change', function(e){

    const file = e.target.files[0];

    if(file){

        const reader = new FileReader();

        reader.onload = function(event){

            document.querySelector('.photo-preview').innerHTML =
                `<img src="${event.target.result}">`;
        }

        reader.readAsDataURL(file);
    }
});

</script>

@endsection