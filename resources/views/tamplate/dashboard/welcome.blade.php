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
                            <div class="card info-card pemas-card">
                                <div class="card-body">
                                    <h5 class="card-title">Berita <span>| Postingan Kamu</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-newspaper"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>8</h6>
                                            <span class="text-info small pt-1 fw-bold">8%</span> <span
                                                class="text-muted small pt-2 ps-1">increase</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->
                        <div class="col-xxl-3 col-xl-12">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Komunitas <span>| Kamu ikuti</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
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
                            <div class="card info-card pengmas-card">
                                <div class="card-body">
                                    <h5 class="card-title">Pemas <span>| kamu ikuti</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-heart-fill"></i>
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
                                            <i class="bi bi-tree-fill"></i>
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
                                            <a href="{{ route('post.informasi') }}"
                                                class="btn btn-outline-primary w-100">Tulis berita</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h5 class="text-center title-informasi">Informasi Penting</h5>
                            <div class="container">
                                <div class="card-container d-flex justify-content-center">
                                    <div class="row row-cols-2 row-cols-lg-4 justify-content-center">
                                        @foreach ($pengmases as $pemas)
                                            <div class="card col " style="width: 18rem; margin-right: 10px;">
                                                <img src="{{ asset('storage/images/' . $pemas->image) }}"
                                                    class="card-img-top" alt="..."
                                                    style="width: 100%; height: 200px; object-fit: cover;">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">{{ $pemas->name }}</h5>
                                                    <p class="card-text">{!! $pemas->content !!}</p>

                                                    <p class="card-text text-center">({{ $pemas->location }})</p>

                                                    <div class="d-flex justify-content-around">
                                                        <a href="{{ route('registrasiPemas', ['slug' => $pemas->slug]) }}"
                                                            class="btn btn-outline-primary mx-2">Daftar Anggota</a>
                                                        <a href="{{ route('detailpemas', $pemas->slug) }}"
                                                            class="btn btn-outline-success mx-2">Detail Informasi</a>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ $pengmases->links() }}

                    </div>
                </div><!-- End Left side columns -->
                <!-- Right side columns -->
                <div class="col-lg-4">


                </div><!-- End Right side columns -->

            </div>
        </section>

    </main><!-- End #main -->
@endsection
