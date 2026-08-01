<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="Hall",
 *      required={"name","monday_cost","tuesday_cost","wednesday_cost","thursday_cost","friday_cost","saturday_cost","sunday_cost","sort","publish"},
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
 *          property="monday_cost",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="number",
 *          format="number"
 *      ),
 *      @OA\Property(
 *          property="tuesday_cost",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="number",
 *          format="number"
 *      ),
 *      @OA\Property(
 *          property="wednesday_cost",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="number",
 *          format="number"
 *      ),
 *      @OA\Property(
 *          property="thursday_cost",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="number",
 *          format="number"
 *      ),
 *      @OA\Property(
 *          property="friday_cost",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="number",
 *          format="number"
 *      ),
 *      @OA\Property(
 *          property="saturday_cost",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="number",
 *          format="number"
 *      ),
 *      @OA\Property(
 *          property="sunday_cost",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="number",
 *          format="number"
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
 */class Hall extends Model
{
    use HasFactory;    public $table = 'halls';

    public $fillable = [
        'name',
        'description',
        'image',
        'image_alt_text',
        'monday_cost',
        'tuesday_cost',
        'wednesday_cost',
        'thursday_cost',
        'friday_cost',
        'saturday_cost',
        'sunday_cost',
        'monday_three_day_cost',
        'tuesday_three_day_cost',
        'wednesday_three_day_cost',
        'thursday_three_day_cost',
        'friday_three_day_cost',
        'saturday_three_day_cost',
        'sunday_three_day_cost',
        'sort',
        'publish'
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'image' => 'string',
        'image_alt_text' => 'string',
        'monday_cost' => 'float',
        'tuesday_cost' => 'float',
        'wednesday_cost' => 'float',
        'thursday_cost' => 'float',
        'friday_cost' => 'float',
        'saturday_cost' => 'float',
        'sunday_cost' => 'float',
        'monday_three_day_cost' => 'float',
        'tuesday_three_day_cost' => 'float',
        'wednesday_three_day_cost' => 'float',
        'thursday_three_day_cost' => 'float',
        'friday_three_day_cost' => 'float',
        'saturday_three_day_cost' => 'float',
        'sunday_three_day_cost' => 'float',
        'publish' => 'boolean'
    ];

    public static array $rules = [
        'name' => 'required|string|max:255|unique:halls,name,',
        'description' => 'nullable|string|max:65535',
        'image' => 'nullable|max:255',
        'image_alt_text' => 'nullable|string|max:255',
        'monday_cost' => 'required|numeric',
        'tuesday_cost' => 'required|numeric',
        'wednesday_cost' => 'required|numeric',
        'thursday_cost' => 'required|numeric',
        'friday_cost' => 'required|numeric',
        'saturday_cost' => 'required|numeric',
        'sunday_cost' => 'required|numeric',
        'monday_three_day_cost' => 'required|numeric',
        'tuesday_three_day_cost' => 'required|numeric',
        'wednesday_three_day_cost' => 'required|numeric',
        'thursday_three_day_cost' => 'required|numeric',
        'friday_three_day_cost' => 'required|numeric',
        'saturday_three_day_cost' => 'required|numeric',
        'sunday_three_day_cost' => 'required|numeric',
    ];

    public function hallAddonCosts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\HallAddonCost::class, 'hall_id');
    }

    public function hallOrderLists(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\HallOrderList::class, 'hall_id');
    }
}
