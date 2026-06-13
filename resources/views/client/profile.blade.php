@extends('layouts.app')

@section('content')
@include('partials.client.navbar-sidebar')

<div class="app-main">
    <div class="app-content">
        <div class="page-header">
            <div class="page-title">
                <h1><i class="fas fa-user-circle"></i> Profil Saya</h1>
                <p>Kelola informasi akun Anda</p>
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

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="profile-grid">
            <!-- Edit Profile Card -->
            <div class="profile-card card-full">
                <div class="card-header">
                    <i class="fas fa-user-edit"></i>
                    <h3>Edit Profil</h3>
                </div>

                <form action="{{ route('client.profile-update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
                    @csrf
                    
                    <!-- Foto Profil -->
                    <div class="avatar-section">
                        <div class="avatar-wrapper">
                            @if(Auth::user()->profile_photo)
                                <div class="avatar-preview">
                                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo" id="avatarPreview">
                                </div>
                            @else
                                <div class="avatar-placeholder" id="avatarPreview">
                                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                                </div>
                            @endif
                            <button type="button" class="avatar-upload-btn" onclick="document.getElementById('photoInput').click()">
                                <i class="fas fa-camera"></i>
                            </button>
                            <input type="file" name="profile_photo" id="photoInput" accept="image/*" style="display: none;" onchange="previewPhoto(this)">
                        </div>
                        <p class="avatar-hint">Klik ikon kamera untuk mengganti foto profil (Max 2MB)</p>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label><i class="fas fa-user"></i> Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-envelope"></i> Alamat Email</label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="form-input" required>
                            <small class="form-text text-muted">Email digunakan untuk login</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-phone"></i> Nomor Telepon</label>
                        <input type="tel" name="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="Contoh: 08123456789 atau +628123456789" class="form-input">
                        <small class="form-text text-muted">Nomor telepon untuk keperluan komunikasi</small>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-tag"></i> Role / Status</label>
                        <input type="text" value="{{ ucfirst(Auth::user()->role) }}" class="form-input" disabled style="background: var(--surface-alt); cursor: not-allowed;">
                        <small class="form-text text-muted">Role tidak dapat diubah</small>
                    </div>

                    <button type="submit" class="btn-save">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </form>
            </div>

            <!-- Ganti Password Card -->
          
            <!-- Informasi Akun Card -->
            
        </div>
    </div>
</div>

<style>
/* Profile Page Styles */
.app-main {
    margin-left: var(--sidebar-width);
    margin-top: var(--header-height);
    padding: 32px;
    min-height: calc(100vh - var(--header-height));
}

.app-content {
    max-width: 1000px;
    margin: 0 auto;
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

.page-title h1 i {
    color: var(--accent);
    margin-right: 12px;
}

.page-title p {
    color: var(--text-secondary);
}

/* Alerts */
.alert {
    padding: 16px 20px;
    border-radius: 12px;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.alert-success {
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.3);
    color: #10b981;
}

.alert-danger {
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.3);
    color: #ef4444;
}

.alert-danger ul {
    margin: 0;
    padding-left: 20px;
}

/* Profile Grid */
.profile-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
}

.profile-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 28px;
}

.card-full {
    grid-column: span 2;
}

/* Card Header */
.card-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--border);
}

.card-header i {
    font-size: 1.5rem;
    color: var(--accent);
}

.card-header h3 {
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0;
}

.card-subtitle {
    color: var(--text-secondary);
    font-size: 0.85rem;
    margin-bottom: 24px;
}

/* Avatar Section */
.avatar-section {
    text-align: center;
    margin-bottom: 32px;
    padding-bottom: 24px;
    border-bottom: 1px solid var(--border);
}

.avatar-wrapper {
    position: relative;
    display: inline-block;
}

.avatar-preview,
.avatar-placeholder {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
}

.avatar-preview img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
}

.avatar-placeholder {
    background: linear-gradient(135deg, var(--accent), var(--accent-hover));
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    font-weight: 700;
    color: #fff;
}

.avatar-upload-btn {
    position: absolute;
    bottom: 5px;
    right: 5px;
    width: 36px;
    height: 36px;
    background: var(--surface);
    border: 2px solid var(--border);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    color: var(--text);
}

.avatar-upload-btn:hover {
    border-color: var(--accent);
    color: var(--accent);
    transform: scale(1.05);
}

.avatar-hint {
    font-size: 0.75rem;
    color: var(--text-secondary);
    margin-top: 12px;
}

/* Form Styles */
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
    color: var(--text-secondary);
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
    box-shadow: 0 0 0 3px rgba(59, 130, 255, 0.1);
}

.form-input:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.form-text {
    display: block;
    margin-top: 6px;
    font-size: 0.7rem;
    color: var(--text-secondary);
}

.text-muted {
    opacity: 0.7;
}

/* Buttons */
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
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 0.9rem;
}

.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(59, 130, 255, 0.3);
}

.btn-secondary {
    background: linear-gradient(135deg, #6b7280, #4b5563);
}

.btn-secondary:hover {
    box-shadow: 0 4px 15px rgba(107, 114, 128, 0.3);
}

/* Divider */
.divider {
    height: 1px;
    background: var(--border);
    margin: 20px 0;
}

/* Info List */
.info-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 12px;
    background: var(--bg);
    border-radius: 12px;
}

.info-icon {
    width: 44px;
    height: 44px;
    background: rgba(59, 130, 255, 0.1);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.info-icon i {
    font-size: 1.3rem;
    color: var(--accent);
}

.info-detail {
    flex: 1;
}

.info-label {
    display: block;
    font-size: 0.7rem;
    color: var(--text-secondary);
    margin-bottom: 4px;
}

.info-value {
    display: block;
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--text);
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    margin-top: 16px;
}

.stat-card {
    background: var(--bg);
    border-radius: 12px;
    padding: 16px;
    text-align: center;
}

.stat-number {
    font-size: 1.8rem;
    font-weight: 800;
    color: var(--accent);
    font-family: var(--font-display);
}

.stat-label {
    font-size: 0.7rem;
    color: var(--text-secondary);
    margin-top: 4px;
}

/* Responsive */
@media (max-width: 768px) {
    .app-main {
        margin-left: 0;
        padding: 20px;
    }
    
    .profile-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .card-full {
        grid-column: span 1;
    }
    
    .form-row {
        grid-template-columns: 1fr;
        gap: 0;
    }
    
    .profile-card {
        padding: 20px;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 480px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .info-item {
        padding: 10px;
    }
    
    .info-icon {
        width: 36px;
        height: 36px;
    }
    
    .stat-number {
        font-size: 1.5rem;
    }
}
</style>

<script>
    function previewPhoto(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            
            // Validasi ukuran file (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 2MB.');
                input.value = '';
                return;
            }
            
            // Validasi tipe file
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                alert('Format file tidak didukung. Gunakan JPG, PNG, atau GIF.');
                input.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('avatarPreview');
                if (preview.tagName === 'IMG') {
                    preview.src = e.target.result;
                } else {
                    // Replace placeholder with img
                    const parent = preview.parentElement;
                    const img = document.createElement('img');
                    img.id = 'avatarPreview';
                    img.src = e.target.result;
                    img.style.width = '100%';
                    img.style.height = '100%';
                    img.style.borderRadius = '50%';
                    img.style.objectFit = 'cover';
                    parent.replaceChild(img, preview);
                }
            };
            reader.readAsDataURL(file);
            
            // Auto submit the form to upload photo immediately
            document.getElementById('profileForm').submit();
        }
    }
</script>
@endsection