@extends('layouts.front')

@section('title', 'Write a Review')

@section('content')
<!-- Page Title -->
<section class="relative bg-gradient-to-r from-gray-900 to-gray-700 text-white py-16">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl md:text-5xl font-bold mb-4">Write a Review</h1>
        <p class="text-xl text-gray-300 mb-6">Share your experience with our products and services</p>
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
                        <a href="{{ route('testimonials.index') }}" class="text-gray-300 hover:text-white transition-colors">
                            Testimonials
                        </a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="text-white font-medium">Write Review</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</section>
<!-- End Page Title -->

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 relative" role="alert">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3 text-green-500"></i>
                <span class="block sm:inline">{{ session('success') }}</span>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                    <i class="fas fa-times text-green-500 hover:text-green-700"></i>
                </button>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Share Your Experience</h2>
            <p class="text-gray-600">Your feedback helps us improve and helps other customers make informed decisions.</p>
        </div>

        <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Personal Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="w-full border-2 border-gray-300 rounded-lg shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('name') border-red-500 @enderror"
                           placeholder="Enter your full name">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                           class="w-full border-2 border-gray-300 rounded-lg shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('email') border-red-500 @enderror"
                           placeholder="Enter your email address">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Company (Optional)</label>
                    <input type="text" name="company" id="company" value="{{ old('company') }}"
                           class="w-full border-2 border-gray-300 rounded-lg shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('company') border-red-500 @enderror"
                           placeholder="Enter your company name">
                    @error('company')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="position" class="block text-sm font-medium text-gray-700 mb-2">Position (Optional)</label>
                    <input type="text" name="position" id="position" value="{{ old('position') }}"
                           class="w-full border-2 border-gray-300 rounded-lg shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('position') border-red-500 @enderror"
                           placeholder="Enter your job title">
                    @error('position')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Rating -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Rating *</label>
                <div class="flex items-center space-x-2">
                    <div class="flex items-center" id="rating-stars">
                        @for($i = 1; $i <= 5; $i++)
                            <button type="button" class="rating-star text-2xl text-gray-300 hover:text-yellow-400 transition-colors" data-rating="{{ $i }}">
                                <i class="fas fa-star"></i>
                            </button>
                        @endfor
                    </div>
                    <span id="rating-text" class="text-sm text-gray-600 ml-4">Click to rate</span>
                </div>
                <input type="hidden" name="rating" id="rating-input" value="{{ old('rating', 5) }}">
                @error('rating')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Photo Upload -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Your Photo (Optional)</label>
                <div class="flex items-center justify-center w-full">
                    <label for="image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-3 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-1 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> your photo</p>
                            <p class="text-xs text-gray-500">PNG, JPG or GIF (MAX. 2MB)</p>
                        </div>
                        <input id="image" name="image" type="file" class="hidden" accept="image/*" />
                    </label>
                </div>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Testimonial -->
            <div>
                <label for="testimonial" class="block text-sm font-medium text-gray-700 mb-2">Your Review *</label>
                <textarea name="testimonial" id="testimonial" rows="6" required
                          class="w-full border-2 border-gray-300 rounded-lg shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('testimonial') border-red-500 @enderror"
                          placeholder="Share your experience with our products or services. What did you like? How did we help you? (Minimum 50 characters)">{{ old('testimonial') }}</textarea>
                <p class="text-sm text-gray-500 mt-1">Minimum 50 characters required</p>
                @error('testimonial')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('testimonials.index') }}" 
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-medium transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="bg-primary-color hover:bg-secondary-color text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-paper-plane mr-2"></i>Submit Review
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.rating-star');
    const ratingInput = document.getElementById('rating-input');
    const ratingText = document.getElementById('rating-text');
    
    const ratingTexts = {
        1: 'Poor',
        2: 'Fair', 
        3: 'Good',
        4: 'Very Good',
        5: 'Excellent'
    };
    
    // Set initial rating
    let currentRating = parseInt(ratingInput.value) || 5;
    updateStars(currentRating);
    
    stars.forEach(star => {
        star.addEventListener('click', function() {
            currentRating = parseInt(this.dataset.rating);
            ratingInput.value = currentRating;
            updateStars(currentRating);
        });
        
        star.addEventListener('mouseenter', function() {
            const hoverRating = parseInt(this.dataset.rating);
            updateStars(hoverRating);
        });
    });
    
    document.getElementById('rating-stars').addEventListener('mouseleave', function() {
        updateStars(currentRating);
    });
    
    function updateStars(rating) {
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-300');
            }
        });
        
        ratingText.textContent = ratingTexts[rating] || 'Click to rate';
    }
});
</script>
@endpush
@endsection
