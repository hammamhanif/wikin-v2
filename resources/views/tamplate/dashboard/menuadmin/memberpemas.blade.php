@extends('tamplate.dashboard.maindashboard')

@section('dashboard')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Anggota Pengabdian Masyarakat</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item ">Menu Pangabdian</li>
                    <li class="breadcrumb-item active">Anggota Pemas</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <!-- List Data User -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Daftar sebagai anggota pengabdian (Admin)</span></h5>
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
                                        <th scope="col">Nama Pengguna</th>
                                        <th scope="col">Prodi</th>
                                        <th scope="col">Jabatan</th>
                                        <th scope="col">Status Penerimaan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registrasiPemas as $pemas)
                                        <tr>
                                            <th scope="row"><a href="#">{{ $loop->iteration }}</a></th>
                                            <td>{{ htmlentities($pemas->user->name) }}</td>
                                            <td><a href="#"
                                                    class="text-primary">{{ htmlentities($pemas->program_study) }}</a>
                                            </td>
                                            <td>{{ htmlentities($pemas->type) }}</td>
                                            @if ($pemas->status == 'Diterima')
                                                <td><span class="badge bg-success">{{ htmlentities($pemas->status) }}</span>
                                                </td>
                                            @elseif ($pemas->status == 'Proses verifikasi')
                                                <td><span class="badge bg-warning">{{ htmlentities($pemas->status) }}</span>
                                                </td>
                                            @elseif ($pemas->status == 'Ditolak')
                                                <td><span class="badge bg-danger">{{ htmlentities($pemas->status) }}</span>
                                                </td>
                                            @endif
                                            <td><button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#user{{ $pemas->id }}">
                                                    <i class="bi bi-info-circle">
                                                    </i></button>
                                                <div class="modal fade" id="user{{ $pemas->id }}" tabindex="-1"
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
                                                                <form role="form text-left"
                                                                    action="{{ route('memberPemas.update', $pemas->id) }}"
                                                                    method="post" enctype="multipart/form-data">
                                                                    @method('PUT')
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="name" class="col-form-label">Nama
                                                                            Pengabdian:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="name" name="name"
                                                                            value="{{ htmlentities($pemas->formPemas->name) }}"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="name"
                                                                            class="col-form-label">Nama:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="name" name="name"
                                                                            value="{{ htmlentities($pemas->user->name) }}"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="noID"
                                                                            class="col-form-label">NIK/NIM:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="noID" name="noID"
                                                                            value="{{ htmlentities($pemas->noID) }}"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="username"
                                                                            class="col-form-label">Prodi:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="username" name="username"
                                                                            value="{{ htmlentities($pemas->program_study) }}"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="email"
                                                                            class="col-form-label">Jabatan:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="email" name="email"
                                                                            value="{{ htmlentities($pemas->type) }}"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="type"
                                                                            class="col-form-label">Alamat</label>
                                                                        <textarea class="form-control" name="type" id="type" rows="3">{{ $pemas->alamat }}</textarea>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="status"
                                                                            class="form-label">Status</label>
                                                                        <select class="form-select" name="status"
                                                                            id="status">
                                                                            <option value="Proses verifikasi"
                                                                                @if ($pemas->status === 'Proses verifikasi') selected @endif>
                                                                                Proses Verifikasi</option>
                                                                            <option value="Diterima"
                                                                                @if ($pemas->status === 'Diterima') selected @endif>
                                                                                Diterima</option>
                                                                            <option value="Ditolak"
                                                                                @if ($pemas->status === 'Ditolak') selected @endif>
                                                                                Ditolak</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="type"
                                                                            class="col-form-label">Motivasi</label>
                                                                        <textarea class="form-control" name="type" id="type" rows="3">{{ $pemas->motivasi }}</textarea>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Update</button>
                                                                </form>
                                                                <a href="#"
                                                                    onclick="confirmDelete({{ $pemas->id }})">
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-bs-dismiss="modal">Hapus</button>
                                                                </a>

                                                                <form id="delete-form-{{ $pemas->id }}"
                                                                    action="{{ route('registrasi_pemas.delete', ['id' => $pemas->id]) }}"
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
    <script>
        function confirmDelete(userId) {
            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus pengguna ini?',
                text: "Tindakan ini tidak dapat dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + userId).submit();
                }
            });
        }
    </script>
@endsection
