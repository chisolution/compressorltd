<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Newsletter;
use App\Models\Product;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productCount = Product::count();
        $categoryCount = Category::count();
        $quoteRequestCount = QuoteRequest::count();
        $contactMessageCount = ContactMessage::count();
        $newsletterCount = Newsletter::where('active', true)->count();

        $recentQuoteRequests = QuoteRequest::with('product')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentContactMessages = ContactMessage::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $unreadMessagesCount = ContactMessage::where('status', 'new')->count();

        return view('admin.dashboard.index', compact(
            'productCount',
            'categoryCount',
            'quoteRequestCount',
            'contactMessageCount',
            'newsletterCount',
            'recentQuoteRequests',
            'recentContactMessages',
            'unreadMessagesCount'
        ));
    }
}
