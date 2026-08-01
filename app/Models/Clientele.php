<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="Clientele",
 *      required={"clientele_category_id","image","publish"},
 *      @OA\Property(
 *          property="image",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
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
 *          property="title",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="sub_title",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="url",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="new_window",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="boolean",
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
 */ class Clientele extends Model
{
    use HasFactory;
    public $table = 'clienteles';

    public $fillable = [
        'clientele_category_id',
        'image',
        'image_alt_text',
        'title',
        'sub_title',
        'url',
        'new_window',
        'publish',
        'sort'
    ];

    protected $casts = [
        'image' => 'string',
        'image_alt_text' => 'string',
        'title' => 'string',
        'sub_title' => 'string',
        'url' => 'string',
        'new_window' => 'boolean',
        'publish' => 'boolean'
    ];

    public static array $rules = [
        'clientele_category_id' => 'required',
        // 'image' => 'required',
        'image_alt_text' => 'nullable|string|max:255',
        'title' => 'nullable|string|max:255',
        'sub_title' => 'nullable|string|max:65535',
        'url' => 'nullable|string|max:255',
        'new_window' => 'nullable|boolean',
        'publish' => 'required|boolean',
        'sort' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function clienteleCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\ClienteleCategory::class, 'clientele_category_id');
    }
}