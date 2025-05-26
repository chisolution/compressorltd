<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request, $slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $comment = Comment::create([
            'blog_id' => $blog->id,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your comment! It will be reviewed and published shortly.',
            'comment' => $comment
        ]);
    }
}
