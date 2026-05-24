<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    // Proses Login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            
            // Ambil data user yang baru saja login
            $user = Auth::user();

            // Tentukan link redirect berdasarkan role user
            if ($user->role == 'admin') {
                $redirect = '/admin/dashboard';
            } elseif ($user->role == 'team') {
                $redirect = '/team/dashboard';
            } else {
                $redirect = '/client/dashboard';
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'user' => $user,
                'redirect' => url($redirect) // Menggunakan variabel redirect yang dinamis
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah'
        ], 401);
    }

    // Proses Register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Secara default pendaftar baru diset sebagai 'client'
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'client',
        ]);

        Auth::login($user);

        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil! Selamat datang ' . $user->name,
            'user' => $user,
            'redirect' => url('/client/dashboard')
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil',
            'redirect' => url('/')
        ]);
    }

    // Cek status login
    public function check()
    {
        if (Auth::check()) {
            return response()->json([
                'logged_in' => true,
                'user' => Auth::user()
            ]);
        }

        return response()->json([
            'logged_in' => false
        ]);
    }

    // Google OAuth methods
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('email', $googleUser->getEmail())->first();
            
            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make(uniqid()),
                    'role' => 'client', // Default role jika user baru terdaftar via Google
                ]);
            } else {
                $user->update(['google_id' => $googleUser->getId()]);
            }
            
            Auth::login($user);
            
            // Redirect dinamis untuk login Google
            if ($user->role == 'admin') {
                return redirect()->intent('/admin/dashboard');
            } elseif ($user->role == 'team') {
                return redirect()->intent('/team/dashboard');
            } else {
                return redirect()->intent('/client/dashboard');
            }

        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Google login gagal: ' . $e->getMessage());
        }
    }
}