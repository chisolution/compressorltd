<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Product;
use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get active sliders ordered by sort_order
        $sliders = Slider::active()->sorted()->get();

        // Get featured products first, if none exist, get the first 6 active products
        $featuredProducts = Product::with('category')
            ->active()
            ->featured()
            ->take(6)
            ->get();

        $showingFeatured = $featuredProducts->isNotEmpty();

        // If no featured products, get the first 6 active products
        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::with('category')
                ->active()
                ->latest()
                ->take(6)
                ->get();
        }

        // Get latest blog posts for homepage
        $latestBlogs = Blog::with('category')
            ->published()
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('home', compact('sliders', 'featuredProducts', 'latestBlogs', 'showingFeatured'));
    }
}
