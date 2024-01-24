<ul class="navbar-item flex-row navbar-dropdown ml-auto">
    <li class="nav-item dropdown user-profile-dropdown order-lg-0 order-1">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i data-feather="settings"></i>
        </a>
        <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
            <div class="user-profile-section">
                <div class="media mx-auto">
                    <img src="{{ $user->avatar }}" class="img-fluid mr-2" alt="avatar">
                    <div class="media-body">
                        <h5>{{ $user->name }}</h5>
                        <p>
                            {{ $user->role }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="dropdown-item">
                <a href="{{ route('setting.profile') }}">
                    <i data-feather="user"></i> <span>My Profile</span>
                </a>
            </div>
            <div class="dropdown-item">
                <a href="javascript:void(0);">
                    <i data-feather="inbox"></i> <span>My Inbox</span>
                </a>
            </div>
            <div class="dropdown-item">
                <a href="javascript:void(0);">
                    <i data-feather="lock"></i> <span>Lock Screen</span>
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
