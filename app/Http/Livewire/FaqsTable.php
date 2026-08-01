<?php

namespace App\Http\Livewire;

use App\Http\Controllers\FaqController;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Repositories\FaqRepository;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class FaqsTable extends DataTableComponent
{
    protected $model = Faq::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $faqrepo = new FaqRepository();
        $faq = new FaqController($faqrepo);
        $faq->destroy($id);
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
            Column::make("Faq Categories Id", "faqCategory.name"),
            Column::make("Question", "question")
                ->sortable()
                ->searchable(),
            Column::make("Answer", "answer")
                ->sortable()
                ->searchable(),
            Column::make("Button Name", "button_name")
                ->sortable()
                ->searchable(),
            Column::make("Button Url", "button_url")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('faqs.show', $row->id),
                        'editUrl' => route('faqs.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'faqs'
                    ])
                )
        ];
    }
    
    public function reorder($items): void
    {
        foreach ($items as $item) {
            $faq = Faq::find((int)$item['value']);
            $faq->sort = $item['order'];
            $faq->save();
        }
    }

    public function builder(): Builder
    {
        return Faq::query();
    }
    public function filters(): array
    {

        $categories = FaqCategory::all()->pluck('name', 'id');
        return [
            SelectFilter::make('Product Category')
                ->options(['' => 'Select Category', $categories])
                ->filter(function (Builder $builder, $value) {
                    $builder->where('faq_categories_id', $value);
                }),
        ];
    }
}
