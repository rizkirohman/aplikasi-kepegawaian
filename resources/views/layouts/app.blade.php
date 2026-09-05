<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title', 'Aplikasi SDM')</title>

    <!-- Custom fonts -->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- SB Admin 2 -->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    @stack('styles')

</head>

<body id="page-top">

    <div id="wrapper">

        {{-- Sidebar --}}
        @include('partials.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                {{-- Navbar --}}
                @include('partials.navbar')

                {{-- Halaman --}}
                <div class="container-fluid">

                    @yield('content')

                </div>

            </div>

            {{-- Footer --}}
            @include('partials.footer')

        </div>

    </div>

    <!-- Scroll to Top Button -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript -->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts -->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

    @stack('scripts')

</body>

</html>
