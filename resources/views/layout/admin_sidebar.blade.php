<div class="sidebar">
    <div class="logo text-center">
        <a href="{{ route('home') }}" class="logo-normal">
            <img src="{{ asset('img/logo.png') }}" alt="">
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin-dashboard') }}">
                    <i class="fas fa-th-large"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="nav-item {{ ($activePage == 'account' || $activePage == 'agent' || $activePage == 'counter') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#user-management">
                    <i class="fas fa-users"></i>
                    <p>{{ __('Users') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ ($activePage == 'account' || $activePage == 'agent' || $activePage == 'counter') ? ' show' : '' }}" id="user-management">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'account' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('admin-account') }}">
                                <i class="fa fa-angle-right"></i>
                                <span class="sidebar-normal">{{ __('Accounts') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'agent' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('admin-agent') }}">
                                <i class="fa fa-angle-right"></i>
                                <span class="sidebar-normal"> {{ __('Agents') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'counter' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('admin-counter') }}">
                                <i class="fa fa-angle-right"></i>
                                <span class="sidebar-normal"> {{ __('Counters') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item{{ $activePage == 'booking' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin-booking') }}">
                    <i class="far fa-clipboard"></i>
                    <p>{{ __('Booking') }}</p>
                </a>
            </li>
            <li class="nav-item{{ ($activePage == 'event' || $activePage == 'show') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin-event-list') }}">
                    <i class="fas fa-film"></i>
                    <p>{{ __('Shows') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'hall' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin-hall') }}">
                    <i class="far fa-life-ring"></i>
                    <p>{{ __('Halls') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'promotion' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin-promotion-package') }}">
                    <i class="fas fa-gift"></i>
                    <p>{{ __('Promotion') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'options' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin-options') }}">
                    <i class="fas fa-wrench"></i>
                    <p>{{ __('Options') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'notification' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin-notifications') }}">
                    <i class="fas fa-bell"></i>
                    <p>{{ __('Notifications') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'report' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin-report') }}">
                    <i class="fas fa-file-alt"></i>
                    <p>{{ __('Report') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>