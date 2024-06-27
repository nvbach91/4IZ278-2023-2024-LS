<?php

namespace App\Notifications;

use App\Models\Sitting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SittingRequest extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        protected Sitting $sitting,
    ) {}

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
        return (new MailMessage)
                    ->subject('Žádost o hlídání')
                    ->replyTo($this->sitting->owner->email, $this->sitting->owner->name)
                    ->line("Máte novou žádost o hlídání od uživatele {$this->sitting->owner->name}.")
                    ->line("Termín: Od {$this->sitting->start->isoFormat('LLLL')} do {$this->sitting->end->isoFormat('LLLL')}")
                    ->action('Prohlédnout žádosti o hlídání', route('hlidani.index'))
                    ->line('Žadatele můžete požádat o doplňující informace odesláním odpovědi na tento e-mail.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
