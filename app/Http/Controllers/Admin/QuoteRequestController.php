<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\QuoteRequest;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuoteRequestNotification;

class QuoteRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quoteRequests = QuoteRequest::with('product')->latest()->paginate(10);
        return view('admin.quote-requests.index', compact('quoteRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('status', 'active')->get();
        return view('admin.quote-requests.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'message' => 'required|string',
            'product_id' => 'nullable|exists:products,id',
            'status' => 'required|in:new,processing,completed',
        ]);

        QuoteRequest::create($request->all());

        $emails = SiteSetting::getEmailAddresses('quote_request_emails');
        foreach ($emails as $email) {
            Mail::to($email)->send(new QuoteRequestNotification($request->all()));
        }

        return redirect()->route('admin.quote-requests.index')
            ->with('success', 'Quote request created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(QuoteRequest $quoteRequest)
    {
        return view('admin.quote-requests.show', compact('quoteRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuoteRequest $quoteRequest)
    {
        $products = Product::where('status', 'active')->get();
        return view('admin.quote-requests.edit', compact('quoteRequest', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuoteRequest $quoteRequest)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'message' => 'required|string',
            'product_id' => 'nullable|exists:products,id',
            'status' => 'required|in:new,processing,completed',
        ]);

        $quoteRequest->update($request->all());

        return redirect()->route('admin.quote-requests.index')
            ->with('success', 'Quote request updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuoteRequest $quoteRequest)
    {
        $quoteRequest->delete();

        return redirect()->route('admin.quote-requests.index')
            ->with('success', 'Quote request deleted successfully.');
    }
}
