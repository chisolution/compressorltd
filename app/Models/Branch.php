<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'province',
        'address',
        'phone',
        'email',
        'manager_name',
        'operating_hours',
        'latitude',
        'longitude',
        'active',
        'sort_order'
    ];

    protected $casts = [
        'active' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'sort_order' => 'integer'
    ];

    /**
     * Scope for active branches
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Scope for sorted branches
     */
    public function scopeSorted($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('name', 'asc');
    }

    /**
     * Get full address
     */
    public function getFullAddressAttribute()
    {
        $address = $this->address;
        if ($this->city) {
            $address .= ', ' . $this->city;
        }
        if ($this->province) {
            $address .= ', ' . $this->province;
        }
        return $address;
    }

    /**
     * Get formatted operating hours
     */
    public function getFormattedOperatingHoursAttribute()
    {
        if (!$this->operating_hours) {
            return 'Contact for hours';
        }
        return $this->operating_hours;
    }
}
