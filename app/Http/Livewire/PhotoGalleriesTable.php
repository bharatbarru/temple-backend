<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\PhotoGallery;

class PhotoGalleriesTable extends DataTableComponent
{
    protected $model = PhotoGallery::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        PhotoGallery::find($id)->delete();
        Flash::success('Photo Gallery deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Photo Category Id", "photoCategory.name")
                ->sortable()
                ->searchable(),
            Column::make("Title", "title")
                ->sortable()
                ->searchable(),
            Column::make("Description", "description")
                ->sortable()
                ->searchable(),
            Column::make("Sort", "sort")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('photoGalleries.show', $row->id),
                        'editUrl' => route('photoGalleries.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'photo-galleries'
                    ])
                )
        ];
    }
}
