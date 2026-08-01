<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="Service",
 *      required={"service_category_id","title","icon","publish"},
 *      @OA\Property(
 *          property="title",
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
 *          property="sub_title",
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
 *          property="gallery",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="video_url",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="video_iframe",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="page_title",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="seo_title",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="seo_keywords",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="seo_description",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="icon",
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
 */ class Service extends Model
{
    use HasFactory;
    public $table = 'services';

    public $fillable = [
        'service_category_id',
        'title',
        'slug',
        'sub_title',
        'image',
        'image_alt_text',
        'short_description',
        'description',
        'custom_url',
        'new_window',
        'gallery',
        'video_url',
        'video_iframe',
        'page_title',
        'seo_title',
        'seo_keywords',
        'seo_description',
        'icon',
        'publish',
        'banner_image',
        'sort'
    ];

    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'sub_title' => 'string',
        'image' => 'string',
        'image_alt_text' => 'string',
        'short_description' => 'string',
        'description' => 'string',
        'custom_url' => 'string',
        'new_window' => 'boolean',
        'gallery' => 'array',
        'video_url' => 'string',
        'video_iframe' => 'string',
        'page_title' => 'string',
        'seo_title' => 'string',
        'seo_keywords' => 'string',
        'seo_description' => 'string',
        'icon' => 'string',
        'publish' => 'boolean',
        'banner_image' => 'string',
    ];

    public static array $rules = [
        'service_category_id' => 'required',
        'title' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255',
        'sub_title' => 'nullable|string|max:255',
        'image_alt_text' => 'nullable|string|max:255',
        'short_description' => 'nullable|string|max:65535',
        'description' => 'nullable|string|max:65535',
        'custom_url' => 'nullable|string|max:255',
        'new_window' => 'nullable|boolean',
        'video_url' => 'nullable|string|max:255',
        'video_iframe' => 'nullable|string|max:65535',
        'page_title' => 'nullable|string|max:65535',
        'seo_title' => 'nullable|string|max:65535',
        'seo_keywords' => 'nullable|string|max:65535',
        'seo_description' => 'nullable|string|max:65535',
        'icon' => 'nullable|string|max:255',
        'publish' => 'required|boolean',
        'sort' => 'nullable',
        'banner_image' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function serviceCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\ServiceCategory::class, 'service_category_id');
    }
}