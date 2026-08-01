<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="Testimonial",
 *      required={"name","testimonial_category_id"},
 *      @OA\Property(
 *          property="name",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="company",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="designation",
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
 *          format="date"
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
 *      )
 * )
 */class Testimonial extends Model
{
    use HasFactory;    public $table = 'testimonials';

    public $fillable = [
        'name',
        'company',
        'designation',
        'date',
        'rating',
        'image',
        'image_alt_text',
        'icon',
        'video_url',
        'video_iframe',
        'short_description',
        'description',
        'custom_url',
        'new_window',
        'sort',
        'testimonial_category_id'
    ];

    protected $casts = [
        'name' => 'string',
        'company' => 'string',
        'designation' => 'string',
        'date' => 'date',
        'rating' => 'string',
        'image' => 'string',
        'image_alt_text' => 'string',
        'icon' => 'string',
        'video_url' => 'string',
        'video_iframe' => 'string',
        'short_description' => 'string',
        'description' => 'string',
        'custom_url' => 'string',
        'new_window' => 'boolean'
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'company' => 'nullable|string|max:255',
        'designation' => 'nullable|string|max:255',
        'date' => 'nullable',
        'rating' => 'nullable|string|max:255',
        // 'image' => 'nullable|string|max:255',
        'image_alt_text' => 'nullable|string|max:255',
        'icon' => 'nullable|string|max:255',
        'video_url' => 'nullable|string|max:255',
        'video_iframe' => 'nullable|string|max:255',
        'short_description' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:65535',
        'custom_url' => 'nullable|string|max:65535',
        'new_window' => 'nullable|boolean',
        'sort' => 'nullable',
        'testimonial_category_id' => 'required'
    ];

    public function testimonialCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\TestimonialCategory::class, 'testimonial_category_id');
    }
}