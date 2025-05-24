@extends('admin.layouts.app')

@section('header', 'Site Settings')

@section('content')
<div class="bg-white rounded-lg shadow-md">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">
            <i class="fas fa-cog mr-2 text-primary-color"></i>
            Site Configuration
        </h2>
        <p class="text-gray-600 mt-1">Manage your website's global settings, branding, and configuration.</p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Column - Basic Settings -->
            <div class="space-y-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                        Basic Information
                    </h3>

                    <!-- Site Title -->
                    <div class="mb-4">
                        <label for="site_title" class="block text-sm font-medium text-gray-700 mb-2">Site Title</label>
                        <input type="text" name="site_title" id="site_title"
                               value="{{ old('site_title', $settings['site_title']->value ?? '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent"
                               required>
                        @error('site_title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Company Name -->
                    <div class="mb-4">
                        <label for="company_name" class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                        <input type="text" name="company_name" id="company_name"
                               value="{{ old('company_name', $settings['company_name']->value ?? '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent"
                               required>
                        @error('company_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Company Tagline -->
                    <div class="mb-4">
                        <label for="company_tagline" class="block text-sm font-medium text-gray-700 mb-2">Company Tagline</label>
                        <input type="text" name="company_tagline" id="company_tagline"
                               value="{{ old('company_tagline', $settings['company_tagline']->value ?? '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent">
                        @error('company_tagline')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Currency Settings -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-money-bill-wave mr-2 text-green-500"></i>
                        Currency Settings
                    </h3>

                    <div class="grid grid-cols-2 gap-4">
                        <!-- Currency Symbol -->
                        <div>
                            <label for="currency_symbol" class="block text-sm font-medium text-gray-700 mb-2">Currency Symbol</label>
                            <input type="text" name="currency_symbol" id="currency_symbol"
                                   value="{{ old('currency_symbol', $settings['currency_symbol']->value ?? 'R') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent"
                                   required>
                            @error('currency_symbol')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Currency Code -->
                        <div>
                            <label for="currency_code" class="block text-sm font-medium text-gray-700 mb-2">Currency Code</label>
                            <input type="text" name="currency_code" id="currency_code"
                                   value="{{ old('currency_code', $settings['currency_code']->value ?? 'ZAR') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent"
                                   required>
                            @error('currency_code')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Delivery Settings -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-truck mr-2 text-blue-500"></i>
                        Delivery Settings
                    </h3>

                    <div class="flex items-center">
                        <input type="checkbox" name="delivery_nationwide" id="delivery_nationwide"
                               value="1" {{ old('delivery_nationwide', $settings['delivery_nationwide']->value ?? false) ? 'checked' : '' }}
                               class="h-4 w-4 text-primary-color focus:ring-primary-color border-gray-300 rounded">
                        <label for="delivery_nationwide" class="ml-2 block text-sm text-gray-700">
                            We deliver nationwide
                        </label>
                    </div>
                </div>
            </div>

            <!-- Right Column - Contact & Media -->
            <div class="space-y-6">
                <!-- Logo & Favicon -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-image mr-2 text-purple-500"></i>
                        Branding
                    </h3>

                    <!-- Site Logo -->
                    <div class="mb-4">
                        <label for="site_logo" class="block text-sm font-medium text-gray-700 mb-2">Site Logo</label>
                        @if(isset($settings['site_logo']) && $settings['site_logo']->value)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $settings['site_logo']->value) }}" alt="Current Logo" class="h-16 object-contain">
                                <p class="text-xs text-gray-500 mt-1">Current logo</p>
                            </div>
                        @endif
                        <input type="file" name="site_logo" id="site_logo" accept="image/*"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-1">Recommended size: 300x100px. Formats: JPG, PNG, SVG</p>
                        @error('site_logo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Site Favicon -->
                    <div class="mb-4">
                        <label for="site_favicon" class="block text-sm font-medium text-gray-700 mb-2">Site Favicon</label>
                        @if(isset($settings['site_favicon']) && $settings['site_favicon']->value)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $settings['site_favicon']->value) }}" alt="Current Favicon" class="h-8 w-8 object-contain">
                                <p class="text-xs text-gray-500 mt-1">Current favicon</p>
                            </div>
                        @endif
                        <input type="file" name="site_favicon" id="site_favicon" accept="image/*"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-1">Will be converted to .ico format. Recommended: 32x32px square image</p>
                        @error('site_favicon')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-address-book mr-2 text-green-500"></i>
                        Contact Information
                    </h3>

                    <!-- Company Phone -->
                    <div class="mb-4">
                        <label for="company_phone" class="block text-sm font-medium text-gray-700 mb-2">Company Phone</label>
                        <input type="text" name="company_phone" id="company_phone"
                               value="{{ old('company_phone', $settings['company_phone']->value ?? '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent">
                        @error('company_phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Company Email -->
                    <div class="mb-4">
                        <label for="company_email" class="block text-sm font-medium text-gray-700 mb-2">Company Email</label>
                        <input type="email" name="company_email" id="company_email"
                               value="{{ old('company_email', $settings['company_email']->value ?? '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent">
                        @error('company_email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Company Address -->
                    <div class="mb-4">
                        <label for="company_address" class="block text-sm font-medium text-gray-700 mb-2">Company Address</label>
                        <textarea name="company_address" id="company_address" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent">{{ old('company_address', $settings['company_address']->value ?? '') }}</textarea>
                        @error('company_address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- WhatsApp Number -->
                    <div class="mb-4">
                        <label for="whatsapp_number" class="block text-sm font-medium text-gray-700 mb-2">
                            WhatsApp Number
                            <span class="text-xs text-gray-500">(Include country code, e.g., +27123456789)</span>
                        </label>
                        <input type="text" name="whatsapp_number" id="whatsapp_number"
                               value="{{ old('whatsapp_number', $settings['whatsapp_number']->value ?? '') }}"
                               placeholder="+27123456789"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent">
                        @error('whatsapp_number')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">This number will be used for the floating WhatsApp button on your website.</p>
                    </div>

                    <!-- WhatsApp Enabled -->
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="checkbox" name="whatsapp_enabled" id="whatsapp_enabled" value="1"
                                   {{ old('whatsapp_enabled', $settings['whatsapp_enabled']->value ?? true) ? 'checked' : '' }}
                                   class="h-4 w-4 text-primary-color focus:ring-primary-color border-gray-300 rounded">
                            <label for="whatsapp_enabled" class="ml-2 block text-sm text-gray-700">
                                Enable floating WhatsApp button
                            </label>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Show a floating WhatsApp button on all pages for easy customer contact.</p>
                    </div>
                </div>

                <!-- About Us Content -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-info mr-2 text-blue-500"></i>
                        About Us Content
                    </h3>

                    <div class="mb-4">
                        <label for="about_us_content" class="block text-sm font-medium text-gray-700 mb-2">About Us Description</label>
                        <textarea name="about_us_content" id="about_us_content" rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent"
                                  placeholder="Brief description about your company for homepage and about page">{{ old('about_us_content', $settings['about_us_content']->value ?? '') }}</textarea>
                        @error('about_us_content')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <div class="flex justify-end">
                <button type="submit" class="bg-primary-color hover:bg-secondary-color text-white px-6 py-3 rounded-lg font-semibold transition-colors duration-200 flex items-center">
                    <i class="fas fa-save mr-2"></i>
                    Save Settings
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
