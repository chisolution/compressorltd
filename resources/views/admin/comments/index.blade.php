@extends('admin.layouts.app')

@section('title', 'Comments Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Comments Management</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <form method="GET" action="{{ route('admin.comments.index') }}" class="d-flex">
                                <input type="text" name="search" class="form-control float-right"
                                       placeholder="Search comments..." value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Status Filter Tabs -->
                <div class="card-body p-0">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ !request('status') ? 'active' : '' }}"
                                   href="{{ route('admin.comments.index') }}">
                                    All Comments
                                    <span class="badge badge-secondary ml-1">{{ $statusCounts['all'] }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request('status') === 'pending' ? 'active' : '' }}"
                                   href="{{ route('admin.comments.index', ['status' => 'pending']) }}">
                                    Pending
                                    <span class="badge badge-warning ml-1">{{ $statusCounts['pending'] }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request('status') === 'approved' ? 'active' : '' }}"
                                   href="{{ route('admin.comments.index', ['status' => 'approved']) }}">
                                    Approved
                                    <span class="badge badge-success ml-1">{{ $statusCounts['approved'] }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request('status') === 'rejected' ? 'active' : '' }}"
                                   href="{{ route('admin.comments.index', ['status' => 'rejected']) }}">
                                    Rejected
                                    <span class="badge badge-danger ml-1">{{ $statusCounts['rejected'] }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    @if($comments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Comment</th>
                                        <th>Author</th>
                                        <th>Blog Post</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($comments as $comment)
                                        <tr>
                                            <td>
                                                <div class="comment-preview">
                                                    <p class="mb-1">{{ Str::limit($comment->comment, 100) }}</p>
                                                    @if(strlen($comment->comment) > 100)
                                                        <small class="text-muted">
                                                            <a href="{{ route('admin.comments.show', $comment) }}" class="text-primary">
                                                                Read more...
                                                            </a>
                                                        </small>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <strong>{{ $comment->name }}</strong><br>
                                                    <small class="text-muted">{{ $comment->email }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('blog.show', $comment->blog->slug) }}"
                                                   target="_blank" class="text-primary">
                                                    {{ Str::limit($comment->blog->title, 50) }}
                                                    <i class="fas fa-external-link-alt ml-1"></i>
                                                </a>
                                            </td>
                                            <td>
                                                @if($comment->status === 'pending')
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif($comment->status === 'approved')
                                                    <span class="badge badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td>
                                                <small>
                                                    {{ $comment->created_at->format('M j, Y') }}<br>
                                                    {{ $comment->created_at->format('g:i A') }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.comments.show', $comment) }}"
                                                       class="btn btn-sm btn-info" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    @if($comment->status !== 'approved')
                                                        <button type="button"
                                                                class="btn btn-sm btn-success approve-comment"
                                                                data-id="{{ $comment->id }}"
                                                                title="Approve">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    @endif

                                                    @if($comment->status !== 'rejected')
                                                        <button type="button"
                                                                class="btn btn-sm btn-warning reject-comment"
                                                                data-id="{{ $comment->id }}"
                                                                title="Reject">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    @endif

                                                    <button type="button"
                                                            class="btn btn-sm btn-danger delete-comment"
                                                            data-id="{{ $comment->id }}"
                                                            title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="card-footer">
                            {{ $comments->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No Comments Found</h4>
                            <p class="text-muted">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
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
        const button = $(this);

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
        const button = $(this);

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
        const commentId = $(this).data('id');
        const deleteForm = $('#deleteForm');
        deleteForm.attr('action', `/admin/comments/${commentId}`);
        $('#deleteModal').modal('show');
    });
});
</script>
@endpush
@endsection
