<?php

namespace App\Notifications\Dashboard\Balance\Verify;

use App\Channels\NetGsmVoiceChannel;
use App\Http\Controllers\Service\ServiceController;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DashboardBalanceVerifyPhoneCallNotification extends Notification
{

    use Queueable;

    protected $user;

    protected $key;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $key)
    {
        $this->user = $user;
        $this->key  = $key;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return [NetGsmVoiceChannel::class];
    }

    /**
     * Get the voice representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return toNetGsmVoice
     */
    public function toNetGsmVoice($notifiable)
    {
        $key    = $this->key;
        $fileId = ServiceController::voiceKey($key);

        return $fileId;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
