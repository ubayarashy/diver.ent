@extends('layouts.app')

@section('content')
@include('admin.sidebar')

<div class="admin-main">

    <div class="admin-content">

        <!-- HEADER -->

        <div class="page-header">

            <div class="page-title">

                <a href="{{ route('admin.teams') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Team
                </a>

                <h1>
                    <i class="fas fa-user-plus"></i>
                    Tambah Team Baru
                </h1>

                <p>
                    Tambahkan anggota tim baru untuk mengerjakan project client
                </p>

            </div>

        </div>

        <!-- ALERT -->

        @if ($errors->any())

        <div class="alert alert-danger">

            <i class="fas fa-exclamation-circle"></i>

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

        @endif

        @if (session('success'))

        <div class="alert alert-success">

            <i class="fas fa-check-circle"></i>

            {{ session('success') }}

        </div>

        @endif

        <!-- LAYOUT -->

        <div class="form-layout">

            <!-- FORM -->

            <div class="form-container">

                <form method="POST"
                      action="{{ route('admin.team-store') }}">

                    @csrf

                    <div class="form-card">

                        <!-- BASIC -->

                        <div class="form-section">

                            <h3>

                                <i class="fas fa-user-circle"></i>

                                Informasi Dasar

                            </h3>

                            <div class="form-group">

                                <label for="name">

                                    Nama Lengkap

                                    <span class="required">*</span>

                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-input"
                                    placeholder="Contoh: Ahmad Rizki"
                                    value="{{ old('name') }}"
                                    required
                                >

                                <small>
                                    Nama lengkap team member
                                </small>

                            </div>

                            <div class="form-group">

                                <label for="email">

                                    Email

                                    <span class="required">*</span>

                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-input"
                                    placeholder="team@diverent.com"
                                    value="{{ old('email') }}"
                                    required
                                >

                                <small>
                                    Email yang akan digunakan untuk login
                                </small>

                            </div>

                            <div class="form-group">

                                <label for="password">

                                    Password

                                    <span class="required">*</span>

                                </label>

                                <div class="password-wrapper">

                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        class="form-input"
                                        placeholder="Minimal 8 karakter"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="toggle-password"
                                        onclick="togglePassword()"
                                    >

                                        <i class="fas fa-eye"></i>

                                    </button>

                                </div>

                                <small>
                                    Password minimal 8 karakter
                                </small>

                            </div>

                        </div>

                        <!-- ADDITIONAL -->

                        <div class="form-section">

                            <h3>

                                <i class="fas fa-info-circle"></i>

                                Informasi Tambahan

                            </h3>

                            <div class="form-group">

                                <label for="role_display">

                                    Role

                                </label>

                                <input
                                    type="text"
                                    id="role_display"
                                    class="form-input"
                                    value="Team Member"
                                    disabled
                                >

                                <small>
                                    Role akan diatur otomatis sebagai Team
                                </small>

                            </div>

                        </div>

                    </div>

                    <!-- ACTION -->

                    <div class="form-actions">

                        <a href="{{ route('admin.teams') }}"
                           class="btn-cancel">

                            Batal

                        </a>

                        <button type="submit"
                                class="btn-submit">

                            <i class="fas fa-save"></i>

                            Simpan Team

                        </button>

                    </div>

                </form>

            </div>

            <!-- PREVIEW -->

            <div class="preview-card">

                <h3>

                    <i class="fas fa-eye"></i>

                    Preview

                </h3>

                <div class="preview-content">

                    <div class="preview-avatar"
                         id="previewAvatar">

                        AT

                    </div>

                    <div class="preview-info">

                        <h4 id="previewName">

                            Ahmad Team

                        </h4>

                        <p id="previewEmail">

                            team@diverent.com

                        </p>

                        <span class="preview-badge">

                            Team Member

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<style>

/* ================= MAIN ================= */

.admin-main{
    margin-left:280px;
    min-height:100vh;
    padding-top:80px;

    background:
        radial-gradient(
            circle at top left,
            rgba(59,130,246,0.08),
            transparent 30%
        ),
        var(--bg);
}

.admin-content{
    padding:40px;
    width:100%;
}

/* ================= HEADER ================= */

.page-header{
    margin-bottom:40px;
}

.page-title{
    display:flex;
    flex-direction:column;
    gap:12px;
}

.back-link{
    display:inline-flex;
    align-items:center;
    gap:8px;

    color:var(--text-secondary);

    text-decoration:none;

    font-size:.9rem;

    transition:.3s;

    width:max-content;
}

.back-link:hover{
    color:var(--accent);
    transform:translateX(-4px);
}

.page-title h1{
    font-size:2.3rem;
    font-weight:800;

    display:flex;
    align-items:center;
    gap:14px;

    letter-spacing:-1px;
}

.page-title p{
    color:var(--text-secondary);
}

/* ================= ALERT ================= */

.alert{
    padding:18px 22px;
    border-radius:18px;
    margin-bottom:24px;
}

.alert-success{
    background:rgba(16,185,129,.1);
    border:1px solid rgba(16,185,129,.2);
    color:#10b981;
}

.alert-danger{
    background:rgba(239,68,68,.1);
    border:1px solid rgba(239,68,68,.2);
    color:#ef4444;
}

/* ================= LAYOUT ================= */

.form-layout{
    display:grid;
    grid-template-columns:1.8fr .9fr;
    gap:28px;
    align-items:start;
}

/* ================= CARD ================= */

.form-card{

    background:
        linear-gradient(
            180deg,
            rgba(255,255,255,.03),
            rgba(255,255,255,.01)
        );

    border:1px solid rgba(255,255,255,.06);

    border-radius:28px;

    overflow:hidden;

    backdrop-filter:blur(20px);

    box-shadow:
        0 10px 40px rgba(0,0,0,.25);
}

.form-section{
    padding:32px;
    border-bottom:1px solid rgba(255,255,255,.05);
}

.form-section:last-child{
    border-bottom:none;
}

.form-section h3{
    display:flex;
    align-items:center;
    gap:10px;

    font-size:1rem;
    font-weight:700;

    margin-bottom:28px;
}

/* ================= FORM ================= */

.form-group{
    margin-bottom:24px;
}

.form-group label{
    display:block;
    margin-bottom:10px;

    font-size:.88rem;
    font-weight:600;
}

.required{
    color:#ef4444;
}

.form-input{

    width:100%;

    height:56px;

    padding:0 18px;

    background:
        rgba(255,255,255,.03);

    border:1px solid rgba(255,255,255,.08);

    border-radius:16px;

    color:var(--text);

    font-size:.92rem;

    transition:.3s;
}

.form-input:focus{

    outline:none;

    border-color:var(--accent);

    box-shadow:
        0 0 0 4px rgba(59,130,246,.12);

    background:
        rgba(255,255,255,.04);
}

.form-input::placeholder{
    color:rgba(255,255,255,.35);
}

.form-group small{
    display:block;
    margin-top:8px;
    color:var(--text-secondary);
    font-size:.72rem;
}

/* ================= PASSWORD ================= */

.password-wrapper{
    position:relative;
}

.toggle-password{

    position:absolute;

    top:50%;
    right:18px;

    transform:translateY(-50%);

    background:none;
    border:none;

    color:var(--text-secondary);

    cursor:pointer;
}

/* ================= ACTION ================= */

.form-actions{
    display:flex;
    justify-content:flex-end;
    gap:16px;
    margin-top:28px;
}

.btn-cancel{

    height:52px;
    padding:0 28px;

    border-radius:16px;

    border:1px solid rgba(255,255,255,.08);

    background:transparent;

    color:var(--text);

    text-decoration:none;

    display:flex;
    align-items:center;
    justify-content:center;

    font-weight:600;

    transition:.3s;
}

.btn-cancel:hover{
    border-color:var(--accent);
    color:var(--accent);
}

.btn-submit{

    height:52px;
    padding:0 32px;

    border:none;

    border-radius:16px;

    background:
        linear-gradient(
            135deg,
            var(--accent),
            var(--accent-hover)
        );

    color:#fff;

    font-weight:700;

    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;

    cursor:pointer;

    transition:.3s;

    box-shadow:
        0 10px 25px rgba(59,130,246,.25);
}

.btn-submit:hover{
    transform:translateY(-3px);

    box-shadow:
        0 14px 30px rgba(59,130,246,.35);
}

/* ================= PREVIEW ================= */

.preview-card{

    position:sticky;
    top:100px;

    background:
        linear-gradient(
            180deg,
            rgba(255,255,255,.03),
            rgba(255,255,255,.01)
        );

    border:1px solid rgba(255,255,255,.06);

    border-radius:28px;

    padding:28px;

    backdrop-filter:blur(20px);

    overflow:hidden;
}

.preview-card::before{

    content:'';

    position:absolute;
    inset:0;

    background:
        radial-gradient(
            circle at top right,
            rgba(59,130,246,.15),
            transparent 40%
        );

    pointer-events:none;
}

.preview-card h3{

    position:relative;

    display:flex;
    align-items:center;
    gap:10px;

    margin-bottom:24px;

    font-size:1rem;
    font-weight:700;
}

.preview-content{

    position:relative;

    display:flex;
    flex-direction:column;
    align-items:center;

    text-align:center;
}

.preview-avatar{

    width:92px;
    height:92px;

    border-radius:50%;

    background:
        linear-gradient(
            135deg,
            var(--accent),
            var(--accent-hover)
        );

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:1.8rem;
    font-weight:800;

    color:#fff;

    margin-bottom:18px;

    box-shadow:
        0 10px 30px rgba(59,130,246,.35);
}

.preview-info h4{
    font-size:1.15rem;
    font-weight:700;
    margin-bottom:6px;
}

.preview-info p{
    color:var(--text-secondary);
    font-size:.85rem;
    margin-bottom:14px;
}

.preview-badge{

    display:inline-flex;
    align-items:center;
    justify-content:center;

    padding:8px 16px;

    border-radius:999px;

    background:
        rgba(59,130,246,.12);

    color:var(--accent);

    font-size:.75rem;
    font-weight:700;
}

/* ================= RESPONSIVE ================= */

@media(max-width:1100px){

    .form-layout{
        grid-template-columns:1fr;
    }

    .preview-card{
        position:relative;
        top:0;
    }
}

@media(max-width:768px){

    .admin-main{
        margin-left:0;
    }

    .admin-content{
        padding:20px;
    }

    .page-title h1{
        font-size:1.8rem;
    }

    .form-section{
        padding:24px;
    }

    .form-actions{
        flex-direction:column;
    }

    .btn-submit,
    .btn-cancel{
        width:100%;
    }
}

</style>

<script>

/* ================= PREVIEW ================= */

const nameInput =
    document.getElementById('name');

const emailInput =
    document.getElementById('email');

const previewAvatar =
    document.getElementById('previewAvatar');

const previewName =
    document.getElementById('previewName');

const previewEmail =
    document.getElementById('previewEmail');

function updatePreview(){

    const name =
        nameInput.value.trim();

    const email =
        emailInput.value.trim();

    if(name){

        const initials =
            name
                .split(' ')
                .map(word => word[0])
                .join('')
                .toUpperCase()
                .substring(0,2);

        previewAvatar.textContent = initials;

        previewName.textContent = name;

    }else{

        previewAvatar.textContent = 'AT';

        previewName.textContent = 'Ahmad Team';
    }

    previewEmail.textContent =
        email || 'team@diverent.com';
}

nameInput.addEventListener('input', updatePreview);

emailInput.addEventListener('input', updatePreview);

/* ================= PASSWORD ================= */

function togglePassword(){

    const passwordInput =
        document.getElementById('password');

    const toggleBtn =
        document.querySelector('.toggle-password i');

    if(passwordInput.type === 'password'){

        passwordInput.type = 'text';

        toggleBtn.className =
            'fas fa-eye-slash';

    }else{

        passwordInput.type = 'password';

        toggleBtn.className =
            'fas fa-eye';
    }
}

</script>

@endsection