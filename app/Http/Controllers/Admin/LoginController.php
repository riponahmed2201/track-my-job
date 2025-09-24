<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Exception;

class LoginController extends Controller
{
    public function showLoginForm(): View
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        try {
            // Attempt login using Laravel's built-in authentication
            if (Auth::attempt($request->validated(), $request->boolean('remember'))) {
                // Regenerate session to prevent fixation attacks
                $request->session()->regenerate();

                // Redirect to the dashboard
                return redirect()->intended(route('admin.dashboard'))->with('success', 'Login successful');
            }

            return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
        } catch (Exception $exception) {
            // Log the exception and show a generic error message
            logger()->error('Login error: ' . $exception->getMessage());
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        // Log out the user
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token to prevent session fixation attacks
        $request->session()->regenerateToken();

        // Redirect to the login page or home page
        return redirect('/admin/login')->with('success', 'You have been logged out successfully.');
    }
}
