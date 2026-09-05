<!DOCTYPE html>
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

</html>
