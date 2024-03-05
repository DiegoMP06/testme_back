<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        //

        VerifyEmail::toMailUsing(function (object $notifiable, $url) {
            return (new MailMessage)
                ->subject('Verificar Cuenta')
                ->greeting('¡Hola!')
                ->line('Tu Cuenta ya Casi Esta Lista.')
                ->line('Solo Debes Presionar el Enlace a Continuacion.')
                ->action('Confirmar Cuenta', $_ENV['FRONTEND_URL'] . '/auth/verify-email' . explode('/verify-email', $url)[1])
                ->line('Si No Creaste esta Cuenta Puedes Ignorar el Mensaje.')
                ->line('¡Gracias Por Usar TestMe!');
                ;
        });
    }
}
