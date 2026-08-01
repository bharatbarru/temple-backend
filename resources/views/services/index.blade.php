@extends('layouts.app')

@section('content')
    @php
        $heading = request()->get('type') ? request()->get('type') : request()->get('main');
    @endphp
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ ucwords(str_replace('-', ' ', $heading)) }}</h1>
                </div>
                <div class="col-sm-6">
                    @if(request()->get('type'))
                        <a class="btn btn-primary float-right"
                           href="{{ route('services.create') . '?type=' . request()->get('type') }}">
                            Add New
                        </a>
                    @endif

                    @if(request()->get('main'))
                        <a class="btn btn-primary float-right"
                           href="{{ route('services.create') . '?main=' . request()->get('main') }}">
                            Add New
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                @livewire('services-table', ['type' => request()->get('type'), 'main' => request()->get('main')])
            </div>
        </div>
    </div>

@endsection
