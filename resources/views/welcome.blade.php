<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ applicationSettings('site-name') }}</title>
    <link rel="icon" type="image/x-icon"
    href="{{ asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('favicon')) }}" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>
    @vite('resources/frontend/scss/style-main.scss')
    @stack('third_party_stylesheets')
    @stack('page_css')
</head>
<body>
   {{-- @vite('resources/js/app.js') --}}
   @stack('third_party_scripts')
   @stack('page_scripts')
</body>
</html>