<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
                    <p>Untuk memiliki akun silahkan daftar.</p>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ htmlentities($error) }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('register.post') }}" method="post">
                    @method('POST')
                    @csrf
                    <div class="row align-items-center">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Nama lengkap" name="name" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Username" name="username" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control form-control-lg bg-light fs-6" name="email"
                                placeholder="Email address" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Password" name="password" required>
                        </div>

                        <label for="type">Pilih Peran:</label>
                        <div class="input-group mb-1 mt-3">
                            <select class="form-select" name="type" id="type">
                                <option value="" selected disabled>Pilih salah satu</option>
                                <option value="dosen">Dosen</option>
                                <option value="mahasiswa">Mahasiswa</option>
                                <option value="masyarakat">Masyarakat</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-lg btn-primary w-100 fs-6 custom-btn">Daftar</button>
                        </div>
                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-lg btn-light w-100 fs-6">
                                <img src="{{ asset('images/google.png') }}" style="width:20px" class="me-2">
                                <small>Sign In with Google</small>
                            </button>
                        </div>
                        <div class="row">
                            <small>Sudah Punya Akun? <a href="{{ route('login') }}">Log In</a></small>
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

</html>
