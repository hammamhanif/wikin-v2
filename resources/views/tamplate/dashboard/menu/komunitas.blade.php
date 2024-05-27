@extends('tamplate.dashboard.maindashboard')
@section('dashboard')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Menu Komunitas</h1>
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
                            <h5 class="card-title">Komunitas yang berhasil kamu Buat</span></h5>
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
                                        <th scope="col">Status</th>
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
                                            @if ($community->status == 'active')
                                                <td><span
                                                        class="badge bg-success">{{ htmlentities($community->status) }}</span>
                                                </td>
                                            @elseif ($community->status == 'verifikasi')
                                                <td><span
                                                        class="badge bg-warning">{{ htmlentities($community->status) }}</span>
                                                </td>
                                            @elseif ($community->status == 'inactive')
                                                <td><span
                                                        class="badge bg-danger">{{ htmlentities($community->status) }}</span>
                                                </td>
                                            @endif

                                            <td>
                                                <div style="display: flex; align-items: center;">
                                                    <a href="{{ route('communities.edit', ['slug' => $community->slug]) }}"
                                                        class="btn btn-info" style="margin-right: 5px;">
                                                        Edit
                                                    </a>

                                                    <a href="{{ route('galeri.add', ['slug' => $community->slug]) }}"
                                                        class="btn btn-warning" style="margin-right: 5px;">
                                                        <i class="bi bi-images"></i>
                                                    </a>

                                                    <form
                                                        action="{{ route('communities.delete', ['id' => $community->id]) }}"
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
