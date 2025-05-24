@extends('admin.layouts.app')

@section('title', 'Newsletter Subscribers')

@section('header', 'Newsletter Subscribers')

@section('content')
    <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <a href="{{ route('admin.newsletters.create') }}" class="bg-primary-color hover:bg-opacity-90 text-white px-4 py-2 rounded-md font-medium shadow-md transition-all duration-200 hover:shadow-lg transform hover:-translate-y-1">
                <i class="fas fa-plus mr-2"></i> Add Subscriber
            </a>
            
            <button type="button" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md font-medium shadow-md transition-all duration-200 hover:shadow-lg ml-2" onclick="document.getElementById('import-modal').classList.remove('hidden')">
                <i class="fas fa-file-import mr-2"></i> Import Subscribers
            </button>
        </div>
        
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.newsletters.index') }}" class="px-4 py-2 rounded-md font-medium {{ $status === 'all' ? 'bg-gray-800 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                All
            </a>
            <a href="{{ route('admin.newsletters.index', ['status' => 'active']) }}" class="px-4 py-2 rounded-md font-medium {{ $status === 'active' ? 'bg-gray-800 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                Active
            </a>
            <a href="{{ route('admin.newsletters.index', ['status' => 'inactive']) }}" class="px-4 py-2 rounded-md font-medium {{ $status === 'inactive' ? 'bg-gray-800 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                Inactive
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-left">Subscribed Date</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @forelse($subscribers as $subscriber)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-6 text-left">{{ $subscriber->email }}</td>
                            <td class="py-3 px-6 text-left">
                                @if($subscriber->active)
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Active</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Inactive</span>
                                @endif
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ $subscriber->subscribed_at ? $subscriber->subscribed_at->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex justify-center">
                                    <a href="{{ route('admin.newsletters.edit', $subscriber) }}" class="text-blue-500 hover:text-blue-700 mx-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.newsletters.destroy', $subscriber) }}" method="POST" class="inline-block mx-1" onsubmit="return confirm('Are you sure you want to delete this subscriber?');">
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
                            <td colspan="4" class="py-3 px-6 text-center text-gray-500">No subscribers found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4">
            {{ $subscribers->appends(request()->query())->links() }}
        </div>
    </div>

    <!-- Import Modal -->
    <div id="import-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-gray-900">Import Subscribers</h3>
                <button type="button" class="text-gray-400 hover:text-gray-500" onclick="document.getElementById('import-modal').classList.add('hidden')">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form action="{{ route('admin.newsletters.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-4">
                    <label for="csv_file" class="block text-sm font-medium text-gray-700 mb-2">CSV File</label>
                    <input type="file" name="csv_file" id="csv_file" accept=".csv" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary-color focus:border-primary-color" required>
                    <p class="text-sm text-gray-500 mt-1">CSV file should have an 'email' column.</p>
                </div>
                
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md mr-2" onclick="document.getElementById('import-modal').classList.add('hidden')">
                        Cancel
                    </button>
                    <button type="submit" class="bg-primary-color hover:bg-opacity-90 text-white px-4 py-2 rounded-md">
                        Import
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
