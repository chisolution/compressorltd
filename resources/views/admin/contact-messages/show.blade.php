@extends('admin.layouts.app')

@section('title', 'View Message')

@section('header', 'View Message')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('admin.contact-messages.index') }}" class="text-gray-600 hover:text-gray-900">
            <i class="fas fa-arrow-left mr-2"></i> Back to Messages
        </a>
        
        <div>
            <form action="{{ route('admin.contact-messages.destroy', $message) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md" onclick="return confirm('Are you sure you want to delete this message?')">
                    <i class="fas fa-trash mr-2"></i> Delete
                </button>
            </form>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $message->subject ?? 'No Subject' }}</h2>
                    <p class="text-gray-600 mt-1">From: {{ $message->name }} &lt;{{ $message->email }}&gt;</p>
                    <p class="text-gray-500 text-sm mt-1">{{ $message->created_at->format('F j, Y, g:i a') }}</p>
                </div>
                <div>
                    @if($message->status === 'new')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            New
                        </span>
                    @elseif($message->status === 'read')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                            Read
                        </span>
                    @else
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Replied
                        </span>
                    @endif
                </div>
            </div>
            
            @if($message->phone)
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-700 mb-2">Phone Number</h3>
                    <p class="text-gray-800">{{ $message->phone }}</p>
                </div>
            @endif
            
            <div class="mb-6">
                <h3 class="text-sm font-medium text-gray-700 mb-2">Message</h3>
                <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                    <p class="text-gray-800 whitespace-pre-line">{{ $message->message }}</p>
                </div>
            </div>
            
            @if($message->status !== 'replied')
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Reply to this message</h3>
                    
                    <form action="{{ route('admin.contact-messages.update', $message) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <input type="hidden" name="status" value="replied">
                        
                        <div class="mb-4">
                            <label for="reply" class="block text-sm font-medium text-gray-700 mb-2">Your Reply</label>
                            <textarea name="reply" id="reply" rows="6" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 @error('reply') border-red-500 @enderror" required></textarea>
                            @error('reply')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="bg-primary-color hover:bg-opacity-90 text-white px-6 py-3 rounded-md font-medium shadow-md transition-all duration-200 hover:shadow-lg">
                                <i class="fas fa-paper-plane mr-2"></i> Send Reply
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection
