<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;

class ExploreController extends Controller
{
    public function index()
    {
        // Ambil semua project yang statusnya approved
        $projects = Project::with('category')
            ->where('status', 'approved')
            ->orderBy('published_at', 'desc')
            ->get();
        
        // Ambil project ID yang sudah di-like user (jika login)
        $likedProjectIds = [];
        if (auth()->check()) {
            $likedProjectIds = auth()->user()->likes()->pluck('project_id')->toArray();
        }
        
        // Mapping ke format yang dibutuhkan view
        $allProjects = $projects->map(function($project) {
            $formattedDate = 'January 2024';
            if ($project->published_at) {
                try {
                    $formattedDate = date('F Y', strtotime($project->published_at));
                } catch (\Exception $e) {
                    $formattedDate = date('F Y');
                }
            }
            
            return (object)[
                'id' => $project->id,
                'title' => $project->title,
                'slug' => $project->slug,  // <-- TAMBAHKAN UNTUK LINK DETAIL
                'category' => $project->category ? $project->category->name : 'Uncategorized',
                'subcategory' => $this->getSubcategory($project->category_id),
                'thumbnail' => $project->thumbnail,
                'image' => $project->thumbnail,
                'description' => substr($project->description ?? 'No description', 0, 120),
                'photographer' => $project->user ? $project->user->name : 'Diver Team',
                'designer' => $project->user ? $project->user->name : 'Diver Team',
                'videographer' => $project->user ? $project->user->name : 'Diver Team',
                'likes' => $project->likes_count ?? 0,
                'views' => $project->views ?? 0,
                'date' => $formattedDate,
                'tags' => $project->tags ? (is_array($project->tags) ? $project->tags : json_decode($project->tags, true)) : ['creative', 'design'],
                'duration' => $project->category_id == 2 ? '2:30' : null,
            ];
        });
        
        // Pisahkan berdasarkan kategori untuk keperluan view (opsional)
        $photographyProjects = $projects->where('category_id', 1)->map(function($project) {
            $formattedDate = $project->published_at ? date('F Y', strtotime($project->published_at)) : date('F Y');
            return (object)[
                'id' => $project->id,
                'title' => $project->title,
                'category' => 'Photography',
                'subcategory' => $this->getSubcategory(1),
                'thumbnail' => $project->thumbnail,
                'description' => substr($project->description ?? '', 0, 120),
                'photographer' => $project->user ? $project->user->name : 'Diver Team',
                'likes' => $project->likes_count ?? 0,
                'views' => $project->views ?? 0,
                'date' => $formattedDate,
                'tags' => $project->tags ? (is_array($project->tags) ? $project->tags : json_decode($project->tags, true)) : ['photography', 'creative'],
            ];
        });
        
        $designProjects = $projects->where('category_id', 3)->map(function($project) {
            $formattedDate = $project->published_at ? date('F Y', strtotime($project->published_at)) : date('F Y');
            return (object)[
                'id' => $project->id,
                'title' => $project->title,
                'category' => 'Design',
                'subcategory' => 'Brand Identity',
                'thumbnail' => $project->thumbnail,
                'description' => substr($project->description ?? '', 0, 120),
                'designer' => $project->user ? $project->user->name : 'Diver Team',
                'likes' => $project->likes_count ?? 0,
                'views' => $project->views ?? 0,
                'date' => $formattedDate,
                'tags' => $project->tags ? (is_array($project->tags) ? $project->tags : json_decode($project->tags, true)) : ['design', 'branding'],
            ];
        });
        
        $videoProjects = $projects->where('category_id', 2)->map(function($project) {
            $formattedDate = $project->published_at ? date('F Y', strtotime($project->published_at)) : date('F Y');
            return (object)[
                'id' => $project->id,
                'title' => $project->title,
                'category' => 'Videography',
                'subcategory' => 'Video Production',
                'thumbnail' => $project->thumbnail,
                'description' => substr($project->description ?? '', 0, 120),
                'videographer' => $project->user ? $project->user->name : 'Diver Team',
                'duration' => '2:30',
                'likes' => $project->likes_count ?? 0,
                'views' => $project->views ?? 0,
                'date' => $formattedDate,
                'tags' => $project->tags ? (is_array($project->tags) ? $project->tags : json_decode($project->tags, true)) : ['video', 'cinematic'],
            ];
        });
        
        // Categories
        $dbCategories = Category::all();
        $categories = collect([
            (object)['id' => 'all', 'name' => 'All', 'icon' => '🎨']
        ])->concat($dbCategories->map(function($cat) {
            return (object)[
                'id' => $cat->slug,
                'name' => $cat->name,
                'icon' => $this->getCategoryIcon($cat->name),
            ];
        }));
        
        // Featured Thumbnails
        $featuredThumbnails = $projects->take(4)->pluck('thumbnail')->toArray();
        if (empty($featuredThumbnails)) {
            $featuredThumbnails = [
                'https://images.unsplash.com/photo-1500462918059-b1a0cb512f1d?w=1200',
                'https://images.unsplash.com/photo-1536240474400-9d7b4b6cfbab?w=1200',
                'https://images.unsplash.com/photo-1542744094-3a31f272c490?w=1200',
                'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=1200',
            ];
        }
        
        return view('explore.index', compact(
            'allProjects', 
            'photographyProjects', 
            'designProjects', 
            'videoProjects', 
            'categories', 
            'featuredThumbnails',
            'likedProjectIds'  // <-- TAMBAHKAN INI
        ));
    }
    
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $projects = Project::with('category')
            ->where('status', 'approved')
            ->when($category, function($query) use ($category) {
                return $query->where('category_id', $category->id);
            })
            ->orderBy('published_at', 'desc')
            ->get();
        
        return view('explore.category', compact('category', 'projects'));
    }
    
    public function search(Request $request)
    {
        $query = $request->get('q');
        $projects = Project::with('category')
            ->where('status', 'approved')
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->orderBy('published_at', 'desc')
            ->get();
        
        return view('explore.search', compact('query', 'projects'));
    }
    
    private function getSubcategory($categoryId)
    {
        $subcategories = [
            1 => 'Photography',
            2 => 'Videography', 
            3 => 'Brand Identity',
            4 => 'Social Media',
            5 => 'Motion Graphic',
        ];
        return $subcategories[$categoryId] ?? 'Creative Work';
    }
    
    private function getCategoryIcon($categoryName)
    {
        $icons = [
            'Photography' => '📷',
            'Videography' => '🎬',
            'Branding' => '🏷️',
            'Social Media' => '📱',
            'Motion Graphic' => '🎨',
        ];
        return $icons[$categoryName] ?? '🎨';
    }
}