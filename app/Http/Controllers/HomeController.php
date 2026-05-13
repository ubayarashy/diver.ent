<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // ============================================
        // HERO SLIDES
        // ============================================
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

        // ============================================
        // ALL PROJECTS - 15+ Projects
        // ============================================
        $allProjects = [
            (object)['id' => 1, 'title' => 'NIKE AIR MAX', 'brand' => 'Nike', 'category' => 'Fashion Campaign', 'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800', 'year' => '2024', 'likes' => '2.5M'],
            (object)['id' => 2, 'title' => 'PRADA LINEA ROSSA', 'brand' => 'Prada', 'category' => 'Luxury Campaign', 'image' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=800', 'year' => '2024', 'likes' => '1.8M'],
            (object)['id' => 3, 'title' => 'LOUIS VUITTON', 'brand' => 'Louis Vuitton', 'category' => 'Luxury Editorial', 'image' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=800', 'year' => '2024', 'likes' => '3.2M'],
            (object)['id' => 4, 'title' => 'VERSACE MANSION', 'brand' => 'Versace', 'category' => 'Luxury Campaign', 'image' => 'https://images.unsplash.com/photo-1556905055-8f358a7a47b2?w=800', 'year' => '2024', 'likes' => '2.1M'],
            (object)['id' => 5, 'title' => 'NIKE TECH PACK', 'brand' => 'Nike', 'category' => 'Sportswear', 'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800', 'year' => '2024', 'likes' => '1.5M'],
            (object)['id' => 6, 'title' => 'STARBUCKS RESERVE', 'brand' => 'Starbucks', 'category' => 'Brand Identity', 'image' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?w=800', 'year' => '2024', 'likes' => '890K'],
            (object)['id' => 7, 'title' => 'ADIDAS ORIGINALS', 'brand' => 'Adidas', 'category' => 'Streetwear', 'image' => 'https://images.unsplash.com/photo-1518002172853-08c1f8def5cc?w=800', 'year' => '2024', 'likes' => '3.8M'],
            (object)['id' => 8, 'title' => 'BARBERSHOP SUITES', 'brand' => 'Barbershop', 'category' => 'Interior', 'image' => 'https://images.unsplash.com/photo-1585747860715-2ba37e788b70?w=800', 'year' => '2024', 'likes' => '456K'],
            (object)['id' => 9, 'title' => 'COFFEE SOCIETY', 'brand' => 'Coffee Society', 'category' => 'Visual Identity', 'image' => 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?w=800', 'year' => '2023', 'likes' => '234K'],
            (object)['id' => 10, 'title' => 'DIOR MENSWEAR', 'brand' => 'Dior', 'category' => 'Luxury Fashion', 'image' => 'https://images.unsplash.com/photo-1617137968427-85924c800c6a?w=800', 'year' => '2024', 'likes' => '2.7M'],
            (object)['id' => 11, 'title' => 'BALENCIAGA', 'brand' => 'Balenciaga', 'category' => 'Luxury Fashion', 'image' => 'https://images.unsplash.com/photo-1588092734404-4b8af47e25a0?w=800', 'year' => '2024', 'likes' => '4.2M'],
            (object)['id' => 12, 'title' => 'TOMMY HILFIGER', 'brand' => 'Tommy Hilfiger', 'category' => 'Editorial', 'image' => 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=800', 'year' => '2024', 'likes' => '1.2M'],
            (object)['id' => 13, 'title' => 'THE BARBER ROOM', 'brand' => 'Barber Room', 'category' => 'Barbershop', 'image' => 'https://images.unsplash.com/photo-1621605815971-fbc98d665033?w=800', 'year' => '2024', 'likes' => '345K'],
            (object)['id' => 14, 'title' => 'BREW LAB', 'brand' => 'Brew Lab', 'category' => 'Cafe', 'image' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=800', 'year' => '2023', 'likes' => '123K'],
            (object)['id' => 15, 'title' => 'GUCCI GARDEN', 'brand' => 'Gucci', 'category' => 'Luxury Fashion', 'image' => 'https://images.unsplash.com/photo-1602751584552-8ba73aad9259?w=800', 'year' => '2024', 'likes' => '5.2M'],
        ];

        // ============================================
        // SERVICES
        // ============================================
        $services = [
            (object)['icon' => '📷', 'title' => 'Photography', 'desc' => 'Professional photography for fashion, products, events, and editorial content.'],
            (object)['icon' => '🎥', 'title' => 'Videography', 'desc' => 'Cinematic video production, brand films, commercials, and motion graphics.'],
            (object)['icon' => '🏷️', 'title' => 'Brand Identity', 'desc' => 'Complete branding solutions including logo, color palette, typography, and guidelines.'],
            (object)['icon' => '📱', 'title' => 'Social Media', 'desc' => 'Strategic social media management, content creation, and community engagement.'],
            (object)['icon' => '🎬', 'title' => 'Motion Graphic', 'desc' => '2D and 3D animation, explainer videos, and motion graphics for digital platforms.'],
            (object)['icon' => '🚀', 'title' => 'Creative Campaign', 'desc' => 'Full-scale creative campaigns from concept development to execution.'],
        ];

        // ============================================
        // TEAM MEMBERS - 8 ORANG (Template Placeholder)
        // ============================================
        $teamMembers = [
            (object)['name' => 'Andi Pratama', 'position' => 'Creative Director', 'avatar' => 'https://randomuser.me/api/portraits/men/32.jpg', 'social' => ['ig','lk','be']],
            (object)['name' => 'Citra Dewi', 'position' => 'Lead Photographer', 'avatar' => 'https://randomuser.me/api/portraits/women/68.jpg', 'social' => ['ig','lk','be']],
            (object)['name' => 'Budi Santoso', 'position' => 'Videographer', 'avatar' => 'https://randomuser.me/api/portraits/men/45.jpg', 'social' => ['ig','lk','be']],
            (object)['name' => 'Dian Sastro', 'position' => 'Editor', 'avatar' => 'https://randomuser.me/api/portraits/women/45.jpg', 'social' => ['ig','lk','be']],
            (object)['name' => 'Eka Gusti', 'position' => 'Social Media Specialist', 'avatar' => 'https://randomuser.me/api/portraits/men/67.jpg', 'social' => ['ig','lk','be']],
            (object)['name' => 'Fajar Nugraha', 'position' => 'Lead Designer', 'avatar' => 'https://randomuser.me/api/portraits/men/89.jpg', 'social' => ['ig','lk','be']],
            (object)['name' => 'Rina Widiastuti', 'position' => 'Motion Artist', 'avatar' => 'https://randomuser.me/api/portraits/women/55.jpg', 'social' => ['ig','lk','be']],
            (object)['name' => 'Tony Harsono', 'position' => 'Producer', 'avatar' => 'https://randomuser.me/api/portraits/men/72.jpg', 'social' => ['ig','lk','be']],
        ];

        // ============================================
        // MASONRY GALLERY - 60+ PHOTOS
        // ============================================
        $validImages = [
            'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600',
            'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=600',
            'https://images.unsplash.com/photo-1500462918059-b1a0cb512f1d?w=600',
            'https://images.unsplash.com/photo-1536240474400-9d7b4b6cfbab?w=600',
            'https://images.unsplash.com/photo-1442512595331-e89e73853f31?w=600',
            'https://images.unsplash.com/photo-1585747860715-2ba37e788b70?w=600',
            'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=600',
            'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?w=600',
            'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=600',
            'https://images.unsplash.com/photo-1541701494587-cb58502866ab?w=600',
            'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=600',
            'https://images.unsplash.com/photo-1535016120720-40c646be5580?w=600',
            'https://images.unsplash.com/photo-1518002172853-08c1f8def5cc?w=600',
            'https://images.unsplash.com/photo-1617137968427-85924c800c6a?w=600',
            'https://images.unsplash.com/photo-1556905055-8f358a7a47b2?w=600',
            'https://images.unsplash.com/photo-1602751584552-8ba73aad9259?w=600',
        ];
        
        $masonryGallery = [];
        $brands = ['Nike', 'Prada', 'Adidas', 'Starbucks', 'Barbershop', 'Dior', 'Versace', 'Gucci'];
        $categories = ['Fashion', 'Luxury', 'Streetwear', 'Editorial', 'Branding', 'Interior'];
        
        for ($i = 1; $i <= 60; $i++) {
            $masonryGallery[] = (object)[
                'image' => $validImages[array_rand($validImages)],
                'title' => 'Project ' . $i,
                'brand' => $brands[array_rand($brands)],
                'category' => $categories[array_rand($categories)],
            ];
        }

        // ============================================
        // SPECIALIZED SOLUTIONS (ED&I, BRAND, MARKETING, PRODUCT)
        // ============================================
        $specializations = [
            (object)['icon' => '🎯', 'title' => 'ED&I Initiatives', 'desc' => 'Inclusive creative strategies that celebrate diversity and representation.'],
            (object)['icon' => '🏷️', 'title' => 'Brand Strategy', 'desc' => 'Data-driven brand positioning and storytelling that resonates.'],
            (object)['icon' => '📈', 'title' => 'Marketing Campaigns', 'desc' => 'Integrated marketing solutions that drive engagement and conversions.'],
            (object)['icon' => '💡', 'title' => 'Product Innovation', 'desc' => 'Creative product development and launch strategies for success.'],
        ];

        // ============================================
        // TESTIMONIALS
        // ============================================
        $testimonials = [
            (object)['content' => 'Diver Entertainment transformed our brand identity. The fashion campaign was pure magic! 45% increase in engagement.', 'name' => 'MICHAEL ROBERTS', 'pos' => 'Marketing Director, Nike', 'avatar' => 'men/1', 'rating' => 5],
            (object)['content' => 'Our barbershop branding went viral! Instagram grew 300% in 3 months. They understood our vintage aesthetic perfectly.', 'name' => 'JAMES WILSON', 'pos' => 'Owner, Barbershop Suites', 'avatar' => 'men/2', 'rating' => 5],
            (object)['content' => 'The visual identity for our coffee shop attracted so many customers. Sales increased 60% after rebranding.', 'name' => 'SOPHIA WIDJAJA', 'pos' => 'Founder, Coffee Society', 'avatar' => 'women/3', 'rating' => 5],
            (object)['content' => 'The cinematic quality of the film was world-class. Their creative vision is unmatched.', 'name' => 'ALESSANDRO MICHELE', 'pos' => 'Creative Director, Gucci', 'avatar' => 'men/4', 'rating' => 5],
            (object)['content' => 'The minimalist aesthetic perfectly represents our brand values. The team understood our vision from day one.', 'name' => 'MARIA SANTOS', 'pos' => 'CEO, Prada', 'avatar' => 'women/6', 'rating' => 5],
            (object)['content' => 'The social media content went viral! We gained over 200k followers in just 2 months.', 'name' => 'DAVID KIM', 'pos' => 'Marketing Manager, Starbucks', 'avatar' => 'men/7', 'rating' => 5],
        ];

        // ============================================
        // ARTICLES
        // ============================================
        $articles = [
            (object)['title' => 'How Cinematic Storytelling Transforms Brand Identity', 'category' => 'BRANDING', 'time' => '5 min', 'image' => 'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=600'],
            (object)['title' => 'The Rise of Minimalist Aesthetic in Modern Advertising', 'category' => 'TRENDS', 'time' => '4 min', 'image' => 'https://images.unsplash.com/photo-1541701494587-cb58502866ab?w=600'],
            (object)['title' => 'Behind the Scenes: Fashion Campaign Production', 'category' => 'PRODUCTION', 'time' => '6 min', 'image' => 'https://images.unsplash.com/photo-1535016120720-40c646be5580?w=600'],
            (object)['title' => 'Social Media Strategy for Barbershops & Cafes', 'category' => 'STRATEGY', 'time' => '7 min', 'image' => 'https://images.unsplash.com/photo-1585747860715-2ba37e788b70?w=600'],
            (object)['title' => 'The Psychology of Color in Branding', 'category' => 'DESIGN', 'time' => '5 min', 'image' => 'https://images.unsplash.com/photo-1542744094-3a31f272c490?w=600'],
            (object)['title' => 'Why Video Content Dominates Social Media', 'category' => 'MARKETING', 'time' => '4 min', 'image' => 'https://images.unsplash.com/photo-1536240474400-9d7b4b6cfbab?w=600'],
            (object)['title' => 'Luxury Branding Trends 2024', 'category' => 'LUXURY', 'time' => '6 min', 'image' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=600'],
            (object)['title' => 'The Art of Street Photography', 'category' => 'PHOTOGRAPHY', 'time' => '5 min', 'image' => 'https://images.unsplash.com/photo-1500462918059-b1a0cb512f1d?w=600'],
        ];

        // ============================================
        // STATISTICS
        // ============================================
        $stats = [
            (object)['number' => 385, 'label' => 'Projects Completed'],
            (object)['number' => 256, 'label' => 'Happy Clients'],
            (object)['number' => 34, 'label' => 'Awards Won'],
            (object)['number' => 12, 'label' => 'Years Experience'],
        ];

        // ============================================
        // PARTNERS
        // ============================================
        $partners = [
            (object)['name' => 'NIKE'],
            (object)['name' => 'ADIDAS'],
            (object)['name' => 'PRADA'],
            (object)['name' => 'GUCCI'],
            (object)['name' => 'STARBUCKS'],
            (object)['name' => 'DIOR'],
        ];

        // Data untuk kompatibilitas
        $featuredWork = $allProjects;
        $recentProjects = array_slice($allProjects, 0, 6);
        $featuredProjects = array_slice($allProjects, 0, 3);
        $galleryPhotos = $masonryGallery;
        $instagramFeed = array_slice($masonryGallery, 0, 12);
        $zoomGallery = array_slice($masonryGallery, 0, 12);
        $abstractGallery = array_slice($masonryGallery, 0, 10);
        $spotlightCreators = [];
        $awards = [];
        $faqs = [];
        $socialFeed = [];
        $categories = [];
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
}