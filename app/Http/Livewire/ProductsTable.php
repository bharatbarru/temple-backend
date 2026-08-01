<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ProductController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Repositories\ProductRepository;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class ProductsTable extends DataTableComponent
{
    protected $model = Product::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $productrepo = new ProductRepository();
        $product = new ProductController($productrepo);
        $product->destroy($id);
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
            Column::make("Product Category", "product_category_id")
                ->format(function ($product_category_id, $product) {
                    return $product->productCategory->name ?? '';
                }),
            Column::make("Title", "title")
                ->sortable()
                ->searchable(),
            Column::make("Slug", "slug")
                ->sortable()
                ->searchable(),
            // Column::make("Sub Title", "sub_title")
            //     ->sortable()
            //     ->searchable(),
            Column::make("Post Date", "post_date")
                ->sortable()
                ->searchable(),
            Column::make("Image", "image")
                ->format(function ($image) {
                    $img = PRODUCT_IMAGE_PATH . $image;
                    echo $image != '' ? '<img src="' . asset($img) . '" width="50">' : '';
                }),
            // Column::make("Image Alt Text", "image_alt_text")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Short Description", "short_description")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Description", "description")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Image Gallery", "image_gallery")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Video Gallery", "video_gallery")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Video Url", "video_url")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Video Iframe", "video_iframe")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Custom Url", "custom_url")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Map Url", "map_url")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Map Iframe", "map_iframe")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Page Title", "page_title")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Seo Title", "seo_title")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Seo Keywords", "seo_keywords")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Seo Description", "seo_description")
            //     ->sortable()
            Column::make("Publish", "publish", "products")
                ->format(function ($publish, $products) {
                    return view('common.livewire-tables.publish', ['publish' => $publish, 'id' => $products->id]);
                }),
            // Column::make('Special Product', 'special_product')
            //     ->format(function ($special_product, $products){
            //         return view('common.livewire-tables.specialProduct', ['special_product' => $special_product , 'id' => $products->id]);
            //     }),
            
            // Column::make("Special Prodcut", "special_product")
            //     ->sortable()
            //     ->searchable(),
            Column::make("Sort", "sort")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('products.show', $row->id),
                        'editUrl' => route('products.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'products'
                    ])
                )
        ];
    }

    public function togglePublish($id)
    {
        $products = Product::find($id);
        $products->publish = !$products->publish;
        $products->save();
    }
    public function toggleSpecialProduct($id)
    {
        $products = Product::find($id);
        $products->special_product = !$products->special_product;
        $products->save();
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            $product = Product::find((int)$item['value']);
            $product->sort = $item['order'];
            $product->save();
        }
    }

    public function builder(): Builder
    {
        return Product::query();
    }
    public function filters(): array
    {

        $categories = ProductCategory::all()->pluck('name', 'id');
        return [
            SelectFilter::make('Product Category')
                ->options(['' => 'Select Category', $categories])
                ->filter(function (Builder $builder, $value) {
                    $builder->where('product_category_id', $value);
                }),
        ];
    }
}