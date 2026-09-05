{{-- <!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - Aplikasi Kepegawaian</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-6 col-md-8">

                <div class="card o-hidden border-0 shadow-lg my-5">

                    <div class="card-body p-0">

                        <div class="p-5">

                            <div class="text-center">

                                <h1 class="h4 text-gray-900 mb-4">
                                    Sistem Informasi Kepegawaian
                                </h1>

                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <form class="user" method="POST" action="{{ route('login') }}">

                                @csrf

                                <div class="form-group">

                                    <input type="email" name="email" class="form-control form-control-user"
                                        placeholder="Masukkan Email..." value="{{ old('email') }}" required autofocus>

                                </div>

                                <div class="form-group">

                                    <input type="password" name="password" class="form-control form-control-user"
                                        placeholder="Masukkan Password..." required>

                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">

                                    <i class="fas fa-sign-in-alt mr-2"></i>
                                    Login

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

</body>

</html> --}}

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Aplikasi Kepegawaian</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fc !important;
        }

        .login-card {
            border-radius: 8px;
            /* Sudut kartu tidak terlalu bulat */
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1) !important;
        }

        .brand-icon {
            width: 55px;
            height: 55px;
            background-color: #4e73df;
            color: #fff;
            border-radius: 10px;
            /* Lengkungan icon dibuat serasi dengan kartu */
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 15px;
        }

        /* Penyesuaian input & tombol standar tanpa kapsul (rounded-pill) */
        .form-control-custom {
            height: 45px;
            border-radius: 6px;
            font-size: 0.9rem;
        }

        .btn-custom {
            height: 45px;
            border-radius: 6px;
            font-size: 0.95rem;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container min-vh-100 d-flex align-items-center justify-content-center py-5">
        <div class="row justify-content-center w-100">
            <!-- Diperlebar menggunakan col-xl-5 col-lg-6 col-md-8 -->
            <div class="col-xl-5 col-lg-6 col-md-8">

                <div class="card border-0 login-card">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <div class="brand-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <h1 class="h4 text-gray-900 font-weight-bold mb-1">
                                SDM APP
                            </h1>
                            <p class="text-muted small mb-0">Sistem Informasi Kepegawaian</p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show text-left mb-4" role="alert">
                                <small>{{ $errors->first() }}</small>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label class="small text-gray-700 font-weight-bold mb-1" for="email">Email</label>
                                <input type="email" id="email" name="email"
                                    class="form-control form-control-custom" placeholder="Masukkan Email..."
                                    value="{{ old('email') }}" required autofocus>
                            </div>

                            <div class="form-group mb-4">
                                <label class="small text-gray-700 font-weight-bold mb-1" for="password">Password</label>
                                <input type="password" id="password" name="password"
                                    class="form-control form-control-custom" placeholder="Masukkan Password..."
                                    required>
                            </div>

                            <button type="submit"
                                class="btn btn-primary btn-custom btn-block font-weight-bold shadow-sm">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Login
                            </button>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-4 text-muted small">
                    Copyright &copy; Aplikasi Kepegawaian {{ date('Y') }}
                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
