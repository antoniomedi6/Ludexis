<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        // Forzamos scopes para asegurar email/perfil y evitar usuarios duplicados.
        $provider = Socialite::driver('google');

        return $provider->scopes(['openid', 'profile', 'email'])->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        $providerName = 'google';
        $providerId = (string) $googleUser->getId();
        $email = $googleUser->getEmail() ?: ($providerId . '@google.local');

        // Si ya existe por provider_id, lo usamos.
        // Si no, intentamos enlazar por email para que no de error por la restricción unique en users.email.
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
                'name' => $googleUser->getName() ?: 'Google User',
                'email' => $email,
                'password' => bcrypt(Str::random(32)), // Contraseña aleatoria
                'profile_photo_path' => $googleUser->getAvatar(),
            ]);
        }

        /* Si es la primera vez que entra y no tiene el email verificado, se marca como válido */
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
