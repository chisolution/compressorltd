@php
use App\Services\CompanyInfoService;
@endphp

@component('mail::message')
@if(CompanyInfoService::logo())
<img src="{{ asset('storage/' . CompanyInfoService::logo()) }}" alt="{{ CompanyInfoService::name() }}" style="max-height: 50px; margin-bottom: 20px;">
@endif

# New Contact Message Received
@if(CompanyInfoService::tagline())
{{ CompanyInfoService::tagline() }}
@endif

**Message Details:**

@component('mail::panel', ['style' => 'background-color: #f9f9f9; border: 1px solid #ddd; padding: 15px;'])
## Contact Information
- **Name:** {{ $contactMessage->name }}
- **Email:** {{ $contactMessage->email }}
@if($contactMessage->phone)
- **Phone:** {{ $contactMessage->phone }}
@endif
@if($contactMessage->company)
- **Company:** {{ $contactMessage->company }}
@endif
- **Inquiry Type:** {{ ucfirst($contactMessage->inquiry_type) }}
@if($contactMessage->branch_id)
- **Branch:** {{ optional($contactMessage->branch)->name }}
@endif

## Message Details
**Subject:** {{ $contactMessage->subject }}

**Message:**
{{ $contactMessage->message }}

**Received:** {{ $contactMessage->created_at->format('F j, Y \a\t g:i A') }}
@endcomponent

@component('mail::button', ['url' => route('admin.contact-messages.show', $contactMessage->id), 'color' => 'blue'])
View Full Message
@endcomponent

@if(isset($reply))
## Our Reply:
{{ $reply }}
@endif

Thank you for managing communications at {{ CompanyInfoService::name() }}.

Best regards,<br>
{{ CompanyInfoService::name() }}
@if(CompanyInfoService::phone())<br>Tel: {{ CompanyInfoService::phone() }}@endif
@if(CompanyInfoService::email())<br>Email: {{ CompanyInfoService::email() }}@endif
@if(CompanyInfoService::address())<br>{{ CompanyInfoService::address() }}@endif

<small style="color: #718096;">This is an automated notification. For security, please use the dashboard to respond to messages.</small>
@endcomponent
