<?php

namespace App\Http\Livewire;

use App\Http\Controllers\CouponController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Coupon;
use App\Repositories\CouponRepository;

class CouponsTable extends DataTableComponent
{
    protected $model = Coupon::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $paymentmethodrepo = new CouponRepository();
        $coupon = new CouponController($paymentmethodrepo);
        $coupon->destroy($id);
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
            Column::make("Coupon Code", "coupon_code")
                ->sortable()
                ->searchable(),
            Column::make("Image", "image")
                ->sortable()
                ->searchable(),
            Column::make("Discount Type", "discount_type")
                ->sortable()
                ->searchable(),
            Column::make("Amount/Percentage", "id")
                ->format(function ($id) {
                    $coupon = Coupon::find($id);
                    return $coupon->getFormattedDiscountValue();
                })
                ->html()
                ->sortable()
                ->searchable(),
            Column::make("Min Order Amount", "min_order_amount")
                ->sortable()
                ->searchable(),
            Column::make("Valid From", "valid_from")
                ->format(fn($value) => formatDate($value))
                ->sortable()
                ->searchable(),
            Column::make("Valid Until", "valid_until")
                ->format(fn($value) => formatDate($value))
                ->sortable()
                ->searchable(),
            Column::make("Usage Limit", "usage_limit")
                ->sortable()
                ->searchable(),
            Column::make("Publish", "publish")
                ->format(function ($publish, $coupon) {
                    return view('common.livewire-tables.publish', ['publish' => $publish, 'id' => $coupon->id]);
                }),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('coupons.show', $row->id),
                        'editUrl' => route('coupons.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'coupons'
                    ])
                )
        ];
    }

    public function togglePublish($id)
    {
        $coupon = Coupon::find($id);
        $coupon->publish = !$coupon->publish;
        $coupon->save();
    }
}
