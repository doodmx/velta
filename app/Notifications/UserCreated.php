<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCreated extends Notification implements ShouldQueue
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
            ->bcc(['mariana.villagomez@azellft.com','gpichardo@azell.co'])
            ->success()
            ->greeting('¡¡ Hola ' . $notifiable->profile->lastname . ' ' . $notifiable->profile->name . '!!')
            ->subject('AzellFT - Nuevo Partner')
            ->line('Te damos la bienvenida a AzellFT la forma más segura e inteligente de invertir. Esperamos disfrutes de tu capacitación.')
            ->line('Correo Electrónico: ' . $notifiable->email)
            ->line('Contraseña: ' . $this->plainPassword)
            ->action('Iniciar Sesión', route('login'))
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
