<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallOrderAddonList extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hall_order_addons_list';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hall_order_id',
        'hall_id',
        'hall_addon_id',
        'no_of_hours',
        'addon_cost',
    ];

    /**
     * Get the hall order that owns the HallOrderAddonList.
     */
    public function hallOrder()
    {
        return $this->belongsTo(HallOrder::class, 'hall_order_id');
    }

    /**
     * Get the hall associated with the HallOrderAddonList.
     */
    public function hall()
    {
        return $this->belongsTo(Hall::class, 'hall_id');
    }

    /**
     * Get the hall addon associated with the HallOrderAddonList.
     */
    public function hallAddon()
    {
        return $this->belongsTo(HallAddon::class, 'hall_addon_id');
    }
}
