@extends('admin.layouts.app')

@section('header', 'Branch Management')

@section('content')
<div class="bg-white rounded-lg shadow-md">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                <i class="fas fa-map-marker-alt mr-2 text-primary-color"></i>
                Company Branches
            </h2>
            <p class="text-gray-600 mt-1">Manage your company's branch locations and contact information.</p>
        </div>
        <a href="{{ route('admin.branches.create') }}" class="bg-primary-color hover:bg-secondary-color text-white px-4 py-2 rounded-lg font-semibold transition-colors duration-200 flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Add Branch
        </a>
    </div>

    @if($branches->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Branch</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Manager</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($branches as $branch)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-primary-color flex items-center justify-center">
                                            <i class="fas fa-building text-white"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $branch->name }}</div>
                                        <div class="text-sm text-gray-500">Sort: {{ $branch->sort_order }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $branch->city }}</div>
                                @if($branch->province)
                                    <div class="text-sm text-gray-500">{{ $branch->province }}</div>
                                @endif
                                <div class="text-xs text-gray-400 mt-1">{{ Str::limit($branch->address, 40) }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if($branch->phone)
                                    <div class="text-sm text-gray-900">
                                        <i class="fas fa-phone text-primary-color mr-1"></i>
                                        {{ $branch->phone }}
                                    </div>
                                @endif
                                @if($branch->email)
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-envelope text-primary-color mr-1"></i>
                                        {{ $branch->email }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($branch->manager_name)
                                    <div class="text-sm text-gray-900">{{ $branch->manager_name }}</div>
                                @else
                                    <span class="text-gray-400 text-sm">Not assigned</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('admin.branches.toggle-active', $branch) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $branch->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        <i class="fas fa-circle mr-1 text-xs"></i>
                                        {{ $branch->active ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.branches.show', $branch) }}" class="text-blue-600 hover:text-blue-900" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.branches.edit', $branch) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.branches.destroy', $branch) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this branch?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="p-12 text-center">
            <div class="mx-auto h-24 w-24 text-gray-400 mb-4">
                <i class="fas fa-map-marker-alt text-6xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No branches found</h3>
            <p class="text-gray-500 mb-6">Get started by adding your first branch location.</p>
            <a href="{{ route('admin.branches.create') }}" class="bg-primary-color hover:bg-secondary-color text-white px-6 py-3 rounded-lg font-semibold transition-colors duration-200 inline-flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Add First Branch
            </a>
        </div>
    @endif
</div>

@if($branches->count() > 0)
    <div class="mt-6 bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            <i class="fas fa-info-circle mr-2 text-blue-500"></i>
            Branch Management Tips
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
            <div class="flex items-start">
                <i class="fas fa-lightbulb text-yellow-500 mr-2 mt-0.5"></i>
                <div>
                    <strong>Sort Order:</strong> Use the sort order to control how branches appear on your website. Lower numbers appear first.
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-toggle-on text-green-500 mr-2 mt-0.5"></i>
                <div>
                    <strong>Active Status:</strong> Only active branches will be displayed on the public website.
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-map-pin text-red-500 mr-2 mt-0.5"></i>
                <div>
                    <strong>Coordinates:</strong> Add latitude and longitude for map integration features.
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-clock text-blue-500 mr-2 mt-0.5"></i>
                <div>
                    <strong>Operating Hours:</strong> Include detailed operating hours to help customers plan their visits.
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
