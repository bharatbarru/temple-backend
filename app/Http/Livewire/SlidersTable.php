<?php

namespace App\Http\Livewire;

use App\Http\Controllers\SliderController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Slider;
use App\Repositories\SliderRepository;

class SlidersTable extends DataTableComponent
{
    protected $model = Slider::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $sliderRepo = new SliderRepository();
        $slider = new SliderController($sliderRepo);
        $slider->destroy($id);
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
            Column::make('Image')
                ->format(function ($image) {
                    $img = SLIDER_IMAGE_PATH . $image;
                    echo $image != '' ? '<img src="' . asset($img) . '" width="50">' : '';
                }),
            Column::make("Image Alt Text", "image_alt_text")
                ->sortable()
                ->searchable(),
            Column::make("Title", "title")
                ->sortable()
                ->searchable(),
            Column::make("Tagline", "tagline")
                ->sortable()
                ->searchable(),
            Column::make("Button Name", "button_name")
                ->sortable()
                ->searchable(),
            Column::make("Button Url", "button_url")
                ->sortable()
                ->searchable(),
            Column::make('Publish', 'publish', 'slider')
                ->format(function ($publish, $slider) {
                    return view('common.livewire-tables.publish', ['publish' => $publish, 'id' => $slider->id]);
                }),
            Column::make("Actions", 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('sliders.show', $row->id),
                        'editUrl' => route('sliders.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'slider'
                    ])
                )
        ];
    }

    public function togglePublish($sliderId)
    {
        $slider = Slider::find($sliderId);
        $slider->publish = !$slider->publish;
        $slider->save();
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            $slider = Slider::find((int)$item['value']);
            $slider->sort = $item['order'];
            $slider->save();
        }
    }
}
