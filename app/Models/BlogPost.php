<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="BlogPost",
 *      required={"blog_category_id","title","publish"},
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
 *          property="post_date",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *          format="date-time"
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
 *          property="image_gallery",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="video_gallery",
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
 *          property="custom_url",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="map_url",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="map_iframe",
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
 */class BlogPost extends Model
{
    use HasFactory;    public $table = 'blog_posts';

    public $fillable = [
        'blog_category_id',
        'title',
        'slug',
        'sub_title',
        'post_date',
        'image',
        'image_alt_text',
        'short_description',
        'description',
        'image_gallery',
        'video_gallery',
        'video_url',
        'video_iframe',
        'custom_url',
        'map_url',
        'map_iframe',
        'page_title',
        'seo_title',
        'seo_keywords',
        'seo_description',
        'publish',
        'sort',
        'author_image'
    ];

    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'sub_title' => 'string',
        'post_date' => 'datetime',
        'image' => 'string',
        'image_alt_text' => 'string',
        'short_description' => 'string',
        'description' => 'string',
        'image_gallery' => 'array',
        'video_gallery' => 'string',
        'video_url' => 'string',
        'video_iframe' => 'string',
        'custom_url' => 'string',
        'map_url' => 'string',
        'map_iframe' => 'string',
        'page_title' => 'string',
        'seo_title' => 'string',
        'seo_keywords' => 'string',
        'seo_description' => 'string',
        'publish' => 'boolean',
        'author_image' => 'string',
    ];

    public static array $rules = [
        'blog_category_id' => 'required',
        'title' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255',
        'sub_title' => 'nullable|string|max:255',
        'post_date' => 'nullable',
//        'image_alt_text' => 'nullable|string|max:255',
        // 'short_description' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:65535',
//        'video_gallery' => 'nullable|string|max:65535',
        'video_url' => 'nullable|string|max:255',
        'video_iframe' => 'nullable|string|max:255',
        'custom_url' => 'nullable|string|max:255',
        'map_url' => 'nullable|string|max:255',
        'map_iframe' => 'nullable|string|max:255',
        'page_title' => 'nullable|string|max:65535',
        'seo_title' => 'nullable|string|max:65535',
        'seo_keywords' => 'nullable|string|max:65535',
        'seo_description' => 'nullable|string|max:65535',
        'publish' => 'required|boolean',
        'sort' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
    ];

    public function blogCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\BlogCategory::class, 'blog_category_id');
    }
}