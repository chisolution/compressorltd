<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Testimonial::query();

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhere('testimonial', 'like', "%{$search}%");
            });
        }

        $testimonials = $query->latest()->paginate(10);

        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'testimonial' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'required|in:pending,approved,rejected',
            'featured' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');
        $data['featured'] = $request->has('featured');

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $this->imageService->uploadImage($request->file('image'), 'testimonials');
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'testimonial' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'required|in:pending,approved,rejected',
            'featured' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');
        $data['featured'] = $request->has('featured');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $data['image'] = $this->imageService->uploadImage($request->file('image'), 'testimonials');
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        // Delete image if exists
        if ($testimonial->image) {
            Storage::disk('public')->delete($testimonial->image);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully.');
    }

    /**
     * Approve a testimonial
     */
    public function approve(Testimonial $testimonial)
    {
        $testimonial->update(['status' => 'approved']);

        return redirect()->back()
            ->with('success', 'Testimonial approved successfully.');
    }

    /**
     * Reject a testimonial
     */
    public function reject(Testimonial $testimonial)
    {
        $testimonial->update(['status' => 'rejected']);

        return redirect()->back()
            ->with('success', 'Testimonial rejected.');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Testimonial $testimonial)
    {
        $testimonial->update(['featured' => !$testimonial->featured]);

        $status = $testimonial->featured ? 'featured' : 'unfeatured';
        return redirect()->back()
            ->with('success', "Testimonial {$status} successfully.");
    }

    /**
     * Remove the image from the testimonial.
     */
    public function removeImage(Testimonial $testimonial)
    {
        // Delete the image file
        if ($testimonial->image) {
            Storage::disk('public')->delete($testimonial->image);
        }

        // Update the database record
        $testimonial->update(['image' => null]);

        return back()->with('success', 'Image removed successfully.');
    }
}
