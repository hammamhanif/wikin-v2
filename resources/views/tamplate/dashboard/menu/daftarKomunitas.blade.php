@extends('tamplate.dashboard.maindashboard')

@section('dashboard')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Daftar Komunitas Wikin</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item ">Menu Komunitas</li>
                    <li class="breadcrumb-item active">Komunitas Wikin</li>
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
                            <div class="pagetitle text-center">
                                <h1>Daftar Semua Komunitas</h1>
                            </div>
                            <div class="container">
                                <div class="card-container d-flex justify-content-center">
                                    <div class="row row-cols-2 row-cols-lg-4 justify-content-center">
                                        @foreach ($communities as $community)
                                            <div class="card col " style="width: 18rem; margin-right: 10px;">
                                                <img src="{{ asset('storage/' . $community->image) }}" class="card-img-top"
                                                    alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">{{ $community->name }}
                                                    </h5>
                                                    <p class="card-text">{!! $community->content !!}</p>

                                                    <div style="display: flex; align-items: text-center;">
                                                        <a href="{{ route('regKomunitas', ['slug' => $community->slug]) }}"
                                                            class="btn btn-outline-success" style="margin-right: 5px;">
                                                            Gabung
                                                        </a>
                                                        <a href="{{ route('detailcommunity', $community->slug) }} "
                                                            class="btn btn-outline-primary"
                                                            style="margin-right: 5px;">Detail</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>

                                <div>
                                    {{ $communities->links() }}
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
@endsection
