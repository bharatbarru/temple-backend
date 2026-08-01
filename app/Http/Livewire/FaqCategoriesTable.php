<?php

namespace App\Http\Livewire;

use App\Http\Controllers\FaqCategoryController;
use App\Models\BlogPost;
use App\Models\Cms;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\FaqCategory;
use App\Models\Product;
use App\Models\Service;
use App\Repositories\FaqCategoryRepository;

class FaqCategoriesTable extends DataTableComponent
{
    protected $model = FaqCategory::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $faqCategoryRepo = new FaqCategoryRepository();
        $faqCategory = new FaqCategoryController($faqCategoryRepo);
        $faqCategory->destroy($id);
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
            Column::make('S.no', 'id')
                ->format(fn ()  => ($this->page - 1) * $this->perPage + $this->i++),
            Column::make("Page Type", "page_type")
                ->sortable()
                ->searchable(),
            Column::make('Page Name', 'page_name')
                ->format(fn ($value, $faqCategory) => getPageNames($faqCategory->page_type, $faqCategory->page_name)),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('faqCategories.show', $row->id),
                        'editUrl' => route('faqCategories.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'faq_categories',
                    ])
                )
        ];
    }

    public function query()
    {
        return FaqCategory::query();
    }
}
