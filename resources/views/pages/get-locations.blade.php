@php
    $ourLocations = getServiceCategory('locations');
@endphp
@if ($ourLocations)

@if ($ourLocations->display_name || $ourLocations->tagline )
<div class=" text-center">
    <h2 class="font-color section-title title-center">{{ $ourLocations->display_name }}</h2>
    <p class="font-color">{!! $ourLocations->tagline !!}</p>
</div>
@endif




            <div class="row mt-5">
                @foreach ($ourLocations->services as $ourLocation)
                    <div class="col-md-4 mb-3">
                        <div class="card card-body bg-tertiary h-100 text-light pb-0">
                            <div class="text-center">
                                <div class="badge badge-top badge-primary "><span class="material-symbols-outlined">
                                        location_on
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex w-100 my-3 border-bottom pb-1">
                                <div class="icon">
                                    <span class="material-symbols-outlined">
                                        location_on
                                    </span>
                                </div>
                                <div>
                                    <h4>{{ $ourLocation->sub_title }}</h4>
                                    {!! $ourLocation->short_description !!}
                                </div>
                            </div>
                            @if ($ourLocation->video_url)
                            <div class="d-flex w-100 my-1 border-bottom pb-3 align-items-center">
                                <div class="icon">
                                    <span class="material-symbols-outlined">
                                        email
                                    </span>
                                </div>
                                <div>
                                    <a href="tel:{{ $ourLocation->video_url }}" class="h6">{{ $ourLocation->video_url }}</a>
                                </div>
                            </div>
                            @endif
                            <div class="d-flex w-100 my-3 border-bottom pb-3 align-items-center">
                                <div class="icon">
                                    <span class="material-symbols-outlined">
                                        phone
                                    </span>
                                </div>
                                <div>
                                    <a href="mailto:{{ $ourLocation->icon }}" class="h5">{{ $ourLocation->icon }}</a>
                                </div>
                            </div>

                              @if ($ourLocation->url)
                            <a href="{{ $ourLocation->custom_url }}" class="btn btn-outline-white text-light" @if ($ourLocation->new_window == 'yes') target="_blank" @endif >
                                Get Location
                            </a>
                            @endif

                            @if ($ourLocation->description)
                            <div class="map mt-3">
                                {!! $ourLocation->description !!}
                            </div>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>
      
@endif
