<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SendResetLinkEmail extends Notification
{
    use Queueable;


    public $tries = 10;

    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        return (new MailMessage)
            ->success()
            ->greeting('¡¡ Hola ' . $notifiable->profile->lastname . ' ' . $notifiable->profile->name . '!!')
            ->subject('Velta - Recuperación de Contraseña')
            ->line('Recibimos una solicitud para restablecer tu contraseña. Si no hizo la solicitud, simplemente ignore este correo electrónico. De lo contrario, puedes restablecer tu contraseña usando este enlace:')
            ->action('Click aquí para restaurar tu contraseña', route('password.reset',[$this->token]))
            ->line('Mantén este correo en un lugar seguro, no lo compartas con nadie.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
