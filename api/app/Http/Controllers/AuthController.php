<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validate the incoming request
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // 3. CRITICAL: Regenerate the session to prevent session fixation attacks
            $request->session()->regenerate();

            return response()->json(['message' => 'Logged in successfully']);
        }

        // 4. If authentication fails, return a 422 error
        return response()->json([
            'message' => 'The provided credentials do not match our records.'
        ], 422);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
