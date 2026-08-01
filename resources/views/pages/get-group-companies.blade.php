@php
    $groupCompanies = getClienteleCategory('group-companies');
@endphp
@if ($groupCompanies)
    <section class="group-companies pt-0">
        <div class="container">
            <div class="section-title text-center ">
                <h2>{{ $groupCompanies->display_name }}</h2>
                <p class="font-color">{{ $groupCompanies->tagline }}</p>
            </div>
            <div class="four-items-slider our-brands-list mt-5">
                @foreach ($groupCompanies->clienteles as $groupCompany)
                    <div class="item ">
                        <div class="card text-center mx-2 p-3">
                            @if ($groupCompany->url)
                                <a class="d-block" href="{{ $groupCompany->url }}" @if ($groupCompany->new_window == 'yes') target="_blank" @endif >
                                    <figure class="m-0 p-2"> <img class="m-auto d-block"
                                            src="{{ asset(CLIENTELE_IMAGE_PATH . $groupCompany->image) }}"
                                            alt="{{ $groupCompany->image_alt_text }}"></figure>
                                    <p class="lead font-color">{{ $groupCompany->title }}</p>
                                </a>
                            @else
                                <figure class="m-0 p-2"> <img class="m-auto d-block"
                                        src="{{ asset(CLIENTELE_IMAGE_PATH . $groupCompany->image) }}"
                                        alt="{{ $groupCompany->image_alt_text }}"></figure>
                                <p class="lead font-color">{{ $groupCompany->title }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
@endif
</section>
