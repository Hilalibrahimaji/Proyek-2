<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ContactMessage;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactMessage;

    public function __construct(ContactMessage $contactMessage)
    {
        $this->contactMessage = $contactMessage;
    }

    public function build()
    {
        return $this->subject('New Contact Form Message: ' . $this->contactMessage->subject)
                    ->view('emails.contact-form')
                    ->with([
                        'name' => $this->contactMessage->name,
                        'email' => $this->contactMessage->email,
                        'subject' => $this->contactMessage->subject,
                        'message' => $this->contactMessage->message,
                        'timestamp' => $this->contactMessage->created_at,
                    ]);
    }
}