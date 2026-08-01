@php
    $latestNews = latestNews();
@endphp
@if ($latestNews)
    <section class="our-services pt-3 pb-2">
        <div class="container">
            <div class="text-center">
            <h2 class="lead font-700 text-tertiary title-center mb-5">Latest News</h2>
            </div>
            <div class="mt-5 row our-service-list">
                @foreach ($latestNews as $news)
                    <div class="col-md-4 text-center block mb-3" data-aos="fade-in" data-aos-duration="1500">
                        <div class="card h-100 transition">
                            <div class="card-body d-flex flex-column">
                                <div class="flex-grow-1 lead">
                                    {{ $news->title }}
                                </div>
                                <div class="flex-grow-1 lead">
                                    {{ $news->short_description }}
                                </div>
                                <div class="text-center">
                                    <a class="btn btn-default d-inline-block font-400" href="{{ url('news/'. $news->slug) }}">
                                        <span class="material-symbols-outlined">
                                            add
                                        </span>
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
