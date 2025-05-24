@extends('layouts.front')

@section('title', 'Already Unsubscribed')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8">
        <div class="text-center mb-8">
            <div class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-info-circle text-gray-600 text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Already Unsubscribed</h1>
            <p class="text-gray-600">This email address is not subscribed to our newsletter.</p>
        </div>

        <div class="bg-gray-50 rounded-lg p-6 mb-6">
            <div class="flex items-center mb-4">
                <i class="fas fa-envelope text-gray-400 mr-3"></i>
                <span class="text-gray-700 font-medium">{{ $subscriber->email }}</span>
            </div>
            @if($subscriber->unsubscribed_at)
                <p class="text-sm text-gray-600">
                    Previously unsubscribed on {{ $subscriber->unsubscribed_at->format('F j, Y \a\t g:i A') }}
                </p>
            @else
                <p class="text-sm text-gray-600">
                    This email address is not currently subscribed to our newsletter.
                </p>
            @endif
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Want to subscribe again?</h3>
            <p class="text-gray-600 text-sm mb-4">
                You can easily resubscribe to our newsletter to receive:
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

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <h4 class="font-semibold text-blue-900 mb-2">Resubscribe Now</h4>
            <p class="text-sm text-blue-800 mb-3">
                Visit our website and enter your email address in any newsletter signup form to start receiving our updates again.
            </p>
        </div>

        <div class="space-y-3">
            <a href="{{ route('home') }}" 
               class="w-full bg-primary-color hover:bg-secondary-color text-white font-medium py-3 px-4 rounded-lg text-center transition-colors duration-200 inline-block">
                <i class="fas fa-home mr-2"></i>
                Visit Our Website
            </a>
            
            <a href="{{ route('blog.index') }}" 
               class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-4 rounded-lg text-center transition-colors duration-200 inline-block">
                <i class="fas fa-blog mr-2"></i>
                Read Our Blog
            </a>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-200">
            <p class="text-xs text-gray-500 text-center">
                Questions? Contact us at 
                <a href="mailto:{{ $siteSettings['contact_email'] ?? 'info@compressor.com' }}" 
                   class="text-primary-color hover:underline">
                    {{ $siteSettings['contact_email'] ?? 'info@compressor.com' }}
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
