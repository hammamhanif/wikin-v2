<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="{{ asset('img/logo.png') }}" rel="icon">
    <link href="{{ asset('img/logo.png') }}" rel="apple-touch-icon">
    <title>Wikin | Website Interaktif Komunitas Nuklir Indonesia</title>
</head>

<body>

    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!----------------------- Login Container -------------------------->

        <div class="row border rounded-5 p-3 bg-white shadow box-area">

            <!--------------------------- Left Box ----------------------------->

            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
                style="background: #6f2da8">
                <div class="featured-image mb-3">
                    <img src="{{ asset('images/1.png') }}" class="img-fluid" style="width: 250px;">
                </div>
                <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Be
                    Verified</p>
                <small class="text-white text-wrap text-center"
                    style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Bergabung untuk mengetahui
                    nuklir lebih dalam!</small>
            </div>

            <!-------------------- ------ Right Box ---------------------------->

            <div class="col-md-6 right-box">
                <div class="header-text mb-4">
                    <h2>Selamat Datang!</h2>
                    <p>Untuk membuat berita silahkan masuk terlebih dahulu.</p>
                </div>
                <div class="pt-4 pb-2">
                    @if (Session::has('status'))
                        <div class="alert alert-success" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('status') }}</span>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-primary" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    @if (Session::has('unsuccess'))
                        <div class="alert alert-danger" role="alert">
                            <strong class="font-bold">Unsuccess!</strong>
                            <span class="block sm:inline">{{ session('unsuccess') }}</span>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ htmlentities($error) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <form action="{{ route('login.post') }}" method="post">
                    @method('POST')
                    @csrf
                    <div class="row align-items-center">

                        <div class="input-group mb-3">
                            <input type="email" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Masukkan Alamat Email" name="email">
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" class="form-control form-control-lg bg-light fs-6"
                                placeholder=" Masukkan Password" name="password">
                        </div>
                        <div class="form-group mb-3 mt-2">
                            <div class="captcha">
                                <span id="captcha-img">{!! captcha_img() !!}</span>
                                <button type="button" class="btn btn-primary reload" id="reload">&#x21bb;</button>
                            </div>
                        </div>
                        <div class="input-group mb-1">
                            <input type="text" id="captcha" name="captcha" required placeholder="Masukkan Captcha">
                        </div>
                        <div class="input-group mb-5 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="formCheck" name="remember">
                                <label for="formCheck" class="form-check-label text-secondary"><small>Ingat
                                        saya</small></label>
                            </div>
                            <div class="forgot">
                                <small><a href="{{ route('forgot') }}">Lupa password?</a></small>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-lg btn-primary w-100 fs-6 custom-btn">Login</button>
                        </div>
                        <div class="input-group mb-3">
                            <a href="{{ route('user.login.google') }}" class="btn btn-lg btn-light w-100 fs-6"
                                role="button">
                                <img src="{{ asset('images/google.png') }}" style="width:20px" class="me-2">
                                <small>Daftar dengan Google</small>
                            </a>

                        </div>
                        <div class="row">
                            <small>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></small>
                        </div>
                        <div class="row">
                            <a href="{{ route('home') }}">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the reload button and captcha image
        var reloadButton = document.getElementById('reload');
        var captchaImage = document.getElementById('captcha-img');

        // Attach a click event listener to the reload button
        reloadButton.addEventListener('click', function() {
            // Generate a new captcha image URL by adding a timestamp parameter
            var captchaImageUrl = "{{ route('captcha') }}?" + Date.now();

            // Update the src attribute of the captcha image with the new URL
            captchaImage.innerHTML = '<img src="' + captchaImageUrl + '" alt="Captcha Image">';
        });
    });
</script>

</html>
