<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="Team",
 *      required={"team_categories_id","name"},
 *      @OA\Property(
 *          property="name",
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
 *          property="designation",
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
 *          property="linkedin_url",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="facebook_url",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="instagram_url",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="twitter_url",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="github_url",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="other",
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
 */class Team extends Model
{
    use HasFactory;    public $table = 'teams';

    public $fillable = [
        'team_categories_id',
        'name',
        'slug',
        'image',
        'image_alt_text',
        'designation',
        'description',
        'linkedin_url',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'github_url',
        'other',
        'sort'
    ];

    protected $casts = [
        'name' => 'string',
        'image' => 'string',
        'image_alt_text' => 'string',
        'designation' => 'string',
        'description' => 'string',
        'linkedin_url' => 'string',
        'facebook_url' => 'string',
        'instagram_url' => 'string',
        'twitter_url' => 'string',
        'github_url' => 'string',
        'other' => 'string'
    ];

    public static array $rules = [
        'team_categories_id' => 'required',
        'name' => 'required|string|max:255',
        // 'image' => 'nullable|string|max:255',
        'image_alt_text' => 'nullable|string|max:255',
        'designation' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:65535',
        'linkedin_url' => 'nullable|string|max:255',
        'facebook_url' => 'nullable|string|max:255',
        'instagram_url' => 'nullable|string|max:255',
        'twitter_url' => 'nullable|string|max:255',
        'github_url' => 'nullable|string|max:255',
        'other' => 'nullable|string|max:65535',
        'sort' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function teamCategories(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\TeamCategory::class, 'team_categories_id');
    }
}
