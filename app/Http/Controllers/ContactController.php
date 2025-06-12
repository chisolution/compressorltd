<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Display the contact page
     */
    public function index()
    {
        $branches = Branch::active()->sorted()->get();

        return view('contact', compact('branches'));
    }

    /**
     * Store a contact message
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'branch_id' => 'nullable|exists:branches,id',
            'inquiry_type' => 'required|in:general,quote,support,partnership,other'
        ]);

        // Store the contact message
        $contactMessage = ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'subject' => $request->subject,
            'message' => $request->message,
            'branch_id' => $request->branch_id,
            'inquiry_type' => $request->inquiry_type,
            'status' => 'new',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        // Send notification to admin email addresses
        try {
            $emails = \App\Models\SiteSetting::getEmailAddresses('contact_form_emails');
            foreach ($emails as $email) {
                Mail::to($email)->send(new \App\Mail\ContactNotification($contactMessage));
            }
        } catch (\Exception $e) {
            Log::error('Failed to send contact form notification: ' . $e->getMessage());
            // Don't let email failures affect the user experience
        }

        // Return JSON response for AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message! We will get back to you within 24 hours.'
            ]);
        }

        return redirect()->route('contact.index')
            ->with('success', 'Thank you for your message! We will get back to you within 24 hours.');
    }

    /**
     * Get branch details via AJAX
     */
    public function getBranch(Branch $branch)
    {
        return response()->json([
            'name' => $branch->name,
            'address' => $branch->full_address,
            'phone' => $branch->phone,
            'email' => $branch->email,
            'manager_name' => $branch->manager_name,
            'operating_hours' => $branch->formatted_operating_hours
        ]);
    }
}
