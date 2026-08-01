@php
    $ourCaterings = getServiceCategory('caterings');
@endphp
@if ($ourCaterings)
@if ($ourCaterings->display_name || $ourCaterings->tagline )
    <div class="section-title text-center">
        <h2 class="font-color">{{ $ourCaterings->display_name }}</h2>
        <p class="font-color">{!! $ourCaterings->tagline !!}</p>
    </div>
@endif
<div class="caterings-list">
    @foreach ($ourCaterings->services as $ourCatering)
        <div class="row mt-5 align-items-center justify-content-around block">
            <div class="col-md-5 col-xl-6 mb-4 mb-md-0 pic">
                <img class="w-100 shadow-3d" src="{{ asset(SERVICE_IMAGE_PATH . $ourCatering->image) }}"
                    alt="{{ $ourCatering->image_alt_text }}">
            </div>
            <div class="col-md-7 col-xl-6 content">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10">
                        <div class="my-3"><span class="h1 font-color">{{ $ourCatering->title }}</span></div>
                        {!! $ourCatering->description !!}
                        @if ($ourCatering->custom_url)
                        <a class="btn btn-primary mt-5" href="{{ $ourCatering->custom_url }}"
                            @if ($ourCatering->new_window == 'yes') target="_blank" @endif>View Gallery</a>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endif
