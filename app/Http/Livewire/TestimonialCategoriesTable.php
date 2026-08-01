<?php

namespace App\Http\Livewire;

use App\Http\Controllers\TestimonialCategoryController;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\TestimonialCategory;
use App\Repositories\TestimonialCategoryRepository;

class TestimonialCategoriesTable extends DataTableComponent
{
    protected $model = TestimonialCategory::class;

    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $testimonial_category_repo = new TestimonialCategoryRepository();
        $testimonial_category = new TestimonialCategoryController($testimonial_category_repo);
        $testimonial_category->destroy($id);
    }

    public function resetCounter()
    {
        $this->i = 1;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            // ->setReorderEnabled()
            ->setSingleSortingDisabled()
            ->setHideReorderColumnUnlessReorderingEnabled()
            ->resetCounter();

    }

    public function columns(): array
    {
        return [
            // Column::make('Order', 'sort')
            //     ->sortable()
            //     ->collapseOnMobile()
            //     ->excludeFromColumnSelect(),
            Column::make('S.no', 'id')
                ->format(fn ()  => ($this->page - 1) * $this->perPage + $this->i++),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            // Column::make("Display Name", "display_name")
            //     ->sortable()
            //     ->searchable(),
            Column::make("Testimonial Type", "testimonial_type")
                ->sortable()
                ->searchable(),
            // Column::make("Icon", "icon")
            //     ->sortable()
            //     ->searchable(),
            Column::make("Page Type", "type")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('testimonialCategories.show', $row->id),
                        'editUrl' => route('testimonialCategories.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'testimonial_categories',
                        ])
                    )
            ];
        }
    
        public function builder(): Builder
        {
            return TestimonialCategory::query();
        }
    }