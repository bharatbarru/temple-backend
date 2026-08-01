@extends('frontend.app')
@section('title')
    {{ $page->title ?? null }}
@endsection
@section('seotitle')
    {{ $page->seo_title ?? null }}
@endsection
@section('seodescription')
    {{ $page->seo_description ?? null }}
@endsection
@section('seokeywords')
    {{ $page->seo_keywords ?? null }}
@endsection
@section('pageclassname')
    homepage
@endsection
@section('content')
    @if ($sliders->count() > 0)
        <section class="resturant-banner p-0">
            <img class="w-50 float-right" src="{{ asset('assets/bg.png') }}">
            <div class="clear"></div>
            <div class="home-slider">
                @foreach ($sliders as $key => $slider)
                    <div class="item h-100">
                        <div class="container h-100">
                            <div class="row align-items-center h-100">
                                <div class="col-md-6">
                                    @if ($slider->title || $slider->tagline || $slider->button_name || $slider->button_url)
                                        <div class="banner-text ">
                                            <div class="banner-text-inner ">
                                                @if ($key == 0 && $slider->title)
                                                    <h1 class="display-3 section-title w-bg">
                                                        {!! $slider->title !!}
                                                    </h1>
                                                @elseif ($slider->title)
                                                    <h2 class="display-3 section-title w-bg">
                                                        {!! $slider->title !!}
                                                    </h2>
                                                @endif
                                                @if ($slider->tagline)
                                                    <p class="lead font-400">{!! $slider->tagline !!}</p>
                                                @endif

                                                    <div class="buttons-block mt-5 ">
                                                @if ($slider->button_name && $slider->button_url)
                                                    <a href="{{ $slider->button_url }}"
                                                        class="btn btn-secondary btn-lg custom-button btn-shadow"
                                                        target="{{ $slider->new_window ? '_target' : '' }}">
                                                        <span class="span-text" data-text="{{ $slider->button_name }}">
                                                        {{ $slider->button_name }}
                                                        </span>
                                                    </a>
                                                @endif
                                                <a href="{{ url('/menu') }}" class="btn btn-white btn-lg custom-button btn-shadow" target="" tabindex="0">
                                                    <span class="span-text" data-text="Menu">
                                                    Menu
                                                </span>
                                                </a>
                                                    </div>


                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <figure class="m-0  rotate-pic an-move-down ">
                            <img class="img-fluid" src="{{ asset(SLIDER_IMAGE_PATH . $slider->image) }}"
                                alt="{{ $slider->image_alt_text }}">
                        </figure>
                    </div>
                @endforeach
            </div>
        </section>



       
    @endif


@include('pages.welcome-block')


@include('pages.get-product')


@include('pages.why-choose-us')

@include('pages.get-about')


@include('pages.get-our-menu')

   
@endsection
