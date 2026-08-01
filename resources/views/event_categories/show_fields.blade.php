<div class="col-sm-6">
    <ul class="nav flex-column">
        <li class="nav-item mb-3 pb-3">
            {!! Form::label('name', 'Name:') !!} 
            <span class="float-right">{{ $eventCategory->name }}</span>
        </li>
        <li class="nav-item mb-3 pb-3">
            {!! Form::label('slug', 'Slug:') !!}
            <span class="float-right">{{ $eventCategory->slug }}</span>
        </li>
        <li class="nav-item mb-3 pb-3">
            {!! Form::label('display_name', 'Display Name:') !!}
            <span class="float-right">{{ $eventCategory->display_name }}</span>
        </li>
        <li class="nav-item mb-3 pb-3">
            {!! Form::label('image', 'Image:') !!}
            <span class="float-right">
                @if (!empty($eventCategory->image))
                    <img src="{{ asset(EVENT_CATEGORY_IMAGE_PATH . $eventCategory->image) }}" alt="Category Image" height="50">
                @endif
            </span>
        </li>
        <li class="nav-item">
            {!! Form::label('image_alt_text', 'Image Alt Text:') !!}
            <span class="float-right">{{ $eventCategory->image_alt_text }}</span>
        </li>
    </ul>
</div>
