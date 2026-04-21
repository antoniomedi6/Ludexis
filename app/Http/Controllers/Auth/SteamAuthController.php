<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SteamAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('steam')->redirect();
    }

    public function callback()
    {
        $steamUser = Socialite::driver('steam')->user();

        $user = User::updateOrCreate(
            [
                'provider_name' => 'steam',
                'provider_id' => $steamUser->getId(),
            ],
            [
                'name' => $steamUser->getNickname(),
                'email' => $steamUser->getId() . '@steam.local',
                'password' => bcrypt(Str::random(32)),
                'profile_photo_path' => $steamUser->getAvatar(),
            ]
        );

        /* Marca el email como verificado */
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}