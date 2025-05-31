<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Compressor Ltd</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-color': '#33c4aa',
                        'secondary-color': '#2ba995'
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- jQuery (required for legacy scripts) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Custom Styles -->
    <style>
        .sidebar {
            width: 250px;
            transition: all 0.3s;
            background-color: #1a202c; /* Dark background */
            height: 100vh;
            position: fixed;
            overflow-y: auto; /* Make sidebar scrollable */
            display: flex;
            flex-direction: column;
        }

        .sidebar-nav {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .sidebar-nav ul {
            flex-grow: 1;
        }

        .logout-container {
            margin-top: auto;
            padding: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .content {
            margin-left: 250px;
            transition: all 0.3s;
            min-height: 100vh;
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: -250px;
                z-index: 50;
            }

            .sidebar.active {
                margin-left: 0;
            }

            .content {
                margin-left: 0;
            }

            .content.active {
                margin-left: 250px;
            }
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="sidebar text-white z-10">
            <div class="p-4 flex justify-between items-center border-b border-gray-700">
                <h1 class="text-xl font-bold">Admin Panel</h1>
                <button id="sidebar-toggle-btn" class="md:hidden text-white">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <nav class="sidebar-nav">
                <ul class="py-2">
                    <li class="mb-1">
                        <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.categories.index') }}" class="block py-2 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.categories.*') ? 'bg-gray-700' : '' }}">
                            <i class="fas fa-folder mr-2"></i> Categories
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.products.index') }}" class="block py-2 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.products.*') ? 'bg-gray-700' : '' }}">
                            <i class="fas fa-box mr-2"></i> Products
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.quote-requests.index') }}" class="block py-2 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.quote-requests.*') ? 'bg-gray-700' : '' }}">
                            <i class="fas fa-quote-left mr-2"></i> Quote Requests
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.testimonials.index') }}" class="block py-2 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.testimonials.*') ? 'bg-gray-700' : '' }}">
                            <i class="fas fa-comments mr-2"></i> Testimonials
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.contact-messages.index') }}" class="block py-2 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.contact-messages.*') ? 'bg-gray-700' : '' }}">
                            <i class="fas fa-envelope mr-2"></i> Contact Messages
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.newsletters.index') }}" class="block py-2 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.newsletters.*') ? 'bg-gray-700' : '' }}">
                            <i class="fas fa-paper-plane mr-2"></i> Newsletter
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.blogs.index') }}" class="block py-2 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.blogs.*') ? 'bg-gray-700' : '' }}">
                            <i class="fas fa-blog mr-2"></i> Blog Posts
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.blog-categories.index') }}" class="block py-2 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.blog-categories.*') ? 'bg-gray-700' : '' }}">
                            <i class="fas fa-tags mr-2"></i> Blog Categories
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.comments.index') }}" class="block py-2 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.comments.*') ? 'bg-gray-700' : '' }}">
                            <i class="fas fa-comment-dots mr-2"></i> Comments
                            @php
                                $pendingComments = \App\Models\Comment::where('status', 'pending')->count();
                            @endphp
                            @if($pendingComments > 0)
                                <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full ml-2">
                                    {{ $pendingComments }}
                                </span>
                            @endif
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.sliders.index') }}" class="block py-2 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.sliders.*') ? 'bg-gray-700' : '' }}">
                            <i class="fas fa-images mr-2"></i> Sliders
                        </a>
                    </li>

                    <!-- Settings Section -->
                    <li class="mb-2 mt-6">
                        <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            Settings
                        </div>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.settings.index') }}" class="block py-2 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.settings.*') ? 'bg-gray-700' : '' }}">
                            <i class="fas fa-cog mr-2"></i> Site Settings
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.branches.index') }}" class="block py-2 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.branches.*') ? 'bg-gray-700' : '' }}">
                            <i class="fas fa-map-marker-alt mr-2"></i> Branches
                        </a>
                    </li>
                </ul>

                <!-- Logout button at the bottom -->
                <div class="logout-container">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left py-2 px-4 hover:bg-gray-700 text-gray-300">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </nav>
        </div>

        <!-- Content -->
        <div class="content flex-1">
            <!-- Top Navigation -->
            <div class="bg-white shadow-md p-4 flex justify-between items-center">
                <button id="mobile-sidebar-toggle" class="md:hidden text-gray-700 focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center focus:outline-none" aria-label="Toggle profile dropdown">
                        <div class="w-10 h-10 rounded-full bg-primary-color text-white flex items-center justify-center font-semibold text-lg border-2 border-gray-200 hover:bg-opacity-90 transition-colors">
                            @php
                                $name = Auth::user()->name;
                                $initials = strtoupper(substr($name, 0, 1));

                                // Check if there's a space in the name
                                if (strpos($name, ' ') !== false) {
                                    $initials .= strtoupper(substr($name, strpos($name, ' ') + 1, 1));
                                } elseif (strlen($name) > 1) {
                                    // If no space but name is longer than 1 character, use the second character
                                    $initials .= strtoupper(substr($name, 1, 1));
                                }
                            @endphp
                            {{ $initials }}
                        </div>
                    </button>

                    <div x-show="open"
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
                         style="display: none;">
                        <a href="{{ route('admin.profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <h1 class="text-2xl font-bold mb-6">@yield('header', 'Dashboard')</h1>

                @yield('content')
            </div>
        </div>
    </div>

    <script>
        // Mobile sidebar toggle
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile sidebar toggle
            document.getElementById('mobile-sidebar-toggle').addEventListener('click', function() {
                document.querySelector('.sidebar').classList.toggle('active');
                document.querySelector('.content').classList.toggle('active');
            });

            // Sidebar toggle button (inside sidebar)
            document.getElementById('sidebar-toggle-btn').addEventListener('click', function() {
                document.querySelector('.sidebar').classList.toggle('active');
                document.querySelector('.content').classList.toggle('active');
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                const sidebar = document.querySelector('.sidebar');
                const sidebarToggle = document.getElementById('mobile-sidebar-toggle');

                if (window.innerWidth <= 768 &&
                    !sidebar.contains(event.target) &&
                    event.target !== sidebarToggle &&
                    !sidebarToggle.contains(event.target) &&
                    sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                    document.querySelector('.content').classList.remove('active');
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
