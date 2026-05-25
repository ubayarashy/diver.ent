<?php

namespace App\Http\Controllers;

use App\Models\Brief;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollaborationController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // Tampilkan form brief (Ayo Kerjasama)
    public function index()
    {
        return view('client.create-project');
    }

    // Simpan brief
    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'categories' => 'required|array|min:1',
            'categories.*' => 'string|in:Social Media Management,Videography,Fotografi,Digital Ads',
            'budget' => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:2000',
        ]);

        $brief = Brief::create([
            'user_id' => Auth::id(),
            'project_name' => $request->project_name,
            'categories' => $request->categories,
            'budget' => $request->budget,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Brief terkirim! Tim kami akan segera menghubungi Anda.',
            'brief' => $brief
        ]);
    }

    // History brief client
    public function history()
    {
        $briefs = Brief::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('client.my-projects', compact('briefs'));
    }
}