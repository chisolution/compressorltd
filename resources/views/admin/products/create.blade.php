@extends('admin.layouts.app')

@section('title', 'Add Product')

@section('header', 'Add Product')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        .note-editor .dropdown-toggle::after {
            display: none;
        }

        /* Multi-step form styles */
        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .step-indicator .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e5e7eb;
            color: #6b7280;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin: 0 8px;
            position: relative;
            border: 2px solid #d1d5db;
            font-size: 18px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .step-indicator .step-circle.active {
            background-color: #33c4aa;
            color: white;
            border-color: #33c4aa;
            transform: scale(1.1);
            box-shadow: 0 4px 6px rgba(51, 196, 170, 0.3);
        }

        .step-indicator .step-circle.completed {
            background-color: #10b981;
            color: white;
            border-color: #10b981;
        }

        .step-indicator .step-line {
            flex-grow: 1;
            height: 4px;
            background-color: #e5e7eb;
            margin-top: 18px;
            border-radius: 2px;
            transition: background-color 0.3s ease;
        }

        .step-indicator .step-line.active {
            background-color: #33c4aa;
        }
    </style>
@endpush

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <form id="product-form" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Step Indicators -->
            <div class="step-indicator">
                <div class="step-circle active" data-step="1">1</div>
                <div class="step-line"></div>
                <div class="step-circle" data-step="2">2</div>
                <div class="step-line"></div>
                <div class="step-circle" data-step="3">3</div>
            </div>

            <!-- Step 1: Basic Information -->
            <div id="step-1" class="step active">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Step 1: Basic Information</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Product Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('name') border-red-500 @enderror" placeholder="Enter product name" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('slug') border-red-500 @enderror" placeholder="product-slug">
                        <p class="text-gray-500 text-sm mt-2">Leave empty to auto-generate from name.</p>
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
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 pl-7 pr-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('price') border-red-500 @enderror" placeholder="0.00">
                        </div>
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="sale_price" class="block text-sm font-medium text-gray-700 mb-2">Sale Price (Optional)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" name="sale_price" id="sale_price" value="{{ old('sale_price') }}" step="0.01" min="0" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 pl-7 pr-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('sale_price') border-red-500 @enderror" placeholder="0.00">
                        </div>
                        <p class="text-gray-500 text-sm mt-2">Leave empty if there is no sale price.</p>
                        @error('sale_price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="short_description" class="block text-sm font-medium text-gray-700 mb-2">Short Description</label>
                    <textarea name="short_description" id="short_description" rows="3" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('short_description') border-red-500 @enderror" placeholder="Enter a brief description of the product" required>{{ old('short_description') }}</textarea>
                    @error('short_description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" id="status" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('status') border-red-500 @enderror">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
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
                                <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured') ? 'checked' : '' }} class="w-5 h-5 text-primary-color bg-gray-100 border-gray-300 rounded focus:ring-primary-color focus:ring-2">
                                <span class="ml-3 text-sm text-gray-700">Mark this product as featured</span>
                            </label>
                        </div>
                        <p class="text-gray-500 text-sm mt-1">Featured products can be highlighted in admin reports (not shown on frontend).</p>
                        @error('featured')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="button" class="next-step bg-primary-color hover:bg-opacity-90 text-white px-6 py-3 rounded-md font-medium text-lg shadow-md transition-all duration-200 hover:shadow-lg transform hover:-translate-y-1" data-step="1">
                        Next Step <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>

            <!-- Step 2: Images -->
            <div id="step-2" class="step">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Step 2: Images</h3>

                <div class="mb-6">
                    <label for="primary_image" class="block text-sm font-medium text-gray-700 mb-2">Primary Image</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="primary_image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-1 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500">PNG, JPG or GIF (MAX. 2MB)</p>
                            </div>
                            <input id="primary_image" name="primary_image" type="file" class="hidden" required accept="image/*" />
                        </label>
                    </div>
                    <p class="text-gray-500 text-sm mt-2">This is the main image that will be displayed for the product.</p>
                    @error('primary_image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-2">Gallery Images (Optional)</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="gallery_images" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-1 text-sm text-gray-500"><span class="font-semibold">Click to upload multiple images</span></p>
                                <p class="text-xs text-gray-500">PNG, JPG or GIF (MAX. 2MB each)</p>
                            </div>
                            <input id="gallery_images" name="gallery_images[]" type="file" class="hidden" multiple accept="image/*" />
                        </label>
                    </div>
                    <p class="text-gray-500 text-sm mt-2">You can select multiple images for the product gallery.</p>
                    <div id="gallery-preview" class="flex flex-wrap gap-2 mt-3"></div>
                    @error('gallery_images')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    @error('gallery_images.*')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between">
                    <button type="button" class="prev-step bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-md font-medium text-lg shadow-md transition-all duration-200 hover:shadow-lg" data-step="2">
                        <i class="fas fa-arrow-left mr-2"></i> Previous Step
                    </button>
                    <button type="button" class="next-step bg-primary-color hover:bg-opacity-90 text-white px-6 py-3 rounded-md font-medium text-lg shadow-md transition-all duration-200 hover:shadow-lg transform hover:-translate-y-1" data-step="2">
                        Next Step <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>

            <!-- Step 3: Additional Details (Optional) -->
            <div id="step-3" class="step">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Step 3: Additional Details (Optional)</h3>

                <div class="mb-6">
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex">
                            <button type="button" class="tab-button active py-2 px-4 border-b-2 border-primary-color text-primary-color" data-tab="description">
                                Long Description
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
                        <textarea name="long_description" id="long_description" class="summernote @error('long_description') border-red-500 @enderror">{{ old('long_description') }}</textarea>
                        <p class="text-gray-500 text-sm mt-1">Detailed description of the product (optional).</p>
                        @error('long_description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="additional-tab" class="tab-content py-4 hidden">
                        <label for="additional_information" class="block text-sm font-medium text-gray-700 mb-1">Additional Information</label>
                        <textarea name="additional_information" id="additional_information" class="summernote @error('additional_information') border-red-500 @enderror">{{ old('additional_information') }}</textarea>
                        <p class="text-gray-500 text-sm mt-1">Any additional information about the product (optional).</p>
                        @error('additional_information')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="specifications-tab" class="tab-content py-4 hidden">
                        <label for="specifications" class="block text-sm font-medium text-gray-700 mb-1">Specifications</label>
                        <textarea name="specifications" id="specifications" class="summernote @error('specifications') border-red-500 @enderror">{{ old('specifications') }}</textarea>
                        <p class="text-gray-500 text-sm mt-1">Technical specifications of the product (optional).</p>
                        @error('specifications')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-between">
                    <button type="button" class="prev-step bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-md font-medium text-lg shadow-md transition-all duration-200 hover:shadow-lg" data-step="3">
                        <i class="fas fa-arrow-left mr-2"></i> Previous Step
                    </button>
                    <div>
                        <a href="{{ route('admin.products.index') }}" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-md font-medium shadow-md transition-all duration-200 hover:shadow-lg mr-2">
                            Cancel
                        </a>
                        <button type="submit" class="bg-primary-color hover:bg-opacity-90 text-white px-6 py-3 rounded-md font-medium text-lg shadow-md transition-all duration-200 hover:shadow-lg transform hover:-translate-y-1">
                            <i class="fas fa-save mr-2"></i> Save Product
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Summernote
            $('.summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            // Tab functionality
            $('.tab-button').click(function() {
                $('.tab-button').removeClass('active border-primary-color text-primary-color').addClass('border-transparent text-gray-500');
                $(this).addClass('active border-primary-color text-primary-color').removeClass('border-transparent text-gray-500');

                $('.tab-content').addClass('hidden');
                $('#' + $(this).data('tab') + '-tab').removeClass('hidden');
            });

            // Auto-generate slug from name
            $('#name').on('input', function() {
                const nameValue = $(this).val();
                const slugInput = $('#slug');

                // Only update slug if it's empty or hasn't been manually changed
                if (!slugInput.val() || slugInput.data('auto-generated')) {
                    const slug = nameValue
                        .toLowerCase()
                        .replace(/[^\w\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-');

                    slugInput.val(slug);
                    slugInput.data('auto-generated', true);
                }
            });

            $('#slug').on('input', function() {
                // If user manually changes the slug, don't auto-generate it anymore
                $(this).data('auto-generated', false);
            });

            // Multi-step form functionality
            $('.next-step').click(function() {
                const currentStep = parseInt($(this).data('step'));
                const nextStep = currentStep + 1;

                // Validate current step fields
                let isValid = true;

                if (currentStep === 1) {
                    // Validate Step 1 fields
                    if (!$('#name').val()) {
                        $('#name').addClass('border-red-500');
                        isValid = false;
                    } else {
                        $('#name').removeClass('border-red-500');
                    }

                    if (!$('#category_id').val()) {
                        $('#category_id').addClass('border-red-500');
                        isValid = false;
                    } else {
                        $('#category_id').removeClass('border-red-500');
                    }

                    if (!$('#short_description').val()) {
                        $('#short_description').addClass('border-red-500');
                        isValid = false;
                    } else {
                        $('#short_description').removeClass('border-red-500');
                    }
                } else if (currentStep === 2) {
                    // Validate Step 2 fields
                    if (!$('#primary_image').val() && !$('#primary_image').attr('data-has-file')) {
                        $('#primary_image').addClass('border-red-500');
                        isValid = false;
                    } else {
                        $('#primary_image').removeClass('border-red-500');
                    }
                }

                if (!isValid) {
                    // Show error message
                    alert('Please fill in all required fields before proceeding.');
                    return;
                }

                // Hide current step and show next step
                $('#step-' + currentStep).removeClass('active');
                $('#step-' + nextStep).addClass('active');

                // Update step indicators
                $('.step-circle[data-step="' + currentStep + '"]').addClass('completed');
                $('.step-circle[data-step="' + nextStep + '"]').addClass('active');
                $('.step-line').eq(currentStep - 1).addClass('active');

                // Scroll to top of form
                $('html, body').animate({
                    scrollTop: $('#product-form').offset().top - 20
                }, 300);
            });

            $('.prev-step').click(function() {
                const currentStep = parseInt($(this).data('step'));
                const prevStep = currentStep - 1;

                // Hide current step and show previous step
                $('#step-' + currentStep).removeClass('active');
                $('#step-' + prevStep).addClass('active');

                // Update step indicators
                $('.step-circle[data-step="' + currentStep + '"]').removeClass('active');
                $('.step-circle[data-step="' + prevStep + '"]').removeClass('completed').addClass('active');
                $('.step-line').eq(prevStep).removeClass('active');

                // Scroll to top of form
                $('html, body').animate({
                    scrollTop: $('#product-form').offset().top - 20
                }, 300);
            });

            // Handle primary image preview
            $('#primary_image').change(function() {
                const file = this.files[0];
                if (file) {
                    $(this).attr('data-has-file', 'true');

                    // Create preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Remove any existing preview
                        $('.primary-image-preview').remove();

                        // Create new preview
                        const preview = $('<div class="primary-image-preview mt-3 relative"></div>');
                        const img = $('<img class="w-32 h-32 object-cover rounded-lg border-2 border-primary-color">').attr('src', e.target.result);
                        const removeBtn = $('<button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600"><i class="fas fa-times"></i></button>');

                        removeBtn.click(function() {
                            preview.remove();
                            $('#primary_image').val('').removeAttr('data-has-file');
                        });

                        preview.append(img).append(removeBtn);
                        $('#primary_image').closest('.flex').after(preview);
                    };
                    reader.readAsDataURL(file);
                } else {
                    $(this).removeAttr('data-has-file');
                    $('.primary-image-preview').remove();
                }
            });

            // Handle gallery images preview
            $('#gallery_images').change(function() {
                const files = this.files;
                if (files.length > 0) {
                    // Clear existing previews
                    $('#gallery-preview').empty();

                    // Create previews for each file
                    Array.from(files).forEach((file, index) => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const preview = $('<div class="gallery-image-preview relative"></div>');
                            const img = $('<img class="w-24 h-24 object-cover rounded-lg border-2 border-gray-300">').attr('src', e.target.result);
                            preview.append(img);
                            $('#gallery-preview').append(preview);
                        };
                        reader.readAsDataURL(file);
                    });
                } else {
                    $('#gallery-preview').empty();
                }
            });

            // Form submission validation
            $('#product-form').on('submit', function(e) {
                // Check if primary image is provided
                if (!$('#primary_image').val() && !$('#primary_image').attr('data-has-file')) {
                    e.preventDefault();
                    alert('Please upload a primary image for the product.');

                    // Go to step 2
                    $('#step-3').removeClass('active');
                    $('#step-2').addClass('active');
                    $('.step-circle[data-step="3"]').removeClass('active');
                    $('.step-circle[data-step="2"]').addClass('active').removeClass('completed');
                    $('.step-line').eq(1).removeClass('active');
                }
            });
        });
    </script>
@endpush
