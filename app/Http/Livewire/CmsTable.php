<?php

namespace App\Http\Livewire;

use App\Http\Controllers\CmsController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Cms;
use App\Repositories\CmsRepository;

class CmsTable extends DataTableComponent
{
    protected $model = Cms::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $cmsRepo = new CmsRepository();
        $cms = new CmsController($cmsRepo);
        $cms->destroy($id);
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
            Column::make("Title", "title")
                ->sortable()
                ->searchable(),
            Column::make("Slug", "slug")
                ->sortable()
                ->searchable(),
            Column::make("Parent", "parent", "cms")
                ->format(function ($parent, $cms) {
                    return $parent != 'root' ? $cms->parentName->title : 'root';
                }),
            Column::make('Publish', 'publish', 'slider')
                ->format(function ($publish, $slider) {
                    return view('common.livewire-tables.publish', ['publish' => $publish, 'id' => $slider->id]);
                }),
            Column::make("Actions", 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('cms.show', $row->id),
                        'editUrl' => route('cms.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'cms'
                    ])
                )
        ];
    }

    public function togglePublish($id)
    {
        $cms = Cms::find($id);
        $cms->publish = !$cms->publish;
        $cms->save();
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            $cms = Cms::find((int)$item['value']);
            $cms->sort = $item['order'];
            $cms->save();
        }
    }
}
