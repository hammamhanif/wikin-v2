@extends('tamplate.dashboard.maindashboard')

@push('styles')
    <style>
        .sales-card {
            position: relative;
            background-color: #d1e7fe;
            /* Warna biru */
            color: #fff;
            /* Warna teks putih */
            padding: 20px;
            /* Spasi dalam */
            border-radius: 10px;
            /* Sudut bulat */
        }

        .sales-card .card-body .text-primary {
            position: relative;
            /* Memastikan posisi teks tetap relatif */
            display: inline-block;
            /* Menjamin bahwa lebar elemen hanya cukup untuk konten */
            z-index: 1;
            /* Menaikkan z-index untuk teks di atas gambar */
        }

        .sales-card img {
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
            object-fit: cover;
            /* Mempertahankan aspek rasio gambar */
            z-index: 0;
            /* Menempatkan gambar di belakang konten */
        }
    </style>
@endpush
@section('dashboard')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <div class="row">
                            <div class="col-xxl-6 col-sm-12 col-md-12">
                                <div class="card info-card sales-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Selamat Datang di Dashboard</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="ps-3">
                                                <span
                                                    class="text-primary small pt-1 fw-bold">{{ Auth::user()->name }}</span>
                                            </div>
                                            <div class="ms-auto">
                                                <img src="{{ asset('img/welcome-bg.png') }}" alt="Image"
                                                    class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Sales Card -->

                            <div class="col-xxl-6 col-sm-12 col-md-12 mt-3 mt-xxl-0">
                                <div class="alert alert-warning" role="alert">
                                    <h5 class="alert-heading">Pemberitahuan</h5>
                                    <p>Untuk mengakses setiap fitur silahkan klik pilihan menu yang ada di bagian
                                        <strong>kiri.</strong> jangan lupa untuk selalu mengecek setiap status kegiatan yang
                                        telah kamu unggah!
                                    </p>
                                    <hr>
                                    Tetap semangat dalam berbagi ilmu!
                                </div>
                            </div><!-- End Alert -->
                        </div>


                        <!-- Revenue Card -->
                        <div class="col-xxl-3 col-xl-12">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Berita <span>| Postingan Kamu</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-radioactive"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>8</h6>
                                            <span class="text-success small pt-1 fw-bold">8%</span> <span
                                                class="text-muted small pt-2 ps-1">increase</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->
                        <div class="col-xxl-3 col-xl-12">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Berita <span>| Postingan Kamu</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-radioactive"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>8</h6>
                                            <span class="text-success small pt-1 fw-bold">8%</span> <span
                                                class="text-muted small pt-2 ps-1">increase</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->
                        <div class="col-xxl-3 col-xl-12">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Berita <span>| Postingan Kamu</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-radioactive"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>8</h6>
                                            <span class="text-success small pt-1 fw-bold">8%</span> <span
                                                class="text-muted small pt-2 ps-1">increase</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-3 col-xl-12">
                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">Pemas <span>| Pengajuan Kamu</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>1244</h6>
                                            <span class="text-danger small pt-1 fw-bold">12%</span> <span
                                                class="text-muted small pt-2 ps-1">decrease</span>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Aksi Cepat</h5>
                                    <p class="card-text">Pilih salah satu tindakan berikut:</p>
                                    <div class="row row-cols-1 row-cols-md-4 g-2">
                                        <div class="col">
                                            <a href="{{ route('communities.create') }}"
                                                class="btn btn-outline-warning w-100">Buat Komunitas</a>
                                        </div>
                                        <div class="col">
                                            <a href="{{ route('contact') }}" class="btn btn-outline-danger w-100">Hubungi
                                                Admin</a>
                                        </div>
                                        <div class="col">
                                            <a href="{{ route('requestpemas') }}"
                                                class="btn btn-outline-success w-100">Ajukan Pengabdian</a>
                                        </div>
                                        <div class="col">
                                            <a href="#berita" class="btn btn-outline-primary w-100">Tulis berita</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Reports -->
                        <div class="col-12">
                            <div class="card">

                                <div class="card-body" id="berita">
                                    <h5 class="card-title">Bagikan informasi seputar kenukliran</h5>
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

                                    <!-- TinyMCE Editor -->
                                    <form role="form text-left" action="{{ route('news.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @method('POST')
                                        @csrf
                                        <div class="mb-3 row">
                                            <div class="col-sm-6 col-xs-12">
                                                <label for="judul" class="col-sm-5 col-form-label">Judul</label>
                                                <input type="text" class="form-control" name="title" id="judul"
                                                    placeholder="Judul">
                                            </div>
                                            <div class="col-sm-6 col-xs-12 ">
                                                <label for="deskripsi" class="col-sm-5 col-form-label">Deskripsi</label>
                                                <input type="text" class="form-control" name="description"
                                                    id="deskripsi" placeholder="Deskripsi">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-6 col-xs-12">

                                                <label for="image" class="col-sm-5 col-form-label">Gambar (Apabila
                                                    Ada)</label>
                                                <input class="form-control" type="file" name="image" id="image"
                                                    accept="image/*">
                                            </div>

                                            <div class="col-sm-6 col-xs-12">
                                                <label for="category" class="form-label">Kategori</label>
                                                <select class="form-select" name="category" id="category">
                                                    <option value="Umum">Umum</option>
                                                    <option value="Kesehatan">Kesehatan</option>
                                                    <option value="Energi">Energi</option>
                                                    <option value="Industri">Industri</option>
                                                    <option value="Pangan">Pangan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="news" class="col-form-label">Konten</label>
                                            <textarea class="form-control" id="news" name="content"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Kirimkan</button>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- End Left side columns -->
                <!-- Right side columns -->
                <div class="col-lg-4">


                </div><!-- End Right side columns -->

            </div>
        </section>

    </main><!-- End #main -->


@endsection
