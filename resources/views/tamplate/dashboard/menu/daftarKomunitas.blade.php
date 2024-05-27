@extends('tamplate.dashboard.maindashboard')
@section('dashboard')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Daftar Komunitas</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Menu Komunitas</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <!-- List Data User -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Semua Komunitas yang terdaftar</span></h5>
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    <strong class="font-bold">Success!</strong>
                                    <span class="block sm:inline">{{ session('success') }}</span>
                                </div>
                            @elseif(session('unsuccess'))
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
                            <div class="d-grid gap-1 d-md-flex justify-content-md-end">
                            </div>
                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Komunitas</th>
                                        <th scope="col">Nama PJ</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($communities as $community)
                                        <tr>
                                            <th scope="row"><a href="#">{{ $loop->iteration }}</a></th>
                                            <td>{{ htmlentities($community->name) }}</td>
                                            <td>{{ htmlentities($community->user->name) }}</td>
                                            <td><a href="#"
                                                    class="text-primary">{{ htmlentities($community->category) }}</a>
                                            </td>

                                            <td>
                                                <div style="display: flex; align-items: center;">
                                                    <a href="{{ route('regKomunitas', ['slug' => $community->slug]) }}"
                                                        class="btn btn-outline-success" style="margin-right: 5px;">
                                                        Gabung
                                                    </a>
                                                </div>

                        </div>
                        </td>
                        </tr>
                        @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- End List Komunitas  -->
            </div>
        </section>
    </main><!-- End #main -->

@endsection
