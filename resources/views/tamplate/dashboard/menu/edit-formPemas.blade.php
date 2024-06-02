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

        #pemas {
            height: 200px;
            /* Atur tinggi sesuai kebutuhan */
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
                    <li class="breadcrumb-item ">Menu Pemas</li>
                    <li class="breadcrumb-item ">Pengajuan Pengabdian Masyarakat</li>
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
                                    <h5 class="card-title ">Edit Pengajuan Pengabdian Masyarakat</h5>
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
                                        action="{{ route('formPemas.update', ['slug' => $pemas->slug]) }}" method="post"
                                        enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="judul" class="form-label">Nama Pengabdian Masyarakat </label>
                                                <input type="text" class="form-control" name="nama_kegiatan"
                                                    id="judul" placeholder="Nama Pengabdian Masyarakat.."
                                                    value="{{ htmlentities($pemas->nama_kegiatan) }}">
                                            </div>
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="deskripsi" class="form-label">Nama Pengguna yang
                                                    mengajukan</label>
                                                <input type="text" class="form-control" name="description" id="deskripsi"
                                                    placeholder="Deskripsi" value="{{ htmlentities($pemas->name) }}" pemas
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="">
                                                <label for="proposal" class="col-sm-5 col-form-label">Proposal</label>
                                                <input class="form-control" type="file" name="proposal" id="proposal"
                                                    accept=".pdf,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                            </div>

                                        </div>
                                        <div class="mb-3">
                                            <label for="category" class="form-label">Kategori</label>
                                            <select class="form-select" name="category" id="category">
                                                <option value="Umum" @if ($pemas->category === 'Umum') selected @endif>
                                                    Umum</option>
                                                <option value="Kesehatan" @if ($pemas->category === 'Kesehatan') selected @endif>
                                                    Kesehatan</option>
                                                <option value="Energi" @if ($pemas->category === 'Energi') selected @endif>
                                                    Energi</option>
                                                <option value="Industri" @if ($pemas->category === 'Industri') selected @endif>
                                                    Industri</option>
                                                <option value="Pangan" @if ($pemas->category === 'Pangan') selected @endif>
                                                    Pangan</option>
                                            </select>

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
                                                    placeholder="Status Kegiatan" value="{{ htmlentities($pemas->status) }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="waktuMulai" class="form-label">Waktu Mulai</label>
                                                <input type="datetime-local" class="form-control" name="start_time"
                                                    id="waktuMulai" value="{{ htmlentities($pemas->start_time) }}">
                                            </div>
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="waktuSelesai" class="form-label">Waktu Selesai</label>
                                                <input type="datetime-local" class="form-control" name="end_time"
                                                    id="waktuSelesai" value="{{ htmlentities($pemas->end_time) }}">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="judul" class="form-label">Nomor NIK/NIM/NIP </label>
                                            <input type="text" class="form-control" name="noID" id="judul"
                                                placeholder="Nomor ID " value="{{ htmlentities($pemas->noID) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="pemas" class="col-form-label">Konten</label>
                                            <textarea class="form-control" id="pemas" name="content">{!! htmlentities($pemas->content) !!}</textarea>
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
