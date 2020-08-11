<?php

namespace App\Notifications;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AdminEmailConfirmWithCredentials extends Notification
{
    use Queueable;

    protected $password;

    /**
     * AdminEmailConfirmWithCredentials constructor.
     * @param string $password
     */
    public function __construct(string $password)
    {
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                ->subject('Подтверждение регистрации')
                ->greeting('Вы приглашены для управления компанией')
                ->line('Логин - ' . $notifiable->email)
                ->line('Пароль - ' . $this->password)
                ->line('Используйте эти данные для входа в аккаунт.')
                ->line('Пройдите по ссылке чтобы подтвердить регистрацию в системе.')
                ->action('Подтвердить E-mail', route('dashboard.registration.confirm', ['email' => $notifiable->email, 'code' => $notifiable->email_confirmation_code]));
    }
}
