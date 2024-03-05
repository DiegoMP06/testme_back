<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SolicitudAceptada extends Notification
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
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('Tienes un Nuevo Profesor')
        ->greeting('¡Hola!')
        ->line($this->user_nombre . ' <' . $this->user_usuario . '> Acepto tu Solicitud a Unirse a tu Sala "' .  $this->sala_nombre . '"')
        ->action('Administrar Sala', $_ENV['FRONTEND_URL'] . '/dashboard/salas/' . $this->sala_id)
        ->line('¡Gracias Por Usar TestMe!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'sala_id' => $this->sala_id,
            'sala_nombre' => $this->sala_nombre,
            'user_id' => $this->user_id,
            'user_nombre' => $this->user_nombre,
            'user_usuario' => $this->user_usuario,
            'url' => $_ENV['FRONTEND_URL'] . '/dashboard/salas/' . $this->sala_id,
        ];
    }
}
