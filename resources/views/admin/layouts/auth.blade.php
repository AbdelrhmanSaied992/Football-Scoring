<!DOCTYPE html>
<head>
    @include('admin.includes.head')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/fontawesome/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/extra/colors.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/admin/css/application.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.min.css') }}">
</head>

<body>
    <div class="vironeer-sign-container">
        <div class="vironeer-sign-form">
            <div class="card">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/admin/js/application.js') }}"></script>
    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}')
            @endforeach
        </script>
    @elseif(session('status'))
        <script>
            toastr.success('{{ session('status') }}')
        </script>
    @endif
</body>

</html>
