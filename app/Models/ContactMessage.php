<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'subject',
        'message',
        'status',
        'inquiry_type',
        'branch_id',
        'ip_address',
        'user_agent'
    ];

    public function scopeUnread($query)
    {
        return $query->where('status', 'new');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function getInquiryTypeAttribute($value)
    {
        return ucfirst(str_replace('_', ' ', $value));
    }
}
