@extends('layouts.front')

@section('title', '404 - Page Not Found')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 text-center">
        <div>
            <div class="mx-auto h-32 w-32 text-red-500">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
            </div>
            <h1 class="mt-6 text-6xl font-bold text-gray-900">404</h1>
            <h2 class="mt-2 text-3xl font-bold text-gray-900">Page Not Found</h2>
            <p class="mt-2 text-sm text-gray-600">
                Sorry, we couldn't find the page you're looking for.
            </p>
        </div>

        <div class="mt-8 space-y-4">
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}"
                   class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                    <svg class="-ml-1 mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Go Home
                </a>

                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                    <svg class="-ml-1 mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    Browse Products
                </a>
            </div>

            <div class="text-sm text-gray-500">
                <p>Or try one of these popular pages:</p>
                <div class="mt-2 space-x-4">
                    <a href="{{ route('about.index') }}" class="text-red-600 hover:text-red-500">About Us</a>
                    <a href="{{ route('contact.index') }}" class="text-red-600 hover:text-red-500">Contact</a>
                    <a href="{{ route('blog.index') }}" class="text-red-600 hover:text-red-500">Blog</a>
                </div>
            </div>
        </div>

        <div class="mt-8 text-xs text-gray-400">
            <p>Error Code: 404 | {{ config('app.name') }}</p>
        </div>
    </div>
</div>
@endsection
