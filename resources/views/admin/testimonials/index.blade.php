@extends('admin.layouts.app')

@section('title', 'Testimonials')

@section('header', 'Testimonials')

@push('styles')
<style>
    /* Responsive table/card view */
    .desktop-table {
        display: none;
    }

    .mobile-cards {
        display: block;
    }

    @media (min-width: 1024px) {
        .desktop-table {
            display: block;
        }

        .mobile-cards {
            display: none;
        }
    }
</style>
@endpush

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Manage Testimonials</h1>
                <p class="text-gray-600 mt-1">Review and manage customer testimonials</p>
            </div>

            <a href="{{ route('admin.testimonials.create') }}"
               class="bg-primary-color hover:bg-opacity-90 text-white px-4 py-2 rounded-md font-medium">
                <i class="fas fa-plus mr-2"></i> Add Testimonial
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <form action="{{ route('admin.testimonials.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search testimonials..."
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50">
            </div>

            <div>
                <select name="status" class="border-gray-300 rounded-md shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-primary-color hover:bg-opacity-90 text-white px-4 py-2 rounded-md">
                    <i class="fas fa-search mr-2"></i> Search
                </button>
                <a href="{{ route('admin.testimonials.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                    <i class="fas fa-times mr-2"></i> Clear
                </a>
            </div>
        </form>
    </div>

    <!-- Desktop Table View -->
    <div class="desktop-table bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                        <th class="py-3 px-3 text-left">Customer</th>
                        <th class="py-3 px-4 text-left">Review</th>
                        <th class="py-3 px-3 text-left">Rating</th>
                        <th class="py-3 px-3 text-left">Status</th>
                        <th class="py-3 px-3 text-left">Featured</th>
                        <th class="py-3 px-3 text-left">Date</th>
                        <th class="py-3 px-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @forelse($testimonials as $testimonial)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-4 px-3 text-left align-top">
                                <div class="flex items-center space-x-3">
                                    @if($testimonial->image)
                                        <img src="{{ asset('storage/' . $testimonial->image) }}"
                                             alt="{{ $testimonial->name }}"
                                             class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-semibold">
                                            {{ substr($testimonial->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $testimonial->name }}</div>
                                        @if($testimonial->company)
                                            <div class="text-xs text-gray-500">{{ $testimonial->company }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-left align-top max-w-xs">
                                <div class="text-gray-900 leading-tight">
                                    {{ Str::limit($testimonial->testimonial, 100) }}
                                </div>
                            </td>
                            <td class="py-4 px-3 text-left align-top">
                                <div class="flex items-center">
                                    {!! $testimonial->rating_stars !!}
                                    <span class="ml-2 text-sm text-gray-600">({{ $testimonial->rating }})</span>
                                </div>
                            </td>
                            <td class="py-4 px-3 text-left align-top">
                                <span class="inline-flex items-center px-2 py-1 bg-{{ $testimonial->status_badge_color }}-100 text-{{ $testimonial->status_badge_color }}-800 rounded-full text-xs font-medium">
                                    @if($testimonial->status == 'approved')
                                        <i class="fas fa-check-circle mr-1"></i>
                                    @elseif($testimonial->status == 'pending')
                                        <i class="fas fa-clock mr-1"></i>
                                    @else
                                        <i class="fas fa-times-circle mr-1"></i>
                                    @endif
                                    {{ ucfirst($testimonial->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-3 text-left align-top">
                                @if($testimonial->featured)
                                    <span class="inline-flex items-center px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">
                                        <i class="fas fa-star mr-1"></i>
                                        Featured
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-medium">
                                        <i class="far fa-star mr-1"></i>
                                        Regular
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-3 text-left align-top">
                                <div class="text-sm text-gray-600">
                                    {{ $testimonial->created_at->format('M d, Y') }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $testimonial->created_at->format('H:i') }}
                                </div>
                            </td>
                            <td class="py-4 px-3 text-center align-top">
                                <div class="flex justify-center space-x-1">
                                    @if($testimonial->status == 'pending')
                                        <form action="{{ route('admin.testimonials.approve', $testimonial) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-green-500 hover:text-green-700 transition-colors p-1" title="Approve">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.testimonials.reject', $testimonial) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-red-500 hover:text-red-700 transition-colors p-1" title="Reject">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('admin.testimonials.toggle-featured', $testimonial) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-yellow-500 hover:text-yellow-700 transition-colors p-1" title="Toggle Featured">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.testimonials.show', $testimonial) }}"
                                       class="text-gray-500 hover:text-primary-color transition-colors p-1" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}"
                                       class="text-blue-500 hover:text-blue-700 transition-colors p-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}"
                                          method="POST" class="inline"
                                          onsubmit="return confirm('Are you sure you want to delete this testimonial?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 transition-colors p-1" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="border-b border-gray-200">
                            <td colspan="7" class="py-8 px-6 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-comments text-4xl text-gray-300 mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">No testimonials found</h3>
                                    <p class="text-gray-500 mb-4">Start by adding your first testimonial.</p>
                                    <a href="{{ route('admin.testimonials.create') }}"
                                       class="bg-primary-color hover:bg-opacity-90 text-white px-4 py-2 rounded-md font-medium">
                                        <i class="fas fa-plus mr-2"></i> Add Testimonial
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mobile Card View -->
    <div class="mobile-cards space-y-4">
        @forelse($testimonials as $testimonial)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4">
                    <div class="flex items-start space-x-4">
                        @if($testimonial->image)
                            <img src="{{ asset('storage/' . $testimonial->image) }}"
                                 alt="{{ $testimonial->name }}"
                                 class="w-16 h-16 rounded-full object-cover">
                        @else
                            <div class="w-16 h-16 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-semibold text-lg">
                                {{ substr($testimonial->name, 0, 1) }}
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="font-medium text-gray-900 leading-tight">
                                        {{ $testimonial->name }}
                                    </h3>
                                    @if($testimonial->company)
                                        <p class="text-sm text-gray-500">{{ $testimonial->company }}</p>
                                    @endif
                                    <p class="text-sm text-gray-700 mt-2">
                                        {{ Str::limit($testimonial->testimonial, 100) }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-2 mt-3">
                                <div class="flex items-center">
                                    {!! $testimonial->rating_stars !!}
                                </div>

                                <span class="inline-flex items-center px-2 py-1 bg-{{ $testimonial->status_badge_color }}-100 text-{{ $testimonial->status_badge_color }}-800 rounded-full text-xs font-medium">
                                    {{ ucfirst($testimonial->status) }}
                                </span>

                                @if($testimonial->featured)
                                    <span class="inline-flex items-center px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">
                                        <i class="fas fa-star mr-1"></i>Featured
                                    </span>
                                @endif

                                <span class="text-xs text-gray-500">
                                    {{ $testimonial->created_at->format('M d, Y') }}
                                </span>
                            </div>

                            <div class="flex space-x-2 mt-3">
                                @if($testimonial->status == 'pending')
                                    <form action="{{ route('admin.testimonials.approve', $testimonial) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-500 hover:text-green-700 transition-colors p-2" title="Approve">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.testimonials.reject', $testimonial) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-red-500 hover:text-red-700 transition-colors p-2" title="Reject">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                @endif

                                <a href="{{ route('admin.testimonials.show', $testimonial) }}"
                                   class="text-gray-500 hover:text-primary-color transition-colors p-2" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.testimonials.edit', $testimonial) }}"
                                   class="text-blue-500 hover:text-blue-700 transition-colors p-2" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow-md p-8 text-center text-gray-500">
                <div class="flex flex-col items-center">
                    <i class="fas fa-comments text-4xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No testimonials found</h3>
                    <p class="text-gray-500 mb-4">Start by adding your first testimonial.</p>
                    <a href="{{ route('admin.testimonials.create') }}"
                       class="bg-primary-color hover:bg-opacity-90 text-white px-4 py-2 rounded-md font-medium">
                        <i class="fas fa-plus mr-2"></i> Add Testimonial
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <div class="px-6 py-4">
        {{ $testimonials->appends(request()->query())->links() }}
    </div>
@endsection
