@extends('layouts.app')

@section('title', 'Upload Project - Diver Entertainment')

@section('content')

<style>
    .upload-area {
        border: 2px dashed rgba(255, 255, 255, 0.15);
        border-radius: 20px;
        padding: 40px;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .upload-area:hover {
        border-color: #00D2FF;
        background: rgba(0, 210, 255, 0.02);
    }
    .upload-area.dragover {
        border-color: #00D2FF;
        background: rgba(0, 210, 255, 0.05);
    }
    .preview-img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 12px;
        margin-top: 15px;
        border: 2px solid rgba(255,255,255,0.1);
    }
    .form-input {
        width: 100%;
        padding: 12px 16px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        color: white;
        transition: all 0.3s;
    }
    .form-input:focus {
        outline: none;
        border-color: #00D2FF;
    }
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        color: #9a9a9a;
    }
</style>

<div class="py-24 px-6">
    <div class="container mx-auto max-w-3xl">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('creator.dashboard') }}" class="text-gray-400 hover:text-blue transition">← Back to Dashboard</a>
            <h1 class="text-3xl font-bold">Upload <span class="gradient-blue">New Project</span></h1>
        </div>
        
        <div class="glass rounded-2xl p-8">
            <form action="{{ route('creator.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="form-label">Project Title *</label>
                        <input type="text" name="title" class="form-input" placeholder="e.g., Nike Air Max Campaign" required>
                    </div>
                    <div>
                        <label class="form-label">Category *</label>
                        <select name="category_id" class="form-input" required>
                            <option value="">Select Category</option>
                            @foreach($categories ?? [] as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="mt-4">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="5" class="form-input" placeholder="Describe your project..."></textarea>
                </div>
                
                <!-- Thumbnail Upload -->
                <div class="mt-4">
                    <label class="form-label">Thumbnail * (Main Image)</label>
                    <div id="dropZone" class="upload-area">
                        <input type="file" name="thumbnail" id="thumbnailInput" accept="image/*" class="hidden" required>
                        <svg class="w-12 h-12 mx-auto text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-gray-400">Click or drag & drop image here</p>
                        <p class="text-xs text-gray-600 mt-1">JPG, PNG, GIF, WebP (Max 5MB)</p>
                    </div>
                    <div id="previewContainer" class="mt-4 hidden">
                        <img id="imagePreview" class="preview-img">
                        <p id="fileName" class="text-xs text-gray-500 mt-2"></p>
                    </div>
                </div>
                
                <div class="flex gap-4 mt-8">
                    <button type="submit" class="px-6 py-3 bg-blue text-black rounded-xl font-semibold hover:bg-blue-dark transition">
                        Upload Project
                    </button>
                    <a href="{{ route('creator.dashboard') }}" class="px-6 py-3 border border-white/20 rounded-xl hover:bg-white/10 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropZone = document.getElementById('dropZone');
    const thumbnailInput = document.getElementById('thumbnailInput');
    const previewContainer = document.getElementById('previewContainer');
    const imagePreview = document.getElementById('imagePreview');
    const fileName = document.getElementById('fileName');
    
    // Klik area upload
    dropZone.addEventListener('click', () => thumbnailInput.click());
    
    // Drag & drop
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('dragover');
    });
    
    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('dragover');
    });
    
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('dragover');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            handleFile(file);
            thumbnailInput.files = e.dataTransfer.files;
        }
    });
    
    thumbnailInput.addEventListener('change', (e) => {
        if (e.target.files[0]) {
            handleFile(e.target.files[0]);
        }
    });
    
    function handleFile(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            previewContainer.classList.remove('hidden');
            fileName.textContent = file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
        };
        reader.readAsDataURL(file);
    }
});
</script>

@endsection