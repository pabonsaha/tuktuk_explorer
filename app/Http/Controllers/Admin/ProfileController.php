<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('admin.profile.password-reset');
    }

    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'current_password.current_password' => 'The current password is incorrect.',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update the password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Logout the user
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect to login with success message
        return redirect()->route('login')->with('success', 'Password changed successfully. Please login with your new password.');
    }
}
