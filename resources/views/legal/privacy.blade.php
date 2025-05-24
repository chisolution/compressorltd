@extends('layouts.front')

@section('title', 'Privacy Policy - ' . ($siteSettings['company_name'] ?? config('app.name')))

@section('content')
    <!-- Page Title Section -->
    <div class="bg-gradient-to-r from-primary-color to-secondary-color text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Privacy Policy</h1>
                <p class="text-xl md:text-2xl text-blue-100 mb-6">How we protect and handle your personal information</p>
                <div class="flex items-center justify-center space-x-2 text-blue-100">
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                    <i class="fas fa-chevron-right text-sm"></i>
                    <span>Privacy Policy</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Privacy Policy Content -->
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

            <!-- Introduction -->
            <div class="prose prose-lg max-w-none">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Introduction</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    {{ $siteSettings['company_name'] ?? 'Our Company' }} ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our services. Please read this privacy policy carefully. If you do not agree with the terms of this privacy policy, please do not access the site.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Information We Collect</h2>
                
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Personal Information</h3>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    We may collect personal information that you voluntarily provide to us when you:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-6 space-y-2">
                    <li>Fill out contact forms or request quotes</li>
                    <li>Subscribe to our newsletter</li>
                    <li>Create an account on our website</li>
                    <li>Make inquiries about our products or services</li>
                    <li>Participate in surveys or promotional activities</li>
                </ul>

                <p class="text-gray-600 mb-6 leading-relaxed">
                    This information may include:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-6 space-y-2">
                    <li>Name and contact information (email address, phone number, postal address)</li>
                    <li>Company name and job title</li>
                    <li>Product preferences and requirements</li>
                    <li>Communication preferences</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-900 mb-3">Automatically Collected Information</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    When you visit our website, we may automatically collect certain information about your device and usage patterns, including:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-6 space-y-2">
                    <li>IP address and browser type</li>
                    <li>Operating system and device information</li>
                    <li>Pages visited and time spent on our site</li>
                    <li>Referring website and search terms used</li>
                    <li>Cookies and similar tracking technologies</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">How We Use Your Information</h2>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    We use the information we collect for various purposes, including:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-6 space-y-2">
                    <li>Responding to your inquiries and providing customer support</li>
                    <li>Processing quote requests and providing product information</li>
                    <li>Sending newsletters and marketing communications (with your consent)</li>
                    <li>Improving our website and services</li>
                    <li>Analyzing website usage and performance</li>
                    <li>Complying with legal obligations</li>
                    <li>Protecting against fraud and security threats</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Information Sharing and Disclosure</h2>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except in the following circumstances:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-6 space-y-2">
                    <li><strong>Service Providers:</strong> We may share information with trusted third-party service providers who assist us in operating our website and conducting our business</li>
                    <li><strong>Legal Requirements:</strong> We may disclose information when required by law or to protect our rights, property, or safety</li>
                    <li><strong>Business Transfers:</strong> In the event of a merger, acquisition, or sale of assets, your information may be transferred</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Data Security</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    We implement appropriate technical and organizational security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the internet or electronic storage is 100% secure, and we cannot guarantee absolute security.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Cookies and Tracking Technologies</h2>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    Our website uses cookies and similar tracking technologies to enhance your browsing experience. Cookies are small data files stored on your device that help us:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-6 space-y-2">
                    <li>Remember your preferences and settings</li>
                    <li>Analyze website traffic and usage patterns</li>
                    <li>Provide personalized content and advertisements</li>
                    <li>Improve website functionality and performance</li>
                </ul>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    You can control cookie settings through your browser preferences, but disabling cookies may affect website functionality.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Your Rights and Choices</h2>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    Depending on your location, you may have certain rights regarding your personal information, including:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-6 space-y-2">
                    <li><strong>Access:</strong> Request access to your personal information</li>
                    <li><strong>Correction:</strong> Request correction of inaccurate or incomplete information</li>
                    <li><strong>Deletion:</strong> Request deletion of your personal information</li>
                    <li><strong>Portability:</strong> Request a copy of your information in a portable format</li>
                    <li><strong>Opt-out:</strong> Unsubscribe from marketing communications</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Children's Privacy</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Our website and services are not intended for children under the age of 13. We do not knowingly collect personal information from children under 13. If we become aware that we have collected personal information from a child under 13, we will take steps to delete such information.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Changes to This Privacy Policy</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    We may update this Privacy Policy from time to time to reflect changes in our practices or applicable laws. We will notify you of any material changes by posting the updated policy on our website and updating the "Last Updated" date. Your continued use of our website after such changes constitutes acceptance of the updated policy.
                </p>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Contact Information</h2>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    If you have any questions about this Privacy Policy or our privacy practices, please contact us:
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
                </div>
            </div>
        </div>
    </div>
@endsection
