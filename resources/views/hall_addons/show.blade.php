@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        Hall Addon Details
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right" href="javascript:history.back()">Back</a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            @include('hall_addons.show_fields')
        </div>
    </div>
@endsection
