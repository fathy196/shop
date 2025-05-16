<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'status',
        'shipping_address',
        'payment_method'
    ];

    public function getFormattedTotalAttribute()
    {
        return 'EGP ' . number_format($this->total + 80, 2);
    }

    public function getPaymentMethodTextAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->payment_method));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Status change methods
    public function markAsApproved()
    {
        $this->update(['status' => 'approved']);
    }

    public function markAsShipped()
    {
        $this->update(['status' => 'shipped']);
    }

    public function markAsCancelled()
    {
        $this->update(['status' => 'cancelled']);
        // Add any cancellation logic here
    }
}