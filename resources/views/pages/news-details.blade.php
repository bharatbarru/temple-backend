@extends('frontend.app')
{{-- @section('title')
    {{ $blogPost->title }}
@endsection
@section('seotitle')
    {{ $blogPost->seo_title }}
@endsection
@section('seodescription')
    {{ $blogPost->seo_description }}
@endsection
@section('seokeywords')
    {{ $blogPost->seo_keywords }}
@endsection --}}
@section('content')
{{-- ----------inner-banner------------- --}}
{{-- <section class="bg-dark text-light header-inner p-0  inner-banner">
    @if (applicationSettings('blog-banner'))
        <img src="{{ asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('blog-banner')) }}"
            alt="{{ applicationSettingsAltText('blog-banner') }}" class="w-100">
        @else
            <figure class="m-0">
                <img src="{{ asset('assets/inner-banner.webp') }}" alt="{{ $blogPost->title }}" class="w-100">
            </figure>
    @endif
    <div class="inner-text text-center">
        <div class="container">
            <nav aria-label="breadcrumb text-light">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/blog') }}">Blog</a>
                        </li>
                        
                        <li class="breadcrumb-item active" aria-current="page">{{ $blogPost->title }}</li>
                    </ol>
                </nav>
            <div class="display-2">News Details</div>
        </div>
    </div>
</section> --}}
{{-- ----------end of inner-banner------------- --}}

<section class="blog-details">
    <div class="container">
        <div class="row">
            <div class="col-md-8 blog-left">
                <div class="card shadow">
                    <div class="card-body">
                        <figure class="pic m-0 mb-3">
                            <img class="w-100" src="{{ asset(NEWS_IMAGE_PATH . $news->image) }}"
                                alt="{{ $news->title }}">
                        </figure>
                        <h1>{{ $news->title }}</h1>
                        <div class="d-flex justify-content-between mb-3">
                            <div class="mr-2">
                                <span> <i class="material-symbols-outlined custom-icon">
                                        calendar_month
                                    </i> {{ date('M d, Y', strtotime($news->date)) }}</span>
                            </div>
                            <div class="text-small d-flex">
                                <span class="text-muted">
                                    <i class="material-symbols-outlined custom-icon">
                                        lan
                                    </i>
                                    {{ $news->newsCategory->name }}</span>
                            </div>
                        </div>
                        <div class="description"> {!! $news->description !!}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="sidebar sticky-sidebar ">
                    <!--widget tags -->
                    <div class="widget  widget-tags">
                        <h4 class="widget-title">Categories</h4>
                        <div class="card">
                            <ul class="list-group list-group-flush">
                                @foreach ($newsCategories as $category)
                                    <li class="list-group-item"><a href="{{ url('news/' . $category->name) }}"><span
                                                class="material-symbols-outlined custom-icon">
                                                lan
                                            </span>
                                            {{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!--end: widget tags -->
                </div>
            </div>
        </div>
</section>
{{-- @if ($faqCategory)
    @include('common.faqs', ['faqs' => $faqCategory->faqs]);
@endif --}}
@endsection
