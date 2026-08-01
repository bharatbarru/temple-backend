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
@section('pageclassname')
    menu-main-page
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
                <h1 class="display-3">{{ $page->banner_title != '' ? $page->banner_title : $page->title }}</h1>
            </div>
        </div>
    </section>
    <div class="menu-positions-pics">
        <img alt="{{ applicationSettingsAltText('menu-left-image') }}"
            src="{{ asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('menu-left-image')) }}"
            class="menu-left-pic an-move-down" />
        <img alt="{{ applicationSettingsAltText('menu-right-image') }}"
            src="{{ asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('menu-right-image')) }}"
            class="menu-right-pic an-move-down" />
    </div>
    <div class="hide-mobile">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col">
                    <div class="product-cat sticky-top mb-3 align-items-center bg-tertiary">
                        <div class="tabs-container">
                            <!-- Left Arrow -->
                            <button class="scroll-arrow left-arrow" id="scroll-left">&lt;</button>
                            <!-- Nav Tabs -->
                            <ul class="nav nav-tabs tabs-scrollable" id="foodmenuTab" role="tablist">
                                <!-- First Tab for All Products -->
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab-all" data-toggle="tab" href="#content-all" role="tab"
                                       aria-controls="content-all" aria-selected="true">All</a>
                                </li>
                                <!-- Dynamically generating tabs for each category -->
                                @foreach ($productCategories->sortBy('sort') as $index => $productCategory)
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab-{{ Str::slug($productCategory->name) }}"
                                           data-toggle="tab" href="#content-{{ Str::slug($productCategory->name) }}" role="tab"
                                           aria-controls="content-{{ Str::slug($productCategory->name) }}" aria-selected="false">
                                            {{ $productCategory->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- Right Arrow -->
                            <button class="scroll-arrow right-arrow" id="scroll-right">&gt;</button>
                        </div>
                    </div>
                    
                    <!-- Tab panes -->
                    <div class="tab-content" id="foodmenuTabContent">
                        <!-- First Tab Pane for All Products -->
                        <div class="tab-pane fade show active" id="content-all" role="tabpanel" aria-labelledby="tab-all">
                            <div class="row" data-isotope-collection data-isotope-id="example-1">

                                @foreach ($productCategories->sortBy('sort') as $productCategory)
                                <div data-isotope-item class="col-4">
                                    <div class="inner  p-2 h-100">
                                        <h5 class=" text-primary font-700 text-uppercase"> {{ $productCategory->name }}
                                        </h5>
                                        <ul class="products-lists">
                                            @foreach ($productCategory->products as $product)
                                                <li>
                                                    <a href="#" class="d-block">
                                                        <div class="row justify-content-between align-items-center">
                                                            <h6 class="col-8 le">
                                                                <span>{{ $product->title }}<span></span></span>
                                                            </h6>
                                                            <hr>
                                                            <p class="col-4 text-primary text-right font-700 font-14">
                                                                <span> {{ formatAmount($product->price) }} </span>
                                                            </p>
                                                        </div>
                                                        <div class="des font-14 font-400">
                                                            {{ $product->short_description }}
                                                        </div>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                     
                           
                              </div>
                            {{-- <div class="row">
                                @foreach ($productCategories->sortBy('sort') as $productCategory)
                                    <div class="col-md-4 mb-3 menu-page-lists">
                                        <div class="inner  p-2 h-100">
                                            <h6 class=" text-primary font-700 text-uppercase"> {{ $productCategory->name }}
                                            </h6>
                                            <ul class="products-lists">
                                                @foreach ($productCategory->products as $product)
                                                    <li>
                                                        <a href="#" class="d-block">
                                                            <div class="row justify-content-between align-items-center">
                                                                <h6 class="col-8 le">
                                                                    <span>{{ $product->title }}<span></span></span>
                                                                </h6>
                                                                <hr>
                                                                <p class="col-4 text-primary text-right font-700 font-14">
                                                                    <span> {{ formatAmount($product->price) }}</span>
                                                                </p>
                                                            </div>
                                                            <div class="des font-14 font-400">
                                                                {{ $product->short_description }}
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div> --}}
                        </div>
                        <!-- Tab Panes for Each Category -->
                        @foreach ($productCategories->sortBy('sort') as $productCategory)
                            <div class="tab-pane fade" id="content-{{ Str::slug($productCategory->name) }}" role="tabpanel"
                                aria-labelledby="tab-{{ Str::slug($productCategory->name) }}">
                                <div class="row justify-content-center">
                                    <div class="col-md-4 mb-3 menu-page-lists">
                                        <div class="inner shadow p-2">
                                            <h5 class=" text-primary font-700 text-uppercase"> {{ $productCategory->name }}
                                            </h5>
                                            <ul class="products-lists">
                                                @foreach ($productCategory->products as $product)
                                                    <li>
                                                        <a href="#" class="d-block">
                                                            <div class="row justify-content-between align-items-center">
                                                                <h6 class="col-8 le">
                                                                    <span>{{ $product->title }}<span></span></span>
                                                                </h6>
                                                                <hr>
                                                                <p class="col-4 text-primary text-right font-700 font-14">
                                                                    <span> {{ formatAmount($product->price) }}</span>
                                                                </p>
                                                            </div>
                                                            <div class="des font-14 font-400">
                                                                {{ $product->short_description }}
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="mobile-show show-mobile pt-0">
        <div class="container">
            <!-- Categories Dropdown -->
            <div class="cat mb-3">
                <h4 class="font-700">Select Categories</h4>
                <select id="category-select" class="form-control">
                    <option value="all">All Categories</option>
                    @foreach ($productCategories->sortBy('sort') as $productCategory)
                        <option value="{{ $productCategory->id }}">{{ $productCategory->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Products List -->
            <div class="products-list">
                @foreach ($productCategories->sortBy('sort') as $productCategory)
                    <div class="mb-3 menu-page-lists product-category" data-category="{{ $productCategory->id }}">
                        <div class="inner shadow p-2">
                            <h5 class="text-primary font-700 text-uppercase"> {{ $productCategory->name }}</h5>
                            <ul class="products-lists">
                                @foreach ($productCategory->products->sortBy('sort') as $product)
                                    <li>
                                        <a href="{{ url('products/' . $product->slug) }}" class="d-block">
                                            @if ($product->price != '')
                                                <div class="row justify-content-between align-items-center">
                                                    <h6 class="col-8 le"><span>{!! $product->title !!}<span></h6>
                                                    <hr />
                                                    <p class="col-4 text-primary text-right font-700 font-14">
                                                        <span>
                                                            {{ formatAmount($product->price) }}</span>
                                                    </p>
                                                </div>
                                            @else
                                                <h6>{!! $product->title !!}</h6>
                                            @endif
                                            <div class="des font-14 font-400"> {!! $product->short_description !!}</div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
