{{-- <section class="our-testimonial">

    <img class="left-testi" src="{{ asset('assets/left-testi.svg') }}"  data-aos="fade-in"
  
    data-aos-duration="500"  />
    <img class="right-testi" src="{{ asset('assets/right-testi.svg') }}" data-aos="fade-in"
  
    data-aos-duration="500" />

    <div class="container">
        <h2 class="section-title title-center text-center">What our Customers Say</h2>
        <p class="text-center">Gravida nascetur elementum gravida congue netus neque, dui. Sit eget mattis
            <br />nisilacus duis nulla accumsan viverra vulputate. A ut pretium ullamcorper.</p>
        <div class="mt-5 our-testimonial-list">
            @if ($testimonials->count() > 0)
                <div class="row testimonials-card-list">
                    @php $testimonialCount = 0; @endphp
                    @foreach ($testimonials as $testimonial)
                        @if ($testimonialCount < 3)
                            <div class="col-md-4 mb-3 inner" data-aos="fade-up"
                            data-aos-anchor-placement="center-bottom">
                                <div class="card card-body h-100 pb-0">
                                    <div class="flex-grow-1 ">
                                        <div class="row justify-content-between align-items-center mb-3">
                                            <img style="max-width: 80px" src="{{ asset('assets/google-r.svg') }}"
                                                alt="Google Review" />
                                            <div class="rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <svg class="{{ $testimonial->rating >= $i ? 'active' : '' }}"
                                                        width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M7.87317 1.5625C8.24817 0.8125 9.31067 0.84375 9.65442 1.5625L11.7169 5.71875L16.2794 6.375C17.0919 6.5 17.4044 7.5 16.8107 8.09375L13.5294 11.3125L14.3107 15.8438C14.4357 16.6562 13.5607 17.2812 12.8419 16.9062L8.77942 14.75L4.68567 16.9062C3.96692 17.2812 3.09192 16.6562 3.21692 15.8438L3.99817 11.3125L0.716917 8.09375C0.123167 7.5 0.435667 6.5 1.24817 6.375L5.84192 5.71875L7.87317 1.5625Z"
                                                            fill="#DFE1E3" />
                                                    </svg>
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="description">
                                            <p>
                                                "{!! \Illuminate\Support\Str::limit(strip_tags($testimonial->description), 150, '...') !!}"
                                            </p>
                                        </div>
                                        <p class="lead text-primary font-700">{{ $testimonial->name }}</p>
                                    </div>
                                </div>
                            </div>
                            @php $testimonialCount++; @endphp
                        @endif
                    @endforeach
                </div>
                @if ($testimonials->count() > 3)
                    <div class="text-center mt-5">
                        <a class="btn btn-primary" href="/testimonials">View All Testimonials</a>
                    </div>
                @endif
            @endif
        </div>
    </div>
</section> --}}
