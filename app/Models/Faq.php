<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="Faq",
 *      required={"faq_categories_id","question","answer"},
 *      @OA\Property(
 *          property="question",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="answer",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="button_name",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="button_url",
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
 */class Faq extends Model
{
    use HasFactory;    public $table = 'faqs';

    public $fillable = [
        'faq_categories_id',
        'question',
        'answer',
        'button_name',
        'button_url',
        'new_window',
        'sort'
    ];

    protected $casts = [
        'question' => 'string',
        'answer' => 'string',
        'button_name' => 'string',
        'button_url' => 'string',
        'new_window' => 'boolean'
    ];

    public static array $rules = [
        'faq_categories_id' => 'required',
        'question' => 'required|string|max:255',
        'answer' => 'required|string|max:65535',
        'button_name' => 'nullable|string|max:255',
        'button_url' => 'nullable|string|max:65535',
        'new_window' => 'nullable|boolean',
        'sort' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function faqCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\FaqCategory::class, 'faq_categories_id');
    }
}
