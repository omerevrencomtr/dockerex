<?php

namespace App\Notifications\Auth\Verify\Register;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Channels\NetGsmSmsChannel;
use App\User;

class AuthVerifyRegisterPhoneSmsNotification extends Notification
{
    use Queueable;
    protected $user;
    protected $key;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user,$key)
    {
        $this->user = $user;
        $this->key = $key;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [NetGsmSmsChannel::class];
    }

    /**
     * Get the voice representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return toNetGsmSms
     */
    public function toNetGsmSms($notifiable)
    {
        $key=$this->key;
        $user=$this->user;
        return __('register.sms_message', ['Name' => $user->name,'Surname' => $user->surname,'key' => $key]);
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
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
