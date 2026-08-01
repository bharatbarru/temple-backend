<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ServiceCategoryController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ServiceCategory;
use App\Repositories\ServiceCategoryRepository;

class ServiceCategoriesTable extends DataTableComponent
{
    protected $model = ServiceCategory::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $serviceCategoryRepo = new ServiceCategoryRepository();
        $serviceCategory = new ServiceCategoryController($serviceCategoryRepo);
        $serviceCategory->destroy($id);
    }

    public function resetCounter()
    {
        $this->i = 1;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->resetCounter();
    }

    public function columns(): array
    {
        return [
            Column::make('S.no', 'id')
                ->format(fn ()  => ($this->page - 1) * $this->perPage + $this->i++),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Slug", "slug")
                ->sortable()
                ->searchable(),
            Column::make("Display Name", "display_name")
                ->sortable()
                ->searchable(),
            Column::make('Menu', 'slug', 'serviceCategory')
                ->format(function ($slug, $serviceCategory) {
                    return '<li class="nav-item">
                                <a href="{{ url(\'admin/services?type=' . $serviceCategory->slug . '\') }}"
                                    class="nav-link {{ request()->input("type") == "'. $serviceCategory->slug .'"
                                        ? "active" : "" }}">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>' . $serviceCategory->name . '</p>
                                </a>
                            </li>';
                }),
            Column::make("Actions", 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('serviceCategories.show', $row->id),
                        'editUrl' => route('serviceCategories.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'service-categories'
                    ])
                )
        ];
        }
    }
