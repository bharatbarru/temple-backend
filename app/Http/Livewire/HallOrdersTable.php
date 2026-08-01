<?php

namespace App\Http\Livewire;

use App\Http\Controllers\HallOrderController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\HallOrder;
use App\Repositories\HallOrderRepository;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class HallOrdersTable extends DataTableComponent
{
    protected $model = HallOrder::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $hallOrderRepo = new HallOrderRepository();
        $hallOrder = new HallOrderController($hallOrderRepo);
        $hallOrder->destroy($id);
    }

    public function resetCounter()
    {
        $this->i = 1;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setSingleSortingDisabled()
            ->setHideReorderColumnUnlessReorderingEnabled()
            ->resetCounter();

        $this->setTrAttributes(
                function($row) {
                    $className = getClassNameFromStatus($row->getLatestStatus());
                    return [
                        'class' => $className,
                    ];
                }
            );
    }

    public function rowClasses($row): ?string
{
    $hallOrder = HallOrder::find($row->id);

    if (!$hallOrder) {
        return null;
    }

    return match ($hallOrder->getLatestStatus()) {
        'NEW REQUEST' => 'table-warning',      // Yellow background
        'RESCHEDULE_REQUEST' => 'table-success',  // Green background
        'CANCEL_REQUEST' => 'table-danger',    // Red background
        default => '',
    };
}


    public function columns(): array
    {
        return [
            Column::make('S.no', 'id')
                ->format(fn()  => ($this->page - 1) * $this->perPage + $this->i++),
            Column::make('Hall Request Id', 'hall_request_id')
                ->format(fn($value, $row) => '<a href="'.route('hallOrders.show', $row).'">'.$value.'</a>')
                ->html()
                ->sortable()
                ->searchable(),
            Column::make("Halls", "id")
                ->format(function($id) {
                    $hallOrder = HallOrder::find($id);
                    
                    // Check if hallOrder and hallOrderLists exist
                    if ($hallOrder && $hallOrder->hallOrderLists) {
                        return $hallOrder->hallOrderLists->map(function($hallOrderList) {
                            return optional($hallOrderList->hall)->name; // Assuming `hall` is the relation in HallOrderList
                        })->implode(', ');
                    }
            
                    return ''; // Return empty string if no halls are found
                }),
            
            Column::make("Date of Request", "created_at")
                ->format(fn($value) => formatDate($value))
                ->sortable()
                ->searchable(),
            Column::make("Date / Time of Event", "id")
                ->format(function($id) {
                    $hallOrder = HallOrder::find($id);
                    
                    return formatDate($hallOrder->date_of_event) . '<br>' . formatTime($hallOrder->start_time);
                })
                ->html(),
            Column::make("Individual / Community Name", "id")
                ->format(function($id) {
                    $hallOrder = HallOrder::find($id);
                    
                    return $hallOrder->type_of_event == 'community' ?  $hallOrder->user->first_name . '/ ' . $hallOrder->user->community_name : $hallOrder->user->first_name . ' ' . $hallOrder->user->last_name;
                }),
            Column::make("Email / Mobile", "id")
                ->format(function($id) {
                    $hallOrder = HallOrder::find($id);
                    
                    return $hallOrder->user->email . '<br>' . $hallOrder->user->mobile;
                })
                ->html(),
            Column::make("Request Status", "id")
                ->format(function($id){
                    $hallOrder = HallOrder::find($id);
                    return $hallOrder->getLatestStatus();
                })
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('hallOrders.show', $row->id),
                        'editUrl' => null,
                        'recordId' => $row->id,
                        'permissionName' => 'hall-orders'
                    ])
                )
        ];
    }
    public function filters(): array
    {
        return [
            DateFilter::make('From Date')
                ->filter(function (Builder $builder, $value) {
                    $builder->where('date_of_event', '>=', $value);
                }),
            DateFilter::make('To Date')
                ->filter(function (Builder $builder, $value) {
                    $builder->where('date_of_event', '<=', $value);
                }),
                SelectFilter::make('Status')
                ->options([
                    '' => 'All',
                    'NEW REQUEST' => 'NEW REQUEST',
                    'RESCHEDULE REQUEST' => 'RESCHEDULE REQUEST',
                    'CANCEL REQUEST' => 'CANCEL REQUEST',
                ])
                ->filter(function (Builder $builder, $value) {
                    if (!empty($value)) {
                        $builder->whereHas('orderStatuses', function ($query) use ($value) {
                            $query->where('status', $value)
                                  ->whereIn('id', function ($subquery) {
                                      $subquery->selectRaw('MAX(id)')
                                               ->from('order_status')
                                               ->where('hall_order_id', \DB::raw('hall_orders.id'))
                                               ->groupBy('hall_order_id');
                                  });
                        });
                    }
                }),
        ];
    }
    public function builder(): Builder
    {
        return HallOrder::orderBy('created_at', 'desc');
    }
}
