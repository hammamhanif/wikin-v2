@extends('tamplate.landingpage.main')

@section('main')
    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Daftar Pengabdian Masyarakat <strong> </strong></h2>
                <h3>{{ $pemas->name }}</h3>
                <div class="alert alert-warning" role="alert">
                    Pastikan data yang diisikan benar karena tidak bisa diulang!
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
            </div>

            <form action="{{ route('store.registrasiPemas') }}" method="POST">
                @csrf
                <div class="row gy-4">


                    <div class="col-md-6" hidden>
                        <label for="pemas_id" class="form-label">Pemas ID</label>
                        <input type="number" class="form-control" id="pemas_id" name="pemas_id" hidden
                            value="{{ $pemas->id }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            placeholder="Masukkan nama anda.." required>
                    </div>

                    <div class="col-md-6">
                        <label for="noID" class="form-label">NIP / NIK</label>
                        <input type="text" class="form-control" id="noID" placeholder="Masukkan NIK atau NIM anda.."
                            name="noID" required>
                    </div>

                    <div class="col-md-6">
                        <label for="judul" class="form-label">Nama Pengabdian Masyarakat</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="{{ $pemas->name }}"
                            readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat"
                            placeholder="Masukkan alamat anda.." required>
                    </div>

                    <div class="col-md-6">
                        <label for="program_study" class="form-label">Program Studi</label>
                        <select class="form-select" id="program_study" name="program_study" required>
                            <option value="">Pilih Prodi</option>
                            <option value="Elektronika Instrumentasi">Elektronika Instrumentasi</option>
                            <option value="Teknokimia Nuklir">Teknokimia Nuklir</option>
                            <option value="Elektro Mekanika">Elektro Mekanika</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="type" class="form-label">Jabatan</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="">Pilih Jabatan</option>
                            <option value="dosen">Dosen</option>
                            <option value="mahasiswa">Mahasiswa</option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label for="motivasi" class="form-label">Motivasi</label>
                        <textarea class="form-control" id="motivasi" name="motivasi" rows="4" required
                            placeholder="Tuliskan motivasi anda mengapa ingin mengikuti program pengabdian masyarakat ini.."></textarea>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary ">Submit</button>
                    </div>

                </div>
            </form>

        </div>
    </section><!-- End Services Section -->
@endsection