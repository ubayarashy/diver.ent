<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'description',
        'content',
        'thumbnail',
        'cover_image',
        'cover_video',
        'gallery',
        'tools_used',
        'tags',
        'views',
        'likes_count',
        'bookmarks_count',
        'is_featured',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'gallery' => 'array',
        'tags' => 'array',
    ];

    // Relasi ke User (creator)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // TAMBAHKAN METHOD INI - Relasi ke Like
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // TAMBAHKAN METHOD INI - Cek apakah user sudah like
    public function isLikedBy($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }
}