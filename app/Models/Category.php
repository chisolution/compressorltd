<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Get all ancestors of the current category
    public function ancestors()
    {
        $ancestors = collect([]);
        $category = $this->parent;

        while ($category) {
            $ancestors->push($category);
            $category = $category->parent;
        }

        return $ancestors->reverse();
    }

    // Get all descendants of the current category
    public function descendants()
    {
        $descendants = collect([]);

        foreach ($this->children as $child) {
            $descendants->push($child);
            $descendants = $descendants->merge($child->descendants());
        }

        return $descendants;
    }

    /**
     * Get the total count of active products in this category and all its subcategories
     */
    public function getTotalProductsCount()
    {
        // Count direct products in this category
        $count = $this->products()->where('status', 'active')->count();

        // Add products from all subcategories recursively
        foreach ($this->children as $child) {
            $count += $child->getTotalProductsCount();
        }

        return $count;
    }

    /**
     * Scope to include product counts for categories
     */
    public function scopeWithProductCounts($query)
    {
        return $query->with(['children', 'products' => function($query) {
            $query->where('status', 'active');
        }]);
    }
}
