<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Klaim Ban | Login</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">

</head>

<body>
    <section class="section register min-vh-100 d-flex flex-column align-items-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                    <!-- Logo -->
                    <div class="d-flex justify-content-center py-3">
                        <img src="img/logo.png" alt="logo" width="220px" height="70px">
                    </div><!-- Batas Logo -->

                    <!-- Card -->
                    <div class="card mb-3">

                        <!-- Card body -->
                        <div class="card-body">

                            <!-- Judul -->
                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Sistem Informasi Klaim Ban</h5>
                                <p class="text-center small">Silahkan masukan Username dan Password anda</p>
                            </div><!-- Batas Judul -->

                            <!-- Pesan Error -->
                            @if ($message = session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <!-- Batas Pesan Error -->

                            <!-- Form Login -->
                            <form class="row g-3 " action="/login" method="post">
                                {{ csrf_field() }}

                                <!-- Inputan Username -->
                                <div class="col-12">
                                    <label for="yourUsername" class="form-label">Username</label>
                                    <div class="input-group has-validation">
                                        <input type="text" name="username" id="username" class="form-control"
                                            required autofocus>
                                        <div class="invalid-feedback">Harap masukan username anda.</div>
                                    </div>
                                </div><!-- Batas Inputan Username -->

                                <!-- Inputan Password -->
                                <div class="col-12 mb-3">
                                    <label for="yourPassword" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" required>
                                    <div class="invalid-feedback">Harap masukan Password anda!</div>
                                </div><!-- Batas Inputan Password -->

                                <!-- Tombol Login -->
                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Login</button>
                                </div><!-- Batas Tombol Login -->

                            </form><!-- Batas Form Login -->

                        </div><!-- Batas card body -->
                    </div><!-- Batas Card -->
                </div>
            </div>
        </div>

    </section>

    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
