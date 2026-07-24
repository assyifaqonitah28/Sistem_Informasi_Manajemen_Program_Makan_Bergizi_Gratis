<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    /**
     * Redirect ke Google
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle callback dari Google
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->getId())
                        ->orWhere('email', $googleUser->getEmail())
                        ->first();

            if ($user) {
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->getId()]);
                }

                if ($user->status !== 'active') {
                    return redirect()->route('login')->withErrors(['email' => 'Akun Anda tidak aktif.']);
                }

                Auth::login($user, true);
                return redirect()->intended('/dashboard');
            } else {
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make(Str::random(24)),
                    'status' => 'active',
                    'email_verified_at' => now(),
                ]);

                $newUser->assignRole('user');

                Auth::login($newUser, true);
                return redirect()->intended('/dashboard');
            }

        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Gagal login dengan Google. Silakan coba lagi.']);
        }
    }
}
