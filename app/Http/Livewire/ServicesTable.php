<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ServiceController;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceType;
use App\Repositories\ServiceRepository;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class ServicesTable extends DataTableComponent
{
    protected $model = Service::class;
    public $i = 1;
    public $type;
    public $main;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $serviceRepo = new ServiceRepository();
        $service = new ServiceController($serviceRepo);
        $service->destroy($id);
    }

    public function mount($type, $main)
    {
        $this->type = $type;
        $this->main = $main;
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
            ->setHideReorderColumnUnlessReorderingEnabled();
        $this->resetCounter();
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
            // Column::make("Service Category", "service_category_id")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Service Category", "service_category_id")
            //     ->format(function ($service_category_id, $service) {
            //         return $service->serviceCategory->name ?? '';
            //     }),
            Column::make("Title", "title")
                ->sortable()
                ->searchable(),
            Column::make("Slug", "slug")
                ->sortable()
                ->searchable(),
            Column::make("Sub Title", "sub_title")
                ->sortable()
                ->searchable(),
            Column::make("Image", "image")
                ->format(function ($image) {
                    $img = SERVICE_IMAGE_PATH . $image;
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
            // Column::make("Custom Url", "custom_url")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("New Window", "new_window")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Gallery", "gallery")
            //     ->format(function ($gallery) {
            //         $img = SERVICE_IMAGE_PATH . $gallery;
            //         echo $gallery != '' ? '<img src="' . asset($img) . '" width="50">' : '';
            //     }),
            // Column::make("Video Url", "video_url")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Video Iframe", "video_iframe")
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
            //     ->searchable(),
            // Column::make("Icon", "icon")
            //     ->sortable()
            //     ->searchable(),
            Column::make("Publish", "publish", "service")
                ->format(function ($publish, $service) {
                    return view('common.livewire-tables.publish', ['publish' => $publish, 'id' => $service->id]);
                }),
            Column::make("Sort", "sort")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('services.show', $row->id) . ($this->type ? '?type=' . $this->type : '?main=' . $this->main),
                        'editUrl' => route('services.edit', $row->id) . ($this->type ? '?type=' . $this->type : '?main=' . $this->main),
                        'recordId' => $row->id,
                        'permissionName' => 'services'
                    ])
                )
        ];
    }
    public function togglePublish($id)
    {
        $service = Service::find($id);
        $service->publish = !$service->publish;
        $service->save();
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            $service = Service::find((int)$item['value']);
            $service->sort = $item['order'];
            $service->save();
        }
    }
    
    public function builder(): Builder
    {
        if($this->main) {
            $serviceType = ServiceType::where('slug', $this->main)->first();
            $categoryIds = ServiceCategory::where('service_type_id', $serviceType->id)->pluck('id')->unique()->toArray();
            return Service::query()->whereIn('service_category_id', $categoryIds);
        }else {
            $categoryId = ServiceCategory::where('slug', $this->type)->first()->id;
            return Service::query()->where('service_category_id', $categoryId);
        }
    }
    
    public function filters(): array
    {

        $categories = ServiceCategory::all()->pluck('name', 'id');
        return [
            SelectFilter::make('Service Category')
                ->options(['' => 'Select Category', $categories])
                ->filter(function (Builder $builder, $value) {
                    $builder->where('product_category_id', $value);
                }),
        ];
    }
}