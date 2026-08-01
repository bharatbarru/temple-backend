<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoyaltyPoint extends Model
{
    use HasFactory;
    public $table = 'royalty_points';

    public $fillable = [
        'customer_id',
        'order_id',
        'points',
    ];

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Order::class, 'order_id');
    }

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Customer::class, 'customer_id');
    }
}
