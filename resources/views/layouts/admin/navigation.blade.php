
<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ route('dashboard') }}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>F</b>L</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Foko</b>line</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            {{-- <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> --}}
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs">{{ Auth::user()->email }}</span>
            </a>
            <ul class="dropdown-menu">
            <li class="user-header" style="height: auto !important;">
                <p>
                {{{ Auth::user()->email }}}
                <small>Member since {{ Auth::user()->created_at }}</small>
                </p>
            </li>

            <li class="user-footer">
                <div class="row" style="position: relative">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div class="pull-right">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            this.closest('form').submit();" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                    </form>
                </div>
            </li>
            </ul>
        </li>
        </ul>
    </div>
    </nav>
</header>

<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>

            @php
                $user = Auth::user();
                $role = $user->role;
            @endphp

            @if (in_array($role, ['admin', 'store']))
            <li class="{{ request()->routeIs('dashboard') ? 'active' : ''}}">
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            @endif

            @if ($role == 'admin')
            <li class="{{ request()->routeIs('store.verification') ? 'active' : ''}}">
                <a href="{{ route('store.verification') }}">
                    <i class="fa fa-university"></i> <span> Verifikasi Toko </span>
                </a>
            </li>
            @endif

            <li class="{{ request()->routeIs('order.list') ? 'active' : ''}}">
                <a href="{{ route('order.list') }}">
                    <i class="fa fa-table"></i> <span> Order List </span>
                </a>
            </li>

            <li class="header">Pengaturan</li>

            <li class="{{ request()->routeIs('user.setting') ? 'active' : ''}}">
                <a href="{{ route('user.setting') }}">
                    <i class="fa fa-gear"></i> <span> Pengaturan User </span>
                </a>
            </li>

            @if ($role == 'store')
            <li class="{{ request()->routeIs('price.index') ? 'active' : ''}}">
                <a href="{{ route('price.index') }}">
                    <i class="fa fa-gear"></i> <span> Pengaturan Vendor </span>
                </a>
            </li>
            @endif

            <li class="header"><hr style="margin-top:0px !important; margin-bottom:0px !important"></li>

            <li class="{{ request()->routeIs('homepage') ? 'active' : ''}}">
                <a href="{{ route('homepage') }}">
                    <i class="fa fa-home"></i> <span> Homepage </span>
                </a>
            </li>
        </ul>
    </section>
</aside>
