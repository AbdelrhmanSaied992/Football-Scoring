<header class="vironeer-page-header">
    <div class="vironeer-sibebar-icon me-auto">
        <i class="fa fa-bars fa-lg"></i>
    </div>


    <div class="vironeer-user-menu">
        <div class="vironeer-user" id="dropdownMenuButton" data-bs-toggle="dropdown">
            <div class="vironeer-user-avatar">
                <img src="{{asset('images/avatars/default.png')}}" alt="{{  Auth::guard('admin')->user()->name }}" />
            </div>
            <div class="vironeer-user-info d-none d-md-block">
                <p class="vironeer-user-title mb-0">{{ Auth::guard('admin')->user()->name }}</p>
                <p class="vironeer-user-text mb-0">{{ Auth::guard('admin')->user()->email }}</p>
            </div>
        </div>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" ><i
                        class="fa fa-edit me-2"></i>{{ __('Details') }}</a></li>
            <li><a class="dropdown-item" ><i
                        class="fa fa-lock me-2"></i>{{ __('Security') }}</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button class="dropdown-item text-danger"><i
                            class="fas fa-sign-out-alt me-2"></i>{{ __('Logout') }}</button>
                </form>
            </li>
        </ul>
    </div>
</header>
