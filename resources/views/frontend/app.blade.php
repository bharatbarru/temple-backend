<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    {{-- ----------viewport mobile responsive-------------- --}}
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    {{-- ----------viewport mobile responsive end-------------- --}}
    {{-- ----------favicon-------------- --}}
    <link rel="icon" type="image/x-icon"
        href="{{ asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('favicon')) }}" />
    <link rel="apple-touch-icon" href="{{ asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('favicon')) }}">
    {{-- ----------favicon end-------------- --}}
    {{-- ----------meta seo-------------- --}}
    <title>@yield('seotitle')</title>
    <meta name='keywords' content="@yield('seokeywords')">
    <meta name="description" content="@yield('seodescription')">
    <meta name="author" content="{{ applicationSettings('site-name') }}" />
    {{-- ----------meta seo end-------------- --}}
    {{-- ----------og seo-------------- --}}
    <meta property="og:title" content="{{ applicationSettings('og-title') }}" />
    <meta property="og:site_name" content="{{ applicationSettings('site-name') }}" />
    <meta property="og:description" content="{{ applicationSettings('og-description') }}" />
    <meta property="og:type" content="{{ applicationSettings('og-type') }}">
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('og-image')) }}" />
    {{-- ----------og seo end-------------- --}}
    {{-- ----------meta twitter -------------- --}}
    <meta name="twitter:title" content="{!! applicationSettings('twitter-title') !!}">
    <meta name="twitter:card" content="{!! applicationSettings('twitter-card') !!}">
    <meta name="twitter:image"
        content="{{ asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('meta-twitter-image')) }}" />
    {{-- ----------meta twitter end-------------- --}}
    {{-- ----------fb:app_id -------------- --}}
    <meta property="fb:app_id" content="{!! applicationSettings('fb-app-id') !!}" />
    {{-- ----------fb:app_id end -------------- --}}
    {{-- ----------verification -------------- --}}
    <meta name="google-site-verification" content="{!! applicationSettings('google-site-verification-code') !!}" />
    <!-- Google tag (gtag.js) -->
    {{-- <script async src="https://www.googletagmanager.com/gtag/js?id={!! strip_tags(applicationSettings('google-analytics-code')) !!}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', '{!! strip_tags(applicationSettings('google-analytics-code')) !!}');
        </script> --}}
    {!! applicationSettings('metricool') !!}
    {{-- ----------verification end -------------- --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style type="text/css">
        :root {
            --primary-color: {{ applicationSettings('primay-color') }};
            --secondary-color: {{ applicationSettings('secondary-color') }};
            --tertiary-color: {{ applicationSettings('tertiary-color') }};
            --link-color: {{ applicationSettings('link-color') }};
            --font-color: {{ applicationSettings('font-color') }};
        }
    </style>
    @vite('resources/frontend/scss/app.scss')
    @yield('page_styles')
    <link rel=“stylesheet” href=“https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css”>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
</head>

<body class="@yield('pageclassname')">
    <div class="loader">
        <div class="loading-animation"></div>
    </div>
    <header class="position-absolute navbar-expand-lg w-100 transition" data-sticky="top">
        @include('pages.frontend-menu')
    </header>
    @yield('content')
    @include('pages.footer')
    <a href="#" class="btn back-to-top btn-primary btn-round" data-smooth-scroll data-aos="fade-up"
        data-aos-offset="2000" data-aos-mirror="true" data-aos-once="false">
        <span class="material-symbols-outlined">
            arrow_upward
        </span>
    </a>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap.js') }}"></script>
    <!-- AOS (Animate On Scroll - animates elements into view while scrolling down) -->
    <script type="text/javascript" src="{{ asset('frontend/js/aos.js') }}"></script>
    <!-- Clipboard (copies content from browser into OS clipboard) -->
    <script type="text/javascript" src="{{ asset('frontend/js/clipboard.min.js') }}"></script>
    <!-- Fancybox (handles image and video lightbox and galleries) -->
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.fancybox.min.js') }}"></script>
    <!-- Flatpickr (calendar/date/time picker UI) -->
    <script type="text/javascript" src="{{ asset('frontend/js/flatpickr.min.js') }}"></script>
    <!-- Flickity (handles touch enabled carousels and sliders) -->
    <script type="text/javascript" src="{{ asset('frontend/js/flickity.pkgd.min.js') }}"></script>
    <!-- Ion rangeSlider (flexible and pretty range slider elements) -->
    <script type="text/javascript" src="{{ asset('frontend/js/ion.rangeSlider.min.js') }}"></script>
    <!-- Isotope (masonry layouts and filtering) -->
    <script type="text/javascript" src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
    <!-- jarallax (parallax effect and video backgrounds) -->
    <script type="text/javascript" src="{{ asset('frontend/js/jarallax.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jarallax-video.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jarallax-element.min.js') }}"></script>
    <!-- jQuery Countdown (displays countdown text to a specified date) -->
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
    <!-- jQuery smartWizard facilitates steppable wizard content -->
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.smartWizard.min.js') }}"></script>
    <!-- Plyr (unified player for Video, Audio, Vimeo and Youtube) -->
    <script type="text/javascript" src="{{ asset('frontend/js/plyr.polyfilled.min.js') }}"></script>
    <!-- Prism (displays formatted code boxes) -->
    <script type="text/javascript" src="{{ asset('frontend/js/prism.js') }}"></script>
    <!-- ScrollMonitor (manages events for elements scrolling in and out of view) -->
    <script type="text/javascript" src="{{ asset('frontend/js/scrollMonitor.js') }}"></script>
    <!-- Smooth scroll (animation to links in-page)-->
    <script type="text/javascript" src="{{ asset('frontend/js/smooth-scroll.polyfills.min.js') }}"></script>
    <!-- SVGInjector (replaces img tags with SVG code
        to allow easy inclusion of SVGs with the benefit of inheriting colors and styles)-->
    <script type="text/javascript" src="{{ asset('frontend/js/svg-injector.umd.production.js') }}"></script>
    <!-- TwitterFetcher (displays a feed of tweets from a specified account)-->
    <script type="text/javascript" src="{{ asset('frontend/js/twitterFetcher_min.js') }}"></script>
    <!-- Typed text (animated typing effect)-->
    <script type="text/javascript" src="{{ asset('frontend/js/typed.min.js') }}"></script>
    <!-- Slick Slider-->
    <script type="text/javascript" src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/custom-slick.js') }}"></script>
    <!-- Required theme scripts (Do not remove) -->
    <script type="text/javascript" src="{{ asset('frontend/js/theme.js') }}"></script>
    <!--parsley-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @stack('page_scripts')
    <script>
        // Page load class addition for body
        window.addEventListener("load", function() {
            document.querySelector('body').classList.add('loaded');
        });
        // Parsley form validation initialization
        $("form").parsley();
    </script>
    <script>
        // Sticky menu for picture section (For .menu-positions-pics)
        document.addEventListener("DOMContentLoaded", function() {
            var menuPosition = document.querySelector('.menu-positions-pics');
            if (menuPosition) { // Check if element exists
                var stickyOffset = menuPosition.offsetTop;

                function handleScroll() {
                    if (window.pageYOffset > stickyOffset) {
                        menuPosition.classList.add('pics-sticky'); // Add sticky class when scrolling past
                    } else {
                        menuPosition.classList.remove('pics-sticky'); // Remove sticky class when above
                    }
                }
                window.addEventListener('scroll', handleScroll); // Apply sticky menu on scroll
            }
        });
    </script>
    <!-- Category Filter and Product Display for the First Page (show-mobile section) -->
    <script>
        // Category filter for mobile view (First Page - show-mobile section)
        document.addEventListener('DOMContentLoaded', function() {
            const categoryFilter1 = document.getElementById('categoryFilter');
            const productCategories1 = document.querySelectorAll('.product-category');
            // Initially show all categories
            productCategories1.forEach(category => category.style.display = 'block');
            // Event listener for dropdown filter
            if (categoryFilter1) {
                categoryFilter1.addEventListener('change', function() {
                    const selectedCategory = this.value;
                    if (selectedCategory === 'all') {
                        productCategories1.forEach(category => category.style.display = 'block');
                    } else {
                        productCategories1.forEach(category => {
                            if (category.id === `category-${selectedCategory}`) {
                                category.style.display = 'block';
                            } else {
                                category.style.display = 'none';
                            }
                        });
                    }
                });
            }
        });
    </script>
    <!-- Category Filter and Product Display for the Second Page (mobile-show section) -->
    <script>
        // Category filter for mobile view (Second Page - mobile-show section)
        document.addEventListener('DOMContentLoaded', function() {
            const categoryFilter2 = document.getElementById('category-select');
            const productCategories2 = document.querySelectorAll('.menu-page-lists.product-category');
            // Initially show all categories
            productCategories2.forEach(category => category.style.display = 'block');
            // Event listener for dropdown filter
            if (categoryFilter2) {
                categoryFilter2.addEventListener('change', function() {
                    const selectedCategory = this.value;
                    if (selectedCategory === 'all') {
                        productCategories2.forEach(category => category.style.display = 'block');
                    } else {
                        productCategories2.forEach(category => {
                            if (category.dataset.category === selectedCategory) {
                                category.style.display = 'block';
                            } else {
                                category.style.display = 'none';
                            }
                        });
                    }
                });
            }
        });
    </script>
    <script>
        // Scrollable tabs using arrows and mouse wheel
        document.addEventListener("DOMContentLoaded", function() {
            var scrollContainer = document.querySelector('.tabs-scrollable');
            var leftArrow = document.getElementById('scroll-left');
            var rightArrow = document.getElementById('scroll-right');
            var scrollAmount = 200; // Adjust the scroll amount for each arrow click
    
            if (scrollContainer) {
                // Handle left arrow click
                leftArrow.addEventListener('click', function() {
                    scrollContainer.scrollBy({
                        left: -scrollAmount,
                        behavior: 'smooth'
                    });
                });
    
                // Handle right arrow click
                rightArrow.addEventListener('click', function() {
                    scrollContainer.scrollBy({
                        left: scrollAmount,
                        behavior: 'smooth'
                    });
                });
    
                // Handle mouse wheel scroll (both directions)
                scrollContainer.addEventListener('wheel', function(event) {
                    event.preventDefault(); // Prevent default scroll behavior
    
                    // Check if horizontal scroll (deltaX) or vertical scroll (deltaY)
                    if (event.deltaX !== 0) {
                        // Scroll horizontally based on wheel direction
                        scrollContainer.scrollBy({
                            left: event.deltaX < 0 ? -scrollAmount : scrollAmount,
                            behavior: 'smooth'
                        });
                    } else {
                        // For vertical scrolling, act as horizontal scroll
                        scrollContainer.scrollBy({
                            left: event.deltaY < 0 ? -scrollAmount : scrollAmount,
                            behavior: 'smooth'
                        });
                    }
                });
            }
        });
    </script>
    
</body>

</html>
