@extends('layouts.front')

@section('title', 'Unsubscribe from Newsletter')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8">
        <div class="text-center mb-8">
            <div class="mx-auto w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-exclamation-triangle text-yellow-600 text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Unsubscribe from Newsletter</h1>
            <p class="text-gray-600">We're sorry to see you go!</p>
        </div>

        <div class="bg-gray-50 rounded-lg p-6 mb-6">
            <div class="flex items-center mb-4">
                <i class="fas fa-envelope text-gray-400 mr-3"></i>
                <span class="text-gray-700 font-medium">{{ $subscriber->email }}</span>
            </div>
            <p class="text-sm text-gray-600">
                You subscribed to our newsletter on {{ $subscriber->subscribed_at->format('F j, Y') }}.
            </p>
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Are you sure you want to unsubscribe?</h3>
            <p class="text-gray-600 text-sm mb-4">
                By unsubscribing, you'll no longer receive:
            </p>
            <ul class="text-sm text-gray-600 space-y-2 mb-4">
                <li class="flex items-center">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    Latest product updates and announcements
                </li>
                <li class="flex items-center">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    Exclusive offers and promotions
                </li>
                <li class="flex items-center">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    Industry insights and blog posts
                </li>
                <li class="flex items-center">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    Company news and updates
                </li>
            </ul>
        </div>

        <form id="unsubscribe-form" action="{{ route('newsletters.process-unsubscribe', $subscriber->unsubscribe_token) }}" method="POST" class="space-y-4">
            @csrf

            <div id="unsubscribe-message" class="hidden"></div>

            <div class="flex flex-col space-y-3">
                <button type="submit" id="unsubscribe-btn"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200">
                    <i class="fas fa-times mr-2"></i>
                    Yes, Unsubscribe Me
                </button>

                <a href="{{ route('home') }}"
                   class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-4 rounded-lg text-center transition-colors duration-200 inline-block">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Keep My Subscription
                </a>
            </div>
        </form>

        <div class="mt-8 pt-6 border-t border-gray-200">
            <p class="text-xs text-gray-500 text-center">
                Having trouble? Contact us at
                <a href="mailto:{{ $siteSettings['contact_email'] ?? 'info@compressor.com' }}"
                   class="text-primary-color hover:underline">
                    {{ $siteSettings['contact_email'] ?? 'info@compressor.com' }}
                </a>
            </p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Ensure AJAX functionality is available for unsubscribe form
    document.addEventListener('DOMContentLoaded', function() {
        // The AJAX functionality is already handled in the main layout
        // This is just to ensure the form is properly initialized
        console.log('Unsubscribe page loaded with AJAX support');
    });
</script>
@endpush
