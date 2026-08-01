@php
    $corporateValues = getClienteleCategory('corporate-values');
@endphp
@if ($corporateValues)
    <section class="corporate-section text-center">

        <figure class="value-pic m-0" data-aos="zoom-in" data-aos-duration="1000"><img src="{{ asset('assets/values-pic.svg') }}" alt="Corporate Values"/></figure>

        <div class="container-fluid">
            <h2 class="section-title  title-center">{{ $corporateValues->display_name }}</h2>
          
          <p class="lead font-500 mb-5">  {!! $corporateValues->tagline !!}</p>

            <div class="row mt-5">

            @foreach ($corporateValues->clienteles->sortBy('sort') as $corporateValue)
            @if ($corporateValue->publish == 1)
            <div class="col  mb-3" data-aos="zoom-in-up" data-aos-duration="1000">
                <div class="item card card-body h-100 ">
                    <figure class="m-auto  avatar avatar-xlg card">
                        
                        
                        <img src="{{ asset(CLIENTELE_IMAGE_PATH . $corporateValue->image) }}"
                            alt="{{ $corporateValue->image_alt_text }}">
                        
                        </figure>
                        <h5 class="mt-3">{{ $corporateValue->title }}</h5>
                </div>
            </div>
            @endif
        @endforeach
    </div>



        </div>
    </section>
@endif

