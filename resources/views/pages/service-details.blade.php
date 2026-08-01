

@extends('frontend.app')


@section('title')
    {{ $service->title }}
@endsection
@section('seotitle')
    {{ $service->seo_title }}
@endsection
@section('seodescription')
    {{ $service->seo_description }}
@endsection
@section('seokeywords')
    {{ $service->seo_keywords }}
@endsection




@section('content')
    {{-- ----------inner-banner------------- --}}
      {{-- ----------inner-banner------------- --}}
      <section class="bg-dark text-light header-inner p-0  inner-banner">
        @if (applicationSettings('our-service-image'))
            <figure class="m-0">
                <img alt="{{ applicationSettingsAltText('our-service-image') }}"
                src="{{ asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('our-service-image')) }}" class="w-100" />
            </figure>
        @else
            <figure class="m-0">
                <img src="{{ asset('assets/inner-banner.webp') }}" alt="Our Service" class="w-100">
            </figure>
        @endif
        <div class="inner-text text-center">
            <div class="container">
                <h1 class="display-2">Our Service</h1>
            </div>
        </div>
    </section>
    {{-- ----------end of inner-banner------------- --}}
    {{-- ----------end of inner-banner------------- --}}
    
    <section class="service-details bg-tertiary">
        <div class="container">


            <div class="row">

                <div class="col-md-7 service-left">

<div class="inner">
    @if ($service->image != '')
    <figure class="service-image m-0 mb-3">
        <img src="{{ asset(SERVICE_IMAGE_PATH . $service->image) }}" alt="{{ $service->title }}" class="w-100">
    </figure>
@endif
<h2 class="text-light">{!! $service->title !!}</h2>
<div class="description text-light">


    @if ($service->description != '')
{!! $service->description !!}

@else

    {!! $service->short_description !!}

    @endif

</div>
</div>


                </div>
                <div class="col-md-5 pl-5 service-right">
                    <div class="sticky-top">

                        <div class="card card-body mb-3">
                            <h4 class="section-title">Related Services</h4>
                            @php
                            $ourServices = getServiceCategory('our-services');
                            @endphp

<ul class="list-unstyled list-articles">
    @if($ourServices)
                            @foreach ($ourServices->services as $ourService)
                            <li class="row row-tight">

                                @if ($ourService->image != '')
                                <a href="{{ url('services/' . $ourService->slug) }}" class="col-3 thumbnail1">
                                    <img class="rounded object-fit-cover" style="min-height: 70px" src="{{ asset(SERVICE_IMAGE_PATH . $ourService->image) }}" alt="{{ $ourService->image_alt_text }}">
                                  </a>
                                  @endif
                             
                                <div class="col">
                                    <a href="{{ url('services/' . $ourService->slug) }}" class="col-3 thumbnail1">
                                    <h6 class="mb-1">{!! $ourService->title !!}</h6>
                                  </a>
                                 
                                </div>
                              </li>
 
                             @endforeach
                            
                  @endif
                      
                      </ul>
                    </div>

                    @if ($service->gallery != '')
                    <div class="row service-gallery">
                        @foreach (json_decode($service->gallery) as $gal)
                            <div class="col-md-3 block">
                                <figure>
                                    <img src="{{ asset(SERVICE_IMAGE_PATH . $gal->path) }}"
                                        alt="{{ $gal->alt_text }}" class="card-img-top">
                                </figure>
                            </div>
                        @endforeach
                    </div>
                @endif

                    </div>
                </div>

            </div>





       
            {{-- <div class="row">
                <div class="col-md-4">
                    <h2>Services</h2>

                    @if (getServicesCurrentTop($service->id) != null)
                        <ul class="all-services-list">
                            @foreach (getServicesCurrentTop($service->id) as $service)
                                <li class="{{ Request::is('services/' . $service->slug) ? 'active' : '' }}">
                                    <a href="{{ url('services/' . $service->slug) }}">{{ $service->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                
                </div>
             
            </div> --}}
         
         
        </div>
      
    </section>
 
    
    {{-- @include('pages.get-services') --}}

    @include('pages.get-testimonials')
@endsection
