@extends('admin.layouts.app')

@section('title', 'Products')

@section('header', 'Products')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <p class="text-gray-600">Manage your products</p>
            <div id="bulk-actions" class="hidden flex items-center space-x-2">
                <select id="bulk-action-select" class="border border-gray-300 rounded-md px-3 py-1 text-sm">
                    <option value="">Bulk Actions</option>
                    <option value="feature">Mark as Featured</option>
                    <option value="unfeature">Remove Featured</option>
                </select>
                <button id="apply-bulk-action" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm">
                    Apply
                </button>
            </div>
        </div>
        <a href="{{ route('admin.products.create') }}" class="bg-primary-color hover:bg-opacity-90 text-white px-4 py-2 rounded-md">
            <i class="fas fa-plus mr-2"></i> Add Product
        </a>
    </div>

    @if($products->count() > 0)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <input type="checkbox" id="select-all" class="w-4 h-4 text-primary-color bg-gray-100 border-gray-300 rounded focus:ring-primary-color focus:ring-2">
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Featured</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($products as $product)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="product-checkbox w-4 h-4 text-primary-color bg-gray-100 border-gray-300 rounded focus:ring-primary-color focus:ring-2"
                                       value="{{ $product->id }}" data-product-id="{{ $product->id }}">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="{{ asset('storage/' . $product->primary_image) }}" alt="{{ $product->name }}" class="h-12 w-12 object-cover rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($product->short_description, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $product->category->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($product->status == 'active')
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @else
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button type="button"
                                        class="featured-toggle flex items-center transition-all duration-200"
                                        data-product-id="{{ $product->id }}"
                                        data-featured="{{ $product->featured ? 'true' : 'false' }}"
                                        data-url="{{ route('admin.products.toggle-featured', $product) }}">
                                    <span class="featured-badge px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full transition-all duration-200
                                        {{ $product->featured
                                            ? 'bg-yellow-100 text-yellow-800'
                                            : 'bg-gray-100 text-gray-600 hover:bg-yellow-100 hover:text-yellow-800' }}">
                                        <i class="featured-icon {{ $product->featured ? 'fas fa-star' : 'far fa-star' }} mr-1"></i>
                                        <span class="featured-text">{{ $product->featured ? 'Featured' : 'Not Featured' }}</span>
                                    </span>
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.products.view', $product) }}" class="text-blue-600 hover:text-blue-900 mr-3" target="_blank">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this product?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <p class="text-gray-500 mb-4">No products found.</p>
            <a href="{{ route('admin.products.create') }}" class="bg-primary-color hover:bg-opacity-90 text-white px-4 py-2 rounded-md">
                <i class="fas fa-plus mr-2"></i> Add Your First Product
            </a>
        </div>
    @endif
@endsection

@push('styles')
<style>
    .featured-toggle {
        position: relative;
        overflow: hidden;
    }

    .featured-toggle:hover .featured-badge {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .featured-toggle:active .featured-badge {
        transform: translateY(0);
    }

    .featured-toggle:disabled {
        pointer-events: none;
    }

    .toast-notification {
        min-width: 300px;
        max-width: 500px;
        backdrop-filter: blur(10px);
    }

    @keyframes pulse-star {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    .featured-toggle.updating .featured-icon {
        animation: pulse-star 1s infinite;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize featured toggle functionality
        initFeaturedToggles();

        // Initialize bulk actions
        initBulkActions();
    });

    // Featured Toggle AJAX Handler
    function initFeaturedToggles() {
        const toggleButtons = document.querySelectorAll('.featured-toggle');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                handleFeaturedToggle(this);
            });
        });
    }

    // Handle Featured Toggle
    function handleFeaturedToggle(button) {
        const productId = button.dataset.productId;
        const currentFeatured = button.dataset.featured === 'true';
        const url = button.dataset.url;
        const badge = button.querySelector('.featured-badge');
        const icon = button.querySelector('.featured-icon');
        const text = button.querySelector('.featured-text');

        // Check if required elements exist
        if (!badge || !icon || !text) {
            console.error('Required elements not found for featured toggle');
            showToast('Error: Unable to toggle featured status', 'error');
            return;
        }

        // Disable button during request
        button.disabled = true;
        button.classList.add('updating');
        button.style.opacity = '0.7';
        button.style.cursor = 'not-allowed';

        // Show loading state
        const originalIconClass = icon.className;
        const originalText = text.textContent;
        icon.className = 'fas fa-spinner fa-spin mr-1';
        text.textContent = 'Updating...';

        // Send AJAX request
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                               document.querySelector('input[name="_token"]')?.value,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({})
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => Promise.reject(data));
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Update button state
                const newFeatured = data.featured;
                button.dataset.featured = newFeatured ? 'true' : 'false';

                // Update visual appearance
                updateFeaturedButton(button, newFeatured);

                // Show success message
                showToast(data.message, 'success');
            } else {
                throw new Error(data.message || 'Failed to update featured status');
            }
        })
        .catch(error => {
            console.error('Featured toggle error:', error);

            // Restore original state
            icon.className = originalIconClass;
            text.textContent = originalText;

            // Show error message
            const errorMessage = error.message || 'Failed to update featured status. Please try again.';
            showToast(errorMessage, 'error');
        })
        .finally(() => {
            // Re-enable button
            button.disabled = false;
            button.classList.remove('updating');
            button.style.opacity = '1';
            button.style.cursor = 'pointer';
        });
    }

    // Update Featured Button Appearance
    function updateFeaturedButton(button, featured) {
        const badge = button.querySelector('.featured-badge');
        const icon = button.querySelector('.featured-icon');
        const text = button.querySelector('.featured-text');

        // Check if elements exist
        if (!badge || !icon || !text) {
            console.error('Required elements not found for button update');
            return;
        }

        // First, ensure we're not in loading state
        icon.classList.remove('fa-spinner', 'fa-spin');

        if (featured) {
            // Featured state
            badge.className = 'featured-badge px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full transition-all duration-200 bg-yellow-100 text-yellow-800';
            icon.className = 'featured-icon fas fa-star mr-1';
            text.textContent = 'Featured';
        } else {
            // Not featured state
            badge.className = 'featured-badge px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full transition-all duration-200 bg-gray-100 text-gray-600 hover:bg-yellow-100 hover:text-yellow-800';
            icon.className = 'featured-icon far fa-star mr-1';
            text.textContent = 'Not Featured';
        }

        // Add a subtle animation to indicate change
        if (badge) {
            badge.style.transform = 'scale(1.05)';
            setTimeout(() => {
                badge.style.transform = 'scale(1)';
            }, 200);
        }
    }

    // Toast Notification System
    function showToast(message, type = 'success') {
        // Remove existing toasts
        const existingToasts = document.querySelectorAll('.toast-notification');
        existingToasts.forEach(toast => toast.remove());

        // Create toast element
        const toast = document.createElement('div');
        toast.className = `toast-notification fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg transform transition-all duration-300 translate-x-full`;

        // Set toast styling based on type
        if (type === 'success') {
            toast.classList.add('bg-green-500', 'text-white');
            toast.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3 text-lg"></i>
                    <span class="font-medium">${message}</span>
                </div>
            `;
        } else {
            toast.classList.add('bg-red-500', 'text-white');
            toast.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-3 text-lg"></i>
                    <span class="font-medium">${message}</span>
                </div>
            `;
        }

        // Add close button
        const closeBtn = document.createElement('button');
        closeBtn.className = 'ml-4 text-white hover:text-gray-200 focus:outline-none';
        closeBtn.innerHTML = '<i class="fas fa-times"></i>';
        closeBtn.onclick = () => hideToast(toast);
        toast.querySelector('div').appendChild(closeBtn);

        // Add to page
        document.body.appendChild(toast);

        // Animate in
        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 100);

        // Auto-hide after 4 seconds
        setTimeout(() => {
            hideToast(toast);
        }, 4000);
    }

    // Hide Toast
    function hideToast(toast) {
        toast.classList.add('translate-x-full');
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 300);
    }

    // Bulk Actions Functionality
    function initBulkActions() {
        const selectAllCheckbox = document.getElementById('select-all');
        const productCheckboxes = document.querySelectorAll('.product-checkbox');
        const bulkActionsDiv = document.getElementById('bulk-actions');
        const bulkActionSelect = document.getElementById('bulk-action-select');
        const applyBulkActionBtn = document.getElementById('apply-bulk-action');

        // Select all functionality
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                productCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                toggleBulkActions();
            });
        }

        // Individual checkbox functionality
        productCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                // Update select all checkbox state
                const checkedCount = document.querySelectorAll('.product-checkbox:checked').length;
                const totalCount = productCheckboxes.length;

                if (selectAllCheckbox) {
                    selectAllCheckbox.checked = checkedCount === totalCount;
                    selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < totalCount;
                }

                toggleBulkActions();
            });
        });

        // Apply bulk action
        if (applyBulkActionBtn) {
            applyBulkActionBtn.addEventListener('click', function() {
                const selectedProducts = Array.from(document.querySelectorAll('.product-checkbox:checked'))
                    .map(checkbox => checkbox.value);
                const action = bulkActionSelect.value;

                if (selectedProducts.length === 0) {
                    showToast('Please select at least one product.', 'error');
                    return;
                }

                if (!action) {
                    showToast('Please select an action.', 'error');
                    return;
                }

                handleBulkAction(selectedProducts, action);
            });
        }

        function toggleBulkActions() {
            const checkedCount = document.querySelectorAll('.product-checkbox:checked').length;
            if (checkedCount > 0) {
                bulkActionsDiv.classList.remove('hidden');
            } else {
                bulkActionsDiv.classList.add('hidden');
                bulkActionSelect.value = '';
            }
        }
    }

    // Handle Bulk Action
    function handleBulkAction(productIds, action) {
        const actionText = action === 'feature' ? 'featuring' : 'unfeaturing';
        const confirmText = action === 'feature'
            ? `Are you sure you want to mark ${productIds.length} product(s) as featured?`
            : `Are you sure you want to remove featured status from ${productIds.length} product(s)?`;

        if (!confirm(confirmText)) {
            return;
        }

        // Disable bulk action button
        const applyBtn = document.getElementById('apply-bulk-action');
        const originalText = applyBtn.textContent;
        applyBtn.disabled = true;
        applyBtn.textContent = 'Processing...';

        // Process each product
        let completed = 0;
        let errors = 0;

        productIds.forEach(productId => {
            const button = document.querySelector(`.featured-toggle[data-product-id="${productId}"]`);

            if (!button) {
                console.error(`Featured toggle button not found for product ${productId}`);
                completed++;
                errors++;
                checkBulkCompletion();
                return;
            }

            const url = button.dataset.url;
            const currentFeatured = button.dataset.featured === 'true';
            const shouldFeature = action === 'feature';

            // Skip if already in desired state
            if ((shouldFeature && currentFeatured) || (!shouldFeature && !currentFeatured)) {
                completed++;
                checkBulkCompletion();
                return;
            }

            // Send AJAX request
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update button appearance
                    button.dataset.featured = data.featured ? 'true' : 'false';
                    updateFeaturedButton(button, data.featured);
                } else {
                    errors++;
                }
            })
            .catch(error => {
                console.error('Bulk action error:', error);
                errors++;
            })
            .finally(() => {
                completed++;
                checkBulkCompletion();
            });
        });

        function checkBulkCompletion() {
            if (completed === productIds.length) {
                // Re-enable button
                applyBtn.disabled = false;
                applyBtn.textContent = originalText;

                // Clear selections
                document.querySelectorAll('.product-checkbox:checked').forEach(checkbox => {
                    checkbox.checked = false;
                });
                document.getElementById('select-all').checked = false;
                document.getElementById('bulk-actions').classList.add('hidden');
                document.getElementById('bulk-action-select').value = '';

                // Show completion message
                const successCount = productIds.length - errors;
                if (errors === 0) {
                    showToast(`Successfully ${actionText} ${successCount} product(s).`, 'success');
                } else {
                    showToast(`${successCount} product(s) updated successfully. ${errors} failed.`, 'error');
                }
            }
        }
    }
</script>
@endpush
