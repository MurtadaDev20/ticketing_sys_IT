<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Cobit 2019" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    {{-- Start Pusher --}}
    {{-- <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script> --}}

    {{-- @vite('resources/js/app.js') --}}

    {{-- End Pusher --}}
    @include('layouts.support.body.head')
</head>

<body>

    <div class="wrapper">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img src="{{asset('assets/images/pre-loader/loader-01.svg')}}" alt="">
        </div>

        <!--=================================
 preloader -->

        @include('layouts.support.body.main-header')

        @include('layouts.support.body.main-sidebar')

        <!--=================================
 Main content -->
        <!-- main-content -->
        <div class="content-wrapper">

            @yield('page-header')

            @yield('content')


            <!--=================================
 wrapper -->

            <!--=================================
 footer -->

            @include('layouts.support.body.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('layouts.support.body.footer-scripts')

</body>

</html>
