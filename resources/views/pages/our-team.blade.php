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
                <h1 class="display-2">{{ $page->banner_title != '' ? $page->banner_title : $page->title }}</h1>
            </div>
        </div>
    </section>
    {{-- ----------end of inner-banner------------- --}}
    <section class="our-team">
        <div class="container">
            @foreach ($teamCategories as $categories)
                @php
                    $teamsInCategory = $teams->where('team_categories_id', $categories->id);
                @endphp
                @if ($teamsInCategory->isNotEmpty())
                    <div class="team-list">
                        <div class="section-title text-center">
                            <h2 class="font-color"> {{ $categories->name }}</h2>
                        </div>
                        <div class="row mb-5">
                            @foreach ($teams->sortBy('sort') as $team)
                                @if ($categories->id == $team->team_categories_id || $team->publish == 1)
                                    <div class="col-md-4 mb-3">
                                        <div class="card card-icon-2  justify-content-center shadow-3d  text-center ">
                                            <figure class="m-0"> <img src="{{ asset(TEAM_IMAGE_PATH . $team->image) }}"
                                                    alt="{{ $team->name }} Image " class="w-100"></figure>
                                            <div class="cards-inner p-2">
                                                <h5 class="mb-0 font-color">{{ $team->name }}</h5>
                                                <p>{{ $team->designation }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
    <!-- end of team -->
@endsection
