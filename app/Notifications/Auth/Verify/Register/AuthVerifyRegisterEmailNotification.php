<?php

namespace App\Notifications\Auth\Verify\Register;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Channels\IletiMerkeziSmsChannel;
use App\User;

class AuthVerifyRegisterEmailNotification extends Notification
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
        return ['mail'];
    }

    /**
     * Get the voice representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return toIletiMerkeziSms
     */
    public function toIletiMerkeziSms($notifiable)
    {
        $key=$this->key;
        $user=$this->user;
        return $key.' Sayın '.$user->name.' '.$user->surname.' '.config('app.name').' için doğrulama kodunuz. Kayıt SMS';
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
            ->subject('E-posta\'nızı doğrulayın')
            ->line('<b>Son bir adım kaldı!</b>')
            ->line('Sayın ' . $this->user->name . ' ' . $this->user->surname)
            ->line('Üyelik kaydınız tamamlanmak üzere.')
            ->line('Lütfen aşağıdaki bağlantıyı kullanarak e-posta adresinizi onaylayınız.')
            ->action('Doğrula', route('auth.register.verify.email',['userId'=>$this->user->id,'verificationCode'=>$this->key]));
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
