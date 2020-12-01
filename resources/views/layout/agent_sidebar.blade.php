<div class="sidebar">
    <div class="logo text-center">
        <a href="{{ route('home') }}" class="logo-normal">
            <img src="{{ asset('img/logo.png') }}" alt="">
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('agent-dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'user' ? ' active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="material-icons">account_box</i>
                    <p>{{ __('Users') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'booking' ? ' active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="material-icons">assignment</i>
                    <p>{{ __('Booking') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'notification' ? ' active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="material-icons">notifications</i>
                    <p>{{ __('Notifications') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>