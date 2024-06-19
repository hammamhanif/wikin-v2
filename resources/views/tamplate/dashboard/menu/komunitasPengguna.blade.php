@extends('tamplate.dashboard.maindashboard')
@section('dashboard')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Daftar Komunitas Kamu</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item ">Menu Komunitas</li>
                    <li class="breadcrumb-item active">Komunitas Kamu</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <!-- List Data User -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Semua Komunitas yang kamu daftar</span></h5>
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
                                        <th scope="col">Status</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Grup Chat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($communities as $community)
                                        <tr>
                                            <th scope="row"><a href="#">{{ $loop->iteration }}</a></th>
                                            <td>{{ htmlentities($community->community->name) }}</td>
                                            <td>{{ htmlentities($community->community->user->name) }}</td>
                                            @if ($community->status == 'Diterima')
                                                <td><span
                                                        class="badge bg-success">{{ htmlentities($community->status) }}</span>
                                                </td>
                                            @elseif ($community->status == 'Proses verifikasi')
                                                <td><span
                                                        class="badge bg-warning">{{ htmlentities($community->status) }}</span>
                                                </td>
                                            @elseif ($community->status == 'Ditolak')
                                                <td><span
                                                        class="badge bg-danger">{{ htmlentities($community->status) }}</span>
                                                </td>
                                            @endif
                                            <td><a href="#"
                                                    class="text-primary">{{ htmlentities($community->community->category) }}</a>
                                            </td>

                                            <td>
                                                <div style="display: flex; align-items: center;">
                                                    @if ($community->status == 'Diterima')
                                                        <a href="{{ $community->community->group }}"
                                                            class="btn btn-outline-success" style="margin-right: 5px;"
                                                            target="_blank">
                                                            Group
                                                        </a>
                                                    @endif

                                                </div>

                                            </td>
                        </div>
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
