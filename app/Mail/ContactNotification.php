<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $contactMessage;
    public $reply;

    /**
     * Create a new message instance.
     */
    public function __construct(ContactMessage $contactMessage, $reply = null)
    {
        $this->contactMessage = $contactMessage;
        $this->reply = $reply;
    }

    /**
     * Build the message.
     */    public function build()
    {
        $companyName = \App\Services\CompanyInfoService::name();
        return $this->subject("New Contact Form Submission - {$companyName}")
            ->markdown('emails.contact-notification')
            ->from(config('mail.from.address'), $companyName);
    }
}
