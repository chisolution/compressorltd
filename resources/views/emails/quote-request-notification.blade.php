@php
use App\Services\CompanyInfoService;
@endphp

@component('mail::message')
@if(CompanyInfoService::logo())
<img src="{{ asset('storage/' . CompanyInfoService::logo()) }}" alt="{{ CompanyInfoService::name() }}" style="max-height: 50px; margin-bottom: 20px;">
@endif

# New Quote Request Received
@if(CompanyInfoService::tagline())
{{ CompanyInfoService::tagline() }}
@endif

**Request Details:**

@component('mail::panel', ['style' => 'background-color: #f9f9f9; border: 1px solid #ddd; padding: 15px;'])
## Customer Information
- **Name:** {{ $quoteRequest['name'] }}
- **Email:** {{ $quoteRequest['email'] }}
- **Phone:** {{ $quoteRequest['phone'] }}
- **Company:** {{ $quoteRequest['company'] ?? 'Not specified' }}

## Quote Details
@if(isset($quoteRequest['product_interest']) && is_array($quoteRequest['product_interest']))
- **Product Interest:** {{ implode(', ', $quoteRequest['product_interest']) }}
@endif
@if(isset($quoteRequest['product_id']) && $quoteRequest['product_id'])
@php
    $product = \App\Models\Product::find($quoteRequest['product_id']);
@endphp
- **Product:** {{ $product?->name ?? 'Product not found' }}
- **Category:** {{ optional($product->category)->name ?? 'N/A' }}
@if($product && $product->price)
- **Listed Price:** {{ config('settings.currency_symbol', 'R') }} {{ number_format($product->price, 2) }}
@endif
@else
- **Product:** Not specified
@endif
- **Quantity:** {{ $quoteRequest['quantity'] ?? 1 }}
@if(isset($quoteRequest['preferred_contact_method']))
- **Preferred Contact:** {{ ucfirst($quoteRequest['preferred_contact_method']) }}
@endif
@if(isset($quoteRequest['timeline']))
- **Timeline:** {{ ucfirst($quoteRequest['timeline']) }}
@endif

## Message
{{ $quoteRequest['message'] }}
@endcomponent

@component('mail::button', ['url' => route('admin.quote-requests.index'), 'color' => 'blue'])
View in Dashboard
@endcomponent

Thank you for using {{ CompanyInfoService::name() }}'s Quote Request System.

Best regards,<br>
{{ CompanyInfoService::name() }}
@if(CompanyInfoService::phone())<br>Tel: {{ CompanyInfoService::phone() }}@endif
@if(CompanyInfoService::email())<br>Email: {{ CompanyInfoService::email() }}@endif
@if(CompanyInfoService::address())<br>{{ CompanyInfoService::address() }}@endif

<small style="color: #718096;">This is an automated message. Please do not reply directly to this email.</small>
@endcomponent
