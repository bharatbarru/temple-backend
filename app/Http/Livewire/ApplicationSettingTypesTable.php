<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ApplicationSettings\ApplicationSettingTypeController;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ApplicationSettingType;
use App\Repositories\ApplicationSettingTypeRepository;

class ApplicationSettingTypesTable extends DataTableComponent
{
    protected $model = ApplicationSettingType::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $applicationSettingTypeRepo = new ApplicationSettingTypeRepository();
        $type = new ApplicationSettingTypeController($applicationSettingTypeRepo);
        $type->destroy($id);
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
            Column::make("Type", "type")
                ->sortable()
                ->searchable(),
            Column::make("Slug", "slug")
                ->sortable()
                ->searchable(),
            Column::make('Menu', 'slug', 'type')
                ->format(function ($slug, $type) {
                    return '<li class="nav-item">
                                <a href="{{ url(\'admin/settings?type=' . $slug . '\') }}" class="nav-link {{ request()->input("type") == "'. $slug .'" ? "active" : "" }}">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>' . $type->type . '</p>
                                </a>
                            </li>';
                }),
            Column::make("Actions", 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => null,
                        'editUrl' => route('applicationSettingTypes.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'application-setting-types'
                    ])
                )
        ];
    }
}
