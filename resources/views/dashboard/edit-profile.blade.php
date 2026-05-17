@extends('layouts.app')

@section('title', 'Edit Profile - ' . ucfirst(auth()->user()->role))

@section('content')

<style>
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
    .avatar-preview {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #00D2FF;
    }
    .help-text {
        font-size: 11px;
        color: #6b6b6b;
        margin-top: 4px;
    }
</style>

<div class="py-24 px-6">
    <div class="container mx-auto max-w-2xl">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ auth()->user()->role === 'creator' ? route('creator.dashboard') : route('dashboard.user') }}" 
               class="text-gray-400 hover:text-blue transition">← Back to Dashboard</a>
            <h1 class="text-3xl font-bold">Edit <span class="gradient-blue">Profile</span></h1>
        </div>
        
        <div class="glass rounded-2xl p-8">
          <form action="{{ auth()->user()->role === 'creator' ? route('creator.profile.update') : route('user.profile.update') }}" 
      method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <!-- Avatar -->
    <div class="mb-6 text-center">
        <label class="form-label">Profile Picture</label>
        <div class="flex flex-col items-center gap-4">
            <img src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=00D2FF&color=fff&size=100' }}" 
                 class="avatar-preview"
                 id="avatarPreview">
            <div>
                <input type="file" name="avatar" id="avatarInput" accept="image/*" class="text-sm text-gray-400">
                <p class="help-text">JPG, PNG (Max 2MB)</p>
                @if($user->avatar)
                <button type="button" onclick="deleteAvatar()" class="mt-2 text-sm text-red-400 hover:text-red-300 transition">
                    🗑️ Delete Avatar
                </button>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Name -->
    <div class="mb-4">
        <label class="form-label">Display Name *</label>
        <input type="text" name="name" class="form-input" value="{{ $user->name }}" required>
    </div>
    
    <!-- Bio (SEMUA USER) -->
    <div class="mb-4">
        <label class="form-label">Bio</label>
        <textarea name="bio" rows="4" class="form-input" placeholder="Tell about yourself...">{{ $user->bio }}</textarea>
        <p class="help-text">Short bio about yourself (max 500 characters)</p>
    </div>
    
    <!-- Location (KHUSUS CREATOR) -->
    @if(auth()->user()->role === 'creator')
    <div class="mb-6">
        <label class="form-label">📍 Location</label>
        <input type="text" name="location" class="form-input" value="{{ $user->location }}" placeholder="e.g., Jakarta, Indonesia">
        <p class="help-text">Where are you based?</p>
    </div>
    @endif
    
    <div class="flex gap-4">
        <button type="submit" class="px-6 py-3 bg-blue text-black rounded-xl font-semibold hover:bg-blue-dark transition">
            💾 Save Changes
        </button>
        <a href="{{ auth()->user()->role === 'creator' ? route('creator.dashboard') : route('dashboard.user') }}" 
           class="px-6 py-3 border border-white/20 rounded-xl hover:bg-white/10 transition">
            Cancel
        </a>
    </div>
</form>
        </div>
    </div>
</div>

<script>
    // Preview avatar before upload
    document.getElementById('avatarInput')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('avatarPreview').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    
    function deleteAvatar() {
        if (confirm('Are you sure you want to delete your profile picture?')) {
            const url = '{{ auth()->user()->role === "creator" ? route("creator.profile.delete-avatar") : route("user.profile.delete-avatar") }}';
            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(() => location.reload());
        }
    }
</script>

@endsection@extends('layouts.app')

@section('title', 'Edit Profile - ' . ucfirst(auth()->user()->role))

@section('content')

<style>
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
    .avatar-preview {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #00D2FF;
    }
    .help-text {
        font-size: 11px;
        color: #6b6b6b;
        margin-top: 4px;
    }
</style>

<div class="py-24 px-6">
    <div class="container mx-auto max-w-2xl">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ auth()->user()->role === 'creator' ? route('creator.dashboard') : route('dashboard.user') }}" 
               class="text-gray-400 hover:text-blue transition">← Back to Dashboard</a>
            <h1 class="text-3xl font-bold">Edit <span class="gradient-blue">Profile</span></h1>
        </div>
        
        <div class="glass rounded-2xl p-8">
            <form action="{{ auth()->user()->role === 'creator' ? route('creator.profile.update') : route('user.profile.update') }}" 
                  method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Avatar -->
                <div class="mb-6 text-center">
                    <label class="form-label">Profile Picture</label>
                    <div class="flex flex-col items-center gap-4">
                        <img src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=00D2FF&color=fff&size=100' }}" 
                             class="avatar-preview"
                             id="avatarPreview">
                        <div>
                            <input type="file" name="avatar" id="avatarInput" accept="image/*" class="text-sm text-gray-400">
                            <p class="help-text">JPG, PNG (Max 2MB)</p>
                            @if($user->avatar)
                            <button type="button" onclick="deleteAvatar()" class="mt-2 text-sm text-red-400 hover:text-red-300 transition">
                                🗑️ Delete Avatar
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Name -->
                <div class="mb-4">
                    <label class="form-label">Display Name *</label>
                    <input type="text" name="name" class="form-input" value="{{ $user->name }}" required>
                </div>
                
                <!-- Bio (SEMUA USER) -->
                <div class="mb-4">
                    <label class="form-label">Bio</label>
                    <textarea name="bio" rows="4" class="form-input" placeholder="Tell about yourself...">{{ $user->bio }}</textarea>
                    <p class="help-text">Short bio about yourself (max 500 characters)</p>
                </div>
                
                <!-- Location (KHUSUS CREATOR) -->
                @if(auth()->user()->role === 'creator')
                <div class="mb-6">
                    <label class="form-label">📍 Location</label>
                    <input type="text" name="location" class="form-input" value="{{ $user->location }}" placeholder="e.g., Jakarta, Indonesia">
                    <p class="help-text">Where are you based?</p>
                </div>
                @endif
                
                <div class="flex gap-4">
                    <button type="submit" class="px-6 py-3 bg-blue text-black rounded-xl font-semibold hover:bg-blue-dark transition">
                        💾 Save Changes
                    </button>
                    <a href="{{ auth()->user()->role === 'creator' ? route('creator.dashboard') : route('dashboard.user') }}" 
                       class="px-6 py-3 border border-white/20 rounded-xl hover:bg-white/10 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Preview avatar before upload
    document.getElementById('avatarInput')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('avatarPreview').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    
    function deleteAvatar() {
        if (confirm('Are you sure you want to delete your profile picture?')) {
            const url = '{{ auth()->user()->role === "creator" ? route("creator.profile.delete-avatar") : route("user.profile.delete-avatar") }}';
            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(() => location.reload());
        }
    }
</script>

@endsection