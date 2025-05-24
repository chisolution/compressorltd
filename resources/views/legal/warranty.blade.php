@extends('layouts.front')

@section('title', 'Warranty Information - ' . ($siteSettings['company_name'] ?? config('app.name')))

@section('content')
    <!-- Page Title Section -->
    <div class="bg-gradient-to-r from-primary-color to-secondary-color text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Warranty Information</h1>
                <p class="text-xl md:text-2xl text-blue-100 mb-6">Comprehensive warranty coverage for your peace of mind</p>
                <div class="flex items-center justify-center space-x-2 text-blue-100">
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                    <i class="fas fa-chevron-right text-sm"></i>
                    <span>Warranty</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Warranty Overview -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Our Warranty Promise</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    At {{ $siteSettings['company_name'] ?? 'our company' }}, we stand behind the quality of our products with comprehensive warranty coverage that gives you confidence in your investment.
                </p>
            </div>

            <!-- Warranty Features -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-color rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Comprehensive Coverage</h3>
                    <p class="text-gray-600">Full protection against manufacturing defects and component failures</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-color rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-tools text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Expert Service</h3>
                    <p class="text-gray-600">Professional repair and replacement services by certified technicians</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-color rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Fast Response</h3>
                    <p class="text-gray-600">Quick turnaround times to minimize downtime and disruption</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Warranty Details -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg max-w-none">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Warranty Coverage Details</h2>

                <!-- Product Categories -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    <!-- Compressors -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-cogs text-primary-color text-2xl mr-3"></i>
                            <h3 class="text-xl font-bold">Air Compressors</h3>
                        </div>
                        <ul class="space-y-2 text-gray-600">
                            <li><strong>Standard Warranty:</strong> 12-24 months</li>
                            <li><strong>Extended Options:</strong> Up to 5 years available</li>
                            <li><strong>Coverage:</strong> Motor, pump, tank, controls</li>
                            <li><strong>Labor:</strong> Included for first 12 months</li>
                        </ul>
                    </div>

                    <!-- Generators -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-bolt text-primary-color text-2xl mr-3"></i>
                            <h3 class="text-xl font-bold">Generators</h3>
                        </div>
                        <ul class="space-y-2 text-gray-600">
                            <li><strong>Standard Warranty:</strong> 12-36 months</li>
                            <li><strong>Extended Options:</strong> Up to 7 years available</li>
                            <li><strong>Coverage:</strong> Engine, alternator, controls</li>
                            <li><strong>Labor:</strong> Included for first 24 months</li>
                        </ul>
                    </div>

                    <!-- Inverters -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-solar-panel text-primary-color text-2xl mr-3"></i>
                            <h3 class="text-xl font-bold">Power Inverters</h3>
                        </div>
                        <ul class="space-y-2 text-gray-600">
                            <li><strong>Standard Warranty:</strong> 24-60 months</li>
                            <li><strong>Extended Options:</strong> Up to 10 years available</li>
                            <li><strong>Coverage:</strong> Electronics, transformers</li>
                            <li><strong>Labor:</strong> Included for first 12 months</li>
                        </ul>
                    </div>

                    <!-- Accessories -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-puzzle-piece text-primary-color text-2xl mr-3"></i>
                            <h3 class="text-xl font-bold">Parts & Accessories</h3>
                        </div>
                        <ul class="space-y-2 text-gray-600">
                            <li><strong>Standard Warranty:</strong> 6-12 months</li>
                            <li><strong>Extended Options:</strong> Up to 2 years available</li>
                            <li><strong>Coverage:</strong> Manufacturing defects</li>
                            <li><strong>Labor:</strong> Installation support included</li>
                        </ul>
                    </div>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">What's Covered</h2>
                <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-6">
                    <h4 class="font-semibold text-green-800 mb-3">✓ Covered Under Warranty</h4>
                    <ul class="list-disc list-inside text-green-700 space-y-1">
                        <li>Manufacturing defects in materials and workmanship</li>
                        <li>Component failures under normal operating conditions</li>
                        <li>Electrical and mechanical malfunctions</li>
                        <li>Premature wear of covered components</li>
                        <li>Labor costs for authorized repairs (where specified)</li>
                        <li>Replacement parts for covered components</li>
                    </ul>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">What's Not Covered</h2>
                <div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-6">
                    <h4 class="font-semibold text-red-800 mb-3">✗ Not Covered Under Warranty</h4>
                    <ul class="list-disc list-inside text-red-700 space-y-1">
                        <li>Damage due to misuse, abuse, or negligence</li>
                        <li>Normal wear and tear items (filters, belts, oil)</li>
                        <li>Damage from improper installation or maintenance</li>
                        <li>Environmental damage (corrosion, flooding, etc.)</li>
                        <li>Modifications or unauthorized repairs</li>
                        <li>Consequential or incidental damages</li>
                        <li>Transportation costs (unless specified)</li>
                    </ul>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Warranty Registration</h2>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    To ensure your warranty coverage is active, please register your product within 30 days of purchase. Registration helps us:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-6 space-y-2">
                    <li>Maintain accurate records of your purchase</li>
                    <li>Provide faster warranty service</li>
                    <li>Send important product updates and recalls</li>
                    <li>Offer extended warranty options</li>
                </ul>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                    <h4 class="font-semibold text-blue-800 mb-3">Required Information for Registration</h4>
                    <ul class="list-disc list-inside text-blue-700 space-y-1">
                        <li>Product model and serial number</li>
                        <li>Purchase date and dealer information</li>
                        <li>Installation date and location</li>
                        <li>Customer contact information</li>
                    </ul>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Making a Warranty Claim</h2>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    If you need to make a warranty claim, follow these simple steps:
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-primary-color rounded-full flex items-center justify-center mr-4 mt-1 flex-shrink-0">
                            <span class="text-white font-bold text-sm">1</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">Contact Us</h4>
                            <p class="text-gray-600 text-sm">Call our warranty hotline or submit an online claim form with your product details.</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-primary-color rounded-full flex items-center justify-center mr-4 mt-1 flex-shrink-0">
                            <span class="text-white font-bold text-sm">2</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">Provide Documentation</h4>
                            <p class="text-gray-600 text-sm">Submit proof of purchase, warranty registration, and description of the issue.</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-primary-color rounded-full flex items-center justify-center mr-4 mt-1 flex-shrink-0">
                            <span class="text-white font-bold text-sm">3</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">Diagnosis & Approval</h4>
                            <p class="text-gray-600 text-sm">Our technicians will diagnose the issue and approve the warranty claim if covered.</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-primary-color rounded-full flex items-center justify-center mr-4 mt-1 flex-shrink-0">
                            <span class="text-white font-bold text-sm">4</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">Repair or Replace</h4>
                            <p class="text-gray-600 text-sm">We'll repair or replace the defective product according to warranty terms.</p>
                        </div>
                    </div>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Extended Warranty Options</h2>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    Protect your investment with our extended warranty plans that provide additional coverage beyond the standard warranty period:
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
                        <h4 class="font-bold text-lg mb-2">Basic Extended</h4>
                        <p class="text-2xl font-bold text-primary-color mb-2">+2 Years</p>
                        <p class="text-gray-600 text-sm">Parts coverage with labor support</p>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
                        <h4 class="font-bold text-lg mb-2">Premium Extended</h4>
                        <p class="text-2xl font-bold text-primary-color mb-2">+5 Years</p>
                        <p class="text-gray-600 text-sm">Full parts and labor coverage</p>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
                        <h4 class="font-bold text-lg mb-2">Comprehensive</h4>
                        <p class="text-2xl font-bold text-primary-color mb-2">+10 Years</p>
                        <p class="text-gray-600 text-sm">Complete coverage with maintenance</p>
                    </div>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Contact Warranty Support</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    For warranty claims, questions, or to register your product, contact our dedicated warranty support team:
                </p>

                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if(isset($siteSettings['company_phone']) && $siteSettings['company_phone'])
                            <div class="flex items-center">
                                <i class="fas fa-phone text-primary-color mr-3"></i>
                                <div>
                                    <div class="font-semibold text-gray-900">Warranty Hotline</div>
                                    <a href="tel:{{ $siteSettings['company_phone'] }}" class="text-primary-color hover:text-secondary-color">
                                        {{ $siteSettings['company_phone'] }}
                                    </a>
                                    <div class="text-xs text-gray-500">Mon-Fri: 8AM-5PM</div>
                                </div>
                            </div>
                        @endif

                        @if(isset($siteSettings['company_email']) && $siteSettings['company_email'])
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-primary-color mr-3"></i>
                                <div>
                                    <div class="font-semibold text-gray-900">Email Support</div>
                                    <a href="mailto:warranty@{{ str_replace(['http://', 'https://', 'www.'], '', $siteSettings['company_email'] ?? 'company.com') }}" class="text-primary-color hover:text-secondary-color">
                                        warranty@{{ str_replace(['http://', 'https://', 'www.'], '', $siteSettings['company_email'] ?? 'company.com') }}
                                    </a>
                                    <div class="text-xs text-gray-500">24/7 Response</div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('contact.index') }}" class="flex-1 bg-primary-color hover:bg-secondary-color text-white px-6 py-3 rounded-lg text-center font-semibold transition-colors">
                                <i class="fas fa-headset mr-2"></i>
                                Contact Support
                            </a>
                            <button onclick="openQuoteModal()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-lg font-semibold transition-colors">
                                <i class="fas fa-file-alt mr-2"></i>
                                Register Product
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
