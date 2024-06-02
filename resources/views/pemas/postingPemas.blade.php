@extends('tamplate.dashboard.maindashboard')

@section('dashboard')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Informasi Pengabdian Masyarakat</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Pengajuan</li>
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
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title">Posting Program Pengabdian Masyarakatmu!</h5>
                                    <div class="alert alert-warning" role="alert">
                                        <strong class="font-bold">Pastikan!</strong>
                                        <span class="block sm:inline">Ajukan terlebih dahulu program pengabdian masyarakatmu
                                            di bagian
                                            pengajuan pengabdian.</span>
                                    </div>
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
                                    <form role="form text-left" action="{{ route('pemas.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @method('POST')
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="form_pemas_id" class="form-label">ID Pengajuan
                                                    Pengabdian :</label>
                                                <input type="text" class="form-control" name="form_pemas_id"
                                                    id="form_pemas_id" placeholder=" Masukkan Id Pemas..">
                                            </div>
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="location" class="form-label">Lokasi :</label>
                                                <input type="text" class="form-control" name="location" id="location"
                                                    placeholder="Lokasi">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" name="status_pemas" id="status">
                                                    <option value="pengajuan">Pengajuan</option>
                                                    <option value="pencarian volunteer">Pencarian Volunteer</option>
                                                    <option value="selesai">Selesai</option>
                                                    <option value="sedang berjalan">Sedang berjalan</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6 col-xs-12 mt-3">
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
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="image" class="col-sm-5 col-form-label">Gambar </label>
                                                <input class="form-control" type="file" name="image" id="image"
                                                    accept="image/*">
                                            </div>
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="lpj" class="col-sm-5 col-form-label">LPJ Kegiatan (apabila
                                                    selesai)</label>
                                                <input class="form-control" type="file" name="lpj" id="lpj"
                                                    accept=".pdf,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="news" class="col-form-label">Isi</label>
                                            <textarea class="form-control" id="news" name="content"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Kirimkan</button>
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
