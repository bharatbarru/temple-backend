@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                    Create Roles
                    </h1>
                </div>
                <div class="select-permissions">
                    <input type="checkbox" id="select-all">
                    <label for="select-all"> Select All </label>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'roles.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('user-management.roles.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                @include('common.cancel-button-with-sweet-alert', ['route' => route('roles.index')])
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
