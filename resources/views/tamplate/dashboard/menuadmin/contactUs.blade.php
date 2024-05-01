@extends('tamplate.dashboard.maindashboard')

@section('dashboard')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <!-- List Data User -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Data Hubungi Admin</span></h5>
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
                                        <th scope="col">Nama User</th>
                                        <th scope="col">Deskripsi</th>
                                        <th scope="col">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $user)
                                        <tr>
                                            <th scope="row"><a href="#">{{ $loop->iteration }}</a></th>
                                            <td>{{ htmlentities($user->name) }}</td>
                                            <td><a href="#"
                                                    class="text-primary">{{ htmlentities($user->subject) }}</a>
                                            </td>
                                            <td><button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#user{{ $user->id }}">
                                                    <i class="bi bi-info-circle">
                                                    </i></button>
                                                <div class="modal fade" id="user{{ $user->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Akun
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form role="form text-left" action="" method="post"
                                                                    enctype="multipart/form-data">
                                                                    @method('PUT')
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="name"
                                                                            class="col-form-label">Nama:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="name" name="name"
                                                                            value="{{ htmlentities($user->name) }}"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="username"
                                                                            class="col-form-label">Deskripsi:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="username" name="username"
                                                                            value="{{ htmlentities($user->subject) }}"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="email"
                                                                            class="col-form-label">Email:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="email" name="email"
                                                                            value="{{ htmlentities($user->email) }}"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="email" class="col-form-label">Isi
                                                                            Pesan:</label>
                                                                        <textarea class="form-control" id="email" name="email" readonly>{{ htmlentities($user->message) }}</textarea>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                </form>
                                                                <a href="{{ route('contact.destroy', ['id' => $user->id]) }}"
                                                                    onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this user?')) document.getElementById('delete-form-{{ htmlentities($user->id) }}').submit();">
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-bs-dismiss="modal">Hapus</button>
                                                                </a>
                                                                <form id="delete-form-{{ htmlentities($user->id) }}"
                                                                    action="{{ route('contact.destroy', ['id' => $user->id]) }}"
                                                                    method="POST" style="display: none;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
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
    <!-- End Main Content -->

@endsection
