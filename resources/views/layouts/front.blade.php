<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', $siteSettings['site_title'] ?? config('app.name', 'Laravel'))</title>

        <!-- Additional Meta Tags -->
        @stack('meta')

        <!-- Favicon -->
        @if(isset($siteSettings['site_favicon']) && $siteSettings['site_favicon'])
            <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $siteSettings['site_favicon']) }}">
            @if(isset($siteSettings['favicon_16']))
                <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/' . $siteSettings['favicon_16']) }}">
            @endif
            @if(isset($siteSettings['favicon_32']))
                <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/' . $siteSettings['favicon_32']) }}">
            @endif
        @endif

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            'primary-color': '#33c4aa',
                            'secondary-color': '#2ba995'
                        }
                    }
                }
            }
        </script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Custom Styles -->
        <style>
            .btn-primary {
                background-color: #33c4aa;
                color: white;
                padding: 0.75rem 1.5rem;
                border-radius: 0.375rem;
                font-weight: 600;
                text-decoration: none;
                display: inline-block;
                transition: all 0.2s;
            }

            .btn-primary:hover {
                background-color: #2ba995;
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(51, 196, 170, 0.3);
            }

            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            /* Desktop Navigation Styles */
            .nav-link {
                display: flex;
                align-items: center;
                padding: 0.75rem 1rem;
                font-size: 1rem;
                font-weight: 600;
                color: #374151;
                text-decoration: none;
                border-radius: 0.5rem;
                transition: all 0.2s ease-in-out;
                position: relative;
            }

            .nav-link:hover {
                color: #33c4aa;
                background-color: #f3f4f6;
                transform: translateY(-1px);
            }

            .nav-link-active {
                color: #33c4aa !important;
                background-color: #ecfdf5;
                border: 1px solid #a7f3d0;
            }

            .nav-link-active::after {
                content: '';
                position: absolute;
                bottom: -2px;
                left: 50%;
                transform: translateX(-50%);
                width: 80%;
                height: 3px;
                background-color: #33c4aa;
                border-radius: 2px;
            }

            /* Mobile Navigation Styles */
            .mobile-nav-link {
                display: flex;
                align-items: center;
                padding: 1rem;
                font-size: 1.125rem;
                font-weight: 600;
                color: #374151;
                text-decoration: none;
                border-radius: 0.75rem;
                transition: all 0.2s ease-in-out;
                border: 1px solid transparent;
            }

            .mobile-nav-link:hover {
                color: #33c4aa;
                background-color: #f3f4f6;
                border-color: #d1d5db;
            }

            .mobile-nav-link-active {
                color: #33c4aa !important;
                background-color: #ecfdf5;
                border-color: #a7f3d0;
                box-shadow: 0 2px 4px rgba(51, 196, 170, 0.1);
            }

            /* Enhanced Mobile Menu Animation */
            #mobile-menu {
                transition: all 0.3s ease-in-out;
                transform: translateY(-10px);
                opacity: 0;
            }

            #mobile-menu:not(.hidden) {
                transform: translateY(0);
                opacity: 1;
            }

            /* Logo Enhancement */
            .logo-icon {
                animation: rotate 20s linear infinite;
            }

            @keyframes rotate {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }

            /* Responsive Font Sizes */
            @media (max-width: 640px) {
                .nav-link {
                    font-size: 0.875rem;
                    padding: 0.5rem 0.75rem;
                }

                .mobile-nav-link {
                    font-size: 1rem;
                    padding: 0.875rem;
                }
            }

            /* Footer Responsive Adjustments */
            @media (min-width: 1280px) {
                .max-w-8xl {
                    max-width: 88rem;
                }
            }

            /* Footer Column Spacing */
            .footer-grid {
                display: grid;
                gap: 2rem;
                grid-template-columns: 1fr;
            }

            @media (min-width: 768px) {
                .footer-grid {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 2rem;
                }
            }

            @media (min-width: 1024px) {
                .footer-grid {
                    grid-template-columns: repeat(3, 1fr);
                    gap: 1.5rem;
                }
            }

            @media (min-width: 1280px) {
                .footer-grid {
                    grid-template-columns: 2fr 1.5fr 1.5fr 1.5fr 1.5fr;
                    gap: 2rem;
                }
            }
        </style>

        @stack('styles')

        <!-- Structured Data -->
        @stack('structured-data')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- Top Header -->
            <div class="bg-gray-800 text-white py-2">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col sm:flex-row justify-between items-center text-sm">
                        <div class="flex items-center space-x-4 mb-2 sm:mb-0">
                            <span class="hidden sm:inline">Follow Us:</span>
                            <div class="flex space-x-3">
                                <a href="#" class="text-gray-300 hover:text-white transition-colors">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="text-gray-300 hover:text-white transition-colors">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="text-gray-300 hover:text-white transition-colors">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="text-gray-300 hover:text-white transition-colors">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-y-0 sm:space-x-6">
                            @if(isset($siteSettings['company_phone']) && $siteSettings['company_phone'])
                                <div class="flex items-center">
                                    <i class="fas fa-phone mr-2 text-primary-color"></i>
                                    <span>Call: <a href="tel:{{ $siteSettings['company_phone'] }}" class="hover:text-primary-color">{{ $siteSettings['company_phone'] }}</a></span>
                                </div>
                            @endif
                            @if(isset($siteSettings['company_email']) && $siteSettings['company_email'])
                                <div class="flex items-center">
                                    <i class="fas fa-envelope mr-2 text-primary-color"></i>
                                    <span>Email: <a href="mailto:{{ $siteSettings['company_email'] }}" class="hover:text-primary-color">{{ $siteSettings['company_email'] }}</a></span>
                                </div>
                            @endif
                            @if(isset($siteSettings['delivery_nationwide']) && $siteSettings['delivery_nationwide'])
                                <div class="flex items-center">
                                    <i class="fas fa-truck mr-2 text-primary-color"></i>
                                    <span class="text-sm font-medium">Nationwide Delivery</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Header -->
            <header class="bg-white shadow-lg sticky top-0 z-50 border-b-2 border-primary-color">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center py-4 lg:py-6">
                        <!-- Logo -->
                        <div class="flex items-center">
                            <a href="{{ route('home') }}" class="flex items-center text-2xl lg:text-3xl font-bold text-primary-color hover:text-secondary-color transition-colors">
                                @if(isset($siteSettings['site_logo']) && $siteSettings['site_logo'])
                                    <img src="{{ asset('storage/' . $siteSettings['site_logo']) }}" alt="{{ $siteSettings['company_name'] ?? config('app.name') }}" class="h-8 lg:h-10 mr-3 object-contain">
                                @else
                                    <i class="fas fa-cogs mr-2 logo-icon"></i>
                                @endif
                                {{ $siteSettings['company_name'] ?? config('app.name', 'Laravel') }}
                            </a>
                        </div>

                        <!-- Desktop Navigation -->
                        <nav class="hidden lg:flex items-center space-x-2">
                            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'nav-link-active' : '' }}">
                                <i class="fas fa-home mr-2"></i>
                                <span>Home</span>
                            </a>
                            <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'nav-link-active' : '' }}">
                                <i class="fas fa-boxes mr-2"></i>
                                <span>Products</span>
                            </a>
                            <a href="{{ route('about.index') }}" class="nav-link {{ request()->routeIs('about.*') ? 'nav-link-active' : '' }}">
                                <i class="fas fa-info-circle mr-2"></i>
                                <span>About</span>
                            </a>
                            <a href="{{ route('contact.index') }}" class="nav-link {{ request()->routeIs('contact.*') ? 'nav-link-active' : '' }}">
                                <i class="fas fa-envelope mr-2"></i>
                                <span>Contact</span>
                            </a>
                            <a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog.*') ? 'nav-link-active' : '' }}">
                                <i class="fas fa-blog mr-2"></i>
                                <span>Blog</span>
                            </a>
                            <a href="{{ route('testimonials.index') }}" class="nav-link {{ request()->routeIs('testimonials.*') ? 'nav-link-active' : '' }}">
                                <i class="fas fa-comments mr-2"></i>
                                <span>Reviews</span>
                            </a>
                        </nav>

                        <!-- Right Side Actions -->
                        <div class="flex items-center space-x-3">
                            <!-- Quote Button -->
                            <button onclick="openQuoteModal()" class="hidden sm:flex items-center bg-primary-color hover:bg-secondary-color text-white px-4 py-2 rounded-lg font-semibold text-sm transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg">
                                <i class="fas fa-quote-left mr-2"></i>
                                <span class="hidden md:inline">Get Quote</span>
                                <span class="md:hidden">Quote</span>
                            </button>

                            <!-- Mobile Menu Toggle -->
                            <button id="mobile-menu-toggle" class="lg:hidden focus:outline-none p-2 rounded-lg hover:bg-gray-100 transition-colors">
                                <i class="fas fa-bars text-2xl text-gray-700"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="lg:hidden hidden bg-white shadow-xl border-t-2 border-primary-color">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <nav class="flex flex-col space-y-2">
                        <!-- Mobile Navigation Links -->
                        <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'mobile-nav-link-active' : '' }}">
                            <i class="fas fa-home text-lg mr-3"></i>
                            <span>Home</span>
                            @if(request()->routeIs('home'))
                                <i class="fas fa-chevron-right ml-auto text-primary-color"></i>
                            @endif
                        </a>

                        <a href="{{ route('products.index') }}" class="mobile-nav-link {{ request()->routeIs('products.*') ? 'mobile-nav-link-active' : '' }}">
                            <i class="fas fa-boxes text-lg mr-3"></i>
                            <span>Products</span>
                            @if(request()->routeIs('products.*'))
                                <i class="fas fa-chevron-right ml-auto text-primary-color"></i>
                            @endif
                        </a>

                        <a href="{{ route('about.index') }}" class="mobile-nav-link {{ request()->routeIs('about.*') ? 'mobile-nav-link-active' : '' }}">
                            <i class="fas fa-info-circle text-lg mr-3"></i>
                            <span>About</span>
                            @if(request()->routeIs('about.*'))
                                <i class="fas fa-chevron-right ml-auto text-primary-color"></i>
                            @endif
                        </a>

                        <a href="{{ route('contact.index') }}" class="mobile-nav-link {{ request()->routeIs('contact.*') ? 'mobile-nav-link-active' : '' }}">
                            <i class="fas fa-envelope text-lg mr-3"></i>
                            <span>Contact</span>
                            @if(request()->routeIs('contact.*'))
                                <i class="fas fa-chevron-right ml-auto text-primary-color"></i>
                            @endif
                        </a>

                        <a href="{{ route('blog.index') }}" class="mobile-nav-link {{ request()->routeIs('blog.*') ? 'mobile-nav-link-active' : '' }}">
                            <i class="fas fa-blog text-lg mr-3"></i>
                            <span>Blog</span>
                            @if(request()->routeIs('blog.*'))
                                <i class="fas fa-chevron-right ml-auto text-primary-color"></i>
                            @endif
                        </a>

                        <a href="{{ route('testimonials.index') }}" class="mobile-nav-link {{ request()->routeIs('testimonials.*') ? 'mobile-nav-link-active' : '' }}">
                            <i class="fas fa-comments text-lg mr-3"></i>
                            <span>Reviews</span>
                            @if(request()->routeIs('testimonials.*'))
                                <i class="fas fa-chevron-right ml-auto text-primary-color"></i>
                            @endif
                        </a>

                        <!-- Mobile Action Buttons -->
                        <div class="pt-4 mt-4 border-t border-gray-200 space-y-3">
                            <button onclick="openQuoteModal()" class="w-full flex items-center justify-center bg-primary-color hover:bg-secondary-color text-white px-4 py-3 rounded-lg font-semibold text-base transition-all duration-200 transform hover:scale-105 shadow-md">
                                <i class="fas fa-quote-left mr-2"></i>
                                <span>Get a Quote</span>
                            </button>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-gray-800 text-white py-12">
                <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 xl:px-12">
                    <div class="footer-grid">
                        <div>
                            <h3 class="text-xl font-semibold mb-4">{{ $siteSettings['company_name'] ?? config('app.name', 'Laravel') }}</h3>
                            <p class="text-gray-400 mb-6">
                                {{ $siteSettings['about_us_content'] ?? 'Quality compressors, generators, and power solutions for all your industrial and commercial needs.' }}
                            </p>

                            <!-- Payment Methods -->
                            <div>
                                <h4 class="text-sm font-semibold mb-3 text-gray-300">We Accept</h4>
                                <div class="flex flex-wrap gap-2">
                                    <!-- Visa -->
                                    <div class="bg-white rounded p-1 w-12 h-8 flex items-center justify-center">
                                        <svg viewBox="0 0 40 24" class="w-8 h-5">
                                            <path fill="#1434CB" d="M16.283 12.853l1.313-8.1h2.096l-1.313 8.1h-2.096zm11.694-7.94c-.417-.156-1.073-.323-1.896-.323-2.096 0-3.573 1.093-3.583 2.656-.01.948.864 1.479 1.521 1.792.677.323 1.906.531 1.906 1.823-.01.198-.24.406-.76.406-.51 0-.781-.073-1.198-.25l-.167-.078-.177 1.073c.49.219 1.396.406 2.344.406 2.23 0 3.677-1.083 3.687-2.76.01-.75-.458-1.323-1.469-1.792-.615-.302-.99-.51-.99-.823 0-.281.323-.583.99-.583.563-.01 1.073.115 1.427.25l.167.073.177-1.063-.01.01zm5.208-2.16h-1.615c-.5 0-.875.135-1.094.646l-3.104 7.26h2.23s.365-.99.448-1.208h2.75c.063.281.26 1.208.26 1.208h1.969l-1.719-7.906h-.125zm-2.656 5.156c.177-.458.844-2.24.844-2.24-.01.021.177-.469.281-.771l.146.698s.406 1.906.49 2.313h-1.76zm-11.49-5.156l-2.063 5.531-.219-1.104c-.385-1.281-1.583-2.667-2.927-3.365l1.875 7.031h2.25l3.354-8.093h-2.27z"/>
                                            <path fill="#FAA61A" d="M6.647 4.753H2.917l-.031.188c2.667.677 4.427 2.313 5.156 4.281l-.74-3.75c-.125-.5-.49-.656-.969-.719z"/>
                                        </svg>
                                    </div>

                                    <!-- Mastercard -->
                                    <div class="bg-white rounded p-1 w-12 h-8 flex items-center justify-center">
                                        <svg viewBox="0 0 40 24" class="w-8 h-5">
                                            <circle cx="15" cy="12" r="7" fill="#EB001B"/>
                                            <circle cx="25" cy="12" r="7" fill="#F79E1B"/>
                                            <path fill="#FF5F00" d="M22 12c0-2.4-1.2-4.5-3-5.7-1.8 1.2-3 3.3-3 5.7s1.2 4.5 3 5.7c1.8-1.2 3-3.3 3-5.7z"/>
                                        </svg>
                                    </div>

                                    <!-- PayPal -->
                                    <div class="bg-white rounded p-1 w-12 h-8 flex items-center justify-center">
                                        <svg viewBox="0 0 40 24" class="w-8 h-5">
                                            <path fill="#003087" d="M8.533 23.5h-2.4L8.8 4.967h5.733c1.867 0 3.2.4 4 1.2.8.8 1.067 2 .8 3.6-.4 2.533-1.333 4.267-2.8 5.2-1.467.933-3.6 1.4-6.4 1.4H8.533l-.8 7.133zm1.6-9.6h1.6c1.067 0 1.867-.2 2.4-.6.533-.4.867-1.067 1-2 .133-.933 0-1.6-.4-2-.4-.4-1.067-.6-2-.6h-1.6l-1 5.2z"/>
                                            <path fill="#009CDE" d="M18.133 23.5h-2.4l2.667-18.533h5.733c1.867 0 3.2.4 4 1.2.8.8 1.067 2 .8 3.6-.4 2.533-1.333 4.267-2.8 5.2-1.467.933-3.6 1.4-6.4 1.4h-1.6l-.8 7.133zm1.6-9.6h1.6c1.067 0 1.867-.2 2.4-.6.533-.4.867-1.067 1-2 .133-.933 0-1.6-.4-2-.4-.4-1.067-.6-2-.6h-1.6l-1 5.2z"/>
                                        </svg>
                                    </div>

                                    <!-- Apple Pay -->
                                    <div class="bg-white rounded p-1 w-12 h-8 flex items-center justify-center">
                                        <svg viewBox="0 0 40 24" class="w-8 h-5">
                                            <path fill="#000" d="M12.533 7.2c-.267-1.6.667-3.2 1.733-4.267 1.067-1.067 2.8-1.867 4.4-1.733.133 1.6-.533 3.2-1.467 4.267-1.067 1.067-2.667 1.867-4.667 1.733zm.4 1.333c2.533-.133 4.667 1.333 5.867 1.333 1.2 0 3.733-1.6 6.267-1.467 1.067.067 4.133.4 6.133 3.2-.133.133-3.6 2.133-3.467 6.4.133 5.067 4.4 6.8 4.533 6.8-.067.133-.667 2.4-2.267 4.8-1.333 2-2.8 4-5.067 4-2.133 0-2.8-1.333-5.333-1.333-2.4 0-3.2 1.4-5.2 1.333-2.133-.067-3.867-2.133-5.2-4.133-2.8-4.133-4.933-11.733-2.067-16.8 1.4-2.533 4-4.133 6.8-4.133z"/>
                                        </svg>
                                    </div>

                                    <!-- Google Pay -->
                                    <div class="bg-white rounded p-1 w-12 h-8 flex items-center justify-center">
                                        <svg viewBox="0 0 40 24" class="w-8 h-5">
                                            <path fill="#4285F4" d="M19.533 12c0-.8-.067-1.533-.2-2.267H10v4.267h5.467c-.233 1.267-.933 2.333-2 3.067v2.533h3.2c1.867-1.733 2.867-4.267 2.867-7.6z"/>
                                            <path fill="#34A853" d="M10 20c2.7 0 4.967-.9 6.633-2.4l-3.2-2.533c-.9.6-2.067.967-3.433.967-2.633 0-4.867-1.8-5.667-4.2H1v2.6C2.667 17.2 6.067 20 10 20z"/>
                                            <path fill="#FBBC04" d="M4.333 11.833c-.2-.6-.333-1.267-.333-1.933s.133-1.333.333-1.933V5.367H1C.367 6.633 0 8.267 0 10s.367 3.367 1 4.633l3.333-2.8z"/>
                                            <path fill="#EA4335" d="M10 4c1.467 0 2.8.5 3.833 1.5l2.867-2.867C14.967 1.067 12.7 0 10 0 6.067 0 2.667 2.8 1 6.567l3.333 2.8C5.133 5.8 7.367 4 10 4z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                            <ul class="space-y-2">
                                <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors">Home</a></li>
                                <li><a href="{{ route('products.index') }}" class="text-gray-400 hover:text-white transition-colors">Products</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-white transition-colors">About Us</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
                            <ul class="space-y-3 text-gray-400">
                                @if(isset($siteSettings['company_address']) && $siteSettings['company_address'])
                                    <li class="flex items-start">
                                        <i class="fas fa-map-marker-alt mr-3 mt-1 text-primary-color"></i>
                                        <span>{!! nl2br(e($siteSettings['company_address'])) !!}</span>
                                    </li>
                                @endif
                                @if(isset($siteSettings['company_phone']) && $siteSettings['company_phone'])
                                    <li class="flex items-center">
                                        <i class="fas fa-phone mr-3 text-primary-color"></i>
                                        <a href="tel:{{ $siteSettings['company_phone'] }}" class="hover:text-white transition-colors">{{ $siteSettings['company_phone'] }}</a>
                                    </li>
                                @endif
                                @if(isset($siteSettings['company_email']) && $siteSettings['company_email'])
                                    <li class="flex items-center">
                                        <i class="fas fa-envelope mr-3 text-primary-color"></i>
                                        <a href="mailto:{{ $siteSettings['company_email'] }}" class="hover:text-white transition-colors">{{ $siteSettings['company_email'] }}</a>
                                    </li>
                                @endif
                                @if(isset($siteSettings['delivery_nationwide']) && $siteSettings['delivery_nationwide'])
                                    <li class="flex items-center">
                                        <i class="fas fa-truck mr-3 text-primary-color"></i>
                                        <span class="text-sm">Nationwide Delivery Available</span>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
                            <p class="text-gray-400 mb-4 text-sm">Subscribe to our newsletter for updates and special offers</p>
                            <form id="footer-newsletter-form" action="{{ route('newsletters.store') }}" method="POST" class="space-y-3">
                                @csrf
                                <div class="flex">
                                    <input type="email" name="email" id="footer-newsletter-email" placeholder="Your email" required
                                           class="px-3 py-2 w-full rounded-l-md focus:outline-none text-gray-800 text-sm border border-gray-300">
                                    <button type="submit" id="footer-newsletter-btn" class="bg-primary-color hover:bg-secondary-color px-4 py-2 rounded-r-md transition-colors">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                                <div id="footer-newsletter-message" class="hidden"></div>
                                <p class="text-xs text-gray-500">We respect your privacy. Unsubscribe at any time.</p>
                            </form>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-4">Our Branches</h3>
                            @if($branches->count() > 0)
                                <ul class="space-y-3 text-gray-400">
                                    @foreach($branches->take(2) as $branch)
                                        <li class="flex items-start">
                                            <i class="fas fa-building mr-2 mt-1 text-primary-color text-sm"></i>
                                            <div>
                                                <div class="font-medium text-gray-300 text-sm">{{ $branch->name }}</div>
                                                <div class="text-xs">{{ $branch->city }}@if($branch->province), {{ $branch->province }}@endif</div>
                                                @if($branch->phone)
                                                    <div class="text-xs mt-1">
                                                        <a href="tel:{{ $branch->phone }}" class="hover:text-white transition-colors">{{ $branch->phone }}</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                    @if($branches->count() > 2)
                                        <li class="text-xs">
                                            <a href="#" class="text-primary-color hover:text-white transition-colors">
                                                View all {{ $branches->count() }} branches →
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            @else
                                <div class="text-gray-400 text-sm space-y-3">
                                    <div>
                                        <p class="font-medium text-gray-300">Cape Town</p>
                                        <p class="text-xs">45 Industrial Road</p>
                                        <p class="text-xs">+27 21 555 0123</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-300">Johannesburg</p>
                                        <p class="text-xs">123 Industrial Ave</p>
                                        <p class="text-xs">+27 11 123 4567</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="border-t border-gray-700 mt-8 pt-8">
                        <!-- Single Row - Copyright, Legal Links, and Social -->
                        <div class="flex flex-col lg:flex-row justify-between items-center space-y-4 lg:space-y-0">
                            <!-- Left - Copyright -->
                            <p class="text-gray-400">© {{ date('Y') }} {{ $siteSettings['company_name'] ?? config('app.name', 'Laravel') }}. All rights reserved.</p>

                            <!-- Right - Legal Links and Social Media -->
                            <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-8">
                                <!-- Legal Links -->
                                <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-y-0 sm:space-x-6">
                                    <a href="{{ route('legal.privacy') }}" class="text-gray-400 hover:text-white transition-colors text-sm">
                                        <i class="fas fa-shield-alt mr-2"></i>Privacy Policy
                                    </a>
                                    <a href="{{ route('legal.warranty') }}" class="text-gray-400 hover:text-white transition-colors text-sm">
                                        <i class="fas fa-certificate mr-2"></i>Warranty
                                    </a>
                                    <a href="{{ route('legal.terms') }}" class="text-gray-400 hover:text-white transition-colors text-sm">
                                        <i class="fas fa-file-contract mr-2"></i>Terms
                                    </a>
                                </div>

                                <!-- Social Media Icons -->
                                <div class="flex space-x-4">
                                    <a href="#" class="text-gray-400 hover:text-white transition-colors" title="Facebook">
                                        <i class="fab fa-facebook-f text-xl"></i>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-white transition-colors" title="X (Twitter)">
                                        <i class="fab fa-x-twitter text-xl"></i>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-white transition-colors" title="LinkedIn">
                                        <i class="fab fa-linkedin-in text-xl"></i>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-white transition-colors" title="Instagram">
                                        <i class="fab fa-instagram text-xl"></i>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-white transition-colors" title="WhatsApp">
                                        <i class="fab fa-whatsapp text-xl"></i>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-white transition-colors" title="TikTok">
                                        <i class="fab fa-tiktok text-xl"></i>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-white transition-colors" title="YouTube">
                                        <i class="fab fa-youtube text-xl"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Floating WhatsApp Button -->
        @if(isset($siteSettings['whatsapp_enabled']) && $siteSettings['whatsapp_enabled'] && isset($siteSettings['whatsapp_number']) && $siteSettings['whatsapp_number'])
            <div id="whatsapp-float" class="fixed bottom-6 left-6 z-40 group">
                <!-- Main WhatsApp Button -->
                <a href="https://wa.me/{{ str_replace(['+', ' ', '-', '(', ')'], '', $siteSettings['whatsapp_number']) }}?text=Hi%20there!%20I%20have%20a%20question%20about%20your%20services."
                   target="_blank" rel="noopener noreferrer"
                   class="flex items-center justify-center w-14 h-14 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 animate-pulse">
                    <i class="fab fa-whatsapp text-2xl"></i>
                </a>

                <!-- Tooltip -->
                <div class="absolute left-16 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded-lg text-sm whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                    Chat with us on WhatsApp
                    <div class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-1 w-0 h-0 border-t-4 border-b-4 border-r-4 border-transparent border-r-gray-800"></div>
                </div>

                <!-- Notification Badge (optional) -->
                <div class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full flex items-center justify-center">
                    <span class="text-white text-xs font-bold">1</span>
                </div>
            </div>
        @endif

        <!-- Quote Modal -->
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden" id="quote-modal">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-bold text-gray-800">Get a Free Quote</h3>
                        <button class="text-gray-500 hover:text-gray-700 focus:outline-none" id="close-modal">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <!-- AJAX Message Container -->
                    <div id="global-quote-message" class="hidden mb-4"></div>

                    <form id="global-quote-form" action="{{ route('quote-requests.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color" required>
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700 font-medium mb-2">Phone</label>
                            <input type="tel" id="phone" name="phone" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color" required>
                        </div>
                        <div class="mb-4">
                            <label for="company" class="block text-gray-700 font-medium mb-2">Company Name (Optional)</label>
                            <input type="text" id="company" name="company" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Product Interest</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="product_interest[]" value="compressors" class="mr-2 text-primary-color focus:ring-primary-color">
                                    Air Compressors
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="product_interest[]" value="generators" class="mr-2 text-primary-color focus:ring-primary-color">
                                    Generators
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="product_interest[]" value="inverters" class="mr-2 text-primary-color focus:ring-primary-color">
                                    Inverters
                                </label>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                            <textarea id="message" name="message" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color" placeholder="Tell us about your requirements..."></textarea>
                        </div>
                        <button type="submit" id="global-quote-submit-btn" class="w-full bg-primary-color hover:bg-secondary-color text-white font-bold py-3 px-4 rounded-md transition">Submit Request</button>
                    </form>
                </div>
            </div>
        </div>

        @stack('scripts')

        <!-- Global JavaScript -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Mobile Menu Toggle
                const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
                const mobileMenu = document.getElementById('mobile-menu');

                if (mobileMenuToggle && mobileMenu) {
                    mobileMenuToggle.addEventListener('click', function() {
                        mobileMenu.classList.toggle('hidden');
                    });
                }

                // Quote Modal Functionality
                const quoteModal = document.getElementById('quote-modal');
                const closeModal = document.getElementById('close-modal');

                // Close modal function
                function closeQuoteModal() {
                    if (quoteModal) {
                        quoteModal.classList.add('hidden');
                        document.body.style.overflow = 'auto';

                        // Clear any messages and form errors when closing
                        const messageDiv = document.getElementById('global-quote-message');
                        const form = document.getElementById('global-quote-form');
                        if (messageDiv) messageDiv.className = 'hidden';
                        if (form) clearGlobalQuoteFormErrors(form);
                    }
                }

                // Open modal function
                window.openQuoteModal = function() {
                    if (quoteModal) {
                        quoteModal.classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                    }
                };

                // Close modal event listeners
                if (closeModal) {
                    closeModal.addEventListener('click', closeQuoteModal);
                }

                // Close modal when clicking outside
                if (quoteModal) {
                    quoteModal.addEventListener('click', function(e) {
                        if (e.target === quoteModal) {
                            closeQuoteModal();
                        }
                    });
                }

                // Close modal with Escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        closeQuoteModal();
                    }
                });

                // Initialize global quote form AJAX
                initGlobalQuoteForm();

                // WhatsApp Floating Button Enhancement
                const whatsappFloat = document.getElementById('whatsapp-float');
                if (whatsappFloat) {
                    // Add entrance animation after page load
                    setTimeout(() => {
                        whatsappFloat.classList.add('animate-bounce');
                        setTimeout(() => {
                            whatsappFloat.classList.remove('animate-bounce');
                        }, 2000);
                    }, 1000);

                    // Add click tracking (optional)
                    const whatsappLink = whatsappFloat.querySelector('a');
                    if (whatsappLink) {
                        whatsappLink.addEventListener('click', function() {
                            // Track WhatsApp button clicks (you can integrate with analytics)
                            console.log('WhatsApp button clicked');

                            // Optional: Show a brief success message
                            const tooltip = whatsappFloat.querySelector('.absolute.left-16');
                            if (tooltip) {
                                const originalText = tooltip.textContent;
                                tooltip.textContent = 'Opening WhatsApp...';
                                setTimeout(() => {
                                    tooltip.textContent = originalText;
                                }, 2000);
                            }
                        });
                    }

                    // Hide/show on scroll (modern UX pattern)
                    let lastScrollTop = 0;
                    window.addEventListener('scroll', function() {
                        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                        if (scrollTop > lastScrollTop && scrollTop > 100) {
                            // Scrolling down - hide button
                            whatsappFloat.style.transform = 'translateX(-100px)';
                            whatsappFloat.style.opacity = '0.7';
                        } else {
                            // Scrolling up - show button
                            whatsappFloat.style.transform = 'translateX(0)';
                            whatsappFloat.style.opacity = '1';
                        }

                        lastScrollTop = scrollTop;
                    });
                }

                // Newsletter AJAX functionality
                initNewsletterForms();
            });

            // Newsletter AJAX Form Handler
            function initNewsletterForms() {
                // Handle Footer Newsletter Form
                const footerForm = document.getElementById('footer-newsletter-form');
                if (footerForm) {
                    footerForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        handleNewsletterSubmission(this, 'footer');
                    });
                }

                // Handle Blog Newsletter Form
                const blogForm = document.getElementById('blog-newsletter-form');
                if (blogForm) {
                    blogForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        handleNewsletterSubmission(this, 'blog');
                    });
                }

                // Handle Unsubscribe Form
                const unsubscribeForm = document.getElementById('unsubscribe-form');
                if (unsubscribeForm) {
                    unsubscribeForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        handleUnsubscribeSubmission(this);
                    });
                }
            }

            // Newsletter Subscription Handler
            function handleNewsletterSubmission(form, type) {
                const emailInput = form.querySelector('input[name="email"]');
                const submitBtn = form.querySelector('button[type="submit"]');
                const messageDiv = form.querySelector(`#${type}-newsletter-message`);

                // Clear previous messages
                messageDiv.className = 'hidden';
                emailInput.classList.remove('border-red-500', 'border-green-500');

                // Validate email
                const email = emailInput.value.trim();
                if (!email || !isValidEmail(email)) {
                    showMessage(messageDiv, 'Please enter a valid email address.', 'error');
                    emailInput.classList.add('border-red-500');
                    return;
                }

                // Show loading state
                const originalBtnContent = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Subscribing...';
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
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showMessage(messageDiv, data.message, 'success');
                        emailInput.classList.add('border-green-500');
                        emailInput.value = ''; // Clear the form

                        // Show success alert
                        alert('✅ Success!\n\n' + data.message);
                    } else {
                        showMessage(messageDiv, data.message || 'An error occurred. Please try again.', 'error');
                        emailInput.classList.add('border-red-500');

                        // Show error alert
                        alert('❌ Error!\n\n' + (data.message || 'An error occurred. Please try again.'));
                    }
                })
                .catch(error => {
                    console.error('Newsletter subscription error:', error);
                    showMessage(messageDiv, 'An error occurred. Please try again.', 'error');
                    emailInput.classList.add('border-red-500');

                    // Show error alert
                    alert('❌ Error!\n\nAn error occurred while subscribing to the newsletter. Please try again.');
                })
                .finally(() => {
                    // Restore button state
                    submitBtn.innerHTML = originalBtnContent;
                    submitBtn.disabled = false;
                });
            }

            // Unsubscribe Handler
            function handleUnsubscribeSubmission(form) {
                const submitBtn = form.querySelector('button[type="submit"]');
                const messageDiv = form.querySelector('#unsubscribe-message');

                // Show loading state
                const originalBtnContent = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
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
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showMessage(messageDiv, data.message, 'success');
                        // Hide the form after successful unsubscribe
                        setTimeout(() => {
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            }
                        }, 2000);
                    } else {
                        showMessage(messageDiv, data.message || 'An error occurred. Please try again.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Unsubscribe error:', error);
                    showMessage(messageDiv, 'An error occurred. Please try again.', 'error');
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

                messageDiv.className = `${bgColor} ${textColor} border ${borderColor} rounded-lg p-3 text-sm`;
                messageDiv.innerHTML = `
                    <div class="flex items-center">
                        <i class="${icon} mr-2"></i>
                        <span>${message}</span>
                    </div>
                `;

                // Auto-hide success messages after 5 seconds
                if (!isError) {
                    setTimeout(() => {
                        messageDiv.className = 'hidden';
                    }, 5000);
                }
            }

            // Global Quote Form AJAX Handler
            function initGlobalQuoteForm() {
                const globalQuoteForm = document.getElementById('global-quote-form');
                if (globalQuoteForm) {
                    globalQuoteForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        handleGlobalQuoteSubmission(this);
                    });
                }
            }

            // Global Quote Form Submission Handler
            function handleGlobalQuoteSubmission(form) {
                const submitBtn = form.querySelector('#global-quote-submit-btn');
                const messageDiv = document.getElementById('global-quote-message');

                // Clear previous messages and errors
                messageDiv.className = 'hidden';
                clearGlobalQuoteFormErrors(form);

                // Validate required fields
                const requiredFields = form.querySelectorAll('[required]');
                let hasErrors = false;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        showGlobalQuoteFieldError(field, 'This field is required.');
                        hasErrors = true;
                    } else if (field.type === 'email' && !isValidEmail(field.value)) {
                        showGlobalQuoteFieldError(field, 'Please enter a valid email address.');
                        hasErrors = true;
                    }
                });

                if (hasErrors) {
                    showGlobalQuoteMessage(messageDiv, 'Please correct the errors below.', 'error');
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
                        showGlobalQuoteMessage(messageDiv, data.message, 'success');
                        form.reset(); // Clear the form
                        clearGlobalQuoteFormErrors(form);

                        // Show success alert
                        alert('✅ Success!\n\n' + data.message);

                        // Auto-close modal after alert
                        closeQuoteModal();
                    } else {
                        showGlobalQuoteMessage(messageDiv, data.message || 'An error occurred. Please try again.', 'error');

                        // Show error alert
                        alert('❌ Error!\n\n' + (data.message || 'An error occurred. Please try again.'));
                    }
                })
                .catch(error => {
                    console.error('Global quote form error:', error);

                    // Handle validation errors
                    if (error.errors) {
                        Object.keys(error.errors).forEach(field => {
                            const fieldElement = form.querySelector(`[name="${field}"]`);
                            if (fieldElement) {
                                showGlobalQuoteFieldError(fieldElement, error.errors[field][0]);
                            }
                        });
                        showGlobalQuoteMessage(messageDiv, 'Please correct the errors below.', 'error');

                        // Show validation error alert
                        alert('❌ Validation Error!\n\nPlease correct the errors in the form and try again.');
                    } else {
                        showGlobalQuoteMessage(messageDiv, error.message || 'An error occurred. Please try again.', 'error');

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

            // Global Quote Form Utility Functions
            function showGlobalQuoteMessage(messageDiv, message, type) {
                const isError = type === 'error';
                const bgColor = isError ? 'bg-red-100' : 'bg-green-100';
                const textColor = isError ? 'text-red-800' : 'text-green-800';
                const borderColor = isError ? 'border-red-200' : 'border-green-200';
                const icon = isError ? 'fas fa-exclamation-circle' : 'fas fa-check-circle';

                messageDiv.className = `${bgColor} ${textColor} border ${borderColor} rounded-lg p-3 mb-4`;
                messageDiv.innerHTML = `
                    <div class="flex items-center">
                        <i class="${icon} mr-2"></i>
                        <span class="font-medium">${message}</span>
                    </div>
                `;
            }

            function showGlobalQuoteFieldError(field, message) {
                // Add error styling to field
                field.classList.add('border-red-500');
                field.classList.remove('border-gray-300');

                // Remove existing error message
                const existingError = field.parentNode.querySelector('.global-quote-field-error');
                if (existingError) {
                    existingError.remove();
                }

                // Add error message
                const errorDiv = document.createElement('p');
                errorDiv.className = 'text-red-500 text-sm mt-1 global-quote-field-error';
                errorDiv.textContent = message;
                field.parentNode.appendChild(errorDiv);
            }

            function clearGlobalQuoteFormErrors(form) {
                // Remove error styling from all fields
                const fields = form.querySelectorAll('input, select, textarea');
                fields.forEach(field => {
                    field.classList.remove('border-red-500');
                    field.classList.add('border-gray-300');
                });

                // Remove all error messages
                const errorMessages = form.querySelectorAll('.global-quote-field-error');
                errorMessages.forEach(error => error.remove());
            }
        </script>
    </body>
</html>
