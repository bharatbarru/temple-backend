<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="ApplicationSetting",
 *      required={"field_name","slug","input_type","application_setting_type_id"},
 *      @OA\Property(
 *          property="field_name",
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
 *          property="input_type",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="value",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="alt_text",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="options",
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
 */ class ApplicationSetting extends Model
{
    use HasFactory;
    public $table = 'application_settings';

    public $fillable = [
        'field_name',
        'slug',
        'input_type',
        'value',
        'alt_text',
        'options',
        'application_setting_type_id',
        'application_setting_category_id',
        'sort'
    ];

    protected $casts = [
        'field_name' => 'string',
        'slug' => 'string',
        'input_type' => 'string',
        'value' => 'string',
        'alt_text' => 'string',
        'options' => 'string'
    ];

    public static array $rules = [
        'field_name' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'input_type' => 'required|string|max:255',
        'value' => 'nullable|string|max:65535',
        'alt_text' => 'nullable|string|max:255',
        'options' => 'nullable|string|max:65535',
        'application_setting_type_id' => 'required',
        'application_setting_category_id' => 'nullable',
        'sort' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function applicationSettingCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\ApplicationSettingCategory::class, 'application_setting_category_id');
    }

    public function applicationSettingType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\ApplicationSettingType::class, 'application_setting_type_id');
    }
}
