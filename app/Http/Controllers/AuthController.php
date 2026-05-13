<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        // Login logic here
    }
    
    public function showRegister()
    {
        return view('auth.register');
    }
    
    public function register(Request $request)
    {
        // Register logic here
    }
    
    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}