<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Aplikasi presensi siswa</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
</head>

<body class="bg-light-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/images/logos/logo.webp') }}" width="150px" alt="PRESENSI LOGO">
                            <h1 class="text-primary mt-3 mb-4"><strong>Aplikasi Presensi Siswa<strong></h1>
                        </div>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="usernameOrEmail" class="form-label">Username atau Email</label>
                                <input type="text" name="username_or_email" class="form-control" id="usernameOrEmail"
                                    aria-describedby="usernameOrEmailHelp" required
                                    placeholder="Masukkan username atau Email">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                    required placeholder="Masukkan password">
                            </div>
                            <button type="submit" value="Log In" class="btn btn-primary w-100 py-2 mb-3">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script rel="preload" src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script rel="preload" src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
