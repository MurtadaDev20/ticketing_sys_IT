<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <style>
                    .side-menu-fixed {
                        /* width: 200px; */
                        background: linear-gradient(180deg, #1a237e 0%, #283593 100%);
                        height: 100vh;
                        position: fixed;
                        left: 0;
                        top: 0;
                        z-index: 1000;
                        box-shadow: 4px 0 20px rgba(0,0,0,0.15);
                    }

                    .side-menu-fixed .side-menu li {
                        width: 200px;
                    }
                    .side-menu {
                        padding: 25px 0;
                    }

                    .side-menu li {
                        margin: 5px 15px;
                        padding: 0;
                    }

                    .side-menu li a {
                        padding: 14px 20px;
                        border-radius: 12px;
                        color: rgba(255,255,255,0.85);
                        transition: all 0.3s ease;
                        display: block;
                        text-decoration: none;
                        position: relative;
                        overflow: hidden;
                    }

                    .side-menu li a::before {
                        content: '';
                        position: absolute;
                        left: 0;
                        top: 0;
                        height: 100%;
                        width: 0;
                        background: rgba(255,255,255,0.1);
                        transition: all 0.3s ease;
                        z-index: 0;
                    }

                    .side-menu li a:hover {
                        color: #fff;
                        transform: translateX(5px);
                    }

                    .side-menu li a:hover::before {
                        width: 100%;
                    }

                    .side-menu li.active a {
                        background: rgba(255,255,255,0.15);
                        color: #fff;
                        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                    }

                    .side-menu li.active a::before {
                        width: 100%;
                    }

                    .side-menu .menu-title {
                        color: rgba(255,255,255,0.5);
                        font-size: 0.8rem;
                        text-transform: uppercase;
                        letter-spacing: 2px;
                        padding: 20px 20px 10px;
                        margin-top: 20px;
                        font-weight: 600;
                    }

                    .side-menu i {
                        font-size: 1.3rem;
                        margin-right: 15px;
                        width: 25px;
                        text-align: center;
                        position: relative;
                        z-index: 1;
                        color: rgba(255,255,255,0.9);
                    }

                    .right-nav-text {
                        font-size: 0.95rem;
                        font-weight: 500;
                        position: relative;
                        z-index: 1;
                    }

                    .pull-left {
                        display: flex;
                        align-items: center;
                        position: relative;
                        z-index: 1;
                    }

                    .clearfix {
                        display: none;
                    }

                    /* Custom scrollbar */
                    .scrollbar {
                        height: 100%;
                        overflow-y: auto;
                        padding-right: 5px;
                    }

                    .scrollbar::-webkit-scrollbar {
                        width: 4px;
                    }

                    .scrollbar::-webkit-scrollbar-track {
                        background: rgba(255,255,255,0.05);
                        border-radius: 10px;
                    }

                    .scrollbar::-webkit-scrollbar-thumb {
                        background: rgba(255,255,255,0.2);
                        border-radius: 10px;
                    }

                    .scrollbar::-webkit-scrollbar-thumb:hover {
                        background: rgba(255,255,255,0.3);
                    }

                    /* Logo or Brand Section */
                    .brand-section {
                        padding: 20px;
                        margin-bottom: 20px;
                        text-align: center;
                        border-bottom: 1px solid rgba(255,255,255,0.1);
                    }

                    .brand-section h3 {
                        color: #fff;
                        font-size: 1.5rem;
                        margin: 0;
                        font-weight: 600;
                    }

                    /* Notification Badge */
                    .notification-badge {
                        background: #ff4081;
                        color: white;
                        border-radius: 50%;
                        padding: 2px 6px;
                        font-size: 0.7rem;
                        position: absolute;
                        right: 10px;
                        top: 50%;
                        transform: translateY(-50%);
                    }
                </style>

                <div class="brand-section">
                    <h3>Ticket System</h3>
                </div>

                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li class="active">
                        <a href="{{route('user.main')}}">
                            <div class="pull-left">
                                <i class="ti-home"></i>
                                <span class="right-nav-text">Dashboard</span>
                            </div>
                        </a>
                    </li>
                    
                    <!-- menu title -->
                    <li class="menu-title">Main Menu</li>
                    
                    <!-- menu item Elements-->
                    <li>
                        <a href="{{route('user.AllTickets')}}">
                            <div class="pull-left">
                                <i class="fa fa-ticket"></i>
                                <span class="right-nav-text">All Tickets</span>
                            </div>
                        </a>
                    </li>

                    @php
                        $approvals = App\Models\Approval::where('user_id',Auth::user()->id);
                    @endphp
                    @if ($approvals->count() > 0)
                    <li>
                        <a href="{{route('user.allapproval')}}">
                            <div class="pull-left">
                                <i class="fa fa-check-circle"></i>
                                <span class="right-nav-text">All Approvals</span>
                            </div>
                        </a>
                    </li>
                    @endif

                    <li>
                        <a href="{{route('user.addTickets')}}">
                            <div class="pull-left">
                                <i class="fa fa-plus-circle"></i>
                                <span class="right-nav-text">Add New Ticket</span>
                            </div>
                        </a>
                    </li>

                    @php
                        $survays = App\Models\SurveyAllowUser::where('user_id',Auth::user()->id);
                    @endphp
                    @if ($survays->count() > 0)
                    <li>
                        <a href="{{route('user.surveyManageAdmin')}}" >
                            <div class="pull-left">
                                <i class="fa fa-clipboard-list"></i>
                                <span class="right-nav-text">Survey Manage</span>
                            </div>
                        </a>
                    </li>
                    @endif
                    <li>
                        <a href="{{route('user.surveyViewUser')}}" >
                            <div class="pull-left">
                                <i class="fa fa-clipboard-list"></i>
                                <span class="right-nav-text">Surveys</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Left Sidebar End-->

        <!--=================================
