<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="PujaOrder",
 *      required={"puja_request_id","user_id","puja_location","date_of_puja","time_of_puja","terms_conditions"},
 *      @OA\Property(
 *          property="puja_request_id",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="puja_location",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="date_of_puja",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *          format="date"
 *      ),
 *      @OA\Property(
 *          property="time_of_puja",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="alternate_date_of_puja1",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *          format="date"
 *      ),
 *      @OA\Property(
 *          property="alternate_date_of_puja2",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *          format="date"
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
 *          property="priest_name",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="comments",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="admin_comments",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="cancelled_by",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="cancelled_comments",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="changed_by",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="changed_comments",
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
 *          property="terms_conditions",
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
 */class PujaOrder extends Model
{
    use HasFactory;    public $table = 'puja_orders';

    public $fillable = [
        'puja_request_id',
        'user_id',
        'puja_location',
        'date_of_puja',
        'time_of_puja',
        'alternate_date_of_puja1',
        'alternate_time_of_puja2',
        'total_amount',
        'priest_name',
        'comments',
        'admin_comments',
        'cancelled_by',
        'cancelled_comments',
        'changed_by',
        'changed_comments',
        'payment_status',
        'terms_conditions'
    ];

    protected $casts = [
        'puja_request_id' => 'string',
        'puja_location' => 'string',
        'date_of_puja' => 'date',
        'time_of_puja' => 'string',
        'alternate_date_of_puja1' => 'date',
        'alternate_time_of_puja2' => 'string',
        'total_amount' => 'float',
        'priest_name' => 'string',
        'comments' => 'string',
        'admin_comments' => 'string',
        'cancelled_by' => 'string',
        'cancelled_comments' => 'string',
        'changed_by' => 'string',
        'changed_comments' => 'string',
        'payment_status' => 'string',
        'terms_conditions' => 'boolean'
    ];

    public static array $rules = [
        'puja_request_id' => 'nullable|string|max:255|unique:puja_orders,puja_request_id,',
        'user_id' => 'nullable',
        'puja_location' => 'nullable|string|max:255',
        'date_of_puja' => 'required',
        'time_of_puja' => 'required|string|max:255',
        'alternate_date_of_puja1' => 'nullable',
        'alternate_time_of_puja2' => 'nullable',
        'total_amount' => 'nullable|numeric',
        'priest_name' => 'nullable|string|max:255',
        'comments' => 'nullable|string|max:65535',
        'admin_comments' => 'nullable|string|max:65535',
        'cancelled_by' => 'nullable|string|max:255',
        'cancelled_comments' => 'nullable|string|max:65535',
        'changed_by' => 'nullable|string|max:255',
        'changed_comments' => 'nullable|string|max:255',
        'payment_status' => 'nullable|string|max:255',
        'terms_conditions' => 'nullable|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pujaOrder) {
            $now = Carbon::now();
            $year = (int) $now->format('Y');
            $prefix = $now->format('Ymd') . 'P';

            // Lock the latest order for this year to avoid race conditions
            // $lastOrder = DB::table('puja_orders')
            //     ->whereYear('created_at', $year)
            //     ->orderByDesc('id')
            //     ->lockForUpdate()
            //     ->first();

            // $nextSeq = 1;
            // if ($lastOrder && isset($lastOrder->puja_request_id)) {
            //     if (preg_match('/P(\d{4})$/', $lastOrder->puja_request_id, $m)) {
            //         $nextSeq = ((int) $m[1]) + 1;
            //     }
            // }
            DB::table('puja_orders')
                ->whereYear('created_at', $year)
                ->orderByDesc('id')
                ->lockForUpdate()
                ->first();

            $yearCount = DB::table('puja_orders')
                ->whereYear('created_at', $year)
                ->count();

            $nextSeq = $yearCount + 1;

            $pujaOrder->puja_request_id = $prefix . str_pad((string) $nextSeq, 4, '0', STR_PAD_LEFT);
        });
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\FrontendUser::class, 'user_id');
    }

    public function orderStatuses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\OrderStatus::class, 'puja_order_id');
    }

    public function pujaOrderLists(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\PujaOrderList::class, 'puja_order_id');
    }

    public function getLatestStatus()
    {
        return $this->orderStatuses()->latest()->value('status') ?? 'No Status Available';
    }
}
