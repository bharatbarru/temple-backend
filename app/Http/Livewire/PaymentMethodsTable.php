<?php

namespace App\Http\Livewire;

use App\Http\Controllers\PaymentMethodController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Builder;
use App\Repositories\PaymentMethodRepository;

class PaymentMethodsTable extends DataTableComponent
{
    protected $model = PaymentMethod::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $paymentmethodrepo = new PaymentMethodRepository();
        $paymentMethod = new PaymentMethodController($paymentmethodrepo);
        $paymentMethod->destroy($id);
    }

    public function resetCounter()
    {
        $this->i = 1;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setReorderEnabled()
            ->setSingleSortingDisabled()
            ->setHideReorderColumnUnlessReorderingEnabled()
            ->resetCounter();
    }

    public function columns(): array
    {
        return [
            Column::make('Order', 'sort')
                ->sortable()
                ->collapseOnMobile()
                ->excludeFromColumnSelect(),
            Column::make('S.no', 'id')
                ->format(fn()  => ($this->page - 1) * $this->perPage + $this->i++),
            Column::make("Payment Method Name", "payment_method_name")
                ->sortable()
                ->searchable(),
            Column::make("Display Name", "display_name")
                ->sortable()
                ->searchable(),
            Column::make("Publish", "publish")
                ->format(function ($publish, $paymentMethod) {
                    return view('common.livewire-tables.publish', ['publish' => $publish, 'id' => $paymentMethod->id]);
                }),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('paymentMethods.show', $row->id),
                        'editUrl' => route('paymentMethods.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'payment-methods'
                    ])
                )
        ];
    }

    public function togglePublish($id)
    {
        $paymentMethod = PaymentMethod::find($id);
        $paymentMethod->publish = !$paymentMethod->publish;
        $paymentMethod->save();
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            $paymentMethod = PaymentMethod::find((int)$item['value']);
            $paymentMethod->sort = $item['order'];
            $paymentMethod->save();
        }
    }

    public function builder(): Builder
    {
        return PaymentMethod::query();
    }
}
