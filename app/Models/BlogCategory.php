<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="BlogCategory",
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
 */class BlogCategory extends Model
{
    use HasFactory;    public $table = 'blog_categories';

    public $fillable = [
        'name',
        'display_name',
        'image',
        'image_alt_text',
        'icon',
        'description',
        'type',
        'sort'
    ];

    protected $casts = [
        'name' => 'string',
        'display_name' => 'string',
        'image' => 'string',
        'image_alt_text' => 'string',
        'icon' => 'string',
        'description' => 'string',
        'type' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'display_name' => 'nullable|string|max:255',
//        'image_alt_text' => 'nullable|string|max:255',
        'icon' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:65535',
        'type' => 'nullable|string|max:255',
        'sort' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function blogPost(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\BlogPost::class, 'blog_category_id');
    }

    public function activeBlogPosts(){
        return $this->blogPost()->where('publish', 1);
    }
}