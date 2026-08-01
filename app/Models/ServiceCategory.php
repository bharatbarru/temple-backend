<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="ServiceCategory",
 *      required={"name","tagline"},
 *      @OA\Property(
 *          property="name",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="slug",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
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
 *          property="icon",
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
 *          property="tagline",
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
 */ class ServiceCategory extends Model
{
    use HasFactory;
    public $table = 'service_categories';

    public $fillable = [
        'name',
        'slug',
        'display_name',
        'image',
        'image_alt_text',
        'icon',
        'description',
        'tagline',
        'service_type_id'
    ];

    protected $casts = [
        'name' => 'string',
        'slug' => 'string',
        'display_name' => 'string',
        'image' => 'string',
        'image_alt_text' => 'string',
        'icon' => 'string',
        'description' => 'string',
        'tagline' => 'string',
        'service_type_id' => 'integer'
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255',
        'display_name' => 'nullable|string|max:255',
        // 'image' => 'string',
        'image_alt_text' => 'nullable|string|max:255',
        'icon' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:65535',
        'tagline' => 'nullable|string|max:255',
    ];

    public function services(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Service::class, 'service_category_id');
    }

    public function serviceType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\serviceType::class, 'service_type_id');
    }
}