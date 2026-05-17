<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Show Login Form
    public function showLogin()
    {
        return view('auth.login');
    }
    
    // Handle Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            
            // Redirect berdasarkan role
            $user = Auth::user();
            
            if ($user->role === 'creator') {
                return redirect()->intended('/creator/dashboard');
            } elseif ($user->role === 'curator' || $user->role === 'admin') {
                return redirect()->intended('/curator/dashboard');
            }
            
            return redirect()->intended('/dashboard');
        }
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    
    // Show Register Form
    public function showRegister()
    {
        return view('auth.register');
    }
    
    // Handle Register
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'in:user,creator',
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'user',
            'avatar' => null,
            'bio' => null,
            'verified' => false,
            'follower_count' => 0,
            'following_count' => 0,
        ]);
        
        Auth::login($user);
        
        if ($user->role === 'creator') {
            return redirect('/creator/dashboard');
        }
        
        return redirect('/dashboard');
    }
    
    // Handle Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    
    // Show Forgot Password Form
    public function showForgot()
    {
        return view('auth.forgot-password');
    }
    
    // Handle Forgot Password
    public function forgot(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $request->validate(['email' => 'required|email']);
 
        $status = Password::sendResetLink(
        $request->only('email')
        );
 
         return $status === Password::ResetLinkSent
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
        
        return back()->with('status', 'We have emailed your password reset link!');
    }

    public function showReset(){
        return view('auth.reset-password');
    }

    public function reset(Request $request, string $token){
        $request->validate([
            'token'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request ->only('email','password','password_confirmation','token'),
            function (User $user , string $password){
                $user->forceFill([
                    'password'=>Hash::make($password);
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user);)
            }
        );

            return $status === Password::PasswordReset
                ? redirect()->route('login')->with('status',__('$status'))
                : back()->withErrors(['email'=>[__($status)]]);
    }
}