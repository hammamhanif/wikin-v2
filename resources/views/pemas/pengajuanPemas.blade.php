@extends('tamplate.dashboard.maindashboard')

@section('dashboard')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Pengajuan Pengabdian Masyarakat</h1>
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
                                    <h5 class="card-title">Ajukan Program Pengabdian Masyarakatmu!</h5>
                                    <div class="alert alert-warning" role="alert">
                                        <strong class="font-bold">Pastikan!</strong>
                                        <span class="block sm:inline">Data yang diisikan benar dan selalu periksa
                                            <strong>status</strong>
                                            pada bagian menu pengabdian</span>
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
                                    <form role="form text-left" action="{{ route('requestpemas.store') }}" method="post"
                                        enctype="multipart/form-data" id="requestForm">
                                        @method('POST')
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="kegiatan" class="form-label">Nama Pengguna</label>
                                                <input type="text" class="form-control" name="name" id="kegiatan"
                                                    placeholder="Masukkan Nama.." value="{{ Auth::user()->name }}" readonly>
                                            </div>
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="lokasi" class="form-label">Nomor Identitas</label>
                                                <input type="text" class="form-control" name="noID" id="lokasi"
                                                    placeholder="NIP / NIM / NIK ...">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="kegiatan" class="form-label">Nama Kegiatan</label>
                                                <input type="text" class="form-control" name="name" id="kegiatan"
                                                    placeholder="Nama Kegiatan..">
                                            </div>
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="lokasi" class="form-label">Lokasi</label>
                                                <input type="text" class="form-control" name="location" id="lokasi"
                                                    placeholder="Lokasi..">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="">
                                                <label for="proposal" class="col-sm-5 col-form-label">Proposal
                                                    @if (Auth::user()->type == 'masyarakat')
                                                        (Apabila ada)
                                                    @else
                                                        (Wajib Diisi)
                                                    @endif
                                                </label>
                                                <input class="form-control" type="file" name="proposal" id="proposal"
                                                    accept=".pdf,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                                    @if (Auth::user()->type == 'mahasiswa' || Auth::user()->type == 'dosen') @else required @endif>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="waktuMulai" class="form-label">Waktu Mulai</label>
                                                <input type="datetime-local" class="form-control" name="start_time"
                                                    id="waktuMulai">
                                            </div>
                                            <div class="col-sm-6 col-xs-12 mt-3">
                                                <label for="waktuSelesai" class="form-label">Waktu Selesai</label>
                                                <input type="datetime-local" class="form-control" name="end_time"
                                                    id="waktuSelesai">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-12 col-xs-12 mt-3">
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
                                        <div class="mb-3">
                                            <label for="pemas" class="col-form-label">Deskripsi Kegiatan</label>
                                            <textarea class="form-control" id="pemas" name="content" placeholder="Masukkan deskrispsi secara jelas.."></textarea>
                                        </div>
                                        <div class="justify-content-center d-flex">
                                            <button type="button" class="btn btn-outline-primary btn-lg"
                                                onclick="confirmSubmission()">Kirimkan</button>
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
        function confirmSubmission() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang diisikan sudah benar?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kirimkan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('requestForm').submit();
                }
            })
        }
    </script>
@endsection
