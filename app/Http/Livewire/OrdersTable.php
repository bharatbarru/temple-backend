<?php

namespace App\Http\Livewire;

use App\Http\Controllers\OrderController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Database\Eloquent\Builder;

class OrdersTable extends DataTableComponent
{
    protected $model = Order::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $paymentmethodrepo = new OrderRepository();
        $order = new OrderController($paymentmethodrepo);
        $order->destroy($id);
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
    }

    public function columns(): array
    {
        return [
            Column::make('S.no', 'id')
                ->format(fn()  => ($this->page - 1) * $this->perPage + $this->i++),
            Column::make("Order ID", "orderid")
                ->sortable()
                ->searchable(),
            Column::make("Name", "id")
                ->format(function ($id) {
                    $order = Order::find($id);
                    return $order->customer ? $order->customer->name : $order->guest_name;
                })
                ->sortable()
                ->searchable(),
            Column::make("Mobile", "id")
                ->format(function ($id) {
                    $order = Order::find($id);
                    return $order->customer ? $order->customer->mobile : $order->guest_phone;
                })
                ->sortable()
                ->searchable(),
            Column::make("Address", "delivery_address")
                ->sortable()
                ->searchable(),
            Column::make("Order Type", "order_type")
                ->sortable()
                ->searchable(),
            Column::make("Total Amount", "total_amount")
                ->format(fn($value) => formatAmount($value))
                ->sortable()
                ->searchable(),
            Column::make("Payment Method", "paymentMethod.display_name")
                ->sortable()
                ->searchable(),
            Column::make("Transaction ID", "transaction_id")
                ->sortable()
                ->searchable(),
            Column::make("Payment Status", "payment_status")
                ->format(function ($value, $order) {
                    return view('common.livewire-tables.payment-status', ['id' => $order->id, 'value' => $value]);
                })
                ->sortable()
                ->searchable(),
            Column::make("Order Status", "order_status")
                ->format(function ($status, $row) {
                    if ($status == 'pending') {
                        return '<a href="' . url('admin/accept-order/' . $row->id) . '" class="btn-sm btn-info">
                                    Accept
                                </a><a href="' . url('admin/decline-order/' . $row->id) . '" class="btn-sm btn-danger ajax-popup-link">
                                    Decline
                                </a>';
                    } elseif ($status == 'accepted') {
                        return '<a href="' . url('admin/complete-order/' . $row->id) . '" class="btn-sm btn-warning">
                            Complete
                        </a>';
                    } else {
                        return $status;
                    }
                })
                ->html(),
            Column::make("Created At", "created_at")
                ->format(fn($value) => formatDateTime($value))
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('orders.show', $row->id),
                        'editUrl' => null,
                        'recordId' => $row->id,
                        'permissionName' => 'orders'
                    ])
                )
        ];
    }

    public function updatePaymentStatus($id, $value)
    {
        $order = Order::find($id);

        $order->payment_status = $value;
        $order->save();
    }

    public function builder(): Builder
    {
        return Order::orderBy('created_at', 'desc');
    }
}
