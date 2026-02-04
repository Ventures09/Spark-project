<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log;

class LoginController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password is required.',
        ]);

        // Hardcoded credentials
        $validEmail = 'iict2026@gmail.com';
        $validPassword = 'iict12345';

        if ($request->email === $validEmail && $request->password === $validPassword) {
            // Set session
            $request->session()->put('logged_in', true);
            $request->session()->regenerate();

            // Log login
            Log::create([
                'action' => 'login',
                'module' => 'Auth',
                'details' => 'User ' . $request->email . ' logged in',
            ]);

            return redirect()->route('dashboard.main');
        }

        return back()->withErrors([
            'email' => 'The email or password you entered is incorrect.',
        ])->onlyInput('email');
    }

    // Handle logout
    public function logout(Request $request)
    {
        if ($request->session()->has('logged_in')) {
            // Log logout
            Log::create([
                'action' => 'logout',
                'module' => 'Auth',
                'details' => 'User logged out',
            ]);
        }

        // Clear session
        $request->session()->forget('logged_in');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
