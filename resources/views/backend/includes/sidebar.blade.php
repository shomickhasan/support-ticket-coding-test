@php
  $support = [
      'ticket.index',
      'ticket.add',
      'ticket.details',
      'ticket.store',
      'ticket.reply',
      'ticket.ticketClose',

      ];
  $customer = [
        'customer.index',
        'customer.add_edit',
        'customer.store',
        'customer.update',
    ];

$routeName=\Request::route()->getName();
@endphp


<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="{{route('admin_dashboard')}}" class="nav-link @if($routeName=="admin_dashboard") active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if(auth()->user()->user_type==0)
                    <li class="nav-item menu-open">
                        <a href="{{route('customer.index')}}" class="nav-link @if(in_array($routeName,$customer)) active @endif">
                            <i class="nav-icon fas  fa-users"></i>
                            <p>
                                Customer
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item menu-open">
                    <a href="{{route('ticket.index')}}" class="nav-link @if(in_array($routeName,$support)) active @endif">
                        <i class="nav-icon fas  fa-sticky-note"></i>
                        <p>
                            Supports
                        </p>
                    </a>
                </li>
                <li class="nav-item menu-open">
                    <a href="{{route('logout')}}" class="nav-link">
                        <i class="nav-icon fas  fa-arrow-left"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
                {{--<li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-shield-virus"></i>
                        <p>
                            Administration
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('user.index')}}" class="nav-link">
                                <i class="far fa-user nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('activity.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User Activities</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('roles')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Role & permission</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('auto')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>auto</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('add-edit')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>add edit same form</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('cat_index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>list</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">EXAMPLES</li>
                <li class="nav-item">
                    <a href="pages/calendar.html" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Calendar
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('add_product')}}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Add Product
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list_product')}}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            List Product
                        </p>
                    </a>
                </li>
                <li class="nav-item bg-danger">
                    <a href="{{route('logout')}}" class="nav-link">
                        <i class="nav-icon far fa-arrow-alt-circle-up text-light"></i>
                        <p>
                            Sign Out
                        </p>
                    </a>
                </li>--}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
