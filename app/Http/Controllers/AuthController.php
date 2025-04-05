<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // Debug log
        Log::info('Login attempt', ['email' => $credentials['email']]);

        // Attempt login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Log::info('Login successful', ['email' => $credentials['email']]);
            return redirect()->intended('/');
        }

        Log::warning('Login failed', ['email' => $credentials['email']]);
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function createAdminUser()
    {
        // First, check if user already exists
        $existingUser = User::where('email', 'admin@gmail.com')->first();
        if ($existingUser) {
            // Update existing user's password
            $existingUser->update([
                'password' => Hash::make('Test@123')
            ]);
            return "Admin user password updated successfully!";
        }

        // Create new admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Test@123')
        ]);

        return "Admin user created successfully!";
    }
} 