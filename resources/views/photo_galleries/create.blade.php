@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                    Create Photo Galleries
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'photoGalleries.store', 'files' => true]) !!}

            <div class="card-body photo_galleries">

                <div class="row">
                    @include('photo_galleries.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                @include('common.cancel-button-with-sweet-alert', ['route' => route('photoGalleries.index')])
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
