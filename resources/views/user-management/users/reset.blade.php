@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Reset Password
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <form method="POST" action="{{ url('admin/users/reset') }}">
                <div class="card-body">
                    <div class="row">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $id }}">

                        <div class="form-group col-lg-6">
                            <label for="name" class="span-required">New Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="New Password" required data-parsley-minlength="8">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="name" class="span-required">Confirm Password</label>
                            <input type="password" class="form-control" id="cpassword" name="cpassword"
                                placeholder="Confirm Password" required data-parsley-equalto="#password">
                        </div>
                    </div>


                    <div class="card-buttons">
                        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
                    </div>
                    <!-- /.box-body -->
                </div>
            </form>
        </div>
    </div>
@endsection
