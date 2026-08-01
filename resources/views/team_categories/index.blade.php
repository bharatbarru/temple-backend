@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Team Categories</h1>
                </div>
                <div class="col-sm-6">                    
                    @if(auth()->user()->hasPermissionTo('add-team_categories'))
                    <a class="btn btn-primary float-right"
                       href="{{ route('teamCategories.create') }}">
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
                @livewire('team-categories-table', [])
            </div>
        </div>
    </div>

@endsection
