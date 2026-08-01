@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Edit Slider
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($slider, ['route' => ['sliders.update', $slider->id], 'method' => 'patch', 'files' => 'true']) !!}

            <div class="card-body">
                <div class="row">
                    @include('sliders.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                @include('common.cancel-button-with-sweet-alert', ['route' => route('sliders.index')])
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
