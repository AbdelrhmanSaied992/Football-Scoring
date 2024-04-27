<!DOCTYPE html>

<head>
    @include('admin.includes.head')
    @include('admin.includes.styles')
</head>

<body>
    @include('admin.includes.sidebar')
    <div class="vironeer-page-content">
        @include('admin.includes.header')
        <div class="container">
            <div class="vironeer-page-body">
                <div class="py-4 g-4">
                    <div class="row align-items-center">
                        <div class="col">
                            @include('admin.includes.breadcrumb')
                        </div>
                        <div class="col-auto">
                            @hasSection('back')
                                <a href="@yield('back')" class="btn btn-secondary"><i
                                        class="fas fa-arrow-left me-2"></i>{{ __('Back') }}</a>
                            @endif
                                @hasSection('link')
                                    <a href="@yield('link')" class="btn btn-primary me-2"><i class="fa fa-plus"></i></a>
                                @endif
                        </div>
                    </div>
                </div>
                @yield('content')
            </div>
        </div>
        @include('admin.includes.footer')
    </div>
    @include('admin.includes.scripts')
</body>

</html>
