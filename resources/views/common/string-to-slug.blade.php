@push('page_scripts')
    <script type="text/javascript">
        function convertToSlug() {
            var text = $("#{{ $fieldName }}").val();
            var output = text.toLowerCase()
                        .replace(/ /g, '-')
                        .replace(/[^\w-]+/g, '');
            $("#slug").val(output);
        }
    </script>
@endpush