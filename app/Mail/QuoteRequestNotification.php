<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuoteRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $quoteRequest;

    /**
     * Create a new message instance.
     */
    public function __construct(array $quoteRequest)
    {
        $this->quoteRequest = $quoteRequest;
    }

    /**
     * Build the message.
     */    public function build()
    {
        $companyName = \App\Services\CompanyInfoService::name();
        return $this->subject("New Quote Request - {$companyName}")
            ->markdown('emails.quote-request-notification', ['quoteRequest' => $this->quoteRequest])
            ->from(config('mail.from.address'), $companyName);
    }
}
