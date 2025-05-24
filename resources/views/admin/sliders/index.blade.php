@extends('admin.layouts.app')

@section('title', 'Sliders')

@section('header', 'Sliders')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.css">
    <style>
        .sortable-ghost {
            opacity: 0.4;
            background-color: #f3f4f6;
        }
        
        .sortable-handle {
            cursor: grab;
        }
        
        .sortable-handle:active {
            cursor: grabbing;
        }
    </style>
@endpush

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <a href="{{ route('admin.sliders.create') }}" class="bg-primary-color hover:bg-opacity-90 text-white px-4 py-2 rounded-md font-medium shadow-md transition-all duration-200 hover:shadow-lg transform hover:-translate-y-1">
                <i class="fas fa-plus mr-2"></i> Add New Slider
            </a>
        </div>
        
        <div id="order-controls" class="hidden">
            <button id="save-order" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md font-medium shadow-md transition-all duration-200 hover:shadow-lg">
                <i class="fas fa-save mr-2"></i> Save Order
            </button>
            <button id="cancel-order" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md font-medium shadow-md transition-all duration-200 hover:shadow-lg ml-2">
                <i class="fas fa-times mr-2"></i> Cancel
            </button>
        </div>
        
        <button id="reorder-btn" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md font-medium shadow-md transition-all duration-200 hover:shadow-lg">
            <i class="fas fa-sort mr-2"></i> Reorder Sliders
        </button>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Order</th>
                        <th class="py-3 px-6 text-left">Image</th>
                        <th class="py-3 px-6 text-left">Title</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody id="sliders-table" class="text-gray-600 text-sm">
                    @forelse($sliders as $slider)
                        <tr class="border-b border-gray-200 hover:bg-gray-50" data-id="{{ $slider->id }}" data-order="{{ $slider->sort_order }}">
                            <td class="py-3 px-6 text-left">
                                <span class="order-display">{{ $slider->sort_order }}</span>
                                <span class="sortable-handle hidden">
                                    <i class="fas fa-grip-vertical text-gray-400"></i>
                                </span>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->title }}" class="w-20 h-12 object-cover rounded">
                            </td>
                            <td class="py-3 px-6 text-left">{{ $slider->title }}</td>
                            <td class="py-3 px-6 text-left">
                                @if($slider->active)
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Active</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Inactive</span>
                                @endif
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex justify-center">
                                    <a href="{{ route('admin.sliders.edit', $slider) }}" class="text-blue-500 hover:text-blue-700 mx-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" class="inline-block mx-1" onsubmit="return confirm('Are you sure you want to delete this slider?');">
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
                            <td colspan="5" class="py-3 px-6 text-center text-gray-500">No sliders found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4">
            {{ $sliders->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slidersTable = document.getElementById('sliders-table');
            const reorderBtn = document.getElementById('reorder-btn');
            const orderControls = document.getElementById('order-controls');
            const saveOrderBtn = document.getElementById('save-order');
            const cancelOrderBtn = document.getElementById('cancel-order');
            const sortableHandles = document.querySelectorAll('.sortable-handle');
            const orderDisplays = document.querySelectorAll('.order-display');
            
            let sortable = null;
            let originalOrder = [];
            
            // Store original order
            document.querySelectorAll('#sliders-table tr[data-id]').forEach(row => {
                originalOrder.push({
                    id: row.dataset.id,
                    order: row.dataset.order
                });
            });
            
            // Enable reordering
            reorderBtn.addEventListener('click', function() {
                reorderBtn.classList.add('hidden');
                orderControls.classList.remove('hidden');
                
                // Show drag handles, hide order numbers
                sortableHandles.forEach(handle => handle.classList.remove('hidden'));
                orderDisplays.forEach(display => display.classList.add('hidden'));
                
                // Initialize Sortable
                sortable = new Sortable(slidersTable, {
                    handle: '.sortable-handle',
                    animation: 150,
                    ghostClass: 'sortable-ghost'
                });
            });
            
            // Cancel reordering
            cancelOrderBtn.addEventListener('click', function() {
                if (sortable) {
                    sortable.destroy();
                    sortable = null;
                }
                
                // Reset to original order
                const rows = Array.from(document.querySelectorAll('#sliders-table tr[data-id]'));
                rows.sort((a, b) => {
                    const aOrder = originalOrder.find(item => item.id === a.dataset.id).order;
                    const bOrder = originalOrder.find(item => item.id === b.dataset.id).order;
                    return aOrder - bOrder;
                });
                
                rows.forEach(row => {
                    slidersTable.appendChild(row);
                });
                
                // Hide drag handles, show order numbers
                sortableHandles.forEach(handle => handle.classList.add('hidden'));
                orderDisplays.forEach(display => display.classList.remove('hidden'));
                
                orderControls.classList.add('hidden');
                reorderBtn.classList.remove('hidden');
            });
            
            // Save new order
            saveOrderBtn.addEventListener('click', function() {
                const rows = document.querySelectorAll('#sliders-table tr[data-id]');
                const newOrder = [];
                
                rows.forEach((row, index) => {
                    newOrder.push({
                        id: row.dataset.id,
                        sort_order: index
                    });
                    
                    // Update displayed order
                    row.querySelector('.order-display').textContent = index;
                    row.dataset.order = index;
                });
                
                // Send to server
                fetch('{{ route("admin.sliders.update-order") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ sliders: newOrder })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update original order
                        originalOrder = newOrder;
                        
                        // Show success message
                        const successMessage = document.createElement('div');
                        successMessage.className = 'bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4';
                        successMessage.innerHTML = '<span class="block sm:inline">Slider order updated successfully.</span>';
                        
                        const content = document.querySelector('.content > .p-6');
                        content.insertBefore(successMessage, content.firstChild);
                        
                        // Remove message after 3 seconds
                        setTimeout(() => {
                            successMessage.remove();
                        }, 3000);
                    }
                })
                .catch(error => {
                    console.error('Error updating order:', error);
                    
                    // Show error message
                    const errorMessage = document.createElement('div');
                    errorMessage.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4';
                    errorMessage.innerHTML = '<span class="block sm:inline">Error updating slider order. Please try again.</span>';
                    
                    const content = document.querySelector('.content > .p-6');
                    content.insertBefore(errorMessage, content.firstChild);
                    
                    // Remove message after 3 seconds
                    setTimeout(() => {
                        errorMessage.remove();
                    }, 3000);
                })
                .finally(() => {
                    if (sortable) {
                        sortable.destroy();
                        sortable = null;
                    }
                    
                    // Hide drag handles, show order numbers
                    sortableHandles.forEach(handle => handle.classList.add('hidden'));
                    orderDisplays.forEach(display => display.classList.remove('hidden'));
                    
                    orderControls.classList.add('hidden');
                    reorderBtn.classList.remove('hidden');
                });
            });
        });
    </script>
@endpush
