@extends('admin.layouts.app')

@section('title', 'Add Subscriber')

@section('header', 'Add Subscriber')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.newsletters.store') }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('email') border-red-500 @enderror" placeholder="Enter email address" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="active" class="flex items-center">
                    <input type="checkbox" name="active" id="active" value="1" {{ old('active', '1') == '1' ? 'checked' : '' }} class="rounded border-gray-300 text-primary-color shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-700">Active</span>
                </label>
            </div>
            
            <div class="mb-6">
                <label for="subscribed_at" class="block text-sm font-medium text-gray-700 mb-2">Subscription Date</label>
                <input type="date" name="subscribed_at" id="subscribed_at" value="{{ old('subscribed_at', date('Y-m-d')) }}" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('subscribed_at') border-red-500 @enderror">
                @error('subscribed_at')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center justify-end">
                <a href="{{ route('admin.newsletters.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md font-medium shadow-md transition-all duration-200 hover:shadow-lg mr-2">
                    Cancel
                </a>
                <button type="submit" class="bg-primary-color hover:bg-opacity-90 text-white px-4 py-2 rounded-md font-medium shadow-md transition-all duration-200 hover:shadow-lg transform hover:-translate-y-1">
                    <i class="fas fa-save mr-2"></i> Save Subscriber
                </button>
            </div>
        </form>
    </div>
@endsection
