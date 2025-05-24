<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Display a listing of approved testimonials.
     */
    public function index()
    {
        $testimonials = Testimonial::approved()
            ->latest()
            ->paginate(12);

        $featuredTestimonials = Testimonial::approved()
            ->featured()
            ->latest()
            ->limit(3)
            ->get();

        return view('testimonials.index', compact('testimonials', 'featuredTestimonials'));
    }

    /**
     * Show the form for creating a new testimonial.
     */
    public function create()
    {
        return view('testimonials.create');
    }

    /**
     * Store a newly created testimonial in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'testimonial' => 'required|string|min:50',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'company', 'position', 'testimonial', 'rating']);
        $data['status'] = 'pending';

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('testimonials', 'public');
        }

        Testimonial::create($data);

        return redirect()->route('testimonials.create')
            ->with('success', 'Thank you for your valuable feedback!');
    }
}
