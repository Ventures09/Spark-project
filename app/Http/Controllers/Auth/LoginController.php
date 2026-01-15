<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Email is required.',
                'email.email' => 'Please enter a valid email address.',
                'password.required' => 'Password is required.',
            ]
        );

        // Hardcoded credentials
        $validEmail = 'iict2026@gmail.com';
        $validPassword = 'iict12345';

        if ($request->email === $validEmail && $request->password === $validPassword) {

            // Set session
            $request->session()->put('logged_in', true);
            $request->session()->regenerate();

            // ✅ REDIRECT TO DASHBOARD
            return redirect()->route('dashboard.main');
        }

        return back()->withErrors([
            'email' => 'The email or password you entered is incorrect.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('logged_in');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
