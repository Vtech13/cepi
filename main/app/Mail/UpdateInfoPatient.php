<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdateInfoPatient extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    public $patientName;

    /**
     * @var string
     */
    public $confrereFirstname;

    /**
     * @var string
     */
    public $confrereLastname;

    /**
     * @var string
     */
    public $patientFirstname;

    /**
     * @var string
     */
    public $patientLastname;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $patientLastname, string $patientFirstname, string $confrereLastname, string $confrereFirstname)
    {
        $this->patientLastname = $patientLastname;
        $this->patientFirstname = $patientFirstname;
        $this->confrereLastname = $confrereLastname;
        $this->confrereFirstname = $confrereFirstname;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): UpdateInfoPatient
    {
        return $this
            ->subject('Nouvelle information patient | ' . config('app.name'))
            ->view('emails.update-info-patient');
    }
}
