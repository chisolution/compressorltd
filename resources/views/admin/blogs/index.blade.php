@extends('admin.layouts.app')

@section('title', 'Blog Posts')

@section('header', 'Blog Posts')

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
    <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <a href="{{ route('admin.blogs.create') }}" class="bg-primary-color hover:bg-opacity-90 text-white px-4 py-2 rounded-md font-medium shadow-md transition-all duration-200 hover:shadow-lg transform hover:-translate-y-1">
                <i class="fas fa-plus mr-2"></i> Add New Post
            </a>
        </div>

        <div class="flex flex-col md:flex-row gap-2">
            <form action="{{ route('admin.blogs.index') }}" method="GET" class="flex flex-wrap gap-2">
                <select name="category" class="border-2 border-gray-300 rounded-md shadow-sm py-2 px-3 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <select name="status" class="border-2 border-gray-300 rounded-md shadow-sm py-2 px-3 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50">
                    <option value="">All Status</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>

                <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md font-medium">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>

                @if(request('category') || request('status'))
                    <a href="{{ route('admin.blogs.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md font-medium">
                        <i class="fas fa-times mr-2"></i> Clear
                    </a>
                @endif
            </form>
        </div>
    </div>

    <!-- Desktop Table View -->
    <div class="desktop-table bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                        <th class="py-3 px-3 text-left">ID</th>
                        <th class="py-3 px-4 text-left">Title</th>
                        <th class="py-3 px-3 text-left">Category</th>
                        <th class="py-3 px-3 text-left">Status</th>
                        <th class="py-3 px-3 text-left">Featured</th>
                        <th class="py-3 px-3 text-left">Date</th>
                        <th class="py-3 px-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @forelse($blogs as $blog)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-4 px-3 text-left align-top">
                                <span class="font-medium text-gray-900">{{ $blog->id }}</span>
                            </td>
                            <td class="py-4 px-4 text-left align-top max-w-xs">
                                <div class="flex items-center space-x-3">
                                    @if($blog->featured_image)
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('storage/' . $blog->featured_image) }}"
                                                 alt="{{ $blog->title }}"
                                                 class="w-12 h-12 object-cover rounded-lg shadow-sm">
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <div class="font-medium text-gray-900 leading-tight break-words">
                                            {{ $blog->title }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-3 text-left align-top">
                                <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                                    {{ $blog->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>
                            <td class="py-4 px-3 text-left align-top">
                                @if($blog->status == 'published')
                                    <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">
                                        <i class="fas fa-edit mr-1"></i>
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-3 text-left align-top">
                                <button type="button"
                                        class="featured-toggle-blog"
                                        data-blog-id="{{ $blog->id }}"
                                        data-featured="{{ $blog->featured ? 'true' : 'false' }}"
                                        data-url="{{ route('admin.blogs.toggle-featured', $blog) }}">
                                    <span class="featured-badge px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full transition-all duration-200 {{ $blog->featured ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-600 hover:bg-yellow-100 hover:text-yellow-800' }}">
                                        <i class="featured-icon {{ $blog->featured ? 'fas fa-star' : 'far fa-star' }} mr-1"></i>
                                        <span class="featured-text">{{ $blog->featured ? 'Featured' : 'Not Featured' }}</span>
                                    </span>
                                </button>
                            </td>
                            <td class="py-4 px-3 text-left align-top">
                                <div class="text-sm text-gray-600">
                                    {{ $blog->created_at->format('M d, Y') }}
                                </div>
                                @if($blog->published_at)
                                    <div class="text-xs text-gray-500">
                                        {{ $blog->published_at->format('H:i') }}
                                    </div>
                                @endif
                            </td>
                            <td class="py-4 px-3 text-center align-top">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('blog.show', $blog->slug) }}"
                                       target="_blank"
                                       class="text-gray-500 hover:text-primary-color transition-colors p-1"
                                       title="View Post">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.blogs.edit', $blog) }}"
                                       class="text-blue-500 hover:text-blue-700 transition-colors p-1"
                                       title="Edit Post">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.blogs.destroy', $blog) }}"
                                          method="POST"
                                          class="inline-block"
                                          onsubmit="return confirm('Are you sure you want to delete this blog post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-500 hover:text-red-700 transition-colors p-1"
                                                title="Delete Post">
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
                                    <i class="fas fa-blog text-4xl text-gray-300 mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">No blog posts found</h3>
                                    <p class="text-gray-500 mb-4">Get started by creating your first blog post.</p>
                                    <a href="{{ route('admin.blogs.create') }}"
                                       class="bg-primary-color hover:bg-opacity-90 text-white px-4 py-2 rounded-md font-medium">
                                        <i class="fas fa-plus mr-2"></i> Add New Post
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
        @forelse($blogs as $blog)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4">
                    <div class="flex items-start space-x-4">
                        @if($blog->featured_image)
                            <div class="flex-shrink-0">
                                <img src="{{ asset('storage/' . $blog->featured_image) }}"
                                     alt="{{ $blog->title }}"
                                     class="w-20 h-20 object-cover rounded-lg shadow-sm">
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="font-medium text-gray-900 leading-tight">
                                        {{ $blog->title }}
                                    </h3>
                                    @if($blog->excerpt)
                                        <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                                            {{ Str::limit($blog->excerpt, 100) }}
                                        </p>
                                    @endif
                                </div>
                                <div class="flex space-x-2 ml-4">
                                    <a href="{{ route('blog.show', $blog->slug) }}"
                                       target="_blank"
                                       class="text-gray-500 hover:text-primary-color transition-colors p-2"
                                       title="View Post">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.blogs.edit', $blog) }}"
                                       class="text-blue-500 hover:text-blue-700 transition-colors p-2"
                                       title="Edit Post">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.blogs.destroy', $blog) }}"
                                          method="POST"
                                          class="inline-block"
                                          onsubmit="return confirm('Are you sure you want to delete this blog post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-500 hover:text-red-700 transition-colors p-2"
                                                title="Delete Post">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-2 mt-3">
                                <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                                    {{ $blog->category->name ?? 'Uncategorized' }}
                                </span>

                                @if($blog->status == 'published')
                                    <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">
                                        <i class="fas fa-edit mr-1"></i>
                                        Draft
                                    </span>
                                @endif

                                @if($blog->featured)
                                    <span class="inline-flex items-center px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-medium">
                                        <i class="fas fa-star mr-1"></i>
                                        Featured
                                    </span>
                                @endif

                                <span class="text-xs text-gray-500">
                                    ID: {{ $blog->id }} • {{ $blog->created_at->format('M d, Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow-md p-8 text-center text-gray-500">
                <div class="flex flex-col items-center">
                    <i class="fas fa-blog text-4xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No blog posts found</h3>
                    <p class="text-gray-500 mb-4">Get started by creating your first blog post.</p>
                    <a href="{{ route('admin.blogs.create') }}"
                       class="bg-primary-color hover:bg-opacity-90 text-white px-4 py-2 rounded-md font-medium">
                        <i class="fas fa-plus mr-2"></i> Add New Post
                    </a>
                </div>
            </div>
        @endforelse
    </div>

        <div class="px-6 py-4">
            {{ $blogs->appends(request()->query())->links() }}
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        initFeaturedBlogToggles();
    });

    function initFeaturedBlogToggles() {
        const toggleButtons = document.querySelectorAll('.featured-toggle-blog');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                handleFeaturedBlogToggle(this);
            });
        });
    }

    function handleFeaturedBlogToggle(button) {
        const blogId = button.dataset.blogId;
        const currentFeatured = button.dataset.featured === 'true';
        const url = button.dataset.url;
        const badge = button.querySelector('.featured-badge');
        const icon = button.querySelector('.featured-icon');
        const text = button.querySelector('.featured-text');

        if (!badge || !icon || !text) {
            console.error('Required elements not found for featured toggle');
            showToast('Error: Unable to toggle featured status', 'error');
            return;
        }

        button.disabled = true;
        button.classList.add('updating');
        button.style.opacity = '0.7';
        button.style.cursor = 'not-allowed';

        // Save original state for error fallback
        const originalFeatured = currentFeatured;

        icon.className = 'featured-icon fas fa-spinner fa-spin mr-1';
        text.textContent = 'Updating...';

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                               document.querySelector('input[name="_token"]')?.value,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({})
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => Promise.reject(data));
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const newFeatured = data.featured;
                button.dataset.featured = newFeatured ? 'true' : 'false';
                updateFeaturedBlogButton(button, newFeatured);
                showToast(data.message, 'success');
            } else {
                throw new Error(data.message || 'Failed to update featured status');
            }
        })
        .catch(error => {
            console.error('Featured toggle error:', error);
            // Always reset to original state on error
            updateFeaturedBlogButton(button, originalFeatured);
            const errorMessage = error.message || 'Failed to update featured status. Please try again.';
            showToast(errorMessage, 'error');
        })
        .finally(() => {
            button.disabled = false;
            button.classList.remove('updating');
            button.style.opacity = '1';
            button.style.cursor = 'pointer';
        });
    }

    function updateFeaturedBlogButton(button, featured) {
        const badge = button.querySelector('.featured-badge');
        const icon = button.querySelector('.featured-icon');
        const text = button.querySelector('.featured-text');
        if (!badge || !icon || !text) {
            console.error('Required elements not found for button update');
            return;
        }
        icon.classList.remove('fa-spinner', 'fa-spin');
        if (featured) {
            badge.className = 'featured-badge px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full transition-all duration-200 bg-yellow-100 text-yellow-800';
            icon.className = 'featured-icon fas fa-star mr-1';
            text.textContent = 'Featured';
        } else {
            badge.className = 'featured-badge px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full transition-all duration-200 bg-gray-100 text-gray-600 hover:bg-yellow-100 hover:text-yellow-800';
            icon.className = 'featured-icon far fa-star mr-1';
            text.textContent = 'Not Featured';
        }
        if (badge) {
            badge.style.transform = 'scale(1.05)';
            setTimeout(() => {
                badge.style.transform = 'scale(1)';
            }, 200);
        }
    }

    function showToast(message, type = 'success') {
        const existingToasts = document.querySelectorAll('.toast-notification');
        existingToasts.forEach(toast => toast.remove());
        const toast = document.createElement('div');
        toast.className = `toast-notification fixed top-6 right-6 z-50 px-6 py-3 rounded-lg shadow-lg text-white font-semibold ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.remove();
        }, 2500);
    }
</script>
@endpush
