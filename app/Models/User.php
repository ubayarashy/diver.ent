<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'avatar', 
        'bio', 'location', 'verified', 'follower_count', 'following_count'
    ];

    protected $hidden = ['password', 'remember_token'];

    // Relasi ke project (sebagai creator)
    public function projects()
    {
        return $this->hasMany(Project::class, 'user_id');
    }
    
    // TAMBAHKAN INI - Relasi ke Like
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    // Followers (orang yang follow user ini)
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }
    
    // Following (orang yang di-follow user ini)
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }
    
    // Cek apakah user sudah follow creator ini
    public function isFollowing($creatorId)
    {
        return $this->following()->where('following_id', $creatorId)->exists();
    }
}