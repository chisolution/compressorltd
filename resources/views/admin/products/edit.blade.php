@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('header', 'Edit Product')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        .note-editor .dropdown-toggle::after {
            display: none;
        }
    </style>
@endpush

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Product Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('name') border-red-500 @enderror" placeholder="Enter product name" required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $product->slug) }}" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('slug') border-red-500 @enderror" placeholder="product-slug" required>
                    <p class="text-gray-500 text-sm mt-2">URL-friendly version of the product name.</p>
                    @error('slug')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                <select name="category_id" id="category_id" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('category_id') border-red-500 @enderror" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">R</span>
                        </div>
                        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 pl-7 pr-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('price') border-red-500 @enderror" placeholder="0.00">
                    </div>
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="sale_price" class="block text-sm font-medium text-gray-700 mb-2">Sale Price (Optional)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">R</span>
                        </div>
                        <input type="number" name="sale_price" id="sale_price" value="{{ old('sale_price', $product->sale_price) }}" step="0.01" min="0" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 pl-7 pr-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('sale_price') border-red-500 @enderror" placeholder="0.00">
                    </div>
                    <p class="text-gray-500 text-sm mt-2">Leave empty if there is no sale price.</p>
                    @error('sale_price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="short_description" class="block text-sm font-medium text-gray-700 mb-2">Short Description</label>
                <textarea name="short_description" id="short_description" rows="3" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('short_description') border-red-500 @enderror" placeholder="Enter a brief description of the product" required>{{ old('short_description', $product->short_description) }}</textarea>
                @error('short_description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="primary_image" class="block text-sm font-medium text-gray-700 mb-1">Primary Image</label>
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('storage/' . $product->primary_image) }}" alt="{{ $product->name }}" class="h-20 w-20 object-cover rounded">
                    <input type="file" name="primary_image" id="primary_image" class="w-full border border-gray-300 rounded-md shadow-sm p-2 @error('primary_image') border-red-500 @enderror" accept="image/*">
                </div>
                <p class="text-gray-500 text-sm mt-1">Leave empty to keep the current image.</p>
                @error('primary_image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-1">Gallery Images</label>
                <input type="file" name="gallery_images[]" id="gallery_images" class="w-full border border-gray-300 rounded-md shadow-sm p-2 @error('gallery_images') border-red-500 @enderror" multiple accept="image/*">
                <p class="text-gray-500 text-sm mt-1">You can select multiple images to add to the gallery.</p>
                @error('gallery_images')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                @error('gallery_images.*')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                @if($product->images->count() > 0)
                    <div class="mt-4">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Current Gallery Images</h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                            @foreach($product->images as $image)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gallery Image" class="h-24 w-24 object-cover rounded">
                                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('admin.products.remove-image', $image) }}" class="text-white hover:text-red-300" onclick="return confirm('Are you sure you want to remove this image?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" id="status" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('status') border-red-500 @enderror">
                        <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Featured Product</label>
                    <div class="flex items-center h-12">
                        <label class="flex items-center cursor-pointer">
                            <input type="hidden" name="featured" value="0">
                            <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured', $product->featured) ? 'checked' : '' }} class="w-5 h-5 text-primary-color bg-gray-100 border-gray-300 rounded focus:ring-primary-color focus:ring-2">
                            <span class="ml-3 text-sm text-gray-700">Mark this product as featured</span>
                        </label>
                    </div>
                    <p class="text-gray-500 text-sm mt-1">Featured products can be highlighted in admin reports (not shown on frontend).</p>
                    @error('featured')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Tabs for Long Description, Additional Information, and Specifications -->
            <div class="mb-6">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex">
                        <button type="button" class="tab-button active py-2 px-4 border-b-2 border-primary-color text-primary-color" data-tab="description">
                            Description
                        </button>
                        <button type="button" class="tab-button py-2 px-4 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="additional">
                            Additional Information
                        </button>
                        <button type="button" class="tab-button py-2 px-4 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="specifications">
                            Specifications
                        </button>
                    </nav>
                </div>

                <div id="description-tab" class="tab-content py-4">
                    <label for="long_description" class="block text-sm font-medium text-gray-700 mb-1">Long Description</label>
                    <textarea name="long_description" id="long_description" class="summernote @error('long_description') border-red-500 @enderror">{{ old('long_description', $product->long_description) }}</textarea>
                    @error('long_description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div id="additional-tab" class="tab-content py-4 hidden">
                    <label for="additional_information" class="block text-sm font-medium text-gray-700 mb-1">Additional Information</label>
                    <textarea name="additional_information" id="additional_information" class="summernote @error('additional_information') border-red-500 @enderror">{{ old('additional_information', $product->additional_information) }}</textarea>
                    @error('additional_information')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div id="specifications-tab" class="tab-content py-4 hidden">
                    <label for="specifications" class="block text-sm font-medium text-gray-700 mb-1">Specifications</label>
                    <textarea name="specifications" id="specifications" class="summernote @error('specifications') border-red-500 @enderror">{{ old('specifications', $product->specifications) }}</textarea>
                    @error('specifications')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.products.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md mr-2">
                    Cancel
                </a>
                <button type="submit" class="bg-primary-color hover:bg-opacity-90 text-white px-4 py-2 rounded-md">
                    Update Product
                </button>
            </div>
        </form
