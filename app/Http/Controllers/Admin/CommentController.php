<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Blog;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Comment::with('blog');

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('comment', 'like', "%{$search}%")
                  ->orWhereHas('blog', function($blogQuery) use ($search) {
                      $blogQuery->where('title', 'like', "%{$search}%");
                  });
            });
        }

        $comments = $query->latest()->paginate(20);

        // Get counts for status badges
        $statusCounts = [
            'all' => Comment::count(),
            'pending' => Comment::where('status', 'pending')->count(),
            'approved' => Comment::where('status', 'approved')->count(),
            'rejected' => Comment::where('status', 'rejected')->count(),
        ];

        return view('admin.comments.index', compact('comments', 'statusCounts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $comment->load('blog');
        return view('admin.comments.show', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $comment->update([
            'status' => $request->status,
            'approved_at' => $request->status === 'approved' ? now() : null,
        ]);

        return redirect()->back()->with('success', 'Comment status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments.index')->with('success', 'Comment deleted successfully.');
    }

    /**
     * Approve a comment
     */
    public function approve(Comment $comment)
    {
        $comment->approve();
        return response()->json(['success' => true, 'message' => 'Comment approved successfully.']);
    }

    /**
     * Reject a comment
     */
    public function reject(Comment $comment)
    {
        $comment->reject();
        return response()->json(['success' => true, 'message' => 'Comment rejected successfully.']);
    }
}
