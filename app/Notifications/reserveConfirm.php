<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;

class reserveConfirm extends Notification
{
    use Queueable;

    protected $reserve;

    /**
     * Create a new notification instance.
     */
    public function __construct($reserve)
    {
        $this->reserve = $reserve;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $startDate = Carbon::parse($this->reserve->start)->format('d/m/Y H:i');
        $endDate   = Carbon::parse($this->reserve->end)->format('d/m/Y H:i');

        return (new MailMessage())
            ->subject('Reserva confirmada')
            ->greeting('Olá!')
            ->line('Sua reserva foi confirmada.')
            ->line('Reserva: ' . $this->reserve->title)
            ->line('Descrição: ' . $this->reserve->description)
            ->line('Local: ' . $this->reserve->rentalItem->name)
            ->line('Início: ' . $startDate)
            ->line('Fim: ' . $endDate)
            ->action('Ver reserva', route('reserves.index'))
            ->line('Obrigado por usar nosso sistema!')
            ->salutation('Atenciosamente, Digiplace.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'reserve_id' => $this->reserve->id,
            'title'      => $this->reserve->title,
        ];
    }
}
