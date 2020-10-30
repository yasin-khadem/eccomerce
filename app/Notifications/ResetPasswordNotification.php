<?php

namespace App\Notifications;

use App\Mail\ResetPassword;
use App\Mail\ResetPasswordMarkdown;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Message;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;
    public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token,$user)
    {
        $this->token = $token;
        $this->user = $user;
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
        $ressetPasswordUrl = config('frontend.reset_password_url') . "?token={$this->token}";
      
        Mail::send(new ResetPasswordMarkdown($ressetPasswordUrl, $this->user->name,$this->user->email,$this->token));
        dump('sending email');
        return response(['ok'],200);
       
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
            
        ];
    }
}
