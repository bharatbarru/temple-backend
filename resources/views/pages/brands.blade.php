@php
    $ourBrands = getClienteleCategory('get-why-choose-us');
@endphp
@if ($ourBrands)
    <section class="our-brands text-center">
        <i class="flaticon-fast-delivery"></i>
        <img class="brand-left"  src="{{ asset("assets/our-brand-1.svg")}}" alt="Our Brand 1"   data-aos="zoom-out-up" data-aos-duration="1000"/>
        <img class="brand-right"  src="{{ asset("assets/our-brand-2.svg")}}" alt="Our Brand 2"  data-aos="zoom-out-up"  data-aos-duration="1000"/>
        <div class="container">
          
<figure class="m-0 section-img"><img src="{{ asset('assets/frock.svg') }}" alt="our brands"/></figure>

                <h2 class="section-title title-center  text-center"> {{ $ourBrands->display_name }}</h2>
                <p class="lead font-500">{!! $ourBrands->tagline !!}</p>
            
            <div class="five-items-slider our-brands-list mt-5">
                @foreach ($ourBrands->clienteles->sortBy('sort') as $ourBrand)
                    @if ($ourBrand->publish == 1)
                        <div class="item">
                            <figure class="m-0">
                                
                                
                                <img src="{{ asset(CLIENTELE_IMAGE_PATH . $ourBrand->image) }}"
                                    alt="{{ $ourBrand->image_alt_text }}">
                                
                                </figure>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
@endif
</section>
