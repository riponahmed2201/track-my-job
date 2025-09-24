<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PasswordChangeController extends Controller
{
    public function passwordChange(): View
    {
        $profile = User::with('profile')->where('id', Auth::id())->first();

        return view('admin.auth.password-change', compact('profile'));
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        try {
            $user = Auth::user();

            $hashedPassword = $user->password;

            if (Hash::check($request->current_password, $hashedPassword)) {
                if (!Hash::check($request->password, $hashedPassword)) {
                    $user->update([
                        'password' => Hash::make($request->password)
                    ]);
                    Auth::logout();
                    notify()->success('Password was changed successfully.', 'Success');
                    return redirect('/admin/login');
                } else {
                    notify()->warning('New password can not be same as old password.', 'Warning');
                }
            } else {
                notify()->error('Current password not match.', 'Error');
            }

            return back();
        } catch (Exception $exception) {
            Log::error("Password update failed", ['error' => $exception->getMessage()]);
            notify()->error("Something went wrong! Please try again.", "Error");
            return back();
        }
    }
}
