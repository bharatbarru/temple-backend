@push('page_scripts')
    <script type="text/javascript">
        function singleImage(preview, name){
            var reader = new FileReader();
            $('.edit-image'+preview.replace('image_preview','')).hide();
            $('#'+preview).empty();
            reader.onload = function (e) {
                $('#'+preview).append("<img src='"+e.target.result+"' height='50'>");
            }
            
            reader.readAsDataURL(name);
        }
        function readURL(input, preview) {
            if (input.files.length > 1) {
                for(var i=0; i<input.files.length; i++)
                {
                    singleImage(preview, input.files[i]);
                }
            }else{
                singleImage(preview, input.files[0]);
            }
        }
    </script>
@endpush