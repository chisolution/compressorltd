@extends('layouts.front')

@section('title', 'Products')

@section('content')
<!-- Page Title -->
<section class="relative bg-gradient-to-r from-gray-900 to-gray-700 text-white py-20">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">Our Products</h1>
        <nav class="flex justify-center" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fas fa-home mr-2"></i> Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="text-white font-medium">Products</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</section>
<!-- End Page Title -->

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col md:flex-row">
        <!-- Sidebar with categories -->
        <div class="w-full lg:w-1/4 pr-0 lg:pr-8 mb-8 lg:mb-0">
            <!-- Search Widget -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 border-b border-gray-200 pb-2">
                    <i class="fas fa-search mr-2 text-primary-color"></i>Search Products
                </h3>

                <form action="{{ route('products.index') }}" method="GET">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif

                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="w-full border-2 border-gray-300 rounded-lg shadow-sm py-3 px-4 pr-12 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 transition-all"
                               placeholder="Search products...">

                        <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-primary-color hover:bg-secondary-color text-white px-3 py-2 rounded-md transition-colors">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Categories Widget -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 border-b border-gray-200 pb-2">
                    <i class="fas fa-list mr-2 text-primary-color"></i>Categories
                </h3>

                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('products.index') }}"
                           class="flex items-center justify-between py-2 px-3 rounded-md transition-all {{ !request('category') ? 'bg-primary-color text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                            <span>All Products</span>
                            <span class="text-sm {{ !request('category') ? 'text-white' : 'text-gray-500' }}">
                                ({{ $products->total() }})
                            </span>
                        </a>
                    </li>

                    @foreach($categories->where('parent_id', null) as $category)
                        <li>
                            <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                               class="flex items-center justify-between py-2 px-3 rounded-md transition-all {{ request('category') == $category->slug ? 'bg-primary-color text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                                <span>{{ $category->name }}</span>
                                <span class="text-sm {{ request('category') == $category->slug ? 'text-white' : 'text-gray-500' }}">
                                    ({{ $category->products_count }})
                                </span>
                            </a>

                            @if($category->children->count() > 0)
                                <ul class="ml-4 mt-2 space-y-1">
                                    @foreach($category->children as $child)
                                        <li>
                                            <a href="{{ route('products.index', ['category' => $child->slug]) }}"
                                               class="flex items-center justify-between py-1 px-3 rounded-md text-sm transition-all {{ request('category') == $child->slug ? 'bg-primary-color text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                                                <span>{{ $child->name }}</span>
                                                <span class="text-xs {{ request('category') == $child->slug ? 'text-white' : 'text-gray-400' }}">
                                                    ({{ $child->products_count }})
                                                </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Main content -->
        <div class="w-full lg:w-3/4">
            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">
                            @if(request('category'))
                                @php
                                    $currentCategory = $categories->where('slug', request('category'))->first();
                                @endphp
                                {{ $currentCategory ? $currentCategory->name : 'Products' }}
                            @else
                                All Products
                            @endif
                        </h1>

                        @if(request('search'))
                            <p class="text-lg text-gray-600">
                                Search results for "<span class="font-semibold text-primary-color">{{ request('search') }}</span>"
                            </p>
                        @endif

                        <p class="text-gray-600 mt-1">
                            Showing {{ $products->count() }} of {{ $products->total() }} products
                        </p>
                    </div>

                    <!-- Sorting and View Options -->
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2">
                            <label for="sort" class="text-sm font-medium text-gray-700">Sort by:</label>
                            <select id="sort" name="sort" class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-primary-color">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name A-Z</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name Z-A</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price Low-High</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price High-Low</option>
                            </select>
                        </div>

                        <div class="flex border border-gray-300 rounded-md overflow-hidden">
                            <button class="px-3 py-2 bg-primary-color text-white hover:bg-secondary-color transition-colors" title="Grid View">
                                <i class="fas fa-th"></i>
                            </button>
                            <button class="px-3 py-2 bg-gray-100 text-gray-600 hover:bg-gray-200 transition-colors" title="List View">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($products as $product)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-2 group">
                            <div class="relative overflow-hidden">
                                <a href="{{ route('products.show', $product->slug) }}" class="block">
                                    <img src="{{ asset('storage/' . $product->primary_image) }}" alt="{{ $product->name }}"
                                         class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-105">

                                    <!-- Category Badge -->
                                    <div class="absolute top-4 left-4">
                                        <span class="bg-primary-color text-white px-3 py-1 rounded-full text-xs font-medium">
                                            {{ $product->category->name }}
                                        </span>
                                    </div>

                                    <!-- Sale Badge -->
                                    @if($product->hasDiscount())
                                        <div class="absolute top-4 right-4">
                                            <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold animate-pulse">
                                                @if($product->is_on_sale)
                                                    SALE
                                                @else
                                                    {{ number_format($product->getCalculatedDiscountPercentage(), 0) }}% OFF
                                                @endif
                                            </span>
                                        </div>
                                    @endif

                                    <!-- Hover Overlay -->
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                                        <div class="transform translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                            <span class="bg-white text-primary-color px-6 py-2 rounded-full font-semibold shadow-lg">
                                                <i class="fas fa-eye mr-2"></i>View Details
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="p-6">
                                <a href="{{ route('products.show', $product->slug) }}" class="block">
                                    <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-primary-color transition-colors">
                                        {{ $product->name }}
                                    </h3>

                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed">
                                        {{ $product->short_description }}
                                    </p>
                                </a>

                                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="fas fa-tag mr-2"></i>
                                        <span>{{ $product->category->name }}</span>
                                    </div>

                                    <a href="{{ route('products.show', $product->slug) }}"
                                       class="bg-primary-color hover:bg-secondary-color text-white px-4 py-2 rounded-md text-sm font-medium transition-all duration-200 transform hover:scale-105">
                                        Learn More
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    <div class="bg-white rounded-lg shadow-lg p-4">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-lg shadow-lg p-12 text-center">
                    <div class="max-w-md mx-auto">
                        <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-search text-gray-400 text-3xl"></i>
                        </div>

                        <h2 class="text-2xl font-bold text-gray-800 mb-4">No Products Found</h2>

                        <p class="text-gray-600 mb-8 leading-relaxed">
                            @if(request('search'))
                                We couldn't find any products matching "<span class="font-semibold text-primary-color">{{ request('search') }}</span>".
                                Try adjusting your search terms or browse our categories.
                            @elseif(request('category'))
                                There are no products in this category yet. Check back soon or explore other categories.
                            @else
                                There are no products available at the moment. Please check back later.
                            @endif
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            @if(request('search') || request('category'))
                                <a href="{{ route('products.index') }}"
                                   class="bg-primary-color hover:bg-secondary-color text-white px-6 py-3 rounded-md font-medium transition-colors">
                                    <i class="fas fa-grid-3x3 mr-2"></i>View All Products
                                </a>
                            @endif

                            <a href="{{ route('home') }}"
                               class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-6 py-3 rounded-md font-medium transition-colors">
                                <i class="fas fa-home mr-2"></i>Back to Home
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sort functionality
    const sortSelect = document.getElementById('sort');

    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const currentUrl = new URL(window.location.href);
            const params = new URLSearchParams(currentUrl.search);

            // Update or add the sort parameter
            if (this.value && this.value !== 'latest') {
                params.set('sort', this.value);
            } else {
                params.delete('sort');
            }

            // Remove page parameter to start from page 1
            params.delete('page');

            // Redirect to the new URL
            const newUrl = currentUrl.pathname + (params.toString() ? '?' + params.toString() : '');
            window.location.href = newUrl;
        });
    }
});
</script>
@endpush

@endsection
