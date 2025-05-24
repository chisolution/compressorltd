<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Store a newsletter subscription
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;

        // Check if email already exists
        $existingSubscriber = Newsletter::where('email', $email)->first();

        if ($existingSubscriber) {
            // If inactive, reactivate them
            if (!$existingSubscriber->active) {
                $existingSubscriber->update([
                    'active' => true,
                    'subscribed_at' => now(),
                    'unsubscribed_at' => null
                ]);
            }
            // Always return success message (don't reveal they were already subscribed)
        } else {
            // Create new subscriber
            Newsletter::create([
                'email' => $email,
                'active' => true,
                'subscribed_at' => now()
            ]);
        }

        // Return JSON response for AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for subscribing to our newsletter!',
                'debug' => [
                    'email' => $email,
                    'existing' => $existingSubscriber ? true : false,
                    'was_inactive' => $existingSubscriber && !$existingSubscriber->active ? true : false
                ]
            ]);
        }

        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }

    /**
     * Show unsubscribe confirmation page
     */
    public function unsubscribe($token)
    {
        $subscriber = Newsletter::where('unsubscribe_token', $token)->first();

        if (!$subscriber) {
            abort(404, 'Invalid unsubscribe link.');
        }

        if (!$subscriber->active) {
            return view('newsletters.already-unsubscribed', compact('subscriber'));
        }

        return view('newsletters.unsubscribe', compact('subscriber'));
    }

    /**
     * Process unsubscribe request
     */
    public function processUnsubscribe(Request $request, $token)
    {
        $subscriber = Newsletter::where('unsubscribe_token', $token)->first();

        if (!$subscriber) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid unsubscribe link.'
                ], 404);
            }
            abort(404, 'Invalid unsubscribe link.');
        }

        if ($subscriber->active) {
            $subscriber->unsubscribe();
        }

        // Return JSON response for AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'You have been successfully unsubscribed from our newsletter.',
                'redirect' => route('newsletters.unsubscribe', $token) // Redirect to success page
            ]);
        }

        return view('newsletters.unsubscribed', compact('subscriber'));
    }
}
