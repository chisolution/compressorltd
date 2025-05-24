@extends('admin.layouts.app')

@section('title', 'Add Quote Request')

@section('header', 'Add Quote Request')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.quote-requests.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('name') border-red-500 @enderror" required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('email') border-red-500 @enderror" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('phone') border-red-500 @enderror" required>
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700 mb-1">Company (Optional)</label>
                    <input type="text" name="company" id="company" value="{{ old('company') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('company') border-red-500 @enderror">
                    @error('company')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="mb-6">
                <label for="product_id" class="block text-sm font-medium text-gray-700 mb-1">Product (Optional)</label>
                <select name="product_id" id="product_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('product_id') border-red-500 @enderror">
                    <option value="">No Specific Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
                @error('product_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                <textarea name="message" id="message" rows="5" class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('message') border-red-500 @enderror" required>{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('status') border-red-500 @enderror" required>
                    <option value="new" {{ old('status') == 'new' ? 'selected' : '' }}>New</option>
                    <option value="processing" {{ old('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-end">
                <a href="{{ route('admin.quote-requests.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md mr-2">
                    Cancel
                </a>
                <button type="submit" class="bg-primary-color hover:bg-opacity-90 text-white px-4 py-2 rounded-md">
                    Save Quote Request
                </button>
            </div>
        </form>
    </div>
@endsection
