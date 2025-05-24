<?php

namespace App\Console\Commands;

use App\Models\Newsletter;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateNewsletterTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:generate-tokens';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate unsubscribe tokens for existing newsletter subscribers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating unsubscribe tokens for existing newsletter subscribers...');

        $subscribers = Newsletter::whereNull('unsubscribe_token')->get();

        if ($subscribers->isEmpty()) {
            $this->info('No subscribers found without unsubscribe tokens.');
            return;
        }

        $count = 0;
        foreach ($subscribers as $subscriber) {
            $subscriber->update([
                'unsubscribe_token' => Str::random(64)
            ]);
            $count++;
        }

        $this->info("Successfully generated unsubscribe tokens for {$count} subscribers.");
    }
}
