<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'short_description',
        'long_description',
        'primary_image',
        'price',
        'sale_price',
        'discount_percentage',
        'discount_amount',
        'is_on_sale',
        'additional_information',
        'specifications',
        'status',
        'featured',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'is_on_sale' => 'boolean',
        'featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function quoteRequests()
    {
        return $this->hasMany(QuoteRequest::class);
    }

    /**
     * Alias for the images relationship
     */
    public function gallery()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Scope for featured products
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope for active products
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get the effective sale price (considering discounts)
     */
    public function getEffectivePriceAttribute()
    {
        if ($this->is_on_sale && $this->sale_price) {
            return $this->sale_price;
        }

        if ($this->discount_percentage) {
            return $this->price * (1 - $this->discount_percentage / 100);
        }

        if ($this->discount_amount) {
            return max(0, $this->price - $this->discount_amount);
        }

        return $this->price;
    }

    /**
     * Get the calculated discount percentage
     */
    public function getCalculatedDiscountPercentage()
    {
        if ($this->discount_percentage) {
            return $this->discount_percentage;
        }

        if ($this->is_on_sale && $this->sale_price && $this->price > 0) {
            return round((($this->price - $this->sale_price) / $this->price) * 100, 2);
        }

        if ($this->discount_amount && $this->price > 0) {
            return round(($this->discount_amount / $this->price) * 100, 2);
        }

        return 0;
    }

    /**
     * Check if product has any discount
     */
    public function hasDiscount()
    {
        return $this->is_on_sale || $this->discount_percentage > 0 || $this->discount_amount > 0;
    }

    /**
     * Get the savings amount
     */
    public function getSavingsAmount()
    {
        if ($this->is_on_sale && $this->sale_price) {
            return $this->price - $this->sale_price;
        }

        if ($this->discount_amount) {
            return $this->discount_amount;
        }

        if ($this->discount_percentage) {
            return $this->price * ($this->discount_percentage / 100);
        }

        return 0;
    }

    /**
     * Get formatted specifications for display
     */
    public function getFormattedSpecificationsAttribute()
    {
        if (empty($this->specifications)) {
            return null;
        }

        // If specifications is already HTML (legacy data), return as is
        if (is_string($this->specifications) && (strpos($this->specifications, '<') !== false)) {
            return $this->specifications;
        }

        // If specifications is an array/object, format it as a nice table
        if (is_array($this->specifications) || is_object($this->specifications)) {
            $specs = is_object($this->specifications) ? (array) $this->specifications : $this->specifications;

            $html = '<div class="specifications-table">';
            $html .= '<table class="w-full border-collapse border border-gray-300">';
            $html .= '<thead>';
            $html .= '<tr class="bg-gray-100">';
            $html .= '<th class="border border-gray-300 px-4 py-2 text-left font-semibold">Specification</th>';
            $html .= '<th class="border border-gray-300 px-4 py-2 text-left font-semibold">Value</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';

            foreach ($specs as $key => $value) {
                $html .= '<tr>';
                $html .= '<td class="border border-gray-300 px-4 py-2 font-medium">' . htmlspecialchars($key) . '</td>';
                $html .= '<td class="border border-gray-300 px-4 py-2">' . htmlspecialchars($value) . '</td>';
                $html .= '</tr>';
            }

            $html .= '</tbody>';
            $html .= '</table>';
            $html .= '</div>';

            return $html;
        }

        // If it's a string but not HTML, try to parse as JSON
        if (is_string($this->specifications)) {
            $decoded = json_decode($this->specifications, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                // Format the decoded JSON as a table
                $html = '<div class="specifications-table">';
                $html .= '<table class="w-full border-collapse border border-gray-300">';
                $html .= '<thead>';
                $html .= '<tr class="bg-gray-100">';
                $html .= '<th class="border border-gray-300 px-4 py-2 text-left font-semibold">Specification</th>';
                $html .= '<th class="border border-gray-300 px-4 py-2 text-left font-semibold">Value</th>';
                $html .= '</tr>';
                $html .= '</thead>';
                $html .= '<tbody>';

                foreach ($decoded as $key => $value) {
                    $html .= '<tr>';
                    $html .= '<td class="border border-gray-300 px-4 py-2 font-medium">' . htmlspecialchars($key) . '</td>';
                    $html .= '<td class="border border-gray-300 px-4 py-2">' . htmlspecialchars($value) . '</td>';
                    $html .= '</tr>';
                }

                $html .= '</tbody>';
                $html .= '</table>';
                $html .= '</div>';

                return $html;
            }

            // If not JSON, return as plain text
            return '<p>' . htmlspecialchars($this->specifications) . '</p>';
        }

        return null;
    }
}
