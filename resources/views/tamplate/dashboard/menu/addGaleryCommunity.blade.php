@extends('tamplate.dashboard.maindashboard')

@section('dashboard')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Posting Galeri Kegiatan Komunitas</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item ">Menu Komunitas</li>
                    <li class="breadcrumb-item active">Galeri</li>
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
                                    <h5 class="card-title ">Tambahkan Galeri Komunitas anda!</h5>
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
                                    <form role="form text-left" id="updateNewsForm" action="{{ route('galeri.store') }}"
                                        method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="community_id" value="{{ $community->id }}">
                                        @method('POST')
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="judul" class="form-label">Judul </label>
                                                <input type="text" class="form-control" name="title" id="judul"
                                                    placeholder="Judul">
                                            </div>
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                                <input type="text" class="form-control" name="description" id="deskripsi"
                                                    placeholder="Deskripsi" value="">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-12">
                                                <label for="image" class="col-sm-5 col-form-label">Gambar()</label>
                                                <input class="form-control" type="file" name="image" id="image"
                                                    accept="image/*">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="submitBtn">Tambahkan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="container">
                                <div class="card-container d-flex justify-content-center">
                                    <div class="row row-cols-2 row-cols-lg-4 justify-content-center">
                                        @foreach ($galleries as $gallery)
                                            <div class="card col " style="width: 18rem; margin-right: 10px;">
                                                <img src="{{ asset('storage/' . $gallery->image) }}" class="card-img-top"
                                                    alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">{{ $gallery->title }}</h5>
                                                    <p class="card-text">{{ $gallery->description }}</p>
                                                    <form id="deleteForm"
                                                        action="{{ route('galeri.delete', ['id' => $gallery->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-outline-danger mt-3 mb-3">Hapus</button>
                                                    </form>

                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
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
                text: "Menambahkan Galeri ini!",
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
    <script>
        document.getElementById('submitButton').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior

            // Trigger form submission
            document.getElementById('myForm').submit();
        });
    </script>
@endsection
