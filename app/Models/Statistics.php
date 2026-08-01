<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="Statistics",
 *      required={"title"},
 *      @OA\Property(
 *          property="title",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="number",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="prefix",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="suffix",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="url",
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
 */class Statistics extends Model
{
    use HasFactory;    public $table = 'statistics';

    public $fillable = [
        'title',
        'number',
        'prefix',
        'suffix',
        'url',
        'sort',
        'new_window'
    ];

    protected $casts = [
        'title' => 'string',
        'number' => 'string',
        'prefix' => 'string',
        'suffix' => 'string',
        'url' => 'string',
        'new_window' => 'boolean'
    ];

    public static array $rules = [
        'title' => 'required|string|max:255',
        'number' => 'nullable|string|max:255',
        'prefix' => 'nullable|string|max:255',
        'suffix' => 'nullable|string|max:255',
        'url' => 'nullable|string|max:65535',
        'new_window' => 'nullable|boolean',
        'sort' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}