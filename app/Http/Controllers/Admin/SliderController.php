<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::sorted()->paginate(10);
        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'active' => 'boolean',
        ]);

        $data = $request->except('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $this->imageService->uploadImage($request->file('image'), 'sliders');
        }

        Slider::create($data);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        return redirect()->route('admin.sliders.edit', $slider);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'active' => 'boolean',
        ]);

        $data = $request->except('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }

            $data['image'] = $this->imageService->uploadImage($request->file('image'), 'sliders');
        }

        $slider->update($data);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        // Delete image
        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider deleted successfully.');
    }

    /**
     * Update the sort order of sliders
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'sliders' => 'required|array',
            'sliders.*.id' => 'required|exists:sliders,id',
            'sliders.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->sliders as $sliderData) {
            $slider = Slider::find($sliderData['id']);
            $slider->update(['sort_order' => $sliderData['sort_order']]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Remove the image from the slider.
     */
    public function removeImage(Slider $slider)
    {
        // Delete the image file
        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }

        // Update the database record
        $slider->update(['image' => null]);

        return back()->with('success', 'Slider image removed successfully.');
    }
}
