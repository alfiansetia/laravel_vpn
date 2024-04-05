<div class="header-container container-xxl">
    <header class="header navbar navbar-expand-sm expand-header">

        <a href="javascript:void(0);" class="sidebarCollapse">
            <i data-feather="menu"></i>
        </a>

        <div class="search-animated toggle-search">
            <i data-feather="search"></i>
            <form class="form-inline search-full form-inline search" role="search">
                <div class="search-bar">
                    <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Search...">
                    <i data-feather="x" class="search-close"></i>
                </div>
            </form>
            <span class="badge badge-secondary">Ctrl + /</span>
        </div>

        <ul class="navbar-item flex-row ms-lg-auto ms-0">

            {{-- <li class="nav-item dropdown language-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="language-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('backend/src/assets/img/1x1/us.svg') }}" class="flag-width" alt="flag">
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="language-dropdown">
                    <a class="dropdown-item d-flex" href="javascript:void(0);"><img
                            src="{{ asset('backend/src/assets/img/1x1/us.svg') }}" class="flag-width" alt="flag">
                        <span class="align-self-center">&nbsp;English</span></a>
                    <a class="dropdown-item d-flex" href="javascript:void(0);"><img
                            src="{{ asset('backend/src/assets/img/1x1/tr.svg') }}" class="flag-width" alt="flag">
                        <span class="align-self-center">&nbsp;Turkish</span></a>
                    <a class="dropdown-item d-flex" href="javascript:void(0);"><img
                            src="{{ asset('backend/src/assets/img/1x1/br.svg') }}" class="flag-width" alt="flag">
                        <span class="align-self-center">&nbsp;Portuguese</span></a>
                    <a class="dropdown-item d-flex" href="javascript:void(0);"><img
                            src="{{ asset('backend/src/assets/img/1x1/in.svg') }}" class="flag-width" alt="flag">
                        <span class="align-self-center">&nbsp;Hindi</span></a>
                    <a class="dropdown-item d-flex" href="javascript:void(0);"><img
                            src="{{ asset('backend/src/assets/img/1x1/de.svg') }}" class="flag-width" alt="flag">
                        <span class="align-self-center">&nbsp;German</span></a>
                </div>
            </li> --}}
            <li class="nav-item">
                <a href="javascript:void(0);" class="nav-link">
                    <i data-feather="refresh-cw" class="refresh-data bs-tooltip" title="Refresh Data"></i>
                </a>
            </li>

            <li class="nav-item theme-toggle-item">
                <a href="javascript:void(0);" class="nav-link theme-toggle">
                    <i data-feather="moon" class="dark-mode"></i>
                    <i data-feather="sun" class="light-mode"></i>
                </a>
            </li>

            <li class="nav-item dropdown notification-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="bell"></i>
                    <span class="badge badge-success"></span>
                </a>

                <div class="dropdown-menu position-absolute" aria-labelledby="notificationDropdown">
                    <div class="drodpown-title message">
                        <h6 class="d-flex justify-content-between"><span class="align-self-center">Notification</span>
                            <span class="badge badge-primary">{{ $user->notification_unreads_count }} Unread</span>
                        </h6>
                    </div>
                    <div class="notification-scroll">
                        @foreach ($user->notification_unreads as $item)
                            <div class="dropdown-item">
                                <div class="media server-log">
                                    <i data-feather="user"></i>
                                    <div class="media-body">
                                        <div class="data-info">
                                            <h6 class="">{{ $item->notification->title }}</h6>
                                            <p class="">{{ $item->notification->date }}</p>
                                        </div>

                                        <div class="icon-status">
                                            <i data-feather="x" class="bs-tooltip" title="Mark as read"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

            </li>

            <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar-container">
                        <div class="avatar avatar-sm avatar-indicators avatar-online">
                            <img alt="avatar" src="{{ $user->avatar }}" class="rounded-circle">
                        </div>
                    </div>
                </a>

                <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                    <div class="user-profile-section">
                        <div class="media mx-auto">
                            <div class="emoji me-2">
                                &#x1F44B;
                            </div>
                            <div class="media-body">
                                <h5>{{ $user->name }}</h5>
                                <p>{{ $user->role }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-item">
                        <a href="{{ route('setting.profile') }}">
                            <i data-feather="user"></i><span>Profile</span>
                        </a>
                    </div>
                    <div class="dropdown-item">
                        <a href="javascript:void(0);" onclick="logout_()">
                            <i data-feather="log-out"></i> <span>Log Out</span>
                        </a>
                    </div>
                </div>

            </li>
        </ul>
    </header>
</div>
