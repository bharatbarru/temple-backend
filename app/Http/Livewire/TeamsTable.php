<?php

namespace App\Http\Livewire;

use App\Http\Controllers\TeamController;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Team;
use App\Models\TeamCategory;
use App\Repositories\TeamRepository;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class TeamsTable extends DataTableComponent
{
    protected $model = Team::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $teamrepo = new TeamRepository();
        $team = new TeamController($teamrepo);
        $team->destroy($id);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setReorderEnabled()
            ->setSingleSortingDisabled()
            ->setHideReorderColumnUnlessReorderingEnabled()
            ->resetCounter();
        }
    public function resetCounter(){
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
            Column::make("Team Categories Id", "team_categories_id")
                ->format(function ($team_categories_id, $team) {
                    return $team->teamCategories->name ?? '';
                }),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Image", "image")
            ->format(function ($image) {
                $img = TEAM_IMAGE_PATH . $image;
                echo $image != '' ? '<img src="' . asset($img) . '" width="50">' : '';
            }),
            // Column::make("Image Alt Text", "image_alt_text")
            //     ->sortable()
            //     ->searchable(),
            Column::make("Designation", "designation")
                ->sortable()
                ->searchable(),
            // Column::make("Description", "description")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Linkedin Url", "linkedin_url")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Facebook Url", "facebook_url")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Instagram Url", "instagram_url")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Twitter Url", "twitter_url")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Github Url", "github_url")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Other", "other")
            //     ->sortable()
            //     ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('teams.show', $row->id),
                        'editUrl' => route('teams.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'teams'

                    ])
                )
        ];
    }
    public function reorder($items): void
    {
        foreach ($items as $item) {
            $teams = Team::find((int)$item['value']);
            $teams->sort = $item['order'];
            $teams->save();
        }
    }
    public function filters(): array
    {

        $categories = TeamCategory::all()->pluck('name', 'id');
        return [
            SelectFilter::make('Team Category')
                ->options(['' => 'Select Category', $categories])
                ->filter(function (Builder $builder, $value) {
                    $builder->where('team_categories_id', $value);
                }),
        ];
    }

    public function builder(): Builder
    {
        return Team::query();
    }
}
