<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function index()
    {
        // ============================================
        // PHOTOGRAPHY PROJECTS
        // ============================================
        $photographyProjects = [
            (object)[
                'id' => 1,
                'title' => 'Urban Symphony: Jakarta Streets',
                'category' => 'Photography',
                'subcategory' => 'Street Photography',
                'thumbnail' => 'https://images.unsplash.com/photo-1500462918059-b1a0cb512f1d?w=600',
                'image' => 'https://images.unsplash.com/photo-1500462918059-b1a0cb512f1d?w=800',
                'description' => 'Capturing the raw energy and vibrant chaos of Jakarta\'s urban landscape.',
                'photographer' => 'Andi Pratama',
                'likes' => 2340,
                'views' => 12450,
                'date' => 'May 2024',
                'tags' => ['street', 'urban', 'black-white']
            ],
           
            (object)[
                'id' => 3,
                'title' => 'Monochrome Portraits',
                'category' => 'Photography',
                'subcategory' => 'Portrait',
                'thumbnail' => 'https://images.unsplash.com/photo-1542744094-3a31f272c490?w=600',
                'image' => 'https://images.unsplash.com/photo-1542744094-3a31f272c490?w=800',
                'description' => 'Minimalist monochrome portrait series exploring human expression.',
                'photographer' => 'Budi Santoso',
                'likes' => 3450,
                'views' => 15670,
                'date' => 'March 2024',
                'tags' => ['portrait', 'monochrome', 'minimalist']
            ],
            (object)[
                'id' => 4,
                'title' => 'Coffee Culture',
                'category' => 'Photography',
                'subcategory' => 'Lifestyle',
                'thumbnail' => 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?w=600',
                'image' => 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?w=800',
                'description' => 'Documenting the art of coffee brewing and cafe culture.',
                'photographer' => 'Maya Sari',
                'likes' => 2780,
                'views' => 12340,
                'date' => 'February 2024',
                'tags' => ['coffee', 'lifestyle', 'warm']
            ],
            (object)[
                'id' => 5,
                'title' => 'Barbershop Chronicle',
                'category' => 'Photography',
                'subcategory' => 'Documentary',
                'thumbnail' => 'https://images.unsplash.com/photo-1585747860715-2ba37e788b70?w=600',
                'image' => 'https://images.unsplash.com/photo-1585747860715-2ba37e788b70?w=800',
                'description' => 'Capturing the vintage vibe and community spirit of local barbershops.',
                'photographer' => 'Eka Gusti',
                'likes' => 3450,
                'views' => 9870,
                'date' => 'January 2024',
                'tags' => ['barbershop', 'vintage', 'documentary']
            ],
            (object)[
                'id' => 6,
                'title' => 'Fashion Editorial',
                'category' => 'Photography',
                'subcategory' => 'Fashion',
                'thumbnail' => 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=600',
                'image' => 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=800',
                'description' => 'High-end fashion editorial for Tommy Hilfiger campaign.',
                'photographer' => 'Alexander Chen',
                'likes' => 5670,
                'views' => 23450,
                'date' => 'December 2023',
                'tags' => ['fashion', 'editorial', 'luxury']
            ],
        ];

        // ============================================
        // DESIGN PROJECTS (Poster, Branding, UI/UX)
        // ============================================
        $designProjects = [
            (object)[
                'id' => 7,
                'title' => 'Minimalist Poster Series',
                'category' => 'Design',
                'subcategory' => 'Poster Design',
                'thumbnail' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=600',
                'image' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=800',
                'description' => 'Award-winning minimalist poster collection for art exhibition.',
                'designer' => 'Fajar Nugraha',
                'likes' => 2340,
                'views' => 18900,
                'date' => 'May 2024',
                'tags' => ['poster', 'minimalist', 'typography']
            ],
            (object)[
                'id' => 8,
                'title' => 'Nike Brand Identity',
                'category' => 'Design',
                'subcategory' => 'Brand Identity',
                'thumbnail' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600',
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800',
                'description' => 'Complete brand identity system for Nike Air Max campaign.',
                'designer' => 'Andi Pratama',
                'likes' => 7890,
                'views' => 34500,
                'date' => 'April 2024',
                'tags' => ['branding', 'identity', 'sportswear']
            ],
            (object)[
                'id' => 9,
                'title' => 'Coffee Society Packaging',
                'category' => 'Design',
                'subcategory' => 'Packaging',
                'thumbnail' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?w=600',
                'image' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?w=800',
                'description' => 'Elegant packaging design for artisanal coffee brand.',
                'designer' => 'Citra Dewi',
                'likes' => 4560,
                'views' => 18760,
                'date' => 'March 2024',
                'tags' => ['packaging', 'coffee', 'minimalist']
            ],
            (object)[
                'id' => 10,
                'title' => 'Music Festival Poster',
                'category' => 'Design',
                'subcategory' => 'Poster Design',
                'thumbnail' => 'https://images.unsplash.com/photo-1541701494587-cb58502866ab?w=600',
                'image' => 'https://images.unsplash.com/photo-1541701494587-cb58502866ab?w=800',
                'description' => 'Vibrant poster design for annual music festival.',
                'designer' => 'Budi Santoso',
                'likes' => 3450,
                'views' => 23400,
                'date' => 'February 2024',
                'tags' => ['poster', 'music', 'colorful']
            ],
            (object)[
                'id' => 11,
                'title' => 'Barbershop Logo Suite',
                'category' => 'Design',
                'subcategory' => 'Logo Design',
                'thumbnail' => 'https://images.unsplash.com/photo-1585747860715-2ba37e788b70?w=600',
                'image' => 'https://images.unsplash.com/photo-1585747860715-2ba37e788b70?w=800',
                'description' => 'Complete logo and identity system for premium barbershop.',
                'designer' => 'Eka Gusti',
                'likes' => 2780,
                'views' => 12540,
                'date' => 'January 2024',
                'tags' => ['logo', 'barbershop', 'vintage']
            ],
            (object)[
                'id' => 12,
                'title' => 'Typography Exploration',
                'category' => 'Design',
                'subcategory' => 'Typography',
                'thumbnail' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=600',
                'image' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=800',
                'description' => 'Experimental typography and lettering exploration.',
                'designer' => 'Fajar Nugraha',
                'likes' => 1890,
                'views' => 9870,
                'date' => 'December 2023',
                'tags' => ['typography', 'lettering', 'experimental']
            ],
        ];

        // ============================================
        // VIDEO PROJECTS
        // ============================================
        $videoProjects = [
            (object)[
                'id' => 13,
                'title' => 'Cinematic Travel Film: Bali',
                'category' => 'Videography',
                'subcategory' => 'Travel Film',
                'thumbnail' => 'https://images.unsplash.com/photo-1535016120720-40c646be5580?w=600',
                'image' => 'https://images.unsplash.com/photo-1535016120720-40c646be5580?w=800',
                'description' => 'Cinematic travel documentary exploring Bali\'s hidden gems.',
                'videographer' => 'Citra Dewi',
                'duration' => '3:45',
                'likes' => 5670,
                'views' => 45600,
                'date' => 'May 2024',
                'tags' => ['travel', 'cinematic', 'bali']
            ],
            (object)[
                'id' => 14,
                'title' => 'Fashion Film: Gucci Garden',
                'category' => 'Videography',
                'subcategory' => 'Fashion Film',
                'thumbnail' => 'https://images.unsplash.com/photo-1539109136881-3be0616acf4b?w=600',
                'image' => 'https://images.unsplash.com/photo-1539109136881-3be0616acf4b?w=800',
                'description' => 'Luxury fashion film for Gucci\'s latest collection.',
                'videographer' => 'Alexander Chen',
                'duration' => '2:30',
                'likes' => 8900,
                'views' => 67800,
                'date' => 'April 2024',
                'tags' => ['fashion', 'luxury', 'film']
            ],
            (object)[
                'id' => 15,
                'title' => 'Barbershop Story',
                'category' => 'Videography',
                'subcategory' => 'Documentary',
                'thumbnail' => 'https://images.unsplash.com/photo-1621605815971-fbc98d665033?w=600',
                'image' => 'https://images.unsplash.com/photo-1621605815971-fbc98d665033?w=800',
                'description' => 'Short documentary about traditional barbershop culture.',
                'videographer' => 'Budi Santoso',
                'duration' => '5:20',
                'likes' => 3450,
                'views' => 23400,
                'date' => 'March 2024',
                'tags' => ['documentary', 'barbershop', 'storytelling']
            ],
        ];

        // ============================================
        // ALL PROJECTS (Gabungan)
        // ============================================
        $allProjects = array_merge($photographyProjects, $designProjects, $videoProjects);

        // ============================================
        // CATEGORIES
        // ============================================
        $categories = [
            (object)['id' => 'all', 'name' => 'All', 'icon' => '🎨'],
            (object)['id' => 'photography', 'name' => 'Photography', 'icon' => '📷'],
            (object)['id' => 'design', 'name' => 'Design', 'icon' => '✏️'],
            (object)['id' => 'videography', 'name' => 'Videography', 'icon' => '🎬'],
            (object)['id' => 'poster', 'name' => 'Poster', 'icon' => '🖼️'],
            (object)['id' => 'branding', 'name' => 'Branding', 'icon' => '🏷️'],
            (object)['id' => 'portrait', 'name' => 'Portrait', 'icon' => '👤'],
            (object)['id' => 'street', 'name' => 'Street', 'icon' => '🏙️'],
        ];

        // ============================================
        // FEATURED THUMBNAILS (Untuk hero explore)
        // ============================================
        $featuredThumbnails = [
            'https://images.unsplash.com/photo-1500462918059-b1a0cb512f1d?w=1200',
            'https://images.unsplash.com/photo-1536240474400-9d7b4b6cfbab?w=1200',
            'https://images.unsplash.com/photo-1542744094-3a31f272c490?w=1200',
            'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=1200',
        ];

        return view('explore.index', compact('allProjects', 'photographyProjects', 'designProjects', 'videoProjects', 'categories', 'featuredThumbnails'));
    }

    public function category($category)
    {
        // Filter by category logic
        return view('explore.category', ['category' => $category]);
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        // Search logic
        return view('explore.search', ['query' => $query]);
    }
}