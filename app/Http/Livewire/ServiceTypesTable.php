<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ServiceType;

class ServiceTypesTable extends DataTableComponent
{
    protected $model = ServiceType::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];
        public function deleteRecord($id)
    {
        ServiceType::find($id)->delete();
        Flash::success('Service Type deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Slug", "slug")
                ->sortable()
                ->searchable(),
            Column::make("Display Name", "display_name")
                ->sortable()
                ->searchable(),
            Column::make("Image", "image")
                ->sortable()
                ->searchable(),
            Column::make("Image Alt Text", "image_alt_text")
                ->sortable()
                ->searchable(),
            Column::make("Icon", "icon")
                ->sortable()
                ->searchable(),
            Column::make("Description", "description")
                ->sortable()
                ->searchable(),
            Column::make("Tagline", "tagline")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('serviceTypes.show', $row->id),
                        'editUrl' => route('serviceTypes.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'service-types'
                    ])
                )
        ];
    }
}