<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PasswordChangeController extends Controller
{
    private function profilePasswordUrl(string $fragment = ''): string
    {
        $url = route('admin.profile', ['tab' => 'password']);

        return $fragment !== '' ? $url.$fragment : $url;
    }

    /**
     * Password is edited on the same page as profile (account settings).
     */
    public function passwordChange(): RedirectResponse
    {
        return redirect()->to($this->profilePasswordUrl('#change-password'));
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->to($this->profilePasswordUrl())
                ->withErrors($validator);
        }

        try {
            $user = Auth::user();
            $hashedPassword = $user->password;

            if (! Hash::check($request->current_password, $hashedPassword)) {
                return redirect()->to($this->profilePasswordUrl('#change-password'))
                    ->with('error', 'Current password does not match.');
            }

            if (Hash::check($request->password, $hashedPassword)) {
                return redirect()->to($this->profilePasswordUrl('#change-password'))
                    ->with('warning', 'New password cannot be the same as your current password.');
            }

            $user->update([
                'password' => Hash::make($request->password),
            ]);

            Auth::logout();

            return redirect('/admin/login')->with('success', 'Password changed successfully. Please sign in again.');
        } catch (Exception $exception) {
            Log::error('Password update failed', ['error' => $exception->getMessage()]);

            return redirect()->to($this->profilePasswordUrl('#change-password'))
                ->with('error', 'Something went wrong. Please try again.');
        }
    }
}
