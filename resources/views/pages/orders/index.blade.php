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
    order-online-main-page
@endsection
@section('page_styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
@endsection
@section('content')
    {{-- ----------inner-banner------------- --}}
    <section class="bg-dark text-light header-inner p-0 inner-banner">
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
    <section class="pt-5 order-online">
        <a href="{{ url('/cart') }}" class="btn btn-primary  show-mobile mobile-cart-button">View Cart</a>
        <div class="container">
            <div class="product-category-filter mb-3 show-mobile">
                <select id="categoryFilter" class="form-control">
                    <option value="all">Select Categories</option>
                    @foreach ($productCategories->sortBy('sort') as $productCategory)
                        @php
                            $count = $productCategory->products->count();
                        @endphp
                        @if ($count > 0)
                            <option value="{{ Str::slug($productCategory->name) }}">{{ $productCategory->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="card shadow mobile-no-card">
                <div
                    class="row justify-content-end card-header bg-secondary py-2 align-items-center text-light m-0 sticky-top">
                    <div class="col-6 col-md-6 font-700">Menu List</div>
                    <div class="col-6 col-md-2 font-700">Price</div>
                    <div class="col-6 col-md-2 font-700">Quantity</div>
                    <div class="col-6  col-md-2 text-right mob-text-right">
                        <a href="{{ url('/cart') }}" class="btn btn-light pt-2 pb-2">View Cart</a>
                    </div>
                </div>
             <!-- Products list -->
@foreach ($productCategories->sortBy('sort') as $productCategory)
@php
    $count = $productCategory->products->count();
@endphp
@if ($count > 0)
    <div class="category-section" data-category="{{ Str::slug($productCategory->name) }}">
        <div class="card-body pb-0 py-2 category-title">
            <div class="col-md-12">
                <h5 class="m-0 text-secondary"><span>{{ $productCategory->name }}</span></h5>
            </div>
        </div>
        @foreach ($productCategory->products->sortBy('sort') as $index => $product)
            <div class="card-body py-2 {{ $count > 1 && $index + 1 < $count ? 'border-bottom' : '' }}">
                <div class="row product-card">
                    <div class="col-12 col-md-6">
                        <div class="item-title avatar-author align-items-center">
                            <img src="{{ asset($product->image ? PRODUCT_IMAGE_PATH . $product->image : 'assets/no-image-aval.webp') }}"
                                alt="{{ $product->title }}" class="avatar">
                            <div class="ml-2">
                                <h6 class="font-700">{{ $product->title }}</h6>
                                <div class="show-mobile">
                                    @if ($product->price != '')
                                        <h5 class="text-primary font-700"> {{ formatAmount($product->price) }} </h5>
                                    @endif
                                </div>
                                <span>{{ $product->short_description }}</span>
                            </div>
                        </div>
                    </div>
                    <hr class="w-100 show-mobile" />
                    <div class="col-6 col-md-2 font-700 hide-mobile">
                        @if ($product->price != '')
                            <span> {{ formatAmount($product->price) }} </span>
                        @endif
                    </div>
                    <div class="col-6 col-md-2 font-700">
                        <div class="qty-container">
                            <button class="qty-btn-minus btn-light" type="button" data-id="{{ $product->id }}">
                                <span class="material-symbols-outlined">remove</span>
                            </button>
                            <input type="text" name="qty" value="0" class="input-qty"
                                id="qty-{{ $product->id }}" data-id="{{ $product->id }}" />
                            <button class="qty-btn-plus btn-light" type="button" data-id="{{ $product->id }}">
                                <span class="material-symbols-outlined">add</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-6 col-md-2 no-position" align="center">
                        <button type="button" class="btn-sm btn-primary add-to-cart" data-id="{{ $product->id }}" data-qty="1">
                            Add to Cart
                        </button>
                        <button type="button" class="btn btn-remove btn-sm remove-from-cart" data-id="{{ $product->id }}" style="display: none;">
                            <span class="material-symbols-outlined">delete_forever</span>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endforeach
            </div>
        </div>
    </section>



<div class="show-mobile">
    <div class="mobile-footer row justify-content-around align-items-center ">
        <div class="col">
            <a href="{{ url('/menu') }}"><span class="material-symbols-outlined">
                menu
                </span>
            <i>Our Menu</i>
            </a>
        </div>
        <div class="col">
            <a href="{{ url('/cart') }}" class="shopping_cart-link">
                <span class="material-symbols-outlined">shopping_cart</span>
                <!-- Cart count badge -->
                <span class="cart-count badge badge-primary position-absolute" style="right: 12px; top: -5px;">
                    {{ count(session()->get('cart', [])) }}
                </span>
                <i>View Cart</i>
            </a>
        </div>
        <div class="col">
            <a href="{{ url('/reservations') }}">
                <span class="material-symbols-outlined">
                    deck
                    </span>
                    <i>Online Reservations</i>
            </a>
        </div>
    </div>
</div>








@endsection
@push('page_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Update initial cart quantities
            const cart = @json(session('cart', []));
            for (const productId in cart) {
                if (cart.hasOwnProperty(productId)) {
                    const qty = cart[productId].quantity;
                    // Update quantity input field
                    const qtyInput = document.getElementById('qty-' + productId);
                    if (qtyInput) {
                        qtyInput.value = qty;
                    }
                    // Update "Add to Cart" button state
                    const addToCartButton = document.querySelector('.add-to-cart[data-id="' + productId + '"]');
                    const removeFromCartButton = document.querySelector('.remove-from-cart[data-id="' + productId +
                        '"]');
                    if (addToCartButton && qty > 0) {
                        addToCartButton.classList.remove('btn-primary');
                        addToCartButton.classList.add('btn-success');
                        addToCartButton.textContent = 'Added';
                        addToCartButton.disabled = true;
                        removeFromCartButton.style.display = 'block';
                    }
                }
            }
            // Handle Increment and Decrement
            document.querySelectorAll('.qty-btn-plus').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    let qtyInput = document.getElementById('qty-' + productId);
                    let currentQty = parseInt(qtyInput.value);
                    if (isNaN(currentQty)) currentQty = 0;
                    qtyInput.value = currentQty + 1;
                    updateCartAfterChange(productId, qtyInput.value);
                });
            });
            document.querySelectorAll('.qty-btn-minus').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    let qtyInput = document.getElementById('qty-' + productId);
                    let currentQty = parseInt(qtyInput.value);
                    if (isNaN(currentQty)) currentQty = 0;
                    if (currentQty > 1) {
                        qtyInput.value = currentQty - 1;
                        updateCartAfterChange(productId, qtyInput.value);
                    } else if (currentQty === 1) {
                        qtyInput.value = 0;
                        removeFromCart(productId);
                    }
                });
            });
            // Handle Add to Cart button
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    let qtyInput = document.getElementById('qty-' + productId);
                    let currentQty = parseInt(qtyInput.value);
                    if (currentQty <= 0) {
                        qtyInput.value = 1;
                        currentQty = 1;
                    }
                    addToCart(productId, currentQty);
                });
            });
            // Add this code inside the DOMContentLoaded event listener
            document.querySelectorAll('.remove-from-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    removeFromCart(productId);
                });
            });
            // Function to add or update cart
            function updateCartAfterChange(productId, quantity) {
                fetch('{{ url('/add-to-cart') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const addToCartButton = document.querySelector('.add-to-cart[data-id="' +
                                productId + '"]');
                            const removeFromCartButton = document.querySelector('.remove-from-cart[data-id="' +
                                productId + '"]');
                            if (addToCartButton) {
                                addToCartButton.classList.remove('btn-primary');
                                addToCartButton.classList.add('btn-success');
                                addToCartButton.textContent = 'Added';
                                addToCartButton.disabled = true;
                                removeFromCartButton.style.display = 'block';
                            }
                            toastr.success(data.message, 'Success');
                            updateCartCount();
                        } else {
                            toastr.error(data.message, 'Error');
                        }
                    })
                    .catch(error => {
                        toastr.error('An error occurred while updating the cart.', 'Error');
                    });
            }
            // Function to add to cart
            function addToCart(productId, quantity) {
                fetch('{{ url('/add-to-cart') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const addToCartButton = document.querySelector('.add-to-cart[data-id="' +
                                productId + '"]');
                            const removeFromCartButton = document.querySelector('.remove-from-cart[data-id="' +
                                productId + '"]');
                            if (addToCartButton) {
                                addToCartButton.classList.remove('btn-primary');
                                addToCartButton.classList.add('btn-success');
                                addToCartButton.textContent = 'Added';
                                addToCartButton.disabled = true;
                                removeFromCartButton.style.display = 'block';
                            }
                            toastr.success('Added to cart successfully', 'Success');
                            updateCartCount();
                        } else {
                            toastr.error(data.message, 'Error');
                        }
                    })
                    .catch(error => {
                        toastr.error('An error occurred while adding the item to the cart.', 'Error');
                    });
            }
            // Function to remove from cart
            function removeFromCart(productId) {
                fetch('{{ url('/remove-from-cart') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const addToCartButton = document.querySelector('.add-to-cart[data-id="' +
                                productId + '"]');
                            if (addToCartButton) {
                                addToCartButton.classList.remove('btn-success');
                                addToCartButton.classList.add('btn-primary');
                                addToCartButton.textContent = 'Add to Cart';
                                addToCartButton.disabled = false;
                            }
                            toastr.success('Removed from cart', 'Success');
                            const removeFromCartButton = document.querySelector('.remove-from-cart[data-id="' +
                                productId + '"]');
                            removeFromCartButton.style.display = 'none';
                            const qtyInput = document.getElementById('qty-' + productId);
                            if (qtyInput) {
                                qtyInput.value = 0;
                            }

                            updateCartCount();
                        } else {
                            toastr.error(data.message, 'Error');
                        }
                    })
                    .catch(error => {
                        toastr.error('An error occurred while removing the item from the cart.', 'Error');
                    });
            }
        });



        document.addEventListener("DOMContentLoaded", function() {
    var categoryFilter = document.getElementById('categoryFilter');
    var allCategorySections = document.querySelectorAll('.category-section');

    // Function to filter the categories
    function filterCategories(selectedCategory) {
        allCategorySections.forEach(function(section) {
            if (selectedCategory === 'all' || section.getAttribute('data-category') === selectedCategory) {
                section.style.display = 'block'; // Show the matching categories
            } else {
                section.style.display = 'none'; // Hide the non-matching categories
            }
        });
    }

    // Event listener for the category dropdown change
    categoryFilter.addEventListener('change', function() {
        var selectedCategory = categoryFilter.value;
        filterCategories(selectedCategory);
    });

    // Initial display (show all products)
    filterCategories('all');
});



    </script>
@endpush
