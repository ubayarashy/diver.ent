<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id', 'thumbnail', 'work_link', 'notes'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}