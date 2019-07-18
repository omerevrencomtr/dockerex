<?php

namespace App\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;

class AuthAttemptNotification extends Notification
{
    use Queueable;
    protected $user;
    protected $getClientIp;
    protected $userAgent;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $getClientIp, $userAgent)
    {
        $this->user = $user;
        $this->getClientIp = $getClientIp;
        $this->userAgent = $userAgent;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = 'http://www.ipsorgu.com/ip_numarasindan_adres_bulma.php?ip='.$this->getClientIp;
        return (new MailMessage)
            ->subject('Başarısız giriş denemesi')
            ->line('Merhaba ' . $this->user->name . ' ' . $this->user->surname . ' Koinbo\'ya giriş yapmaya çalıştınız.')
            ->line('Giriş bilgilerinizin hatalı olduğunu tespit ettik ve durumu size bildirmek istedik.')
            ->action('Giriş yapılmak istenilen IP\'adresi:'.$this->getClientIp,$url)
            ->line('Giriş yapılmak istenilen tarayıcı  : ' .  $this->userAgent);
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
