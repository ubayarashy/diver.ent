<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brief extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'project_name', 'categories', 'budget', 'description', 'status'
    ];

    protected $casts = [
        'categories' => 'array',
        'budget' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function result()
    {
        return $this->hasOne(ProjectResult::class);
    }

    public function portfolio()
    {
        return $this->hasOne(Portfolio::class);
    }
}