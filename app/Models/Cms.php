<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="Cms",
 *      required={"title","slug","parent","type","main_menu","top_menu","side_menu","footer_menu","publish"},
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
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="parent",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="type",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
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
 *          property="banner_image",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="banner_image_alt_text",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="banner_title",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="banner_tagline",
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
 *          property="content",
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
 *          property="main_menu",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="boolean",
 *      ),
 *      @OA\Property(
 *          property="top_menu",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="boolean",
 *      ),
 *      @OA\Property(
 *          property="side_menu",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="boolean",
 *      ),
 *      @OA\Property(
 *          property="footer_menu",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="boolean",
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
 */ class Cms extends Model
{
    use HasFactory;
    public $table = 'cms';

    public $fillable = [
        'title',
        'slug',
        'parent',
        'type',
        'custom_url',
        'banner_image',
        'banner_image_alt_text',
        'banner_title',
        'banner_tagline',
        'short_description',
        'content',
        'gallery',
        'main_menu',
        'top_menu',
        'side_menu',
        'footer_menu',
        'seo_title',
        'seo_keywords',
        'seo_description',
        'publish',
        'sort'
    ];

    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'parent' => 'string',
        'custom_url' => 'string',
        'banner_image' => 'string',
        'banner_title' => 'string',
        'banner_tagline' => 'string',
        'short_description' => 'string',
        'content' => 'string',
        'gallery' => 'string',
        'seo_title' => 'string',
        'seo_keywords' => 'string',
        'seo_description' => 'string',
        'type' => 'string',
    ];

    public static array $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'parent' => 'required|string|max:255',
        'type' => 'required|string|max:255',
    ];

    public function parentName()
    {
        return $this->belongsTo('App\Models\Cms', 'parent');
    }

    public function subMenu()
    {
        return $this->hasMany('App\Models\Cms', 'parent')->where('publish', 1);
    }
    public function faq(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\product::class, 'page_name');
    }
}
