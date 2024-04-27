<aside class="vironeer-sidebar">
    <div class="overlay"></div>
    <div class="vironeer-sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="vironeer-sidebar-logo">
            <img src="{{ asset('images/dashboard/dark-logo.png') }}" alt="{{ 'Football Scoring' }}" />
        </a>
    </div>
    <div class="vironeer-sidebar-menu" data-simplebar>
        <div class="vironeer-sidebar-links">
            <div class="vironeer-sidebar-links-cont">
                <a href="{{ route('admin.dashboard') }}"
                    class="vironeer-sidebar-link p-5 @if (request()->segment(2) == 'dashboard') current @endif">
                    <p class="vironeer-sidebar-link-title">
                        <span><i class="fas fa-th-large"></i>{{ __('Dashboard') }}</span>
                    </p>
                </a>

                <a href="{{ route('admin.teams.index') }}"
                   class="vironeer-sidebar-link p-5 @if (request()->segment(2) == 'teams') current @endif">
                    <p class="vironeer-sidebar-link-title">
                        <span><i class="fas fa-futbol"></i>{{ __('Teams') }}</span>
                    </p>
                </a>

                <a href="{{ route('admin.tournaments.index') }}"
                   class="vironeer-sidebar-link p-5 @if (request()->segment(2) == 'tournaments') current @endif">
                    <p class="vironeer-sidebar-link-title">
                        <span><i class="fas fa-trophy"></i>{{ __('Tournaments') }}</span>
                    </p>
                </a>

                <a href="{{ route('admin.matches.index') }}"
                   class="vironeer-sidebar-link p-5 @if (request()->segment(2) == 'matches') current @endif">
                    <p class="vironeer-sidebar-link-title">
                        <span><i class="fas fa-tv"></i>{{ __('Matches') }}</span>
                    </p>
                </a>
        </div>
    </div>
</aside>
