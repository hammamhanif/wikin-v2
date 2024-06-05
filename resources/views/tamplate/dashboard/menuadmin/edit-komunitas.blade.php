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
            <h1>Edit Komunitas Pengguna</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item ">Menu Admin</li>
                    <li class="breadcrumb-item ">Menu Komunitas</li>
                    <li class="breadcrumb-item active">Edit Komunitas Pengguna</li>
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
                                <strong class="font-bold">Silahkan Update Data!</strong>
                                <span class="block sm:inline"> Apabila ingin update penanggung jawab komunitas maka ubah
                                    ID Penanggung jawab. Selain itu, silahkan ubah status apabila komunitas sudah
                                    sesuai.</span>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title ">Detail Komunitas Nuklir Pengguna</h5>
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
                                        action="{{ route('communities.updateAdmin', ['slug' => $communities->slug]) }}"
                                        method="post" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="image-container">
                                            @if ($communities->image)
                                                <img src="{{ asset('storage/' . $communities->image) }}" class="img-fluid"
                                                    alt="Gambar Berita">
                                            @endif
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="judul" class="form-label">Nama Komunitas :</label>
                                                <input type="text" class="form-control" name="title" id="judul"
                                                    placeholder="Judul" value="{{ htmlentities($communities->name) }}"
                                                    readonly>
                                            </div>
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="deskripsi" class="form-label">Penanggung Jawab :</label>
                                                <input type="text" class="form-control" name="description" id="deskripsi"
                                                    placeholder="Masukkan Penanggung jawab"
                                                    value="{{ htmlentities($communities->user->name) }}" readonly>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">ID Penanggung Jawab :</label>
                                            <input type="text" class="form-control" name="user_id" id="user_id"
                                                placeholder="Masukkan ID pengguna.."
                                                value="{{ htmlentities($communities->user->id) }}">
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="category" class="form-label">Kategori :</label>
                                                <select class="form-select" name="category" id="category">
                                                    <option value="Umum"
                                                        @if ($communities->category === 'Umum') selected @endif>
                                                        Umum</option>
                                                    <option value="Kesehatan"
                                                        @if ($communities->category === 'Kesehatan') selected @endif>
                                                        Kesehatan</option>
                                                    <option value="Energi"
                                                        @if ($communities->category === 'Energi') selected @endif>
                                                        Energi</option>
                                                    <option value="Industri"
                                                        @if ($communities->category === 'Industri') selected @endif>
                                                        Industri</option>
                                                    <option value="Pangan"
                                                        @if ($communities->category === 'Pangan') selected @endif>
                                                        Pangan</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="status" class="form-label">Status :</label>
                                                <select class="form-select" name="status" id="status">
                                                    <option value="verifikasi"
                                                        @if ($communities->status === 'verifikasi') selected @endif>
                                                        Verifikasi</option>
                                                    <option value="inactive"
                                                        @if ($communities->status === 'inactive') selected @endif>
                                                        Inactive</option>
                                                    <option value="active"
                                                        @if ($communities->status === 'active') selected @endif>
                                                        Active</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="mb-3">
                                            <label for="news" class="col-form-label">Desikripsi :</label>
                                            <textarea class="form-control" id="news" name="content">{!! htmlentities($communities->content) !!}</textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="submitBtn">Ubah</button>
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
