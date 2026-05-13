<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function show($slug)
    {
        return view('projects.detail', ['slug' => $slug]);
    }
}