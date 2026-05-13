<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreatorController extends Controller
{
    public function directory()
    {
        // ============================================
        // CREATORS DATA - 12+ CREATORS
        // ============================================
        $creators = [
            (object)[
                'id' => 1,
                'name' => 'ALEXANDER CHEN',
                'username' => '@alexchen',
                'role' => 'Visual Artist & Director',
                'avatar' => 'https://randomuser.me/api/portraits/men/15.jpg',
                'cover' => 'https://images.unsplash.com/photo-1539109136881-3be0616acf4b?w=800',
                'followers' => 45200,
                'projects' => 47,
                'rating' => 4.9,
                'verified' => true,
                'location' => 'New York / Paris',
                'bio' => 'Visual artist & director specializing in minimalist aesthetics and luxury fashion campaigns. Worked with Gucci, Nike, and Louis Vuitton.',
                'tags' => ['fashion', 'luxury', 'photography', 'director'],
            ],
            (object)[
                'id' => 2,
                'name' => 'MAYA SARI',
                'username' => '@mayasari',
                'role' => 'Food & Beverage Photographer',
                'avatar' => 'https://randomuser.me/api/portraits/women/22.jpg',
                'cover' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?w=800',
                'followers' => 38700,
                'projects' => 32,
                'rating' => 4.8,
                'verified' => true,
                'location' => 'Bali / Singapore',
                'bio' => 'Food & beverage visual storyteller. Featured in Food & Wine magazine.',
                'tags' => ['food', 'beverage', 'photography', 'lifestyle'],
            ],
            (object)[
                'id' => 3,
                'name' => 'JAMES WILSON',
                'username' => '@jameswilson',
                'role' => 'Brand Strategist',
                'avatar' => 'https://randomuser.me/api/portraits/men/42.jpg',
                'cover' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800',
                'followers' => 52100,
                'projects' => 64,
                'rating' => 5.0,
                'verified' => true,
                'location' => 'London / Tokyo',
                'bio' => 'Brand strategist for lifestyle brands. Ex-Nike creative strategist.',
                'tags' => ['branding', 'strategy', 'marketing', 'consultant'],
            ],
            (object)[
                'id' => 4,
                'name' => 'SOPHIA LEE',
                'username' => '@sophialee',
                'role' => 'Motion Designer',
                'avatar' => 'https://randomuser.me/api/portraits/women/33.jpg',
                'cover' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=800',
                'followers' => 28900,
                'projects' => 41,
                'rating' => 4.7,
                'verified' => false,
                'location' => 'Seoul / LA',
                'bio' => 'Motion designer & animator. Creates viral content for brands.',
                'tags' => ['motion', 'animation', 'design', '3d'],
            ],
            (object)[
                'id' => 5,
                'name' => 'MICHAEL TAN',
                'username' => '@michaeltan',
                'role' => 'Coffee & Cafe Photographer',
                'avatar' => 'https://randomuser.me/api/portraits/men/55.jpg',
                'cover' => 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?w=800',
                'followers' => 9820,
                'projects' => 23,
                'rating' => 4.6,
                'verified' => false,
                'location' => 'Melbourne / Jakarta',
                'bio' => 'Coffee & cafe photographer. Captures the art of brewing.',
                'tags' => ['coffee', 'cafe', 'photography', 'lifestyle'],
            ],
            (object)[
                'id' => 6,
                'name' => 'ISABELLA ROSSI',
                'username' => '@isabellarossi',
                'role' => 'Luxury Brand Storyteller',
                'avatar' => 'https://randomuser.me/api/portraits/women/44.jpg',
                'cover' => 'https://images.unsplash.com/photo-1588092734404-4b8af47e25a0?w=800',
                'followers' => 76800,
                'projects' => 56,
                'rating' => 5.0,
                'verified' => true,
                'location' => 'Milan / Dubai',
                'bio' => 'Luxury brand storyteller. Creates cinematic brand films.',
                'tags' => ['luxury', 'fashion', 'videography', 'cinematic'],
            ],
            (object)[
                'id' => 7,
                'name' => 'ANDI PRATAMA',
                'username' => '@andipratama',
                'role' => 'Creative Director',
                'avatar' => 'https://randomuser.me/api/portraits/men/32.jpg',
                'cover' => 'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=800',
                'followers' => 15600,
                'projects' => 89,
                'rating' => 4.9,
                'verified' => true,
                'location' => 'Medan / Jakarta',
                'bio' => 'Creative director at Diver Entertainment. 15+ years experience.',
                'tags' => ['creative', 'direction', 'branding', 'consulting'],
            ],
            (object)[
                'id' => 8,
                'name' => 'CITRA DEWI',
                'username' => '@citradewi',
                'role' => 'Videographer & Editor',
                'avatar' => 'https://randomuser.me/api/portraits/women/68.jpg',
                'cover' => 'https://images.unsplash.com/photo-1535016120720-40c646be5580?w=800',
                'followers' => 23400,
                'projects' => 38,
                'rating' => 4.8,
                'verified' => true,
                'location' => 'Bali',
                'bio' => 'Cinematic videographer & editor. Award-winning filmmaker.',
                'tags' => ['videography', 'editing', 'travel', 'cinematic'],
            ],
            (object)[
                'id' => 9,
                'name' => 'BUDI SANTOSO',
                'username' => '@budisantoso',
                'role' => 'Street Photographer',
                'avatar' => 'https://randomuser.me/api/portraits/men/45.jpg',
                'cover' => 'https://images.unsplash.com/photo-1500462918059-b1a0cb512f1d?w=800',
                'followers' => 18700,
                'projects' => 45,
                'rating' => 4.7,
                'verified' => false,
                'location' => 'Yogyakarta',
                'bio' => 'Street photographer capturing Indonesian cities.',
                'tags' => ['street', 'photography', 'documentary', 'urban'],
            ],
            (object)[
                'id' => 10,
                'name' => 'DIAN SASTRO',
                'username' => '@diansastro',
                'role' => 'Post-Production Specialist',
                'avatar' => 'https://randomuser.me/api/portraits/women/45.jpg',
                'cover' => 'https://images.unsplash.com/photo-1542744094-3a31f272c490?w=800',
                'followers' => 12400,
                'projects' => 67,
                'rating' => 4.9,
                'verified' => true,
                'location' => 'Surabaya',
                'bio' => 'Post-production wizard. Expert in DaVinci Resolve.',
                'tags' => ['editing', 'post-production', 'color-grading', 'vfx'],
            ],
            (object)[
                'id' => 11,
                'name' => 'EKA GUSTI',
                'username' => '@ekagusti',
                'role' => 'Social Media Strategist',
                'avatar' => 'https://randomuser.me/api/portraits/men/67.jpg',
                'cover' => 'https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?w=800',
                'followers' => 34500,
                'projects' => 52,
                'rating' => 4.8,
                'verified' => true,
                'location' => 'Bandung',
                'bio' => 'Digital strategy expert. Grew brands to 1M+ followers.',
                'tags' => ['social-media', 'strategy', 'marketing', 'content'],
            ],
            (object)[
                'id' => 12,
                'name' => 'FAJAR NUGRAHA',
                'username' => '@fajarnugraha',
                'role' => 'Brand Designer',
                'avatar' => 'https://randomuser.me/api/portraits/men/89.jpg',
                'cover' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=800',
                'followers' => 9800,
                'projects' => 34,
                'rating' => 4.6,
                'verified' => false,
                'location' => 'Medan',
                'bio' => 'Minimalist design enthusiast. Award-winning portfolio.',
                'tags' => ['design', 'branding', 'typography', 'minimalist'],
            ],
        ];

        // Categories for filter
        $categories = [
            (object)['id' => 'all', 'name' => 'All'],
            (object)['id' => 'photography', 'name' => 'Photography'],
            (object)['id' => 'videography', 'name' => 'Videography'],
            (object)['id' => 'design', 'name' => 'Design'],
            (object)['id' => 'branding', 'name' => 'Branding'],
            (object)['id' => 'strategy', 'name' => 'Strategy'],
            (object)['id' => 'luxury', 'name' => 'Luxury'],
        ];

        return view('creators.directory', compact('creators', 'categories'));
    }

    public function profile($id)
    {
        // ============================================
        // CREATOR PROFILE DATA - LENGKAP
        // ============================================
        
        // Data dummy untuk semua creator (id 1-12)
        $creatorsData = [
            1 => [
                'name' => 'ALEXANDER CHEN',
                'username' => '@alexchen',
                'role' => 'Visual Artist & Director',
                'avatar' => 'https://randomuser.me/api/portraits/men/15.jpg',
                'cover' => 'https://images.unsplash.com/photo-1539109136881-3be0616acf4b?w=1600',
                'followers' => 45200,
                'following' => 234,
                'projects' => 47,
                'total_likes' => 128900,
                'rating' => 4.9,
                'verified' => true,
                'location' => 'New York / Paris',
                'email' => 'alex@diver.ent',
                'website' => 'www.alexchen.com',
                'bio' => 'Visual artist & director specializing in minimalist aesthetics and luxury fashion campaigns. With over 8 years of experience in the creative industry, I have worked with brands like Nike, Gucci, and Louis Vuitton. My work focuses on cinematic storytelling and emotional connection through visual media.',
                'social' => [
                    'instagram' => 'https://instagram.com/alexchen',
                    'twitter' => 'https://twitter.com/alexchen',
                    'behance' => 'https://behance.net/alexchen',
                ],
                'featured_projects' => [
                    (object)['title' => 'Nike Air Max Campaign', 'thumbnail' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600', 'likes' => 23400],
                    (object)['title' => 'Gucci Cosmos', 'thumbnail' => 'https://images.unsplash.com/photo-1588092734404-4b8af47e25a0?w=600', 'likes' => 18900],
                    (object)['title' => 'Minimalist Series', 'thumbnail' => 'https://images.unsplash.com/photo-1541701494587-cb58502866ab?w=600', 'likes' => 34200],
                ]
            ],
            2 => [
                'name' => 'MAYA SARI',
                'username' => '@mayasari',
                'role' => 'Food & Beverage Photographer',
                'avatar' => 'https://randomuser.me/api/portraits/women/22.jpg',
                'cover' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?w=1600',
                'followers' => 38700,
                'following' => 189,
                'projects' => 32,
                'total_likes' => 87600,
                'rating' => 4.8,
                'verified' => true,
                'location' => 'Bali / Singapore',
                'email' => 'maya@diver.ent',
                'website' => 'www.mayasari.com',
                'bio' => 'Food & beverage visual storyteller. Featured in Food & Wine magazine. Capturing the essence of culinary experiences through my lens. Based between Bali and Singapore.',
                'social' => [
                    'instagram' => 'https://instagram.com/mayasari',
                    'twitter' => 'https://twitter.com/mayasari',
                ],
                'featured_projects' => [
                    (object)['title' => 'Starbucks Reserve', 'thumbnail' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?w=600', 'likes' => 15600],
                    (object)['title' => 'Coffee Society', 'thumbnail' => 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?w=600', 'likes' => 12300],
                    (object)['title' => 'Brew Lab', 'thumbnail' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=600', 'likes' => 8900],
                ]
            ],
            3 => [
                'name' => 'JAMES WILSON',
                'username' => '@jameswilson',
                'role' => 'Brand Strategist',
                'avatar' => 'https://randomuser.me/api/portraits/men/42.jpg',
                'cover' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=1600',
                'followers' => 52100,
                'following' => 312,
                'projects' => 64,
                'total_likes' => 234500,
                'rating' => 5.0,
                'verified' => true,
                'location' => 'London / Tokyo',
                'email' => 'james@diver.ent',
                'website' => 'www.jameswilson.com',
                'bio' => 'Brand strategist for lifestyle brands. Ex-Nike creative strategist. Helping brands find their voice through strategic creative direction and data-driven insights.',
                'social' => [
                    'instagram' => 'https://instagram.com/jameswilson',
                    'linkedin' => 'https://linkedin.com/in/jameswilson',
                ],
                'featured_projects' => [
                    (object)['title' => 'Nike Brand Strategy', 'thumbnail' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600', 'likes' => 45600],
                    (object)['title' => 'Adidas Campaign', 'thumbnail' => 'https://images.unsplash.com/photo-1518002172853-08c1f8def5cc?w=600', 'likes' => 34200],
                    (object)['title' => 'Prada Rebrand', 'thumbnail' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=600', 'likes' => 28900],
                ]
            ],
        ];

        // Tambahkan data untuk creator lain (id 4-12) dengan default
        for ($i = 4; $i <= 12; $i++) {
            if (!isset($creatorsData[$i])) {
                $creatorsData[$i] = [
                    'name' => 'Creator ' . $i,
                    'username' => '@creator' . $i,
                    'role' => 'Creative Professional',
                    'avatar' => 'https://randomuser.me/api/portraits/' . ($i % 2 == 0 ? 'women' : 'men') . '/' . ($i + 10) . '.jpg',
                    'cover' => 'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=1600',
                    'followers' => 5000 + ($i * 1000),
                    'following' => 100 + ($i * 10),
                    'projects' => 10 + ($i * 2),
                    'total_likes' => 20000 + ($i * 5000),
                    'rating' => 4.5 + ($i * 0.05),
                    'verified' => $i < 7,
                    'location' => 'Various Locations',
                    'email' => 'creator' . $i . '@diver.ent',
                    'website' => 'www.creator' . $i . '.com',
                    'bio' => 'Creative professional with passion for visual storytelling and brand development.',
                    'social' => [
                        'instagram' => 'https://instagram.com/creator' . $i,
                    ],
                    'featured_projects' => [
                        (object)['title' => 'Project Alpha', 'thumbnail' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600', 'likes' => 5000],
                        (object)['title' => 'Project Beta', 'thumbnail' => 'https://images.unsplash.com/photo-1588092734404-4b8af47e25a0?w=600', 'likes' => 4500],
                        (object)['title' => 'Project Gamma', 'thumbnail' => 'https://images.unsplash.com/photo-1541701494587-cb58502866ab?w=600', 'likes' => 3800],
                    ]
                ];
            }
        }

        // Ambil data creator berdasarkan ID
        $creatorData = $creatorsData[$id] ?? $creatorsData[1];
        
        $creator = (object)$creatorData;

        return view('creators.profile', compact('creator'));
    }

    public function follow($id)
    {
        return back()->with('success', 'Now following this creator!');
    }

    public function unfollow($id)
    {
        return back()->with('success', 'Unfollowed creator');
    }
}