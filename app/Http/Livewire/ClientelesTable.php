<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ClienteleController;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use App\Models\Clientele;
use App\Models\ClienteleCategory;
use App\Repositories\ClienteleRepository;

use function PHPUnit\Framework\returnSelf;

class ClientelesTable extends DataTableComponent
{
    protected $model = Clientele::class;
    public $i = 1;
    public $type;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $clienteleRepo = new ClienteleRepository();
        $clientele = new ClienteleController($clienteleRepo);
        $clientele->destroy($id);
    }

    public function mount($type)
    {
        $this->type = $type;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setReorderEnabled()
            ->setSingleSortingDisabled()
            ->setHideReorderColumnUnlessReorderingEnabled();
        $this->resetCounter();
    }

    public function resetCounter()
    {
        $this->i = 1;
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
            Column::make("Clientele Category", "clientele_category_id")
                ->format(function ($clientele_category_id, $clientele) {
                    return $clientele->clienteleCategory->name ?? '';
                }),
            Column::make("Image", "image")
                ->format(function ($image) {
                    $img = CLIENTELE_IMAGE_PATH . $image;
                    echo $image != '' ? '<img src="' . asset($img) . '" width="50">' : '';
                }),

            Column::make("Title", "title")
                ->sortable()
                ->searchable(),

            Column::make("Publish", "publish", "clientele")
                ->format(function ($publish, $clientele) {
                    return view('common.livewire-tables.publish', ['publish' => $publish, 'id' => $clientele->id]);
                }),
            Column::make("Sort", "sort")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('clienteles.show', $row->id) . '?type=' . $this->type,
                        'editUrl' => route('clienteles.edit', $row->id) . '?type=' . $this->type,
                        'recordId' => $row->id,
                        'permissionName' => 'clienteles'
                    ])
                )
        ];
    }
    public function togglePublish($id)
    {
        $clientele = Clientele::find($id);
        $clientele->publish = !$clientele->publish;
        $clientele->save();
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            $clientele = Clientele::find((int)$item['value']);
            $clientele->sort = $item['order'];
            $clientele->save();
        }
    }

    public function builder(): Builder
    {
        $categoryId = ClienteleCategory::where('type', $this->type)->first()->id;
        return Clientele::query()->where('clientele_category_id', $categoryId);
    }

    public function filters(): array
    {

        $categories = ClienteleCategory::all()->pluck('name', 'id');
        return [
            SelectFilter::make('Clientele Category')
                ->options(['' => 'Select Category', $categories])
                ->filter(function (Builder $builder, $value) {
                    $builder->where('clientele_category_id', $value);
                }),
        ];
    }
}
