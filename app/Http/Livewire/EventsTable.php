<?php

namespace App\Http\Livewire;

use App\Http\Controllers\EventController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Event;
use App\Repositories\EventRepository;
use Illuminate\Database\Eloquent\Builder;

class EventsTable extends DataTableComponent
{
    protected $model = Event::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $eventRepo = new EventRepository();
        $event = new EventController($eventRepo);
        $event->destroy($id);
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
            Column::make("Event Category", "eventCategory.name")
                ->sortable()
                ->searchable(),
            Column::make("Title", "title")
                ->sortable()
                ->searchable(),
            Column::make("Slug", "slug")
                ->sortable()
                ->searchable(),
            Column::make('Image')
                ->format(function ($image) {
                    $img = EVENT_IMAGE_PATH . $image;
                    return $image != '' ? '<img src="' . asset($img) . '" width="50">' : '';
                })
                ->html(),
            Column::make("Start Date Time", "start_date_time")
                ->format(fn($value) => formatDateTime($value))
                ->sortable()
                ->searchable(),
            Column::make("End Date Time", "end_date_time")
            ->format(fn($value) => formatDateTime($value))
                ->sortable()
                ->searchable(),
            Column::make("Publish", "publish")
                ->format(function ($publish, $event) {
                    return view('common.livewire-tables.publish', ['publish' => $publish, 'id' => $event->id]);
                }),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('events.show', $row->id),
                        'editUrl' => route('events.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'events'
                    ])
                )
        ];
    }

    public function togglePublish($id)
    {
        $event = Event::find($id);
        $event->publish = !$event->publish;
        $event->save();
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            $event = Event::find((int)$item['value']);
            $event->sort = $item['order'];
            $event->save();
        }
    }

    public function builder(): Builder
    {
        return Event::orderBy('events.created_at', 'desc');
    }
}
