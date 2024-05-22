@extends('tamplate.dashboard.maindashboard')
@section('dashboard')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Menu Pengabdian Masyarakat</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item ">Menu Admin</li>
                    <li class="breadcrumb-item active">Menu Admin</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <!-- List Data User -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Postingan Pemas</span></h5>
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
                                        <th scope="col">Nama Pemas</th>
                                        <th scope="col">Lokasi</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Status Kegiatan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengmases as $pemas)
                                        <tr>
                                            <th scope="row"><a href="#">{{ $loop->iteration }}</a></th>
                                            <td>{{ htmlentities($pemas->name) }}</td>
                                            <td>{{ htmlentities($pemas->location) }}</td>
                                            <td><a href="#"
                                                    class="text-primary">{{ htmlentities($pemas->category) }}</a>
                                            </td>
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
                                            @if ($pemas->status_pemas == 'pengajuan')
                                                <td><span
                                                        class="badge bg-warning">{{ htmlentities($pemas->status_pemas) }}</span>
                                                </td>
                                            @elseif ($pemas->status_pemas == 'sedang berjalan')
                                                <td><span
                                                        class="badge bg-primary">{{ htmlentities($pemas->status_pemas) }}</span>
                                                </td>
                                            @elseif ($pemas->status_pemas == 'selesai')
                                                <td><span
                                                        class="badge bg-success">{{ htmlentities($pemas->status_pemas) }}</span>
                                                </td>
                                            @elseif ($pemas->status_pemas == 'pencarian volunteer')
                                                <td><span
                                                        class="badge bg-warning">{{ htmlentities($pemas->status_pemas) }}</span>
                                                </td>
                                            @endif

                                            <td>
                                                <div style="display: flex; align-items: center;">
                                                    <a href="{{ route('pemas.editAdmin', ['slug' => $pemas->slug]) }}"
                                                        class="btn btn-info" style="margin-right: 5px;">
                                                        Edit
                                                    </a>
                                                    <a href="{{ route('memberPemas.admin', ['slug' => $pemas->slug]) }}"
                                                        class="btn btn-warning" style="margin-right: 5px;">
                                                        <i class="bi bi-people"></i>
                                                    </a>

                                                    <form action="{{ route('communities.delete', ['id' => $pemas->id]) }}"
                                                        method="POST" class="delete-form" style="margin-right: 5px;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="confirmDelete(this.form)"
                                                            class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                    </form>
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

        <section class="section">
            <div class="row">
                <!-- List Data User -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Pengajuan Pengabdian Masyarakat</span></h5>
                            <div class="d-grid gap-1 d-md-flex justify-content-md-end">
                            </div>
                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Pemas</th>
                                        <th scope="col">Lokasi</th>
                                        <th scope="col">Nama Pengguna</th>
                                        <th scope="col">Waktu</th>
                                        <th scope="col">Status </th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($formPengmases as $pemas)
                                        <tr>
                                            <th scope="row"><a href="">{{ $loop->iteration }}</a></th>
                                            <td>{{ htmlentities($pemas->nama_kegiatan) }}</td>
                                            <td>{{ htmlentities($pemas->location) }}</td>
                                            <td><a href="" class="text-primary">{{ htmlentities($pemas->name) }}</a>
                                            </td>
                                            <td>{{ htmlentities(strftime('%d %B %Y', strtotime($pemas->start_time))) }} S.d
                                                {{ htmlentities(strftime('%d %B %Y', strtotime($pemas->end_time))) }}
                                            </td>
                                            @if ($pemas->status == 'Diterima')
                                                <td><span
                                                        class="badge bg-success">{{ htmlentities($pemas->status) }}</span>
                                                </td>
                                            @elseif ($pemas->status == 'Proses verifikasi')
                                                <td><span
                                                        class="badge bg-warning">{{ htmlentities($pemas->status) }}</span>
                                                </td>
                                            @elseif ($pemas->status == 'Ditolak')
                                                <td><span class="badge bg-danger">{{ htmlentities($pemas->status) }}</span>
                                                </td>
                                            @endif

                                            <td>
                                                <div style="display: flex; align-items: center;">
                                                    <a href="{{ route('formPemas.editAdmin', ['slug' => $pemas->slug]) }}"
                                                        class="btn btn-info" style="margin-right: 5px;">
                                                        Detail
                                                    </a>
                                                    <form action="{{ route('formPemas.destroy', ['id' => $pemas->id]) }}"
                                                        method="POST" class="delete-form" style="margin-right: 5px;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="confirmDelete(this.form)"
                                                            class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                    </form>
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
    <script>
        // Fungsi untuk menampilkan Sweet Alert konfirmasi sebelum menghapus
        function confirmDelete(form) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan bisa mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit form jika pengguna mengonfirmasi
                }
            });
        }
    </script>
@endsection
