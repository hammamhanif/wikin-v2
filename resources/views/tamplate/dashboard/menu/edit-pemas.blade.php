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
            <h1>Edit Postingan Pengabdian Masyarakat</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item ">Menu Admin</li>
                    <li class="breadcrumb-item ">Pengabdian Masyarakat</li>
                    <li class="breadcrumb-item active">Edit Pengabdian Masyarakat</li>
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
                                    <h5 class="card-title ">Edit Pengabdian Masyarakat</h5>
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
                                        action="{{ route('pemas.update', ['slug' => $pemas->slug]) }}" method="post"
                                        enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="image-container">
                                            @if ($pemas->image)
                                                <img src="{{ asset('storage/images/' . $pemas->image) }}" class="img-fluid"
                                                    alt="Gambar Berita">
                                            @endif
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="judul" class="form-label">Nama Pengabdian Masyarakat </label>
                                                <input type="text" class="form-control" name="name" id="judul"
                                                    placeholder="Nama Pengabdian Masyarakat.."
                                                    value="{{ htmlentities($pemas->formPemas->nama_kegiatan) }}">
                                            </div>
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="deskripsi" class="form-label">Nama Pembuat</label>
                                                <input type="text" class="form-control" name="description" id="deskripsi"
                                                    placeholder="Deskripsi" value="{{ htmlentities($pemas->user->name) }}"
                                                    pemas readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="image" class="col-sm-5 col-form-label">Gambar</label>
                                                <input class="form-control" type="file" name="image" id="image"
                                                    accept="image/*">
                                            </div>
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="lpj" class="col-sm-5 col-form-label">LPJ Kegiatan</label>
                                                <input class="form-control" type="file" name="lpj" id="lpj"
                                                    accept=".pdf,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                            </div>

                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="category" class="form-label">Kategori</label>
                                                <select class="form-select" name="category" id="category">
                                                    <option value="Umum"
                                                        @if ($pemas->category === 'Umum') selected @endif>
                                                        Umum</option>
                                                    <option value="Kesehatan"
                                                        @if ($pemas->category === 'Kesehatan') selected @endif>
                                                        Kesehatan</option>
                                                    <option value="Energi"
                                                        @if ($pemas->category === 'Energi') selected @endif>
                                                        Energi</option>
                                                    <option value="Industri"
                                                        @if ($pemas->category === 'Industri') selected @endif>
                                                        Industri</option>
                                                    <option value="Pangan"
                                                        @if ($pemas->category === 'Pangan') selected @endif>
                                                        Pangan</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="status" class="form-label">Status Kegiatan</label>
                                                <select class="form-select" name="status_pemas" id="status">
                                                    <option value="pengajuan"
                                                        @if ($pemas->status_pemas === 'Proses verifikasi') selected @endif>
                                                        Pengajuan</option>
                                                    <option value="pencarian volunteer"
                                                        @if ($pemas->status_pemas === 'pencarian volunteer') selected @endif>
                                                        Pencarian Volunteer</option>
                                                    <option value="sedang berjalan"
                                                        @if ($pemas->status_pemas === 'sedang berjalan') selected @endif>
                                                        Sedang berjalan</option>
                                                    <option value="selesai"
                                                        @if ($pemas->status_pemas === 'selesai') selected @endif>
                                                        Selesai</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="judul" class="form-label">Lokasi</label>
                                                <input type="text" class="form-control" name="location" id="judul"
                                                    placeholder="Status Kegiatan"
                                                    value="{{ htmlentities($pemas->location) }}">
                                            </div>
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="judul" class="form-label">Status </label>
                                                <input type="text" class="form-control" name="status" id="judul"
                                                    placeholder="Status Kegiatan"
                                                    value="{{ htmlentities($pemas->status) }}" readonly>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="news" class="col-form-label">Konten</label>
                                            <textarea class="form-control" id="news" name="content">{!! htmlentities($pemas->content) !!}</textarea>
                                        </div>
                                        <div class="modal-footer justify-content-center">
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
