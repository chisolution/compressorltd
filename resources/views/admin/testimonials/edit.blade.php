@extends('admin.layouts.app')

@section('title', 'Edit Testimonial')

@section('header', 'Edit Testimonial')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-2">Edit Testimonial #{{ $testimonial->id }}</h2>
            <p class="text-gray-600">Update the testimonial information and content.</p>
        </div>

        <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Customer Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $testimonial->name) }}" required
                           class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('name') border-red-500 @enderror"
                           placeholder="Enter customer name">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $testimonial->email) }}" required
                           class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('email') border-red-500 @enderror"
                           placeholder="Enter email address">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Company (Optional)</label>
                    <input type="text" name="company" id="company" value="{{ old('company', $testimonial->company) }}"
                           class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('company') border-red-500 @enderror"
                           placeholder="Enter company name">
                    @error('company')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="position" class="block text-sm font-medium text-gray-700 mb-2">Position (Optional)</label>
                    <input type="text" name="position" id="position" value="{{ old('position', $testimonial->position) }}"
                           class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('position') border-red-500 @enderror"
                           placeholder="Enter job title">
                    @error('position')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                    <select name="rating" id="rating" required
                            class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('rating') border-red-500 @enderror">
                        <option value="">Select Rating</option>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>
                                {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                            </option>
                        @endfor
                    </select>
                    @error('rating')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" id="status" required
                            class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('status') border-red-500 @enderror">
                        <option value="pending" {{ old('status', $testimonial->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ old('status', $testimonial->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ old('status', $testimonial->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Customer Photo (Optional)</label>
                
                @if($testimonial->image)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Current photo:</p>
                        <img src="{{ asset('storage/' . $testimonial->image) }}" 
                             alt="{{ $testimonial->name }}" 
                             class="w-20 h-20 rounded-full object-cover">
                    </div>
                @endif
                
                <input type="file" name="image" id="image" accept="image/*"
                       class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('image') border-red-500 @enderror">
                <p class="text-gray-500 text-sm mt-2">Upload a new photo to replace the current one (JPG, PNG, GIF - Max 2MB)</p>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="testimonial" class="block text-sm font-medium text-gray-700 mb-2">Testimonial Content</label>
                <textarea name="testimonial" id="testimonial" rows="6" required
                          class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('testimonial') border-red-500 @enderror"
                          placeholder="Enter the testimonial content">{{ old('testimonial', $testimonial->testimonial) }}</textarea>
                @error('testimonial')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <div class="flex items-center">
                    <input type="checkbox" name="featured" id="featured" value="1" 
                           {{ old('featured', $testimonial->featured) ? 'checked' : '' }}
                           class="h-4 w-4 text-primary-color focus:ring-primary-color border-gray-300 rounded">
                    <label for="featured" class="ml-2 block text-sm text-gray-700">
                        Featured Testimonial
                    </label>
                </div>
                <p class="text-gray-500 text-sm mt-1">Featured testimonials are displayed prominently on the testimonials page.</p>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.testimonials.show', $testimonial) }}" 
                   class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-md font-medium shadow-md transition-all duration-200 hover:shadow-lg">
                    <i class="fas fa-eye mr-2"></i> View
                </a>
                <a href="{{ route('admin.testimonials.index') }}" 
                   class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-md font-medium shadow-md transition-all duration-200 hover:shadow-lg">
                    <i class="fas fa-times mr-2"></i> Cancel
                </a>
                <button type="submit" 
                        class="bg-primary-color hover:bg-opacity-90 text-white px-6 py-3 rounded-md font-medium text-lg shadow-md transition-all duration-200 hover:shadow-lg transform hover:-translate-y-1">
                    <i class="fas fa-save mr-2"></i> Update Testimonial
                </button>
            </div>
        </form>
    </div>
@endsection
