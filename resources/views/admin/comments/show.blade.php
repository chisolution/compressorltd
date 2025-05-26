@extends('admin.layouts.app')

@section('title', 'View Comment')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Comment Details</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Back to Comments
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Comment Information -->
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Comment Content</h4>
                                </div>
                                <div class="card-body">
                                    <div class="comment-content">
                                        <p class="lead">{{ $comment->comment }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Blog Post Information -->
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h4 class="card-title">Blog Post</h4>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        @if($comment->blog->featured_image)
                                            <img src="{{ asset('storage/' . $comment->blog->featured_image) }}" 
                                                 alt="{{ $comment->blog->title }}" 
                                                 class="img-thumbnail mr-3" 
                                                 style="width: 100px; height: 80px; object-fit: cover;">
                                        @endif
                                        <div>
                                            <h5>
                                                <a href="{{ route('blog.show', $comment->blog->slug) }}" 
                                                   target="_blank" class="text-primary">
                                                    {{ $comment->blog->title }}
                                                    <i class="fas fa-external-link-alt ml-1"></i>
                                                </a>
                                            </h5>
                                            <p class="text-muted mb-2">{{ Str::limit($comment->blog->excerpt, 150) }}</p>
                                            <small class="text-muted">
                                                Published: {{ $comment->blog->published_at->format('M j, Y') }}
                                                @if($comment->blog->category)
                                                    | Category: {{ $comment->blog->category->name }}
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Comment Metadata -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Comment Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="info-group mb-3">
                                        <label class="font-weight-bold">Author:</label>
                                        <p class="mb-1">{{ $comment->name }}</p>
                                        <small class="text-muted">{{ $comment->email }}</small>
                                    </div>

                                    <div class="info-group mb-3">
                                        <label class="font-weight-bold">Status:</label>
                                        <div>
                                            @if($comment->status === 'pending')
                                                <span class="badge badge-warning badge-lg">Pending Review</span>
                                            @elseif($comment->status === 'approved')
                                                <span class="badge badge-success badge-lg">Approved</span>
                                            @else
                                                <span class="badge badge-danger badge-lg">Rejected</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="info-group mb-3">
                                        <label class="font-weight-bold">Submitted:</label>
                                        <p class="mb-0">{{ $comment->created_at->format('F j, Y') }}</p>
                                        <small class="text-muted">{{ $comment->created_at->format('g:i A') }}</small>
                                    </div>

                                    @if($comment->approved_at)
                                        <div class="info-group mb-3">
                                            <label class="font-weight-bold">Approved:</label>
                                            <p class="mb-0">{{ $comment->approved_at->format('F j, Y') }}</p>
                                            <small class="text-muted">{{ $comment->approved_at->format('g:i A') }}</small>
                                        </div>
                                    @endif

                                    <!-- Action Buttons -->
                                    <div class="mt-4">
                                        <h5>Actions</h5>
                                        <div class="btn-group-vertical w-100" role="group">
                                            @if($comment->status !== 'approved')
                                                <button type="button" 
                                                        class="btn btn-success mb-2 approve-comment" 
                                                        data-id="{{ $comment->id }}">
                                                    <i class="fas fa-check mr-2"></i>Approve Comment
                                                </button>
                                            @endif

                                            @if($comment->status !== 'rejected')
                                                <button type="button" 
                                                        class="btn btn-warning mb-2 reject-comment" 
                                                        data-id="{{ $comment->id }}">
                                                    <i class="fas fa-times mr-2"></i>Reject Comment
                                                </button>
                                            @endif

                                            <button type="button" 
                                                    class="btn btn-danger delete-comment" 
                                                    data-id="{{ $comment->id }}">
                                                <i class="fas fa-trash mr-2"></i>Delete Comment
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this comment? This action cannot be undone.</p>
                <div class="alert alert-warning">
                    <strong>Comment by:</strong> {{ $comment->name }}<br>
                    <strong>Content:</strong> {{ Str::limit($comment->comment, 100) }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" action="{{ route('admin.comments.destroy', $comment) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Comment</button>
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

    // Delete comment
    $('.delete-comment').click(function() {
        $('#deleteModal').modal('show');
    });
});
</script>
@endpush
@endsection
