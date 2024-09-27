<!DOCTYPE html>
<html lang="en">
<head>
    {{--=================================CSS========================--}}
    @include('backend.includes.css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        {{--===============TOP NAV=====================--}}
        @include('backend.includes.topnav')

        {{--==================sidebar=========================--}}
        @include('backend.includes.sidebar')

        <div class="content-wrapper">
            @yield('content')
        </div>
        {{--   ==================footer =======================--}}
        @include('backend.includes.footer')
    </div>


   {{--===============script =======================--}}
   @include('backend.includes.script')
    @stack('scripts')
</body>
</html>
