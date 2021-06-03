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
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

{{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">--}}
	<!-- icons -->

    {{-- select2 --}}

    <link href="{{ asset('select2/css/select2.min.css?'.time()) }}" rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

     <link href="{{ asset('DataTables/css/dataTable.min.css') }}" rel="stylesheet">
     <link href="{{ asset('DataTables/css/FixedColumn.DataTable.min.css') }}" rel="stylesheet">
{{--    <link href="{{ asset('css/flag-icon.min.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{ asset('css/main.css?'.time()) }}" />

</head>
<body class="c-app">
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-md-down-none">YEC catalog</div>
    <ul class="c-sidebar-nav ps ps--active-y">
        <li class="c-sidebar-nav-item @if( Request::segment(1) == 'catalog' ) bg-primary @endif">
            <a class="c-sidebar-nav-link @if( Request::segment(1) == 'catalog' ) text-white @endif" href="{{ route('catalog.index') }}">
                <svg class="c-icon mr-2">
                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-layers') }}"></use>
                </svg> <span>Kataloglar</span>
            </a>
        </li>
        <li class="c-sidebar-nav-item @if( Request::segment(1) == 'room' ) bg-primary @endif">
            <a class="c-sidebar-nav-link @if( Request::segment(1) == 'room' ) text-white @endif" href="{{ route('room.index') }}">
                <svg class="c-icon mr-2">
                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-room') }}"></use>
                </svg> <span>Xonalar</span>
            </a>
        </li>
        <li class="c-sidebar-nav-item @if( Request::segment(1) == 'quality' ) bg-primary @endif">
            <a class="c-sidebar-nav-link @if( Request::segment(1) == 'quality' ) text-white @endif" href="{{ route('quality.index') }}">
                <svg class="c-icon mr-2">
                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-chart-pie') }}"></use>
                </svg> <span>Sifatlar</span>
            </a>
        </li>

        <li class="c-sidebar-nav-item @if( Request::segment(1) == 'user' ) bg-primary @endif">
            <a class="c-sidebar-nav-link @if( Request::segment(1) == 'user' ) text-white @endif" href="{{ route('user.index') }}">
                <svg class="c-icon mr-2">
                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-people') }}"></use>
                </svg> <span>Hodimlar</span>
            </a>
        </li>

    </ul>
</div>
<div class="c-wrapper">

    <header class="c-header c-header-light c-header-fixed">
        <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
            <svg class="c-icon c-icon-lg">
                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-menu')}}"></use>
            </svg>
        </button>
        <a class="c-header-brand d-lg-none" href="#">
            <h2>{{ $title }}</h2>
        </a>

        <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
            <svg class="c-icon mfe-2">
                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-menu') }}"></use>
            </svg>
        </button>


        <ul class="c-header-nav mfe-auto d-none d-lg-block">
            <h2 class="text-right" style="width: 400px; margin-top: 10px ">{{ $title }}</h2>
        </ul>

        <ul class="c-header-nav mfs-auto">
            <div role="group" class="mb-0 form-group @if( Request::segment(1) == 'catalog' ) d-flex @else d-none @endif">
                <input type="text" name="search" class="form-control form-control-sm header_search">
                <input type="submit" value="Izlash" name="searchBtn" class="btn btn-sm btn-info ml-2">
            </div>
        </ul>
        <ul class="c-header-nav">
            <li class="c-header-nav-item dropdown d-md-down-none mx-2">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"></a>
            </li>


            <li class="c-header-nav-item dropdown">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="c-avatar">
                        <img src="{{ asset('uploaded/yec.jpg') }}" alt="logo" width="100%" /> <span>user</span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right pt-0">
                    <div class="dropdown-header bg-light py-2"><strong>Settings</strong></div>
                    <a class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2">
                            <use xlink:href="{{asset('/icons/sprites/free.svg#cil-user')}}"></use>
                        </svg> Profile
                    </a>
                    <a class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2">
                            <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-settings') }}"></use>
                        </svg> Settings
                    </a>
                    <a class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2">
                            <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-credit-card') }}"></use>
                        </svg> Payments<span class="badge badge-secondary mfs-auto">42</span>
                    </a>
                    <a class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2">
                            <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-file')}}"></use>
                        </svg> Projects<span class="badge badge-primary mfs-auto">42</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <svg class="c-icon mr-2">
                            <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-task') }}"></use>
                        </svg> Lock Account
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        <svg class="c-icon mr-2">
                            <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-account-logout') }}"></use>
                        </svg> {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
            <button class="c-header-toggler c-class-toggler mfe-md-3" type="button" data-target="#aside" data-class="c-sidebar-show">
                <svg class="c-icon c-icon-lg">
                    <use xlink:href="{{ asset('/icons/svg/free.svg#cil-applications-settings') }}"></use>
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
<script src="{{ asset('js/jquery-3.5.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script src="{{ asset('bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>
<script src="{{ asset('select2/js/select2.min.js') }}" type='text/javascript'></script>

<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>


{{--fansy Box --}}
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>


<script src="{{ asset('DataTables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('DataTables/js/dataTables.fixedColumns.min.js') }}"></script>

<script src="{{ asset('js/functions.js?'.time()) }}"></script>

</body>
</html>
