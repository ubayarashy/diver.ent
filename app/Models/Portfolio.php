<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'label',
        'description',
        'thumbnail',
        'image',
        'client_name',
        'year',
        'results',
        'status',
        'order'
    ];

    protected $casts = [
        'results' => 'array',
        'year' => 'integer',
    ];

    // Get category color for placeholder
    public function getCategoryColor()
    {
        $colors = [
            'social' => '#1a1a2e',
            'web' => '#162032',
            'ads' => '#1e1a2e',
            'brand' => '#1a2e1e',
            'video' => '#2e1a1e',
            'seo' => '#1e2e1a',
        ];
        return $colors[$this->category] ?? '#1a1a2e';
    }

    // Get category icon for placeholder
    public function getCategoryIcon()
    {
        $icons = [
            'social' => 'fab fa-instagram',
            'web' => 'fas fa-globe',
            'ads' => 'fas fa-chart-line',
            'brand' => 'fas fa-palette',
            'video' => 'fas fa-video',
            'seo' => 'fas fa-search',
        ];
        return $icons[$this->category] ?? 'fas fa-image';
    }

    // Get status badge
    public function getStatusBadge()
    {
        if ($this->status == 'published') {
            return '<span class="badge-success">Published</span>';
        }
        return '<span class="badge-draft">Draft</span>';
    }
}