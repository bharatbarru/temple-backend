<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="Coupon",
 *      required={"coupon_code","discount_type","discount_value","min_order_amount"},
 *      @OA\Property(
 *          property="coupon_code",
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
 *          property="discount_type",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="discount_value",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="number",
 *          format="number"
 *      ),
 *      @OA\Property(
 *          property="min_order_amount",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="number",
 *          format="number"
 *      ),
 *      @OA\Property(
 *          property="valid_from",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *          format="date"
 *      ),
 *      @OA\Property(
 *          property="valid_until",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *          format="date"
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
 */ class Coupon extends Model
{
    use HasFactory;
    public $table = 'coupons';

    public $fillable = [
        'coupon_code',
        'image',
        'discount_type',
        'discount_value',
        'max_amount',
        'min_order_amount',
        'valid_from',
        'valid_until',
        'usage_limit'
    ];

    protected $casts = [
        'coupon_code' => 'string',
        'image' => 'string',
        'discount_type' => 'string',
        'discount_value' => 'float',
        'max_amount' => 'float',
        'min_order_amount' => 'float',
        'valid_from' => 'date',
        'valid_until' => 'date'
    ];

    public static array $rules = [
        'coupon_code' => 'required|string|max:255|unique:coupons,coupon_code,',
        'image' => 'nullable|max:255',
        'discount_type' => 'required|string|max:255',
        'discount_value' => 'required|numeric',
        'max_amount' => 'nullable|numeric',
        'min_order_amount' => 'required|numeric',
        'valid_from' => 'nullable',
        'valid_until' => 'nullable',
        'usage_limit' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Order::class, 'coupon_id');
    }

    public function getFormattedDiscountValue()
    {
        // Check if the discount type is 'fixed' (amount)
        if ($this->discount_type == 'fixed') {
            // Return formatted amount
            return formatAmount($this->discount_value);
        }

        // If the discount type is 'percentage'
        if ($this->discount_type == 'percentage') {
            // Check if the percentage type is 'upto' or 'flat'
            if ($this->max_amount) {
                // Return the percentage value with "Upto" and max_amount
                return $this->discount_value . "% Upto " . formatAmount($this->max_amount);
            } else {
                // Return the percentage value with "Flat"
                return $this->discount_value . "% Flat";
            }
        }

        // Default return value if neither condition is met
        return '-';
    }
}
