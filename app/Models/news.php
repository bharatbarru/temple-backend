<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="news",
 *      required={"title"},
 *      @OA\Property(
 *          property="title",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
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
 *          property="image",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="image_alt",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="date",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="short_description",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
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
 *          property="gallery",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="custom_url",
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
 */class news extends Model
{
    use HasFactory;    public $table = 'news';

    public $fillable = [
        'news_category_id',
        'title',
        'slug',
        'tagline',
        'image',
        'image_alt',
        'date',
        'short_description',
        'description',
        'gallery',
        'custom_url',
        'new_window'
    ];

    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'tagline' => 'string',
        'image_alt' => 'string',
        'date' => 'string',
        'short_description' => 'string',
        'description' => 'string',        
        'custom_url' => 'string',
        'new_window' => 'boolean'
    ];

    public static array $rules = [
        'news_category_id' => 'nullable',
        'title' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255',
        'tagline' => 'nullable|string|max:255',
        'image_alt' => 'nullable|string|max:255',
        'date' => 'nullable|string|max:255',
        'short_description' => 'nullable|string|max:65535',
        'description' => 'nullable|string|max:65535',
        'custom_url' => 'nullable|string|max:255',
        'new_window' => 'nullable|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function newsCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\NewsCategory::class, 'news_category_id');
    }
}