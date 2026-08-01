<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Testimonial;
use App\Repositories\TestimonialRepository;
use App\Http\Controllers\TestimonialController;

class TestimonialsTable extends DataTableComponent
{
    protected $model = Testimonial::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $testimonialrepo = new TestimonialRepository();
        $testimonial = new TestimonialController($testimonialrepo);
        $testimonial->destroy($id);
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
            Column::make("Testimonial Category", "testimonial_category_id")
            ->format(function ($testimonial_category_id, $testimonial) {
                return $testimonial->testimonialCategory->name ?? '';
            }),
            Column::make("Image", "image")
            ->format(function ($image) {
                $img = TESTIMONIAL_IMAGE_PATH . $image;
                echo $image != '' ? '<img src="' . asset($img) . '" width="50">' : '';
            }),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
                
            // Column::make("Company", "company")
            //     ->sortable()
            //     ->searchable(),
            Column::make("Designation", "designation")
                ->sortable()
                ->searchable(),
            Column::make("Date", "date")
                ->sortable()
                ->searchable(),
           
            // Column::make("Image Alt Text", "image_alt_text")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Icon", "icon")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Video Url", "video_url")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Video Iframe", "video_iframe")
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
            
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('testimonials.show', $row->id),
                        'editUrl' => route('testimonials.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'testimonials'
                        ])
                    )
            ];
        }
        
    
        public function reorder($items): void
        {
            foreach ($items as $item) {
                $testimonial = Testimonial::find((int)$item['value']);
                $testimonial->sort = $item['order'];
                $testimonial->save();
            }
        }
    
        public function builder(): Builder
        {
            return Testimonial::query();
        }
    }