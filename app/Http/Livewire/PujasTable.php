<?php

namespace App\Http\Livewire;

use App\Http\Controllers\PujaController;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Puja;
use App\Repositories\PujaRepository;

class PujasTable extends DataTableComponent
{
    protected $model = Puja::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $pujaRepo = new PujaRepository();
        $puja = new PujaController($pujaRepo);
        $puja->destroy($id);
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
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Home Amount", "home_amount")
                ->format(fn($value) => formatAmount($value))
                ->sortable()
                ->searchable(),
            Column::make("Temple Amount", "temple_amount")
                ->format(fn($value) => formatAmount($value))
                ->sortable()
                ->searchable(),
            Column::make("Publish", "publish")
                ->format(function ($publish, $puja) {
                    return view('common.livewire-tables.publish', ['publish' => $publish, 'id' => $puja->id]);
                }),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('pujas.show', $row->id),
                        'editUrl' => route('pujas.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'pujas'
                    ])
                )
        ];
    }

    public function togglePublish($id)
    {
        $puja = Puja::find($id);
        $puja->publish = !$puja->publish;
        $puja->save();
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            $puja = Puja::find((int)$item['value']);
            $puja->sort = $item['order'];
            $puja->save();
        }
    }
}
