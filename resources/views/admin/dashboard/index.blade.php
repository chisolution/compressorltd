@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('header', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
                    <i class="fas fa-box text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Products</h3>
                    <p class="text-3xl font-bold">{{ $productCount }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.products.index') }}" class="text-blue-500 hover:text-blue-700">
                    View all products <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                    <i class="fas fa-folder text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Categories</h3>
                    <p class="text-3xl font-bold">{{ $categoryCount }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.categories.index') }}" class="text-green-500 hover:text-green-700">
                    View all categories <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-500 mr-4">
                    <i class="fas fa-quote-left text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Quote Requests</h3>
                    <p class="text-3xl font-bold">{{ $quoteRequestCount }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.quote-requests.index') }}" class="text-yellow-500 hover:text-yellow-700">
                    View all requests <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-500 mr-4">
                    <i class="fas fa-envelope text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Messages</h3>
                    <p class="text-3xl font-bold">{{ $contactMessageCount }}</p>
                    @if($unreadMessagesCount > 0)
                        <span class="ml-2 px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">{{ $unreadMessagesCount }} new</span>
                    @endif
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.contact-messages.index') }}" class="text-purple-500 hover:text-purple-700">
                    View all messages <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-indigo-100 text-indigo-500 mr-4">
                    <i class="fas fa-paper-plane text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Newsletter</h3>
                    <p class="text-3xl font-bold">{{ $newsletterCount }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.newsletters.index') }}" class="text-indigo-500 hover:text-indigo-700">
                    View subscribers <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">Recent Quote Requests</h2>

        @if($recentQuoteRequests->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-left">Name</th>
                            <th class="py-2 px-4 border-b text-left">Email</th>
                            <th class="py-2 px-4 border-b text-left">Product</th>
                            <th class="py-2 px-4 border-b text-left">Status</th>
                            <th class="py-2 px-4 border-b text-left">Date</th>
                            <th class="py-2 px-4 border-b text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentQuoteRequests as $request)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $request->name }}</td>
                                <td class="py-2 px-4 border-b">{{ $request->email }}</td>
                                <td class="py-2 px-4 border-b">
                                    @if($request->product)
                                        {{ $request->product->name }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b">
                                    @if($request->status == 'new')
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">New</span>
                                    @elseif($request->status == 'processing')
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Processing</span>
                                    @else
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Completed</span>
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b">{{ $request->created_at->format('M d, Y') }}</td>
                                <td class="py-2 px-4 border-b">
                                    <a href="{{ route('admin.quote-requests.show', $request) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <a href="{{ route('admin.quote-requests.index') }}" class="text-blue-500 hover:text-blue-700">
                    View all quote requests <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        @else
            <p class="text-gray-500">No quote requests yet.</p>
        @endif
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 mt-6">
        <h2 class="text-xl font-semibold mb-4">Recent Contact Messages</h2>

        @if($recentContactMessages->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-left">Name</th>
                            <th class="py-2 px-4 border-b text-left">Email</th>
                            <th class="py-2 px-4 border-b text-left">Subject</th>
                            <th class="py-2 px-4 border-b text-left">Status</th>
                            <th class="py-2 px-4 border-b text-left">Date</th>
                            <th class="py-2 px-4 border-b text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentContactMessages as $message)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $message->name }}</td>
                                <td class="py-2 px-4 border-b">{{ $message->email }}</td>
                                <td class="py-2 px-4 border-b">{{ $message->subject ?? 'N/A' }}</td>
                                <td class="py-2 px-4 border-b">
                                    @if($message->status == 'new')
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">New</span>
                                    @elseif($message->status == 'read')
                                        <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">Read</span>
                                    @else
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Replied</span>
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b">{{ $message->created_at->format('M d, Y') }}</td>
                                <td class="py-2 px-4 border-b">
                                    <a href="{{ route('admin.contact-messages.show', $message) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <a href="{{ route('admin.contact-messages.index') }}" class="text-blue-500 hover:text-blue-700">
                    View all messages <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        @else
            <p class="text-gray-500">No contact messages yet.</p>
        @endif
    </div>
@endsection
