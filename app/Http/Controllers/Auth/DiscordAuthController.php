<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class DiscordAuthController extends Controller
{
    public function redirect()
    {
        // Con identify y email tenemos los datos básicos y el avatar.
        $provider = Socialite::driver('discord');

        return $provider->scopes(['identify', 'email'])->redirect();
    }

    public function callback()
    {
        $discordUser = Socialite::driver('discord')->user();

        $providerName = 'discord';
        $providerId = (string) $discordUser->getId();
        $email = $discordUser->getEmail() ?: ($providerId . '@discord.local');

        $user = User::query()
            ->where('provider_name', $providerName)
            ->where('provider_id', $providerId)
            ->first()
            ?? User::query()->where('email', $email)->first();

        if ($user) {
            $user->forceFill([
                'provider_name' => $providerName,
                'provider_id' => $providerId,
            ])->save();
        } else {
            $user = User::create([
                'provider_name' => $providerName,
                'provider_id' => $providerId,
                'name' => $discordUser->getNickname() ?? $discordUser->getName() ?? 'Discord User',
                'email' => $email,
                'password' => bcrypt(Str::random(32)),
                'profile_photo_path' => $discordUser->getAvatar(),
            ]);
        }

        /* Marca el email como verificado si entra por primera vez */
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
