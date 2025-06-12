@extends('emails.layouts.main')

@section('content')
    <div class="header">
        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" class="logo">
        <h1>New Quote Request</h1>
    </div>

    <div class="content">
        <div class="panel">
            <h2>Customer Information</h2>
            <div class="info-row">
                <span class="info-label">Name:</span> {{ $quoteRequest['name'] }}
            </div>
            @if($quoteRequest['company'])
            <div class="info-row">
                <span class="info-label">Company:</span> {{ $quoteRequest['company'] }}
            </div>
            @endif
            <div class="info-row">
                <span class="info-label">Email:</span> {{ $quoteRequest['email'] }}
            </div>
            <div class="info-row">
                <span class="info-label">Phone:</span> {{ $quoteRequest['phone'] }}
            </div>
        </div>

        @if(isset($quoteRequest['product_id']) && $quoteRequest['product_id'])
        <div class="panel">
            <h2>Product Interest</h2>
            @php
                $product = \App\Models\Product::find($quoteRequest['product_id']);
            @endphp
            <div class="info-row">
                <span class="info-label">Product:</span> {{ $product ? $product->name : 'Product not found' }}
            </div>
            <div class="info-row">
                <span class="info-label">Quantity:</span> {{ $quoteRequest['quantity'] ?? 1 }}
            </div>
            @if($product && $product->primary_image)
            <div style="margin-top: 15px;">
                <img src="{{ asset('storage/' . $product->primary_image) }}" 
                     alt="{{ $product->name }}" 
                     style="max-width: 200px; border-radius: 4px;">
            </div>
            @endif
        </div>
        @endif

        <div class="panel">
            <h2>Message</h2>
            {{ $quoteRequest['message'] }}
        </div>

        <a href="{{ route('admin.quote-requests.index') }}" class="button">
            View in Dashboard
        </a>
    </div>
@endsection
