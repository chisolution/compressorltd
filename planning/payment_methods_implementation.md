# Payment Methods SVGs Implementation

## Overview
This document outlines the implementation of payment method SVGs in the website footer, with admin configuration capabilities. The implementation uses high-quality SVG logos from the [datatrans/payment-logos](https://github.com/datatrans/payment-logos) repository.

## Completed Tasks

### Database Structure
- [x] Created `payment_methods` table with migration
- [x] Implemented `PaymentMethod` model with appropriate attributes and relationships
- [x] Added scopes for filtering active payment methods and ordering
- [x] Created seeder to populate the database with initial payment methods

### SVG Integration
- [x] Downloaded SVG payment method logos from datatrans/payment-logos repository
- [x] Organized SVGs in categories (cards, wallets, alternative payment methods)
- [x] Created directory structure for storing SVGs
- [x] Implemented proper asset paths for SVGs

### Dynamic Display
- [x] Updated footer to dynamically display active payment methods
- [x] Created view composer to load payment methods for the footer
- [x] Implemented sorting to display payment methods in a specific order
- [x] Added tooltips to display payment method names on hover

### Admin Backend
- [x] Created controller for managing payment methods
- [x] Implemented CRUD operations for payment methods
- [x] Added routes for the admin payment methods controller
- [x] Added functionality to toggle active status of payment methods

## Pending Tasks

### Admin Views
- [ ] Create admin index view for listing all payment methods
- [ ] Implement create form for adding new payment methods
- [ ] Create edit form for modifying existing payment methods
- [ ] Add delete confirmation modal
- [ ] Implement active/inactive status toggle UI

### SVG Upload Functionality
- [ ] Create file upload component for SVG files
- [ ] Implement validation for SVG files
- [ ] Add storage configuration for uploaded SVGs
- [ ] Create preview functionality for uploaded SVGs

### Admin Authentication
- [ ] Secure admin routes with authentication middleware
- [ ] Implement role-based access control for payment method management
- [ ] Add audit logging for payment method changes

### Testing
- [ ] Write unit tests for PaymentMethod model
- [ ] Create feature tests for admin CRUD operations
- [ ] Implement browser tests for admin interface
- [ ] Test footer display across different devices and browsers

## Implementation Details

### Database Schema
```php
Schema::create('payment_methods', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->string('svg_path');
    $table->string('category')->default('card'); // card, wallet, apm (alternative payment method)
    $table->boolean('is_active')->default(true);
    $table->integer('sort_order')->default(0);
    $table->timestamps();
});
```

### Model Definition
```php
class PaymentMethod extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'svg_path',
        'category',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}
```

### View Composer
```php
class FooterComposer
{
    public function compose(View $view)
    {
        $view->with('paymentMethods', PaymentMethod::active()->ordered()->get());
    }
}
```

### Footer Implementation
```blade
<div class="flex flex-wrap gap-4">
    @foreach($paymentMethods as $method)
        <img src="{{ asset($method->svg_path) }}" alt="{{ $method->name }}" class="h-8" title="{{ $method->name }}">
    @endforeach
</div>
```

## Next Steps
1. Complete the admin views for managing payment methods
2. Implement SVG upload functionality
3. Secure the admin routes with authentication
4. Write tests for the payment methods functionality
5. Document the admin interface for payment method management

## Scheduled Revisit
This implementation will be revisited in Sprint 9 (Task TS090A) to complete the admin interface and any remaining functionality. The basic implementation is sufficient for now, allowing the footer to display payment method SVGs, but the full admin interface will be completed later in the project timeline.
