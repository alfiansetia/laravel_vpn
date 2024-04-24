@php
    $param_router = '?router=' . request()->query('router');
@endphp

<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="navbar-nav theme-brand flex-row  text-center">
            <div class="nav-logo">
                <div class="nav-item theme-logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ $company->logo_light }}" class="navbar-logo" alt="logo">
                    </a>
                </div>
                <div class="nav-item theme-text">
                    <a href="{{ route('home') }}" class="nav-link"> {{ $company->name }} </a>
                </div>
            </div>
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <i data-feather="chevrons-left"></i>
                </div>
            </div>
        </div>
        <div class="profile-info">
            <div class="user-info">
                <div class="profile-img">
                    <img src="{{ $user->avatar }}" alt="avatar">
                </div>
                <div class="profile-content">
                    <h6 class="">{{ $user->name }}</h6>
                    <p class="">{{ $user->role }}</p>
                </div>
            </div>
        </div>

        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">

            <li class="menu {{ $title == 'Data Router' ? 'active' : '' }}">
                <a href="{{ route('router.index') }}" aria-expanded="{{ $title == 'Data Router' ? 'true' : 'false' }}"
                    class="dropdown-toggle">
                    <div class="">
                        <i data-feather="cloud"></i>
                        <span>List Router</span>
                    </div>
                </a>
            </li>

            <li class="menu menu-heading">
                <div class="heading">
                    <i data-feather="minus"></i>
                    <span>SERVICE</span>
                </div>
            </li>

            <li class="menu {{ $title == 'Dashboard' ? 'active' : '' }}">
                <a href="{{ route('mikapi.dashboard') }}{{ $param_router }}"
                    aria-expanded="{{ $title == 'Dashboard' ? 'true' : 'false' }}" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="home"></i>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>

            <li
                class="menu {{ $title == 'Hotspot Profile' || $title == 'Hotspot User' || $title == 'Hotspot Active' || $title == 'Hotspot Host' || $title == 'Hotspot Binding' || $title == 'Hotspot Cookie' ? 'active' : '' }}">
                <a href="#hotspot_nav" data-bs-toggle="collapse"
                    aria-expanded="{{ $title == 'Hotspot Profile' || $title == 'Hotspot User' || $title == 'Hotspot Active' || $title == 'Hotspot Host' || $title == 'Hotspot Binding' || $title == 'Hotspot Cookie' ? 'true' : 'false' }}"
                    class="dropdown-toggle">
                    <div class="">
                        <i data-feather="wifi"></i>
                        <span> Hotspot </span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ $title == 'Hotspot Profile' || $title == 'Hotspot User' || $title == 'Hotspot Active' || $title == 'Hotspot Host' || $title == 'Hotspot Binding' || $title == 'Hotspot Cookie' ? 'show' : '' }}"
                    id="hotspot_nav" data-bs-parent="#accordionExample">
                    <li class="{{ $title == 'Hotspot Profile' ? 'active' : '' }}">
                        <a href="{{ route('mikapi.hotspot.profile') }}{{ $param_router }}"> Profile </a>
                    </li>
                    <li class="{{ $title == 'Hotspot User' ? 'active' : '' }}">
                        <a href="{{ route('mikapi.hotspot.user') }}{{ $param_router }}"> User </a>
                    </li>
                    <li class="{{ $title == 'Hotspot Active' ? 'active' : '' }}">
                        <a href="{{ route('mikapi.hotspot.active') }}{{ $param_router }}"> Active </a>
                    </li>
                    <li class="{{ $title == 'Hotspot Host' ? 'active' : '' }}">
                        <a href="{{ route('mikapi.hotspot.host') }}{{ $param_router }}"> Host </a>
                    </li>
                    <li class="{{ $title == 'Hotspot Binding' ? 'active' : '' }}">
                        <a href="{{ route('mikapi.hotspot.binding') }}{{ $param_router }}"> Binding </a>
                    </li>
                    <li class="{{ $title == 'Hotspot Cookie' ? 'active' : '' }}">
                        <a href="{{ route('mikapi.hotspot.cookie') }}{{ $param_router }}"> Cookie </a>
                    </li>
                </ul>
            </li>

            <li
                class="menu {{ $title == 'PPP Profile' || $title == 'PPP Secret' || $title == 'PPP Active' || $title == 'PPP L2tp Secret' ? 'active' : '' }}">
                <a href="#ppp_nav" data-bs-toggle="collapse"
                    aria-expanded="{{ $title == 'PPP Profile' || $title == 'PPP Secret' || $title == 'PPP Active' || $title == 'PPP L2tp Secret' ? 'true' : 'false' }}"
                    class="dropdown-toggle">
                    <div class="">
                        <i data-feather="share-2"></i>
                        <span> PPP </span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ $title == 'PPP Profile' || $title == 'PPP Secret' || $title == 'PPP Active' || $title == 'PPP L2tp Secret' ? 'show' : '' }}"
                    id="ppp_nav" data-bs-parent="#accordionExample">
                    <li class="{{ $title == 'PPP Profile' ? 'active' : '' }}">
                        <a href="{{ route('mikapi.ppp.profile') }}{{ $param_router }}"> Profile </a>
                    </li>
                    <li class="{{ $title == 'PPP Secret' ? 'active' : '' }}">
                        <a href="{{ route('mikapi.ppp.secret') }}{{ $param_router }}"> Secret </a>
                    </li>
                    <li class="{{ $title == 'PPP Active' ? 'active' : '' }}">
                        <a href="{{ route('mikapi.ppp.active') }}{{ $param_router }}"> Active </a>
                    </li>
                    <li class="{{ $title == 'PPP L2tp Secret' ? 'active' : '' }}">
                        <a href="{{ route('mikapi.ppp.l2tp_secret') }}{{ $param_router }}"> L2tp Secret </a>
                    </li>
                </ul>
            </li>

            <li class="menu {{ $title == 'Log' ? 'active' : '' }}">
                <a href="{{ route('mikapi.log.index') }}{{ $param_router }}"
                    aria-expanded="{{ $title == 'Log' ? 'true' : 'false' }}" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="list"></i>
                        <span>Log</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ $title == 'DHCP Lease' ? 'active' : '' }}">
                <a href="{{ route('mikapi.dhcp.lease') }}{{ $param_router }}"
                    aria-expanded="{{ $title == 'DHCP Lease' ? 'true' : 'false' }}" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="smartphone"></i>
                        <span>DHCP Lease</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ $title == 'Monitor Interface' ? 'active' : '' }}">
                <a href="{{ route('mikapi.monitor.interface') }}{{ $param_router }}"
                    aria-expanded="{{ $title == 'Monitor Interface' ? 'true' : 'false' }}" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="monitor"></i>
                        <span>Monitor</span>
                    </div>
                </a>
            </li>

            <li class="menu menu-heading">
                <div class="heading">
                    <i data-feather="minus"></i>
                    <span>SETTING</span>
                </div>
            </li>
            <li
                class="menu {{ $title == 'System Routerboard' || $title == 'System Resource' || $title == 'System User' || $title == 'System Group' || $title == 'User Active' ? 'active' : '' }}">
                <a href="#system_nav" data-bs-toggle="collapse"
                    aria-expanded="{{ $title == 'System Routerboard' || $title == 'System Resource' || $title == 'System User' || $title == 'System Group' || $title == 'User Active' ? 'true' : 'false' }}"
                    class="dropdown-toggle">
                    <div class="">
                        <i data-feather="cpu"></i>
                        <span> SYSTEM</span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ $title == 'System Routerboard' || $title == 'System Resource' || $title == 'System User' || $title == 'System Group' || $title == 'User Active' ? 'show' : '' }}"
                    id="system_nav" data-bs-parent="#accordionExample">
                    <li class="{{ $title == 'System Routerboard' ? 'active' : '' }}">
                        <a href="{{ route('mikapi.system.routerboard') }}{{ $param_router }}"> Routerboard </a>
                    </li>
                    <li class="{{ $title == 'System Resource' ? 'active' : '' }}">
                        <a href="{{ route('mikapi.system.resource') }}{{ $param_router }}"> Resource </a>
                    </li>
                    <li class="{{ $title == 'System User' ? 'active' : '' }}">
                        <a href="{{ route('mikapi.system.user') }}{{ $param_router }}"> User </a>
                    </li>
                    <li class="{{ $title == 'System Group' ? 'active' : '' }}">
                        <a href="{{ route('mikapi.system.group') }}{{ $param_router }}"> Group </a>
                    </li>
                    <li class="{{ $title == 'User Active' ? 'active' : '' }}">
                        <a href="{{ route('mikapi.system.user_active') }}{{ $param_router }}"> User Active </a>
                    </li>
                </ul>
            </li>

            <li class="menu menu-heading"></li>
            <li class="menu menu-heading"></li>
            <li class="menu menu-heading"></li>



        </ul>

    </nav>

</div>
