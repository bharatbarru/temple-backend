<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="Puja",
 *      required={"name","home_amount","temple_amount","sort","publish"},
 *      @OA\Property(
 *          property="name",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="home_amount",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="number",
 *          format="number"
 *      ),
 *      @OA\Property(
 *          property="temple_amount",
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
 */class Puja extends Model
{
    use HasFactory;    public $table = 'pujas';

    public $fillable = [
        'name',
        'home_amount',
        'temple_amount',
        'sort',
        'publish'
    ];

    protected $casts = [
        'name' => 'string',
        'home_amount' => 'float',
        'temple_amount' => 'float',
        'publish' => 'boolean'
    ];

    protected $attributes = [
        'home_amount' => 0,
        'temple_amount' => 0,
    ];    

    public static array $rules = [
        'name' => 'required|string|max:255|unique:pujas,name,',
        'home_amount' => 'nullable|required_without:temple_amount|numeric',
        'temple_amount' => 'nullable|required_without:home_amount|numeric',
    ];

    public function pujaOrderLists(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\PujaOrderList::class, 'puja_id');
    }
}
