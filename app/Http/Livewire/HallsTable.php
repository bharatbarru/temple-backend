<?php

namespace App\Http\Livewire;

use App\Http\Controllers\HallController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Hall;
use App\Repositories\HallRepository;

class HallsTable extends DataTableComponent
{
    protected $model = Hall::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $hallRepo = new HallRepository();
        $hall = new HallController($hallRepo);
        $hall->destroy($id);
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
        $columns = [
            Column::make('Order', 'sort')
                ->sortable()
                ->collapseOnMobile()
                ->excludeFromColumnSelect(),
            Column::make('S.no', 'id')
                ->format(fn()  => ($this->page - 1) * $this->perPage + $this->i++),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Image", "image")
                ->format(function ($image) {
                    $img = HALL_IMAGE_PATH . $image;
                    return $image != '' ? '<img src="' . asset($img) . '" width="50">' : '';
                })
                ->html(),
        ];

        // Days of the week for cost columns
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        foreach ($days as $day) {
            $columns[] = Column::make(ucfirst($day) . " Cost", "id")
                ->format(function ($id) use ($day) {
                    $hall = Hall::find($id);

                    $oneDayCost = $hall->{$day . '_cost'} > 0 ? formatAmount($hall->{$day . '_cost'}) : '-';
                    $threeDayCost = $hall->{$day . '_three_day_cost'} > 0 ? formatAmount($hall->{$day . '_three_day_cost'}) : '-';

                    return "1-Day Cost: " . $oneDayCost . "<br> Multiple-Day Cost (Per Day): " . $threeDayCost;
                })
                ->sortable()
                ->searchable()
                ->html();
        }

        $columns[] = Column::make("Publish", "publish")
            ->format(function ($publish, $hall) {
                return view('common.livewire-tables.publish', ['publish' => $publish, 'id' => $hall->id]);
            });

        $columns[] = Column::make("Actions", 'id')
            ->format(
                fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                    'showUrl' => route('halls.show', $row->id),
                    'editUrl' => route('halls.edit', $row->id),
                    'recordId' => $row->id,
                    'permissionName' => 'halls'
                ])
            );

        return $columns;
    }

    public function togglePublish($id)
    {
        $hall = Hall::find($id);
        $hall->publish = !$hall->publish;
        $hall->save();
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            $hall = Hall::find((int)$item['value']);
            $hall->sort = $item['order'];
            $hall->save();
        }
    }
}
