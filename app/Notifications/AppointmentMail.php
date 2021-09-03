<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AppointmentMail extends Notification
{
    use Queueable;

    private $contact;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $name = $this->contact['name'].' '.$this->contact['lastname'];

        return (new MailMessage)
            ->subject('Velta - Velta "Agendar una Cita"')
            ->from($this->contact['email'], $name)
            ->line('El siguiente usuario se puso en contacto con nosotros, para Agendar una cita personalizada.')
            ->line('La información de contacto es la siguiente:')
            ->line('Nombre: '.$name)
            ->line('Email: '.$this->contact['email'])
            ->line('WhatsApp: '.$this->contact['whatsapp'])
            ->line('Ponte en contacto con el para realizar la Agenda personalizada.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
