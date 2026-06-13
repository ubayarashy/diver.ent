@extends('layouts.app')

@section('content')
@include('admin.sidebar')

<div class="admin-main">
    <div class="admin-content">
        <div class="page-header">
            <h1><i class="fas fa-plus-circle"></i> Tambah Portfolio</h1>
            <p>Tambahkan portfolio baru ke landing page</p>
        </div>

        <div class="form-container">
            <form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label>Judul Portfolio <span class="required">*</span></label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Kategori <span class="required">*</span></label>
                        <select name="category" class="form-control" required>
                            <option value="social">Social Media</option>
                            <option value="web">Website & Apps</option>
                            <option value="ads">Digital Ads</option>
                            <option value="brand">Visual Branding</option>
                            <option value="video">Photo & Video</option>
                            <option value="seo">SEO</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Label <span class="required">*</span></label>
                        <input type="text" name="label" class="form-control" placeholder="Social Media, Website Dev, dll" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi <span class="required">*</span></label>
                    <textarea name="description" rows="5" class="form-control" required></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Client</label>
                        <input type="text" name="client_name" class="form-control" placeholder="Nama brand/client">
                    </div>
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="number" name="year" class="form-control" placeholder="2024" value="{{ date('Y') }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Gambar Utama</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="form-hint">Ukuran: 800x600px, maks 2MB</small>
                    </div>
                    <div class="form-group">
                        <label>Thumbnail</label>
                        <input type="file" name="thumbnail" class="form-control" accept="image/*">
                        <small class="form-hint">Ukuran: 400x300px, maks 1MB</small>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Order</label>
                        <input type="number" name="order" class="form-control" placeholder="Urutan tampil" value="0">
                    </div>
                </div>

              

                <div class="form-actions">
                    <a href="{{ route('admin.portfolios') }}" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-submit">Simpan Portfolio</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.admin-main {
    margin-left: 280px;
    min-height: 100vh;
    padding-top: 10px;
}
.admin-content{
    max-width: 1400px;
    margin: 0 auto;
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
.form-container {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 32px;
}
.form-group {
    margin-bottom: 20px;
}
.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
}
.required {
    color: #ef4444;
}
.form-control {
    width: 100%;
    padding: 12px 16px;
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 12px;
    color: var(--text);
    font-size: 0.9rem;
}
.form-control:focus {
    outline: none;
    border-color: var(--accent);
}
.form-hint {
    font-size: 0.7rem;
    color: var(--text-secondary);
    margin-top: 4px;
    display: block;
}
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}
.form-actions {
    display: flex;
    gap: 16px;
    justify-content: flex-end;
    margin-top: 24px;
}
.btn-cancel {
    background: transparent;
    border: 1px solid var(--border);
    color: var(--text);
    padding: 12px 24px;
    border-radius: 40px;
    text-decoration: none;
    transition: all 0.3s;
}
.btn-cancel:hover {
    border-color: var(--accent);
    color: var(--accent);
}
.btn-submit {
    background: var(--accent);
    color: #000;
    border: none;
    padding: 12px 24px;
    border-radius: 40px;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.3s;
}
.btn-submit:hover {
    transform: translateY(-2px);
    filter: brightness(0.95);
}
@media (max-width: 768px) {
    .admin-main { margin-left: 0; }
    .admin-content { padding: 20px; }
    .form-container { padding: 24px; }
    .form-row { grid-template-columns: 1fr; gap: 16px; }
}
</style>
@endsection