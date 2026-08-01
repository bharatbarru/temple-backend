<!-- Page Type Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('page_type', 'Page Type:') !!}
    {!! Form::select('page_type', ['pages' => 'pages', 'blogs' => 'blogs', 'services' => 'services', 'products' => 'products'], null, [
        'class' => 'form-control select2',
        'placeholder' => 'Select Page Type',
        'required',
        'id' => 'page_type', // Add an ID to identify the element
    ]) !!}
</div>

<!-- Page Name Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('page_name', 'Page Name:') !!}
    {!! Form::select('page_name[]',isset($faqCategory) ? getPageNames($faqCategory->page_type, null) : [], null, [
        'class' => 'form-control select2',
        'multiple',
        'required',
        'id' => 'page_name', // Add an ID to identify the element
    ]) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Category Name:') !!}
    {!! Form::text('name', null, [
        'class' => 'form-control',
        'required',
    ]) !!}
</div>
@push('page_scripts')
    <script type="text/javascript">
        $(function() {
            $("#page_type").on("change", function() {
                var type = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ url('admin/get-page-names-list') }}",
                    data: {
                        type: type,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $("#page_name").find('option').remove();
                            $.each(response, function(key, value) {
                                $("#page_name").append(
                                    '<option value="' + key + '">' + value + '</option>'
                                );
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseJSON.error);
                    }
                });
            });
        });
    </script>
@endpush

