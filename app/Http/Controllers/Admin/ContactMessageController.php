<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Mail\ContactReply;
use App\Mail\ContactNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\SiteSetting;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);
        return view('admin.contact-messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactMessage $contactMessage)
    {
        // Mark as read if it's new
        if ($contactMessage->status === 'new') {
            $contactMessage->update(['status' => 'read']);
        }

        return view('admin.contact-messages.show', ['message' => $contactMessage]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactMessage $contactMessage)
    {
        $request->validate([
            'status' => 'required|in:new,read,replied',
            'reply' => 'required_if:status,replied|string'
        ]);

        $contactMessage->update($request->only('status'));

        // Send notification to admin email addresses
        $emails = SiteSetting::getEmailAddresses('contact_form_emails');
        foreach ($emails as $email) {
            Mail::to($email)->send(new ContactNotification($contactMessage));
        }

        // If replying to the message, send an email to the customer
        if ($request->status === 'replied' && $request->has('reply')) {
            try {
                Mail::to($contactMessage->email)->send(new ContactReply($contactMessage, $request->reply));
            } catch (\Exception $e) {
                Log::error('Failed to send contact reply email: ' . $e->getMessage());
                return redirect()->back()
                    ->with('error', 'Failed to send email. Please check your email configuration.');
            }
        }

        return redirect()->route('admin.contact-messages.show', $contactMessage)
            ->with('success', 'Contact message updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'Contact message deleted successfully.');
    }

    /**
     * Mark multiple messages as read
     */
    public function markAsRead(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:contact_messages,id'
        ]);

        ContactMessage::whereIn('id', $request->ids)->update(['status' => 'read']);

        return redirect()->route('admin.contact-messages.index')
            ->with('success', count($request->ids) . ' messages marked as read.');
    }
}
