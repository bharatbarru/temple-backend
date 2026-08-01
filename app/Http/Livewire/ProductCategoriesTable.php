<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ProductCategoryController;
use Laracasts\Flash\Flash;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ProductCategory;
use App\Repositories\ProductCategoryRepository;

class ProductCategoriesTable extends DataTableComponent
{
    protected $model = ProductCategory::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $productCategoryRepo = new ProductCategoryRepository();
        $productCategory = new ProductCategoryController($productCategoryRepo);
        $productCategory->destroy($id);
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
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Display Name", "display_name")
                ->sortable()
                ->searchable(),
            Column::make("Image", "image")
            ->format(function ($image) {
                $img = PRODUCT_CATEGORY_IMAGE_PATH . $image;
                echo $image != '' ? '<img src="' . asset($img) . '" width="50">' : '';
            }),
            Column::make("Image Alt Text", "image_alt_text")
                ->sortable()
                ->searchable(),
            Column::make("Name", "icon")
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
                        'showUrl' => route('productCategories.show', $row->id),
                        'editUrl' => route('productCategories.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'product_categories'
                        ])
                    )
            ];
        }
        
    
        public function reorder($items): void
        {
            foreach ($items as $item) {
                $productCategory = ProductCategory::find((int)$item['value']);
                $productCategory->sort = $item['order'];
                $productCategory->save();
            }
        }
    
        public function builder(): Builder
        {
            return ProductCategory::query();
        }
    }