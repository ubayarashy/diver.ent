@extends('team.layouts.app')

@section('content')
@include('team.partials.sidebar')
<div class="team-main">
    @include('team.partials.navbar')
    <div class="team-content">
        <h1><i class="fas fa-user-circle"></i> Profil Saya</h1>
        <div class="profile-card">
            <div class="avatar-large">{{ substr($user->name, 0, 2) }}</div>
            <form method="POST" action="{{ route('team.profile.update') }}">
                @csrf
                <div class="form-group"><label>Nama</label><input type="text" name="name" value="{{ $user->name }}" required></div>
                <div class="form-group"><label>Email</label><input type="email" name="email" value="{{ $user->email }}" required></div>
                <div class="form-group"><label>Telepon</label><input type="text" name="phone" value="{{ $user->phone ?? '' }}"></div>
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>

<style>
.team-main { margin-left: 280px; }
.team-content { padding: 32px; max-width: 600px; }
.profile-card { background: var(--surface-card); border-radius: 24px; padding: 32px; text-align: center; }
.avatar-large { width: 100px; height: 100px; background: var(--accent); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: bold; margin: 0 auto 24px; color: white; }
.form-group { margin-bottom: 20px; text-align: left; }
.form-group label { display: block; margin-bottom: 8px; font-weight: 600; }
.form-group input { width: 100%; padding: 12px; background: var(--bg); border: 1px solid var(--border); border-radius: 12px; color: var(--text-primary); }
.btn-primary { background: var(--accent); color: #000; border: none; padding: 12px 24px; border-radius: 40px; cursor: pointer; width: 100%; }
@media (max-width: 768px) { .team-main { margin-left: 0; } }
</style>
@endsection