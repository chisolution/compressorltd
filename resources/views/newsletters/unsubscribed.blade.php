@extends('layouts.front')

@section('title', 'Successfully Unsubscribed')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8">
        <div class="text-center mb-8">
            <div class="mx-auto w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-check text-green-600 text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Successfully Unsubscribed</h1>
            <p class="text-gray-600">You have been removed from our newsletter.</p>
        </div>

        <div class="bg-gray-50 rounded-lg p-6 mb-6">
            <div class="flex items-center mb-4">
                <i class="fas fa-envelope text-gray-400 mr-3"></i>
                <span class="text-gray-700 font-medium">{{ $subscriber->email }}</span>
            </div>
            <p class="text-sm text-gray-600">
                Unsubscribed on {{ $subscriber->unsubscribed_at->format('F j, Y \a\t g:i A') }}
            </p>
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">What happens next?</h3>
            <ul class="text-sm text-gray-600 space-y-2">
                <li class="flex items-start">
                    <i class="fas fa-info-circle text-blue-500 mr-2 mt-0.5"></i>
                    <span>You will no longer receive newsletter emails from us</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-clock text-blue-500 mr-2 mt-0.5"></i>
                    <span>It may take up to 24 hours for the change to take effect</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-shield-alt text-blue-500 mr-2 mt-0.5"></i>
                    <span>Your email address has been securely removed from our mailing list</span>
                </li>
            </ul>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <h4 class="font-semibold text-blue-900 mb-2">Changed your mind?</h4>
            <p class="text-sm text-blue-800 mb-3">
                You can always subscribe again by visiting our website and entering your email address in any newsletter signup form.
            </p>
            <a href="{{ route('home') }}" 
               class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 font-medium">
                <i class="fas fa-home mr-2"></i>
                Visit Our Website
            </a>
        </div>

        <div class="space-y-3">
            <a href="{{ route('home') }}" 
               class="w-full bg-primary-color hover:bg-secondary-color text-white font-medium py-3 px-4 rounded-lg text-center transition-colors duration-200 inline-block">
                <i class="fas fa-home mr-2"></i>
                Return to Homepage
            </a>
            
            <a href="{{ route('contact.index') }}" 
               class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-4 rounded-lg text-center transition-colors duration-200 inline-block">
                <i class="fas fa-envelope mr-2"></i>
                Contact Us
            </a>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-200">
            <p class="text-xs text-gray-500 text-center">
                We're sorry to see you go. If you have any feedback about our newsletter, please 
                <a href="{{ route('contact.index') }}" class="text-primary-color hover:underline">let us know</a>.
            </p>
        </div>
    </div>
</div>
@endsection
