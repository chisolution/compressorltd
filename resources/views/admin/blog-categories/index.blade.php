@extends('admin.layouts.app')

@section('title', 'Blog Categories')

@section('header', 'Blog Categories')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <a href="{{ route('admin.blog-categories.create') }}" class="bg-primary-color hover:bg-opacity-90 text-white px-4 py-2 rounded-md font-medium shadow-md transition-all duration-200 hover:shadow-lg transform hover:-translate-y-1">
                <i class="fas fa-plus mr-2"></i> Add New Category
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Slug</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-left">Posts</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @forelse($categories as $category)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-6 text-left">{{ $category->id }}</td>
                            <td class="py-3 px-6 text-left">{{ $category->name }}</td>
                            <td class="py-3 px-6 text-left">{{ $category->slug }}</td>
                            <td class="py-3 px-6 text-left">
                                @if($category->active)
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Active</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Inactive</span>
                                @endif
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ $category->blogs()->count() }}
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex justify-center">
                                    <a href="{{ route('admin.blog-categories.edit', $category) }}" class="text-blue-500 hover:text-blue-700 mx-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.blog-categories.destroy', $category) }}" method="POST" class="inline-block mx-1" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="border-b border-gray-200">
                            <td colspan="6" class="py-3 px-6 text-center text-gray-500">No categories found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
