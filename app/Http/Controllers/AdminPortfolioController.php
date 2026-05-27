<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AdminPortfolioController extends Controller
{
    /**
     * Display a listing of the portfolio.
     */
    public function index()
    {
        $portfolios = Portfolio::orderBy('order', 'asc')->get();
        return view('admin.portfolio', compact('portfolios'));
    }

    /**
     * Show the form for creating a new portfolio.
     */
    public function create()
    {
        return view('admin.portfolio-create');
    }

    /**
     * Store a newly created portfolio in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:social,web,ads,brand,video,seo',
            'label' => 'required|string|max:100',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'client_name' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:2000|max:' . date('Y'),
            'status' => 'required|in:draft,published',
            'order' => 'nullable|integer',
        ]);

        $portfolio = new Portfolio();
        $portfolio->title = $request->title;
        $portfolio->slug = Str::slug($request->title) . '-' . uniqid();
        $portfolio->category = $request->category;
        $portfolio->label = $request->label;
        $portfolio->description = $request->description;
        $portfolio->client_name = $request->client_name;
        $portfolio->year = $request->year;
        $portfolio->status = $request->status;
        $portfolio->order = $request->order ?? 0;

        if ($request->filled('results')) {
            $portfolio->results = json_decode($request->results, true);
        }

        // Upload Image
        if ($request->hasFile('image')) {
            try {
                $file = $request->file('image');
                $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                $path = $file->storeAs('portfolio', $filename, 'public');
                $portfolio->image = $path;
                Log::info('Image uploaded: ' . $path);
            } catch (\Exception $e) {
                Log::error('Image upload failed: ' . $e->getMessage());
            }
        }

        // Upload Thumbnail
        if ($request->hasFile('thumbnail')) {
            try {
                $file = $request->file('thumbnail');
                $filename = time() . '_thumb_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                $path = $file->storeAs('portfolio/thumbnails', $filename, 'public');
                $portfolio->thumbnail = $path;
                Log::info('Thumbnail uploaded: ' . $path);
            } catch (\Exception $e) {
                Log::error('Thumbnail upload failed: ' . $e->getMessage());
            }
        }

        $portfolio->save();

        // PERBAIKAN: Gunakan route admin.portfolios
        return redirect()->route('admin.portfolios')->with('success', 'Portfolio berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified portfolio.
     */
    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('admin.portfolio-edit', compact('portfolio'));
    }

    /**
     * Update the specified portfolio in storage.
     */
    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:social,web,ads,brand,video,seo',
            'label' => 'required|string|max:100',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'client_name' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:2000|max:' . date('Y'),
            'status' => 'required|in:draft,published',
            'order' => 'nullable|integer',
        ]);

        // Update basic info
        $portfolio->title = $request->title;
        $portfolio->category = $request->category;
        $portfolio->label = $request->label;
        $portfolio->description = $request->description;
        $portfolio->client_name = $request->client_name;
        $portfolio->year = $request->year;
        $portfolio->status = $request->status;
        $portfolio->order = $request->order ?? 0;

        if ($request->filled('results')) {
            $portfolio->results = json_decode($request->results, true);
        }

        // Update Image
        if ($request->hasFile('image')) {
            try {
                if ($portfolio->image && Storage::disk('public')->exists($portfolio->image)) {
                    Storage::disk('public')->delete($portfolio->image);
                    Log::info('Old image deleted: ' . $portfolio->image);
                }
                
                $file = $request->file('image');
                $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                $path = $file->storeAs('portfolio', $filename, 'public');
                $portfolio->image = $path;
                Log::info('Image updated: ' . $path);
            } catch (\Exception $e) {
                Log::error('Image update failed: ' . $e->getMessage());
            }
        }

        // Update Thumbnail
        if ($request->hasFile('thumbnail')) {
            try {
                if ($portfolio->thumbnail && Storage::disk('public')->exists($portfolio->thumbnail)) {
                    Storage::disk('public')->delete($portfolio->thumbnail);
                    Log::info('Old thumbnail deleted: ' . $portfolio->thumbnail);
                }
                
                $file = $request->file('thumbnail');
                $filename = time() . '_thumb_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                $path = $file->storeAs('portfolio/thumbnails', $filename, 'public');
                $portfolio->thumbnail = $path;
                Log::info('Thumbnail updated: ' . $path);
            } catch (\Exception $e) {
                Log::error('Thumbnail update failed: ' . $e->getMessage());
            }
        }

        $portfolio->save();

        // PERBAIKAN: Gunakan route admin.portfolios
        return redirect()->route('admin.portfolios')->with('success', 'Portfolio berhasil diperbarui');
    }

    /**
     * Remove the specified portfolio from storage.
     */
   public function destroy($id)
{
    $portfolio = Portfolio::findOrFail($id);
    
    // Hapus file gambar
    if ($portfolio->image && Storage::disk('public')->exists($portfolio->image)) {
        Storage::disk('public')->delete($portfolio->image);
    }
    if ($portfolio->thumbnail && Storage::disk('public')->exists($portfolio->thumbnail)) {
        Storage::disk('public')->delete($portfolio->thumbnail);
    }
    
    $portfolio->delete();
    
    return response()->json(['success' => true]);
}
    /**
     * Toggle portfolio publish status.
     */
    public function togglePublish($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $portfolio->status = $portfolio->status === 'published' ? 'draft' : 'published';
        $portfolio->save();

        return redirect()->route('admin.portfolios')->with('success', 'Status portfolio berhasil diubah');
    }
}