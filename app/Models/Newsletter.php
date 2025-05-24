<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Newsletter extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'unsubscribe_token',
        'active',
        'subscribed_at',
        'unsubscribed_at'
    ];

    protected $casts = [
        'active' => 'boolean',
        'subscribed_at' => 'datetime',
        'unsubscribed_at' => 'datetime'
    ];

    /**
     * Boot the model and generate unsubscribe token
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($newsletter) {
            if (empty($newsletter->unsubscribe_token)) {
                $newsletter->unsubscribe_token = Str::random(64);
            }
        });
    }

    /**
     * Scope for active subscribers
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Generate unsubscribe URL
     */
    public function getUnsubscribeUrlAttribute()
    {
        return route('newsletters.unsubscribe', ['token' => $this->unsubscribe_token]);
    }

    /**
     * Unsubscribe the user
     */
    public function unsubscribe()
    {
        $this->update([
            'active' => false,
            'unsubscribed_at' => now()
        ]);
    }
}
