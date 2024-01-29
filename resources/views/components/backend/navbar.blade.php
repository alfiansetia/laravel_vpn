<div class="header-container container-xxl">
    <header class="header navbar navbar-expand-sm expand-header">

        <a href="javascript:void(0);" class="sidebarCollapse">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-menu">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </a>

        <div class="search-animated toggle-search">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-search">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <form class="form-inline search-full form-inline search" role="search">
                <div class="search-bar">
                    <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Search...">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-x search-close">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
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

            <li class="nav-item theme-toggle-item">
                <a href="javascript:void(0);" class="nav-link theme-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-moon dark-mode">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-sun light-mode">
                        <circle cx="12" cy="12" r="5"></circle>
                        <line x1="12" y1="1" x2="12" y2="3"></line>
                        <line x1="12" y1="21" x2="12" y2="23"></line>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                        <line x1="1" y1="12" x2="3" y2="12"></line>
                        <line x1="21" y1="12" x2="23" y2="12"></line>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                    </svg>
                </a>
            </li>

            <li class="nav-item dropdown notification-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-bell">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg><span class="badge badge-success"></span>
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
