<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="HallAddon",
 *      required={"name","sort","publish"},
 *      @OA\Property(
 *          property="name",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="description",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="image",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="image_alt_text",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
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
 */class HallAddon extends Model
{
    use HasFactory;    public $table = 'hall_addons';

    public $fillable = [
        'name',
        'description',
        'image',
        'image_alt_text',
        'sort',
        'publish',
        'default',
        'event_type'
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'image' => 'string',
        'image_alt_text' => 'string',
        'publish' => 'boolean'
    ];

    public static array $rules = [
        'name' => 'required|string|max:255|unique:hall_addons,name,',
        'description' => 'nullable|string|max:65535',
        'image' => 'nullable|max:255',
        'image_alt_text' => 'nullable|string|max:255',
    ];

    public function hallAddonCosts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\HallAddonCost::class, 'hall_addon_id');
    }

    public function hallOrderAddonsLists(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\HallOrderAddonList::class, 'hall_addon_id');
    }
}
