<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use App\Models\Like;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    // ============================================
    // PUBLIC METHODS (Untuk tampilan frontend)
    // ============================================
    
    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $project->increment('views');
        
        $relatedProjects = Project::where('category_id', $project->category_id)
            ->where('id', '!=', $project->id)
            ->where('status', 'approved')
            ->take(4)
            ->get();
        
        return view('projects.detail', compact('project', 'relatedProjects'));
    }
    
    // ============================================
    // LIKE / UNLIKE METHODS
    // ============================================
    
    // Like or Unlike a project
    public function like($slug)
    {
        try {
            $project = Project::where('slug', $slug)->firstOrFail();
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'You must be logged in to like'
                ], 401);
            }

            $existingLike = Like::where('user_id', $user->id)
                ->where('project_id', $project->id)
                ->first();

            if (!$existingLike) {
                // Create like
                Like::create([
                    'user_id' => $user->id,
                    'project_id' => $project->id,
                ]);
                $project->increment('likes_count');
                
                return response()->json([
                    'success' => true,
                    'liked' => true,
                    'likes_count' => $project->likes_count
                ]);
            } else {
                // Remove like
                $existingLike->delete();
                $project->decrement('likes_count');
                
                return response()->json([
                    'success' => true,
                    'liked' => false,
                    'likes_count' => $project->likes_count
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // Bookmark a project
    public function bookmark($slug)
    {
        try {
            $project = Project::where('slug', $slug)->firstOrFail();
            $user = Auth::user();

            $existingBookmark = \App\Models\Bookmark::where('user_id', $user->id)
                ->where('project_id', $project->id)
                ->first();

            if (!$existingBookmark) {
                \App\Models\Bookmark::create([
                    'user_id' => $user->id,
                    'project_id' => $project->id,
                ]);
                $project->increment('bookmarks_count');
                
                return response()->json([
                    'success' => true,
                    'bookmarked' => true,
                    'message' => 'Project saved to bookmarks!'
                ]);
            } else {
                $existingBookmark->delete();
                $project->decrement('bookmarks_count');
                
                return response()->json([
                    'success' => true,
                    'bookmarked' => false,
                    'message' => 'Project removed from bookmarks!'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // ============================================
    // CREATOR METHODS (Untuk dashboard creator)
    // ============================================
    
    // Menampilkan daftar project milik creator yang login
    public function myProjects()
    {
        $projects = Project::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('creator.projects.index', compact('projects'));
    }
    
    // Menampilkan form upload project
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.upload', compact('categories'));
    }
    
    // Menyimpan project baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        // Upload thumbnail
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('images/projects');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            
            $file->move($destinationPath, $filename);
            $thumbnailPath = '/images/projects/' . $filename;
        }

        $project = Project::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'description' => $request->description,
            'thumbnail' => $thumbnailPath,
            'status' => 'pending',
            'published_at' => now(),
        ]);

        return redirect()->route('creator.dashboard')
            ->with('success', 'Project berhasil diupload! Menunggu approval dari curator.');
    }
    
    // Menampilkan form edit project
    public function edit($id)
    {
        $project = Project::where('user_id', Auth::id())->findOrFail($id);
        $categories = Category::all();
        return view('dashboard.edit', compact('project', 'categories'));
    }
    
    // Update project
    public function update(Request $request, $id)
    {
        $project = Project::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $data = [
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ];

        if ($request->hasFile('thumbnail')) {
            // Hapus file lama
            if ($project->thumbnail && file_exists(public_path($project->thumbnail))) {
                unlink(public_path($project->thumbnail));
            }
            
            $file = $request->file('thumbnail');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('images/projects');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            
            $file->move($destinationPath, $filename);
            $data['thumbnail'] = '/images/projects/' . $filename;
        }

        $project->update($data);

        return redirect()->route('creator.dashboard')
            ->with('success', 'Project berhasil diupdate!');
    }
    
    // Hapus project
    public function destroy($id)
    {
        $project = Project::where('user_id', Auth::id())->findOrFail($id);
        
        // Hapus file thumbnail
        if ($project->thumbnail && file_exists(public_path($project->thumbnail))) {
            unlink(public_path($project->thumbnail));
        }
        
        // Hapus gallery images
        if ($project->gallery) {
            $gallery = json_decode($project->gallery, true);
            if (is_array($gallery)) {
                foreach ($gallery as $image) {
                    if (file_exists(public_path($image))) {
                        unlink(public_path($image));
                    }
                }
            }
        }
        
        $project->delete();
        
        return redirect()->route('creator.dashboard')
            ->with('success', 'Project has been cancelled and deleted!');
    }
    
    // ============================================
    // CURATOR METHODS
    // ============================================
    
    // Menampilkan project pending
    public function pendingProjects()
    {
        $projects = Project::where('status', 'pending')->get();
        return view('curator.pending', compact('projects'));
    }
    
    // Approve project
    public function approve($id)
    {
        $project = Project::findOrFail($id);
        $project->status = 'approved';
        $project->save();
        
        return redirect()->back()->with('success', 'Project "' . $project->title . '" has been approved!');
    }
    
    // Reject project
    public function reject($id)
    {
        $project = Project::findOrFail($id);
        $project->status = 'rejected';
        $project->save();
        
        return redirect()->back()->with('success', 'Project "' . $project->title . '" has been rejected!');
    }
    
    // Menampilkan featured management
    public function featuredManagement()
    {
        $projects = Project::where('is_featured', 1)->get();
        return view('curator.featured', compact('projects'));
    }
    
    // Make project featured
    public function makeFeatured($id)
    {
        $project = Project::findOrFail($id);
        $project->update(['is_featured' => true]);
        return back()->with('success', 'Project marked as featured!');
    }
    
    // Remove featured
    public function unfeature($id)
    {
        $project = Project::findOrFail($id);
        $project->update(['is_featured' => false]);
        return back()->with('success', 'Project removed from featured!');
    }
    
    // ============================================
    // UPLOAD METHODS (AJAX untuk upload gambar)
    // ============================================
    
    public function uploadThumbnail(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('images/uploads');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            
            $file->move($destinationPath, $filename);
            
            return response()->json([
                'success' => true,
                'path' => '/images/uploads/' . $filename
            ]);
        }
        
        return response()->json(['success' => false], 400);
    }
    
    public function uploadGallery(Request $request)
    {
        // Similar to uploadThumbnail but for multiple images
        return response()->json(['success' => true]);
    }
    
    public function deleteGallery($id)
    {
        // Delete gallery image logic
        return response()->json(['success' => true]);
    }
}