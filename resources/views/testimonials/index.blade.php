@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Testimonials</h1>
                </div>
                <div class="col-sm-6">
                    @if(auth()->user()->hasPermissionTo('add-testimonials'))
                    <a class="btn btn-primary float-right"
                       href="{{ route('testimonials.create') }}">
                        Add New
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

{{-- @include('flash::message') --}}

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                @livewire('testimonials-table', [])
            </div>
        </div>
    </div>

@endsection
