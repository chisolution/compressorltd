@extends('layouts.front')

@section('title', 'Testimonials')

@section('content')
<!-- Page Title -->
<section class="relative bg-gradient-to-r from-gray-900 to-gray-700 text-white py-20">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">Customer Testimonials</h1>
        <p class="text-xl text-gray-300 mb-6">What our valued customers say about us</p>
        <nav class="flex justify-center" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fas fa-home mr-2"></i> Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="text-white font-medium">Testimonials</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</section>
<!-- End Page Title -->

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Featured Testimonials -->
    @if($featuredTestimonials->count() > 0)
        <div class="mb-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Customer Reviews</h2>
                <p class="text-lg text-gray-600">Valubale feedback from our customers</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($featuredTestimonials as $testimonial)
                    <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-primary-color">
                        <div class="flex items-center mb-4">
                            @if($testimonial->image)
                                <img src="{{ asset('storage/' . $testimonial->image) }}" 
                                     alt="{{ $testimonial->name }}" 
                                     class="w-16 h-16 rounded-full object-cover mr-4">
                            @else
                                <div class="w-16 h-16 rounded-full bg-primary-color text-white flex items-center justify-center mr-4 text-xl font-bold">
                                    {{ substr($testimonial->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <h4 class="font-semibold text-gray-800">{{ $testimonial->name }}</h4>
                                @if($testimonial->position && $testimonial->company)
                                    <p class="text-sm text-gray-600">{{ $testimonial->position }} at {{ $testimonial->company }}</p>
                                @elseif($testimonial->company)
                                    <p class="text-sm text-gray-600">{{ $testimonial->company }}</p>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <div class="flex items-center mb-2">
                                {!! $testimonial->rating_stars !!}
                            </div>
                            <p class="text-gray-700 italic">"{{ $testimonial->testimonial }}"</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- All Testimonials -->
    <div class="mb-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">All Customer Reviews</h2>
            <a href="{{ route('testimonials.create') }}" 
               class="bg-primary-color hover:bg-secondary-color text-white px-6 py-3 rounded-md font-medium transition-colors">
                <i class="fas fa-plus mr-2"></i>Write a Review
            </a>
        </div>

        @if($testimonials->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($testimonials as $testimonial)
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                        <div class="flex items-start space-x-4">
                            @if($testimonial->image)
                                <img src="{{ asset('storage/' . $testimonial->image) }}" 
                                     alt="{{ $testimonial->name }}" 
                                     class="w-12 h-12 rounded-full object-cover flex-shrink-0">
                            @else
                                <div class="w-12 h-12 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center flex-shrink-0 font-semibold">
                                    {{ substr($testimonial->name, 0, 1) }}
                                </div>
                            @endif
                            
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="font-semibold text-gray-800">{{ $testimonial->name }}</h4>
                                    @if($testimonial->featured)
                                        <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">
                                            <i class="fas fa-star mr-1"></i>Featured
                                        </span>
                                    @endif
                                </div>
                                
                                @if($testimonial->position && $testimonial->company)
                                    <p class="text-sm text-gray-600 mb-2">{{ $testimonial->position }} at {{ $testimonial->company }}</p>
                                @elseif($testimonial->company)
                                    <p class="text-sm text-gray-600 mb-2">{{ $testimonial->company }}</p>
                                @endif
                                
                                <div class="flex items-center mb-3">
                                    {!! $testimonial->rating_stars !!}
                                </div>
                                
                                <p class="text-gray-700">{{ $testimonial->testimonial }}</p>
                                
                                <div class="mt-3 text-xs text-gray-500">
                                    {{ $testimonial->created_at->format('M d, Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                <div class="bg-white rounded-lg shadow-lg p-4">
                    {{ $testimonials->links() }}
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-lg p-12 text-center">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-comments text-gray-400 text-3xl"></i>
                    </div>
                    
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">No Reviews Yet</h2>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        Be the first to share your experience with our products and services.
                    </p>
                    
                    <a href="{{ route('testimonials.create') }}" 
                       class="bg-primary-color hover:bg-secondary-color text-white px-6 py-3 rounded-md font-medium transition-colors">
                        <i class="fas fa-plus mr-2"></i>Write the First Review
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
