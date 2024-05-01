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
                    <h2>Detail Informasi</h2>
                    <ol>
                        <li><a href="{{ route('home') }}">Utama</a></li>
                        <li>
                            Forum </li>

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
                                <img src="{{ asset('images/' . $news->image) }}" alt="" class="img-fluid">
                            </div>

                            <h2 class="title">{{ htmlentities($news->title) }}
                            </h2>

                            <div class="meta-top">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i>
                                        {{ htmlentities($news->user->username) }}<a href=""></a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                            href=""><time
                                                datetime="2020-01-01">{{ htmlentities($news->created) }}</time></a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a
                                            href="">{{ htmlentities($news->total_comments) }} Comments</a></li>
                                </ul>
                            </div><!-- End meta top -->

                            <div class="content">
                                {!! html_entity_decode($news->content) !!}
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
                                            <form method="POST" action="{{ route('report.store') }}">
                                                @method('POST')
                                                @csrf
                                                <input type="hidden" value="{{ $news->id }}" name="news_id">
                                                <div class="form-group">
                                                    <label for="asset_name">Nama Berita / Informasi</label>
                                                    <input type="text" class="form-control" value="{{ $news->title }}"
                                                        name="title" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="creator_name">Nama Penulis</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $news->user->name }}" name="creator_name" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Deskripsi</label>
                                                    <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                        </article><!-- End blog post -->

                        <div class="comments">

                            @livewire('news.comment', ['id' => $news->id])

                        </div><!-- End blog comments -->

                    </div>


                </div>

            </div>
        </section><!-- End Blog Details Section -->

    </main><!-- End #main -->

@endsection
