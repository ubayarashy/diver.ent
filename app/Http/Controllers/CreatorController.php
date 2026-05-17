<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreatorController extends Controller
{
    // Halaman daftar semua creator
    public function directory()
    {
        // Ambil semua user dengan role 'creator'
        $creators = User::where('role', 'creator')
            ->orderBy('follower_count', 'desc')
            ->get()
            ->map(function($creator) {
                // Hitung jumlah project milik creator ini
                $projectsCount = Project::where('user_id', $creator->id)
                    ->where('status', 'approved')
                    ->count();
                
                // Hitung total likes dari semua project
                $totalLikes = Project::where('user_id', $creator->id)
                    ->where('status', 'approved')
                    ->sum('likes_count');
                
                // Rating
                $rating = $totalLikes > 0 ? round(($totalLikes / 1000) * 5, 1) : 4.5;
                if ($rating > 5) $rating = 5;
                
                return (object)[
                    'id' => $creator->id,
                    'name' => $creator->name,
                    'username' => '@' . strtolower(str_replace(' ', '', $creator->name)),
                    'role' => $this->getRoleTitle($creator->bio),
                    'avatar' => $creator->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($creator->name) . '&background=00D2FF&color=fff&size=100',
                    'followers' => $creator->follower_count,
                    'projects' => $projectsCount,
                    'rating' => $rating,
                    'verified' => $creator->verified ?? false,
                    'location' => $creator->location ?? 'Indonesia',
                    'bio' => $creator->bio ?? 'Creative professional passionate about visual storytelling and brand development.',
                    'tags' => $this->getTagsFromBio($creator->bio),
                    'is_following' => auth()->check() ? auth()->user()->isFollowing($creator->id) : false,
                ];
            });
        
        // Categories untuk filter
        $categories = [
            (object)['id' => 'all', 'name' => 'All'],
            (object)['id' => 'photography', 'name' => 'Photography'],
            (object)['id' => 'videography', 'name' => 'Videography'],
            (object)['id' => 'design', 'name' => 'Design'],
            (object)['id' => 'branding', 'name' => 'Branding'],
            (object)['id' => 'luxury', 'name' => 'Luxury'],
        ];
        
        return view('creators.directory', compact('creators', 'categories'));
    }
    
    // Halaman profile creator berdasarkan ID
    public function profile($id)
    {
        $creator = User::where('role', 'creator')
            ->where('id', $id)
            ->firstOrFail();
        
        // Ambil project milik creator ini
        $creatorProjects = Project::where('user_id', $creator->id)
            ->where('status', 'approved')
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get()
            ->map(function($project) {
                return (object)[
                    'title' => $project->title,
                    'thumbnail' => $project->thumbnail,
                    'likes' => $project->likes_count,
                    'slug' => $project->slug,
                ];
            });
        
        // Hitung statistik
        $projectsCount = Project::where('user_id', $creator->id)
            ->where('status', 'approved')
            ->count();
        
        $totalLikes = Project::where('user_id', $creator->id)
            ->where('status', 'approved')
            ->sum('likes_count');
        
        $rating = $totalLikes > 0 ? round(($totalLikes / 1000) * 5, 1) : 4.5;
        if ($rating > 5) $rating = 5;
        
        // Data untuk view
        $creatorData = (object)[
            'id' => $creator->id,
            'name' => $creator->name,
            'username' => '@' . strtolower(str_replace(' ', '', $creator->name)),
            'role' => $this->getRoleTitle($creator->bio),
            'avatar' => $creator->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($creator->name) . '&background=00D2FF&color=fff&size=150',
            'followers' => $creator->follower_count,
            'following' => $creator->following_count ?? 0,
            'projects' => $projectsCount,
            'total_likes' => $totalLikes,
            'rating' => $rating,
            'verified' => $creator->verified ?? false,
            'location' => $creator->location ?? 'Indonesia',
            'email' => $creator->email,
            'bio' => $creator->bio ?? 'Creative professional passionate about visual storytelling and brand development.',
            'social' => [
                'instagram' => '#',
                'twitter' => '#',
                'behance' => '#',
            ],
            'featured_projects' => $creatorProjects,
            'is_following' => auth()->check() ? auth()->user()->isFollowing($creator->id) : false,
        ];
        
        return view('creators.profile', compact('creatorData', 'creatorProjects'));
    }
    
    // Follow creator - Mengembalikan JSON untuk AJAX
    public function follow($id)
    {
        try {
            $user = auth()->user();
            $creator = User::findOrFail($id);
            
            // Cek apakah sudah follow
            $existingFollow = DB::table('follows')
                ->where('follower_id', $user->id)
                ->where('following_id', $creator->id)
                ->first();
            
            if (!$existingFollow) {
                DB::table('follows')->insert([
                    'follower_id' => $user->id,
                    'following_id' => $creator->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                
                // Update follower count creator
                $creator->follower_count = DB::table('follows')->where('following_id', $creator->id)->count();
                $creator->save();
                
                // Update following count user
                $user->following_count = DB::table('follows')->where('follower_id', $user->id)->count();
                $user->save();
                
                return response()->json([
                    'success' => true,
                    'message' => 'Now following ' . $creator->name,
                    'followers_count' => $creator->follower_count
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Already following this creator'
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // Unfollow creator - Mengembalikan JSON untuk AJAX
    public function unfollow($id)
    {
        try {
            $user = auth()->user();
            $creator = User::findOrFail($id);
            
            DB::table('follows')
                ->where('follower_id', $user->id)
                ->where('following_id', $creator->id)
                ->delete();
            
            // Update follower count creator
            $creator->follower_count = DB::table('follows')->where('following_id', $creator->id)->count();
            $creator->save();
            
            // Update following count user
            $user->following_count = DB::table('follows')->where('follower_id', $user->id)->count();
            $user->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Unfollowed ' . $creator->name,
                'followers_count' => $creator->follower_count
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // Helper: Mendapatkan role title dari bio
    private function getRoleTitle($bio)
    {
        if (strpos($bio, 'photographer') !== false) return 'Photographer';
        if (strpos($bio, 'videographer') !== false) return 'Videographer';
        if (strpos($bio, 'designer') !== false) return 'Designer';
        if (strpos($bio, 'director') !== false) return 'Creative Director';
        if (strpos($bio, 'strategist') !== false) return 'Brand Strategist';
        return 'Creative Professional';
    }
    
    // Helper: Mendapatkan tags dari bio
    private function getTagsFromBio($bio)
    {
        $tags = [];
        if (strpos($bio, 'photographer') !== false) $tags[] = 'photography';
        if (strpos($bio, 'videographer') !== false) $tags[] = 'videography';
        if (strpos($bio, 'designer') !== false) $tags[] = 'design';
        if (strpos($bio, 'branding') !== false) $tags[] = 'branding';
        if (strpos($bio, 'luxury') !== false) $tags[] = 'luxury';
        if (strpos($bio, 'fashion') !== false) $tags[] = 'fashion';
        
        if (empty($tags)) {
            $tags = ['creative', 'professional'];
        }
        
        return $tags;
    }
}