@extends('admin.layouts.app')

@section('header', 'Add New Branch')

@section('content')
<div class="bg-white rounded-lg shadow-md">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">
            <i class="fas fa-plus mr-2 text-primary-color"></i>
            Create New Branch
        </h2>
        <p class="text-gray-600 mt-1">Add a new branch location to your company network.</p>
    </div>

    <form action="{{ route('admin.branches.store') }}" method="POST" class="p-6">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Column - Basic Information -->
            <div class="space-y-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                        Basic Information
                    </h3>

                    <!-- Branch Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Branch Name *</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent"
                               required placeholder="e.g., Cape Town Branch">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- City -->
                    <div class="mb-4">
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                        <input type="text" name="city" id="city" value="{{ old('city') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent"
                               required placeholder="e.g., Cape Town">
                        @error('city')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Province -->
                    <div class="mb-4">
                        <label for="province" class="block text-sm font-medium text-gray-700 mb-2">Province</label>
                        <select name="province" id="province" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent">
                            <option value="">Select Province</option>
                            <option value="Eastern Cape" {{ old('province') == 'Eastern Cape' ? 'selected' : '' }}>Eastern Cape</option>
                            <option value="Free State" {{ old('province') == 'Free State' ? 'selected' : '' }}>Free State</option>
                            <option value="Gauteng" {{ old('province') == 'Gauteng' ? 'selected' : '' }}>Gauteng</option>
                            <option value="KwaZulu-Natal" {{ old('province') == 'KwaZulu-Natal' ? 'selected' : '' }}>KwaZulu-Natal</option>
                            <option value="Limpopo" {{ old('province') == 'Limpopo' ? 'selected' : '' }}>Limpopo</option>
                            <option value="Mpumalanga" {{ old('province') == 'Mpumalanga' ? 'selected' : '' }}>Mpumalanga</option>
                            <option value="Northern Cape" {{ old('province') == 'Northern Cape' ? 'selected' : '' }}>Northern Cape</option>
                            <option value="North West" {{ old('province') == 'North West' ? 'selected' : '' }}>North West</option>
                            <option value="Western Cape" {{ old('province') == 'Western Cape' ? 'selected' : '' }}>Western Cape</option>
                        </select>
                        @error('province')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address *</label>
                        <textarea name="address" id="address" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent"
                                  required placeholder="Full street address">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Location Coordinates -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-map-pin mr-2 text-red-500"></i>
                        Location Coordinates (Optional)
                    </h3>

                    <div class="grid grid-cols-2 gap-4">
                        <!-- Latitude -->
                        <div>
                            <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                            <input type="number" name="latitude" id="latitude" value="{{ old('latitude') }}" step="any"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent"
                                   placeholder="e.g., -33.8688">
                            @error('latitude')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Longitude -->
                        <div>
                            <label for="longitude" class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                            <input type="number" name="longitude" id="longitude" value="{{ old('longitude') }}" step="any"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent"
                                   placeholder="e.g., 18.4241">
                            @error('longitude')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Used for map integration and location services.</p>
                </div>
            </div>

            <!-- Right Column - Contact & Management -->
            <div class="space-y-6">
                <!-- Contact Information -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-address-book mr-2 text-green-500"></i>
                        Contact Information
                    </h3>

                    <!-- Phone -->
                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent"
                               placeholder="e.g., +27 21 555 0123">
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent"
                               placeholder="e.g., capetown@company.co.za">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Manager Name -->
                    <div class="mb-4">
                        <label for="manager_name" class="block text-sm font-medium text-gray-700 mb-2">Branch Manager</label>
                        <input type="text" name="manager_name" id="manager_name" value="{{ old('manager_name') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent"
                               placeholder="e.g., John Smith">
                        @error('manager_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Operating Hours -->
                    <div class="mb-4">
                        <label for="operating_hours" class="block text-sm font-medium text-gray-700 mb-2">Operating Hours</label>
                        <textarea name="operating_hours" id="operating_hours" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent"
                                  placeholder="e.g., Mon-Fri: 8:00 AM - 5:00 PM, Sat: 8:00 AM - 1:00 PM">{{ old('operating_hours') }}</textarea>
                        @error('operating_hours')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Settings -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-cog mr-2 text-purple-500"></i>
                        Branch Settings
                    </h3>

                    <!-- Active Status -->
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="checkbox" name="active" id="active" value="1" {{ old('active', true) ? 'checked' : '' }}
                                   class="h-4 w-4 text-primary-color focus:ring-primary-color border-gray-300 rounded">
                            <label for="active" class="ml-2 block text-sm text-gray-700">
                                Active (visible on website)
                            </label>
                        </div>
                    </div>

                    <!-- Sort Order -->
                    <div class="mb-4">
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-1">Lower numbers appear first. Use 0 for default ordering.</p>
                        @error('sort_order')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.branches.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit" class="bg-primary-color hover:bg-secondary-color text-white px-6 py-3 rounded-lg font-semibold transition-colors duration-200 flex items-center">
                    <i class="fas fa-save mr-2"></i>
                    Create Branch
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
