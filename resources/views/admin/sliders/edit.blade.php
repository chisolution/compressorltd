@extends('admin.layouts.app')

@section('title', 'Edit Slider')

@section('header', 'Edit Slider')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Slider Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $slider->title) }}" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('title') border-red-500 @enderror" placeholder="Enter slider title" required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">Subtitle (Optional)</label>
                    <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle', $slider->subtitle) }}" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('subtitle') border-red-500 @enderror" placeholder="Enter slider subtitle">
                    @error('subtitle')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description (Optional)</label>
                <textarea name="description" id="description" class="summernote @error('description') border-red-500 @enderror">{{ old('description', $slider->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="button_text" class="block text-sm font-medium text-gray-700 mb-2">Button Text (Optional)</label>
                    <input type="text" name="button_text" id="button_text" value="{{ old('button_text', $slider->button_text) }}" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('button_text') border-red-500 @enderror" placeholder="Enter button text">
                    @error('button_text')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="button_link" class="block text-sm font-medium text-gray-700 mb-2">Button Link (Optional)</label>
                    <input type="text" name="button_link" id="button_link" value="{{ old('button_link', $slider->button_link) }}" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('button_link') border-red-500 @enderror" placeholder="Enter button link">
                    @error('button_link')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $slider->sort_order) }}" min="0" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('sort_order') border-red-500 @enderror">
                    <p class="text-gray-500 text-sm mt-2">Lower numbers appear first.</p>
                    @error('sort_order')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="active" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="active" id="active" value="1" {{ old('active', $slider->active) ? 'checked' : '' }} class="rounded border-gray-300 text-primary-color shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Active</span>
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Slider Image</label>
                
                @if($slider->image)
                    <div class="mb-3 relative group">
                        <img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->title }}" class="max-w-full h-auto max-h-64 rounded-lg border-2 border-gray-300">
                        <p class="text-sm text-gray-500 mt-1">Current slider image</p>
                        
                        <!-- Remove Image Button -->
                        <form action="{{ route('admin.sliders.remove-image', $slider) }}" method="POST" class="absolute top-2 right-2" onsubmit="return confirm('Are you sure you want to remove this image?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600 transition-colors">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                    </div>
                @endif
                
                <div class="flex items-center justify-center w-full">
                    <label for="image" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-3 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-1 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500">PNG, JPG or GIF (MAX. 2MB)</p>
                        </div>
                        <input id="image" name="image" type="file" class="hidden" accept="image/*" />
                    </label>
                </div>
                <p class="text-gray-500 text-sm mt-2">Recommended size: 1920x600 pixels. Leave empty to keep the current image.</p>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                
                <div id="image-preview" class="mt-4 hidden">
                    <h4 class="text-sm font-medium text-gray-700 mb-2">New Image Preview:</h4>
                    <img id="preview-img" src="#" alt="Preview" class="max-w-full h-auto max-h-64 rounded-lg border-2 border-gray-300">
                </div>
            </div>
            
            <div class="flex items-center justify-end">
                <a href="{{ route('admin.sliders.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md font-medium shadow-md transition-all duration-200 hover:shadow-lg mr-2">
                    Cancel
                </a>
                <button type="submit" class="bg-primary-color hover:bg-opacity-90 text-white px-4 py-2 rounded-md font-medium shadow-md transition-all duration-200 hover:shadow-lg transform hover:-translate-y-1">
                    <i class="fas fa-save mr-2"></i> Update Slider
                </button>
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
                height: 150,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                placeholder: 'Enter slider description here...'
            });
            
            // Image preview
            $('#image').change(function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview-img').attr('src', e.target.result);
                        $('#image-preview').removeClass('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush
