@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hall Addons</h1>
                </div>
                <div class="col-sm-6">
                    @if (auth()->user()->hasPermissionTo('add-hall-addons'))
                        <a class="btn btn-primary float-right"
                        href="{{ route('hallAddons.create') }}">
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
                @livewire('hall-addons-table', [])
            </div>
        </div>
    </div>

@endsection
