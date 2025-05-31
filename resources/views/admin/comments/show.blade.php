@extends('admin.layouts.app')

@section('title', 'View Comment')
@section('header', 'Comment Details')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Main Content -->
        <div class="flex-1">
            <div class="mb-6">
                <a href="{{ route('admin.comments.index') }}" class="inline-flex items-center text-primary-color hover:underline text-sm font-semibold mb-2">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Comments
                </a>
            </div>
            <div class="mb-6">
                <h2 class="text-lg font-bold mb-2">Comment Content</h2>
                <div class="bg-gray-50 rounded p-4 text-gray-800 text-base">{{ $comment->comment }}</div>
            </div>
            <div>
                <h2 class="text-lg font-bold mb-2">Blog Post</h2>
                <div class="flex items-start gap-4">
                    @if($comment->blog->featured_image)
                        <img src="{{ asset('storage/' . $comment->blog->featured_image) }}" alt="{{ $comment->blog->title }}" class="rounded w-28 h-20 object-cover border">
                    @endif
                    <div>
                        <a href="{{ route('blog.show', $comment->blog->slug) }}" target="_blank" class="text-primary-color font-semibold hover:underline flex items-center gap-1">
                            {{ $comment->blog->title }} <i class="fas fa-external-link-alt text-xs"></i>
                        </a>
                        <p class="text-gray-500 text-sm mt-1 mb-2">{{ Str::limit($comment->blog->excerpt, 120) }}</p>
                        <div class="text-xs text-gray-400">
                            Published: {{ $comment->blog->published_at->format('M j, Y') }}
                            @if($comment->blog->category)
                                | Category: {{ $comment->blog->category->name }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar -->
        <div class="w-full md:w-80">
            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <h3 class="font-semibold mb-2 text-gray-700">Comment Information</h3>
                <div class="mb-3">
                    <div class="font-semibold">Author:</div>
                    <div>{{ $comment->name }}</div>
                    <div class="text-xs text-gray-500">{{ $comment->email }}</div>
                </div>
                <div class="mb-3">
                    <div class="font-semibold">Status:</div>
                    @if($comment->status === 'pending')
                        <span class="inline-block px-2 py-1 rounded bg-yellow-100 text-yellow-800 text-xs font-semibold">Pending Review</span>
                    @elseif($comment->status === 'approved')
                        <span class="inline-block px-2 py-1 rounded bg-green-100 text-green-800 text-xs font-semibold">Approved</span>
                    @else
                        <span class="inline-block px-2 py-1 rounded bg-red-100 text-red-800 text-xs font-semibold">Rejected</span>
                    @endif
                </div>
                <div class="mb-3">
                    <div class="font-semibold">Submitted:</div>
                    <div>{{ $comment->created_at->format('F j, Y') }}</div>
                    <div class="text-xs text-gray-500">{{ $comment->created_at->format('g:i A') }}</div>
                </div>
                @if($comment->approved_at)
                <div class="mb-3">
                    <div class="font-semibold">Approved:</div>
                    <div>{{ $comment->approved_at->format('F j, Y') }}</div>
                    <div class="text-xs text-gray-500">{{ $comment->approved_at->format('g:i A') }}</div>
                </div>
                @endif
                <div class="mb-3">
                    <div class="font-semibold">Featured:</div>
                    <button type="button"
                        class="featured-toggle-blog flex items-center transition-all duration-200 mt-1"
                        data-blog-id="{{ $comment->blog->id }}"
                        data-featured="{{ $comment->blog->featured ? 'true' : 'false' }}"
                        data-url="{{ route('admin.blogs.toggle-featured', $comment->blog) }}">
                        <span class="featured-badge px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full transition-all duration-200
                            {{ $comment->blog->featured
                                ? 'bg-yellow-100 text-yellow-800'
                                : 'bg-gray-100 text-gray-600 hover:bg-yellow-100 hover:text-yellow-800' }}">
                            <i class="featured-icon {{ $comment->blog->featured ? 'fas fa-star' : 'far fa-star' }} mr-1"></i>
                            <span class="featured-text">{{ $comment->blog->featured ? 'Featured' : 'Not Featured' }}</span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="font-semibold mb-2 text-gray-700">Actions</h3>
                <div class="flex flex-col gap-2">
                    @if($comment->status !== 'approved')
                    <button type="button" class="px-4 py-2 rounded bg-green-500 text-white hover:bg-green-600 font-semibold approve-comment" data-id="{{ $comment->id }}">
                        <i class="fas fa-check mr-2"></i>Approve
                    </button>
                    @endif
                    @if($comment->status !== 'rejected')
                    <button type="button" class="px-4 py-2 rounded bg-yellow-400 text-white hover:bg-yellow-500 font-semibold reject-comment" data-id="{{ $comment->id }}">
                        <i class="fas fa-times mr-2"></i>Reject
                    </button>
                    @endif
                    <button type="button" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700 font-semibold delete-comment" data-id="{{ $comment->id }}">
                        <i class="fas fa-trash mr-2"></i>Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Confirmation Modal (Alpine.js) -->
    <div x-data="{ show: false }" x-show="show" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-40" style="display: none;">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h2 class="text-lg font-bold mb-4">Confirm Delete</h2>
            <p class="mb-4">Are you sure you want to delete this comment? This action cannot be undone.</p>
            <div class="flex justify-end gap-2">
                <button @click="show = false" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-700">Cancel</button>
                <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Approve comment
    $('.approve-comment').click(function() {
        const commentId = $(this).data('id');
        $.ajax({
            url: `/admin/comments/${commentId}/approve`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                }
            },
            error: function() {
                alert('Error approving comment. Please try again.');
            }
        });
    });
    // Reject comment
    $('.reject-comment').click(function() {
        const commentId = $(this).data('id');
        $.ajax({
            url: `/admin/comments/${commentId}/reject`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                }
            },
            error: function() {
                alert('Error rejecting comment. Please try again.');
            }
        });
    });
    // Delete comment (Alpine modal)
    $('.delete-comment').click(function() {
        document.querySelector('[x-data]').__x.$data.show = true;
    });
    // Toggle featured blog post
    $('.featured-toggle-blog').click(function() {
        const button = $(this);
        const blogId = button.data('blog-id');
        const isFeatured = button.data('featured') === 'true';
        const url = button.data('url');

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                featured: !isFeatured
            },
            success: function(response) {
                if (response.success) {
                    button.data('featured', !isFeatured);
                    button.find('.featured-icon').toggleClass('fas fa-star far fa-star');
                    button.find('.featured-text').text(!isFeatured ? 'Featured' : 'Not Featured');
                    button.find('.featured-badge').toggleClass('bg-yellow-100 text-yellow-800 bg-gray-100 text-gray-600 hover:bg-yellow-100 hover:text-yellow-800');
                }
            },
            error: function() {
                alert('Error toggling featured status. Please try again.');
            }
        });
    });
});
document.addEventListener('DOMContentLoaded', function() {
    initFeaturedBlogToggles();
});
function initFeaturedBlogToggles() {
    const toggleButtons = document.querySelectorAll('.featured-toggle-blog');
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (confirm('Are you sure you want to toggle the featured status for this blog post?')) {
                handleFeaturedBlogToggle(this);
            }
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
        alert('Error: Unable to toggle featured status');
        return;
    }
    button.disabled = true;
    button.classList.add('updating');
    button.style.opacity = '0.7';
    button.style.cursor = 'not-allowed';
    const originalIconClass = icon.className;
    const originalText = text.textContent;
    icon.className = 'fas fa-spinner fa-spin mr-1';
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
        icon.className = originalIconClass;
        text.textContent = originalText;
        alert(error.message || 'Failed to update featured status. Please try again.');
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
    if (!badge || !icon || !text) return;
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
@endsection
