@extends('tamplate.landingpage.main')

@section('main')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
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
                                            href="">12 Comments</a></li>
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

                            <h4 class="comments-count">Diskusi Komentar</h4>

                            <div id="comment-1" class="comment">
                                <div class="d-flex">
                                    <div class="comment-img"><img src="{{ asset('img/blog/comments-1.jpg') }}"
                                            alt=""></div>
                                    <div>
                                        <h5><a href="">Georgia Reader</a></a>
                                        </h5>
                                        <time datetime="2020-01-01">01 Jan,2022</time>
                                        <p>
                                            Et rerum totam nisi. Molestiae vel quam dolorum vel voluptatem et et. Est ad aut
                                            sapiente quis molestiae est qui cum soluta.
                                            Vero aut rerum vel. Rerum quos laboriosam placeat ex qui. Sint qui facilis et.
                                        </p>
                                    </div>
                                </div>
                            </div><!-- End comment #1 -->


                            <div id="comment-3" class="comment">
                                <div class="d-flex">
                                    <div class="comment-img"><img src="{{ asset('img/blog/comments-5.jpg') }}"
                                            alt="">
                                    </div>
                                    <div>
                                        <h5><a href="">Nolan Davidson</a> <a href="#">
                                            </a>
                                        </h5>
                                        <time datetime="2020-01-01">01 Jan,2022</time>
                                        <p>
                                            Distinctio nesciunt rerum reprehenderit sed. Iste omnis eius repellendus quia
                                            nihil ut accusantium tempore. Nesciunt expedita id dolor exercitationem
                                            aspernatur aut quam ut. Voluptatem est accusamus iste at.
                                            Non aut et et esse qui sit modi neque. Exercitationem et eos aspernatur. Ea est
                                            consequuntur officia beatae ea aut eos soluta. Non qui dolorum voluptatibus et
                                            optio veniam. Quam officia sit nostrum dolorem.
                                        </p>
                                    </div>
                                </div>

                            </div><!-- End comment #3 -->

                            <div id="comment-4" class="comment">
                                <div class="d-flex">
                                    <div class="comment-img"><img src="{{ asset('img/blog/blog-author.jpg') }}"
                                            alt="">
                                    </div>
                                    <div>
                                        <h5><a href="">Kay Duggan</a> <a href="#" class="reply"></a></h5>
                                        <time datetime="2020-01-01">01 Jan,2022</time>
                                        <p>
                                            Dolorem atque aut. Omnis doloremque blanditiis quia eum porro quis ut velit
                                            tempore. Cumque sed quia ut maxime. Est ad aut cum. Ut exercitationem non in
                                            fugiat.
                                        </p>
                                    </div>
                                </div>

                            </div><!-- End comment #4 -->

                            <div class="reply-form">

                                <h4>Tambahkan Komentar</h4>

                                <form action="">
                                    <div class="row">
                                        <div class="col form-group">
                                            <textarea name="comment" class="form-control" placeholder="Komentar"></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Kirim</button>

                                </form>

                            </div>

                        </div><!-- End blog comments -->

                    </div>


                </div>

            </div>
        </section><!-- End Blog Details Section -->

    </main><!-- End #main -->
@endsection
