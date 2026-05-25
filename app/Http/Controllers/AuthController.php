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
    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

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

        $credentials = $request->only(
            'email',
            'password'
        );

        if (Auth::attempt($credentials, $request->remember)) {

            $request->session()->regenerate();

            $user = Auth::user();

            /*
            |--------------------------------------------------------------------------
            | REDIRECT BASED ON ROLE
            |--------------------------------------------------------------------------
            */

            if ($user->role === 'admin') {

                $redirect =
                    route('admin.dashboard');

            } elseif ($user->role === 'team') {

                $redirect =
                    route('team.dashboard');

            } else {

                $redirect =
                    route('client.dashboard');
            }

            return response()->json([

                'success' => true,

                'message' => 'Login berhasil',

                'user' => $user,

                'redirect' => $redirect

            ]);

        }

        return response()->json([

            'success' => false,

            'message' => 'Email atau password salah'

        ], 401);
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */

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

        /*
        |--------------------------------------------------------------------------
        | CREATE USER
        |--------------------------------------------------------------------------
        */

        $user = User::create([

            'name' => $request->name,

            'email' => $request->email,

            'password' => Hash::make($request->password),

            'role' => 'client',

        ]);

        Auth::login($user);

        return response()->json([

            'success' => true,

            'message' => 'Registrasi berhasil!',

            'user' => $user,

            'redirect' => route('client.dashboard')

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')
            ->with(
                'success',
                'Berhasil logout'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | CHECK LOGIN
    |--------------------------------------------------------------------------
    */

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

    /*
    |--------------------------------------------------------------------------
    | GOOGLE LOGIN
    |--------------------------------------------------------------------------
    */

    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $googleUser =
                Socialite::driver('google')->user();

            $user = User::where(
                'email',
                $googleUser->getEmail()
            )->first();

            /*
            |--------------------------------------------------------------------------
            | CREATE USER IF NOT EXISTS
            |--------------------------------------------------------------------------
            */

            if (!$user) {

                $user = User::create([

                    'name' => $googleUser->getName(),

                    'email' => $googleUser->getEmail(),

                    'google_id' => $googleUser->getId(),

                    'password' => Hash::make(uniqid()),

                    'role' => 'client',

                ]);

            } else {

                $user->update([

                    'google_id' => $googleUser->getId()

                ]);

            }

            Auth::login($user);

            /*
            |--------------------------------------------------------------------------
            | REDIRECT BY ROLE
            |--------------------------------------------------------------------------
            */

            if ($user->role === 'admin') {

                return redirect()
                    ->route('admin.dashboard');

            } elseif ($user->role === 'team') {

                return redirect()
                    ->route('team.dashboard');
            }

            return redirect()
                ->route('client.dashboard');

        } catch (\Exception $e) {

            return redirect('/')->with(

                'error',

                'Google login gagal'

            );

        }
    }
}