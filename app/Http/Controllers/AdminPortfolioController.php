<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::orderBy('order', 'asc')->get();
        return view('admin.portfolio', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolio-create');
    }

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

        // Handle results JSON
        if ($request->filled('results')) {
            $portfolio->results = json_decode($request->results, true);
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('portfolio', 'public');
            $portfolio->image = $path;
        }

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('portfolio/thumbnails', 'public');
            $portfolio->thumbnail = $path;
        }

        $portfolio->save();

        return redirect()->route('admin.portfolio')->with('success', 'Portfolio berhasil ditambahkan');
    }

    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('admin.portfolio-edit', compact('portfolio'));
    }

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

        $portfolio->title = $request->title;
        $portfolio->category = $request->category;
        $portfolio->label = $request->label;
        $portfolio->description = $request->description;
        $portfolio->client_name = $request->client_name;
        $portfolio->year = $request->year;
        $portfolio->status = $request->status;
        $portfolio->order = $request->order ?? 0;

        // Handle results JSON
        if ($request->filled('results')) {
            $portfolio->results = json_decode($request->results, true);
        }

        if ($request->hasFile('image')) {
            if ($portfolio->image && file_exists(storage_path('app/public/' . $portfolio->image))) {
                unlink(storage_path('app/public/' . $portfolio->image));
            }
            $path = $request->file('image')->store('portfolio', 'public');
            $portfolio->image = $path;
        }

        if ($request->hasFile('thumbnail')) {
            if ($portfolio->thumbnail && file_exists(storage_path('app/public/' . $portfolio->thumbnail))) {
                unlink(storage_path('app/public/' . $portfolio->thumbnail));
            }
            $path = $request->file('thumbnail')->store('portfolio/thumbnails', 'public');
            $portfolio->thumbnail = $path;
        }

        $portfolio->save();

        return redirect()->route('admin.portfolio')->with('success', 'Portfolio berhasil diperbarui');
    }

    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        
        if ($portfolio->image && file_exists(storage_path('app/public/' . $portfolio->image))) {
            unlink(storage_path('app/public/' . $portfolio->image));
        }
        if ($portfolio->thumbnail && file_exists(storage_path('app/public/' . $portfolio->thumbnail))) {
            unlink(storage_path('app/public/' . $portfolio->thumbnail));
        }
        
        $portfolio->delete();
        
        return response()->json(['success' => true]);
    }
}