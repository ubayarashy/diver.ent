<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        $credentials = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
        ];

        // Attempt to log in
        if (Auth::attempt($credentials)) {
            return redirect()->intended('landing')->with('success',);
        }

        // If login fails, redirect back with error
        return back()
            ->withErrors(['email' => 'The provided credentials do not match our records.'])
            ->onlyInput('email');

    }
    
    public function showRegister()
    {
        return view('auth.register');
    }
    
    public function register(Request $request)
    {
        $validated = $request ->validate([
            'name' =>"required|unique:users,name|max:255",
            'email'=>"required|unique:users,email",
            'password'=>"required|min:8"
        ]);

        $user = User::create([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'password'=>Hash::make($validated['password']),
        ]);

        return view ('auth.login');
    }
    
    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}