<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="Customer",
 *      required={"name"},
 *      @OA\Property(
 *          property="name",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="email",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="mobile",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="address",
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
 */ class Customer extends Authenticatable
{
    use HasFactory;
    public $table = 'customers';

    public $fillable = [
        'name',
        'email',
        'mobile',
        'address',
        'pincode',
        'provider',
        'provider_id',
        'publish'
    ];

    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'mobile' => 'string',
        'address' => 'string',
        'pincode' => 'string',
        'publish' => 'boolean'
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'email' => 'nullable|string|max:255',
        'mobile' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:65535',
        'pincode' => 'nullable',
        'publish' => 'nullable|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Order::class, 'customer_id');
    }

    public function royaltyPoints(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\RoyaltyPoint::class, 'customer_id');
    }

    public function latestOrder()
    {
        return $this->hasOne(\App\Models\Order::class, 'customer_id')->latestOfMany();
    }

    // Function to get total royalty points
    public function getUserRoyaltyPointsTotal()
    {
        return $this->royaltyPoints->sum('points');
    }

    // Function to get used royalty points
    public function getUserRoyaltyPointsUsed()
    {
        return $this->orders->sum('royalty_points_amount');
    }

    // Function to get remaining royalty points
    public function getUserRoyaltyPointsRemaining()
    {
        $total = $this->getUserRoyaltyPointsTotal();
        $used = $this->getUserRoyaltyPointsUsed();
        return $total - $used;
    }
}
