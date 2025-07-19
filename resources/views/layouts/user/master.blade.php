<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Cobit 2019" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    {{-- Start Pusher --}}
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    {{-- @vite('resources/js/app.js') --}}

    {{-- End Pusher --}}
    @include('layouts.user.body.head')
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

        @include('layouts.user.body.main-header')

        @include('layouts.user.body.main-sidebar')

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

            @include('layouts.user.body.footer')

            
            @php
                // Get session lifetime from config (in minutes)
                $sessionLifetime = config('session.lifetime', 120);
            @endphp

            <script>
                const sessionLifetimeMinutes = {{ $sessionLifetime }};
                const sessionTimeoutMs = sessionLifetimeMinutes * 60 * 1000;
                const warningBeforeMs = 29 * 60 * 1000; // Warn 1 minutes before timeout

                // ⚠️ Warn user before session timeout
                setTimeout(() => {
                    alert("⚠️ Your session will expire in 1 minute. Please save your work or reload the page.");
                }, sessionTimeoutMs - warningBeforeMs);

                // 🔁 Reload page after session expires
                setTimeout(() => {
                    alert("⏰ Session expired. Reloading the page...");
                    window.location.reload();
                }, sessionTimeoutMs);
            </script>

        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('layouts.user.body.footer-scripts')

</body>

</html>
