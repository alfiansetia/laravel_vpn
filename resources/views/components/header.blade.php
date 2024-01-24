<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">
        <ul class="navbar-nav theme-brand flex-row text-center">
            <li class="nav-item theme-logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/img/logo') }}/{{ $company->logo }}" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="{{ route('home') }}" class="nav-link"> {{ $company->name }} </a>
            </li>
            <li class="nav-item toggle-sidebar">
                <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
                    <i data-feather="list"></i>
                </a>
            </li>
        </ul>

        @include('components.navbar')
    </header>
</div>
