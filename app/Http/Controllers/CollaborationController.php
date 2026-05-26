<?php

namespace App\Http\Controllers;

use App\Models\Brief;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CollaborationController extends Controller
{
    public function index()
    {
        return view('client.create-project');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|string|max:255',
            'categories' => 'required|array|min:1',
            'categories.*' => 'string|in:Social Media Management,Videography,Fotografi,Digital Ads',
            'budget' => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:2000',
            'timeline' => 'nullable|string|max:255',
            'reference_link' => 'nullable|url',
            'phone' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $brief = Brief::create([
            'user_id' => Auth::id(),
            'project_name' => $request->project_name,
            'categories' => $request->categories,
            'description' => $request->description,
            'timeline' => $request->timeline,
            'budget' => $request->budget,
            'reference_link' => $request->reference_link,
            'phone' => $request->phone,
            'status' => 'pending',
        ]);

        $divisiMap = [
            'Social Media Management' => 'smm',
            'Digital Ads' => 'digital_ads',
            'Fotografi' => 'photography',
            'Videography' => 'videography',
        ];

        foreach ($request->categories as $category) {
            Task::create([
                'brief_id' => $brief->id,
                'title' => $brief->project_name . ' - ' . $category,
                'description' => $brief->description,
                'status' => 'pending',
                'divisi' => $divisiMap[$category] ?? null,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Brief terkirim! Tim kami akan segera menghubungi Anda.',
            'brief' => $brief,
        ]);
    }
}

