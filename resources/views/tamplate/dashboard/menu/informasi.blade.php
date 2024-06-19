@extends('tamplate.dashboard.maindashboard')
@section('dashboard')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Menu Berita</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Menu Berita</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <!-- List Data User -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Berita Yang berhasil kamu Unggah</span></h5>
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
                                        <th scope="col">Judul</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($news as $new)
                                        <tr>
                                            <th scope="row"><a href="#">{{ $loop->iteration }}</a></th>
                                            <td>{{ htmlentities($new->user->name) }}</td>
                                            <td><a href="#" class="text-primary">{{ htmlentities($new->title) }}</a>
                                            </td>
                                            @if ($new->status == 'active')
                                                <td><span class="badge bg-success">{{ htmlentities($new->status) }}</span>
                                                </td>
                                            @elseif ($new->status == 'verifikasi')
                                                <td><span class="badge bg-warning">{{ htmlentities($new->status) }}</span>
                                                </td>
                                            @elseif ($new->status == 'inactive')
                                                <td><span class="badge bg-danger">{{ htmlentities($new->status) }}</span>
                                                </td>
                                            @endif

                                            <td>
                                                <div style="display: flex; align-items: center;">
                                                    <a href="{{ route('news.edit', ['slug' => $new->slug]) }}"
                                                        class="btn btn-info" style="margin-right: 5px;" title="Edit Berita">
                                                        <i class="bi bi-info-circle"></i>
                                                    </a>

                                                    <form action="{{ route('news.delete', ['id' => $new->id]) }}"
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
