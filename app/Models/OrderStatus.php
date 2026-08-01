<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $table = 'order_status';

    protected $fillable = [
        'hall_order_id',
        'puja_order_id',
        'temple_tour_order_id',
        'status',
    ];

    public function hallOrder()
    {
        return $this->belongsTo(HallOrder::class, 'hall_order_id');
    }

    public function pujaOrder()
    {
        return $this->belongsTo(PujaOrder::class, 'puja_order_id');
    }

    public function templeTourOrder()
    {
        return $this->belongsTo(TempleTour::class, 'temple_tour_order_id');
    }
}
