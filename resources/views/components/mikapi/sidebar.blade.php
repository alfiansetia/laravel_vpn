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

            <li class="menu {{ $title == 'Dashboard' ? 'active' : '' }}">
                <a href="{{ route('home') }}" aria-expanded="{{ $title == 'Dashboard' ? 'true' : 'false' }}"
                    class="dropdown-toggle">
                    <div class="">
                        <i data-feather="home"></i>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>

            <li class="menu menu-heading">
                <div class="heading">
                    <i data-feather="minus"></i><span>APPLICATIONS</span>
                </div>
            </li>
            <li class="menu">
                <a target="_blank" href="{{ $company->link_blog ?? 'javascript:void(0);' }}" aria-expanded="false"
                    class="dropdown-toggle">
                    <div class="">
                        <i data-feather="book"></i>
                        <span>Tutorial</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a target="_blank" href="{{ $company->link_status ?? 'javascript:void(0);' }}" aria-expanded="false"
                    class="dropdown-toggle">
                    <div class="">
                        <i data-feather="bar-chart"></i>
                        <span>Status Server</span>
                    </div>
                </a>
            </li>

            <li class="menu menu-heading">
                <div class="heading">
                    <i data-feather="minus"></i>
                    <span>SERVICE</span>
                </div>
            </li>
            <li
                class="menu {{ $title == 'Hotspot Profile' || $title == 'Hotspot User' || $title == 'Hotspot Active' || $title == 'Hotspot Host' || $title == 'Hotspot Binding' || $title == 'Hotspot Cookie' ? 'active' : '' }}">
                <a href="#hotspot_nav" data-bs-toggle="collapse"
                    aria-expanded="{{ $title == 'Hotspot Profile' || $title == 'Hotspot User' || $title == 'Hotspot Active' || $title == 'Hotspot Host' || $title == 'Hotspot Binding' || $title == 'Hotspot Cookie' ? 'true' : 'false' }}"
                    class="dropdown-toggle">
                    <div class="">
                        <i data-feather="share-2"></i>
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
                class="menu {{ $title == 'PPP Profile' || $title == 'PPP Secret' || $title == 'PPP Active' ? 'active' : '' }}">
                <a href="#ppp_nav" data-bs-toggle="collapse"
                    aria-expanded="{{ $title == 'PPP Profile' || $title == 'PPP Secret' || $title == 'PPP Active' ? 'true' : 'false' }}"
                    class="dropdown-toggle">
                    <div class="">
                        <i data-feather="share-2"></i>
                        <span> PPP </span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ $title == 'PPP Profile' || $title == 'PPP Secret' || $title == 'PPP Active' ? 'show' : '' }}"
                    id="ppp_nav" data-bs-parent="#accordionExample">
                    <li class="{{ $title == 'PPP Profile' ? 'active' : '' }}">
                        <a href="{{ route('mikapi.ppp.profile') }}{{ $param_router }}"> Profile </a>
                    </li>
                    <li class="{{ $title == 'PPP Secret' ? 'active' : '' }}">
                        <a href="{{ route('mikapi.hotspot.user') }}{{ $param_router }}"> Secret </a>
                    </li>
                    <li class="{{ $title == 'PPP Active' ? 'active' : '' }}">
                        <a href="{{ route('mikapi.hotspot.active') }}{{ $param_router }}"> Active </a>
                    </li>
                </ul>
            </li>

            <li class="menu {{ $title == 'Data Router' ? 'active' : '' }}">
                <a href="{{ route('router.index') }}" aria-expanded="{{ $title == 'Data Router' ? 'true' : 'false' }}"
                    class="dropdown-toggle">
                    <div class="">
                        <i data-feather="cloud"></i>
                        <span>List Router</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ $title == 'Log' ? 'active' : '' }}">
                <a href="{{ route('mikapi.log.index') }}?router={{ request()->query('router') }}"
                    aria-expanded="{{ $title == 'Log' ? 'true' : 'false' }}" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="cloud"></i>
                        <span>Log</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ $title == 'Data Server' ? 'active' : '' }}">
                <a href="#server_nav" data-bs-toggle="collapse"
                    aria-expanded="{{ $title == 'Data Server' ? 'true' : 'false' }}" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="server"></i>
                        <span>Server</span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ $title == 'Data Server' ? 'show' : '' }}"
                    id="server_nav" data-bs-parent="#accordionExample">
                    <li class="{{ $title == 'Data Server' ? 'active' : '' }}">
                        <a href="{{ url('server') }}"> List Server </a>
                    </li>
                </ul>
            </li>

            <li class="menu {{ $title == 'Data Invoice' ? 'active' : '' }}">
                <a href="{{ route('invoice.index') }}"
                    aria-expanded="{{ $title == 'Data Invoice' ? 'true' : 'false' }}" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="shopping-cart"></i>
                        <span>List Invoice</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ $title == 'Data User' || $title == 'Data Bank' ? 'active' : '' }}">
                <a href="#invoice" data-bs-toggle="collapse"
                    aria-expanded="{{ $title == 'Data User' || $title == 'Data Bank' ? 'true' : 'false' }}"
                    class="dropdown-toggle">
                    <div class="">
                        <i data-feather="database"></i>
                        <span>Master Data</span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ $title == 'Data User' || $title == 'Data Bank' ? 'show' : '' }}"
                    id="invoice" data-bs-parent="#accordionExample">
                    <li class="{{ $title == 'Data Bank' ? 'active' : '' }}">
                        <a href="{{ route('bank.index') }}"> Bank </a>
                    </li>
                    <li class="{{ $title == 'Data User' ? 'active' : '' }}">
                        <a href="{{ route('user.index') }}"> User </a>
                    </li>
                    <li>
                        <a href="tes"> Tes </a>
                    </li>
                    <li>
                        <a href="./app-invoice-edit.html"> Edit </a>
                    </li>
                </ul>
            </li>
            <li class="menu menu-heading">
                <div class="heading">
                    <i data-feather="minus"></i>
                    <span>SETTING</span>
                </div>
            </li>
            <li class="menu {{ $title == 'Setting Company' || $title == 'Setting Profile' ? 'active' : '' }}">
                <a href="#setting_nav" data-bs-toggle="collapse"
                    aria-expanded="{{ $title == 'Setting Company' || $title == 'Setting Profile' ? 'true' : 'false' }}"
                    class="dropdown-toggle">
                    <div class="">
                        <i data-feather="settings"></i>
                        <span> SETTING</span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ $title == 'Setting Company' || $title == 'Setting Profile' ? 'show' : '' }}"
                    id="setting_nav" data-bs-parent="#accordionExample">
                    <li class="{{ $title == 'Setting Profile' ? 'active' : '' }}">
                        <a href="{{ route('setting.profile.edit') }}"> Account </a>
                    </li>
                    <li class="{{ $title == 'Setting Company' ? 'active' : '' }}">
                        <a href="{{ route('setting.company.general') }}"> Company </a>
                    </li>
                </ul>
            </li>


        </ul>

    </nav>

</div>
