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
                <h1 class="display-3">{{ $page->banner_title != '' ? $page->banner_title : $page->title }}</h1>
            </div>
        </div>
    </section>
    {{-- ----------end of inner-banner------------- --}}

    @if ($page->slug == 'reservations')
    @include('pages.book-table')

        @else


<section class="inner-page-content">
    <div class="container">
        {!! $page->content !!}


        
          
        
  </div>
</section>

@endif



@endsection
