<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UsuarioExpulsado extends Notification
{
    use Queueable;
    public $sala_id;
    public $sala_nombre;
    public $user_id;
    public $user_nombre;
    public $user_usuario;

    /**
     * Create a new notification instance.
     */
    public function __construct($sala_id, $sala_nombre, $user_id, $user_nombre, $user_usuario)
    {
        $this->sala_id = $sala_id;
        $this->sala_nombre = $sala_nombre;
        $this->user_id = $user_id;
        $this->user_nombre = $user_nombre;
        $this->user_usuario = $user_usuario;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Has Sido Expulsado')
            ->greeting('¡Hola ' . $this->user_nombre . '!')
            ->line('El Administrador de la Sala "' .  $this->sala_nombre . '" Te Expulso.')
            ->line('Puedes Ver Las Salas a las que te has unido.')
            ->action('Ver Mis Salas', $_ENV['FRONTEND_URL'] . "/{$this->user_usuario}/salas")
            ->line('¡Gracias Por Usar TestMe!');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'sala_id' => $this->sala_id,
            'sala_nombre' => $this->sala_nombre,
            'user_id' => $this->user_id,
            'user_nombre' => $this->user_nombre,
            'url' => $_ENV['FRONTEND_URL'] . "/{$this->user_usuario}/salas",
        ];
    }
}
