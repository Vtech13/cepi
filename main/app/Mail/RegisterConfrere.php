<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterConfrere extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): RegisterConfrere
    {
        return $this
            ->subject('Création de compte | ' . config('app.name'))
            ->view('emails.register-confrere');
    }
}
