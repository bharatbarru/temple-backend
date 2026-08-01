<?php

namespace App\Http\Livewire;

use App\Http\Controllers\HallAddonController;
use App\Models\HallAddon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Repositories\HallAddonRepository;

class HallAddonsTable extends DataTableComponent
{
    protected $model = HallAddon::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $hallAddonRepo = new HallAddonRepository();
        $hallAddon = new HallAddonController($hallAddonRepo);
        $hallAddon->destroy($id);
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
                ->format(fn()  => ($this->page - 1) * $this->perPage + $this->i++),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            // Column::make("Type", "event_type")
            //     ->format(fn($value) => ['one_day' => '1 Day Event', 'three_day' => '3 Day Event'][$value] ?? '')
            //     ->sortable()
            //     ->searchable(),
            Column::make("Image", "image")
                ->format(function ($image) {
                    $img = HALL_ADDON_IMAGE_PATH . $image;
                    return $image != '' ? '<img src="' . asset($img) . '" width="50">' : '';
                })
                ->html(),
            Column::make("Publish", "publish")
                ->format(function ($publish, $hallAddon) {
                    return view('common.livewire-tables.publish', ['publish' => $publish, 'id' => $hallAddon->id]);
                }),
            Column::make("Default", "default")
                ->format(function ($default, $hallAddon) {
                    return view('common.livewire-tables.default', ['default' => $default, 'id' => $hallAddon->id]);
                }),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('hallAddons.show', $row->id),
                        'editUrl' => route('hallAddons.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'hall-addons'
                    ])
                )
        ];
    }

    public function togglePublish($id)
    {
        $hallAddon = HallAddon::find($id);
        $hallAddon->publish = !$hallAddon->publish;
        $hallAddon->save();
    }

    public function toggleDefault($id)
    {
        $hallAddon = HallAddon::find($id);
        $hallAddon->default = !$hallAddon->default;
        $hallAddon->save();
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            $hallAddon = HallAddon::find((int)$item['value']);
            $hallAddon->sort = $item['order'];
            $hallAddon->save();
        }
    }
}
