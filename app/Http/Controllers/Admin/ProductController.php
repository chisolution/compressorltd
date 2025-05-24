<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products',
            'category_id' => 'required|exists:categories,id',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'additional_information' => 'nullable|string',
            'specifications' => 'nullable|string',
            'primary_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
            'featured' => 'boolean',
        ]);

        $data = $request->except(['primary_image', 'gallery_images']);

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($request->name);
        }

        // Handle primary image upload
        if ($request->hasFile('primary_image')) {
            $data['primary_image'] = $request->file('primary_image')->store('products', 'public');
        }

        // Create the product
        $product = Product::create($data);

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $imagePath = $image->store('products/gallery', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                    'sort_order' => 0,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return redirect()->route('admin.products.edit', $product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'additional_information' => 'nullable|string',
            'specifications' => 'nullable|string',
            'primary_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
            'featured' => 'boolean',
        ]);

        $data = $request->except(['primary_image', 'gallery_images']);

        // Handle primary image upload
        if ($request->hasFile('primary_image')) {
            // Delete old image
            if ($product->primary_image) {
                Storage::disk('public')->delete($product->primary_image);
            }

            $data['primary_image'] = $request->file('primary_image')->store('products', 'public');
        }

        // Update the product
        $product->update($data);

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $imagePath = $image->store('products/gallery', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                    'sort_order' => $product->images->count(),
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete primary image
        if ($product->primary_image) {
            Storage::disk('public')->delete($product->primary_image);
        }

        // Delete gallery images
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    /**
     * Remove a gallery image
     */
    public function removeImage(ProductImage $image)
    {
        // Delete the image file
        Storage::disk('public')->delete($image->image_path);

        // Delete the database record
        $image->delete();

        return back()->with('success', 'Image removed successfully.');
    }

    /**
     * View the product on the front-end
     */
    public function viewProduct(Product $product)
    {
        return redirect()->route('products.show', $product->slug);
    }

    /**
     * Toggle featured status of a product
     */
    public function toggleFeatured(Product $product)
    {
        try {
            $product->update(['featured' => !$product->featured]);

            $status = $product->featured ? 'featured' : 'unfeatured';
            $message = "Product {$status} successfully.";

            // Return JSON response for AJAX requests
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'featured' => $product->featured,
                    'product_id' => $product->id
                ]);
            }

            return redirect()->back()
                ->with('success', $message);

        } catch (\Exception $e) {
            \Log::error('Failed to toggle product featured status: ' . $e->getMessage());

            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update featured status. Please try again.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Failed to update featured status. Please try again.');
        }
    }
}
