@extends('tamplate.dashboard.maindashboard')

@section('dashboard')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Profil</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Profil</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="{{ Auth::user()->image ?? asset('img/Avatar_Profile.png') }}" alt="Profile"
                                class="rounded-circle">
                            <h2>{{ Auth::user()->username }}</h2>
                            <h3>{{ Auth::user()->type }}</h3>
                            <div class="social-links mt-2">
                                <a href="{{ Auth::user()->facebook_profile }}" class="facebook" target="_blank"><i
                                        class="bi bi-facebook"></i></a>
                                <a href="{{ Auth::user()->instagram_profile }}" class="instagram" target="_blank"><i
                                        class="bi bi-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Keseluruhan</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                        Profil</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Ubah Password</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
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
                                    <h5 class="card-title">Detail Profile</h5>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->name }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Pekerjaan / Jabatan</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->job }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">No.HP</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->phone }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->email }}</div>
                                    </div>
                                </div>
                                <!-- Profile Edit Form -->
                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                    <form role="form text-left" action="{{ route('profile.update', $user->id) }}"
                                        method="post" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="image" class="col-md-4 col-lg-3 col-form-label">Gambar
                                                Profil</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input class="form-control" type="file" name="image" id="image"
                                                    accept="image/*">
                                                @error('image')
                                                    <span class="invalid-feedback">{{ htmlentities($message) }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="username" type="text" class="form-control" id="username"
                                                    value="{{ Auth::user()->username }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="text" class="form-control" id="email"
                                                    value="{{ Auth::user()->email }}" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama
                                                lengkap</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text" class="form-control" id="name"
                                                    value="{{ Auth::user()->name }}">
                                                @error('name')
                                                    <span class="invalid-feedback">{{ htmlentities($message) }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="Job"
                                                class="col-md-4 col-lg-3 col-form-label">Instagram</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="instagram_profile" type="text" class="form-control"
                                                    id="job" value="{{ Auth::user()->instagram_profile }}">
                                                @error('job')
                                                    <span class="invalid-feedback">{{ htmlentities($message) }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="Job"
                                                class="col-md-4 col-lg-3 col-form-label">Facebook</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="facebook_profile" type="text" class="form-control"
                                                    id="job" value="{{ Auth::user()->facebook_profile }}">
                                                @error('job')
                                                    <span class="invalid-feedback">{{ htmlentities($message) }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="Job" class="col-md-4 col-lg-3 col-form-label">Pekerjaan
                                                /Jabatan</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="job" type="text" class="form-control" id="job"
                                                    value="{{ Auth::user()->job }}">
                                                @error('job')
                                                    <span class="invalid-feedback">{{ htmlentities($message) }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">No. HP</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control" id="phone"
                                                    value="{{ Auth::user()->phone }}">
                                                @error('phone')
                                                    <span class="invalid-feedback">{{ htmlentities($message) }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->
                                </div>
                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form role="form" action="{{ route('password.update', $user->id) }}"
                                        method="post" class="user">
                                        @method('post')
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">
                                                Password Lama</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="current_password" type="password" class="form-control"
                                                    id="currentPassword">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">
                                                Password Baru</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control"
                                                    id="newPassword">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Ulangi
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password_confirmation" type="password" class="form-control"
                                                    id="renewPassword">
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Ubah</button>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- End Bordered Tabs -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection
