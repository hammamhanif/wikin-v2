@extends('tamplate.dashboard.maindashboard')

@section('dashboard')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Galeri Kegiatan Komunitas</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item ">Menu Admin</li>
                    <li class="breadcrumb-item active">Galeri Komunitas</li>
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
                                <div class="card-body">
                                    <h5 class="card-title ">Nama Komunitas : {{ $community->name }}</h5>
                                    <p class="card-content ">Nama Penanggung jawab : {{ $community->user->name }}</p>


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
                                                    <form id="deleteForm-{{ $gallery->id }}"
                                                        action="{{ route('galeri.delete', ['id' => $gallery->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="confirmDelete({{ $gallery->id }})"
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
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm-' + id).submit();
                }
            });
        }
    </script>
    <script>
        document.getElementById('submitButton').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior

            // Trigger form submission
            document.getElementById('myForm').submit();
        });
    </script>
@endsection
