<?php

namespace App\Notifications\Dashboard\Balance\Verify;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Channels\NetGsmSmsChannel;
use App\User;

class DashboardBalanceVerifyPhoneSmsNotification extends Notification
{
    use Queueable;
    protected $user;
    protected $key;
    protected $amount;
    protected $address;
    protected $currency;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $key, $amount,$address,$currency)
    {
        $this->user = $user;
        $this->key = $key;
        $this->amount = $amount;
        $this->address = $address;
        $this->currency = $currency;
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
     * @param  mixed $notifiable
     * @return toNetGsmSms
     */
    public function toNetGsmSms($notifiable)
    {
        $key = $this->key;
        $amount = $this->amount;
        $user = $this->user;
        $address=$this->address;
        $currency=$this->currency;

        return __('withdraw.sms_message', ['Name' => $user->name, 'Surname' => $user->surname, 'key' => $key, 'amount' => $amount, 'address' => $address,'currency' => $currency]);
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
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
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
