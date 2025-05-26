<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'driver',
        'host',
        'port',
        'username',
        'password',
        'encryption',
        'from_address',
        'from_name',
        'recipients',
        'is_active',
    ];

    protected $casts = [
        'recipients' => 'array',
        'is_active' => 'boolean',
        'port' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function getByName($name)
    {
        return static::where('name', $name)->active()->first();
    }

    public function getRecipientsListAttribute()
    {
        return is_array($this->recipients) ? implode(', ', $this->recipients) : '';
    }
}
