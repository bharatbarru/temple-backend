@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        {{ $type->type }}
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">
        {{-- @include('flash::message') --}}
        @include('adminlte-templates::common.errors')
        <div class="card general_settings">
            <ul class="page-tabs">
                <li class="nav-item"> <a href="{{ url('admin/settings?type=theme-settings') }}"
                        class="nav-link {{ request()->input('type') == 'theme-settings' ? 'active' : '' }}"> <i
                            class="nav-icon fas fa-cogs"></i>
                        <p>Theme Settings</p>
                    </a> </li>
                <li class="nav-item"> <a href="{{ url('admin/settings?type=contact-details') }}"
                        class="nav-link {{ request()->input('type') == 'contact-details' ? 'active' : '' }}"> <i
                            class="nav-icon fas fa-cogs"></i>
                        <p>Contact Details</p>
                    </a> </li>
                <li class="nav-item"> <a href="{{ url('admin/settings?type=socail-settings') }}"
                        class="nav-link {{ request()->input('type') == 'socail-settings' ? 'active' : '' }}"> <i
                            class="nav-icon fas fa-cogs"></i>
                        <p>Socail Settings</p>
                    </a> </li>
                <li class="nav-item"> <a href="{{ url('admin/settings?type=home-page-blocks') }}"
                        class="nav-link {{ request()->input('type') == 'home-page-blocks' ? 'active' : '' }}"> <i
                            class="nav-icon fas fa-cogs"></i>
                        <p>Home Page Blocks</p>
                    </a> </li>
                  
                    <li class="nav-item">
                        <a href="{{ url('admin/settings?type=footer') }}" class="nav-link {{ request()->input("type") == "footer" ? "active" : "" }}">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>Footer</p>
                        </a>
                    </li>
                <li class="nav-item"> <a href="{{ url('admin/settings?type=meta-settings') }}"
                        class="nav-link {{ request()->input('type') == 'meta-settings' ? 'active' : '' }}"> <i
                            class="nav-icon fas fa-cogs"></i>
                        <p>Meta Settings</p>
                    </a> </li>
                <li class="nav-item"> <a href="{{ url('admin/settings?type=site-verification') }}"
                        class="nav-link {{ request()->input('type') == 'site-verification' ? 'active' : '' }}"> <i
                            class="nav-icon fas fa-cogs"></i>
                        <p>Site Verification</p>
                    </a> </li>
                <li class="nav-item"> <a href="{{ url('admin/settings?type=template-settings') }}"
                        class="nav-link {{ request()->input('type') == 'template-settings' ? 'active' : '' }}"> <i
                            class="nav-icon fas fa-cogs"></i>
                        <p>Template Settings</p>
                    </a> </li>
                <li class="nav-item"> <a href="{{ url('admin/settings?type=payment-settings') }}"
                    class="nav-link {{ request()->input('type') == 'payment-settings' ? 'active' : '' }}"> <i
                        class="nav-icon fas fa-cogs"></i>
                    <p>Payment Settings</p>
                </a> </li>
                <li class="nav-item"> <a href="{{ url('admin/settings?type=terms-and-conditions') }}" class="nav-link {{ request()->input("type") == "terms-and-conditions" ? "active" : "" }}"> <i class="nav-icon fas fa-cogs"></i> <p>Terms and Conditions</p> </a> </li>

             
            </ul>
            {!! Form::open(['url' => 'admin/update-application-settings', 'files' => true]) !!}
            <input type="hidden" name="setting_type_id" value="{{ $type->id }}" />
            <input type="hidden" name="setting_type_slug" value="{{ $type->slug }}" />
            <div class="card-body">
                <div class="row animation-form">
                    {{-- 
                  <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                @foreach ($categories as $category)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="custom-tabs-one-{{ $category->id }}-tab"
                                            data-toggle="pill" href="#custom-tabs-one-{{ $category->id }}" role="tab"
                                            aria-controls="custom-tabs-one-{{ $category->id }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                @foreach ($categories as $category)
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="custom-tabs-one-{{ $category->id }}"
                                        role="tabpanel" aria-labelledby="custom-tabs-one-{{ $category->id }}-tab">
                                        {{ $category->name }}
                                        <div class="row">
                                            @foreach ($category->settings as $setting)
                                              content
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>  --}}
                    @foreach ($settings as $setting)
                        @switch($setting->input_type)
                            @case('heading')
                                <div class="col-12">
                                    <h4 class="category-title">{{ $setting->field_name }}</h4>
                                </div>
                            @break
                            @case('color')
                                <div class="form-group col-sm-4">
                                    {!! Form::label($setting->id, $setting->field_name) !!}
                                    <div class="input-group colorpicker" id="{{ 'colorpicker' . $setting->id }}">
                                        <input type="text" class="form-control" name="{{ $setting->id }}"
                                            value="{{ isset($setting) ? $setting->value : '' }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-square"
                                                    style="{{ isset($setting) ? 'color:' . $setting->value : '' }}"></i></span>
                                        </div>
                                    </div>
                                </div>
                            @break
                            @case('textbox')
                                <div class="form-group col-sm-4">
                                    {!! Form::label($setting->id, $setting->field_name) !!}
                                    {!! Form::text($setting->id, $setting->value, ['class' => 'form-control']) !!}
                                </div>
                            @break
                            @case('select')
                                <div class="form-group col-sm-4">
                                    {!! Form::label($setting->id, $setting->field_name) !!}
                                    @php($options = explode(',', $setting->options))
                                    <select class="form-control select2" name="{{ $setting->id }}">
                                        <option value="">{{ 'Select ' . $setting->field_name }}</option>
                                        @foreach ($options as $option)
                                            <option value="{{ $option }}"
                                                {{ $option == $setting->value ? 'selected' : '' }}>{{ $option }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @break
                            @case('radio')
                                <div class="form-group col-sm-4">
                                    {!! Form::label($setting->id, $setting->field_name) !!}
                                    @php($options = explode(',', $setting->options))
                                    <div class="radio">
                                        @foreach ($options as $option)
                                            <label>
                                                {!! Form::radio('radio' . $setting->id, $option, $option == $setting->value) !!}
                                                {{ $option }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @break
                            @case('checkbox')
                                <div class="form-group col-sm-4">
                                    {!! Form::label($setting->id, $setting->field_name) !!}
                                    @php($options = explode(', ', $setting->options))
                                    <div class="checkbox">
                                        @foreach ($options as $option)
                                            <label>
                                                {!! Form::checkbox(
                                                    'checkbox' . $setting->id . '[]',
                                                    $option,
                                                    in_array(trim($option), explode(',', $setting->value)),
                                                ) !!}
                                                {{ $option }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @break
                            @case('textarea-normal')
                                <div class="form-group col-sm-12">
                                    {!! Form::label($setting->id, $setting->field_name) !!}
                                    {!! Form::textarea($setting->id, $setting->value, ['class' => 'form-control']) !!}
                                </div>
                            @break
                            @case('textarea')
                                <div class="form-group col-sm-12">
                                    {!! Form::label($setting->id . '-editor', $setting->field_name) !!}
                                    {!! Form::textarea($setting->id, $setting->value, ['class' => 'form-control', 'id' => $setting->id . '-editor']) !!}

                                    @include('common.editor', ['field' => $setting->id . '-editor'])
                                </div>
                            @break
                            @case('file')
                                @include('common.image.single-image', [
                                    'field_label' => $setting->field_name,
                                    'field_name' => $setting->id,
                                    'data' => $setting->value,
                                    'path' => APPLICATION_SETTING_IMAGE_PATH,
                                ])
                                <div class="form-group col-sm-4">
                                    {!! Form::label('alt_text' . $setting->id, $setting->field_name . ' Alt Text') !!}
                                    {!! Form::text('alt_text' . $setting->id, $setting->alt_text, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Image Alt Text',
                                    ]) !!}
                                </div>
                            @break
                            @case('multiple-files')
                                @include('common.image.multiple-image', [
                                    'field_label' => $setting->field_name,
                                    'field_name' => $setting->id,
                                    'route' => 'remove-multiple-image-item/' . $setting->id . '/',
                                    'path' => APPLICATION_SETTING_IMAGE_PATH,
                                    'data' => $setting->value,
                                ])
                            @break
                            @case('switch')
                                <div class="form-group col-sm-4">
                                    <label>{{ $setting->field_name }}</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input {{ $setting->id }}-toggle"
                                            id="customSwitch{{ $setting->id }}" name="switch-{{ $setting->id }}"
                                            {{ $setting->value ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customSwitch{{ $setting->id }}">&nbsp;</label>
                                    </div>
                                </div>
                            @break
                        @endswitch
                    @endforeach
                </div>
            </div>
            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('applicationSettings.index') }}" class="btn btn-default"> Cancel </a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@push('page_scripts')
    <script type="text/javascript">
        function addClassToParentDivOfElementWithText(text, className) {
            var labels = document.getElementsByTagName('label');
            for (var i = 0; i < labels.length; i++) {
                if (labels[i].textContent === text) {
                    var parentDiv = labels[i].parentNode;
                    parentDiv.classList.add("opening-hours-title-full");
                }
            }
        }
        addClassToParentDivOfElementWithText("Opening Hours Title", "form-group col-sm-4");
        function addClassToGrandparentDivOfElementWithText(text, className) {
            var labels = document.getElementsByTagName('label');
            for (var i = 0; i < labels.length; i++) {
                if (labels[i].textContent === text) {
                    var parentDiv = labels[i].parentNode;
                    var grandparentDiv = parentDiv.parentNode;
                    grandparentDiv.classList.add(className);
                }
            }
        }
        addClassToGrandparentDivOfElementWithText("Clinic Info Sub Title", "customize-general-settings");
    </script>
@endpush
