<?php

namespace App\Http\Livewire;

use App\Http\Controllers\PhotoGalleryCategoryController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\PhotoGalleryCategory;
use App\Repositories\PhotoGalleryCategoryRepository;

class PhotoGalleryCategoriesTable extends DataTableComponent
{
    protected $model = PhotoGalleryCategory::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $photoGalleryCategoryRepo = new PhotoGalleryCategoryRepository();
        $photoGalleryCategory = new PhotoGalleryCategoryController($photoGalleryCategoryRepo);
        $photoGalleryCategory->destroy($id);
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
            Column::make("Display Name", "display_name")
                ->sortable()
                ->searchable(),
            Column::make("Icon", "icon")
                ->sortable()
                ->searchable(),
            // Column::make("Image", "image")
            //     ->format(function ($image) {
            //         $img = PHOTO_GALLERY_IMAGE_PATH . $image;
            //         echo $image != '' ? '<img src="' . asset($img) . '" width="50">' : '';
            //     }),
            // Column::make("Image Alt Text", "image_alt_text")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Button Name", "button_name")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Button Url", "button_url")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("New Window", "new_window")
            //     ->sortable()
            //     ->searchable(),
            Column::make("Type", "type")
                ->sortable()
                ->searchable(),
            Column::make("Sort", "sort")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('photoGalleryCategories.show', $row->id),
                        'editUrl' => route('photoGalleryCategories.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'photo-gallery-categories'
                    ])
                )
        ];
    }
}
