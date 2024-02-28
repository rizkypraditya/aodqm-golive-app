<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginGoogleController extends Controller
{
    public function loginWithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();

            $is_user = User::where('email', $user->getEmail())->first();

            if (!$is_user) {
                $save_user = User::updateOrCreate(
                    [
                        'google_id' => $user->getId(),
                    ],
                    [
                        'google_id' => $user->getName(),
                        'email_verified_at' => now(),
                    ]
                );
            } else {
                $save_user = User::where('email', $user->getEmail())->update([
                    'google_id' => $user->getEmail(),
                ]);

                $save_user = User::where('email', $user->getEmail())->first();
            }

            Auth::loginUsingId($save_user->id);

            return to_route('home');
        } catch (Exception $e) {
            return to_route('login')->with('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "akun google tidak terdapat.",
            ]);
        }
    }
}
