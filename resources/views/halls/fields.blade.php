<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>

<!-- Image Field -->
@include('common.image.single-image', ['field_label' => 'Image', 'field_name' => 'image', 'data' => isset($hall) ? $hall->image : null, 'path' => HALL_IMAGE_PATH])

<!-- Image Alt Text Field -->
<div class="form-group col-sm-4">
    {!! Form::label('image_alt_text', 'Image Alt Text:') !!}
    {!! Form::text('image_alt_text', null, ['class' => 'form-control', 'maxlength' => 255, 'readonly']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'maxlength' => 65535]) !!}
</div>

@include('common.editor', ['field' => 'description'])

<!-- Cost Table -->
<div class="form-group col-sm-12">
    <label>Event Costs</label>
    <table class="table table-bordered" style="width: 50%">
        <thead>
            <tr>
                <th>Day Name</th>
                <th>1-Day Cost</th>
                <th>Multiple-Day Cost (Per Day)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
            @endphp
            @foreach ($days as $day)
                <tr>
                    <td>{{ ucfirst($day) }}</td>
                    <td>
                        {!! Form::text("{$day}_cost", null, ['class' => 'form-control numbers-input', 'required']) !!}
                    </td>
                    <td>
                        {!! Form::text("{$day}_three_day_cost", null, ['class' => 'form-control numbers-input', 'required']) !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
