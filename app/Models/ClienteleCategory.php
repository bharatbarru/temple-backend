<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="ClienteleCategory",
 *      required={"name"},
 *      @OA\Property(
 *          property="name",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="display_name",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="tagline",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="icon",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="type",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
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
 */class ClienteleCategory extends Model
{
    use HasFactory;    public $table = 'clientele_categories';

    public $fillable = [
        'name',
        'display_name',
        'tagline',
        'icon',
        'type'
    ];

    protected $casts = [
        'name' => 'string',
        'display_name' => 'string',
        'tagline' => 'string',
        'icon' => 'string',
        'type' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'display_name' => 'nullable|string|max:255',
        'tagline' => 'nullable|string|max:65535',
        'icon' => 'nullable|string|max:255',
        'type' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function clienteles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Clientele::class, 'clientele_category_id');
    }

    public function activeClienteles(){
        return $this->clienteles()->where('publish', 1);
    }
}
