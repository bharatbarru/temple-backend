<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ApplicationSettings\ApplicationSettingController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use App\Models\ApplicationSetting;
use App\Models\ApplicationSettingCategory;
use App\Models\ApplicationSettingType;
use App\Repositories\ApplicationSettingRepository;

class ApplicationSettingsTable extends DataTableComponent
{
    protected $model = ApplicationSetting::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $applicationSettingRepo = new ApplicationSettingRepository();
        $setting = new ApplicationSettingController($applicationSettingRepo);
        $setting->destroy($id);
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
            Column::make("Field Name", "field_name")
                ->sortable()
                ->searchable(),
            Column::make("Slug", "slug")
                ->sortable()
                ->searchable(),
            Column::make("Input Type", "input_type")
                ->sortable()
                ->searchable(),
            Column::make("Application Setting Type", "application_setting_type_id", "applicationSettings")
                ->format(function ($application_setting_type_id, $applicationSettings) {
                    return $applicationSettings->applicationSettingType->type ?? '';
                }),
            Column::make("Application Setting Category", "application_setting_category_id", "applicationSettings")
                ->format(function ($application_setting_category_id, $applicationSettings) {
                    return $applicationSettings->applicationSettingCategory->name ?? '';
                }),
            Column::make("Actions", 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('applicationSettings.show', $row->id),
                        'editUrl' => route('applicationSettings.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'application-settings'
                    ])
                )
        ];
    }

    public function filters(): array
    {
        $types = ApplicationSettingType::all()->pluck('type', 'id');
        $categories = ApplicationSettingCategory::all()->pluck('name', 'id');
        return [
            SelectFilter::make('Type')
                ->options(['' => 'Select Type', $types])
                ->filter(function (Builder $builder, $value) {
                    $builder->where('application_setting_type_id', $value);
                }),
            SelectFilter::make('Category')
                ->options(['' => 'Select Category', $categories])
                ->filter(function (Builder $builder, $value) {
                    $builder->where('application_setting_category_id', $value);
                }),
        ];
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            $applicationSettings = ApplicationSetting::find((int)$item['value']);
            $applicationSettings->sort = $item['order'];
            $applicationSettings->save();
        }
    }

    public function builder(): Builder
    {
        return ApplicationSetting::query();
    }
}
