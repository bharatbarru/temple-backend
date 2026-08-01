<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="PhotoGallery",
 *      required={"photo_category_id","image"},
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
 *          property="description",
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
 */ class PhotoGallery extends Model
{
    use HasFactory;
    public $table = 'photo_galleries';

    public $fillable = [
        'photo_category_id',
        'image_gallery',
        'image_alt_text',
        'thumbnail',

        'title',
        'description',
        'sort'
    ];

    protected $casts = [
        'image_gallery' => 'string',
        'thumbnail' => 'string',
        'title' => 'string',
        'description' => 'string'
    ];

    public static array $rules = [
        'photo_category_id' => 'required',
        'title' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:65535',
        'sort' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function photoCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\PhotoGalleryCategory::class, 'photo_category_id');
    }
}
