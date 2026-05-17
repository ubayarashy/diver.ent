<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // ============================================
    // USER DASHBOARD
    // ============================================
    public function userIndex()
    {
        $user = Auth::user();
        
        $likedProjects = Project::whereHas('likes', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->take(6)->get();
        
        $followingCreators = User::whereHas('followers', function($query) use ($user) {
            $query->where('follower_id', $user->id);
        })->take(6)->get();
        
        return view('dashboard.user', compact('user', 'likedProjects', 'followingCreators'));
    }
    
    // Edit Profile untuk SEMUA USER (User biasa)
    public function editProfile()
    {
        $user = Auth::user();
        return view('dashboard.edit-profile', compact('user'));
    }
    
    // Update Profile untuk SEMUA USER (User biasa)
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $user->name = $request->name;
        $user->bio = $request->bio;
        
        if ($request->hasFile('avatar')) {
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }
            
            $file = $request->file('avatar');
            $filename = time() . '_avatar_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('images/avatars');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            
            $file->move($destinationPath, $filename);
            $user->avatar = '/images/avatars/' . $filename;
        }
        
        $user->save();
        
        return redirect()->route('dashboard.user')->with('success', 'Profile updated successfully!');
    }
    
    // Hapus Avatar untuk User
    public function deleteAvatar()
    {
        $user = Auth::user();
        
        if ($user->avatar && file_exists(public_path($user->avatar))) {
            unlink(public_path($user->avatar));
        }
        
        $user->avatar = null;
        $user->save();
        
        return back()->with('success', 'Avatar deleted!');
    }
    
    // ============================================
    // CREATOR DASHBOARD
    // ============================================
    public function creatorIndex()
    {
        $user = Auth::user();
        
        $projects = Project::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        $totalProjects = $projects->count();
        $totalViews = $projects->sum('views');
        $totalLikes = $projects->sum('likes_count');
        $followersCount = $user->followers()->count();
        $engagementRate = $totalViews > 0 ? round(($totalLikes / $totalViews) * 100, 1) : 0;
        $profileVisits = 1234;
        
        return view('dashboard.creator', compact(
            'user', 'projects', 'totalProjects', 'totalViews', 
            'totalLikes', 'followersCount', 'engagementRate', 'profileVisits'
        ));
    }
    
    // Edit Profile untuk CREATOR
    public function editCreatorProfile()
    {
        $user = Auth::user();
        return view('dashboard.edit-profile', compact('user'));
    }
    
    // Update Profile untuk CREATOR
    public function updateCreatorProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
            'location' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $user->name = $request->name;
        $user->bio = $request->bio;
        $user->location = $request->location;
        
        if ($request->hasFile('avatar')) {
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }
            
            $file = $request->file('avatar');
            $filename = time() . '_avatar_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('images/avatars');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            
            $file->move($destinationPath, $filename);
            $user->avatar = '/images/avatars/' . $filename;
        }
        
        $user->save();
        
        return redirect()->route('creator.dashboard')->with('success', 'Profile updated successfully!');
    }
    
    // Hapus Avatar untuk Creator
    public function deleteCreatorAvatar()
    {
        $user = Auth::user();
        
        if ($user->avatar && file_exists(public_path($user->avatar))) {
            unlink(public_path($user->avatar));
        }
        
        $user->avatar = null;
        $user->save();
        
        return back()->with('success', 'Avatar deleted!');
    }
    
    // ============================================
    // CURATOR DASHBOARD
    // ============================================
  // Curator Dashboard - Menampilkan project pending dari database
public function curatorIndex()
{
    // Ambil semua project dengan status 'pending'
    $pendingProjects = Project::where('status', 'pending')
        ->with('user') // Eager loading relasi user (creator)
        ->orderBy('created_at', 'desc')
        ->get();
    
    $pendingCount = $pendingProjects->count();
    $featuredCount = Project::where('is_featured', 1)->count();
    $totalProjects = Project::count();
    
    return view('dashboard.curator', compact(
        'pendingProjects', 
        'pendingCount', 
        'featuredCount', 
        'totalProjects'
    ));
}
}