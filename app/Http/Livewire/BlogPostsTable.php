<?php

namespace App\Http\Livewire;

use App\Http\Controllers\BlogPostController;
use App\Models\BlogCategory;
use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\BlogPost;
use App\Repositories\BlogPostRepository;

class BlogPostsTable extends DataTableComponent
{
    protected $model = BlogPost::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $blogpostrepo = new BlogPostRepository();
        $blogpost = new BlogPostController($blogpostrepo);
        $blogpost->destroy($id);
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
            Column::make("Blog Category", "blog_category_id")
                ->format(function ($blog_category_id, $blogPost) {
                    return $blogPost->blogCategory->name ?? '';
                }),
            Column::make("Title", "title")
                ->sortable()
                ->searchable(),
             Column::make("Slug", "slug")
                 ->sortable()
                 ->searchable(),
            //  Column::make("Sub Title", "sub_title")
            //      ->sortable()
            //      ->searchable(),
            Column::make("Post Date", "post_date")
                ->sortable()
                ->searchable(),
            Column::make("Image", "image")
            ->format(function ($image) {
                $img = BLOG_POST_IMAGE_PATH . $image;
                echo $image != '' ? '<img src="' . asset($img) . '" width="50">' : '';
            }),
            // Column::make("Image Alt Text", "image_alt_text")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Short Description", "short_description")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Description", "description")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Image Gallery", "image_gallery")
            //     ->format(function ($gallery) {
            //         $img = BLOG_POST_IMAGE_PATH . $imagegallery;
            //         echo $image_gallery != '' ? '<img src="' . asset($img) . '" width="50">' : '';
            //     }),
            // Column::make("Video Gallery", "video_gallery")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Video Url", "video_url")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Video Iframe", "video_iframe")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Custom Url", "custom_url")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Map Url", "map_url")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Map Iframe", "map_iframe")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Page Title", "page_title")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Seo Title", "seo_title")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Seo Keywords", "seo_keywords")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Seo Description", "seo_description")
            //     ->sortable()
            //     ->searchable(),
            Column::make("Publish", "publish")
            ->format(function ($publish, $blogPost) {
                return view('common.livewire-tables.publish', ['publish' => $publish, 'id' => $blogPost->id]);
            }),
            Column::make("Sort", "sort")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('blogPosts.show', $row->id),
                        'editUrl' => route('blogPosts.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'blog_posts'
                    ])
                )
        ];
    }
    
    public function togglePublish($id)
    {
        $blogPost = BlogPost::find($id);
        $blogPost->publish = !$blogPost->publish;
        $blogPost->save();
    }
    public function reorder($items): void
    {
        foreach ($items as $item) {
            $blog_posts = BlogPost::find((int)$item['value']);
            $blog_posts->sort = $item['order'];
            $blog_posts->save();
        }
    }

    public function filters(): array
    {

        $categories = BlogCategory::all()->pluck('name', 'id');
        return [
            SelectFilter::make('Blog Category')
                ->options(['' => 'Select Category', $categories])
                ->filter(function (Builder $builder, $value) {
                    $builder->where('blog_category_id', $value);
                }),
        ];
    }

    public function builder(): Builder
    {
        return BlogPost::query();
    }
}