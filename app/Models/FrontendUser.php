<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="FrontendUser",
 *      required={"first_name","mobile","email","publish"},
 *      @OA\Property(
 *          property="first_name",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="last_name",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="mobile",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="email",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
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
 *          property="country",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="state",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="pincode",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="dob",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *          format="date"
 *      ),
 *      @OA\Property(
 *          property="rashi",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="birth_star",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="gothram",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="spouse_name",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="children_name",
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
 */class FrontendUser extends Authenticatable
{
    use HasFactory;    public $table = 'frontend_users';

    public $fillable = [
        'community_name',
        'first_name',
        'last_name',
        'mobile',
        'email',
        'password',
        'address',
        'country',
        'state',
        'city',
        'pincode',
        'dob',
        'rashi',
        'birth_star',
        'gothram',
        'spouse_name',
        'children_name',
        'publish'
    ];

    protected $casts = [
        'community_name' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'mobile' => 'string',
        'email' => 'string',
        'address' => 'string',
        'country' => 'string',
        'state' => 'string',
        'pincode' => 'string',
        'dob' => 'date',
        'rashi' => 'string',
        'birth_star' => 'string',
        'gothram' => 'string',
        'spouse_name' => 'string',
        'children_name' => 'string',
        'publish' => 'boolean'
    ];

    public static array $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'mobile' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'address' => 'nullable|string|max:65535',
        'country' => 'nullable|string|max:255',
        'state' => 'nullable|string|max:255',
        'city' => 'nullable',
        'pincode' => 'nullable|string|max:255',
        'dob' => 'nullable',
        'rashi' => 'nullable|string|max:255',
        'birth_star' => 'nullable|string|max:255',
        'gothram' => 'nullable|string|max:255',
        'spouse_name' => 'nullable|string|max:255',
        'children_name' => 'nullable|string|max:255'
    ];

    public function hallOrders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\HallOrder::class, 'user_id');
    }

    public function pujaOrders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\PujaOrder::class, 'user_id');
    }
}
