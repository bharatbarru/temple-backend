<?php

namespace App\Http\Livewire;

use App\Http\Controllers\BlogCategoryController;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use App\Repositories\BlogCategoryRepository;
use App\Models\BlogCategory;

class BlogCategoriesTable extends DataTableComponent
{
    protected $model = BlogCategory::class;
    public $i = 1;
    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $blogCategoriesRepo = new BlogCategoryRepository();
        $categories = new BlogCategoryController($blogCategoriesRepo);
        $categories->destroy($id);
    }

  
    public function configure(): void
    {
        $this->setPrimaryKey('id')
        ->setReorderEnabled()
        ->setSingleSortingDisabled()
        ->setHideReorderColumnUnlessReorderingEnabled()
        ->resetCounter();

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
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Display Name", "display_name")
                ->sortable()
                ->searchable(),
            Column::make("Image", "image")
            ->format(function ($image) {
                $img = BLOG_CATEGORY_IMAGE_PATH . $image;
                echo $image != '' ? '<img src="' . asset($img) . '" width="50">' : '';
            }),
            Column::make("Image Alt Text", "image_alt_text")
                ->sortable()
                ->searchable(),
            Column::make("Icon", "icon")
                ->sortable()
                ->searchable(),
            Column::make("Description", "description")
                ->sortable()
                ->searchable(),
            Column::make("Type", "type")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('blogCategories.show', $row->id),
                        'editUrl' => route('blogCategories.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'blog_categories',
                    ])
                )
        ];
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            $blog_categories = BlogCategory::find((int)$item['value']);
            $blog_categories->sort = $item['order'];
            $blog_categories->save();
        }
    }
    public function builder(): Builder
    {
        return BlogCategory::query();
    }
}