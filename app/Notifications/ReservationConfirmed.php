<?php

namespace App\Notifications;

use App\Models\Reserve;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationConfirmed extends Notification
{
    use Queueable;

    protected $reserve;

    public function __construct(Reserve $reserve)
    {
        $this->reserve = $reserve;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject('Reserva Confirmada')
            ->line('Sua reserva foi confirmada.')
            ->action('Ver Reserva', url('/reserves/' . $this->reserve->id))
            ->line('Obrigado por usar nosso sistema!');
    }

    public function toArray($notifiable)
    {
        return [
            'reserve_id' => $this->reserve->id,
            'status'     => 'confirmed',
        ];
    }
}
