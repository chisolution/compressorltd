@extends('layouts.front')

@section('content')
    <!-- Hero Section / Slider -->
    <div class="relative">
        <!-- Slider container -->
        <div class="relative overflow-hidden" id="hero-slider">
            @if($sliders->count() > 0)
                <!-- Dynamic Sliders from Database -->
                @foreach($sliders as $index => $slider)
                    <div class="slide relative h-[600px] bg-cover bg-center {{ $index > 0 ? 'hidden' : '' }}"
                         style="background-image: url('{{ asset('storage/' . $slider->image) }}')">
                        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center relative z-10">
                            <div class="max-w-2xl text-white">
                                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">{{ $slider->title }}</h1>
                                @if($slider->subtitle)
                                    <p class="text-lg md:text-xl mb-8">{{ $slider->subtitle }}</p>
                                @endif
                                @if($slider->description)
                                    <div class="text-base mb-8 leading-relaxed">
                                        {!! $slider->description !!}
                                    </div>
                                @endif
                                <div class="flex flex-wrap gap-4">
                                    @if($slider->button_text && $slider->button_link)
                                        <a href="{{ $slider->button_link }}" class="btn-primary">
                                            {{ $slider->button_text }}
                                        </a>
                                    @else
                                        <a href="{{ route('products.index') }}" class="btn-primary">Explore Products</a>
                                    @endif
                                    <a href="{{ route('contact.index') }}" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-primary-color px-6 py-3 rounded-md font-semibold transition">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Static Fallback Sliders -->
                <!-- Slide 1 -->
                <div class="slide relative h-[600px] bg-cover bg-center" style="background-image: url('{{ asset('images/hero/slide1.jpg') }}')">
                    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center relative z-10">
                        <div class="max-w-2xl text-white">
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">Quality Compressors for Every Need</h1>
                            <p class="text-lg md:text-xl mb-8">Reliable, efficient, and durable compressors for industrial and commercial applications.</p>
                            <div class="flex flex-wrap gap-4">
                                <a href="{{ route('products.index') }}" class="btn-primary">Explore Products</a>
                                <a href="{{ route('contact.index') }}" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-primary-color px-6 py-3 rounded-md font-semibold transition">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="slide relative h-[600px] bg-cover bg-center hidden" style="background-image: url('{{ asset('images/hero/slide2.jpg') }}')">
                    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center relative z-10">
                        <div class="max-w-2xl text-white">
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">Powerful Generators for Reliable Power</h1>
                            <p class="text-lg md:text-xl mb-8">Ensure uninterrupted power supply with our range of high-performance generators.</p>
                            <div class="flex flex-wrap gap-4">
                                <a href="{{ route('products.index') }}" class="btn-primary">Explore Products</a>
                                <a href="{{ route('contact.index') }}" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-primary-color px-6 py-3 rounded-md font-semibold transition">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="slide relative h-[600px] bg-cover bg-center hidden" style="background-image: url('{{ asset('images/hero/slide3.jpg') }}')">
                    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center relative z-10">
                        <div class="max-w-2xl text-white">
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">Advanced Inverters for Clean Energy</h1>
                            <p class="text-lg md:text-xl mb-8">Convert and manage power efficiently with our cutting-edge inverter technology.</p>
                            <div class="flex flex-wrap gap-4">
                                <a href="{{ route('products.index') }}" class="btn-primary">Explore Products</a>
                                <a href="{{ route('contact.index') }}" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-primary-color px-6 py-3 rounded-md font-semibold transition">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 4 -->
                <div class="slide relative h-[600px] bg-cover bg-center hidden" style="background-image: url('{{ asset('images/hero/slide4.jpg') }}')">
                    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center relative z-10">
                        <div class="max-w-2xl text-white">
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">Expert Solutions for Your Power Needs</h1>
                            <p class="text-lg md:text-xl mb-8">Customized power and compression solutions backed by technical expertise.</p>
                            <div class="flex flex-wrap gap-4">
                                <a href="{{ route('products.index') }}" class="btn-primary">Explore Products</a>
                                <a href="{{ route('contact.index') }}" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-primary-color px-6 py-3 rounded-md font-semibold transition">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Slider controls -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <button class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-75 rounded-full w-12 h-12 flex items-center justify-center z-10 focus:outline-none" id="prev-slide">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-75 rounded-full w-12 h-12 flex items-center justify-center z-10 focus:outline-none" id="next-slide">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <!-- Slider indicators -->
            <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
                @if($sliders->count() > 0)
                    @foreach($sliders as $index => $slider)
                        <button class="w-3 h-3 rounded-full bg-white bg-opacity-50 focus:outline-none indicator {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></button>
                    @endforeach
                @else
                    <button class="w-3 h-3 rounded-full bg-white bg-opacity-50 focus:outline-none indicator active" data-slide="0"></button>
                    <button class="w-3 h-3 rounded-full bg-white bg-opacity-50 focus:outline-none indicator" data-slide="1"></button>
                    <button class="w-3 h-3 rounded-full bg-white bg-opacity-50 focus:outline-none indicator" data-slide="2"></button>
                    <button class="w-3 h-3 rounded-full bg-white bg-opacity-50 focus:outline-none indicator" data-slide="3"></button>
                @endif
            </div>
        </div>
    </div>

    <!-- Featured Products Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    {{ $showingFeatured ? 'Featured Products' : 'Our Products' }}
                </h2>
                <p class="text-gray-600 max-w-3xl mx-auto">
                    {{ $showingFeatured
                        ? 'Explore our featured selection of high-quality compressors, generators, and inverters designed for reliability and performance.'
                        : 'Discover our range of high-quality compressors, generators, and inverters designed for reliability and performance.' }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if($featuredProducts->count() > 0)
                    @foreach($featuredProducts as $product)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:-translate-y-1 hover:shadow-lg">
                            <div class="relative">
                                <a href="{{ route('products.show', $product->slug) }}">
                                    <img src="{{ asset('storage/' . $product->primary_image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                                </a>

                                <!-- Sale Badge -->
                                @if($product->hasDiscount())
                                    <div class="absolute top-4 left-4">
                                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold animate-pulse">
                                            @if($product->is_on_sale)
                                                SALE
                                            @else
                                                {{ number_format($product->getCalculatedDiscountPercentage(), 0) }}% OFF
                                            @endif
                                        </span>
                                    </div>
                                @endif

                                @if($product->featured)
                                    <div class="absolute top-4 right-4">
                                        <span class="bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-medium flex items-center">
                                            <i class="fas fa-star mr-1"></i>
                                            Featured
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm text-primary-color font-medium">{{ $product->category->name ?? 'Uncategorized' }}</span>
                                    <span class="text-xs text-gray-500">{{ $product->created_at->format('M Y') }}</span>
                                </div>
                                <h3 class="text-xl font-bold mb-2">{{ $product->name }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $product->short_description }}</p>
                                <a href="{{ route('products.show', $product->slug) }}" class="text-primary-color hover:text-secondary-color font-medium flex items-center">
                                    Learn More
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback Static Products -->
                    <!-- Product 1 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:-translate-y-1 hover:shadow-lg">
                        <img src="{{ asset('images/home/commercial-generator.jpg') }}" alt="Commercial Generator" class="w-full h-64 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">Commercial Generators</h3>
                            <p class="text-gray-600 mb-4">Reliable power solutions for commercial applications with various capacity options.</p>
                            <a href="{{ route('products.index') }}" class="text-primary-color hover:text-secondary-color font-medium flex items-center">
                                Learn More
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Product 2 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:-translate-y-1 hover:shadow-lg">
                        <img src="{{ asset('images/home/electric-generator.jpg') }}" alt="Industrial Air Compressor" class="w-full h-64 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">Industrial Air Compressors</h3>
                            <p class="text-gray-600 mb-4">High-performance compressors designed for demanding industrial environments.</p>
                            <a href="{{ route('products.index') }}" class="text-primary-color hover:text-secondary-color font-medium flex items-center">
                                Learn More
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Product 3 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:-translate-y-1 hover:shadow-lg">
                        <img src="{{ asset('images/home/inverter-wall.jpg') }}" alt="Power Inverters" class="w-full h-64 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">Power Inverters</h3>
                            <p class="text-gray-600 mb-4">Clean and efficient power conversion for residential and commercial use.</p>
                            <a href="{{ route('products.index') }}" class="text-primary-color hover:text-secondary-color font-medium flex items-center">
                                Learn More
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('products.index') }}" class="btn-primary">View All Products</a>
            </div>
        </div>
    </section>

    <!-- About Us Preview Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">About {{ $siteSettings['company_name'] ?? 'Our Company' }}</h2>
                    <p class="text-gray-600 mb-6">{{ $siteSettings['about_us_content'] ?? 'Founded in 2016, we have grown to become a leading supplier of industrial and commercial compressors, generators, and inverters. Our mission is to provide high-quality, reliable power and compression solutions that meet the diverse needs of our customers across various industries.' }}</p>
                    <p class="text-gray-600 mb-8">With a team of experienced professionals and partnerships with leading manufacturers, we offer not just products but complete solutions backed by expert advice and reliable after-sales service.</p>
                    <a href="{{ route('about.index') }}" class="btn-primary">Learn More About Us</a>
                </div>
                <div class="relative">
                    <img src="{{ asset('images/home/technicians.jpg') }}" alt="About Compressor Ltd" class="rounded-lg shadow-lg w-full">
                    <div class="absolute -bottom-6 -left-6 bg-primary-color text-white p-6 rounded-lg shadow-lg hidden md:block">
                        <div class="text-4xl font-bold">10+</div>
                        <div class="text-lg">Years of Experience</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Why Choose Us</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">We pride ourselves on delivering exceptional quality, reliability, and service for all your power and compression needs.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Reason 1 -->
                <div class="bg-white p-8 rounded-lg shadow-md transition transform hover:-translate-y-1 hover:shadow-lg">
                    <div class="text-primary-color text-4xl mb-4">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Quality Products</h3>
                    <p class="text-gray-600">We partner with leading manufacturers to provide top-quality compressors, generators, and inverters that meet the highest industry standards.</p>
                </div>

                <!-- Reason 2 -->
                <div class="bg-white p-8 rounded-lg shadow-md transition transform hover:-translate-y-1 hover:shadow-lg">
                    <div class="text-primary-color text-4xl mb-4">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Expert Technical Support</h3>
                    <p class="text-gray-600">Our team of experienced technicians provides comprehensive support, from installation to maintenance and repairs, ensuring optimal performance.</p>
                </div>

                <!-- Reason 3 -->
                <div class="bg-white p-8 rounded-lg shadow-md transition transform hover:-translate-y-1 hover:shadow-lg">
                    <div class="text-primary-color text-4xl mb-4">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Dedicated Customer Service</h3>
                    <p class="text-gray-600">We're committed to exceptional customer service, offering personalized solutions and prompt responses to all your inquiries and needs.</p>
                </div>

                <!-- Reason 4 -->
                <div class="bg-white p-8 rounded-lg shadow-md transition transform hover:-translate-y-1 hover:shadow-lg">
                    <div class="text-primary-color text-4xl mb-4">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Customized Solutions</h3>
                    <p class="text-gray-600">We understand that every business has unique requirements, which is why we offer tailored solutions designed to meet your specific needs.</p>
                </div>

                <!-- Reason 5 -->
                <div class="bg-white p-8 rounded-lg shadow-md transition transform hover:-translate-y-1 hover:shadow-lg">
                    <div class="text-primary-color text-4xl mb-4">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Fast Delivery</h3>
                    <p class="text-gray-600">With our efficient logistics network, we ensure timely delivery of products and parts, minimizing downtime for your operations.</p>
                </div>

                <!-- Reason 6 -->
                <div class="bg-white p-8 rounded-lg shadow-md transition transform hover:-translate-y-1 hover:shadow-lg">
                    <div class="text-primary-color text-4xl mb-4">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Comprehensive Warranty</h3>
                    <p class="text-gray-600">We stand behind our products with robust warranty coverage, giving you peace of mind and confidence in your investment.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Latest Articles</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">Stay updated with the latest industry insights, maintenance tips, and product information.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @if($latestBlogs->count() > 0)
                    @foreach($latestBlogs as $blog)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:-translate-y-1 hover:shadow-lg">
                            <a href="{{ route('blog.show', $blog->slug) }}">
                                <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-48 object-cover">
                            </a>
                            <div class="p-6">
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    <span>{{ $blog->published_at->format('M j, Y') }}</span>
                                    @if($blog->category)
                                        <span class="mx-2">•</span>
                                        <i class="far fa-folder mr-2"></i>
                                        <span>{{ $blog->category->name }}</span>
                                    @endif
                                </div>
                                <h3 class="text-xl font-bold mb-2">
                                    <a href="{{ route('blog.show', $blog->slug) }}" class="hover:text-primary-color transition-colors">
                                        {{ $blog->title }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 mb-4">{{ $blog->excerpt }}</p>
                                <a href="{{ route('blog.show', $blog->slug) }}" class="text-primary-color hover:text-secondary-color font-medium flex items-center">
                                    Read More
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback Static Blog Posts -->
                    <!-- Blog Post 1 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:-translate-y-1 hover:shadow-lg">
                        <img src="{{ asset('images/home/commercial-generator.jpg') }}" alt="How to Choose the Right Compressor" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <i class="far fa-calendar-alt mr-2"></i>
                                <span>May 15, 2023</span>
                                <span class="mx-2">•</span>
                                <i class="far fa-folder mr-2"></i>
                                <span>Product Guides</span>
                            </div>
                            <h3 class="text-xl font-bold mb-2">How to Choose the Right Compressor for Your Application</h3>
                            <p class="text-gray-600 mb-4">Understanding the key factors to consider when selecting an air compressor for your specific industry needs.</p>
                            <a href="{{ route('blog.index') }}" class="text-primary-color hover:text-secondary-color font-medium flex items-center">
                                Read More
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Blog Post 2 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:-translate-y-1 hover:shadow-lg">
                        <img src="{{ asset('images/home/electric-generator.jpg') }}" alt="Preventive Maintenance Checklist" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <i class="far fa-calendar-alt mr-2"></i>
                                <span>April 28, 2023</span>
                                <span class="mx-2">•</span>
                                <i class="far fa-folder mr-2"></i>
                                <span>Maintenance Tips</span>
                            </div>
                            <h3 class="text-xl font-bold mb-2">Preventive Maintenance Checklist for Air Compressors</h3>
                            <p class="text-gray-600 mb-4">Essential maintenance practices to extend the life of your air compressor and ensure optimal performance.</p>
                            <a href="{{ route('blog.index') }}" class="text-primary-color hover:text-secondary-color font-medium flex items-center">
                                Read More
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Blog Post 3 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:-translate-y-1 hover:shadow-lg">
                        <img src="{{ asset('images/home/inverter-wall.jpg') }}" alt="Advances in Energy-Efficient Technology" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <i class="far fa-calendar-alt mr-2"></i>
                                <span>March 12, 2023</span>
                                <span class="mx-2">•</span>
                                <i class="far fa-folder mr-2"></i>
                                <span>Technology Updates</span>
                            </div>
                            <h3 class="text-xl font-bold mb-2">Advances in Energy-Efficient Compressor Technology</h3>
                            <p class="text-gray-600 mb-4">Exploring the latest innovations in energy-efficient compressor technology and their benefits for businesses.</p>
                            <a href="{{ route('blog.index') }}" class="text-primary-color hover:text-secondary-color font-medium flex items-center">
                                Read More
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('blog.index') }}" class="btn-primary">View All Articles</a>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Frequently Asked Questions</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">Find answers to common questions about our products, services, and support.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Left Column - General Information -->
                <div class="space-y-8">
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-info-circle text-primary-color mr-3"></i>
                            About Our Products & Services
                        </h3>

                        <div class="space-y-6 text-gray-600 leading-relaxed">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-3">Quality Industrial Equipment</h4>
                                <p>We specialize in providing high-quality industrial equipment and machinery solutions for businesses across various industries. Our extensive product range includes compressors, generators, pumps, and specialized industrial tools designed to meet the demanding requirements of modern industrial operations.</p>
                            </div>

                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-3">Expert Technical Support</h4>
                                <p>Our team of experienced engineers and technicians provides comprehensive technical support, from initial consultation to installation and ongoing maintenance. We understand that downtime can be costly, which is why we offer rapid response times and reliable service to keep your operations running smoothly.</p>
                            </div>

                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-3">Custom Solutions</h4>
                                <p>Every business has unique requirements. We work closely with our clients to understand their specific needs and provide customized solutions that optimize performance, efficiency, and cost-effectiveness. Our engineering team can modify existing products or develop entirely new solutions to meet your exact specifications.</p>
                            </div>

                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-3">Nationwide Service Network</h4>
                                <p>With service centers and authorized dealers across the country, we ensure that professional support is always within reach. Our nationwide network enables us to provide quick delivery, local support, and efficient maintenance services wherever your business operates.</p>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="{{ route('products.index') }}" class="bg-primary-color hover:bg-secondary-color text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 text-center">
                                    <i class="fas fa-boxes mr-2"></i>View Our Products
                                </a>
                                <button onclick="openQuoteModal()" class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-6 py-3 rounded-lg font-medium transition-all duration-200">
                                    <i class="fas fa-envelope mr-2"></i>Get a Quote
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - FAQs -->
                <div class="space-y-8">
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-question-circle text-primary-color mr-3"></i>
                            Common Questions
                        </h3>

                        <div class="space-y-4">
                            <!-- FAQ Item 1 -->
                            <div class="border border-gray-200 rounded-lg overflow-hidden">
                                <button class="w-full flex justify-between items-center p-4 text-left focus:outline-none hover:bg-gray-50 transition-colors" onclick="toggleFAQ(this)">
                                    <span class="text-lg font-semibold text-gray-800">What types of compressors do you offer?</span>
                                    <svg class="w-5 h-5 transform transition-transform duration-300 text-primary-color" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="hidden px-4 pb-4 pt-0">
                                    <p class="text-gray-600 leading-relaxed">We offer a comprehensive range of compressors including rotary screw compressors, reciprocating/piston compressors, scroll compressors, and centrifugal compressors. Each type is available in various capacities and configurations to meet different industrial and commercial applications.</p>
                                </div>
                            </div>

                            <!-- FAQ Item 2 -->
                            <div class="border border-gray-200 rounded-lg overflow-hidden">
                                <button class="w-full flex justify-between items-center p-4 text-left focus:outline-none hover:bg-gray-50 transition-colors" onclick="toggleFAQ(this)">
                                    <span class="text-lg font-semibold text-gray-800">Do you provide installation services?</span>
                                    <svg class="w-5 h-5 transform transition-transform duration-300 text-primary-color" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="hidden px-4 pb-4 pt-0">
                                    <p class="text-gray-600 leading-relaxed">Yes, we provide professional installation services for all our products. Our team of certified technicians ensures proper setup and configuration according to manufacturer specifications and industry best practices. We also offer training for your staff on basic operation and maintenance procedures.</p>
                                </div>
                            </div>

                            <!-- FAQ Item 3 -->
                            <div class="border border-gray-200 rounded-lg overflow-hidden">
                                <button class="w-full flex justify-between items-center p-4 text-left focus:outline-none hover:bg-gray-50 transition-colors" onclick="toggleFAQ(this)">
                                    <span class="text-lg font-semibold text-gray-800">What warranty coverage do you provide?</span>
                                    <svg class="w-5 h-5 transform transition-transform duration-300 text-primary-color" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="hidden px-4 pb-4 pt-0">
                                    <p class="text-gray-600 leading-relaxed">Our products come with comprehensive warranty coverage that varies by product type and manufacturer. Typically, our compressors and generators include a 1-2 year standard warranty covering parts and labor. Extended warranty options are also available for purchase. Please contact our sales team for specific warranty details on the product you're interested in.</p>
                                </div>
                            </div>

                            <!-- FAQ Item 4 -->
                            <div class="border border-gray-200 rounded-lg overflow-hidden">
                                <button class="w-full flex justify-between items-center p-4 text-left focus:outline-none hover:bg-gray-50 transition-colors" onclick="toggleFAQ(this)">
                                    <span class="text-lg font-semibold text-gray-800">How quickly can you deliver products?</span>
                                    <svg class="w-5 h-5 transform transition-transform duration-300 text-primary-color" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="hidden px-4 pb-4 pt-0">
                                    <p class="text-gray-600 leading-relaxed">Delivery times depend on product availability and your location. Many of our standard products are in stock and can be delivered within 3-5 business days. Custom or specialized equipment may require 2-4 weeks for delivery. For urgent needs, we offer expedited shipping options. Our sales team can provide you with a specific delivery timeline when you place your order.</p>
                                </div>
                            </div>

                            <!-- FAQ Item 5 -->
                            <div class="border border-gray-200 rounded-lg overflow-hidden">
                                <button class="w-full flex justify-between items-center p-4 text-left focus:outline-none hover:bg-gray-50 transition-colors" onclick="toggleFAQ(this)">
                                    <span class="text-lg font-semibold text-gray-800">Do you offer maintenance service plans?</span>
                                    <svg class="w-5 h-5 transform transition-transform duration-300 text-primary-color" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="hidden px-4 pb-4 pt-0">
                                    <p class="text-gray-600 leading-relaxed">Yes, we offer several maintenance service plans to keep your equipment running at peak efficiency. Our plans range from basic preventive maintenance to comprehensive coverage including emergency repairs and priority service. Regular maintenance not only extends equipment life but also optimizes performance and energy efficiency. Contact our service department to discuss the best maintenance plan for your needs.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-16 bg-primary-color text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Need Expert Advice?</h2>
            <p class="text-xl mb-8 max-w-3xl mx-auto">Our team of specialists is ready to help you find the perfect solution for your power and compression needs.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('contact.index') }}" class="bg-white text-primary-color hover:bg-gray-100 px-8 py-3 rounded-md font-semibold transition">Contact Us</a>
                <button onclick="openQuoteModal()" class="bg-secondary-color hover:bg-opacity-90 text-white px-8 py-3 rounded-md font-semibold transition">Get a Free Quote</button>
            </div>
        </div>
    </section>



    <script>
        // Hero Slider Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('#hero-slider .slide');
            const indicators = document.querySelectorAll('.indicator');
            const prevBtn = document.getElementById('prev-slide');
            const nextBtn = document.getElementById('next-slide');
            let currentSlide = 0;
            let slideInterval = setInterval(nextSlide, 5000);

            function showSlide(index) {
                slides.forEach(slide => slide.classList.add('hidden'));
                indicators.forEach(indicator => indicator.classList.remove('active', 'bg-white', 'bg-opacity-100'));
                indicators.forEach(indicator => indicator.classList.add('bg-white', 'bg-opacity-50'));

                slides[index].classList.remove('hidden');
                indicators[index].classList.add('active', 'bg-white', 'bg-opacity-100');
                currentSlide = index;

                // Reset interval
                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, 5000);
            }

            function nextSlide() {
                let next = currentSlide + 1;
                if (next >= slides.length) next = 0;
                showSlide(next);
            }

            function prevSlide() {
                let prev = currentSlide - 1;
                if (prev < 0) prev = slides.length - 1;
                showSlide(prev);
            }

            // Event listeners
            prevBtn.addEventListener('click', prevSlide);
            nextBtn.addEventListener('click', nextSlide);

            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => showSlide(index));
            });

            // Initialize first slide
            showSlide(0);


        });

        // FAQ Toggle Functionality
        function toggleFAQ(element) {
            // Get the content panel
            const content = element.nextElementSibling;

            // Get the arrow icon
            const arrow = element.querySelector('svg');

            // Toggle the content visibility
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                arrow.classList.add('rotate-180');
            } else {
                content.classList.add('hidden');
                arrow.classList.remove('rotate-180');
            }
        }
    </script>
@endsection
