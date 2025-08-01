<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var \App\Models\Admincms\Contact
     */
    private $contact;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Admincms\Contact $contact
     */
    public function __construct(\App\Models\Admincms\Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this
            ->to(config('app.email_send_to'), strtolower(config('app.name')))
            ->subject('demande de contact - dr pauline pagbe')
            ->view('emails.contact')
            ->text('emails.contact_text')
            ->with([
                'data' => $this->contact
            ]);

        if (!empty($this->contact->file)) {
            $this->attachFromStorage($this->contact->file);
        }
        if (!empty($this->contact->file_pano_dentaire)) {
            $this->attachFromStorage($this->contact->file_pano_dentaire);
        }

        return $this;
    }
}
