@extends('tamplate.landingpage.main')


@push('css')
    @livewireStyles
@endpush
@push('js')
    @livewireScripts

    <script>
        Livewire.on('comment_store', commentId => {
            var helloScroll = document.getElementById('comment-' + commentId);
            helloScroll.scrollIntoView({
                behavior: 'smooth'
            }, true);
        })
    </script>
@endpush

@section('main')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
            @if (Session::has('success'))
                <div class="alert alert-primary" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
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
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Detail Pengabdian</h2>
                    <ol>
                        <li><a href="{{ route('home') }}">Utama</a></li>
                        <li>
                            Pengabdian </li>

                    </ol>
                </div>

            </div>
        </div><!-- End Breadcrumbs -->

        <!-- ======= Blog Details Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">

                <div class="row g-5">

                    <div class="col-lg-12">

                        <article class="blog-details">

                            <div class="post-img">
                                <img src="{{ asset('storage/images/' . $pemas->image) }}" alt="" class="img-fluid">
                            </div>

                            <h2 class="title">{{ htmlentities($pemas->title) }}
                            </h2>

                            <div class="meta-top">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i>
                                        {{ htmlentities($pemas->user->name) }}<a href=""></a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                            href=""><time
                                                datetime="2020-01-01">{{ htmlentities($pemas->created) }}</time></a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a
                                            href="">{{ $pemas->total_comments }} Komentar</a></li>
                                </ul>
                            </div><!-- End meta top -->

                            <div class="content">
                                {!! html_entity_decode($pemas->content) !!}
                            </div><!-- End post content -->

                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#reportModal">
                                Laporkan
                            </button>

                            <div class="modal fade" id="reportModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Laporkan Informasi</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="">

                                                <input type="hidden" value="asset_id_value" name="asset_id">
                                                <div class="form-group">
                                                    <label for="asset_name">Judul</label>
                                                    <input type="text" class="form-control" value=""
                                                        name="asset_name" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="creator_name">Nama Penulis</label>
                                                    <input type="text" class="form-control" name="creator_name">
                                                </div>

                                                <div class="form-group">
                                                    <label for="description">Deskripsi</label>
                                                    <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Kirim</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </article><!-- End blog post -->

                        <div class="comments">
                            @livewire('pemas.comment', ['id' => $pemas->id])

                        </div><!-- End blog comments -->

                    </div>


                </div>

            </div>
        </section><!-- End Blog Details Section -->

    </main><!-- End #main -->
@endsection
