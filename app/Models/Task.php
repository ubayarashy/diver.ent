<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'brief_id',
        'title',
        'description',
        'status',
        'divisi',
    ];


    protected $casts = [
        'deadline' => 'date',
    ];

    public function brief()
    {
        return $this->belongsTo(Brief::class, 'brief_id');
    }




    public function result()
    {
        return $this->hasOne(ProjectResult::class);
    }
}