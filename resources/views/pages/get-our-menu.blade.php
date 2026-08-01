<section class="our-menu-section">
    <div class="container">
        <div class="section-head text-center">
            <h2 class="section-title mb-5">From Our Menu</h2>
        </div>

        <!-- Desktop View -->
        <div class="hide-mobile">
            @if ($productCategories->count() > 0)
                <div class="row justify-content-center mt-5">
                    <div class="col">
                        <div class="row mb-3 align-items-center">
                            <div class="col-md-10">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" id="menuTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tab-all" data-toggle="tab" href="#content-all" 
                                           role="tab" aria-controls="content-all" aria-selected="true">
                                            All 
                                        </a>
                                    </li>
                                    @foreach ($productCategories as $index => $productCategory)
                                        <li class="nav-item">
                                            <a class="nav-link" id="tab-{{ $productCategory->id }}" 
                                               data-toggle="tab" href="#content-{{ $productCategory->id }}" 
                                               role="tab" aria-controls="content-{{ $productCategory->id }}" 
                                               aria-selected="false">
                                                {{ $productCategory->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col text-right">
                                <a href="{{ url('/menu') }}" class="btn btn-white btn-lg custom-button" tabindex="0">
                                    <span class="span-text" data-text="Menu">Menu</span>
                                </a>
                            </div>
                        </div>
        
                        <!-- Tab panes -->
                        <div class="tab-content" id="menuTabContent">
                            <!-- All Categories Tab Content -->
                            <div class="tab-pane fade show active" id="content-all" role="tabpanel" aria-labelledby="tab-all">
                                <div class="row">
                                    @foreach ($productCategories as $productCategory)
                                        @foreach ($productCategory->products->where('special_product', 1)->take(3) as $product)
                                            <div class="col-md-4 mb-3">
                                                <a href="{{ url('/menu') }}"  class="card text-center shadow h-100 mb-0">
                                                    <figure class="thumbnail m-0">
                                                        @if ($product->image)
                                                            <img src="{{ asset(PRODUCT_IMAGE_PATH . $product->image) }}" 
                                                                 alt="{{ $product->title }}" 
                                                                 class="w-100 h-100 object-fit-cover" />
                                                        @else
                                                            <img src="{{ asset('assets/no-image-aval.webp') }}" 
                                                                 alt="{{ $product->title }}" 
                                                                 class="w-100 h-100 object-fit-cover" />
                                                        @endif
                                                    </figure>
                                                    <div class="card-body align-items-start">
                                                        <div class="mb-1">
                                                            <h5 class="font-700">{{ $product->title }}</h5>
                                                        </div>
                                                        <div class="des mb-3">
                                                            {!! \Illuminate\Support\Str::limit(strip_tags($product->short_description), 80, '...') !!}
                                                        </div>
                                                        <div class="h4"> {!! formatAmount($product->price) !!}</div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
        
                            <!-- Individual Categories Tab Content -->
                            @foreach ($productCategories as $index => $productCategory)
                                <div class="tab-pane fade" id="content-{{ $productCategory->id }}" role="tabpanel" 
                                     aria-labelledby="tab-{{ $productCategory->id }}">
                                    <div class="row">
                                        @foreach ($productCategory->products->where('special_product', 1)->take(3) as $product)
                                            <div class="col-md-4 mb-3">
                                                <a href="{{ url('/menu') }}"  class="card text-center shadow h-100 mb-0">
                                                    <figure class="thumbnail m-0">
                                                        @if ($product->image)
                                                            <img src="{{ asset(PRODUCT_IMAGE_PATH . $product->image) }}" 
                                                                 alt="{{ $product->title }}" 
                                                                 class="w-100 h-100 object-fit-cover" />
                                                        @else
                                                            <img src="{{ asset('assets/no-image-aval.webp') }}" 
                                                                 alt="{{ $product->title }}" 
                                                                 class="w-100 h-100 object-fit-cover" />
                                                        @endif
                                                    </figure>
                                                    <div class="card-body align-items-start">
                                                        <div class="mb-1">
                                                            <h5 class="font-700">{{ $product->title }}</h5>
                                                        </div>
                                                        <div class="des mb-3">
                                                            {!! \Illuminate\Support\Str::limit(strip_tags($product->short_description), 80, '...') !!}
                                                        </div>
                                                        <div class="h4"> {!! formatAmount($product->price) !!}</div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
        
                                    <!-- View More Button if there are more than 3 products -->
                                    @if ($productCategory->products->where('special_product', 1)->count() > 3)
                                        <div class="text-center mt-3">
                                            <a href="{{ url('/menu') }}" class="btn btn-white btn-lg custom-button">
                                                View More
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
        

        <!-- Mobile View -->
        <div class="show-mobile">
            @if ($productCategories->count() > 0)
                <!-- Dropdown for Category Selection -->
                <select id="categoryFilter" class="form-control mb-3">
                    <option value="all">All</option>
                    @foreach ($productCategories as $productCategory)
                        <option value="{{ $productCategory->id }}">{{ $productCategory->name }}</option>
                    @endforeach
                </select>
        
                <!-- Product Categories and Products -->
                @foreach ($productCategories as $productCategory)
                    <div class="col-md-4 product-category mb-3" id="category-{{ $productCategory->id }}">
                        @foreach ($productCategory->products->where('special_product', 1)->take(6) as $product)
                            <a href="{{ url('/menu') }}" class="card text-center shadow h-100 mb-0">
                                <figure class="thumbnail m-0">
                                    <img src="{{ $product->image ? asset(PRODUCT_IMAGE_PATH . $product->image) : asset('assets/no-image-aval.webp') }}"
                                         alt="{{ $product->title }}" class="w-100 h-100 object-fit-cover">
                                </figure>
                                <div class="card-body align-items-start">
                                    <div class="mb-1">
                                        <h5 class="font-700">{{ $product->title }}</h5>
                                    </div>
                                    <div class="des mb-3">
                                        {!! \Illuminate\Support\Str::limit(strip_tags($product->short_description), 80, '...') !!}
                                    </div>
                                    <div class="h4"> 
                                        {!! formatAmount($product->price) !!}
                                    </div>
                                </div>
                            </a>
                        @endforeach
        
                        <!-- View More Button if there are more than 6 products -->
                        @if ($productCategory->products->where('special_product', 1)->count() > 6)
                            <div class="text-center mt-3">
                                <a href="{{ url('/menu') }}" class="btn btn-white btn-lg custom-button">
                                    View More
                                </a>
                            </div>
                        @endif
                    </div>
                @endforeach
        
                <div class="text-center mt-5">
                    <!-- Menu Button -->
                    <a href="{{ url('/menu') }}" class="btn btn-white btn-lg custom-button" tabindex="0">
                        <span class="span-text" data-text="Menu">Menu</span>
                    </a>
                </div>
            @endif
        </div>
        
    </div>
</section>
