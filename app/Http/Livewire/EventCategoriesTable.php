<?php

namespace App\Http\Livewire;

use App\Http\Controllers\EventCategoryController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\EventCategory;
use App\Repositories\EventCategoryRepository;

class EventCategoriesTable extends DataTableComponent
{
    protected $model = EventCategory::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $eventCategoryRepo = new EventCategoryRepository();
        $eventCategory = new EventCategoryController($eventCategoryRepo);
        $eventCategory->destroy($id);
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
            Column::make("Slug", "slug")
                ->sortable()
                ->searchable(),
            Column::make("Display Name", "display_name")
                ->sortable()
                ->searchable(),
            Column::make("Publish", "publish")
                ->format(function ($publish, $eventCategory) {
                    return view('common.livewire-tables.publish', ['publish' => $publish, 'id' => $eventCategory->id]);
                }),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('eventCategories.show', $row->id),
                        'editUrl' => route('eventCategories.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'event-categories'
                    ])
                )
        ];
    }

    public function togglePublish($id)
    {
        $eventCategory = EventCategory::find($id);
        $eventCategory->publish = !$eventCategory->publish;
        $eventCategory->save();
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            $eventCategory = EventCategory::find((int)$item['value']);
            $eventCategory->sort = $item['order'];
            $eventCategory->save();
        }
    }
}
