<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profiles.index', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:30', Rule::unique('users')->ignore($user->id)],
        ]);

        try {
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->phone = $validated['phone'] !== null && $validated['phone'] !== ''
                ? $validated['phone']
                : null;

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            $user->save();

            return back()->with('success', 'Profile updated successfully.');
        } catch (Exception $exception) {
            Log::error('Profile update failed', ['error' => $exception->getMessage()]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
