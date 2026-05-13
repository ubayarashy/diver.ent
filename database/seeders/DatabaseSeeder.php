<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama
        DB::table('users')->truncate();
        
        // Insert users dengan jumlah kolom yang sama persis
        DB::table('users')->insert([
            [
                'name' => 'Admin Diver',
                'email' => 'admin@diver.com',
                'password' => Hash::make('password'),
                'avatar' => 'https://randomuser.me/api/portraits/men/1.jpg',
                'bio' => 'Creative Director at Diver Entertainment',
                'role' => 'curator',
                'verified' => 1,
                'follower_count' => 0,
                'following_count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'John Photographer',
                'email' => 'john@diver.com',
                'password' => Hash::make('password'),
                'avatar' => 'https://randomuser.me/api/portraits/men/2.jpg',
                'bio' => 'Professional photographer based in Medan',
                'role' => 'creator',
                'verified' => 1,
                'follower_count' => 1250,
                'following_count' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sarah Videographer',
                'email' => 'sarah@diver.com',
                'password' => Hash::make('password'),
                'avatar' => 'https://randomuser.me/api/portraits/women/1.jpg',
                'bio' => 'Cinematic videographer & storyteller',
                'role' => 'creator',
                'verified' => 1,
                'follower_count' => 890,
                'following_count' => 95,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mike Designer',
                'email' => 'mike@diver.com',
                'password' => Hash::make('password'),
                'avatar' => 'https://randomuser.me/api/portraits/men/3.jpg',
                'bio' => 'Brand designer & creative strategist',
                'role' => 'creator',
                'verified' => 1,
                'follower_count' => 2100,
                'following_count' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@diver.com',
                'password' => Hash::make('password'),
                'avatar' => null,
                'bio' => null,
                'role' => 'user',
                'verified' => 1,
                'follower_count' => 0,
                'following_count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
        $this->command->info('✅ Users seeded successfully!');
    }
}