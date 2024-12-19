<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    @include('layouts.admin.body.head')
</head>

<body>

    <div class="wrapper">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img src="assets/images/pre-loader/loader-01.svg" alt="">
        </div>


        @include('layouts.admin.body.main-header')

        @include('layouts.admin.body.main-sidebar')

        <!--=================================
 Main content -->
        <!-- main-content -->
        <div class="content-wrapper">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-0">
                            {{-- <livewire:admin /department-livewire> --}}
                        </h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
            <!-- widgets -->
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fa fa-user-o highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <h4 class="card-text text-dark">Admin</h4>
                                    <h4>{{App\Models\Admin::count()}}</h4>
                                </div>
                            </div>
                            {{-- <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <a href="{{route('allUsers')}}">show users</a>
                            </p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fa fa-user-o highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <h4 class="card-text text-dark">Supports</h4>
                                    <h4>{{App\Models\Support::count()}}</h4>
                                </div>
                            </div>
                            {{-- <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <a href="{{route('allUsers')}}">show users</a>
                            </p> --}}
                        </div>
                    </div>
                </div>
                {{-- Main Proccess --}}
                <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-success">
                                        <i class="fa fa-sitemap highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <h4 class="card-text text-dark">Users</h4>
                                    <h4>{{App\Models\User::count()}}</h4>
                                </div>
                            </div>
                            {{-- <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fa fa-bookmark-o mr-1" aria-hidden="true"></i> Total sales
                            </p> --}}
                        </div>
                    </div>
                </div>
                {{-- Sub Proccess --}}
                <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-secondary ">
                                        <i class="fa fa-tasks highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <h4 class="card-text text-dark">Ticket Pending</h4>
                                    <h4>
                                        @php
                                        $ticket_pending = App\Models\Ticket::where('status_id',1)->count()
                                        @endphp
                                        {{$ticket_pending}}
                                    </h4>
                                </div>
                            </div>

                            {{-- <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fa fa-calendar mr-1" aria-hidden="true"></i> Sales Per Week
                            </p> --}}
                        </div>
                    </div>
                </div>
                {{-- Files --}}
                <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-danger">
                                        <i class="fa fa-file-pdf-o highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <h4 class="card-text text-dark">Ticket In Progress</h4>
                                    <h4>
                                        @php
                                        $ticket_pending = App\Models\Ticket::where('status_id',2)->count()
                                        @endphp
                                        {{$ticket_pending}}
                                    </h4>
                                </div>
                            </div>
                            {{-- <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fa fa-repeat mr-1" aria-hidden="true"></i> Just Updated
                            </p> --}}
                        </div>
                    </div>
                </div>
                {{-- Need Aproval  --}}
                <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-danger">
                                        <i class="fa fa-thumbs-o-up fa-shake highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <h4 class="card-text text-dark">Ticket Complete</h4>
                                    <h4>
                                        @php
                                        $ticket_pending = App\Models\Ticket::where('status_id',3)->count()
                                        @endphp
                                        {{$ticket_pending}}
                                    </h4>
                                </div>
                            </div>
                            {{-- <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fa fa-repeat mr-1" aria-hidden="true"></i> Just Updated
                            </p> --}}
                        </div>
                    </div>
                </div>
                
                {{-- <div class="col-xl-8 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <h5 class="card-title">Avarge Rate </h5>
                            <div class="chart-wrapper">
                                <div id="canvas-holder" style="width: 100%; margin: 0 auto; height: 300px;">
                                    <div class="chartjs-size-monitor"
                                        style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                        <div class="chartjs-size-monitor-expand"
                                            style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                        </div>
                                        <div class="chartjs-size-monitor-shrink"
                                            style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                        </div>
                                    </div>
                                    <canvas id="canvas2" width="446" height="375"
                                        style="display: block; height: 300px; width: 357px;"
                                        class="chartjs-render-monitor"></canvas>

                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <!-- Orders Status widgets-->

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

    <script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
</body>

</html>
