@extends('layouts.app')

@section('content')
    @php
        $heading = request()->get('type') ? request()->get('type') : request()->get('main');
    @endphp
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        {{ ucwords(str_replace('-', ' ', $heading)) }} Details
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right" href="{{ route('services.index') . '?type=' . request()->get('type') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('services.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
