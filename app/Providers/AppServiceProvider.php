<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage())
                ->subject('Verifica tu cuenta en Ludexis')
                ->view('emails.verify', ['url' => $url]);
        });
        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));

            return (new MailMessage)
                ->subject('Recuperación de contraseña en Ludexis')
                ->view('emails.reset', ['url' => $url]);
        });

        /**
         * Autoriza la acción solo si el usuario no es el autor del propio modelo,
         * previniendo el auto like.
         */
        Gate::define('interact-with-model', function (User $user, Model $model) {
            // El usuario debe estar verificado
            if (!$user->hasVerifiedEmail()) {
                return false;
            }

            // Si el modelo tiene un 'user_id' (es el autor de la reseña/captura), 
            // prohibimos que se dé like a sí mismo.
            if (isset($model->user_id)) {
                return $user->id !== $model->user_id;
            }

            return true;
        });
    }

}