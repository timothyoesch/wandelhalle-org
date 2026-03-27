<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;


class PoliticianRegistered extends Notification
{
    use Queueable;

    public $politician_name = '';
    public $politician_user_id = 0;

    /**
     * Create a new notification instance.
     */
    public function __construct($politician_name, $politician_user_id)
    {
        $this->politician_name = $politician_name;
        $this->politician_user_id = $politician_user_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['telegram'];
    }

    public function toTelegram(object $notifiable): TelegramMessage
    {
        return TelegramMessage::create()
            ->to(env('TELEGRAM_CHAT_ID'))
            ->content("A new politician has registered: {$this->politician_name}. Assign them to their profile: " . route('filament.admin.resources.users.edit', ['record' => $this->politician_user_id]));
    }
}
