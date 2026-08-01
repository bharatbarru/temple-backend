@extends('frontend.app')

@isset($page)
    @section('title')
        {{ $page->title }}
    @endsection

    @section('seotitle')
        {{ $page->seo_title }}
    @endsection

    @section('seodescription')
        {{ $page->seo_description }}
    @endsection

    @section('seokeywords')
        {{ $page->seo_keywords }}
    @endsection
@endisset

@section('content')
    @isset($page)
        {{-- ----------inner-banner------------- --}}
        <section class="bg-dark text-light header-inner p-0  inner-banner">
            @if ($page->banner_image != '')
                <figure class="m-0">
                    <img src="{{ asset('images/inner-pages/' . $page->banner_image) }}" alt="{{ $page->banner_image_alt_text }}"
                        class="w-100" />
                </figure>
            @else
                <figure class="m-0">
                    <img src="{{ asset('assets/inner-banner.webp') }}" alt="{{ $page->title }}" class="w-100">
                </figure>
            @endif
            <div class="inner-text text-center">
                <div class="container">
                    <h1 class="display-2">{{ $page->banner_title != '' ? $page->banner_title : $page->title }}</h1>
                </div>
            </div>
        </section>
    @endisset

    {{-- ----------end of inner-banner------------- --}}
    <section class="our-blog-post">
        <div class="container">
            @if (isset($page) && $page->banner_tagline != '')
            <div class="text-center mb-5">
                <h2 class="h1"> {!! $page->banner_tagline !!}</h2>
            </div>
            @endif
            @if ($news->count() > 0)
                <div class="row mb-4">
                    @foreach ($news as $news)
                        <div class="col-md-6 col-lg-4 d-flex ">
                            <div class="card">
                                <a href="{{ url('news/' . $news->slug) }}">
                                    <figure class="m-0"> <img src="{{ asset(NEWS_IMAGE_PATH . $news->image) }}" alt="Image"
                                            class="card-img-top"></figure>
                                </a>
                                <div class="card-body d-flex flex-column">
                                    <div class="block">
                                        <div class="text-small d-flex date-col mb-2">
                                            <span > <i class="material-symbols-outlined custom-icon">
                                                calendar_month
                                            </i> {{ date('M d, Y', strtotime($news->date)) }}</span>
                                        </div>
                                     
                                    </div>
                                    <a href="{{ url('news/' . $news->slug) }}">
                                        <h4 class="font-color">{{ $news->title }}</h4>
                                    </a>
                                    <p class="flex-grow-1">
                                        {!! \Illuminate\Support\Str::limit(strip_tags($news->description), 150, '...') !!}
                                    </p>
                                <a href="{{ url('news/' . $news->slug) }}" class="lead hover-arrow mt-5 d-inline-block">Read More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- <ul class="pagination pagination-lg justify-content-center">
                    {{ $news->appends(request()->query())->links() }}
                </ul> --}}
                <!-- end: Pagination -->
            @else
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    No Posts Found.
                </div>
            @endif
        </div>
    </section>
    @isset($faqCategory)
        @include('common.faqs', ['faqs' => $faqCategory->faqs]);
    @endisset
@endsection
