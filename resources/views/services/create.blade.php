@extends('layouts.app')

@section('content')
    @php
        $heading = request()->get('type') ? request()->get('type') : request()->get('main');
    @endphp

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                    Create {{ ucwords(str_replace('-', ' ', $heading)) }}
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'services.store', 'files' => true]) !!}

            <div class="card-body">

                <div class="row">
                    @include('services.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('services.index') . '?type=' . request()->get('type') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
