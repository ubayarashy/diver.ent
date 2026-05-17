<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\Partner;

class HomeController extends Controller
{
    public function index()
    {
        // ============================================
        // AMBIL DATA DARI DATABASE
        // ============================================
        
        // 1. Projects (Featured Work)
        $allProjects = Project::where('status', 'approved')
            ->orderBy('is_featured', 'desc')
            ->orderBy('published_at', 'desc')
            ->get()
            ->map(function($project) {
                return (object)[
                    'id' => $project->id,
                    'title' => strtoupper($project->title),
                    'brand' => $this->getBrandFromTitle($project->title),
                    'category' => $project->category ? $project->category->name : 'Uncategorized',
                    'image' => $project->thumbnail,
                    'year' => date('Y', strtotime($project->published_at)),
                    'likes' => $this->formatNumber($project->likes_count),
                    'slug' => $project->slug,
                ];
            });
        
        // 2. Recent Projects (6 terbaru)
        $recentProjects = Project::where('status', 'approved')
            ->latest()
            ->take(6)
            ->get()
            ->map(function($project) {
                return (object)[
                    'id' => $project->id,
                    'title' => strtoupper($project->title),
                    'brand' => $this->getBrandFromTitle($project->title),
                    'category' => $project->category ? $project->category->name : 'Uncategorized',
                    'image' => $project->thumbnail,
                    'year' => date('Y', strtotime($project->published_at)),
                    'slug' => $project->slug,
                ];
            });
        
        // 3. Featured Projects (is_featured = 1)
        $featuredProjects = Project::where('status', 'approved')
            ->where('is_featured', 1)
            ->take(3)
            ->get()
            ->map(function($project) {
                return (object)[
                    'id' => $project->id,
                    'title' => strtoupper($project->title),
                    'description' => substr($project->description, 0, 100),
                    'image' => $project->thumbnail,
                    'slug' => $project->slug,
                    'stats' => $this->formatNumber($project->views) . ' Views',
                ];
            });
        
        // 4. Categories
        $categories = Category::all()->map(function($cat) {
            return (object)[
                'id' => $cat->id,
                'name' => strtoupper($cat->name),
                'slug' => $cat->slug,
                'count' => Project::where('category_id', $cat->id)->where('status', 'approved')->count(),
            ];
        });
        
        // 5. Team Members
        $teamMembers = TeamMember::orderBy('order')->get()->map(function($member) {
            return (object)[
                'name' => $member->name,
                'position' => $member->position,
                'avatar' => $member->avatar,
                'bio' => $member->bio,
                'social_links' => $member->social_links ?? ['instagram' => '#', 'linkedin' => '#'],
            ];
        });
        
        // 6. Testimonials
        $testimonials = Testimonial::latest()->take(6)->get()->map(function($testi) {
            return (object)[
                'content' => $testi->content,
                'client_name' => strtoupper($testi->client_name),
                'client_position' => $testi->client_position,
                'avatar' => $testi->avatar,
                'rating' => $testi->rating,
                'project' => $testi->project ?? 'Creative Campaign',
                'date' => $testi->date ?? date('F Y', strtotime($testi->created_at)),
            ];
        });
        
        // 7. Partners
        $partners = Partner::orderBy('order')->get()->map(function($partner) {
            return (object)[
                'name' => $partner->name,
                'logo' => $partner->logo,
            ];
        });
        
        // 8. Statistics (dari database)
        $stats = [
            (object)['number' => Project::where('status', 'approved')->count(), 'label' => 'Projects Completed'],
            (object)['number' => 256, 'label' => 'Happy Clients'],
            (object)['number' => 34, 'label' => 'Awards Won'],
            (object)['number' => 12, 'label' => 'Years Experience'],
        ];
        
        // ============================================
        // DATA STATIS (Hero Slides, Services, dll)
        // ============================================
        
        // Hero Slides
        $heroSlides = [
            (object)[
                'video' => 'https://player.vimeo.com/external/434045892.sd.mp4?s=20c86e222d6042a9de1b28c2a49c377b0efff6ac&profile_id=164',
                'title' => 'Your Diving Buddy',
                'subtitle' => 'To Elevate Your Brand',
                'cta' => 'Explore Work'
            ],
            (object)[
                'video' => 'https://assets.mixkit.co/videos/preview/mixkit-young-woman-posing-in-a-fashion-shoot-4263-large.mp4',
                'title' => 'Cinematic Storytelling',
                'subtitle' => 'That Captivates Audiences',
                'cta' => 'Watch Reel'
            ],
            (object)[
                'video' => 'https://assets.mixkit.co/videos/preview/mixkit-woman-in-a-dark-studio-posing-for-a-fashion-photoshoot-3297-large.mp4',
                'title' => 'Luxury Visuals',
                'subtitle' => 'For Premium Brands',
                'cta' => 'View Portfolio'
            ],
        ];
        
        // Services
        $services = [
            (object)['icon' => '📷', 'title' => 'Photography', 'desc' => 'Professional photography for fashion, products, events, and editorial content.'],
            (object)['icon' => '🎥', 'title' => 'Videography', 'desc' => 'Cinematic video production, brand films, commercials, and motion graphics.'],
            (object)['icon' => '🏷️', 'title' => 'Brand Identity', 'desc' => 'Complete branding solutions including logo, color palette, typography, and guidelines.'],
            (object)['icon' => '📱', 'title' => 'Social Media', 'desc' => 'Strategic social media management, content creation, and community engagement.'],
            (object)['icon' => '🎬', 'title' => 'Motion Graphic', 'desc' => '2D and 3D animation, explainer videos, and motion graphics for digital platforms.'],
            (object)['icon' => '🚀', 'title' => 'Creative Campaign', 'desc' => 'Full-scale creative campaigns from concept development to execution.'],
        ];
        
        // Specializations
        $specializations = [
            (object)['icon' => '🎯', 'title' => 'ED&I Initiatives', 'desc' => 'Inclusive creative strategies that celebrate diversity and representation.'],
            (object)['icon' => '🏷️', 'title' => 'Brand Strategy', 'desc' => 'Data-driven brand positioning and storytelling that resonates.'],
            (object)['icon' => '📈', 'title' => 'Marketing Campaigns', 'desc' => 'Integrated marketing solutions that drive engagement and conversions.'],
            (object)['icon' => '💡', 'title' => 'Product Innovation', 'desc' => 'Creative product development and launch strategies for success.'],
        ];
        
        // Articles (Statis dulu, bisa diambil dari database nanti)
        $articles = [
            (object)['title' => 'How Cinematic Storytelling Transforms Brand Identity', 'category' => 'BRANDING', 'time' => '5 min', 'excerpt' => 'Discover how brands like Nike use visual storytelling to connect with audiences.', 'thumbnail' => 'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=600'],
            (object)['title' => 'The Rise of Minimalist Aesthetic in Modern Advertising', 'category' => 'TRENDS', 'time' => '4 min', 'excerpt' => 'Why less is more: How luxury brands are embracing monochrome and simplicity.', 'thumbnail' => 'https://images.unsplash.com/photo-1541701494587-cb58502866ab?w=600'],
            (object)['title' => 'Behind the Scenes: Fashion Campaign Production', 'category' => 'PRODUCTION', 'time' => '6 min', 'excerpt' => 'Exclusive look at how we produced the latest Tommy Hilfiger campaign.', 'thumbnail' => 'https://images.unsplash.com/photo-1535016120720-40c646be5580?w=600'],
            (object)['title' => 'Social Media Strategy for Local Businesses', 'category' => 'STRATEGY', 'time' => '7 min', 'excerpt' => 'How barbershops and cafes leverage visual content to attract more customers.', 'thumbnail' => 'https://images.unsplash.com/photo-1585747860715-2ba37e788b70?w=600'],
        ];
        
        // Masonry Gallery (untuk sementara dari projects)
        $masonryGallery = $allProjects->map(function($project) {
            return (object)[
                'image' => $project->image,
                'title' => $project->title,
                'brand' => $project->brand,
                'category' => $project->category,
            ];
        });
        
        // Data untuk kompatibilitas view
        $featuredWork = $allProjects;
        $galleryPhotos = $masonryGallery;
        $instagramFeed = $masonryGallery->take(12);
        $zoomGallery = $masonryGallery->take(12);
        $abstractGallery = $masonryGallery->take(10);
        $spotlightCreators = [];
        $awards = [];
        $faqs = [];
        $socialFeed = [];
        $ourPartners = $partners;
        $sponsors = $partners;
        
        return view('landing.index', compact(
            'heroSlides', 'allProjects', 'testimonials', 'masonryGallery',
            'sponsors', 'ourPartners', 'articles',
            'featuredWork', 'recentProjects', 'featuredProjects',
            'galleryPhotos', 'instagramFeed', 'zoomGallery', 'abstractGallery',
            'teamMembers', 'spotlightCreators', 'stats', 'awards',
            'faqs', 'socialFeed', 'categories', 'services', 'specializations', 'partners'
        ));
    }
    
    // Helper function untuk format number (K, M)
    private function formatNumber($num)
    {
        if ($num >= 1000000) {
            return round($num / 1000000, 1) . 'M';
        }
        if ($num >= 1000) {
            return round($num / 1000, 1) . 'K';
        }
        return (string)$num;
    }
    
    // Helper function untuk ambil brand dari title
    private function getBrandFromTitle($title)
    {
        $brands = ['Nike', 'Gucci', 'Prada', 'Adidas', 'Starbucks', 'Dior', 'Versace', 'Louis Vuitton', 'Tommy', 'Balenciaga'];
        foreach ($brands as $brand) {
            if (stripos($title, $brand) !== false) {
                return $brand;
            }
        }
        return 'Diver';
    }
}