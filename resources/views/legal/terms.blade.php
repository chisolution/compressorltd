@extends('layouts.front')

@section('title', 'Terms of Service - ' . ($siteSettings['company_name'] ?? config('app.name')))

@section('content')
    <!-- Page Title Section -->
    <div class="bg-gradient-to-r from-primary-color to-secondary-color text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Terms of Service</h1>
                <p class="text-xl md:text-2xl text-blue-100 mb-6">Terms and conditions for using our services</p>
                <div class="flex items-center justify-center space-x-2 text-blue-100">
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                    <i class="fas fa-chevron-right text-sm"></i>
                    <span>Terms of Service</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Terms Content -->
    <div class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Last Updated -->
            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                <div class="flex items-center">
                    <i class="fas fa-calendar-alt text-primary-color mr-3"></i>
                    <div>
                        <h3 class="font-semibold text-gray-900">Last Updated</h3>
                        <p class="text-gray-600">{{ date('F j, Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="prose prose-lg max-w-none">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Agreement to Terms</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    By accessing and using the {{ $siteSettings['company_name'] ?? 'our company' }} website and services, you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Use License</h2>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    Permission is granted to temporarily download one copy of the materials on {{ $siteSettings['company_name'] ?? 'our' }} website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-6 space-y-2">
                    <li>modify or copy the materials</li>
                    <li>use the materials for any commercial purpose or for any public display</li>
                    <li>attempt to reverse engineer any software contained on the website</li>
                    <li>remove any copyright or other proprietary notations from the materials</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Product Information and Pricing</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    We strive to provide accurate product information and pricing. However, we reserve the right to correct any errors, inaccuracies, or omissions and to change or update information at any time without prior notice. All prices are subject to change without notice and are exclusive of applicable taxes unless otherwise stated.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Quote Requests and Orders</h2>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    Quote requests submitted through our website are not binding offers. All quotes are subject to:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-6 space-y-2">
                    <li>Product availability and current pricing</li>
                    <li>Credit approval and payment terms</li>
                    <li>Technical specifications and compatibility</li>
                    <li>Delivery terms and conditions</li>
                    <li>Our standard terms and conditions of sale</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Disclaimer</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    The materials on {{ $siteSettings['company_name'] ?? 'our' }} website are provided on an 'as is' basis. {{ $siteSettings['company_name'] ?? 'Our company' }} makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties including without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Limitations</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    In no event shall {{ $siteSettings['company_name'] ?? 'our company' }} or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on our website, even if {{ $siteSettings['company_name'] ?? 'our company' }} or an authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Technical Support and Services</h2>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    Technical support and services are provided subject to our standard support terms and conditions. Support may include:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-6 space-y-2">
                    <li>Product selection and specification assistance</li>
                    <li>Installation guidance and support</li>
                    <li>Troubleshooting and maintenance advice</li>
                    <li>Warranty and repair services</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Intellectual Property</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    All content on this website, including but not limited to text, graphics, logos, images, and software, is the property of {{ $siteSettings['company_name'] ?? 'our company' }} or its content suppliers and is protected by copyright and other intellectual property laws. You may not reproduce, distribute, or create derivative works from this content without express written permission.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Privacy Policy</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Your privacy is important to us. Please review our Privacy Policy, which also governs your use of the website, to understand our practices regarding the collection and use of your personal information.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Governing Law</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    These terms and conditions are governed by and construed in accordance with the laws of South Africa, and you irrevocably submit to the exclusive jurisdiction of the courts in that state or location.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Changes to Terms</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    {{ $siteSettings['company_name'] ?? 'Our company' }} may revise these terms of service at any time without notice. By using this website, you are agreeing to be bound by the then current version of these terms of service.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Contact Information</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    If you have any questions about these Terms of Service, please contact us:
                </p>

                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if(isset($siteSettings['company_email']) && $siteSettings['company_email'])
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-primary-color mr-3"></i>
                                <div>
                                    <div class="font-semibold text-gray-900">Email</div>
                                    <a href="mailto:{{ $siteSettings['company_email'] }}" class="text-primary-color hover:text-secondary-color">
                                        {{ $siteSettings['company_email'] }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if(isset($siteSettings['company_phone']) && $siteSettings['company_phone'])
                            <div class="flex items-center">
                                <i class="fas fa-phone text-primary-color mr-3"></i>
                                <div>
                                    <div class="font-semibold text-gray-900">Phone</div>
                                    <a href="tel:{{ $siteSettings['company_phone'] }}" class="text-primary-color hover:text-secondary-color">
                                        {{ $siteSettings['company_phone'] }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if(isset($siteSettings['company_address']) && $siteSettings['company_address'])
                            <div class="flex items-start md:col-span-2">
                                <i class="fas fa-map-marker-alt text-primary-color mr-3 mt-1"></i>
                                <div>
                                    <div class="font-semibold text-gray-900">Address</div>
                                    <div class="text-gray-600">{!! nl2br(e($siteSettings['company_address'])) !!}</div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('contact.index') }}" class="flex-1 bg-primary-color hover:bg-secondary-color text-white px-6 py-3 rounded-lg text-center font-semibold transition-colors">
                                <i class="fas fa-envelope mr-2"></i>
                                Contact Us
                            </a>
                            <a href="{{ route('legal.privacy') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-lg text-center font-semibold transition-colors">
                                <i class="fas fa-shield-alt mr-2"></i>
                                Privacy Policy
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
