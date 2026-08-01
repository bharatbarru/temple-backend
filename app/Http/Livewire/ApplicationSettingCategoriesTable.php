<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ApplicationSettings\ApplicationSettingCategoryController;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ApplicationSettingCategory;
use App\Repositories\ApplicationSettingCategoryRepository;
use Illuminate\Console\Application;

class ApplicationSettingCategoriesTable extends DataTableComponent
{
    protected $model = ApplicationSettingCategory::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $applicationSettingCategoryRepo = new ApplicationSettingCategoryRepository();
        $category = new ApplicationSettingCategoryController($applicationSettingCategoryRepo);
        $category->destroy($id);
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
            Column::make("Actions", 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => null,
                        'editUrl' => route('applicationSettingCategories.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'application-setting-categories'
                    ])
                )
        ];
    }
}
