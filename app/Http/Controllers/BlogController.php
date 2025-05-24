<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of published blog posts
     */
    public function index(Request $request)
    {
        $query = Blog::with('category')
            ->published()
            ->latest('published_at');

        // Filter by category if provided
        if ($request->has('category') && $request->category) {
            $category = BlogCategory::where('slug', $request->category)
                ->where('active', true)
                ->first();
            
            if ($category) {
                $query->where('blog_category_id', $category->id);
            }
        }

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $blogs = $query->paginate(9);
        $categories = BlogCategory::active()
            ->withCount(['blogs' => function($query) {
                $query->published();
            }])
            ->having('blogs_count', '>', 0)
            ->get();

        // Featured posts for sidebar
        $featuredPosts = Blog::published()
            ->featured()
            ->limit(3)
            ->get();

        // Recent posts for sidebar
        $recentPosts = Blog::published()
            ->latest('published_at')
            ->limit(5)
            ->get();

        // SEO Meta Data
        $seoData = [
            'title' => $request->has('category') && isset($category) 
                ? $category->name . ' - Blog' 
                : 'Blog',
            'description' => $request->has('category') && isset($category)
                ? "Read our latest articles about {$category->name}. Stay updated with industry insights, tips, and expert advice."
                : 'Stay updated with our latest blog posts, industry insights, product guides, and expert advice on power and compression solutions.',
            'keywords' => $request->has('category') && isset($category)
                ? $category->name . ', blog, articles, insights'
                : 'blog, articles, compressors, generators, power solutions, industry insights',
            'canonical' => request()->url(),
            'og_type' => 'website'
        ];

        return view('blog.index', compact(
            'blogs', 
            'categories', 
            'featuredPosts', 
            'recentPosts', 
            'seoData'
        ));
    }

    /**
     * Display the specified blog post
     */
    public function show($slug)
    {
        $blog = Blog::with('category')
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        // Get related posts from same category
        $relatedPosts = Blog::published()
            ->where('blog_category_id', $blog->blog_category_id)
            ->where('id', '!=', $blog->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        // Get previous and next posts
        $previousPost = Blog::published()
            ->where('published_at', '<', $blog->published_at)
            ->orderBy('published_at', 'desc')
            ->first();

        $nextPost = Blog::published()
            ->where('published_at', '>', $blog->published_at)
            ->orderBy('published_at', 'asc')
            ->first();

        // Recent posts for sidebar
        $recentPosts = Blog::published()
            ->where('id', '!=', $blog->id)
            ->latest('published_at')
            ->limit(5)
            ->get();

        // Categories for sidebar
        $categories = BlogCategory::active()
            ->withCount(['blogs' => function($query) {
                $query->published();
            }])
            ->having('blogs_count', '>', 0)
            ->get();

        // SEO Meta Data
        $seoData = [
            'title' => $blog->meta_title ?: $blog->title,
            'description' => $blog->meta_description ?: $blog->excerpt,
            'keywords' => $blog->meta_keywords ?: ($blog->category ? $blog->category->name . ', blog, article' : 'blog, article'),
            'canonical' => request()->url(),
            'og_type' => 'article',
            'og_image' => $blog->featured_image ? asset('storage/' . $blog->featured_image) : null,
            'article_author' => config('app.name'),
            'article_published_time' => $blog->published_at->toISOString(),
            'article_modified_time' => $blog->updated_at->toISOString(),
            'article_section' => $blog->category ? $blog->category->name : null,
            'article_tag' => $blog->category ? $blog->category->name : null
        ];

        return view('blog.show', compact(
            'blog', 
            'relatedPosts', 
            'previousPost', 
            'nextPost', 
            'recentPosts', 
            'categories',
            'seoData'
        ));
    }
}
