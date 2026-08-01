<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

/**
 * @OA\Schema(
 *      schema="Order",
 *      required={"orderid"},
 *      @OA\Property(
 *          property="orderid",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="guest_name",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="guest_email",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="guest_phone",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="order_type",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="subtotal_amount",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="number",
 *          format="number"
 *      ),
 *      @OA\Property(
 *          property="coupon_discount",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="number",
 *          format="number"
 *      ),
 *      @OA\Property(
 *          property="royalty_points_amount",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="number",
 *          format="number"
 *      ),
 *      @OA\Property(
 *          property="tax_amount",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="number",
 *          format="number"
 *      ),
 *      @OA\Property(
 *          property="delivery_charge",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="number",
 *          format="number"
 *      ),
 *      @OA\Property(
 *          property="total_amount",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="number",
 *          format="number"
 *      ),
 *      @OA\Property(
 *          property="delivery_address",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="contact_number",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="transaction_id",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="payment_status",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="order_status",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="reason_for_cancellation",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="order_date",
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
 */ class Order extends Model
{
    use HasFactory;
    public $table = 'orders';

    public $fillable = [
        'orderid',
        'customer_id',
        'guest_name',
        'guest_email',
        'guest_phone',
        'order_type',
        'subtotal_amount',
        'coupon_discount',
        'royalty_points_amount',
        'tax_amount',
        'delivery_charge',
        'total_amount',
        'coupon_id',
        'delivery_address',
        'contact_number',
        'payment_method_id',
        'transaction_id',
        'payment_status',
        'order_status',
        'reason_for_cancellation',
        'order_date'
    ];

    protected $casts = [
        'orderid' => 'string',
        'guest_name' => 'string',
        'guest_email' => 'string',
        'guest_phone' => 'string',
        'order_type' => 'string',
        'subtotal_amount' => 'float',
        'coupon_discount' => 'float',
        'royalty_points_amount' => 'float',
        'tax_amount' => 'float',
        'delivery_charge' => 'float',
        'total_amount' => 'float',
        'delivery_address' => 'string',
        'contact_number' => 'string',
        'transaction_id' => 'string',
        'payment_status' => 'string',
        'order_status' => 'string',
        'reason_for_cancellation' => 'string',
        'order_date' => 'date'
    ];

    public static array $rules = [
        'orderid' => 'required|string|max:255',
        'customer_id' => 'nullable',
        'guest_name' => 'nullable|string|max:255',
        'guest_email' => 'nullable|string|max:255',
        'guest_phone' => 'nullable|string|max:255',
        'order_type' => 'nullable|string|max:255',
        'subtotal_amount' => 'nullable|numeric',
        'coupon_discount' => 'nullable|numeric',
        'royalty_points_amount' => 'nullable|numeric',
        'tax_amount' => 'nullable|numeric',
        'delivery_charge' => 'nullable|numeric',
        'total_amount' => 'nullable|numeric',
        'coupon_id' => 'nullable',
        'delivery_address' => 'nullable|string|max:65535',
        'contact_number' => 'nullable|string|max:255',
        'payment_method_id' => 'nullable',
        'transaction_id' => 'nullable|string|max:255',
        'payment_status' => 'nullable|string|max:255',
        'order_status' => 'nullable|string|max:255',
        'reason_for_cancellation' => 'nullable|string|max:65535',
        'order_date' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function paymentMethod(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\PaymentMethod::class, 'payment_method_id');
    }

    public function coupon(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Coupon::class, 'coupon_id');
    }

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Customer::class, 'customer_id');
    }

    public function orderProducts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\OrderProduct::class, 'order_id');
    }

    public static function generateOrderId()
    {
        $currentYear = date('Y'); // Current year, e.g., 2024
        $nextYear = date('y', strtotime('+1 year')); // Next year in two-digit format, e.g., 25 for 2025

        // Fetch the last order number from your database (assuming it is stored in a table)
        $lastOrder = DB::table('orders')->orderBy('created_at', 'desc')->first();
        $lastOrderNumber = $lastOrder ? (int)substr($lastOrder->orderid, strrpos($lastOrder->orderid, '/') + 1) : 0;

        // Increment the order number
        $newOrderNumber = str_pad($lastOrderNumber + 1, 3, '0', STR_PAD_LEFT); // Pad with zeros

        // Format the order ID
        return "{$currentYear}-{$nextYear}/{$newOrderNumber}";
    }
}
