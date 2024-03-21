<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <div class="profile-info">
            <figure class="user-cover-image"></figure>
            <div class="user-info">
                <img src="{{ $user->avatar }}" alt="avatar">
                <h6 class="">{{ $user->name }}</h6>
                <p class="">
                    <span class="badge badge-success rounded">
                        {{ $user->role }}
                    </span>
                </p>
            </div>
        </div>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu {{ $title == 'Dashboard' ? 'active' : '' }}">
                <a href="{{ route('home') }}" aria-expanded="{{ $title == 'Dashboard' ? 'true' : 'false' }}"
                    class="dropdown-toggle">
                    <div class="">
                        <i data-feather="home"></i>
                        <span> Dashboard </span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="javascript:void(0);" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="book"></i>
                        <span> Tutorial </span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="https://stats.uptimerobot.com/Xkn03tnOPl" target="_blank" aria-expanded="false"
                    class="dropdown-toggle">
                    <div class="">
                        <i data-feather="bar-chart"></i>
                        <span> Status Server </span>
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
                class="menu {{ $title == 'Data Vpn' || $title == 'Order Vpn' || $title == 'Data Port' ? 'active' : '' }}">
                <a href="#vpn_nav" data-toggle="collapse"
                    aria-expanded="{{ $title == 'Data VPN' || $title == 'Order Vpn' || $title == 'Data Port' ? 'true' : 'false' }}"
                    class="dropdown-toggle">
                    <div class="">
                        <i data-feather="share-2"></i>
                        <span> Vpn </span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ $title == 'Data Vpn' || $title == 'Order Vpn' || $title == 'Data Port' ? 'show' : '' }}"
                    id="vpn_nav" data-parent="#accordionExample">
                    <li class="{{ $title == 'Order Vpn' ? 'active' : '' }}">
                        <a href="{{ route('vpn.create') }}"> Order Vpn </a>
                    </li>
                    <li class="{{ $title == 'Data Vpn' ? 'active' : '' }}">
                        <a href="{{ route('vpn.index') }}"> List Vpn </a>
                    </li>
                    @if (isAdmin())
                        <li class="{{ $title == 'Data Port' ? 'active' : '' }}">
                            <a href="{{ route('port.index') }}"> List Port </a>
                        </li>
                    @endif
                </ul>
            </li>


            <li class="menu {{ $title == 'Data Router' ? 'active' : '' }}">
                <a href="#router_nav" data-toggle="collapse"
                    aria-expanded="{{ $title == 'Data Router' ? 'true' : 'false' }}" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="cloud"></i>
                        <span> Router </span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ $title == 'Data Router' ? 'show' : '' }}" id="router_nav"
                    data-parent="#accordionExample">
                    <li class="{{ $title == 'Data Router' ? 'active' : '' }}">
                        <a href="{{ route('router.index') }}"> List Router </a>
                    </li>
                </ul>
            </li>

            @if (isAdmin())
                <li class="menu {{ $title == 'Data Server' ? 'active' : '' }}">
                    <a href="#server_nav" data-toggle="collapse"
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
                        id="server_nav" data-parent="#accordionExample">
                        <li class="{{ $title == 'Data Server' ? 'active' : '' }}">
                            <a href="{{ url('server') }}"> List Server </a>
                        </li>
                    </ul>
                </li>
            @endif

            <li class="menu menu-heading">
                <div class="heading">
                    <i data-feather="minus"></i>
                    <span>BILL</span>
                </div>
            </li>



            @if (isAdmin())
                <li class="menu menu-heading">
                    <div class="heading">
                        <i data-feather="minus"></i>
                        <span>USER</span>
                    </div>
                </li>
                <li class="menu {{ $title == 'Data User' || $title == 'Data Bank' ? 'active' : '' }}">
                    <a href="#user_nav" data-toggle="collapse"
                        aria-expanded="{{ $title == 'Data User' || $title == 'Data Bank' ? 'true' : 'false' }}"
                        class="dropdown-toggle">
                        <div class="">
                            <i data-feather="user"></i>
                            <span> MASTER DATA</span>
                        </div>
                        <div>
                            <i data-feather="chevron-right"></i>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled {{ $title == 'Data User' || $title == 'Data Bank' ? 'show' : '' }}"
                        id="user_nav" data-parent="#accordionExample">
                        <li class="{{ $title == 'Data Bank' ? 'active' : '' }}">
                            <a href="{{ route('bank.index') }}"> List Bank </a>
                        </li>
                        <li class="{{ $title == 'Data User' ? 'active' : '' }}">
                            <a href="{{ route('user.index') }}"> List User </a>
                        </li>
                    </ul>
                </li>

                <li class="menu menu-heading">
                    <div class="heading">
                        <i data-feather="minus"></i>
                        <span>SETTING</span>
                    </div>
                </li>
                <li class="menu {{ $title == 'Setting Company' || $title == 'Setting Telegram' ? 'active' : '' }}">
                    <a href="#setting_nav" data-toggle="collapse"
                        aria-expanded="{{ $title == 'Setting Company' || $title == 'Setting Telegram' ? 'true' : 'false' }}"
                        class="dropdown-toggle">
                        <div class="">
                            <i data-feather="settings"></i>
                            <span> SETTING</span>
                        </div>
                        <div>
                            <i data-feather="chevron-right"></i>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled {{ $title == 'Setting Company' || $title == 'Setting Telegram' ? 'show' : '' }}"
                        id="setting_nav" data-parent="#accordionExample">
                        <li class="{{ $title == 'Setting Company' ? 'active' : '' }}">
                            <a href="{{ route('setting.company.general') }}"> Company </a>
                        </li>
                        <li class="{{ $title == 'Setting Telegram' ? 'active' : '' }}">
                            <a href="{{ route('setting.company.telegram') }}"> Telegram </a>
                        </li>
                    </ul>
                </li>

                <li class="menu menu-heading">
                    <div class="heading">
                        <i data-feather="minus"></i>
                        <span>APP</span>
                    </div>
                </li>
                <li class="menu {{ $title == 'Backup Data' ? 'active' : '' }}">
                    <a href="#backup_nav" data-toggle="collapse"
                        aria-expanded="{{ $title == 'Backup Data' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="database"></i>
                            <span> BACKUP</span>
                        </div>
                        <div>
                            <i data-feather="chevron-right"></i>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled {{ $title == 'Backup Data' ? 'show' : '' }}"
                        id="backup_nav" data-parent="#accordionExample">
                        <li class="{{ $title == 'Backup Data' ? 'active' : '' }}">
                            <a href="{{ route('setting.company.backup') }}"> Backup Data </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </nav>
</div>
