@extends('frontend.app')
{{-- @section('content') --}}
{{-- ----------inner-banner------------- --}}
{{-- <section class="bg-dark text-light header-inner p-0 jarallax o-hidden inner-banner" data-overlay data-jarallax
        data-speed="0.2">
        @if (applicationSettings('services-banner') != '')
            <img src="{{ asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('services-banner')) }}"
                alt="{{ applicationSettingsAltText('services-banner') }}" class="jarallax-img opacity-30">
        @else
            <img src="{{ asset('images/commn-innerbanner.jpeg') }}" alt="Inner Image" class="jarallax-img opacity-30">
        @endif
        <div class="container layer-2 ">
            <nav class="breadcrumb-nav" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{!! applicationSettings('services-title') !!}</li>
                </ol>
            </nav>
            <h1 class="display-3">{!! applicationSettings('services-title') !!}</h1>
            <p>{!! applicationSettings('services-tagline') !!}</p>
        </div>
    </section> --}}
{{-- ----------end of inner-banner------------- --}}
{{-- @if (getPhotoGalleries() != null)
        <section class="home-services main-services">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="small-title">{!! applicationSettings('services-bottom-title') !!}</span>
                    <div class="discription">
                        {!! applicationSettings('services-description') !!}
                    </div>
                </div>
                <div class="row mt-5">
                    @foreach (getPhotoGalleries() as $photogallery)
                        <div class="col-md-4">
                            <div class="item d-flex">
                                <div class="card card-body bg-secondary text-light mx-3 ">
                                    <div class="icon-block">
                                        <img src="{{ $photogallery->image }}" alt="{{ $photogallery->title }} icon">
                                    </div>
                                    <h6>{{ $service->title }}</h6>
                                    <p>{!! \Illuminate\Support\Str::limit(strip_tags($service->short_description), 76, '...') !!}</p> 
                                     <a href="{{ url('gallery/' . $service->slug) }}" class="btn btn-primary">See
                                        Details</a>
                                    <a class="full-link" href="{{ url('gallery/' . $service->slug) }}">&nbsp;</a> 
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>


        <div class="container">
            <h2 class="home-title">Gallery</h2>
            @if ($photoCategories != '')
                <div class="home-photo-gallery">
                    @foreach ($photoCategories as $photoCategory)
                        @if ($photoCategory->activePhotoGalleries->count() > 0)
                            <div class="row justify-content-center">
                                @foreach ($photoCategory->activePhotoGalleries as $gallery)
                                    <div class="col-lg-4 block">
                                        <div class="card">
                                            <figure> <img class="card-img-top"
                                                    src="{{ asset('images/gallery/' . $gallery->image) }}" alt="">
                                            </figure>
                                            <div class="card-body-01">
                                                <h5 class="card-title">{{ $gallery->title }}</h5>
                                                <a href="{{ $gallery->image_url }}" class="btn btn-primary btn-xs"
                                                    target="_blank">View Photos</a>
                                            </div>
                                        </div>
                                        <a class="full_link" href="{{ $gallery->image_url }}" target="_blank">&nbsp;</a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
            </section>
            @include('pages.make-an-appointment')
            @include('pages.subscribe-block')
            @include('pages.custom-blocks')
            @include('pages.get-testimonials')
    @endif
@endsection --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Home Gallery</h1>

        
    </div>
@endsection
