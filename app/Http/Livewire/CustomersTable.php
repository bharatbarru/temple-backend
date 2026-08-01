<?php

namespace App\Http\Livewire;

use App\Http\Controllers\CustomerController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Customer;
use App\Repositories\CustomerRepository;

class CustomersTable extends DataTableComponent
{
    protected $model = Customer::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $paymentmethodrepo = new CustomerRepository();
        $customer = new CustomerController($paymentmethodrepo);
        $customer->destroy($id);
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
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            Column::make("Mobile", "mobile")
                ->sortable()
                ->searchable(),
            Column::make("Publish", "publish")
                ->format(function ($publish, $customer) {
                    return view('common.livewire-tables.publish', ['publish' => $publish, 'id' => $customer->id]);
                }),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('customers.show', $row->id),
                        'editUrl' => route('customers.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'customers'
                    ])
                )
        ];
    }

    public function togglePublish($id)
    {
        $customer = Customer::find($id);
        $customer->publish = !$customer->publish;
        $customer->save();
    }
}
