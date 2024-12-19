        <!--=================================
 header start-->
 <nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <!-- logo -->
    <div class="text-left navbar-brand-wrapper">
        <a class="navbar-brand brand-logo" href="#"><img src="{{asset('assets/images/mbi-logo-1.png')}}" alt=""></a>
        <a class="navbar-brand brand-logo-mini" href="#"><img src="{{asset('assets/images/mbi-logo-1.png')}}"
                alt=""></a>
    </div>
    <!-- Top bar left -->
    <ul class="nav navbar-nav mr-auto">
        <li class="nav-item">
            <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left"
                href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
        </li>
        <li class="nav-item">
            <div class="search">
                <a class="search-btn not_click" href="javascript:void(0);"></a>
                <div class="search-box not-click">
                    <input type="text" class="not-click form-control" placeholder="Search" value=""
                        name="search">
                    <button class="search-button" type="submit"> <i class="fa fa-search not-click"></i></button>
                </div>
            </div>
        </li>
    </ul>
    <!-- top bar right -->
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item fullscreen">
            <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
        </li>
        <li class="nav-item dropdown ">
            <a class="nav-link top-nav show" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
              <i class="ti-bell"></i>
              <span class="badge bg-danger notification-status1">{{Auth::guard('admin')->user()->unreadNotifications->count()}} </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications show" data-bs-popper="none">
              <div class="dropdown-header notifications">
                <strong>Notifications</strong>
                <span class="badge bg-warning">{{Auth::guard('admin')->user()->unreadNotifications->count()}}</span>
              </div>
              <div class="dropdown-divider"></div>
              @foreach (Auth::guard('admin')->user()->unreadNotifications as $notification)
              <a href="{{ url($notification->data['link'] . '/notify_id/' . $notification->id) }}" class="dropdown-item">New Ticket From <strong>{{$notification->data['user_name']}}</strong>
                <br>
                <small class="float-end text-muted time">Title : {{$notification->data['ticket_title']}} -- {{$notification->created_at->diffForHumans()}}</small> </a>
              @endforeach


            </div>
          </li>

        <li class="nav-item dropdown mr-30">
            <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="true" aria-expanded="false">
                <img src="{{asset('assets/images/profile-avatar.jpg')}}" alt="avatar">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0">{{Auth::guard('admin')->user()->name}}</h5>
                             <span>{{Auth::guard('admin')->user()->email}}</span>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                {{-- <a class="dropdown-item" href="#"><i class="text-secondary ti-reload"></i>Activity</a>
                <a class="dropdown-item" href="#"><i class="text-success ti-email"></i>Messages</a> --}}
                <a class="dropdown-item" href="#"><i class="text-warning ti-user"></i>Profile</a>
                {{-- <a class="dropdown-item" href="#"><i class="text-dark ti-layers-alt"></i>Projects <span --}}
                        {{-- class="badge badge-info">6</span> </a> --}}
                <div class="dropdown-divider"></div>
                {{-- <a class="dropdown-item" href="#"><i class="text-info ti-settings"></i>Settings</a> --}}
                <form id="logout-form" action="{{ route('admin.logout') }}" method="get" class="d-none">
                    @csrf
                </form>
                <a class="dropdown-item" href="#"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                             <i class="text-danger ti-unlock"></i>
                                {{ __('Logout') }}
                            </a>
            </div>
        </li>
    </ul>
</nav>

<!--=================================
header End-->
