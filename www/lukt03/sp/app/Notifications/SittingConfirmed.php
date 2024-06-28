<?php

namespace App\Notifications;

use App\Models\Sitting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SittingConfirmed extends Notification
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
                    ->subject('Potvrzení hlídání')
                    ->replyTo($this->sitting->sitter->email, $this->sitting->sitter->name)
                    ->line("Žádost o hlídání od uživatele {$this->sitting->sitter->name} byla potvrzena.")
                    ->line('Pokud ještě s hlídačem nejste v kontaktu, e-mailovou komunikaci můžete zahájit odpovědí na tento e-mail.');
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
