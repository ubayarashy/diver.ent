<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'assigned_to', 'title', 'description', 'status', 'progress', 'deadline'
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    public function project()
    {
        return $this->belongsTo(Brief::class, 'project_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function result()
    {
        return $this->hasOne(ProjectResult::class);
    }
}