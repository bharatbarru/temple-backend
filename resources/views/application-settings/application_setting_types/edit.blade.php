@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Edit Application Setting Type
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($applicationSettingType, ['route' => ['applicationSettingTypes.update', $applicationSettingType->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('application-settings.application_setting_types.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                @include('common.cancel-button-with-sweet-alert', ['route' => route('applicationSettingTypes.index')])
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
