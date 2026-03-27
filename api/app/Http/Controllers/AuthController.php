<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }

    public function register(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ["nullable", "string", "in:politician"],
        ]);

        // Create the user
        $user = \App\Models\User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Attach app_user role
        $user->assignRole('app_user');

        if (isset($validatedData['role']) && $validatedData['role'] === 'politician') {
            $user->assignRole('politician');
            // Send Telegram notification about new politician registration
            $user->notify(new \App\Notifications\PoliticianRegistered($user->name, $user->id));
        }

        // Log the user in
        Auth::login($user);

        return response()->json(['message' => 'Registered and logged in successfully']);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logged out successfully']);
    }

    public function forgotPassword(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => ['required', 'email'],
            'base_url' => ["required"]
        ]);

        // Send the password reset link
        $status = \Illuminate\Support\Facades\Password::sendResetLink(
            $request->only('email')
        );

        return response()->json(['message' => 'Password reset link sent']);
    }

    public function resetPassword(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Attempt to reset the user's password
        $status = \Illuminate\Support\Facades\Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();

                // Optionally, you can log the user in after resetting the password
                Auth::login($user);
            }
        );

        if ($status == \Illuminate\Support\Facades\Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Password reset successfully']);
        } else {
            return response()->json(['message' => 'Failed to reset password'], 500);
        }
    }
}
