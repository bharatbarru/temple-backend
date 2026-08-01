<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="TestimonialCategory",
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
 *          property="testimonial_type",
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
 */class TestimonialCategory extends Model
{
    use HasFactory;    public $table = 'testimonial_categories';

    public $fillable = [
        'name',
        'display_name',
        'testimonial_type',
        'icon',
        'type'
    ];

    protected $casts = [
        'name' => 'string',
        'display_name' => 'string',
        'testimonial_type' => 'string',
        'icon' => 'string',
        'type' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'display_name' => 'nullable|string|max:255',
        'testimonial_type' => 'nullable|string|max:255',
        'icon' => 'nullable|string|max:255',
        'type' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function testimonials(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Testimonial::class, 'testimonial_category_id');
    }
}
