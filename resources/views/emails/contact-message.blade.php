@extends('emails.layouts.main')

@section('content')
    <div class="header">
        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" class="logo">
        <h1>New Contact Message</h1>
    </div>

    <div class="content">
        <div class="panel">
            <div class="info-row">
                <span class="info-label">From:</span> {{ $contactMessage->name }}
            </div>
            <div class="info-row">
                <span class="info-label">Email:</span> {{ $contactMessage->email }}
            </div>
            @if($contactMessage->phone)
            <div class="info-row">
                <span class="info-label">Phone:</span> {{ $contactMessage->phone }}
            </div>
            @endif
            <div class="info-row">
                <span class="info-label">Received:</span> {{ $contactMessage->created_at->format('F j, Y \a\t g:i A') }}
            </div>
        </div>

        <h2>Message Content:</h2>
        <div class="panel">
            {{ $contactMessage->message }}
        </div>

        @if(isset($reply))
        <h2>Our Reply:</h2>
        <div class="panel">
            {{ $reply }}
        </div>
        @endif

        <a href="{{ route('admin.contact-messages.show', $contactMessage->id) }}" class="button">
            View in Dashboard
        </a>
    </div>
@endsection
