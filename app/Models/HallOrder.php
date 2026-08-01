<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="HallOrder",
 *      required={"hall_request_id","type_of_event","terms_conditions"},
 *      @OA\Property(
 *          property="hall_request_id",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="type_of_event",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="other_event_type",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="date_of_event",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *          format="date"
 *      ),
 *      @OA\Property(
 *          property="alternate_date_of_event",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *          format="date"
 *      ),
 *      @OA\Property(
 *          property="duration",
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
 *          property="total_amount",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="number",
 *          format="number"
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
 */class HallOrder extends Model
{
    use HasFactory;    public $table = 'hall_orders';

    public $fillable = [
        'hall_request_id',
        'type_of_event',
        'event_duration',
        'user_id',
        'hall_event_type_id',
        'other_event_type',
        'date_of_event',
        'alternate_date_of_event',
        'start_time',
        'duration',
        'comments',
        'total_amount',
        'admin_comments',
        'cancelled_by',
        'cancelled_comments',
        'changed_by',
        'changed_comments',
        'payment_status',
        'terms_conditions',
        'end_date_of_event',
        'number_of_days'
    ];

    protected $casts = [
        'hall_request_id' => 'string',
        'type_of_event' => 'string',
        'other_event_type' => 'string',
        'date_of_event' => 'date',
        'alternate_date_of_event' => 'date',
        'duration' => 'string',
        'comments' => 'string',
        'total_amount' => 'float',
        'admin_comments' => 'string',
        'cancelled_by' => 'string',
        'cancelled_comments' => 'string',
        'changed_by' => 'string',
        'changed_comments' => 'string',
        'payment_status' => 'string',
        'terms_conditions' => 'boolean'
    ];

    public static array $rules = [
        'hall_request_id' => 'nullable|string|max:255|unique:hall_orders,hall_request_id,',
        'type_of_event' => 'nullable|string|max:255',
        'user_id' => 'nullable',
        'hall_event_type_id' => 'nullable',
        'other_event_type' => 'nullable|string|max:255',
        'date_of_event' => 'nullable',
        'alternate_date_of_event' => 'nullable',
        'start_time' => 'nullable',
        'duration' => 'nullable|max:255',
        'comments' => 'nullable|string|max:65535',
        'total_amount' => 'nullable|numeric',
        'admin_comments' => 'nullable|string|max:65535',
        'cancelled_by' => 'nullable|string|max:255',
        'cancelled_comments' => 'nullable|string|max:65535',
        'changed_by' => 'nullable|string|max:255',
        'changed_comments' => 'nullable|string|max:65535',
        'payment_status' => 'nullable|string|max:255',
        'terms_conditions' => 'nullable|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($hallOrder) {
            $now = Carbon::now();
            $year = (int) $now->format('Y');
            $prefix = $now->format('Ymd') . 'SH';

            // Lock the latest order for this year to avoid race conditions
            $lastOrder = DB::table('hall_orders')
                ->whereYear('created_at', $year)
                ->orderByDesc('id')
                ->lockForUpdate()
                ->first();

            $nextSeq = 1;
            if ($lastOrder && isset($lastOrder->hall_request_id)) {
                if (preg_match('/SH(\d{4})$/', $lastOrder->hall_request_id, $m)) {
                    $nextSeq = ((int) $m[1]) + 1;
                }
            }

            $hallOrder->hall_request_id = $prefix . str_pad((string) $nextSeq, 4, '0', STR_PAD_LEFT);
        });
    }

    public function hallEventType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\HallEventType::class, 'hall_event_type_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\FrontendUser::class, 'user_id');
    }

    public function hallOrderAddonsLists(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\HallOrderAddonList::class, 'hall_order_id');
    }

    public function hallOrderLists(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\HallOrderList::class, 'hall_order_id');
    }

    public function orderStatuses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\OrderStatus::class, 'hall_order_id');
    }

    public function getLatestStatus()
    {
        return $this->orderStatuses()->latest()->value('status') ?? 'No Status Available';
    }
}
