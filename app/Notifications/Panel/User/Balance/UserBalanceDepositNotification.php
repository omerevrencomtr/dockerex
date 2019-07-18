<?php

namespace App\Notifications\Panel\User\Balance;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;


class UserBalanceDepositNotification extends Notification
{
    use Queueable;

    private $user;
    private $currency;
    private $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user=null,$currency,$data)
    {
        $this->user=$user;
        $this->currency=$currency;
        $this->data=$data;
    }

    /*
          $user = User::first();

        $user->notify(new UserBalanceDepositNotification($user));

     public function routeNotificationForSlack() {
        return 'https://hooks.slack.com/services/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';
    }



     */

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the Slack representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return SlackMessage
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->success()
            ->content('Yatırım Talebi')
            ->attachment(function ($attachment) {
                $attachment->title($this->user->getFullNameAttribute(),'https://google.com')
                    ->fields([
                        'Talep' => $this->currency->name,
                        'Tutar' => $this->data->amount,
                        'İşlem kodu' => $this->data->created_at,
                        'Tarih saat' => ':-1:',
                    ]);
            });
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
