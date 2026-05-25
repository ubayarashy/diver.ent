<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        // Ambil semua portfolio yang statusnya published, urutkan berdasarkan order
        $portfolios = Portfolio::where('status', 'published')
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Ambil kategori unik untuk filter
        $categories = $portfolios->groupBy('category')->keys();
        
        return view('portfolio', compact('portfolios', 'categories'));
    }

    public function show($slug)
    {
        $portfolio = Portfolio::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
        
        $related = Portfolio::where('status', 'published')
            ->where('category', $portfolio->category)
            ->where('id', '!=', $portfolio->id)
            ->limit(3)
            ->get();
        
        return view('portfolio-detail', compact('portfolio', 'related'));
    }
}