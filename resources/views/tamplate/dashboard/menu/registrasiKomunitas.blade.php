@extends('tamplate.dashboard.maindashboard')

@section('dashboard')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Pendaftaran Komunitas</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item ">Menu Komunitas</li>
                    <li class="breadcrumb-item active">Daftar Komunitas </li>
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
                                <strong class="font-bold">Pastikan!</strong>
                                <span class="block sm:inline">Isi data yang sesuai dengan permintaan formulir</span>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title ">Daftar menjadi anggota komunitas</h5>
                                    <p>Nama Komunitas : {{ $communities->name }}</p>
                                    <p>Ketua Komunitas : {{ $communities->user->name }}</p>
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
                                    @if (Session::has('error'))
                                        <div class="alert alert-danger" role="alert">
                                            <strong class="font-bold">Error!</strong>
                                            <span class="block sm:inline">{{ session('error') }}</span>
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
                                    <form role="form text-left" id="updateNewsForm"
                                        action="{{ route('store.regKomunitas') }}" method="post"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="community_id" value="{{ $communities->id }}">
                                        @method('POST')
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="judul" class="form-label">Nama Komunitas : </label>
                                                <input type="text" class="form-control" name="name" id="judul"
                                                    placeholder="Judul" value="{{ $communities->name }}">
                                            </div>
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="deskripsi" class="form-label">Nama Pengguna :</label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                    placeholder="Deskripsi" value="{{ $user->name }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="argument" class="form-label">Alasan bergabung :</label>
                                            <textarea class="form-control" id="argument" name="argument" rows="4" required
                                                placeholder="Tuliskan alasan mengapa ingin masuk.."></textarea>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button type="button" class="btn btn-primary" id="submitBtn">Tambahkan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
        </section>

    </main><!-- End #main -->

    <script>
        // Ketika tombol submit diklik
        document.getElementById('submitBtn').addEventListener('click', function() {
            // Tampilkan SweetAlert konfirmasi
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "mendaftar di komunitas ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                // Jika pengguna mengonfirmasi
                if (result.isConfirmed) {
                    // Submit formulir
                    document.getElementById('updateNewsForm').submit();
                }
            });
        });
    </script>

@endsection
