<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallOrderList extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hall_order_lists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hall_order_id',
        'hall_id',
        'no_of_hours',
        'hall_cost',
    ];

    /**
     * Get the hall order that owns the HallOrderList.
     */
    public function hallOrder()
    {
        return $this->belongsTo(HallOrder::class, 'hall_order_id');
    }

    /**
     * Get the hall associated with the HallOrderList.
     */
    public function hall()
    {
        return $this->belongsTo(Hall::class, 'hall_id');
    }
}
