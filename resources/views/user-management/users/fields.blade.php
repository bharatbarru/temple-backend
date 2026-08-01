<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Name', ['class' => 'span-required']) !!}
    {!! Form::text('name', null, ['class' => 'form-control letters-input', 'required']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-4">
    {!! Form::label('email', 'Email', ['class' => 'span-required']) !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'required', 'autocomplete' => 'off']) !!}




</div>

<!-- Mobile Field -->
<div class="form-group col-sm-4">
    {!! Form::label('mobile', 'Mobile') !!}
    {!! Form::text('mobile', null, [
        'class' => 'form-control digits-input',
    
        'minlength' => 10,
        'maxlength' => 10,
    ]) !!}
</div>

<!-- Role Field -->
<div class="form-group select-required select2-group col-sm-6">

    {!! Form::label('role', 'Select Role') !!}
    <select class="form-control select2" name="role" required>
        <option value="">Select Role</option>
        @foreach ($roles as $role)
            <option {{ isset($user) ? ($user->hasRole($role->name) ? 'selected' : '') : '' }}>{{ $role->name }}
            </option>
        @endforeach
    </select>
</div>

<!-- Address Field -->
<div class="form-group col-sm-12">
    {!! Form::label('address', 'Address') !!}
    {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
</div>

@if (!isset($user))
    <!-- Password Field -->
    <div class="form-group col-sm-4">

        {!! Form::label('password', 'Password', ['class' => 'span-required']) !!}

        {!! Form::password('password', [
            'class' => 'form-control',
            'id' => 'password',
            'autocomplete' => 'off',
            'required',
            'data-parsley-minlength' => '8',
        ]) !!}
    </div>

    <!-- Confirmation Password Field -->
    <div class="form-group col-sm-4">

        {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'span-required']) !!}

        {!! Form::password('password_confirmation', [
            'class' => 'form-control',
            'autocomplete' => 'off',
            'required',
            'data-parsley-equalto' => '#password',
        ]) !!}
    </div>
@endif
