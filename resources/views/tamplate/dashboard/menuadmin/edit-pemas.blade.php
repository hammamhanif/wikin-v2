@extends('tamplate.dashboard.maindashboard')

@push('news')
    <style>
        .image-container {
            width: 300px;
            /* Lebar gambar yang diinginkan */
            height: 200px;
            /* Tinggi gambar yang diinginkan */
            margin: 0 auto;
            /* Memposisikan gambar di tengah */
            overflow: hidden;
            /* Mengatasi jika gambar terlalu besar */
        }

        .image-container img {
            width: 100%;
            /* Memastikan gambar sesuai dengan lebar container */
            height: auto;
            /* Mengatur tinggi agar gambar tidak terdistorsi */
            display: block;
            /* Agar gambar berada di tengah */
        }
    </style>
@endpush

@section('dashboard')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Laporan Pengabdian Masyarakat</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item ">Menu Admin</li>
                    <li class="breadcrumb-item ">Pengabdian Masyarakat</li>
                    <li class="breadcrumb-item active">Edit Laporan Pengabdian Masyarakat</li>
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
                                    <h5 class="card-title ">Edit Laporan dan Open Recruitment Pengabdian Masyarakat</h5>
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
                                    <form role="form text-left" id="updateNewsForm"
                                        action="{{ route('pemas.updateAdmin', ['slug' => $pemas->slug]) }}" method="post"
                                        enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="image-container">
                                            @if ($pemas->image)
                                                <img src="{{ asset('storage/images/' . $pemas->image) }}" class="img-fluid"
                                                    alt="Gambar Berita">
                                            @endif
                                        </div>
                                        <div class="row mb-3 mt-3">
                                            <div class="">
                                                <p>Nama Pengabdian Masyarakat :
                                                    <strong>{{ htmlentities($pemas->formPemas->name) }}</strong>
                                                </p>
                                                <p>Lokasi :
                                                    <strong>{{ htmlentities($pemas->formPemas->location) }}</strong>
                                                </p>
                                                <p>Kategori :
                                                    <strong>{{ htmlentities($pemas->formPemas->category) }}</strong>
                                                </p>
                                                <p>Status Kegiatan :
                                                    <strong>{{ htmlentities($pemas->status_pemas) }}</strong>
                                                </p>
                                                <p>Pengguna yang mengajukan :
                                                    <strong>{{ htmlentities($pemas->user->name) }}
                                                        ({{ htmlentities($pemas->formPemas->noID) }})</strong>
                                                </p>
                                            </div>
                                        </div>
                                        <div class=" row mb-3">
                                            <div class="">
                                                <label for="user_id" class="form-label">ID Penanggung Jawab :</label>
                                                <input type="text" class="form-control" name="user_id" id="user_id"
                                                    placeholder="Ubah sesuai ID user.."
                                                    value="{{ htmlentities($pemas->formPemas->user->id) }}">
                                            </div>

                                        </div>
                                        <div class="row mb-3">
                                            <div class="">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" name="status" id="status">
                                                    <option value="Proses verifikasi"
                                                        @if ($pemas->status === 'Proses verifikasi') selected @endif>
                                                        Proses Verifikasi</option>
                                                    <option value="Diterima"
                                                        @if ($pemas->status === 'Diterima') selected @endif>
                                                        Diterima</option>
                                                    <option value="Ditolak"
                                                        @if ($pemas->status === 'Ditolak') selected @endif>
                                                        Ditolak</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="mb-3">
                                            <label for="news" class="col-form-label">Konten</label>
                                            <textarea class="form-control" id="news" name="content">{!! htmlentities($pemas->content) !!}</textarea>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type="button" class="btn btn-outline-primary"
                                                id="submitBtn">Ubah</button>
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

    <script>
        // Ketika tombol submit diklik
        document.getElementById('submitBtn').addEventListener('click', function() {
            // Tampilkan SweetAlert konfirmasi
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan menyimpan perubahan ini!",
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
