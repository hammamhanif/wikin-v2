@extends('tamplate.dashboard.maindashboard')

@section('dashboard')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Pengaturan Halaman Depan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item ">Menu Admin</li>
                    <li class="breadcrumb-item active">Pengaturan Halaman Depan</li>
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
                                    <h5 class="card-title">Data tampilan halaman utama</h5>

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
                                    @foreach ($landings as $landing)
                                        <div class="alert alert-warning" role="alert">
                                            <strong class="font-bold">Pastikan!</strong>
                                            <span class="block sm:inline">Setiap Isi pengaturan sudah sesuai yang diinginkan
                                                mulai dari
                                                video halaman utama dan pertanyaan. Silahkan klik <a
                                                    href="{{ route('menuHome.edit', ['id' => $landing->id]) }}">update</a>
                                                jika ingin merubah video
                                                dan
                                                data lainnya.</span>
                                        </div>
                                        <form role="form text-left" method="get" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mb-3">
                                                <div class="col-sm-6 col-xs-12 mt-3">
                                                    <label for="location" class="form-label">Lokasi :</label>
                                                    <input type="text" class="form-control" name="location"
                                                        id="location" placeholder="Lokasi.."
                                                        value="{{ $landing->location }}">
                                                </div>
                                                <div class="col-sm-6 col-xs-12 mt-3">
                                                    <label for="telp" class="form-label">Telepon :</label>
                                                    <input type="text" class="form-control" name="telp" id="telp"
                                                        placeholder="Telepon..." value="{{ $landing->telp }}">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-6 col-xs-12 mt-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="text" class="form-control" name="email" id="email"
                                                        placeholder="Email.." value="{{ $landing->email }}" readonly>
                                                </div>
                                                <div class="col-sm-6 col-xs-12 mt-3">
                                                    <label for="instagram" class="form-label">Instagram</label>
                                                    <input type="text" class="form-control" name="instagram"
                                                        id="instagram" placeholder="Instagram.."
                                                        value="{{ $landing->instagram }}" readonly>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="question1" class="form-label">Pertanyaan 1 :</label>
                                                <input type="text" class="form-control" name="question1" id="question1"
                                                    placeholder="Pertanyaan 1.." value="{{ $landing->question1 }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="answer1" class="col-form-label">Jawaban Pertanyaan 1 :</label>
                                                <textarea class="form-control" id="answer1" name="answer1" placeholder="Masukkan jawaban jelas.." readonly>{{ $landing->answer1 }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="question2" class="form-label">Pertanyaan 2 :</label>
                                                <input type="text" class="form-control" name="question2" id="question2"
                                                    placeholder="Pertanyaan 2.." value="{{ $landing->question2 }}"
                                                    readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="answer2" class="col-form-label">Jawaban Pertanyaan 2
                                                    :</label>
                                                <textarea class="form-control" id="answer2" name="answer2" placeholder="Masukkan jawaban jelas.." value="">{{ $landing->answer2 }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="question3" class="form-label">Pertanyaan 3 :</label>
                                                <input type="text" class="form-control" name="question3"
                                                    id="question3" placeholder="Pertanyaan 3.."
                                                    value="{{ $landing->question3 }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="answer3" class="col-form-label">Jawaban Pertanyaan 3
                                                    :</label>
                                                <textarea class="form-control" id="answer3" name="answer3" placeholder="Masukkan jawaban jelas.." value="">{{ $landing->answer3 }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="question4" class="form-label">Pertanyaan 4 :</label>
                                                <input type="text" class="form-control" name="question4"
                                                    id="question4" placeholder="Pertanyaan 4.."
                                                    value="{{ $landing->question4 }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="answer4" class="col-form-label">Jawaban Pertanyaan 4
                                                    :</label>
                                                <textarea class="form-control" id="answer4" name="answer4" placeholder="Masukkan jawaban jelas.." value="">{{ $landing->answer4 }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="question5" class="form-label">Pertanyaan 5 :</label>
                                                <input type="text" class="form-control" name="question5"
                                                    id="question5" placeholder="Pertanyaan 5.."
                                                    value="{{ $landing->question5 }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="answer5" class="col-form-label">Jawaban Pertanyaan 5
                                                    :</label>
                                                <textarea class="form-control" id="answer5" name="answer5" placeholder="Masukkan jawaban jelas.." value="">{{ $landing->answer5 }}</textarea>
                                            </div>
                                            <div class="modal-footer">
                                            </div>
                                        </form>
                                    @endforeach
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
