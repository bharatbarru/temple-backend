<?php

namespace App\Http\Livewire;

use App\Http\Controllers\StatisticsController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Statistics;
use App\Repositories\StatisticsRepository;

class StatisticsTable extends DataTableComponent
{
    protected $model = Statistics::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $statisticrepo = new StatisticsRepository();
        $statistic = new StatisticsController($statisticrepo);
        $statistic->destroy($id);
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
                ->format(fn ()  => ($this->page - 1) * $this->perPage + $this->i++),
            Column::make("Title", "title")
                ->sortable()
                ->searchable(),
            Column::make("Number", "number")
                ->sortable()
                ->searchable(),
            Column::make("Prefix", "prefix")
                ->sortable()
                ->searchable(),
            Column::make("Suffix", "suffix")
                ->sortable()
                ->searchable(),
            Column::make("Url", "url")
                ->sortable()
                ->searchable(),
            Column::make("New Window", "new_window")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('statistics.show', $row->id),
                        'editUrl' => route('statistics.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'testimonials'
                    ])
                )
        ];
    }


    public function reorder($items): void
    {
        foreach ($items as $item) {
            $statistic = Statistics::find((int)$item['value']);
            $statistic->sort = $item['order'];
            $statistic->save();
        }
    }

    public function builder(): Builder
    {
        return Statistics::query();
    }
}