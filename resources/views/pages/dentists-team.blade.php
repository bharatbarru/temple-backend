@foreach ($teamCategories as $categories)
    @php
        $teamsInCategory = $teams->where('team_categories_id', $categories->id);
    @endphp
    @if ($teamsInCategory->isNotEmpty())
        <section class="dotors-team">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <span class="small-title">{!! applicationSettings('our-dentist-content-sub-title') !!}</span>
                        <h2 class="h1">{!! applicationSettings('our-dentist-content-title') !!}</h2>
                        {!! applicationSettings('our-dentist-content-description') !!}
                        <a href="{{ applicationSettings('our-dentist-content-button-url') }}"
                            class="btn btn-primary">{!! applicationSettings('our-dentist-content-button-text') !!}</a>
                    </div>
                    <div class="col-md-8">
                        <div class="row ">
                            @foreach ($teams as $team)
                                @if ($categories->id == $team->team_categories_id)
                                    <div class="col-md-4 mb-5 aos-init aos-animate" data-aos="fade-up"
                                        data-aos-delay="100">
                                        <div class="card card-lg card-body align-items-center border-0 p-0">
                                            @if ($team->image != '')
                                                <img src="{{ asset(TEAM_IMAGE_PATH . $team->image) }}"
                                                    alt="{{ $team->name }} Image " class="avatar avatar-xlg mb-3">
                                            @else
                                                <img src="{{ asset('images/no-image.jpg') }}" alt="{{ $team->name }}"
                                                    class="avatar avatar-xlg mb-3" />
                                            @endif
                                            <p class="mb-0 h3">{{ $team->name }}</p>
                                            <span>{{ $team->designation }}</span>
                                            <a class="full-link" style="font-size: 0" href="{{ url('our-dentists/' . $team->slug) }}" >View More</a>                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endforeach
<!-- end of team -->
