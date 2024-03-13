<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
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
        VerifyEmail::toMailUsing(function(object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Validation de votre email')
                ->line('Cliquez sur le bouton ci-dessous pour valider votre email.')
                ->action('Valider votre email', $url)
                ->line('Si vous n\'avez pas fait cette demande, aucune action n\'est requise.');
        });
    }
}
