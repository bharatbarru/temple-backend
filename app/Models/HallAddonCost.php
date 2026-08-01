<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallAddonCost extends Model
{
    use HasFactory;

    protected $fillable = [
        'hall_id',
        'hall_addon_id',
        'monday_cost',
        'tuesday_cost',
        'wednesday_cost',
        'thursday_cost',
        'friday_cost',
        'saturday_cost',
        'sunday_cost',
        'sort',
        'publish',
    ];

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function hallAddon()
    {
        return $this->belongsTo(HallAddon::class);
    }
}
