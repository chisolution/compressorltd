@component('mail::message')
# Reply to Your Message

Dear {{ $contactMessage->name }},

Thank you for contacting us. Here is our response to your inquiry:

@component('mail::panel')
{{ $replyMessage }}
@endcomponent

**Original Message:**
@component('mail::panel')
Subject: {{ $contactMessage->subject }}
{{ $contactMessage->message }}
@endcomponent

If you have any further questions, please don't hesitate to contact us again.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
