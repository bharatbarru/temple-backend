@section('page_styles')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection

@push('page_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#contact_btn").click(function(){
                var response = grecaptcha.getResponse();
                if(response != '') {
                    return true;
                }else{
                    event.preventDefault();
                    $('#contact-form').parsley().validate();
                    $("#captchaerrors").text("Invalid Captcha");
                    $("#captchaerrors").addClass("captchaError");
                    return false;
                }
            });
        });

        var imNotARobot = function() {
            var response = grecaptcha.getResponse();
            if(response != '') {
                $("#captchaerrors").text('');
                $("#captchaerrors").removeClass("captchaError");
            }
        };
    </script>
@endpush