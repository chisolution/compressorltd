@extends('layouts.front')

@section('title', $seoData['title'] . ' - ' . ($siteSettings['company_name'] ?? config('app.name')))

@push('meta')
    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ $seoData['description'] }}">
    <meta name="keywords" content="{{ $seoData['keywords'] }}">
    <link rel="canonical" href="{{ $seoData['canonical'] }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $seoData['title'] }} - {{ $siteSettings['company_name'] ?? config('app.name') }}">
    <meta property="og:description" content="{{ $seoData['description'] }}">
    <meta property="og:type" content="{{ $seoData['og_type'] }}">
    <meta property="og:url" content="{{ $seoData['canonical'] }}">
    <meta property="og:site_name" content="{{ $siteSettings['company_name'] ?? config('app.name') }}">
    @if(isset($siteSettings['company_logo']) && $siteSettings['company_logo'])
        <meta property="og:image" content="{{ asset('storage/' . $siteSettings['company_logo']) }}">
    @endif

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoData['title'] }} - {{ $siteSettings['company_name'] ?? config('app.name') }}">
    <meta name="twitter:description" content="{{ $seoData['description'] }}">
    @if(isset($siteSettings['company_logo']) && $siteSettings['company_logo'])
        <meta name="twitter:image" content="{{ asset('storage/' . $siteSettings['company_logo']) }}">
    @endif

    <!-- Pagination Meta Tags -->
    @if($blogs->hasPages())
        @if($blogs->currentPage() > 1)
            <link rel="prev" href="{{ $blogs->previousPageUrl() }}">
        @endif
        @if($blogs->hasMorePages())
            <link rel="next" href="{{ $blogs->nextPageUrl() }}">
        @endif
    @endif
@endpush

@push('structured-data')
    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Blog",
        "name": "{{ $seoData['title'] }} - {{ $siteSettings['company_name'] ?? config('app.name') }}",
        "description": "{{ $seoData['description'] }}",
        "url": "{{ $seoData['canonical'] }}",
        "publisher": {
            "@type": "Organization",
            "name": "{{ $siteSettings['company_name'] ?? config('app.name') }}",
            "url": "{{ route('home') }}"
            @if(isset($siteSettings['company_logo']) && $siteSettings['company_logo'])
            ,"logo": {
                "@type": "ImageObject",
                "url": "{{ asset('storage/' . $siteSettings['company_logo']) }}"
            }
            @endif
        },
        "blogPost": [
            @foreach($blogs as $index => $blog)
            {
                "@type": "BlogPosting",
                "headline": "{{ $blog->title }}",
                "description": "{{ $blog->excerpt }}",
                "url": "{{ route('blog.show', $blog->slug) }}",
                "datePublished": "{{ $blog->published_at->toISOString() }}",
                "dateModified": "{{ $blog->updated_at->toISOString() }}",
                "author": {
                    "@type": "Organization",
                    "name": "{{ $siteSettings['company_name'] ?? config('app.name') }}"
                },
                "publisher": {
                    "@type": "Organization",
                    "name": "{{ $siteSettings['company_name'] ?? config('app.name') }}"
                }
                @if($blog->featured_image)
                ,"image": {
                    "@type": "ImageObject",
                    "url": "{{ asset('storage/' . $blog->featured_image) }}"
                }
                @endif
                @if($blog->category)
                ,"articleSection": "{{ $blog->category->name }}"
                @endif
            }@if(!$loop->last),@endif
            @endforeach
        ]
    }
    </script>

    <!-- Breadcrumb Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Home",
                "item": "{{ route('home') }}"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "Blog",
                "item": "{{ route('blog.index') }}"
            }
            @if(request('category'))
                @php
                    $currentCategory = $categories->where('slug', request('category'))->first();
                @endphp
                @if($currentCategory)
                ,{
                    "@type": "ListItem",
                    "position": 3,
                    "name": "{{ $currentCategory->name }}",
                    "item": "{{ request()->url() }}"
                }
                @endif
            @endif
        ]
    }
    </script>
@endpush

@section('content')
    <!-- Page Title Section -->
    <div class="bg-gradient-to-r from-primary-color to-secondary-color text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $seoData['title'] }}</h1>
                <p class="text-xl md:text-2xl text-blue-100 mb-6">Stay updated with our latest insights and industry news</p>
                <div class="flex items-center justify-center space-x-2 text-blue-100">
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                    <i class="fas fa-chevron-right text-sm"></i>
                    <span>Blog</span>
                    @if(request('category'))
                        @php
                            $currentCategory = $categories->where('slug', request('category'))->first();
                        @endphp
                        @if($currentCategory)
                            <i class="fas fa-chevron-right text-sm"></i>
                            <span>{{ $currentCategory->name }}</span>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Content -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <!-- Search and Filter Bar -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                        <div class="flex flex-col md:flex-row gap-4">
                            <!-- Search Form -->
                            <form method="GET" action="{{ route('blog.index') }}" class="flex-1">
                                @if(request('category'))
                                    <input type="hidden" name="category" value="{{ request('category') }}">
                                @endif
                                <div class="relative">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                           placeholder="Search blog posts..."
                                           class="w-full border-2 border-gray-300 rounded-lg shadow-sm py-3 px-4 pr-12 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 transition-all">
                                    <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-primary-color">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>

                            <!-- Category Filter -->
                            <div class="md:w-64">
                                <select onchange="window.location.href=this.value"
                                        class="w-full border-2 border-gray-300 rounded-lg shadow-sm py-3 px-4 bg-white focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50 transition-all">
                                    <option value="{{ route('blog.index') }}">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ route('blog.index', ['category' => $category->slug]) }}"
                                                {{ request('category') == $category->slug ? 'selected' : '' }}>
                                            {{ $category->name }} ({{ $category->blogs_count }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @if(request('search') || request('category'))
                            <div class="mt-4 flex items-center justify-between">
                                <div class="text-sm text-gray-600">
                                    @if(request('search'))
                                        Search results for "<span class="font-semibold text-primary-color">{{ request('search') }}</span>"
                                    @endif
                                    @if(request('category'))
                                        @php
                                            $currentCategory = $categories->where('slug', request('category'))->first();
                                        @endphp
                                        @if($currentCategory)
                                            in category "<span class="font-semibold text-primary-color">{{ $currentCategory->name }}</span>"
                                        @endif
                                    @endif
                                    - {{ $blogs->total() }} {{ Str::plural('post', $blogs->total()) }} found
                                </div>
                                <a href="{{ route('blog.index') }}" class="text-sm text-primary-color hover:text-secondary-color">
                                    <i class="fas fa-times mr-1"></i>Clear filters
                                </a>
                            </div>
                        @endif
                    </div>

                    @if($blogs->count() > 0)
                        <!-- Blog Posts Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 mb-12">
                            @foreach($blogs as $blog)
                                <article class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-2 group">
                                    <div class="relative overflow-hidden">
                                        <a href="{{ route('blog.show', $blog->slug) }}" class="block">
                                            <img src="{{ asset('storage/' . $blog->featured_image) }}"
                                                 alt="{{ $blog->title }}"
                                                 class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">

                                            <!-- Category Badge -->
                                            @if($blog->category)
                                                <div class="absolute top-4 left-4">
                                                    <span class="bg-primary-color text-white px-3 py-1 rounded-full text-xs font-medium">
                                                        {{ $blog->category->name }}
                                                    </span>
                                                </div>
                                            @endif

                                            <!-- Featured Badge -->
                                            @if($blog->featured)
                                                <div class="absolute top-4 right-4">
                                                    <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-medium">
                                                        <i class="fas fa-star mr-1"></i>Featured
                                                    </span>
                                                </div>
                                            @endif
                                        </a>
                                    </div>

                                    <div class="p-6">
                                        <!-- Meta Information -->
                                        <div class="flex items-center text-sm text-gray-500 mb-3">
                                            <i class="far fa-calendar-alt mr-2"></i>
                                            <time datetime="{{ $blog->published_at->toISOString() }}">
                                                {{ $blog->published_at->format('M j, Y') }}
                                            </time>
                                            @if($blog->category)
                                                <span class="mx-2">•</span>
                                                <i class="far fa-folder mr-2"></i>
                                                <span>{{ $blog->category->name }}</span>
                                            @endif
                                        </div>

                                        <!-- Title and Excerpt -->
                                        <h2 class="text-xl font-bold mb-3 group-hover:text-primary-color transition-colors">
                                            <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                                        </h2>

                                        <p class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed">
                                            {{ $blog->excerpt }}
                                        </p>

                                        <!-- Read More Button -->
                                        <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                            <span class="text-xs text-gray-500">
                                                {{ Str::words(strip_tags($blog->content), 50, '...') !== strip_tags($blog->content) ?
                                                   ceil(str_word_count(strip_tags($blog->content)) / 200) . ' min read' :
                                                   '1 min read' }}
                                            </span>
                                            <a href="{{ route('blog.show', $blog->slug) }}"
                                               class="bg-primary-color hover:bg-secondary-color text-white px-4 py-2 rounded-md text-sm font-medium transition-all duration-200 transform hover:scale-105">
                                                Read More
                                                <i class="fas fa-arrow-right ml-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="flex justify-center">
                            <div class="bg-white rounded-lg shadow-md p-4">
                                {{ $blogs->appends(request()->query())->links() }}
                            </div>
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="bg-white rounded-lg shadow-md p-12 text-center">
                            <div class="max-w-md mx-auto">
                                <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-blog text-gray-400 text-3xl"></i>
                                </div>

                                <h2 class="text-2xl font-bold text-gray-800 mb-4">No Blog Posts Found</h2>

                                <p class="text-gray-600 mb-8 leading-relaxed">
                                    @if(request('search'))
                                        We couldn't find any blog posts matching "<span class="font-semibold text-primary-color">{{ request('search') }}</span>".
                                        Try adjusting your search terms or browse our categories.
                                    @elseif(request('category'))
                                        There are no blog posts in this category yet. Check back soon or explore other categories.
                                    @else
                                        There are no blog posts available at the moment. Please check back later.
                                    @endif
                                </p>

                                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                    @if(request('search') || request('category'))
                                        <a href="{{ route('blog.index') }}"
                                           class="bg-primary-color hover:bg-secondary-color text-white px-6 py-3 rounded-md font-medium transition-colors">
                                            <i class="fas fa-blog mr-2"></i>View All Posts
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

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="space-y-8">
                        <!-- Featured Posts -->
                        @if($featuredPosts->count() > 0)
                            <div class="bg-white rounded-lg shadow-md p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-4">
                                    <i class="fas fa-star text-yellow-500 mr-2"></i>Featured Posts
                                </h3>
                                <div class="space-y-4">
                                    @foreach($featuredPosts as $post)
                                        <div class="flex space-x-3">
                                            <img src="{{ asset('storage/' . $post->featured_image) }}"
                                                 alt="{{ $post->title }}"
                                                 class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
                                            <div class="flex-1 min-w-0">
                                                <h4 class="text-sm font-semibold text-gray-800 line-clamp-2 mb-1">
                                                    <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-primary-color transition-colors">
                                                        {{ $post->title }}
                                                    </a>
                                                </h4>
                                                <p class="text-xs text-gray-500">
                                                    <i class="far fa-calendar-alt mr-1"></i>
                                                    {{ $post->published_at->format('M j, Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Categories -->
                        @if($categories->count() > 0)
                            <div class="bg-white rounded-lg shadow-md p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-4">
                                    <i class="fas fa-folder text-primary-color mr-2"></i>Categories
                                </h3>
                                <div class="space-y-2">
                                    @foreach($categories as $category)
                                        <a href="{{ route('blog.index', ['category' => $category->slug]) }}"
                                           class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors {{ request('category') == $category->slug ? 'bg-primary-color text-white hover:bg-primary-color' : 'text-gray-700' }}">
                                            <span class="font-medium">{{ $category->name }}</span>
                                            <span class="text-sm {{ request('category') == $category->slug ? 'text-blue-100' : 'text-gray-500' }}">
                                                {{ $category->blogs_count }}
                                            </span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Recent Posts -->
                        @if($recentPosts->count() > 0)
                            <div class="bg-white rounded-lg shadow-md p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-4">
                                    <i class="fas fa-clock text-primary-color mr-2"></i>Recent Posts
                                </h3>
                                <div class="space-y-4">
                                    @foreach($recentPosts as $post)
                                        <div class="flex space-x-3">
                                            <img src="{{ asset('storage/' . $post->featured_image) }}"
                                                 alt="{{ $post->title }}"
                                                 class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
                                            <div class="flex-1 min-w-0">
                                                <h4 class="text-sm font-semibold text-gray-800 line-clamp-2 mb-1">
                                                    <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-primary-color transition-colors">
                                                        {{ $post->title }}
                                                    </a>
                                                </h4>
                                                <p class="text-xs text-gray-500">
                                                    <i class="far fa-calendar-alt mr-1"></i>
                                                    {{ $post->published_at->format('M j, Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Newsletter Signup -->
                        <div class="bg-gradient-to-br from-primary-color to-secondary-color rounded-lg shadow-md p-6 text-white">
                            <h3 class="text-xl font-bold mb-4">
                                <i class="fas fa-envelope mr-2"></i>Stay Updated
                            </h3>
                            <p class="text-blue-100 mb-4 text-sm">
                                Subscribe to our newsletter and get the latest blog posts delivered to your inbox.
                            </p>
                            <form id="blog-newsletter-form" action="{{ route('newsletters.store') }}" method="POST" class="space-y-3">
                                @csrf
                                <input type="email" name="email" id="blog-newsletter-email" placeholder="Enter your email" required
                                       class="w-full px-4 py-2 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 border border-gray-300">
                                <button type="submit" id="blog-newsletter-btn"
                                        class="w-full bg-white text-primary-color px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors">
                                    <i class="fas fa-paper-plane mr-2"></i>Subscribe Now
                                </button>
                                <div id="blog-newsletter-message" class="hidden"></div>
                            </form>
                        </div>

                        <!-- Contact CTA -->
                        <div class="bg-white rounded-lg shadow-md p-6 text-center">
                            <div class="w-16 h-16 bg-primary-color rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-phone text-white text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mb-2">Need Help?</h3>
                            <p class="text-gray-600 text-sm mb-4">
                                Have questions about our products or services? Our team is here to help.
                            </p>
                            <a href="{{ route('contact.index') }}"
                               class="bg-primary-color hover:bg-secondary-color text-white px-6 py-2 rounded-lg font-medium transition-colors inline-block">
                                Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
