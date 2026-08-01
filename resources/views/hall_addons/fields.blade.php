<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', isset($hallAddon) ? $hallAddon->name : null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>


{{-- <div class="form-group col-sm-4">
    {!! Form::label('event_type', 'Event Type:') !!}
    <div class="form-check">
        {!! Form::radio('event_type', 'one_day', isset($hallAddon) && $hallAddon->event_type == 'one_day', ['class' => 'form-check-input', 'id' => 'one_day', 'required']) !!}
        {!! Form::label('one_day', 'One Day Event', ['class' => 'form-check-label']) !!}
    </div>
    <div class="form-check">
        {!! Form::radio('event_type', 'three_day', isset($hallAddon) && $hallAddon->event_type == 'three_day', ['class' => 'form-check-input', 'id' => 'three_day']) !!}
        {!! Form::label('three_day', 'Three Day Event', ['class' => 'form-check-label']) !!}
    </div>
</div> --}}

<!-- Image Field -->
@include('common.image.single-image', ['field_label' => 'Image', 'field_name' => 'image', 'data' => isset($hallAddon) ? $hallAddon->image : null, 'path' => HALL_ADDON_IMAGE_PATH])

<!-- Image Alt Text Field -->
<div class="form-group col-sm-4">
    {!! Form::label('image_alt_text', 'Image Alt Text:') !!}
    {!! Form::text('image_alt_text', isset($hallAddon) ? $hallAddon->image_alt_text : null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>





<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', isset($hallAddon) ? $hallAddon->description : null, ['class' => 'form-control', 'maxlength' => 65535]) !!}
</div>

<!-- Hall Cost Table -->
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Hall Name</th>
                <th>Monday Cost</th>
                <th>Tuesday Cost</th>
                <th>Wednesday Cost</th>
                <th>Thursday Cost</th>
                <th>Friday Cost</th>
                <th>Saturday Cost</th>
                <th>Sunday Cost</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($halls as $hall)
                @php
                    $costs = isset($hallAddon) ? $hallAddon->hallAddonCosts->where('hall_id', $hall->id)->first() : null;
                @endphp
                <tr>
                    <td>{{ $hall->name }}</td>
                    @foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                        <td>
                            {!! Form::text("costs[{$hall->id}][{$day}]", $costs ? $costs->{$day . '_cost'} : null, ['class' => 'form-control numbers-input', 'required']) !!}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('common.editor', ['field' => 'description'])
