<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="Event",
 *      required={"event_category_id","title","slug","sort","publish"},
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
 *          property="start_date_time",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *          format="date-time"
 *      ),
 *      @OA\Property(
 *          property="end_date_time",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *          format="date-time"
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
 */class Event extends Model
{
    use HasFactory;    public $table = 'events';

    public $fillable = [
        'event_category_id',
        'title',
        'slug',
        'image',
        'image_alt_text',
        'start_date_time',
        'end_date_time',
        'short_description',
        'description',
        'custom_url',
        'seo_title',
        'seo_keywords',
        'seo_description',
        'sort',
        'publish'
    ];

    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'image' => 'string',
        'image_alt_text' => 'string',
        'start_date_time' => 'datetime',
        'end_date_time' => 'datetime',
        'short_description' => 'string',
        'description' => 'string',
        'custom_url' => 'string',
        'seo_title' => 'string',
        'seo_keywords' => 'string',
        'seo_description' => 'string',
        'publish' => 'boolean'
    ];

    public static array $rules = [
        'event_category_id' => 'required',
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'image' => 'nullable',
        'image_alt_text' => 'nullable|string|max:255',
        'start_date_time' => 'nullable',
        'end_date_time' => 'nullable',
        'short_description' => 'nullable|string|max:65535',
        'description' => 'nullable|string|max:65535',
        'custom_url' => 'nullable|string|max:255',
        'seo_title' => 'nullable|string|max:65535',
        'seo_keywords' => 'nullable|string|max:65535',
        'seo_description' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function eventCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\EventCategory::class, 'event_category_id');
    }
}
