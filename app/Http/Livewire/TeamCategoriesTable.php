<?php

namespace App\Http\Livewire;

use App\Http\Controllers\TeamCategoryController;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\TeamCategory;
use App\Repositories\TeamCategoryRepository;
use Illuminate\Database\Eloquent\Builder;

class TeamCategoriesTable extends DataTableComponent
{
    protected $model = TeamCategory::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $teamCategoriesRepo = new TeamCategoryRepository();
        $categories = new TeamCategoryController($teamCategoriesRepo);
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
            Column::make("Icon", "icon")
                ->sortable()
                ->searchable(),
            Column::make("Image", "image")
            ->format(function ($image) {
                $img = TEAM_CATEGORY_IMAGE_PATH . $image;
                echo $image != '' ? '<img src="' . asset($img) . '" width="50">' : '';
            }),
            Column::make("Image Alt Text", "image_alt_text")
                ->sortable()
                ->searchable(),
            Column::make("Type", "type")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('teamCategories.show', $row->id),
                        'editUrl' => route('teamCategories.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'team_categories',

                    ])
                )
        ];
    }
    public function reorder($items): void
    {
        foreach ($items as $item) {
            $team_categories = TeamCategory::find((int)$item['value']);
            $team_categories->sort = $item['order'];
            $team_categories->save();
        }
    }
    public function builder(): Builder
    {
        return TeamCategory::query();
    }
}
