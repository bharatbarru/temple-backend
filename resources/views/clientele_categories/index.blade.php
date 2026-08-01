@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Clientele Categories</h1>
                </div>

                <div class="col-sm-6">
                    @if (auth()->user()->hasPermissionTo('add-clientele_categories'))
                        <a class="btn btn-primary float-right" href="{{ route('clienteleCategories.create') }}">
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
                @livewire('clientele-categories-table', [])
            </div>
        </div>
    </div>
@endsection
