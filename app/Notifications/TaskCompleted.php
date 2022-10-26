<?php

namespace App\Notifications;

use App\Models\Product;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Orchid\Platform\Notifications\DashboardChannel;
use Orchid\Platform\Notifications\DashboardMessage;

class TaskCompleted extends Notification
{
    use Queueable;

    private $msgData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($msgData)
    {
        $this->msgData = $msgData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [ 'mail', DashboardChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line($this->msgData['body'])
            ->action($this->msgData['msgText'], $this->msgData['msgUrl'])
            ->line($this->msgData['thanks']);
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
            'msg_id' => $this->msgData['msg_id']
        ];
    }

    public function toDashboard($notifiable)
    {
        return (new DashboardMessage)
            ->title('Hello')
            ->message($this->msgData['body'])
            ->action($this->msgData['msgUrl']);
    }
}
