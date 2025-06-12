<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactMessage;
use App\Mail\ContactNotification;

class TestEmail extends Command
{
    protected $signature = 'email:test';
    protected $description = 'Send a test email to verify email configuration';

    public function handle()
    {
        $testMessage = new ContactMessage([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '1234567890',
            'subject' => 'Test Email',
            'message' => 'This is a test message to verify email configuration.',
            'status' => 'new'
        ]);

        try {
            Mail::to('test@example.com')->send(new ContactNotification($testMessage));
            $this->info('Test email sent successfully! Check Mailpit at http://localhost:8025');
        } catch (\Exception $e) {
            $this->error('Failed to send test email: ' . $e->getMessage());
        }
    }
}
