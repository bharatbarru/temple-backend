<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="EventCategory",
 *      required={"name","slug","sort","publish"},
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
 */class EventCategory extends Model
{
    use HasFactory;    public $table = 'event_categories';

    public $fillable = [
        'name',
        'slug',
        'display_name',
        'image',
        'image_alt_text',
        'sort',
        'publish'
    ];

    protected $casts = [
        'name' => 'string',
        'slug' => 'string',
        'display_name' => 'string',
        'image' => 'string',
        'image_alt_text' => 'string',
        'publish' => 'boolean'
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'display_name' => 'nullable|string|max:255',
        'image' => 'nullable|max:255',
        'image_alt_text' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function events(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Event::class, 'event_category_id');
    }
}
