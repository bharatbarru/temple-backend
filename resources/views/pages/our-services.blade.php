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

{{-- ----------end of inner-banner------------- --}}

@php
$ourServices = getServiceCategory('our-services');
@endphp
@if ($ourServices)
<section class="pt-5 services-page-section">
    <div class="container">
        <div class="our-services text-center ">
            <h2 class="h1"> {!! $page->banner_tagline !!}</h2>
            <div class="mt-5 row our-service-list">
                @foreach ($ourServices->services as $ourService)
                    <div class="col-md-4 mb-3 text-center block">
                   
                        <div class="card h-100">
                                
                            <div class="card-body d-flex flex-column">
                                <a href="{{ url('services/' . $ourService->slug) }}" class="thumbnail">
                                    <img class="w-100 h-100 object-fit-cover object-fit-center-postion" src="{{ asset(SERVICE_IMAGE_PATH . $ourService->image) }}" alt="{{ $ourService->image_alt_text }}">
                                  </a>
                           
                              <a href="{{ url('services/' . $ourService->slug) }}">
                                <h5 class="font-700">{{ $ourService->title }}</h5>
                              </a>
                              <div class="flex-grow-1">
                                {!! $ourService->short_description !!}
                              </div>
                             
                            </div>
                          </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
 

    
@endif

@endsection
