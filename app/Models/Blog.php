<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'featured',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    protected $casts = [
        'featured' => 'boolean',
        'published_at' => 'datetime'
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function getIsPublishedAttribute()
    {
        return $this->status === 'published' && $this->published_at <= now();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function approvedComments()
    {
        return $this->hasMany(Comment::class)->approved();
    }

    public function pendingComments()
    {
        return $this->hasMany(Comment::class)->pending();
    }
}
