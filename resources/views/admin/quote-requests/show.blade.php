@extends('admin.layouts.app')

@section('title', 'View Quote Request')

@section('header', 'View Quote Request')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('admin.quote-requests.index') }}" class="text-gray-600 hover:text-gray-900">
            <i class="fas fa-arrow-left mr-2"></i> Back to Quote Requests
        </a>
        <div>
            <a href="{{ route('admin.quote-requests.edit', $quoteRequest) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md mr-2">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <form action="{{ route('admin.quote-requests.destroy', $quoteRequest) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md" onclick="return confirm('Are you sure you want to delete this quote request?')">
                    <i class="fas fa-trash mr-2"></i> Delete
                </button>
            </form>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $quoteRequest->name }}</h2>
                    @if($quoteRequest->company)
                        <p class="text-gray-600">{{ $quoteRequest->company }}</p>
                    @endif
                </div>
                <div>
                    @if($quoteRequest->status == 'new')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            New
                        </span>
                    @elseif($quoteRequest->status == 'processing')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Processing
                        </span>
                    @else
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Completed
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Contact Information</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="text-gray-800">{{ $quoteRequest->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Phone</p>
                            <p class="text-gray-800">{{ $quoteRequest->phone }}</p>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Request Details</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Date Submitted</p>
                            <p class="text-gray-800">{{ $quoteRequest->created_at->format('F d, Y \a\t h:i A') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Product</p>
                            <p class="text-gray-800">
                                @if($quoteRequest->product)
                                    <a href="{{ route('admin.products.edit', $quoteRequest->product) }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $quoteRequest->product->name }}
                                    </a>
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Message</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-800 whitespace-pre-line">{{ $quoteRequest->message }}</p>
                </div>
            </div>
            
            <div class="mt-6 border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Update Status</h3>
                <form action="{{ route('admin.quote-requests.update', $quoteRequest) }}" method="POST" class="flex items-center">
                    @csrf
                    @method('PUT')
                    
                    <input type="hidden" name="name" value="{{ $quoteRequest->name }}">
                    <input type="hidden" name="email" value="{{ $quoteRequest->email }}">
                    <input type="hidden" name="phone" value="{{ $quoteRequest->phone }}">
                    <input type="hidden" name="company" value="{{ $quoteRequest->company }}">
                    <input type="hidden" name="message" value="{{ $quoteRequest->message }}">
                    <input type="hidden" name="product_id" value="{{ $quoteRequest->product_id }}">
                    
                    <select name="status" class="border-gray-300 rounded-md shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 mr-2">
                        <option value="new" {{ $quoteRequest->status == 'new' ? 'selected' : '' }}>New</option>
                        <option value="processing" {{ $quoteRequest->status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ $quoteRequest->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    
                    <button type="submit" class="bg-primary-color hover:bg-opacity-90 text-white px-4 py-2 rounded-md">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
