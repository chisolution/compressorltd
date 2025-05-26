@extends('layouts.front')

@section('title', $product->name)

@section('content')
<!-- Page Title -->
<section class="relative bg-gradient-to-r from-gray-900 to-gray-700 text-white py-16">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-5xl font-bold mb-4">{{ $product->name }}</h1>
            @if($product->category)
                <p class="text-xl text-gray-300">{{ $product->category->name }}</p>
            @endif
        </div>

        <!-- Breadcrumbs -->
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
                        <a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white transition-colors">
                            Products
                        </a>
                    </div>
                </li>
                @if($product->category)
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="text-gray-300 hover:text-white transition-colors">
                                {{ $product->category->name }}
                            </a>
                        </div>
                    </li>
                @endif
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="text-white font-medium">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</section>
<!-- End Page Title -->

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
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

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6">
            <!-- Product Images -->
            <div>
                <div class="mb-4">
                    <img id="main-image" src="{{ asset('storage/' . $product->primary_image) }}" alt="{{ $product->name }}"
                         class="w-full h-96 object-contain rounded-lg border border-gray-200">
                </div>

                @if($product->gallery && $product->gallery->count() > 0)
                    <div class="grid grid-cols-5 gap-2">
                        <div class="cursor-pointer hover:opacity-75 border-2 {{ !request('image') ? 'border-primary-color' : 'border-transparent' }}"
                             onclick="changeImage('{{ asset('storage/' . $product->primary_image) }}', this)">
                            <img src="{{ asset('storage/' . $product->primary_image) }}" alt="{{ $product->name }}"
                                 class="w-full h-20 object-cover rounded">
                        </div>

                        @foreach($product->gallery as $image)
                            <div class="cursor-pointer hover:opacity-75 border-2 {{ request('image') == $image->id ? 'border-primary-color' : 'border-transparent' }}"
                                 onclick="changeImage('{{ asset('storage/' . $image->image_path) }}', this)">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->name }}"
                                     class="w-full h-20 object-cover rounded">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>

                @if($product->category)
                    <div class="mb-4">
                        <span class="bg-gray-100 text-gray-800 text-sm font-medium px-3 py-1 rounded-full">
                            {{ $product->category->name }}
                        </span>
                    </div>
                @endif

                <div class="prose max-w-none mb-6">
                    <p>{{ $product->short_description }}</p>
                </div>

                <div class="border-t border-gray-200 pt-6 mb-6">
                    <button onclick="openProductQuoteModal()" class="bg-primary-color hover:bg-secondary-color text-white px-8 py-3 rounded-md font-medium text-lg w-full md:w-auto transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <i class="fas fa-envelope mr-2"></i>Inquire Now
                    </button>
                </div>
            </div>
        </div>

        <!-- Product Tabs -->
        <div class="border-t border-gray-200">
            <div x-data="{ activeTab: 'description' }">
                <div class="flex border-b border-gray-200">
                    <button @click="activeTab = 'description'"
                            :class="{ 'border-b-2 border-primary-color text-primary-color': activeTab === 'description' }"
                            class="px-6 py-3 text-gray-700 font-medium hover:text-primary-color">
                        Description
                    </button>

                    @if($product->specifications)
                        <button @click="activeTab = 'specifications'"
                                :class="{ 'border-b-2 border-primary-color text-primary-color': activeTab === 'specifications' }"
                                class="px-6 py-3 text-gray-700 font-medium hover:text-primary-color">
                            Specifications
                        </button>
                    @endif

                    @if($product->additional_information)
                        <button @click="activeTab = 'additional'"
                                :class="{ 'border-b-2 border-primary-color text-primary-color': activeTab === 'additional' }"
                                class="px-6 py-3 text-gray-700 font-medium hover:text-primary-color">
                            Additional Information
                        </button>
                    @endif
                </div>

                <div class="p-6">
                    <div x-show="activeTab === 'description'" class="prose max-w-none">
                        {!! $product->long_description !!}
                    </div>

                    @if($product->specifications)
                        <div x-show="activeTab === 'specifications'" class="prose max-w-none">
                            {!! $product->specifications !!}
                        </div>
                    @endif

                    @if($product->additional_information)
                        <div x-show="activeTab === 'additional'" class="prose max-w-none">
                            {!! $product->additional_information !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Related Products</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-lg hover:-translate-y-1">
                        <a href="{{ route('products.show', $relatedProduct->slug) }}" class="block">
                            <img src="{{ asset('storage/' . $relatedProduct->primary_image) }}" alt="{{ $relatedProduct->name }}"
                                 class="w-full h-48 object-cover">

                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $relatedProduct->name }}</h3>

                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {{ $relatedProduct->short_description }}
                                </p>

                                <div class="flex justify-end">
                                    <button class="bg-primary-color hover:bg-opacity-90 text-white px-4 py-2 rounded-md text-sm">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

<!-- Quote Request Modal -->
<div id="quoteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-2xl p-8 w-full max-w-2xl mx-4 max-h-screen overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-gray-800">Request Quote</h3>
            <button onclick="closeProductQuoteModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- AJAX Message Container -->
        <div id="quote-message" class="hidden mb-6"></div>

        <form id="quote-form" action="{{ route('quote-requests.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Hidden product field -->
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <!-- Product Info Display -->
            <div class="bg-gray-50 rounded-lg p-4 border">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('storage/' . $product->primary_image) }}" alt="{{ $product->name }}"
                         class="w-16 h-16 object-cover rounded-lg">
                    <div>
                        <h4 class="font-semibold text-gray-800">{{ $product->name }}</h4>
                        <p class="text-sm text-gray-600">{{ $product->category->name ?? 'Uncategorized' }}</p>
                    </div>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                    <input type="text" name="name" id="name" required
                           class="w-full border-2 border-gray-300 rounded-lg shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 transition-all"
                           placeholder="Enter your full name">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                    <input type="email" name="email" id="email" required
                           class="w-full border-2 border-gray-300 rounded-lg shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 transition-all"
                           placeholder="Enter your email address">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input type="tel" name="phone" id="phone" required
                           class="w-full border-2 border-gray-300 rounded-lg shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 transition-all"
                           placeholder="Enter your phone number">
                </div>

                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Company</label>
                    <input type="text" name="company" id="company"
                           class="w-full border-2 border-gray-300 rounded-lg shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 transition-all"
                           placeholder="Enter your company name">
                </div>
            </div>

            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                <input type="number" name="quantity" id="quantity" min="1" value="1"
                       class="w-full border-2 border-gray-300 rounded-lg shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 transition-all"
                       placeholder="Enter quantity needed">
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                <textarea name="message" id="message" rows="5" required
                          class="w-full border-2 border-gray-300 rounded-lg shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 transition-all"
                          placeholder="Hi there, Can I get a quote for {{ $product->name }}?">Hi there, Can I get a quote for {{ $product->name }}?</textarea>
            </div>

            <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                <button type="button" onclick="closeProductQuoteModal()"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-medium transition-colors">
                    Cancel
                </button>
                <button type="submit" id="quote-submit-btn"
                        class="bg-primary-color hover:bg-secondary-color text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-paper-plane mr-2"></i>Send Quote Request
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize quote form AJAX
        initQuoteForm();
    });

    function changeImage(src, element) {
        document.getElementById('main-image').src = src;

        // Remove border from all thumbnails
        document.querySelectorAll('.grid-cols-5 > div').forEach(el => {
            el.classList.remove('border-primary-color');
            el.classList.add('border-transparent');
        });

        // Add border to selected thumbnail
        element.classList.remove('border-transparent');
        element.classList.add('border-primary-color');
    }

    function openProductQuoteModal() {
        document.getElementById('quoteModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }

    function closeProductQuoteModal() {
        document.getElementById('quoteModal').classList.add('hidden');
        document.body.style.overflow = 'auto'; // Restore scrolling

        // Clear any messages and form errors when closing
        const messageDiv = document.getElementById('quote-message');
        const form = document.getElementById('quote-form');
        if (messageDiv) messageDiv.className = 'hidden';
        if (form) clearQuoteFormErrors(form);
    }

    // Quote Form AJAX Handler
    function initQuoteForm() {
        const quoteForm = document.getElementById('quote-form');
        if (quoteForm) {
            quoteForm.addEventListener('submit', function(e) {
                e.preventDefault();
                handleQuoteSubmission(this);
            });
        }
    }

    // Quote Form Submission Handler
    function handleQuoteSubmission(form) {
        const submitBtn = form.querySelector('#quote-submit-btn');
        const messageDiv = document.getElementById('quote-message');

        // Clear previous messages and errors
        messageDiv.className = 'hidden';
        clearQuoteFormErrors(form);

        // Validate required fields
        const requiredFields = form.querySelectorAll('[required]');
        let hasErrors = false;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                showQuoteFieldError(field, 'This field is required.');
                hasErrors = true;
            } else if (field.type === 'email' && !isValidEmail(field.value)) {
                showQuoteFieldError(field, 'Please enter a valid email address.');
                hasErrors = true;
            }
        });

        if (hasErrors) {
            showQuoteMessage(messageDiv, 'Please correct the errors below.', 'error');
            return;
        }

        // Show loading state
        const originalBtnContent = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending Request...';
        submitBtn.disabled = true;

        // Prepare form data
        const formData = new FormData(form);

        // Send AJAX request
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                               form.querySelector('input[name="_token"]').value
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => Promise.reject(data));
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showQuoteMessage(messageDiv, data.message, 'success');
                form.reset(); // Clear the form
                clearQuoteFormErrors(form);

                // Show success alert
                alert('✅ Success!\n\n' + data.message);

                // Auto-close modal after alert
                closeProductQuoteModal();
            } else {
                showQuoteMessage(messageDiv, data.message || 'An error occurred. Please try again.', 'error');

                // Show error alert
                alert('❌ Error!\n\n' + (data.message || 'An error occurred. Please try again.'));
            }
        })
        .catch(error => {
            console.error('Quote form error:', error);

            // Handle validation errors
            if (error.errors) {
                Object.keys(error.errors).forEach(field => {
                    const fieldElement = form.querySelector(`[name="${field}"]`);
                    if (fieldElement) {
                        showQuoteFieldError(fieldElement, error.errors[field][0]);
                    }
                });
                showQuoteMessage(messageDiv, 'Please correct the errors below.', 'error');

                // Show validation error alert
                alert('❌ Validation Error!\n\nPlease correct the errors in the form and try again.');
            } else {
                showQuoteMessage(messageDiv, error.message || 'An error occurred. Please try again.', 'error');

                // Show general error alert
                alert('❌ Error!\n\n' + (error.message || 'An error occurred. Please try again.'));
            }
        })
        .finally(() => {
            // Restore button state
            submitBtn.innerHTML = originalBtnContent;
            submitBtn.disabled = false;
        });
    }

    // Quote Form Utility Functions
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function showQuoteMessage(messageDiv, message, type) {
        const isError = type === 'error';
        const bgColor = isError ? 'bg-red-100' : 'bg-green-100';
        const textColor = isError ? 'text-red-800' : 'text-green-800';
        const borderColor = isError ? 'border-red-200' : 'border-green-200';
        const icon = isError ? 'fas fa-exclamation-circle' : 'fas fa-check-circle';

        messageDiv.className = `${bgColor} ${textColor} border ${borderColor} rounded-lg p-4 mb-6`;
        messageDiv.innerHTML = `
            <div class="flex items-center">
                <i class="${icon} mr-3 text-lg"></i>
                <span class="font-medium">${message}</span>
            </div>
        `;
    }

    function showQuoteFieldError(field, message) {
        // Add error styling to field
        field.classList.add('border-red-500');
        field.classList.remove('border-gray-300');

        // Remove existing error message
        const existingError = field.parentNode.querySelector('.quote-field-error');
        if (existingError) {
            existingError.remove();
        }

        // Add error message
        const errorDiv = document.createElement('p');
        errorDiv.className = 'text-red-500 text-sm mt-1 quote-field-error';
        errorDiv.textContent = message;
        field.parentNode.appendChild(errorDiv);
    }

    function clearQuoteFormErrors(form) {
        // Remove error styling from all fields
        const fields = form.querySelectorAll('input, select, textarea');
        fields.forEach(field => {
            field.classList.remove('border-red-500');
            field.classList.add('border-gray-300');
        });

        // Remove all error messages
        const errorMessages = form.querySelectorAll('.quote-field-error');
        errorMessages.forEach(error => error.remove());
    }

    // Close modal when clicking outside of it
    document.getElementById('quoteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeProductQuoteModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeProductQuoteModal();
        }
    });
</script>
@endpush
