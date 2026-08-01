<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="HallEventType",
 *      required={"name","sort","publish"},
 *      @OA\Property(
 *          property="name",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="publish",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="boolean",
 *      ),
 *      @OA\Property(
 *          property="created_at",
 *          description="",
 *          readOnly=true,
 *          nullable=true,
 *          type="string",
 *          format="date-time"
 *      ),
 *      @OA\Property(
 *          property="updated_at",
 *          description="",
 *          readOnly=true,
 *          nullable=true,
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */class HallEventType extends Model
{
    use HasFactory;    public $table = 'hall_event_types';

    public $fillable = [
        'name',
        'sort',
        'publish'
    ];

    protected $casts = [
        'name' => 'string',
        'publish' => 'boolean'
    ];

    public static array $rules = [
        'name' => 'required|string|max:255|unique:hall_event_types,name,',
    ];

    public function hallOrders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\HallOrder::class, 'hall_event_type_id');
    }
}
