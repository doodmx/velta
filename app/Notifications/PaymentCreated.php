<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentCreated extends Notification
{
    use Queueable;


    public $payment;
    private $pdfInvoice;
    private $subject;
    private $bcc;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($payment, $pdfInvoice)
    {

        $this->payment = $payment;
        $this->pdfInvoice = $pdfInvoice;
        $this->subject = __('cart.subject');
        $this->bcc = [];

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

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function setBcc($bcc)
    {
        $this->bcc = $bcc;
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
            ->subject($this->subject)
            ->bcc($this->bcc)
            ->attach($this->pdfInvoice)
            ->markdown('emails.payments.paid', ['payment' => $this->payment]);
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
