@if (session()->has('flash_notification'))
    @foreach (session('flash_notification')->all() as $message)
        @php
            $level = $message->level == 'danger' ? 'error' : $message->level;
        @endphp
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
            }
            toastr.{{ $level }}('{!! $message->message !!}');
        </script>
    @endforeach
@endif