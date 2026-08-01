<div class="form-group col-sm-4">
    <label>{{ $field_label }}</label>

    <div class="input-group image_input">
        <div class="custom-file">
            {!! Form::file($field_name, [
                'class' => 'custom-file-input',
                'onchange' => 'readURL(this, "image_preview' . $field_name . '")',
            ]) !!}
            {!! Form::label($field_name, $field_label, ['class' => 'custom-file-label']) !!}
        </div>
    </div>
    <div id="image_preview{{ $field_name }}">
        @if (!empty($data))
            <img src="{{ asset($path . $data) }}" alt="" height="50">
        @endif
    </div>
</div>