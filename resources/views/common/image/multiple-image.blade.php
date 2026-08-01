<div class="form-group col-sm-12">
    <label>{{ $field_label }}</label>

    <div class="input-group image_input">
        <div class="custom-file">
            {!! Form::file($field_name.'[]', [
                'class' => 'custom-file-input',
                'onchange' => 'readURL(this, "image_preview' . $field_name . '")', 'multiple'
            ]) !!}
            {!! Form::label($field_name, $field_label, ['class' => 'custom-file-label']) !!}
        </div>
    </div>

    <div id="image_preview{{ $field_name }}"></div>

    @if ($data != null)
        @foreach (json_decode($data, true) as $key => $image)
            <div class="card">
                <a href="{{ url($route . $key) }}" class="remove-gal-item" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                <img src="{{ asset($path . $image['path']) }}" alt="" width="100">
                {!! Form::text('multiple_alt_text' . $field_name . '[]', $image['alt_text'], ['class' => 'form-control', 'placeholder' => 'Image Alt Text']) !!}
            </div>
        @endforeach
    @endif
</div>

@include('common.image-preview')