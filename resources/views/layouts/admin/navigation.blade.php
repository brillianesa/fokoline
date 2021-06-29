
<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ route('admin') }}" class="logo">
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
                $user = Auth::user()
            @endphp

            @if ($user->role = 'ADMIN')
                <li class="active">
                    <a href="#"><i class="fa fa-link"></i> <span>Link</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#">Link in level 2</a></li>
                        <li><a href="#">Link in level 2</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </section>
</aside>
