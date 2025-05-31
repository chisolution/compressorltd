@extends('admin.layouts.app')

@section('title', 'Comments Management')
@section('header', 'Comments Management')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <form method="GET" action="{{ route('admin.comments.index') }}" class="flex items-center w-full md:w-auto gap-2">
            <div class="relative w-full md:w-64">
                <span class="absolute left-3 top-2.5 text-gray-400"><i class="fas fa-search"></i></span>
                <input type="text" name="search" class="pl-10 pr-4 py-2 rounded border border-gray-300 w-full focus:ring-primary-color focus:border-primary-color text-sm" placeholder="Search comments..." value="{{ request('search') }}">
            </div>
            <button type="submit" class="bg-primary-color text-white px-4 py-2 rounded hover:bg-teal-600 transition text-sm font-semibold">Search</button>
        </form>
        <div class="flex gap-2 text-sm">
            <a href="{{ route('admin.comments.index') }}" class="px-3 py-1 rounded {{ !request('status') ? 'bg-primary-color text-white' : 'bg-gray-100 text-gray-700' }} font-semibold">All <span class="ml-1 text-xs font-bold">{{ $statusCounts['all'] }}</span></a>
            <a href="{{ route('admin.comments.index', ['status' => 'pending']) }}" class="px-3 py-1 rounded {{ request('status') === 'pending' ? 'bg-yellow-400 text-white' : 'bg-gray-100 text-gray-700' }} font-semibold">Pending <span class="ml-1 text-xs font-bold">{{ $statusCounts['pending'] }}</span></a>
            <a href="{{ route('admin.comments.index', ['status' => 'approved']) }}" class="px-3 py-1 rounded {{ request('status') === 'approved' ? 'bg-green-500 text-white' : 'bg-gray-100 text-gray-700' }} font-semibold">Approved <span class="ml-1 text-xs font-bold">{{ $statusCounts['approved'] }}</span></a>
            <a href="{{ route('admin.comments.index', ['status' => 'rejected']) }}" class="px-3 py-1 rounded {{ request('status') === 'rejected' ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-700' }} font-semibold">Rejected <span class="ml-1 text-xs font-bold">{{ $statusCounts['rejected'] }}</span></a>
        </div>
    </div>

    @if($comments->count() > 0)
    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full bg-white text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Comment</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Author</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Blog Post</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Date</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                <tr class="border-t border-gray-100 hover:bg-gray-50">
                    <td class="px-4 py-3 max-w-xs">
                        <div class="truncate">{{ Str::limit($comment->comment, 100) }}</div>
                        @if(strlen($comment->comment) > 100)
                        <a href="{{ route('admin.comments.show', $comment) }}" class="text-primary-color text-xs hover:underline">Read more</a>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="font-semibold">{{ $comment->name }}</div>
                        <div class="text-xs text-gray-500">{{ $comment->email }}</div>
                    </td>
                    <td class="px-4 py-3">
                        <a href="{{ route('blog.show', $comment->blog->slug) }}" target="_blank" class="text-primary-color hover:underline flex items-center gap-1">
                            {{ Str::limit($comment->blog->title, 40) }} <i class="fas fa-external-link-alt text-xs"></i>
                        </a>
                    </td>
                    <td class="px-4 py-3">
                        @if($comment->status === 'pending')
                        <span class="inline-block px-2 py-1 rounded bg-yellow-100 text-yellow-800 text-xs font-semibold">Pending</span>
                        @elseif($comment->status === 'approved')
                        <span class="inline-block px-2 py-1 rounded bg-green-100 text-green-800 text-xs font-semibold">Approved</span>
                        @else
                        <span class="inline-block px-2 py-1 rounded bg-red-100 text-red-800 text-xs font-semibold">Rejected</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        <div>{{ $comment->created_at->format('M j, Y') }}</div>
                        <div class="text-xs text-gray-500">{{ $comment->created_at->format('g:i A') }}</div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.comments.show', $comment) }}" class="text-blue-500 hover:text-blue-700" title="View"><i class="fas fa-eye"></i></a>
                            @if($comment->status !== 'approved')
                            <button type="button" class="text-green-600 hover:text-green-800 approve-comment" data-id="{{ $comment->id }}" title="Approve"><i class="fas fa-check"></i></button>
                            @endif
                            @if($comment->status !== 'rejected')
                            <button type="button" class="text-yellow-600 hover:text-yellow-800 reject-comment" data-id="{{ $comment->id }}" title="Reject"><i class="fas fa-times"></i></button>
                            @endif
                            <button type="button" class="text-red-600 hover:text-red-800 delete-comment" data-id="{{ $comment->id }}" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $comments->appends(request()->query())->links() }}
    </div>
    @else
    <div class="flex flex-col items-center justify-center py-16">
        <i class="fas fa-comments fa-3x text-gray-300 mb-4"></i>
        <h4 class="text-lg font-semibold text-gray-500 mb-2">No Comments Found</h4>
        <p class="text-gray-400">
            @if(request('search'))
                No comments match your search criteria.
            @elseif(request('status'))
                No {{ request('status') }} comments found.
            @else
                No comments have been submitted yet.
            @endif
        </p>
    </div>
    @endif

    <!-- Delete Confirmation Modal (Alpine.js) -->
    <div x-data="{ show: false, commentId: null }" x-show="show" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-40" style="display: none;">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h2 class="text-lg font-bold mb-4">Confirm Delete</h2>
            <p class="mb-4">Are you sure you want to delete this comment? This action cannot be undone.</p>
            <div class="flex justify-end gap-2">
                <button @click="show = false" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-700">Cancel</button>
                <form :action="`/admin/comments/${commentId}`" method="POST" @submit.prevent="$el.submit()" id="alpineDeleteForm">
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
document.addEventListener('alpine:init', () => {
    Alpine.data('deleteModal', () => ({
        show: false,
        commentId: null,
        open(id) {
            this.commentId = id;
            this.show = true;
        }
    }))
});

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
        const commentId = $(this).data('id');
        document.querySelector('[x-data]').__x.$data.show = true;
        document.querySelector('[x-data]').__x.$data.commentId = commentId;
    });
});
</script>
@endpush
@endsection
