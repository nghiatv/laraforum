<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE Laravel </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('adminlte_lang::message.togglenav') }}</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @if(Auth::guest())

                @else
                        <!-- Notifications Menu -->
                <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">{{ Auth::user()->unreadNotifications->count() }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header"> Ban co {{ Auth::user()->unreadNotifications->count() }} thong bao</li>
                        <li>
                            <!-- Inner Menu: contains the notifications -->
                            <ul class="menu">

                                @foreach(Auth::user()->notifications as $notification)
                                    @if($notification->type == 'App\Notifications\CommentNotify')
                                      <li>
                                          <a href="#">

                                              <!-- Message title and timestamp -->
                                              <h5>
                                                  <b>{{ $notification->data['post'] }}</b>

                                              </h5>
                                              <!-- The message -->
                                              <p> {{ substr($notification->data['comment'],0,20) }}</p>

                                              <!-- timestamp -->
                                              <small class="pull-left">{{ $notification->data['user'] }}</small>
                                              <small class="pull-right"><i class="fa fa-clock-o"></i> {{ $notification->created_at }}</small>
                                          </a>
                                      </li>
                                    @else
                                    @endif
                                @endforeach

                            </ul>
                        </li>
                        <li class="footer"><a id="view-all" href="#">{{ trans('adminlte_lang::message.viewall') }}</a></li>
                    </ul>
                </li>
                @endif




                @if (Auth::guest())
                    <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
                    <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
                    @else
                            <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{Auth::user()->avatar_link}}" class="user-image" alt="User Image"/>
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{Auth::user()->avatar_link}}" class="img-circle" alt="User Image"/>
                                <p>
                                    {{ Auth::user()->name }}
                                    <small>{{ trans('adminlte_lang::message.login') }} Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="col-xs-4 text-center">
                                    <a href="#">{{ trans('adminlte_lang::message.followers') }}</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">{{ trans('adminlte_lang::message.sales') }}</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">{{ trans('adminlte_lang::message.friends') }}</a>
                                </div>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#"
                                       class="btn btn-default btn-flat">{{ trans('adminlte_lang::message.profile') }}</a>
                                </div>
                                <div class="pull-right">
                                    {{--<a href="{{ url('/logout') }}" class="btn btn-default btn-flat">{{ trans('adminlte_lang::message.signout') }}</a>--}}

                                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ trans('adminlte_lang::message.signout') }}
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>

                                </div>
                            </li>
                        </ul>
                    </li>
                    @endif

                            <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
            </ul>
        </div>
    </nav>
</header>
