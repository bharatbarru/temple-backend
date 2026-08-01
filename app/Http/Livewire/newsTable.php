<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\news;

class newsTable extends DataTableComponent
{
    protected $model = news::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        news::find($id)->delete();
        Flash::success('News deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            
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
            Column::make('S.no', 'id')
                ->format(fn ()  => ($this->page - 1) * $this->perPage + $this->i++),
            Column::make("News Category", "news_category_id")                
                ->format(function ($news_category_id, $news) {
                    return $news->newsCategory->name ?? '';
                }),
            Column::make("Title", "title")
                ->sortable()
                ->searchable(),
            Column::make("Tagline", "tagline")
                ->sortable()
                ->searchable(),
            Column::make("Image", "image")
            ->format(function ($image) {
                $img = NEWS_IMAGE_PATH. $image;
                echo $image != '' ? '<img src="' . asset($img) . '" width="50">' : '';
            }),
            Column::make("Date", "date")
                ->sortable()
                ->searchable(),
            Column::make("Short Description", "short_description")
                ->sortable()
                ->searchable(),
            Column::make("Description", "description")
                ->sortable()
                ->searchable(),

            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('news.show', $row->id),
                        'editUrl' => route('news.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'news'
                    ])
                )
        ];
    }
}