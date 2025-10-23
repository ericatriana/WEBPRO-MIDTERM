<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Display the login page
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle login process
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Check if email exists in the database
        $userExists = User::where('email', $credentials['email'])->exists();

        if (!$userExists) {
            return back()->with('error', 'Email is not registered. Please register first.');
        }

        // Attempt to login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Successfully logged in!');
        }

        return back()->with('error', 'Incorrect password. Please try again.');
    }

    // Display the registration page
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle registration process
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create a new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Successfully logged out.');
    }
}
