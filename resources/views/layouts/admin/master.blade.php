<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Cobit 2019" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />




    {{-- Start Pusher --}}

   @vite('resources/js/app.js')
    {{-- End Pusher --}}
    @include('layouts.admin.body.head')
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

        @include('layouts.admin.body.main-header')

        @include('layouts.admin.body.main-sidebar')

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

            @include('layouts.admin.body.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('layouts.admin.body.footer-scripts')

</body>

</html>
