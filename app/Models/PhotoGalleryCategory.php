<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="PhotoGalleryCategory",
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
 */class PhotoGalleryCategory extends Model
{
    use HasFactory;    public $table = 'photo_gallery_categories';

    public $fillable = [
        'name',
        'display_name',
        'icon',
        'type',
        'sort'
    ];

    protected $casts = [
        'name' => 'string',
        'display_name' => 'string',
        'icon' => 'string',
        'type' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'display_name' => 'nullable|string|max:255',
        'icon' => 'nullable|string|max:255',
        'type' => 'nullable|string|max:255',
        'sort' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function photoGalleries(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\PhotoGallery::class, 'photo_category_id');
    }
}