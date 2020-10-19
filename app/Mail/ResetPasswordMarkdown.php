<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMarkdown extends Mailable
{
    use Queueable, SerializesModels;

    public $link;
    public $name;
    public $email;
    public $token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($link, $name, $email,$token)
    {
        $this->link = $link;
        $this->name = $name;
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reset-markdown')
                    ->subject('ساختن رمز جدید')
                    ->to($this->email, $this->name);
    }
}
