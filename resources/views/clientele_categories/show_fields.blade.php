<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $clienteleCategory->name }}</p>
</div>

<!-- Display Name Field -->
<div class="col-sm-12">
    {!! Form::label('display_name', 'Display Name:') !!}
    <p>{{ $clienteleCategory->display_name }}</p>
</div>

<!-- Tagline Field -->
<div class="col-sm-12">
    {!! Form::label('tagline', 'Tagline:') !!}
    <p>{{ $clienteleCategory->tagline }}</p>
</div>

<!-- Icon Field -->
<div class="col-sm-12">
    {!! Form::label('icon', 'Icon:') !!}
    <p>{{ $clienteleCategory->icon }}</p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $clienteleCategory->type }}</p>
</div>

