<?php

namespace App\Http\Livewire;

use App\Http\Controllers\TempleTourController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\TempleTour;
use App\Repositories\TempleTourRepository;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class TempleToursTable extends DataTableComponent
{
    protected $model = TempleTour::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $templeTourRepo = new TempleTourRepository();
        $templeTour = new TempleTourController($templeTourRepo);
        $templeTour->destroy($id);
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

    public function columns(): array
    {
        return [
            Column::make('S.no', 'id')
                ->format(fn()  => ($this->page - 1) * $this->perPage + $this->i++),
            Column::make("Request Id", "tour_request_id")
                ->format(function($value, $row){
                    return "<a href=". route('templeTours.show', $row->id) . ">" . $value . "</a>";
                })
                ->html()
                ->sortable()
                ->searchable(),
            Column::make("Date of Request", "created_at")
                ->format(fn($value) => formatDate($value))
                ->sortable()
                ->searchable(),
            Column::make("Date / Time of Tour", "id")
                ->format(function($id){
                    $templeTour = TempleTour::find($id);
                    return formatDate($templeTour->tour_date) . '<br>' . formatTime($templeTour->tour_time);
                })
                ->html(),
            Column::make("Requestor/Group Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Email / Mobile", "id")
                ->format(function($id){
                    $templeTour = TempleTour::find($id);
                    return $templeTour->email . '<br>' . $templeTour->mobile;
                })
                ->html(),
            Column::make("Alternate Date/ Time", "id")
                ->format(function($id){
                    $templeTour = TempleTour::find($id);
                    return formatDate($templeTour->alternate_tour_date) . '<br>' . formatTime($templeTour->alternate_tour_time);
                })
                ->html(),
            Column::make("Request Status", "id")
                ->format(function($id){
                    $templeTour = TempleTour::find($id);
                    return $templeTour->getLatestStatus();
                })
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('templeTours.show', $row->id),
                        // 'editUrl' => route('templeTours.edit', $row->id),
                        'editUrl' => null,
                        'recordId' => $row->id,
                        'permissionName' => 'temple-tours'
                    ])
                )
        ];
    }
    public function filters(): array
    {
        return [
            DateFilter::make('From Date')
                ->filter(function (Builder $builder, $value) {
                    $builder->where('tour_date', '>=', $value);
                }),
            DateFilter::make('To Date')
                ->filter(function (Builder $builder, $value) {
                    $builder->where('tour_date', '<=', $value);
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
                                            ->where('temple_tour_order_id', \DB::raw('temple_tours.id'))
                                            ->groupBy('temple_tour_order_id');
                                });
                        });
                    }
                }),
        ];
    }

    public function builder(): Builder
    {
        return TempleTour::orderBy('created_at', 'desc');
    }
}
