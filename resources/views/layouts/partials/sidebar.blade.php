<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{Auth::user()->avatar_link}}" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}
                    </a>
                </div>
            </div>
            @endif

                    <!-- search form (Optional) -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control"
                           placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="active"><a href="{{ url('home') }}"><i class='fa fa-link'></i>
                        <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
                <li><a href="#"><i class='fa fa-link'></i>
                        <span>{{ trans('adminlte_lang::message.anotherlink') }}</span></a></li>
                <li class="treeview">
                    <a href="{{ url('/admin/categories') }}"><i class='fa fa-link'></i>
                        <span>{{ trans('Categories') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/categories/create') }}">{{ trans('Tạo mới category') }}</a></li>
                        <li><a href="{{ url('/admin/categories') }}">{{ trans('Danh sách category') }}</a></li>
                        {{--<li><a href="{{ url('/admin/categories') }}">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>--}}
                    </ul>
                </li>
                <li class="treeview">
                    <a href="{{ url('/admin/posts') }}"><i class='fa fa-link'></i> <span>{{ trans('Posts') }}</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/posts/create') }}">{{ trans('Tạo mới post') }}</a></li>
                        <li><a href="{{ url('/admin/posts') }}">{{ trans('Danh sách post') }}</a></li>
                        {{--<li><a href="{{ url('/admin/categories') }}">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>--}}
                    </ul>
                </li>

                @if(Auth::user()->hasRole('admin'))
                    <li class="treeview">
                        <a href="{{ url('/admin/tickets') }}"><i class='fa fa-link'></i>
                            <span>{{ trans('Tickets') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="{{ url('/admin/tickets') }}">{{ trans('Danh sách Phản hồi') }}</a></li>
                            {{--<li><a href="{{ url('/admin/categories') }}">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>--}}
                        </ul>
                    </li>
                @endif
            </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
