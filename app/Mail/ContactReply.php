<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReply extends Mailable
{
    use Queueable, SerializesModels;

    public $contactMessage;
    public $replyMessage;

    /**
     * Create a new message instance.
     */
    public function __construct(ContactMessage $contactMessage, string $replyMessage)
    {
        $this->contactMessage = $contactMessage;
        $this->replyMessage = $replyMessage;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $fromAddress = config('mail.from.address');
        $fromName = config('mail.from.name');

        return $this->from($fromAddress, $fromName)
            ->subject('Re: ' . $this->contactMessage->subject)
            ->markdown('emails.contact-reply');
    }
}
