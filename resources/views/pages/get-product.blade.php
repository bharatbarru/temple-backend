{{-- {{ url('products/' . $product->slug) }} --}}

<section class="our-products-section">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title  mb-5">Special Menu </h2>
        </div>
        <div class="products-list row">
            @foreach ($specialProducts->take(4) as $product)
                <div class="col-md-3 mb-3">
                    <a href="{{ url('/menu') }}" class="card text-center h-100">
                        <div class="card-body">
                            <figure class="circle-thumnail">


                                @if ($product->image)
                                <img src="{{ asset(PRODUCT_IMAGE_PATH . $product->image) }}" alt="{{ $product->title }}"
                                class="object-fit-cover object-fit-center-postion w-100 h-100" />
                                @else
                                <img src="{{ asset('assets/no-image-aval.webp') }}" alt="{{ $product->title }}"
                                class="object-fit-cover object-fit-center-postion w-100 h-100" /> 
                                @endif

                               




                            </figure>
                            <h4 class="font-700"> {{ $product->title }}</h4>
                            <p class="h5 font-700 mt-4 mb-4 text-primary"> {{ formatAmount($product->price) }} </p>
                            <span class="btn btn-primary left-ani-btn">Order Now</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
