<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function userIndex()
    {
        return view('dashboard.user');
    }
    
    public function creatorIndex()
    {
        return view('dashboard.creator');
    }
    
    public function curatorIndex()
    {
        return view('dashboard.curator');
    }
    public function adminIndex()
    {
        return view('dashboard.user');
    }
}