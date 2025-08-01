<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPatient extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    public $patientName;

    /**
     * @var string
     */
    public $confrereName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $patientName, string $confrereName)
    {
        $this->patientName = $patientName;
        $this->confrereName = $confrereName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): NewPatient
    {
        return $this
            ->subject('Nouveau patient | ' . config('app.name'))
            ->view('emails.new-patient');
    }
}
