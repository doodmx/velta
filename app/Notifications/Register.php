<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class Register extends Notification
{
    use Queueable;


    public $tries = 10;

    public $plainPassword;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($plainPassword)
    {
        $this->plainPassword = $plainPassword;
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
            ->subject('Velta - Registro')
            ->line(' Bienvenido a tu plataforma inteligente de inversión, mantente informado en tiempo real del rendimiento de tu inversión, descarga la aplicación e inicia sesión ahora.')
            ->line('Email: ' . $notifiable->email)
            ->line('Contraseña: ' . $this->plainPassword)
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
