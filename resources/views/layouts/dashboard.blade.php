<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CoreUI CSS -->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />

	<!-- icons -->
    {{-- <link href="{{ asset('css/free.min.css') }}" rel="stylesheet"> --}}
{{--    <link href="{{ asset('css/flag-icon.min.css') }}" rel="stylesheet">--}}

</head>
<body class="c-app">
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-md-down-none">
        {{ config('app.name', 'Laravel') }}
{{--        <img src="{{ 'images/YEC-logo.jpg' }}" alt="" width="20%"">--}}
    </div>
    <ul class="c-sidebar-nav ps ps--active-y">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="/home">
                <svg class="c-icon mr-2">
                    <use xlink:href="{{ url('/icons/sprites/free.svg#cil-home') }}"></use>
                </svg> <span>Home</span></a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="/home">
                <svg class="c-icon mr-2">
                    <use xlink:href="{{ url('/icons/sprites/free.svg#cil-user') }}"></use>
                </svg> <span>Category</span></a>
        </li>
    </ul>
</div>
<div class="c-wrapper">

    <header class="c-header c-header-light c-header-fixed">
        <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
            <i class="fas fa-bars"></i>
        </button>

        <ul class="c-header-nav d-md-down-none">
            <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Dashboard</a></li>
            <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Users</a></li>
            <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Settings</a></li>
        </ul>

        <ul class="c-header-nav mfs-auto">
            <div role="group" class="mb-0 form-group">
                <input type="text" name="search" class="form-control header_search">
            </div>

        </ul>
        <ul class="c-header-nav">
            <li class="c-header-nav-item dropdown d-md-down-none mx-2">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"></a>
            </li>


            <li class="c-header-nav-item dropdown">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="c-avatar">
                        <img src="{{ 'images/yec.jpg' }}" alt="logo" width="100%" /> <span>user</span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right pt-0">
                    <div class="dropdown-header bg-light py-2"><strong>Settings</strong></div>
                    <a class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2">
                            <use xlink:href="{{'/icons/sprites/free.svg#cil-user'}}"></use>
                        </svg> Profile
                    </a>
                    <a class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2">
                            <use xlink:href="{{'/icons/sprites/free.svg#cil-settings'}}"></use>
                        </svg> Settings
                    </a>
                    <a class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2">
                            <use xlink:href="{{'/icons/sprites/free.svg#cil-credit-card'}}"></use>
                        </svg> Payments<span class="badge badge-secondary mfs-auto">42</span>
                    </a>
                    <a class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2">
                            <use xlink:href="{{'/icons/sprites/free.svg#cil-file'}}"></use>
                        </svg> Projects<span class="badge badge-primary mfs-auto">42</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <svg class="c-icon mr-2">
                            <use xlink:href="http://127.0.0.1:8000/icons/sprites/free.svg#cil-task"></use>
                        </svg> Lock Account
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        <svg class="c-icon mr-2">
                            <use xlink:href="{{'/icons/sprites/free.svg#cil-account-logout'}}"></use>
                        </svg> {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
            <button class="c-header-toggler c-class-toggler mfe-md-3" type="button" data-target="#aside" data-class="c-sidebar-show">
                <svg class="c-icon c-icon-lg">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-applications-settings"></use>
                </svg>
            </button>
        </ul>
    </header>

    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">

                @yield('content')

            </div>
        </main>
    </div>

    <footer class="c-footer">
        <div><a href="https://coreui.io">CoreUI</a> © 2021</div>
        <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/pro/">CoreUI Pro</a></div>
    </footer>

</div>
<!-- Optional JavaScript -->
<!-- Popper.js first, then CoreUI JS -->
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>

</body>
</html>
