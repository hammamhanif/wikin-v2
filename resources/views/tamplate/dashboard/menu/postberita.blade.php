@extends('tamplate.dashboard.maindashboard')

@section('dashboard')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Posting Informasi Kenukliran</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item ">Berita</li>
                    <li class="breadcrumb-item active">Posting Berita</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Reports -->
                        <div class="col-12">
                            <div class="alert alert-warning" role="alert">
                                <strong class="font-bold">Cek Menu Berita !</strong>
                                <span class="block sm:inline">Apabila berita berhasil diposting</span>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title ">Tulis Informasi kenukliran yang ingin anda bagikan atau
                                        diskusikan</h5>
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
                                        <div class="mb-3">

                                            <label for="judul" class="col-sm-5 col-form-label">Judul</label>
                                            <input type="text" class="form-control" name="title" id="judul"
                                                placeholder="Judul">
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
                                        <div class="modal-footer justify-content-center">
                                            <button type="submit" class="btn btn-primary ">Kirimkan</button>
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
