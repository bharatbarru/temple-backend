@extends('frontend.app')
@section('content')
    
    
    <section class="team-details">
    <div class="container">


<div class="row align-items-center">
    <div class="left-team"> 
    <figure>
        <img src="{{ asset(TEAM_IMAGE_PATH . $team->image) }}"
        alt="{{ $team->name }} Image " class="img-fluid m-auto"></figure>
      
    
    </div>
    <div class="col right-team">
        <nav  aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ url('/our-dentists') }}">{!! applicationSettings('team-title') !!}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $team->name }}</li>
            </ol>
        </nav>
        
        <h1 class="display-3 text-primary">{{ $team->name }}</h1>
        <p class="h4">{{ $team->designation }}</p></div>

    <div class="col-md-12 bottom-team">{!! $team->description !!}</div>


</div>



       
    </div>
      
    </section>

@endsection
