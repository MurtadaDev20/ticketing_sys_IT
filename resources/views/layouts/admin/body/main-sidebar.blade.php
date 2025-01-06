<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="{{route('admin.dashboard')}}">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">Dashboard</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Components </li>
                    <!-- menu item Elements-->

                    {{-- @endif --}}
                    {{-- Catigories --}}
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#main-ticket">
                            <div class="pull-left"><i class="fa fa-folder"></i><span
                                    class="right-nav-text">Tickets</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="main-ticket" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('admin.AllTickets')}}">Monitor</a></li>
                            <li><a href="{{route('admin.completeTickets')}}">Ticket Complete</a></li>
                        </ul>

                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#main-caigory">
                            <div class="pull-left"><i class="fa fa-folder"></i><span
                                    class="right-nav-text">Categories</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="main-caigory" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('admin.showCatigories')}}">Manage Category</a></li>
                            <li><a href="{{route('admin.showSubCatigories')}}">Sub Category</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{route('admin.ShowEvaluation')}}" >
                            <div class="pull-left"><i class="fa fa-folder"></i><span
                                    class="right-nav-text">Evaluation</span></div>
                            <div class="clearfix"></div>
                        </a>

                    </li>

                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Actions </li>
                    <!-- menu item Elements-->

                    {{-- @endif --}}
                    {{-- Catigories --}}
                    <li>
                        <a href="{{route('admin.support')}}" >
                            <div class="pull-left"><i class="fa fa-folder"></i><span
                                    class="right-nav-text">Manage Support</span></div>
                            <div class="clearfix"></div>
                        </a>

                    </li>
                    <li>
                        <a href="{{route('admin.user')}}" >
                            <div class="pull-left"><i class="fa fa-folder"></i><span
                                    class="right-nav-text">Manage Users</span></div>
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
