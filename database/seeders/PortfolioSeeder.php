<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run()
    {
        $portfolios = [
            [
                'title' => 'Brand Campaign Wardah',
                'slug' => 'brand-campaign-wardah',
                'category' => 'social',
                'label' => 'Social Media',
                'description' => 'Strategi konten Instagram & TikTok untuk meningkatkan brand awareness Wardah di kalangan Gen-Z. Engagement rate naik 320%.',
                'client_name' => 'Wardah Beauty',
                'year' => 2024,
                'results' => ['engagement' => '+320%', 'reach' => '5M+'],
                'order' => 1,
            ],
            [
                'title' => 'E-Commerce Platform Tokopedia Seller',
                'slug' => 'e-commerce-platform-tokopedia-seller',
                'category' => 'web',
                'label' => 'Website Development',
                'description' => 'Pengembangan landing page e-commerce dengan UX modern, integrasi payment gateway, dan optimasi konversi.',
                'client_name' => 'Tokopedia',
                'year' => 2024,
                'results' => ['conversion' => '+45%', 'load_time' => '-60%'],
                'order' => 2,
            ],
            [
                'title' => 'Google Ads Kopi Kenangan',
                'slug' => 'google-ads-kopi-kenangan',
                'category' => 'ads',
                'label' => 'Digital Ads',
                'description' => 'Kampanye Google Ads & Meta Ads untuk meningkatkan app downloads dan store visits. ROAS 4.5x.',
                'client_name' => 'Kopi Kenangan',
                'year' => 2024,
                'results' => ['roas' => '4.5x', 'downloads' => '+250%'],
                'order' => 3,
            ],
            [
                'title' => 'Rebranding Erigo Apparel',
                'slug' => 'rebranding-erigo-apparel',
                'category' => 'brand',
                'label' => 'Visual Branding',
                'description' => 'Redesign identitas visual lengkap termasuk logo, brand guidelines, packaging, dan marketing collateral.',
                'client_name' => 'Erigo',
                'year' => 2023,
                'results' => ['brand_awareness' => '+180%'],
                'order' => 4,
            ],
            [
                'title' => 'Product Video Shoot Skincare',
                'slug' => 'product-video-shoot-skincare',
                'category' => 'video',
                'label' => 'Video Production',
                'description' => 'Produksi video komersial 30 detik untuk kampanye digital dan TV commercial brand skincare lokal.',
                'client_name' => 'Skincare Local',
                'year' => 2024,
                'results' => ['views' => '2M+', 'engagement' => '+280%'],
                'order' => 5,
            ],
            [
                'title' => 'Social Media Management BCA',
                'slug' => 'social-media-management-bca',
                'category' => 'social',
                'label' => 'Social Media',
                'description' => 'Manajemen akun Instagram, Twitter, & LinkedIn Bank BCA. Followers growth 150% dalam 6 bulan.',
                'client_name' => 'Bank BCA',
                'year' => 2024,
                'results' => ['followers' => '+150%', 'engagement' => '+200%'],
                'order' => 6,
            ],
            [
                'title' => 'SEO Optimization PropertyPro',
                'slug' => 'seo-optimization-propertypro',
                'category' => 'seo',
                'label' => 'SEO',
                'description' => 'Optimasi on-page & off-page SEO untuk website properti. Traffic organik naik 400% dalam 8 bulan.',
                'client_name' => 'PropertyPro',
                'year' => 2024,
                'results' => ['traffic' => '+400%', 'keywords' => '50+ top 10'],
                'order' => 7,
            ],
        ];

        foreach ($portfolios as $portfolio) {
            Portfolio::create($portfolio);
        }
    }
}