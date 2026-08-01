<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="TempleTour",
 *      required={"tour_request_id","name","tour_date","tour_time"},
 *      @OA\Property(
 *          property="tour_request_id",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="name",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="tour_date",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *          format="date"
 *      ),
 *      @OA\Property(
 *          property="tour_time",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="alternate_tour_date",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *          format="date"
 *      ),
 *      @OA\Property(
 *          property="alternate_tour_time",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
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
 *          property="total_visitors",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="age_range_of_group",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="last_visit_to_temple",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="boolean",
 *      ),
 *      @OA\Property(
 *          property="comment",
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
 *          property="terms_conditions",
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
 */class TempleTour extends Model
{
    use HasFactory;    public $table = 'temple_tours';

    public $fillable = [
        'tour_request_id',
        'name',
        'tour_date',
        'tour_time',
        'alternate_tour_date',
        'alternate_tour_time',
        'email',
        'mobile',
        'total_visitors',
        'age_range_of_group',
        'last_visit_to_temple',
        'comment',
        'admin_comments',
        'terms_conditions'
    ];

    protected $casts = [
        'tour_request_id' => 'string',
        'name' => 'string',
        'tour_date' => 'date',
        'tour_time' => 'string',
        'alternate_tour_date' => 'date',
        'alternate_tour_time' => 'string',
        'email' => 'string',
        'mobile' => 'string',
        'total_visitors' => 'string',
        'age_range_of_group' => 'string',
        'last_visit_to_temple' => 'boolean',
        'comment' => 'string',
        'admin_comments' => 'string',
        'terms_conditions' => 'boolean'
    ];

    public static array $rules = [
        'tour_request_id' => 'nullable|string|max:255|unique:temple_tours,tour_request_id,',
        'name' => 'required|string|max:255',
        'tour_date' => 'required',
        'tour_time' => 'required|string|max:255',
        'alternate_tour_date' => 'nullable',
        'alternate_tour_time' => 'nullable|string|max:255',
        'email' => 'nullable|string|max:255',
        'mobile' => 'nullable|string|max:255',
        'total_visitors' => 'nullable|max:255',
        'age_range_of_group' => 'nullable|string|max:255',
        'last_visit_to_temple' => 'nullable|boolean',
        'comment' => 'nullable|string|max:65535',
        'admin_comments' => 'nullable|string|max:65535',
        'terms_conditions' => 'nullable|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($templeTour) {
            $now = Carbon::now();
            $year = (int) $now->format('Y');
            $prefix = $now->format('Ymd') . 'TT';

            // Lock the latest order for this year to avoid race conditions
            // $lastOrder = DB::table('temple_tours')
            //     ->whereYear('created_at', $year)
            //     ->orderByDesc('id')
            //     ->lockForUpdate()
            //     ->first();

            // $nextSeq = 1;
            // if ($lastOrder && isset($lastOrder->tour_request_id)) {
            //     if (preg_match('/TT(\d{4})$/', $lastOrder->tour_request_id, $m)) {
            //         $nextSeq = ((int) $m[1]) + 1;
            //     }
            // }
            DB::table('temple_tours')
                ->whereYear('created_at', $year)
                ->orderByDesc('id')
                ->lockForUpdate()
                ->first();

            $yearCount = DB::table('temple_tours')
                ->whereYear('created_at', $year)
                ->count();

            $nextSeq = $yearCount + 1;

            $templeTour->tour_request_id = $prefix . str_pad((string) $nextSeq, 4, '0', STR_PAD_LEFT);
        });
    }

    public function orderStatuses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\OrderStatus::class, 'temple_tour_order_id');
    }

    public function getLatestStatus()
    {
        return $this->orderStatuses()->latest()->value('status') ?? 'No Status Available';
    }

}
