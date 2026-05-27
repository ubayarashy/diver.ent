<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'brief_id',
        'assigned_to',
        'title',
        'description',
        'status',
        'progress',
        'deadline',
        'result',
        'team_notes',
    ];

    protected $casts = [
        'result' => 'array',
        'deadline' => 'date',
    ];

    public function brief()
    {
        return $this->belongsTo(Brief::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="badge-pending">⏳ Pending</span>',
            'in_progress' => '<span class="badge-progress">🔄 In Progress</span>',
            'review' => '<span class="badge-review">📋 Review</span>',
            'revision' => '<span class="badge-revision">✏️ Revision</span>',
            'completed' => '<span class="badge-completed">✅ Completed</span>',
        ];
        return $badges[$this->status] ?? '<span class="badge-pending">⏳ Pending</span>';
    }
}