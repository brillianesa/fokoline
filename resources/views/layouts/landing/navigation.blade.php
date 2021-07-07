<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky background-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.html" class="logo">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section ">
                            <a href="{{ route('homepage') }}" class="menu-item {{ request()->routeIs('homepage') ? 'active' : ''}}">Home</a>
                            </li>
                        <li class="scroll-to-section">
                            <a href="{{ route('about') }}" class="menu-item {{ request()->routeIs('about') ? 'active' : ''}}">About
                            </a>
                        </li>
                        <li class="scroll-to-section">
                            <a href="{{ route('store') }}" class="menu-item {{ request()->routeIs('store') ? 'active' : ''}}">List Mitra
                            </a>
                        </li>
                        {{-- <li class="submenu">
                            <a href="javascript:;">Drop Down</a>
                            <ul>
                                <li><a href="" class="menu-item">About Us</a></li>
                                <li><a href="" class="menu-item">Features</a></li>
                                <li><a href="" class="menu-item">FAQ's</a></li>
                                <li><a href="" class="menu-item">Blog</a></li>
                            </ul>
                        </li> --}}
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->
