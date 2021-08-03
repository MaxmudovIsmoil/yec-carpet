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

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-toggle.css') }}" rel="stylesheet">


    <!-- Styles -->
{{--    <link rel="stylesheet" href="{{ asset('css/coreui.min.css') }}" crossorigin="anonymous">--}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

     <link href="{{ asset('DataTables/css/dataTable.min.css') }}" rel="stylesheet">
     <link href="{{ asset('DataTables/css/FixedColumn.DataTable.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css?'.time()) }}" />

</head>
<body class="c-app">
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-md-down-none">YEC catalog</div>
    <ul class="c-sidebar-nav ps ps--active-y">
        <li class="c-sidebar-nav-item @if( Request::segment(1) == 'catalog') bg-primary @endif">
            <a class="c-sidebar-nav-link @if( Request::segment(1) == 'catalog') text-white @endif" href="{{ route('catalog.index') }}">
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

        <li class="c-sidebar-nav-item @if( Request::segment(1) == 'termPayment' ) bg-primary @endif">
            <a class="c-sidebar-nav-link @if( Request::segment(1) == 'termPayment' ) text-white @endif" href="{{ route('termPayment.index') }}">
                <svg class="c-icon mr-2">
                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-money') }}"></use>
                </svg> <span>Muddatli to'lov</span>
            </a>
        </li>


{{--        <li class="c-sidebar-nav-item @if( Request::segment(1) == 'user' ) bg-primary @endif">--}}
{{--            <a class="c-sidebar-nav-link @if( Request::segment(1) == 'user' ) text-white @endif" href="{{ route('user.index') }}">--}}
{{--                <svg class="c-icon mr-2">--}}
{{--                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-people') }}"></use>--}}
{{--                </svg> <span>Hodimlar</span>--}}
{{--            </a>--}}
{{--        </li>--}}

    </ul>
</div>

<div class="c-wrapper">
    <header class="c-header c-header-light c-header-fixed">
        <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
            <svg class="c-icon c-icon-lg">
                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-menu')}}"></use>
            </svg>
        </button>
        <a class="c-header-brand mfe-sm-auto d-lg-none" href="#">
            <h2 class="title">{{ $title }}</h2>
        </a>

        <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
            <svg class="c-icon mfe-2">
                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-menu') }}"></use>
            </svg>
        </button>

        <ul class="c-header-nav d-none d-lg-block">
            <h2 class="text-right">{{ $title }}</h2>
        </ul>


        <ul class="c-header-nav mfs-auto">
            @if(Request::segment(1) == 'catalog')
                <a href="{{ route('search.index') }}" class="btn btn-outline-info search_btn mr-3">Izlash</a>
            @endif

            <li class="c-header-nav-item dropdown mr-4">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <span style="font-weight: 600; font-size: 18px;">{{ Auth::user()->username }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right pt-0">
                    <div class="dropdown-header bg-light py-2"><strong>Sozlamalar</strong></div>
                    <a class="dropdown-item" href="{{ route('user.edit_password') }}">
                        <svg class="c-icon mfe-2">
                            <use xlink:href="{{asset('/icons/sprites/free.svg#cil-user')}}"></use>
                        </svg> Parol almashtirish

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
        </ul>
    </header>

    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">

                @yield('content')

            </div>
        </main>
    </div>

    @include('layouts.deleteModal')

    <footer class="c-footer">
        <div class="mfs-auto"><a href="https://almirab.uz">Almirab</a> IT firmasi</div>
    </footer>

</div>

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

<script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
<!--[if IE]><!-->
<script src="{{ asset('js/svgxuse.min.js') }}"></script>
<!--<![endif]-->

<script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
<script src="{{ asset('js/coreui-utils.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
{{--fansy Box --}}
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<script src="{{ asset('js/bootstrap-toggle.min.js') }}"></script>

<script src="{{ asset('DataTables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('DataTables/js/dataTables.fixedColumns.min.js') }}"></script>

<script src="{{ asset('js/functionDelete.js?'.time()) }}"></script>

<script src="{{ asset('js/functionCatalog.js?'.time()) }}"></script>

<script src="{{ asset('js/functions.js?'.time()) }}"></script>

<div class=""></div>
</body>
</html>
