@extends('tamplate.dashboard.maindashboard')

@section('dashboard')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Menu Registrasi Komunitas</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item">Menu Komunitas</li>
                    <li class="breadcrumb-item active">Data Anggota Komunitas</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-12">
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
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title ">Tambahkan Rekan di Pengabdian Masyarakat Anda!</h5>


                            <!-- TinyMCE Editor -->
                            <form action="{{ route('storeAuthor.regKomunitas') }}" method="POST" id="memberForm">
                                @csrf
                                @method('POST   ')
                                <p> Nama Kegiatan : </p>
                                <input type="hidden" name="user_id" value="">
                                <input type="hidden" name="name" value="">
                                <input type="hidden" name="community_id" value="{{ $community->id }}">

                                <div class="row mb-3">
                                    <div class="col">
                                        <select class="form-select" name="user_name" id="user_name">
                                            <option value="" selected disabled>Pilih Rekan</option>
                                            <!-- Opsi default -->
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" data-type="{{ $user->type }}">
                                                    {{ $user->name }}
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <!-- other form inputs -->
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-primary" id="submitBtn">Tambahkan</button>
                                </div>
                            </form>



                        </div>
                    </div>
                </div>
                <!-- List Data Registrasi Komunitas -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Data Anggota Komunitas</h5>
                            <p>{{ $community->name }}</p>

                            <div class="d-grid gap-1 d-md-flex justify-content-md-end">
                            </div>
                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Anggota</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registrasiCommunities as $registrasi)
                                        <tr>
                                            <th scope="row"><a href="#">{{ $loop->iteration }}</a></th>
                                            <td>{{ htmlentities($registrasi->name) }}</td>
                                            <td>{{ htmlentities($registrasi->id) }}</td>
                                            @if ($registrasi->status == 'Diterima')
                                                <td><span
                                                        class="badge bg-success">{{ htmlentities($registrasi->status) }}</span>
                                                </td>
                                            @elseif ($registrasi->status == 'Proses verifikasi')
                                                <td><span
                                                        class="badge bg-warning">{{ htmlentities($registrasi->status) }}</span>
                                                </td>
                                            @elseif ($registrasi->status == 'Ditolak')
                                                <td><span
                                                        class="badge bg-danger">{{ htmlentities($registrasi->status) }}</span>
                                                </td>
                                            @endif
                                            <td>
                                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#registrasi{{ $registrasi->id }}">
                                                    <i class="bi bi-info-circle"></i>
                                                </button>
                                                <div class="modal fade" id="registrasi{{ $registrasi->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Status
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form role="form text-left"
                                                                    action="{{ route('registrasiCommunities.updateStatus', $registrasi->id) }}"
                                                                    method="post" enctype="multipart/form-data">
                                                                    @method('PUT')
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="community_name"
                                                                            class="col-form-label">Nama Komunitas:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="community_name" name="community_name"
                                                                            value="{{ htmlentities($registrasi->community->name) }}"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="user_name" class="col-form-label">Nama
                                                                            Pengguna:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="user_name" name="user_name"
                                                                            value="{{ htmlentities($registrasi->user->name) }}"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="status"
                                                                            class="form-label">Status</label>
                                                                        <select class="form-select" name="status"
                                                                            id="status">
                                                                            <option value="Proses verifikasi"
                                                                                @if ($registrasi->status === 'Proses verifikasi') selected @endif>
                                                                                Proses Verifikasi</option>
                                                                            <option value="Diterima"
                                                                                @if ($registrasi->status === 'Diterima') selected @endif>
                                                                                Diterima</option>
                                                                            <option value="Ditolak"
                                                                                @if ($registrasi->status === 'Ditolak') selected @endif>
                                                                                Ditolak</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="comments"
                                                                            class="col-form-label">Alasan:</label>
                                                                        <textarea class="form-control" id="comments" name="comments" rows="3">{{ $registrasi->argument }}</textarea>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Update</button>
                                                                        <a href="#"
                                                                            onclick="confirmDelete({{ $registrasi->id }})">
                                                                            <button type="button" class="btn btn-danger"
                                                                                data-bs-dismiss="modal">Hapus</button>
                                                                        </a>
                                                                    </div>
                                                                </form>



                                                                <form id="delete-form-{{ $registrasi->id }}"
                                                                    action="{{ route('registrasi_communities.destroy', ['id' => $registrasi->id]) }}"
                                                                    method="POST" style="display: none;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
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
                </div><!-- End List Registrasi Komunitas -->
            </div>
        </section>
    </main><!-- End #main -->
    <!-- End Main Content -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#user_name').change(function() {
                var userId = $(this).val();
                var userName = $(this).find('option:selected').text();
                $('input[name="user_id"]').val(userId);
                $('input[name="name"]').val(userName);
            });

            // Handler untuk tombol submit
            $('#submitBtn').click(function() {
                $('#memberForm').submit();
            });
        });
    </script>
    <script>
        function confirmDelete(registrasiId) {
            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus registrasi komunitas ini?',
                text: "Tindakan ini tidak dapat dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + registrasiId).submit();
                }
            });
        }
    </script>

@endsection
