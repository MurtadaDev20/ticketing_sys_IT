<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="{{route('user.main')}}">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">Dashboard</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Components </li>
                    <!-- menu item Elements-->

                    {{-- @endif --}}
                    {{-- Main Proccess --}}
                    <li>
                        <a href="{{route('user.AllTickets')}}" >
                            <div class="pull-left"><i class="fa fa-folder"></i><span
                                    class="right-nav-text">All Tickets</span></div>
                            <div class="clearfix"></div>
                        </a>

                    </li>
                    <li>
                        <a href="{{route('user.addTickets')}}" >
                            <div class="pull-left"><i class="fa fa-folder"></i><span
                                    class="right-nav-text">Add New Ticket</span></div>
                            <div class="clearfix"></div>
                        </a>

                    </li>







                </ul>
            </div>
        </div>
    </div>
</div>

        <!-- Left Sidebar End-->

        <!--=================================
