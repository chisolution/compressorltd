@extends('layouts.front')

@section('title', 'Contact Us - ' . ($siteSettings['company_name'] ?? config('app.name')))

@section('content')
    <!-- Page Title Section -->
    <div class="bg-gradient-to-r from-primary-color to-secondary-color text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Contact Us</h1>
                <p class="text-xl md:text-2xl text-blue-100 mb-6">Get in touch with {{ $siteSettings['company_name'] ?? 'our team' }}</p>
                <div class="flex items-center justify-center space-x-2 text-blue-100">
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                    <i class="fas fa-chevron-right text-sm"></i>
                    <span>Contact</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Contact Information Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <!-- Phone -->
                <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-primary-color rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-phone text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Call Us</h3>
                    @if(isset($siteSettings['company_phone']) && $siteSettings['company_phone'])
                        <p class="text-gray-600 mb-2">{{ $siteSettings['company_phone'] }}</p>
                        <a href="tel:{{ $siteSettings['company_phone'] }}" class="text-primary-color hover:text-secondary-color font-medium">
                            Call Now
                        </a>
                    @else
                        <p class="text-gray-600">Phone number not available</p>
                    @endif
                </div>

                <!-- Email -->
                <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-primary-color rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-envelope text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Email Us</h3>
                    @if(isset($siteSettings['company_email']) && $siteSettings['company_email'])
                        <p class="text-gray-600 mb-2">{{ $siteSettings['company_email'] }}</p>
                        <a href="mailto:{{ $siteSettings['company_email'] }}" class="text-primary-color hover:text-secondary-color font-medium">
                            Send Email
                        </a>
                    @else
                        <p class="text-gray-600">Email not available</p>
                    @endif
                </div>

                <!-- Address -->
                <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-primary-color rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Visit Us</h3>
                    @if(isset($siteSettings['company_address']) && $siteSettings['company_address'])
                        <p class="text-gray-600 mb-2">{!! nl2br(e($siteSettings['company_address'])) !!}</p>
                        <a href="#branches" class="text-primary-color hover:text-secondary-color font-medium">
                            View All Branches
                        </a>
                    @else
                        <p class="text-gray-600">Address not available</p>
                    @endif
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold mb-6">
                        <i class="fas fa-paper-plane mr-2 text-primary-color"></i>
                        Send us a Message
                    </h2>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <!-- AJAX Message Container -->
                    <div id="contact-message" class="hidden"></div>

                    <form id="contact-form" action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent transition-colors"
                                       placeholder="Your full name">
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent transition-colors"
                                       placeholder="your.email@example.com">
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent transition-colors"
                                       placeholder="+27 11 123 4567">
                                @error('phone')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Company -->
                            <div>
                                <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Company</label>
                                <input type="text" name="company" id="company" value="{{ old('company') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent transition-colors"
                                       placeholder="Your company name">
                                @error('company')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Inquiry Type -->
                            <div>
                                <label for="inquiry_type" class="block text-sm font-medium text-gray-700 mb-2">Inquiry Type *</label>
                                <select name="inquiry_type" id="inquiry_type" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent transition-colors">
                                    <option value="">Select inquiry type</option>
                                    <option value="general" {{ old('inquiry_type') == 'general' ? 'selected' : '' }}>General Inquiry</option>
                                    <option value="quote" {{ old('inquiry_type') == 'quote' ? 'selected' : '' }}>Request Quote</option>
                                    <option value="support" {{ old('inquiry_type') == 'support' ? 'selected' : '' }}>Technical Support</option>
                                    <option value="partnership" {{ old('inquiry_type') == 'partnership' ? 'selected' : '' }}>Partnership</option>
                                    <option value="other" {{ old('inquiry_type') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('inquiry_type')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Branch -->
                            <div>
                                <label for="branch_id" class="block text-sm font-medium text-gray-700 mb-2">Preferred Branch</label>
                                <select name="branch_id" id="branch_id"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent transition-colors">
                                    <option value="">Any branch</option>
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                            {{ $branch->name }} - {{ $branch->city }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('branch_id')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Subject -->
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject *</label>
                            <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent transition-colors"
                                   placeholder="Brief subject of your inquiry">
                            @error('subject')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                            <textarea name="message" id="message" rows="6" required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent transition-colors resize-vertical"
                                      placeholder="Please provide details about your inquiry...">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" id="contact-submit-btn" class="w-full bg-primary-color hover:bg-secondary-color text-white px-6 py-4 rounded-lg font-semibold transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg flex items-center justify-center">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Company Information -->
                <div class="space-y-8">
                    <!-- About Section -->
                    <div class="bg-white rounded-lg shadow-md p-8">
                        <h2 class="text-2xl font-bold mb-6">
                            <i class="fas fa-info-circle mr-2 text-primary-color"></i>
                            About {{ $siteSettings['company_name'] ?? 'Our Company' }}
                        </h2>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ $siteSettings['about_us_content'] ?? 'We are a leading provider of industrial and commercial power solutions, specializing in compressors, generators, and inverters.' }}
                        </p>

                        @if(isset($siteSettings['delivery_nationwide']) && $siteSettings['delivery_nationwide'])
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                                <div class="flex items-center">
                                    <i class="fas fa-truck text-green-600 mr-3"></i>
                                    <div>
                                        <h4 class="font-semibold text-green-800">Nationwide Delivery</h4>
                                        <p class="text-green-700 text-sm">We deliver to all provinces across South Africa</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Expert Consultation</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Quality Products</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Professional Installation</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>After-sales Support</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Contact -->
                    <div class="bg-primary-color rounded-lg shadow-md p-8 text-white">
                        <h3 class="text-xl font-bold mb-4">
                            <i class="fas fa-headset mr-2"></i>
                            Need Immediate Assistance?
                        </h3>
                        <p class="mb-6 text-blue-100">Our team is ready to help you with any questions or urgent requirements.</p>

                        <div class="space-y-3">
                            @if(isset($siteSettings['company_phone']) && $siteSettings['company_phone'])
                                <a href="tel:{{ $siteSettings['company_phone'] }}" class="flex items-center bg-white bg-opacity-20 hover:bg-opacity-30 rounded-lg p-3 transition-colors">
                                    <i class="fas fa-phone mr-3"></i>
                                    <span>{{ $siteSettings['company_phone'] }}</span>
                                </a>
                            @endif

                            @if(isset($siteSettings['company_email']) && $siteSettings['company_email'])
                                <a href="mailto:{{ $siteSettings['company_email'] }}" class="flex items-center bg-white bg-opacity-20 hover:bg-opacity-30 rounded-lg p-3 transition-colors">
                                    <i class="fas fa-envelope mr-3"></i>
                                    <span>{{ $siteSettings['company_email'] }}</span>
                                </a>
                            @endif

                            <button onclick="openQuoteModal()" class="w-full flex items-center justify-center bg-white text-primary-color hover:bg-gray-100 rounded-lg p-3 font-semibold transition-colors">
                                <i class="fas fa-quote-left mr-2"></i>
                                Request Quick Quote
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Branches Section -->
    @if($branches->count() > 0)
        <div id="branches" class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Our Branch Locations</h2>
                    <p class="text-xl text-gray-600">Visit us at any of our convenient locations across South Africa</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($branches as $branch)
                        <div class="bg-gray-50 rounded-lg shadow-md hover:shadow-lg transition-shadow p-6">
                            <div class="flex items-start mb-4">
                                <div class="w-12 h-12 bg-primary-color rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas fa-building text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">{{ $branch->name }}</h3>
                                    <p class="text-primary-color font-medium">{{ $branch->city }}@if($branch->province), {{ $branch->province }}@endif</p>
                                </div>
                            </div>

                            <div class="space-y-3 text-gray-600">
                                <!-- Address -->
                                <div class="flex items-start">
                                    <i class="fas fa-map-marker-alt mr-3 mt-1 text-primary-color flex-shrink-0"></i>
                                    <span class="text-sm">{{ $branch->full_address }}</span>
                                </div>

                                <!-- Phone -->
                                @if($branch->phone)
                                    <div class="flex items-center">
                                        <i class="fas fa-phone mr-3 text-primary-color flex-shrink-0"></i>
                                        <a href="tel:{{ $branch->phone }}" class="text-sm hover:text-primary-color transition-colors">
                                            {{ $branch->phone }}
                                        </a>
                                    </div>
                                @endif

                                <!-- Email -->
                                @if($branch->email)
                                    <div class="flex items-center">
                                        <i class="fas fa-envelope mr-3 text-primary-color flex-shrink-0"></i>
                                        <a href="mailto:{{ $branch->email }}" class="text-sm hover:text-primary-color transition-colors">
                                            {{ $branch->email }}
                                        </a>
                                    </div>
                                @endif

                                <!-- Manager -->
                                @if($branch->manager_name)
                                    <div class="flex items-center">
                                        <i class="fas fa-user-tie mr-3 text-primary-color flex-shrink-0"></i>
                                        <span class="text-sm">Manager: {{ $branch->manager_name }}</span>
                                    </div>
                                @endif

                                <!-- Operating Hours -->
                                @if($branch->operating_hours)
                                    <div class="flex items-start">
                                        <i class="fas fa-clock mr-3 mt-1 text-primary-color flex-shrink-0"></i>
                                        <div class="text-sm">
                                            <div class="font-medium text-gray-700 mb-1">Operating Hours:</div>
                                            <div class="text-gray-600">{!! nl2br(e($branch->operating_hours)) !!}</div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-6 flex flex-col sm:flex-row gap-3">
                                @if($branch->phone)
                                    <a href="tel:{{ $branch->phone }}" class="flex-1 bg-primary-color hover:bg-secondary-color text-white px-4 py-2 rounded-lg text-center font-medium transition-colors text-sm">
                                        <i class="fas fa-phone mr-2"></i>Call
                                    </a>
                                @endif
                                @if($branch->email)
                                    <a href="mailto:{{ $branch->email }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg text-center font-medium transition-colors text-sm">
                                        <i class="fas fa-envelope mr-2"></i>Email
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Contact CTA -->
                <div class="mt-12 text-center">
                    <div class="bg-gradient-to-r from-primary-color to-secondary-color rounded-lg p-8 text-white">
                        <h3 class="text-2xl font-bold mb-4">Can't find what you're looking for?</h3>
                        <p class="text-blue-100 mb-6">Our team is here to help you with any questions or special requirements.</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <button onclick="openQuoteModal()" class="bg-white text-primary-color hover:bg-gray-100 px-6 py-3 rounded-lg font-semibold transition-colors">
                                <i class="fas fa-quote-left mr-2"></i>
                                Request Quote
                            </button>
                            @if(isset($siteSettings['company_phone']) && $siteSettings['company_phone'])
                                <a href="tel:{{ $siteSettings['company_phone'] }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                                    <i class="fas fa-phone mr-2"></i>
                                    Call {{ $siteSettings['company_phone'] }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize contact form AJAX
        initContactForm();
    });

    // Contact Form AJAX Handler
    function initContactForm() {
        const contactForm = document.getElementById('contact-form');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                handleContactSubmission(this);
            });
        }
    }

    // Contact Form Submission Handler
    function handleContactSubmission(form) {
        const submitBtn = form.querySelector('#contact-submit-btn');
        const messageDiv = document.getElementById('contact-message');

        // Clear previous messages and errors
        messageDiv.className = 'hidden';
        clearFormErrors(form);

        // Validate required fields
        const requiredFields = form.querySelectorAll('[required]');
        let hasErrors = false;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                showFieldError(field, 'This field is required.');
                hasErrors = true;
            } else if (field.type === 'email' && !isValidEmail(field.value)) {
                showFieldError(field, 'Please enter a valid email address.');
                hasErrors = true;
            }
        });

        if (hasErrors) {
            showMessage(messageDiv, 'Please correct the errors below.', 'error');
            return;
        }

        // Show loading state
        const originalBtnContent = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending Message...';
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
                showMessage(messageDiv, data.message, 'success');
                form.reset(); // Clear the form
                clearFormErrors(form);

                // Show success alert
                alert('✅ Success!\n\n' + data.message);

                // Scroll to success message
                messageDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
            } else {
                showMessage(messageDiv, data.message || 'An error occurred. Please try again.', 'error');

                // Show error alert
                alert('❌ Error!\n\n' + (data.message || 'An error occurred. Please try again.'));
            }
        })
        .catch(error => {
            console.error('Contact form error:', error);

            // Handle validation errors
            if (error.errors) {
                Object.keys(error.errors).forEach(field => {
                    const fieldElement = form.querySelector(`[name="${field}"]`);
                    if (fieldElement) {
                        showFieldError(fieldElement, error.errors[field][0]);
                    }
                });
                showMessage(messageDiv, 'Please correct the errors below.', 'error');

                // Show validation error alert
                alert('❌ Validation Error!\n\nPlease correct the errors in the form and try again.');
            } else {
                showMessage(messageDiv, error.message || 'An error occurred. Please try again.', 'error');

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

    // Utility Functions
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function showMessage(messageDiv, message, type) {
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

        // Auto-hide success messages after 8 seconds
        if (!isError) {
            setTimeout(() => {
                messageDiv.className = 'hidden';
            }, 8000);
        }
    }

    function showFieldError(field, message) {
        // Add error styling to field
        field.classList.add('border-red-500');
        field.classList.remove('border-gray-300');

        // Remove existing error message
        const existingError = field.parentNode.querySelector('.field-error');
        if (existingError) {
            existingError.remove();
        }

        // Add error message
        const errorDiv = document.createElement('p');
        errorDiv.className = 'text-red-500 text-sm mt-1 field-error';
        errorDiv.textContent = message;
        field.parentNode.appendChild(errorDiv);
    }

    function clearFormErrors(form) {
        // Remove error styling from all fields
        const fields = form.querySelectorAll('input, select, textarea');
        fields.forEach(field => {
            field.classList.remove('border-red-500');
            field.classList.add('border-gray-300');
        });

        // Remove all error messages
        const errorMessages = form.querySelectorAll('.field-error');
        errorMessages.forEach(error => error.remove());
    }
</script>
@endpush