<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" crossorigin="anonymous">

</head>
<body>

    <div class="c-app flex-row align-items-center">
        <div class="container">

            @yield('content')

        </div>
    </div>

{{--    <script src="https://unpkg.com/@popperjs/core@2"></script>--}}
{{--    <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>--}}

</body>
