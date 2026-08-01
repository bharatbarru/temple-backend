<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ClienteleCategoryController;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ClienteleCategory;
use App\Repositories\ClienteleCategoryRepository;

class ClienteleCategoriesTable extends DataTableComponent
{
    protected $model = ClienteleCategory::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $clienteleCategoryRepo = new ClienteleCategoryRepository();
        $clienteleCategory = new ClienteleCategoryController($clienteleCategoryRepo);
        $clienteleCategory->destroy($id);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->resetCounter();
    }

    public function resetCounter()
    {
        $this->i = 1;
    }

    public function columns(): array
    {
        return [
            Column::make('S.no', 'id')
                ->format(fn ()  => ($this->page - 1) * $this->perPage + $this->i++),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Display Name", "display_name")
                ->sortable()
                ->searchable(),
            Column::make("Slug", "type")
                ->sortable()
                ->searchable(),
            Column::make('Menu', 'type', 'clientCategory')
                ->format(function ($type, $clientCategory) {
                    return '<li class="nav-item">
                                <a href="{{ url(\'admin/clienteles?type=' . $type . '\') }}"
                                    class="nav-link {{ request()->input("type") == "'. $type .'"
                                        ? "active" : "" }}">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>' . $clientCategory->name . '</p>
                                </a>
                            </li>';
                }),
            Column::make("Actions", 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('clienteleCategories.show', $row->id),
                        'editUrl' => route('clienteleCategories.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'clientele_categories'
                    ])
                )
        ];
    }
}
