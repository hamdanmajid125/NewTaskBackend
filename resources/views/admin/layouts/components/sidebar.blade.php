<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="{{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="icon-Home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Settings1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span>Website Setting</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Request::routeIs('admin.config.favicon') ? 'active' : '' }}">
                                <a href="{{ route('admin.config.favicon') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Favicon</a>
                            </li>
                            <li class="{{ Request::routeIs('admin.config.logo') ? 'active' : '' }}">
                                <a href="{{ route('admin.config.logo') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Logo</a>
                            </li>

                        </ul>
                    </li>
                  

                    @foreach ($laravelAdminMenus->menus as $section)
                        @if ($section->items)
                            <li class="header">{{ $section->section }}</li>
                            @foreach ($section->items as $menu)
                                <li class="treeview">
                                    <a href="#">
                                        <i class="icon-Library"><span class="path1"></span><span
                                                class="path2"></span></i>
                                        <span>{{ $menu->title }}</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">

                                        <li
                                            class="{{ Request::is('admin'.$menu->url.'/create') ? 'active' : '' }}">
                                            <a href="{{ url('/admin' . $menu->url . '/create') }}"><i
                                                    class="icon-Commit"><span class="path1"></span><span
                                                        class="path2"></span></i>Add {{ $menu->title }}</a>
                                        </li>
                                        <li class="{{ Request::is('admin' . $menu->url) ? 'active' : '' }}">
                                            <a href="{{ url('/admin' . $menu->url) }}"><i class="icon-Commit"><span
                                                        class="path1"></span><span
                                                        class="path2"></span></i>{{ $menu->title }} List</a>
                                        </li>
                                    </ul>
                                </li>
                            @endforeach
                        @endif
                    @endforeach
   
            
                    
                </ul>
            </div>
        </div>
    </section>
</aside>
