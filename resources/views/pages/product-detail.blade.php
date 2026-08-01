@extends('frontend.app')
@section('title')
    {{ $products->title ?? null }}
@endsection
@section('seotitle')
    {{ $products->seo_title ?? null }}
@endsection
@section('seodescription')
    {{ $products->seo_description ?? null }}
@endsection
@section('seokeywords')
    {{ $products->seo_keywords ?? null }}
@endsection

@section('content')



    {{-- ----------inner-banner------------- --}}
    <section class="bg-dark text-light header-inner p-0  inner-banner">
        @if (applicationSettings('product-details-image'))
            <figure class="m-0">
                <img alt="{{ applicationSettingsAltText('product-details-image') }}"
                src="{{ asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('product-details-image')) }}" class="w-100" />
            </figure>
        @else
            <figure class="m-0">
                <img src="{{ asset('assets/inner-banner.webp') }}" alt="OUR MENU" class="w-100">
            </figure>
        @endif
        <div class="inner-text text-center">
            <div class="container">
                <h1 class="display-2">OUR MENU</h1>
            </div>
        </div>
    </section>
    {{-- ----------end of inner-banner------------- --}}
    <section class="product-details">
        <div class="container">

<div class="row align-items-center">
    <div class="col-md-6 details-pic">
        <figure><img src="{{ asset(PRODUCT_IMAGE_PATH . $product->image) }}"
            class="w-100">
          
            {{-- @if($product->special_product == 1)
        <span class="special-product">Special Product</span>
      @endif --}}
          </figure>
</div>
    
    <div class="col-md-6 details-content">
        <div class="inner-text">

            <h2 class="h1">{{ $product->title }}</h1>
                <div class="description lead">{!! $product->description !!}</div>

        </div>


    </div>
</div>


        
        </div>
    </section>
    {{-- <section class="related-products bg-primary-alt">
        <div class="container-fluid">
            <h2 class="title text-center primary-clr">Related Products</h2>
            <div class="four-items related-products-main ">
                @foreach ($relatedProducts as $product)
                    <div class="item">
                        <div class="card mx-3">
                            <a href="{{ url('products/' . $product->slug) }}">
                                <figure class="mb-0"><img src="{{ asset(PRODUCT_IMAGE_PATH . $product->image) }}"
                                        alt="{{ $product->title }}" class="card-img-top"></figure>

                                        @if($product->special_product == 1)
                                        <span class="special-product">Special Product</span>
                                      @endif
                            </a>
                            <div class="card-body align-items-start">
                                <h5 class="mb-3 primary-clr">
                                    <a href="{{ url('products/' . $product->slug) }}"> {{ $product->title }}</a>
                                </h5>
                                <p> {!! \Illuminate\Support\Str::limit(strip_tags($product->description), 100, '...') !!} </p>
                                <a href="{{ url('products/' . $product->slug) }}">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section> --}}
    @if($faqCategory)
        @include('common.faqs', ['faqs' => $faqCategory->faqs]);
    @endif

@endsection
