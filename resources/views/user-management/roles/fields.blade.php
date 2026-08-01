@push('page_css')
<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
@endpush

<!-- Name Field -->
<div class="form-group col-sm-4 inline-lable-search">
    {!! Form::label('name', 'Name', ['class' => 'span-required']) !!}
    {!! Form::text('name', null, ['class' => 'form-control letters-input', 'required']) !!}
</div>

<div class="table-responsive">
<table class="table">
    <thead>
     
        <tr>
            <th style="text-align:left; width: 15%;"> Permission</th>
            <th>All</th>
            <th>Add</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>View</th>
            <th>Publish</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($permissions as $permission)
            <tr>
                <td style="text-align:left">{{ $permission->name }}</td>
                <td><input type="checkbox" class="select-all" id="select-all-{{ $permission->name }}"></td>
                <td>
                    <div class="icheck-primary">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input {{ $permission->name }}-toggle" id="customSwitch{{ $permission->id }}"
                                name="add-{{ $permission->name }}"
                                {{ isset($role) ? ($role->hasPermissionTo('add-' . $permission->name) ? 'checked' : '') : '' }}>
                            <label class="custom-control-label" for="customSwitch{{ $permission->id }}">&nbsp;</label>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="icheck-primary">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input {{ $permission->name }}-toggle" id="customSwitch{{ $permission->id }}a"
                                name="edit-{{ $permission->name }}"
                                {{ isset($role) ? ($role->hasPermissionTo('edit-' . $permission->name) ? 'checked' : '') : '' }}>
                            <label class="custom-control-label" for="customSwitch{{ $permission->id }}a">&nbsp;</label>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="icheck-primary">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input {{ $permission->name }}-toggle" id="customSwitch{{ $permission->id }}b"
                                name="delete-{{ $permission->name }}"
                                {{ isset($role) ? ($role->hasPermissionTo('delete-' . $permission->name) ? 'checked' : '') : '' }}>
                            <label class="custom-control-label" for="customSwitch{{ $permission->id }}b">&nbsp;</label>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="icheck-primary">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input {{ $permission->name }}-toggle" id="customSwitch{{ $permission->id }}c"
                                name="view-{{ $permission->name }}"
                                {{ isset($role) ? ($role->hasPermissionTo('view-' . $permission->name) ? 'checked' : '') : '' }}>
                            <label class="custom-control-label" for="customSwitch{{ $permission->id }}c">&nbsp;</label>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="icheck-primary">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input {{ $permission->name }}-toggle" id="customSwitch{{ $permission->id }}d"
                                name="publish-{{ $permission->name }}"
                                {{ isset($role) ? ($role->hasPermissionTo('publish-' . $permission->name) ? 'checked' : '') : '' }}>
                            <label class="custom-control-label" for="customSwitch{{ $permission->id }}d">&nbsp;</label>
                        </div>
                    </div>
                </td>
            </tr>

            <script type="text/javascript">
                $(function() {
                    const selectAll{{ $permission->id }} = $('#select-all-{{ $permission->name }}');
                    const toggles{{ $permission->id }} = $('.{{ $permission->name }}-toggle');

                    selectAll{{ $permission->id }}.on('click', function() {
                        const isChecked = $(this).prop('checked');
                        toggles{{ $permission->id }}.prop('checked', isChecked);
                    });

                    toggles{{ $permission->id }}.on('click', function() {
                        const isChecked = toggles{{ $permission->id }}.filter(':checked').length === toggles{{ $permission->id }}.length;
                        selectAll{{ $permission->id }}.prop('checked', isChecked);
                        selectAllSinglecheck();
                    });

                    var total = $('.{{ $permission->name }}-toggle').length;
                    var checked = $('.{{ $permission->name }}-toggle:checked').length;
                    $('#select-all-{{ $permission->name }}').prop('checked', total == checked);
                });
            </script>
        @endforeach
    </tbody>
</table>
</div>
@push('page_scripts')
    <script type="text/javascript">
        function selectAllcheck(){
            const allToggles = $('.custom-control-input');
            const isAllChecked = allToggles.filter(':checked').length === allToggles.length;
            $('#select-all').prop('checked', isAllChecked);
            $('.select-all').prop('checked', isAllChecked);
        }
        function selectAllSinglecheck(){
            const allToggles = $('.custom-control-input');
            const isAllChecked = allToggles.filter(':checked').length === allToggles.length;
            $('#select-all').prop('checked', isAllChecked);
        }
        $('.icheck-primary').click(function() {
            if ($(this).is(":checked")) {
                $(this).addClass("active");
                toggleColor();
                console.log('ON');
            } else {
                $(this).removeClass("active");
                removeColor();
                console.log('OFF');
            }
        });
        
        selectAllcheck();
        $('#select-all').on('click', function() {
            const isChecked = $(this).prop('checked');
            $('.custom-control-input').prop('checked', isChecked);
            selectAllcheck();
        });
    </script>
@endpush
