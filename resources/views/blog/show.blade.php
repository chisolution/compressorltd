@extends('layouts.front')

@section('title', $seoData['title'] . ' - ' . ($siteSettings['company_name'] ?? config('app.name')))

@push('meta')
    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ $seoData['description'] }}">
    <meta name="keywords" content="{{ $seoData['keywords'] }}">
    <link rel="canonical" href="{{ $seoData['canonical'] }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $seoData['title'] }}">
    <meta property="og:description" content="{{ $seoData['description'] }}">
    <meta property="og:type" content="{{ $seoData['og_type'] }}">
    <meta property="og:url" content="{{ $seoData['canonical'] }}">
    <meta property="og:site_name" content="{{ $siteSettings['company_name'] ?? config('app.name') }}">
    @if($seoData['og_image'])
        <meta property="og:image" content="{{ $seoData['og_image'] }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
    @endif

    <!-- Article-specific Open Graph -->
    <meta property="article:author" content="{{ $seoData['article_author'] }}">
    <meta property="article:published_time" content="{{ $seoData['article_published_time'] }}">
    <meta property="article:modified_time" content="{{ $seoData['article_modified_time'] }}">
    @if($seoData['article_section'])
        <meta property="article:section" content="{{ $seoData['article_section'] }}">
    @endif
    @if($seoData['article_tag'])
        <meta property="article:tag" content="{{ $seoData['article_tag'] }}">
    @endif

    <!-- X (Twitter) Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoData['title'] }}">
    <meta name="twitter:description" content="{{ $seoData['description'] }}">
    @if($seoData['og_image'])
        <meta name="twitter:image" content="{{ $seoData['og_image'] }}">
    @endif

    <!-- Navigation Meta Tags -->
    @if($previousPost)
        <link rel="prev" href="{{ route('blog.show', $previousPost->slug) }}">
    @endif
    @if($nextPost)
        <link rel="next" href="{{ route('blog.show', $nextPost->slug) }}">
    @endif
@endpush

@push('structured-data')
    <!-- JSON-LD Structured Data for Article -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BlogPosting",
        "headline": "{{ $blog->title }}",
        "description": "{{ $blog->excerpt }}",
        "image": @if($blog->featured_image)"{{ asset('storage/' . $blog->featured_image) }}"@else null @endif,
        "author": {
            "@type": "Organization",
            "name": "{{ $siteSettings['company_name'] ?? config('app.name') }}",
            "url": "{{ route('home') }}"
        },
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
        "datePublished": "{{ $blog->published_at->toISOString() }}",
        "dateModified": "{{ $blog->updated_at->toISOString() }}",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "{{ route('blog.show', $blog->slug) }}"
        },
        "url": "{{ route('blog.show', $blog->slug) }}"
        @if($blog->category)
        ,"articleSection": "{{ $blog->category->name }}"
        ,"about": {
            "@type": "Thing",
            "name": "{{ $blog->category->name }}"
        }
        @endif
        ,"wordCount": {{ str_word_count(strip_tags($blog->content)) }}
        ,"articleBody": "{{ strip_tags($blog->content) }}"
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
            @if($blog->category)
            ,{
                "@type": "ListItem",
                "position": 3,
                "name": "{{ $blog->category->name }}",
                "item": "{{ route('blog.index', ['category' => $blog->category->slug]) }}"
            }
            @endif
            ,{
                "@type": "ListItem",
                "position": {{ $blog->category ? 4 : 3 }},
                "name": "{{ $blog->title }}",
                "item": "{{ route('blog.show', $blog->slug) }}"
            }
        ]
    }
    </script>

    <!-- Organization Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "{{ $siteSettings['company_name'] ?? config('app.name') }}",
        "url": "{{ route('home') }}"
        @if(isset($siteSettings['company_logo']) && $siteSettings['company_logo'])
        ,"logo": "{{ asset('storage/' . $siteSettings['company_logo']) }}"
        @endif
        @if(isset($siteSettings['company_phone']) && $siteSettings['company_phone'])
        ,"telephone": "{{ $siteSettings['company_phone'] }}"
        @endif
        @if(isset($siteSettings['company_email']) && $siteSettings['company_email'])
        ,"email": "{{ $siteSettings['company_email'] }}"
        @endif
    }
    </script>
@endpush

@section('content')
    <!-- Page Title Section -->
    <div class="bg-gradient-to-r from-primary-color to-secondary-color text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                @if($blog->category)
                    <div class="mb-4">
                        <span class="bg-white bg-opacity-20 text-white px-4 py-2 rounded-full text-sm font-medium">
                            {{ $blog->category->name }}
                        </span>
                    </div>
                @endif
                <h1 class="text-3xl md:text-5xl font-bold mb-4">{{ $blog->title }}</h1>
                <div class="flex items-center justify-center space-x-4 text-blue-100">
                    <div class="flex items-center">
                        <i class="far fa-calendar-alt mr-2"></i>
                        <time datetime="{{ $blog->published_at->toISOString() }}">
                            {{ $blog->published_at->format('F j, Y') }}
                        </time>
                    </div>
                    <span>•</span>
                    <div class="flex items-center">
                        <i class="far fa-clock mr-2"></i>
                        <span>{{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min read</span>
                    </div>
                    @if($blog->featured)
                        <span>•</span>
                        <div class="flex items-center">
                            <i class="fas fa-star mr-2"></i>
                            <span>Featured</span>
                        </div>
                    @endif
                </div>

                <!-- Breadcrumbs -->
                <nav class="flex justify-center mt-6" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('home') }}" class="text-blue-100 hover:text-white transition-colors">
                                <i class="fas fa-home mr-2"></i> Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-blue-300 mx-2"></i>
                                <a href="{{ route('blog.index') }}" class="text-blue-100 hover:text-white transition-colors">
                                    Blog
                                </a>
                            </div>
                        </li>
                        @if($blog->category)
                            <li>
                                <div class="flex items-center">
                                    <i class="fas fa-chevron-right text-blue-300 mx-2"></i>
                                    <a href="{{ route('blog.index', ['category' => $blog->category->slug]) }}" class="text-blue-100 hover:text-white transition-colors">
                                        {{ $blog->category->name }}
                                    </a>
                                </div>
                            </li>
                        @endif
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-blue-300 mx-2"></i>
                                <span class="text-white font-medium">{{ Str::limit($blog->title, 30) }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Blog Content -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <article class="bg-white rounded-lg shadow-md overflow-hidden">
                        <!-- Featured Image -->
                        @if($blog->featured_image)
                            <div class="relative">
                                <img src="{{ asset('storage/' . $blog->featured_image) }}"
                                     alt="{{ $blog->title }}"
                                     class="w-full h-96 object-cover">

                                <!-- Social Share Overlay -->
                                <div class="absolute top-4 right-4">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                           target="_blank" rel="noopener"
                                           class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-full transition-colors">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a href="https://x.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}"
                                           target="_blank" rel="noopener"
                                           class="bg-black hover:bg-gray-800 text-white p-2 rounded-full transition-colors">
                                            <i class="fab fa-x-twitter"></i>
                                        </a>
                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                                           target="_blank" rel="noopener"
                                           class="bg-blue-700 hover:bg-blue-800 text-white p-2 rounded-full transition-colors">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                        <a href="https://www.instagram.com/"
                                           target="_blank" rel="noopener"
                                           class="bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white p-2 rounded-full transition-colors">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                        <a href="https://wa.me/?text={{ urlencode($blog->title . ' - ' . request()->url()) }}"
                                           target="_blank" rel="noopener"
                                           class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-full transition-colors">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <a href="https://www.tiktok.com/"
                                           target="_blank" rel="noopener"
                                           class="bg-black hover:bg-gray-800 text-white p-2 rounded-full transition-colors">
                                            <i class="fab fa-tiktok"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Article Content -->
                        <div class="p-8">
                            <!-- Article Meta -->
                            <div class="flex items-center justify-between mb-6 pb-6 border-b border-gray-200">
                                <div class="flex items-center space-x-4 text-sm text-gray-600">
                                    <div class="flex items-center">
                                        <i class="far fa-calendar-alt mr-2 text-primary-color"></i>
                                        <time datetime="{{ $blog->published_at->toISOString() }}">
                                            Published {{ $blog->published_at->format('F j, Y') }}
                                        </time>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="far fa-clock mr-2 text-primary-color"></i>
                                        <span>{{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} minute read</span>
                                    </div>
                                    @if($blog->updated_at->gt($blog->published_at))
                                        <div class="flex items-center">
                                            <i class="fas fa-edit mr-2 text-primary-color"></i>
                                            <span>Updated {{ $blog->updated_at->format('M j, Y') }}</span>
                                        </div>
                                    @endif
                                </div>

                                @if($blog->featured)
                                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                        <i class="fas fa-star mr-1"></i>Featured
                                    </span>
                                @endif
                            </div>

                            <!-- Article Excerpt -->
                            @if($blog->excerpt)
                                <div class="bg-gray-50 border-l-4 border-primary-color p-6 mb-8">
                                    <p class="text-lg text-gray-700 italic leading-relaxed">{{ $blog->excerpt }}</p>
                                </div>
                            @endif

                            <!-- Article Body -->
                            <div class="prose prose-lg max-w-none">
                                {!! $blog->content !!}
                            </div>

                            <!-- Article Footer -->
                            <div class="mt-12 pt-8 border-t border-gray-200">
                                <!-- Tags/Category -->
                                @if($blog->category)
                                    <div class="mb-6">
                                        <span class="text-sm text-gray-600 mr-2">Filed under:</span>
                                        <a href="{{ route('blog.index', ['category' => $blog->category->slug]) }}"
                                           class="bg-primary-color text-white px-3 py-1 rounded-full text-sm font-medium hover:bg-secondary-color transition-colors">
                                            {{ $blog->category->name }}
                                        </a>
                                    </div>
                                @endif

                                <!-- Social Sharing -->
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-800 mb-3">Share this article</h4>
                                        <div class="flex flex-wrap gap-3">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                               target="_blank" rel="noopener"
                                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                                                <i class="fab fa-facebook-f mr-2"></i>Facebook
                                            </a>
                                            <a href="https://x.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}"
                                               target="_blank" rel="noopener"
                                               class="bg-black hover:bg-gray-800 text-white px-4 py-2 rounded-lg transition-colors">
                                                <i class="fab fa-x-twitter mr-2"></i>X
                                            </a>
                                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                                               target="_blank" rel="noopener"
                                               class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg transition-colors">
                                                <i class="fab fa-linkedin-in mr-2"></i>LinkedIn
                                            </a>
                                            <a href="https://www.instagram.com/"
                                               target="_blank" rel="noopener"
                                               class="bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white px-4 py-2 rounded-lg transition-colors">
                                                <i class="fab fa-instagram mr-2"></i>Instagram
                                            </a>
                                            <a href="https://wa.me/?text={{ urlencode($blog->title . ' - ' . request()->url()) }}"
                                               target="_blank" rel="noopener"
                                               class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-colors">
                                                <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                                            </a>
                                            <a href="https://www.tiktok.com/"
                                               target="_blank" rel="noopener"
                                               class="bg-black hover:bg-gray-800 text-white px-4 py-2 rounded-lg transition-colors">
                                                <i class="fab fa-tiktok mr-2"></i>TikTok
                                            </a>
                                            <button onclick="copyToClipboard('{{ request()->url() }}')"
                                                    class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                                                <i class="fas fa-link mr-2"></i>Copy Link
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Navigation Between Posts -->
                    @if($previousPost || $nextPost)
                        <div class="mt-8 bg-white rounded-lg shadow-md p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @if($previousPost)
                                    <div class="text-left">
                                        <p class="text-sm text-gray-600 mb-2">
                                            <i class="fas fa-arrow-left mr-2"></i>Previous Article
                                        </p>
                                        <a href="{{ route('blog.show', $previousPost->slug) }}"
                                           class="text-lg font-semibold text-gray-800 hover:text-primary-color transition-colors line-clamp-2">
                                            {{ $previousPost->title }}
                                        </a>
                                    </div>
                                @endif

                                @if($nextPost)
                                    <div class="text-right">
                                        <p class="text-sm text-gray-600 mb-2">
                                            Next Article<i class="fas fa-arrow-right ml-2"></i>
                                        </p>
                                        <a href="{{ route('blog.show', $nextPost->slug) }}"
                                           class="text-lg font-semibold text-gray-800 hover:text-primary-color transition-colors line-clamp-2">
                                            {{ $nextPost->title }}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Related Posts -->
                    @if($relatedPosts->count() > 0)
                        <div class="mt-8">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6">Related Articles</h2>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @foreach($relatedPosts as $relatedPost)
                                    <article class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                        <a href="{{ route('blog.show', $relatedPost->slug) }}" class="block">
                                            <img src="{{ asset('storage/' . $relatedPost->featured_image) }}"
                                                 alt="{{ $relatedPost->title }}"
                                                 class="w-full h-48 object-cover">

                                            <div class="p-4">
                                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                                    <i class="far fa-calendar-alt mr-2"></i>
                                                    <time datetime="{{ $relatedPost->published_at->toISOString() }}">
                                                        {{ $relatedPost->published_at->format('M j, Y') }}
                                                    </time>
                                                </div>

                                                <h3 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2">
                                                    {{ $relatedPost->title }}
                                                </h3>

                                                <p class="text-gray-600 text-sm line-clamp-2">
                                                    {{ $relatedPost->excerpt }}
                                                </p>
                                            </div>
                                        </a>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="space-y-8">
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

                        <!-- Categories -->
                        @if($categories->count() > 0)
                            <div class="bg-white rounded-lg shadow-md p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-4">
                                    <i class="fas fa-folder text-primary-color mr-2"></i>Categories
                                </h3>
                                <div class="space-y-2">
                                    @foreach($categories as $category)
                                        <a href="{{ route('blog.index', ['category' => $category->slug]) }}"
                                           class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors {{ $blog->category && $blog->category->id == $category->id ? 'bg-primary-color text-white hover:bg-primary-color' : 'text-gray-700' }}">
                                            <span class="font-medium">{{ $category->name }}</span>
                                            <span class="text-sm {{ $blog->category && $blog->category->id == $category->id ? 'text-blue-100' : 'text-gray-500' }}">
                                                {{ $category->blogs_count }}
                                            </span>
                                        </a>
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
                            <form action="{{ route('newsletters.store') }}" method="POST" class="space-y-3">
                                @csrf
                                <input type="email" name="email" placeholder="Enter your email" required
                                       class="w-full px-4 py-2 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50">
                                <button type="submit"
                                        class="w-full bg-white text-primary-color px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors">
                                    Subscribe Now
                                </button>
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

                        <!-- Back to Blog -->
                        <div class="bg-white rounded-lg shadow-md p-6 text-center">
                            <a href="{{ route('blog.index') }}"
                               class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-6 py-3 rounded-lg font-medium transition-colors inline-block">
                                <i class="fas fa-arrow-left mr-2"></i>Back to Blog
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Show success message
            const button = event.target.closest('button');
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-check mr-2"></i>Copied!';
            button.classList.remove('bg-gray-600', 'hover:bg-gray-700');
            button.classList.add('bg-green-600', 'hover:bg-green-700');

            setTimeout(function() {
                button.innerHTML = originalText;
                button.classList.remove('bg-green-600', 'hover:bg-green-700');
                button.classList.add('bg-gray-600', 'hover:bg-gray-700');
            }, 2000);
        }).catch(function(err) {
            console.error('Could not copy text: ', err);
        });
    }
</script>
@endpush
