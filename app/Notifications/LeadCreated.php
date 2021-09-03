<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LeadCreated extends Notification implements ShouldQueue
{
    public $tries = 10;
    use Queueable;

    private $name, $phone, $email;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name, $phone, $email)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
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
            ->greeting('¡¡ Hola Ventas Azell !!')
            ->subject('AzellFT - Nuevo Contacto de Partner')
            ->line('Hay un contacto interesado en formar parte de AzellFT a continuación te mostramos sus datos:')
            ->line('Nombre: ' . $this->name)
            ->line('Teléfono: ' . $this->phone)
            ->line('Correo Electrónico: ' . $this->email)
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
