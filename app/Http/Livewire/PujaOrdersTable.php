<?php

namespace App\Http\Livewire;

use App\Http\Controllers\PujaOrderController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\PujaOrder;
use App\Models\PujaOrderList;
use App\Repositories\PujaOrderRepository;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;


class PujaOrdersTable extends DataTableComponent
{
    protected $model = PujaOrder::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $pujaOrderRepo = new PujaOrderRepository();
        $pujaOrder = new PujaOrderController($pujaOrderRepo);
        $pujaOrder->destroy($id);
    }

    public function getPaymentStatusValue($row): string
    {
        return $row && $row->paymentTransactions()->exists() ? 'Paid' : '';
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

    public function builder(): Builder
    {
        return PujaOrder::query()->orderBy('created_at', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make('S.no', 'id')
                ->format(fn()  => ($this->page - 1) * $this->perPage + $this->i++),
            Column::make('Puja Request Id', 'puja_request_id')
                ->format(fn($value, $row) => '<a href="'.route('pujaOrders.show', $row).'">'.$value.'</a>')
                ->html()
                ->sortable()
                ->searchable(),
            Column::make("Date Of Request", "created_at")
                ->format(fn($value) => formatDateTime($value))
                ->sortable()
                ->searchable(),
            Column::make("Date / Time of Puja", "id")
                ->format(function($value){
                    $pujaOrder = PujaOrder::find($value);
                    return formatDateTime($pujaOrder->date_of_puja) . '<br>' .$pujaOrder->time_of_puja;
                })
                ->html(),
            Column::make("Puja Name", "id")
                ->format(function($value){
                    $pujaOrderLists = PujaOrderList::where('puja_order_id', $value)->get();
                    $pujaNames = [];
                    foreach ($pujaOrderLists as $pujaOrderList) {
                        $pujaNames[] = $pujaOrderList->puja->name;
                    }
                    return implode(', ', $pujaNames);
                }),
            Column::make("Puja location", "puja_location")
                ->format(function($value){
                    return $value == 'temple' ? 'Temple' : 'Home';
                }),
            Column::make("Who/Devotee", "id")
                ->format(function($value){
                    $pujaOrder = PujaOrder::find($value);
                    return $pujaOrder->user->first_name . ' ' . $pujaOrder->user->last_name;
                }),
            Column::make("Email / Phone", "id")
                ->format(function($value){
                    $pujaOrder = PujaOrder::find($value);
                    return $pujaOrder->user->email . '<br>' . $pujaOrder->user->mobile;
                })
                ->html(),
            Column::make("Payment Status", "payment_status")
                ->format(function ($value, $row) {
                    return $this->getPaymentStatusValue($row);
                })
                ->sortable()
                ->searchable(),
            Column::make("Request Status", "id")
                ->format(function($id){
                    $hallOrder = PujaOrder::find($id);
                    return $hallOrder->getLatestStatus();
                }),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('pujaOrders.show', $row->id),
                        'editUrl' => null,
                        'recordId' => $row->id,
                        'permissionName' => 'puja-orders'
                    ])
                )
        ];
    }
    public function filters(): array
    {
        return [
            DateFilter::make('From Date')
                ->filter(function (Builder $builder, $value) {
                    $builder->where('date_of_puja', '>=', $value);
                }),
            DateFilter::make('To Date')
                ->filter(function (Builder $builder, $value) {
                    $builder->where('date_of_puja', '<=', $value);
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
                                               ->where('puja_order_id', \DB::raw('puja_orders.id'))
                                               ->groupBy('puja_order_id');
                                  });
                        });
                    }
                }),
        ];
    }
}
