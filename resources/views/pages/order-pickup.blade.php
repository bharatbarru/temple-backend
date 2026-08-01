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
@section('pageclassname')
    order-pickup-page
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
                                        <h1 class="display-3 section-title w-bg">
                                            Order & Pickup

                                            
                                        </h1>
                                        <h3 class="lobster-regular h1"><span class="text-primary">
                                               
                                        Authentic Traditional  </span> South Indian,North Indian Dishes</h3>
                                        <p class="lead font-400">Discover the trendiest spot in Chicago Loop for mouthwatering, genuine Indian cuisine to-go.

                                        </p>

                                            <div class="buttons-block mt-5 ">
                                        {{-- @if ($slider->button_name && $slider->button_url)
                                            <a href="{{ $slider->button_url }}"
                                                class="btn btn-secondary btn-lg custom-button btn-shadow"
                                                target="{{ $slider->new_window ? '_target' : '' }}">
                                                <span class="span-text" data-text="{{ $slider->button_name }}">
                                                {{ $slider->button_name }}
                                                </span>
                                            </a>
                                        @endif --}}
                                        <a href="tel:{!! applicationSettings('secondary-phone-number') !!}" class="btn btn-white btn-lg custom-button btn-shadow" target="_blank" tabindex="0">
                                            Call Now
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
@endsection
