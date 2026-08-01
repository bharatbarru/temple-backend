<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PujaOrderList extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'puja_order_lists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'puja_order_id',
        'puja_id',
        'puja_cost',
    ];

    /**
     * Get the related PujaOrder.
     */
    public function pujaOrder()
    {
        return $this->belongsTo(PujaOrder::class, 'puja_order_id');
    }

    /**
     * Get the related Puja.
     */
    public function puja()
    {
        return $this->belongsTo(Puja::class, 'puja_id');
    }
}
