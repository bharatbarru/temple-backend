<?php

namespace App\Services;

use App\Models\HallOrder;
use App\Models\PaymentTransaction;
use App\Models\PujaOrder;
use App\Models\TempleTour;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Backs the admin reports.
 *
 * Every report is described in one place - its query, its column headings and
 * the way a record turns into a row - so the preview on screen and the Excel
 * download can never drift apart.
 */
class ReportService
{
    public const TYPE_DONATIONS = 'donations';
    public const TYPE_HALL_ORDERS = 'hall-orders';
    public const TYPE_PUJA_ORDERS = 'puja-orders';
    public const TYPE_TEMPLE_ORDERS = 'temple-orders';
    public const TYPE_TEMPLE_TOURS = 'temple-tours';

    private string $type;

    /** @var array<string, string|null> */
    private array $filters;

    public function __construct(?string $type = null, array $filters = [])
    {
        $this->type = array_key_exists((string) $type, self::types())
            ? (string) $type
            : self::TYPE_PUJA_ORDERS;

        $this->filters = [
            'from' => $filters['from'] ?? null,
            'to' => $filters['to'] ?? null,
            'source' => $filters['source'] ?? null,
            'payment_status' => $filters['payment_status'] ?? null,
            'search' => $filters['search'] ?? null,
        ];
    }

    /**
     * Every report offered in the admin panel.
     *
     * @return array<string, string>
     */
    public static function types(): array
    {
        return [
            self::TYPE_DONATIONS => 'Donations',
            self::TYPE_HALL_ORDERS => 'Hall Orders',
            self::TYPE_PUJA_ORDERS => 'Puja Orders (Home)',
            self::TYPE_TEMPLE_ORDERS => 'Temple Orders (At Temple)',
            self::TYPE_TEMPLE_TOURS => 'Temple Tour Requests',
        ];
    }

    /**
     * Where a booking was made.
     *
     * @return array<string, string>
     */
    public static function sources(): array
    {
        return [
            PujaOrder::SOURCE_WEB => 'Web',
            PujaOrder::SOURCE_MOBILE => 'Mobile',
            PujaOrder::SOURCE_UNKNOWN => 'Unknown',
        ];
    }

    public function type(): string
    {
        return $this->type;
    }

    public function label(): string
    {
        return self::types()[$this->type];
    }

    /** @return array<string, string|null> */
    public function filters(): array
    {
        return $this->filters;
    }

    public function filter(string $key): ?string
    {
        return $this->filters[$key] ?? null;
    }

    /**
     * Only puja bookings carry a web / mobile source.
     */
    public function supportsSource(): bool
    {
        return in_array($this->type, [self::TYPE_PUJA_ORDERS, self::TYPE_TEMPLE_ORDERS], true);
    }

    /**
     * Temple tour visits are free, so they have no payment status to filter on.
     */
    public function supportsPaymentStatus(): bool
    {
        return $this->type !== self::TYPE_TEMPLE_TOURS;
    }

    /**
     * A note shown above the report when the data itself needs explaining.
     */
    public function notice(): ?string
    {
        return match ($this->type) {
            self::TYPE_DONATIONS => 'Donations are read from the payment transactions recorded against the website. Rows appear here as soon as donation payments start being captured.',
            self::TYPE_HALL_ORDERS => 'Hall bookings are not paid for online yet, so they carry a payment status and a total amount but no card or PayPal details.',
            self::TYPE_TEMPLE_TOURS => 'Temple tour visits are free requests, so this report carries visitor details rather than payment details.',
            default => null,
        };
    }

    /**
     * The filtered query behind the report.
     */
    public function query(): Builder
    {
        $query = match ($this->type) {
            self::TYPE_DONATIONS => $this->donationsQuery(),
            self::TYPE_HALL_ORDERS => $this->hallOrdersQuery(),
            self::TYPE_TEMPLE_ORDERS => $this->pujaOrdersQuery('temple'),
            self::TYPE_TEMPLE_TOURS => $this->templeToursQuery(),
            default => $this->pujaOrdersQuery('home'),
        };

        $this->applyDateRange($query);
        $this->applySource($query);
        $this->applyPaymentStatus($query);
        $this->applySearch($query);

        return $query->latest('created_at');
    }

    /**
     * Totals for the filtered report, shown above the table.
     *
     * @return array{count: int, amount_label: string|null, amount: float|null}
     */
    public function summary(): array
    {
        $query = $this->query()->reorder();

        return match ($this->type) {
            self::TYPE_DONATIONS => [
                'count' => (clone $query)->count(),
                'amount_label' => 'Total Donated',
                'amount' => (float) (clone $query)->sum('paypal_amount'),
            ],
            self::TYPE_TEMPLE_TOURS => [
                'count' => (clone $query)->count(),
                'amount_label' => null,
                'amount' => null,
            ],
            default => [
                'count' => (clone $query)->count(),
                'amount_label' => 'Total Amount',
                'amount' => (float) (clone $query)->sum('total_amount'),
            ],
        };
    }

    /**
     * Column headings, in the same order as a mapped row.
     *
     * @return array<int, string>
     */
    public function headings(): array
    {
        return match ($this->type) {
            self::TYPE_DONATIONS => [
                'Transaction ID', 'Donated On', 'Donor Name', 'Donor Email', 'Mobile', 'Reference ID',
                'Amount', 'Currency', 'Payment Status', 'Paid', 'Payment Method', 'Card Brand', 'Card Type',
                'Card Last 4', 'Card Holder', 'Payer Email', 'Payer ID', 'PayPal Order ID',
                'PayPal Capture ID', 'Payment Created', 'Payment Updated',
            ],
            self::TYPE_HALL_ORDERS => [
                'Hall Request ID', 'Booked On', 'Customer Name', 'Email', 'Mobile', 'Event Type', 'Halls',
                'Addons', 'Date of Event', 'End Date', 'Alternate Date', 'Start Time', 'Duration',
                'Event Duration', 'No. of Days', 'Total Amount', 'Payment Status', 'Latest Status',
                'Comments', 'Admin Comments',
            ],
            self::TYPE_TEMPLE_TOURS => [
                'Tour Request ID', 'Requested On', 'Name', 'Email', 'Mobile', 'Tour Date', 'Tour Time',
                'Alternate Date', 'Alternate Time', 'Total Visitors', 'Age Range', 'Last Visit To Temple',
                'Latest Status', 'Comment', 'Admin Comments',
            ],
            default => [
                'Puja Request ID', 'Booked On', 'Source', 'Customer Name', 'Email', 'Mobile', 'City',
                'State', 'Country', 'Puja Location', 'Pujas', 'Date of Puja', 'Time of Puja',
                'Alternate Date', 'Alternate Time', 'Priest', 'Total Amount', 'Payment Status',
                'Latest Status', 'Transaction ID', 'Payment Method', 'Card Brand', 'Card Type',
                'Card Last 4', 'Card Holder', 'Payer Email', 'PayPal Order ID', 'PayPal Capture ID',
                'PayPal Status', 'Amount Paid', 'Currency', 'Paid', 'Paid On', 'Comments',
            ],
        };
    }

    /**
     * Turn one record into a report row.
     *
     * @return array<int, mixed>
     */
    public function map(Model $record): array
    {
        return match ($this->type) {
            self::TYPE_DONATIONS => $this->mapDonation($record),
            self::TYPE_HALL_ORDERS => $this->mapHallOrder($record),
            self::TYPE_TEMPLE_TOURS => $this->mapTempleTour($record),
            default => $this->mapPujaOrder($record),
        };
    }

    /**
     * Zero based indexes of the money columns, so the preview can show them
     * with a currency symbol and Excel can keep them as real numbers.
     *
     * @return array<int, int>
     */
    public function amountColumns(): array
    {
        return match ($this->type) {
            self::TYPE_DONATIONS => [6],
            self::TYPE_HALL_ORDERS => [15],
            self::TYPE_TEMPLE_TOURS => [],
            default => [16, 29],
        };
    }

    /**
     * Payment statuses actually present in the data, so the filter never offers
     * a value that cannot match anything.
     *
     * @return array<int, string>
     */
    public function paymentStatusOptions(): array
    {
        if (!$this->supportsPaymentStatus()) {
            return [];
        }

        $column = $this->type === self::TYPE_DONATIONS ? 'paypal_status' : 'payment_status';

        $query = match ($this->type) {
            self::TYPE_DONATIONS => PaymentTransaction::query()->where('transaction_type', PaymentTransaction::TYPE_DONATION),
            self::TYPE_HALL_ORDERS => HallOrder::query(),
            self::TYPE_TEMPLE_ORDERS => PujaOrder::query()->where('puja_location', 'temple'),
            default => PujaOrder::query()->where('puja_location', 'home'),
        };

        return $query->whereNotNull($column)
            ->where($column, '!=', '')
            ->distinct()
            ->orderBy($column)
            ->pluck($column)
            ->all();
    }

    public function fileName(): string
    {
        return Str::slug($this->label()) . '-report-' . date('Y-m-d-His') . '.xlsx';
    }

    /**
     * Sheet name for the export - Excel rejects anything over 31 characters.
     */
    public function sheetTitle(): string
    {
        return substr(str_replace(['(', ')'], '', $this->label()), 0, 31);
    }

    /* ------------------------------------------------------------------ */
    /* Queries                                                             */
    /* ------------------------------------------------------------------ */

    private function donationsQuery(): Builder
    {
        return PaymentTransaction::query()
            ->with('frontendUser')
            ->where('transaction_type', PaymentTransaction::TYPE_DONATION);
    }

    private function hallOrdersQuery(): Builder
    {
        return HallOrder::query()->with([
            'user',
            'hallEventType',
            'hallOrderLists.hall',
            'hallOrderAddonsLists.hallAddon',
            'orderStatuses',
        ]);
    }

    private function pujaOrdersQuery(string $location): Builder
    {
        return PujaOrder::query()
            ->with([
                'user',
                'pujaOrderLists.puja',
                'paymentTransactions',
                'orderStatuses',
            ])
            ->where('puja_location', $location);
    }

    private function templeToursQuery(): Builder
    {
        return TempleTour::query()->with('orderStatuses');
    }

    /* ------------------------------------------------------------------ */
    /* Filters                                                             */
    /* ------------------------------------------------------------------ */

    private function applyDateRange(Builder $query): void
    {
        $table = $query->getModel()->getTable();

        if (!empty($this->filters['from'])) {
            $query->whereDate($table . '.created_at', '>=', $this->filters['from']);
        }

        if (!empty($this->filters['to'])) {
            $query->whereDate($table . '.created_at', '<=', $this->filters['to']);
        }
    }

    private function applySource(Builder $query): void
    {
        if (!$this->supportsSource() || empty($this->filters['source'])) {
            return;
        }

        if (!array_key_exists($this->filters['source'], self::sources())) {
            return;
        }

        // Bookings taken before the source was recorded default to `unknown`,
        // and rows written before the column existed can be null.
        if ($this->filters['source'] === PujaOrder::SOURCE_UNKNOWN) {
            $query->where(function ($query) {
                $query->whereNull('source')
                    ->orWhere('source', '')
                    ->orWhere('source', PujaOrder::SOURCE_UNKNOWN);
            });

            return;
        }

        $query->where('source', $this->filters['source']);
    }

    private function applyPaymentStatus(Builder $query): void
    {
        if (!$this->supportsPaymentStatus() || empty($this->filters['payment_status'])) {
            return;
        }

        $column = $this->type === self::TYPE_DONATIONS ? 'paypal_status' : 'payment_status';

        $query->where($column, $this->filters['payment_status']);
    }

    private function applySearch(Builder $query): void
    {
        $search = trim((string) $this->filters['search']);

        if ($search === '') {
            return;
        }

        $term = '%' . $search . '%';

        match ($this->type) {
            self::TYPE_DONATIONS => $query->where(function ($query) use ($term) {
                $query->where('transaction_id', 'like', $term)
                    ->orWhere('reference_id', 'like', $term)
                    ->orWhere('paypal_payer_email', 'like', $term)
                    ->orWhere('card_holder_name', 'like', $term)
                    ->orWhere('paypal_order_id', 'like', $term)
                    ->orWhere('paypal_capture_id', 'like', $term)
                    ->orWhereHas('frontendUser', fn($user) => $this->searchUser($user, $term));
            }),
            self::TYPE_HALL_ORDERS => $query->where(function ($query) use ($term) {
                $query->where('hall_request_id', 'like', $term)
                    ->orWhereHas('user', fn($user) => $this->searchUser($user, $term));
            }),
            self::TYPE_TEMPLE_TOURS => $query->where(function ($query) use ($term) {
                $query->where('tour_request_id', 'like', $term)
                    ->orWhere('name', 'like', $term)
                    ->orWhere('email', 'like', $term)
                    ->orWhere('mobile', 'like', $term);
            }),
            default => $query->where(function ($query) use ($term) {
                $query->where('puja_request_id', 'like', $term)
                    ->orWhereHas('user', fn($user) => $this->searchUser($user, $term));
            }),
        };
    }

    private function searchUser($query, string $term): void
    {
        $query->where('first_name', 'like', $term)
            ->orWhere('last_name', 'like', $term)
            ->orWhere('email', 'like', $term)
            ->orWhere('mobile', 'like', $term);
    }

    /* ------------------------------------------------------------------ */
    /* Row mapping                                                         */
    /* ------------------------------------------------------------------ */

    private function mapDonation(Model $donation): array
    {
        $user = $donation->frontendUser;

        return [
            $donation->reference,
            formatDateTime($donation->created_at),
            $donation->card_holder_name ?: $this->userName($user),
            $donation->paypal_payer_email ?: ($user->email ?? ''),
            $user->mobile ?? '',
            $donation->reference_id ?: '',
            $this->amount($donation->paypal_amount),
            $donation->paypal_currency ?: '',
            $donation->paypal_status ?: '',
            $donation->paypal_paid ? 'Yes' : 'No',
            $donation->payment_method_label,
            $donation->card_brand ?: '',
            $donation->card_type ?: '',
            $donation->card_last_digits ?: '',
            $donation->card_holder_name ?: '',
            $donation->paypal_payer_email ?: '',
            $donation->paypal_payer_id ?: '',
            $donation->paypal_order_id ?: '',
            $donation->paypal_capture_id ?: '',
            formatDateTime($donation->paypal_create_time),
            formatDateTime($donation->paypal_update_time),
        ];
    }

    private function mapHallOrder(Model $order): array
    {
        $halls = $order->hallOrderLists
            ->map(fn($list) => $list->hall->name ?? '')
            ->filter()
            ->implode(', ');

        $addons = $order->hallOrderAddonsLists
            ->map(fn($list) => $list->hallAddon->name ?? '')
            ->filter()
            ->implode(', ');

        return [
            $order->hall_request_id,
            formatDateTime($order->created_at),
            $this->userName($order->user),
            $order->user->email ?? '',
            $order->user->mobile ?? '',
            $order->hallEventType->name ?? ($order->other_event_type ?: $order->type_of_event),
            $halls,
            $addons,
            formatDate($order->date_of_event),
            formatDate($order->end_date_of_event),
            formatDate($order->alternate_date_of_event),
            formatTime($order->start_time),
            $order->duration ?: '',
            $order->event_duration ?: '',
            $order->number_of_days ?: '',
            $this->amount($order->total_amount),
            $order->payment_status ?: '',
            $order->getLatestStatus(),
            $order->comments ?: '',
            $order->admin_comments ?: '',
        ];
    }

    private function mapPujaOrder(Model $order): array
    {
        $pujas = $order->pujaOrderLists
            ->map(fn($list) => $list->puja->name ?? '')
            ->filter()
            ->implode(', ');

        // The most recent payment recorded against the booking - a booking can
        // hold more than one attempt.
        $payment = $order->paymentTransactions->sortByDesc('id')->first();

        return [
            $order->puja_request_id,
            formatDateTime($order->created_at),
            $order->source_label,
            $this->userName($order->user),
            $order->user->email ?? '',
            $order->user->mobile ?? '',
            $order->user->city ?? '',
            $order->user->state ?? '',
            $order->user->country ?? '',
            ucfirst((string) $order->puja_location),
            $pujas,
            formatDate($order->date_of_puja),
            $order->time_of_puja ?: '',
            formatDate($order->alternate_date_of_puja1),
            $order->alternate_time_of_puja2 ?: '',
            $order->priest_name ?: '',
            $this->amount($order->total_amount),
            $order->payment_status ?: '',
            $order->getLatestStatus(),
            $payment?->reference ?: '',
            $payment?->payment_method_label ?: '',
            $payment?->card_brand ?: '',
            $payment?->card_type ?: '',
            $payment?->card_last_digits ?: '',
            $payment?->card_holder_name ?: '',
            $payment?->paypal_payer_email ?: '',
            $payment?->paypal_order_id ?: '',
            $payment?->paypal_capture_id ?: '',
            $payment?->paypal_status ?: '',
            $payment ? $this->amount($payment->paypal_amount) : null,
            $payment?->paypal_currency ?: '',
            $payment ? ($payment->paypal_paid ? 'Yes' : 'No') : '',
            $payment ? formatDateTime($payment->created_at) : '',
            $order->comments ?: '',
        ];
    }

    private function mapTempleTour(Model $tour): array
    {
        return [
            $tour->tour_request_id,
            formatDateTime($tour->created_at),
            $tour->name,
            $tour->email ?: '',
            $tour->mobile ?: '',
            formatDate($tour->tour_date),
            $tour->tour_time ?: '',
            formatDate($tour->alternate_tour_date),
            $tour->alternate_tour_time ?: '',
            $tour->total_visitors ?: '',
            $tour->age_range_of_group ?: '',
            $tour->last_visit_to_temple ?: '',
            $tour->getLatestStatus(),
            $tour->comment ?: '',
            $tour->admin_comments ?: '',
        ];
    }

    private function userName($user): string
    {
        if (!$user) {
            return '';
        }

        return trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
    }

    /**
     * Money stays a number so Excel can total a column.
     */
    private function amount($value): ?float
    {
        return $value === null ? null : round((float) $value, 2);
    }
}
