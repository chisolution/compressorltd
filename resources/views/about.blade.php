@extends('layouts.front')

@section('title', 'About Us - ' . ($siteSettings['company_name'] ?? config('app.name')))

@section('content')
    <!-- Page Title Section -->
    <div class="bg-gradient-to-r from-primary-color to-secondary-color text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">About {{ $siteSettings['company_name'] ?? 'Our Company' }}</h1>
                <p class="text-xl md:text-2xl text-blue-100 mb-6">{{ $siteSettings['company_tagline'] ?? 'Quality Power & Compression Solutions' }}</p>
                <div class="flex items-center justify-center space-x-2 text-blue-100">
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                    <i class="fas fa-chevron-right text-sm"></i>
                    <span>About</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Company Overview Section -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Content -->
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Our Story</h2>
                    <div class="space-y-4 text-gray-600 leading-relaxed">
                        <p>
                            {{ $siteSettings['about_us_content'] ?? 'Founded in 2016, we have grown to become a leading supplier of industrial and commercial compressors, generators, and inverters across South Africa.' }}
                        </p>
                        <p>
                            With years of experience in the power and compression industry, {{ $siteSettings['company_name'] ?? 'our company' }} has built a reputation for delivering high-quality products and exceptional customer service. We understand that reliable power solutions are critical to your business operations.
                        </p>
                        <p>
                            Our team of experienced professionals works closely with clients to understand their unique requirements and provide tailored solutions that meet their specific needs. From initial consultation to installation and ongoing support, we're committed to your success.
                        </p>
                    </div>

                    <!-- Key Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary-color mb-2">8+</div>
                            <div class="text-sm text-gray-600">Years Experience</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary-color mb-2">500+</div>
                            <div class="text-sm text-gray-600">Happy Clients</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary-color mb-2">{{ $branches->count() }}+</div>
                            <div class="text-sm text-gray-600">Branch{{ $branches->count() !== 1 ? 'es' : '' }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary-color mb-2">24/7</div>
                            <div class="text-sm text-gray-600">Support</div>
                        </div>
                    </div>
                </div>

                <!-- Image -->
                <div class="relative">
                    <div class="bg-gray-200 rounded-lg overflow-hidden shadow-lg">
                        <img src="{{ asset('images/about/company-overview.jpg') }}" alt="About {{ $siteSettings['company_name'] ?? 'Our Company' }}"
                             class="w-full h-96 object-cover">
                    </div>
                    <!-- Floating Card -->
                    <div class="absolute -bottom-6 -left-6 bg-white rounded-lg shadow-xl p-6 max-w-xs">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-primary-color rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-award text-white text-xl"></i>
                            </div>
                            <div>
                                <div class="font-bold text-gray-900">Quality Certified</div>
                                <div class="text-sm text-gray-600">ISO Standards</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mission, Vision, Values Section -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Our Foundation</h2>
                <p class="text-xl text-gray-600">The principles that guide everything we do</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Mission -->
                <div class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-primary-color rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-bullseye text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Our Mission</h3>
                    <p class="text-gray-600 leading-relaxed">
                        To provide reliable, efficient, and cost-effective power and compression solutions that enable our clients to achieve their operational goals while maintaining the highest standards of quality and service.
                    </p>
                </div>

                <!-- Vision -->
                <div class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-primary-color rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-eye text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Our Vision</h3>
                    <p class="text-gray-600 leading-relaxed">
                        To be South Africa's leading provider of industrial power solutions, recognized for our innovation, reliability, and commitment to customer success across all sectors.
                    </p>
                </div>

                <!-- Values -->
                <div class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-primary-color rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-heart text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Our Values</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Integrity, excellence, innovation, and customer-centricity drive our daily operations. We believe in building long-term partnerships based on trust and mutual success.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">What We Do</h2>
                <p class="text-xl text-gray-600">Comprehensive power and compression solutions for every need</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="group">
                    <div class="bg-gray-50 rounded-lg p-6 hover:bg-primary-color transition-colors duration-300">
                        <div class="w-12 h-12 bg-primary-color group-hover:bg-white rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-cogs text-white group-hover:text-primary-color text-xl transition-colors"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3 group-hover:text-white transition-colors">Industrial Compressors</h3>
                        <p class="text-gray-600 group-hover:text-blue-100 transition-colors">
                            High-performance air compressors for industrial applications, designed for reliability and efficiency in demanding environments.
                        </p>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="group">
                    <div class="bg-gray-50 rounded-lg p-6 hover:bg-primary-color transition-colors duration-300">
                        <div class="w-12 h-12 bg-primary-color group-hover:bg-white rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-bolt text-white group-hover:text-primary-color text-xl transition-colors"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3 group-hover:text-white transition-colors">Power Generators</h3>
                        <p class="text-gray-600 group-hover:text-blue-100 transition-colors">
                            Reliable backup power solutions for commercial and industrial facilities, ensuring uninterrupted operations.
                        </p>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="group">
                    <div class="bg-gray-50 rounded-lg p-6 hover:bg-primary-color transition-colors duration-300">
                        <div class="w-12 h-12 bg-primary-color group-hover:bg-white rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-solar-panel text-white group-hover:text-primary-color text-xl transition-colors"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3 group-hover:text-white transition-colors">Power Inverters</h3>
                        <p class="text-gray-600 group-hover:text-blue-100 transition-colors">
                            Clean and efficient power conversion solutions for residential and commercial applications.
                        </p>
                    </div>
                </div>

                <!-- Service 4 -->
                <div class="group">
                    <div class="bg-gray-50 rounded-lg p-6 hover:bg-primary-color transition-colors duration-300">
                        <div class="w-12 h-12 bg-primary-color group-hover:bg-white rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-tools text-white group-hover:text-primary-color text-xl transition-colors"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3 group-hover:text-white transition-colors">Installation & Maintenance</h3>
                        <p class="text-gray-600 group-hover:text-blue-100 transition-colors">
                            Professional installation and ongoing maintenance services to ensure optimal performance and longevity.
                        </p>
                    </div>
                </div>

                <!-- Service 5 -->
                <div class="group">
                    <div class="bg-gray-50 rounded-lg p-6 hover:bg-primary-color transition-colors duration-300">
                        <div class="w-12 h-12 bg-primary-color group-hover:bg-white rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-headset text-white group-hover:text-primary-color text-xl transition-colors"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3 group-hover:text-white transition-colors">Technical Support</h3>
                        <p class="text-gray-600 group-hover:text-blue-100 transition-colors">
                            Expert technical support and consultation to help you choose the right solutions for your specific needs.
                        </p>
                    </div>
                </div>

                <!-- Service 6 -->
                <div class="group">
                    <div class="bg-gray-50 rounded-lg p-6 hover:bg-primary-color transition-colors duration-300">
                        <div class="w-12 h-12 bg-primary-color group-hover:bg-white rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-shipping-fast text-white group-hover:text-primary-color text-xl transition-colors"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3 group-hover:text-white transition-colors">Nationwide Delivery</h3>
                        <p class="text-gray-600 group-hover:text-blue-100 transition-colors">
                            @if(isset($siteSettings['delivery_nationwide']) && $siteSettings['delivery_nationwide'])
                                Fast and reliable delivery across all provinces in South Africa, ensuring you get your equipment when you need it.
                            @else
                                Reliable delivery services to get your equipment where it needs to be, when you need it.
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Why Choose Us Section -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Why Choose {{ $siteSettings['company_name'] ?? 'Us' }}?</h2>
                <p class="text-xl text-gray-600">The advantages that set us apart from the competition</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Left Column - Benefits -->
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-primary-color rounded-full flex items-center justify-center mr-4 mt-1 flex-shrink-0">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Expert Knowledge</h3>
                            <p class="text-gray-600">Our team has extensive experience in power and compression systems, ensuring you get the right solution for your needs.</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-primary-color rounded-full flex items-center justify-center mr-4 mt-1 flex-shrink-0">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Quality Products</h3>
                            <p class="text-gray-600">We partner with leading manufacturers to offer only the highest quality equipment that meets international standards.</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-primary-color rounded-full flex items-center justify-center mr-4 mt-1 flex-shrink-0">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Competitive Pricing</h3>
                            <p class="text-gray-600">Our strong supplier relationships allow us to offer competitive prices without compromising on quality or service.</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-primary-color rounded-full flex items-center justify-center mr-4 mt-1 flex-shrink-0">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Comprehensive Support</h3>
                            <p class="text-gray-600">From initial consultation to installation and ongoing maintenance, we provide complete support throughout the product lifecycle.</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-primary-color rounded-full flex items-center justify-center mr-4 mt-1 flex-shrink-0">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Fast Response</h3>
                            <p class="text-gray-600">We understand that downtime costs money. Our rapid response times ensure minimal disruption to your operations.</p>
                        </div>
                    </div>

                    @if(isset($siteSettings['delivery_nationwide']) && $siteSettings['delivery_nationwide'])
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-primary-color rounded-full flex items-center justify-center mr-4 mt-1 flex-shrink-0">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold mb-2">Nationwide Coverage</h3>
                                <p class="text-gray-600">With delivery and service coverage across all South African provinces, we're always within reach when you need us.</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Column - Image -->
                <div class="relative">
                    <div class="bg-gray-200 rounded-lg overflow-hidden shadow-lg h-full min-h-96">
                        <img src="{{ asset('images/about/why-choose-us.jpg') }}" alt="Why Choose {{ $siteSettings['company_name'] ?? 'Us' }}"
                             class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Branches Section -->
    @if($branches->count() > 0)
        <div class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Our Locations</h2>
                    <p class="text-xl text-gray-600">Serving customers across South Africa from our strategic locations</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($branches as $branch)
                        <div class="bg-gray-50 rounded-lg shadow-md hover:shadow-lg transition-shadow p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-primary-color rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-map-marker-alt text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">{{ $branch->name }}</h3>
                                    <p class="text-primary-color font-medium">{{ $branch->city }}@if($branch->province), {{ $branch->province }}@endif</p>
                                </div>
                            </div>

                            <div class="space-y-3 text-gray-600 mb-6">
                                <div class="flex items-start">
                                    <i class="fas fa-map-marker-alt mr-3 mt-1 text-primary-color flex-shrink-0"></i>
                                    <span class="text-sm">{{ $branch->full_address }}</span>
                                </div>

                                @if($branch->phone)
                                    <div class="flex items-center">
                                        <i class="fas fa-phone mr-3 text-primary-color flex-shrink-0"></i>
                                        <span class="text-sm">{{ $branch->phone }}</span>
                                    </div>
                                @endif

                                @if($branch->manager_name)
                                    <div class="flex items-center">
                                        <i class="fas fa-user-tie mr-3 text-primary-color flex-shrink-0"></i>
                                        <span class="text-sm">Manager: {{ $branch->manager_name }}</span>
                                    </div>
                                @endif
                            </div>

                            <div class="flex space-x-3">
                                @if($branch->phone)
                                    <a href="tel:{{ $branch->phone }}" class="flex-1 bg-primary-color hover:bg-secondary-color text-white px-4 py-2 rounded-lg text-center font-medium transition-colors text-sm">
                                        <i class="fas fa-phone mr-2"></i>Call
                                    </a>
                                @endif
                                <a href="{{ route('contact.index') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg text-center font-medium transition-colors text-sm">
                                    <i class="fas fa-envelope mr-2"></i>Contact
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Call to Action Section -->
    <div class="py-16 bg-gradient-to-r from-primary-color to-secondary-color text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Get Started?</h2>
            <p class="text-xl text-blue-100 mb-8 max-w-3xl mx-auto">
                Whether you need a single compressor or a complete power solution, our team is ready to help you find the perfect equipment for your needs.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button onclick="openQuoteModal()" class="bg-white text-primary-color hover:bg-gray-100 px-8 py-4 rounded-lg font-semibold transition-colors text-lg">
                    <i class="fas fa-quote-left mr-2"></i>
                    Get a Free Quote
                </button>

                <a href="{{ route('products.index') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-8 py-4 rounded-lg font-semibold transition-colors text-lg">
                    <i class="fas fa-boxes mr-2"></i>
                    Browse Products
                </a>

                <a href="{{ route('contact.index') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-8 py-4 rounded-lg font-semibold transition-colors text-lg">
                    <i class="fas fa-phone mr-2"></i>
                    Contact Us
                </a>
            </div>

            @if(isset($siteSettings['company_phone']) && $siteSettings['company_phone'])
                <div class="mt-8 pt-8 border-t border-blue-300">
                    <p class="text-blue-100 mb-2">Need immediate assistance?</p>
                    <a href="tel:{{ $siteSettings['company_phone'] }}" class="text-2xl font-bold hover:text-white transition-colors">
                        {{ $siteSettings['company_phone'] }}
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection