@extends('frontend.app')
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
@section('content')
    {{-- ----------inner-banner------------- --}}
    <section class="bg-dark text-light header-inner p-0 jarallax o-hidden inner-banner" data-overlay data-jarallax
        data-speed="0.2">
        @if ($page->banner_image != '')
            <img src="{{ asset('images/inner-pages/' . $page->banner_image) }}" alt="{{ $page->title }} "
                class="jarallax-img opacity-30" />
        @else
            <img src="{{ asset('images/commn-innerbanner.jpeg') }}" alt="{{ $page->title }} "
                class="jarallax-img opacity-30">
        @endif
        <div class="container layer-2 ">
            <nav class="breadcrumb-nav" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    @if ($page->parentName)
                        <li class="breadcrumb-item">
                            <a href="{{ url('/' . $page->parentName->slug) }}">{{ $page->parentName->title }}</a>
                        </li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
                </ol>
            </nav>
            <h1 class="display-1">{{ $page->banner_title != '' ? $page->banner_title : $page->title }}</h1>
        </div>
    </section>
    {{-- ----------end of inner-banner------------- --}}
    <section class="testimonial-page">
        <div class="container">
            <div class="inner-page-title">
                <h2 class="text-primary h1">{!! $page->banner_tagline !!}</h2>
                <p>{!! $page->short_description !!}</p>
            </div>
            @if ($testimonials->count() > 0)
                <div class="row justify-content-center">
                    <div class="col-xl-11">
                        <div class="row">
                            @foreach ($testimonials as $testimonial)
                                <div class="col-md-12 mb-3 " >
                                    <div class="card card-body shadow">
                                        <div class="row">
                                    @if ($testimonial->image != '')
                                        <figure>
                                            <img src="{{ asset(TESTIMONIAL_IMAGE_PATH . $testimonial->image) }}"
                                                alt="{{ $testimonial->name }}  " class="avatar mr-2">
                                        </figure>
                                    @endif
                                        <div class="col">
                                        <h4 class="mb-2">{{ $testimonial->name }}
                                            <span>{{ $testimonial->designation }}</span></h4>
                                        {!! $testimonial->description !!}
                                    </div>
                                </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <ul class="pagination pagination-lg justify-content-center">
                    {{ $testimonials->appends(request()->query())->links() }}
                </ul>
            @else
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    No Posts Found.
                </div>
            @endif
        </div>
        </div>
    </section>
@endsection
