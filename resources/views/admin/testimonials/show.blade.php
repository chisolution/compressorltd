@extends('admin.layouts.app')

@section('title', 'View Testimonial')

@section('header', 'Testimonial Details')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-800 mb-2">Testimonial #{{ $testimonial->id }}</h2>
                <p class="text-gray-600">View testimonial details and manage status</p>
            </div>
            
            <div class="flex flex-wrap gap-2">
                @if($testimonial->status == 'pending')
                    <form action="{{ route('admin.testimonials.approve', $testimonial) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md font-medium">
                            <i class="fas fa-check mr-2"></i> Approve
                        </button>
                    </form>
                    <form action="{{ route('admin.testimonials.reject', $testimonial) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md font-medium">
                            <i class="fas fa-times mr-2"></i> Reject
                        </button>
                    </form>
                @endif
                
                <form action="{{ route('admin.testimonials.toggle-featured', $testimonial) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-md font-medium">
                        <i class="fas fa-star mr-2"></i> 
                        {{ $testimonial->featured ? 'Unfeature' : 'Feature' }}
                    </button>
                </form>
                
                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                
                <a href="{{ route('admin.testimonials.index') }}" 
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md font-medium">
                    <i class="fas fa-arrow-left mr-2"></i> Back to List
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Customer Information -->
            <div class="lg:col-span-1">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Customer Information</h3>
                    
                    <div class="flex items-center mb-6">
                        @if($testimonial->image)
                            <img src="{{ asset('storage/' . $testimonial->image) }}" 
                                 alt="{{ $testimonial->name }}" 
                                 class="w-20 h-20 rounded-full object-cover mr-4">
                        @else
                            <div class="w-20 h-20 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-semibold text-2xl mr-4">
                                {{ substr($testimonial->name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <h4 class="font-semibold text-gray-900">{{ $testimonial->name }}</h4>
                            @if($testimonial->position && $testimonial->company)
                                <p class="text-gray-600">{{ $testimonial->position }} at {{ $testimonial->company }}</p>
                            @elseif($testimonial->company)
                                <p class="text-gray-600">{{ $testimonial->company }}</p>
                            @elseif($testimonial->position)
                                <p class="text-gray-600">{{ $testimonial->position }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <p class="text-gray-900">{{ $testimonial->email }}</p>
                        </div>
                        
                        @if($testimonial->company)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Company</label>
                                <p class="text-gray-900">{{ $testimonial->company }}</p>
                            </div>
                        @endif
                        
                        @if($testimonial->position)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                                <p class="text-gray-900">{{ $testimonial->position }}</p>
                            </div>
                        @endif
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                            <div class="flex items-center">
                                {!! $testimonial->rating_stars !!}
                                <span class="ml-2 text-sm text-gray-600">({{ $testimonial->rating }}/5)</span>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <span class="inline-flex items-center px-3 py-1 bg-{{ $testimonial->status_badge_color }}-100 text-{{ $testimonial->status_badge_color }}-800 rounded-full text-sm font-medium">
                                @if($testimonial->status == 'approved')
                                    <i class="fas fa-check-circle mr-1"></i>
                                @elseif($testimonial->status == 'pending')
                                    <i class="fas fa-clock mr-1"></i>
                                @else
                                    <i class="fas fa-times-circle mr-1"></i>
                                @endif
                                {{ ucfirst($testimonial->status) }}
                            </span>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Featured</label>
                            @if($testimonial->featured)
                                <span class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                                    <i class="fas fa-star mr-1"></i>
                                    Featured
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">
                                    <i class="far fa-star mr-1"></i>
                                    Regular
                                </span>
                            @endif
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Submitted</label>
                            <p class="text-gray-900">{{ $testimonial->created_at->format('M d, Y \a\t H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial Content -->
            <div class="lg:col-span-2">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Testimonial Content</h3>
                    
                    <div class="bg-white rounded-lg p-6 border-l-4 border-primary-color">
                        <div class="flex items-start">
                            <i class="fas fa-quote-left text-primary-color text-2xl mr-4 mt-1"></i>
                            <div class="flex-1">
                                <p class="text-gray-800 leading-relaxed text-lg">
                                    {{ $testimonial->testimonial }}
                                </p>
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-center">
                                        {!! $testimonial->rating_stars !!}
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-gray-900">{{ $testimonial->name }}</p>
                                        @if($testimonial->position && $testimonial->company)
                                            <p class="text-sm text-gray-600">{{ $testimonial->position }}, {{ $testimonial->company }}</p>
                                        @elseif($testimonial->company)
                                            <p class="text-sm text-gray-600">{{ $testimonial->company }}</p>
                                        @elseif($testimonial->position)
                                            <p class="text-sm text-gray-600">{{ $testimonial->position }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if($testimonial->status == 'pending')
                        <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-triangle text-yellow-600 mr-2"></i>
                                <p class="text-yellow-800 font-medium">This testimonial is pending approval</p>
                            </div>
                            <p class="text-yellow-700 text-sm mt-1">
                                Review the content and approve or reject this testimonial to make it visible to the public.
                            </p>
                        </div>
                    @elseif($testimonial->status == 'approved')
                        <div class="mt-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-600 mr-2"></i>
                                <p class="text-green-800 font-medium">This testimonial is approved and visible to the public</p>
                            </div>
                        </div>
                    @else
                        <div class="mt-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-times-circle text-red-600 mr-2"></i>
                                <p class="text-red-800 font-medium">This testimonial has been rejected</p>
                            </div>
                            <p class="text-red-700 text-sm mt-1">
                                This testimonial is not visible to the public.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
