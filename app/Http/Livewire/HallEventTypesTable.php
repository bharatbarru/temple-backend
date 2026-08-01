<?php

namespace App\Http\Livewire;

use App\Http\Controllers\HallEventTypeController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\HallEventType;
use App\Repositories\HallEventTypeRepository;

class HallEventTypesTable extends DataTableComponent
{
    protected $model = HallEventType::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $hallEventTypeRepo = new HallEventTypeRepository();
        $hallEventType = new HallEventTypeController($hallEventTypeRepo);
        $hallEventType->destroy($id);
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
            Column::make("Publish", "publish")
                ->format(function ($publish, $hallEventType) {
                    return view('common.livewire-tables.publish', ['publish' => $publish, 'id' => $hallEventType->id]);
                }),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('hallEventTypes.show', $row->id),
                        'editUrl' => route('hallEventTypes.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'hall-event-types'
                    ])
                )
        ];
    }

    public function togglePublish($id)
    {
        $hallEventType = HallEventType::find($id);
        $hallEventType->publish = !$hallEventType->publish;
        $hallEventType->save();
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            $hallEventType = HallEventType::find((int)$item['value']);
            $hallEventType->sort = $item['order'];
            $hallEventType->save();
        }
    }
}
