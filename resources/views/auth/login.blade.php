<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('templateadmin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('templateadmin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('templateadmin/dist/css/adminlte.min.css') }}">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('templateadmin/dist/img/AdminLTELogo.png') }}">
    <!-- Google reCAPTCHA Script -->
    {!! NoCaptcha::renderJs() !!}
</head>

<body class="hold-transition login-page">

    <div class="card">
        <div class="card-body login-card-body">
            <div class="login-box">
                <div class="login-logo">
                    <a href=""><b>Diskominfo SP</b></a>
                    <div class="text-center mt-2">
                        <img src="{{ asset('image/logo/logodiskominfo.png') }}" alt="Logo Diskominfo"
                            style="height: 80px;">
                    </div>
                </div>

                <p class="text-center">Masukkan username & password untuk login</p>

                @if (session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->has('username'))
                    <div class="alert alert-danger text-center">
                        {{ $errors->first('username') }}
                    </div>
                @endif

                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    {{-- ✅ reCAPTCHA --}}
                    <div class="mb-3">
                        {!! NoCaptcha::display() !!}
                        @error('g-recaptcha-response')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-6 d-flex gap-3">
                        <button type="submit" class="btn btn-primary btn-block w-60 text-nowrap">Masuk</button> <br>
                        <a href="{{ route('password.request') }}"
                            class="btn btn-outline-secondary w-60 text-nowrap">Lupa Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('templateadmin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('templateadmin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('templateadmin/dist/js/adminlte.min.js') }}"></script>

</body>

</html>
