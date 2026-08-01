<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="PaymentMethod",
 *      required={"payment_method_name","display_name","slug"},
 *      @OA\Property(
 *          property="payment_method_name",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="display_name",
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
 *          property="sandbox_key",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="sandbox_secret",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="live_key",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="live_secret",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="publish",
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
 */class PaymentMethod extends Model
{
    use HasFactory;    public $table = 'payment_methods';

    public $fillable = [
        'payment_method_name',
        'display_name',
        'slug',
        'sandbox_key',
        'sandbox_secret',
        'live_key',
        'live_secret',
        'publish',
        'sort'
    ];

    protected $casts = [
        'payment_method_name' => 'string',
        'display_name' => 'string',
        'slug' => 'string',
        'sandbox_key' => 'string',
        'sandbox_secret' => 'string',
        'live_key' => 'string',
        'live_secret' => 'string',
        'publish' => 'boolean'
    ];

    public static array $rules = [
        'payment_method_name' => 'required|string|max:255',
        'display_name' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'sandbox_key' => 'nullable|string|max:255',
        'sandbox_secret' => 'nullable|string|max:255',
        'live_key' => 'nullable|string|max:255',
        'live_secret' => 'nullable|string|max:255',
        'publish' => 'nullable|boolean',
        'sort' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Order::class, 'payment_method_id');
    }
}
