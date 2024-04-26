@extends('tamplate.landingpage.main')

@section('main')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Informasi Kenukliran</h2>
                    <ol>
                        <li><a href="{{ route('home') }}">Utama</a></li>
                        <li>Informasi</li>
                    </ol>
                </div>

            </div>
        </div><!-- End Breadcrumbs -->

        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">

                <div class="row g-5">

                    <div class="col-lg-8">

                        <div class="row gy-4 posts-list">
                            @foreach ($lot_news as $news)
                                <div class="col-lg-6">
                                    <article class="d-flex flex-column">

                                        <div class="post-img">
                                            <img src="{{ asset('images/' . $news->image) }}" alt=""
                                                class="img-fluid">
                                        </div>

                                        <h2 class="title">
                                            <a href="blog-details.html">{{ $news->title }}</a>
                                        </h2>
                                        <div>
                                            Kategori: ({{ $news->category }})
                                            </>
                                        </div>

                                        <div class="meta-top">
                                            <ul>
                                                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                                        href="blog-details.html">{{ $news->author }}</a></li>
                                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                                        href="blog-details.html"><time
                                                            datetime="2022-01-01">{{ $news->created }}</time></a></li>
                                            </ul>
                                            <li class="d-flex align-items-center mt-2"><i class="bi bi-chat-dots"></i>
                                                <a href="blog-details.html">12 Comments</a>
                                            </li>
                                        </div>

                                        <div class="content">
                                            <p>
                                                {{ $news->description }}
                                            </p>
                                        </div>

                                        <div class="read-more mt-auto align-self-end">
                                            <a href="{{ route('detail', $news->slug) }}">Baca</a>
                                        </div>

                                    </article>
                                </div><!-- End post list item -->
                            @endforeach
                        </div><!-- End blog posts list -->

                        <div class="blog-pagination">
                            {{ $lot_news->links() }}
                        </div><!-- End blog pagination -->

                    </div>

                    <div class="col-lg-4">

                        <div class="sidebar">

                            <div class="sidebar-item search-form">
                                <h3 class="sidebar-title">Cari</h3>
                                <form action="{{ route('news') }}" method="GET" class="mt-3">
                                    <input type="text" name="title" placeholder="Masukkan judul">
                                    <button type="submit"><i class="bi bi-search"></i></button>
                                </form>

                            </div><!-- End sidebar search formn-->

                            <div class="sidebar-item tags">
                                <h3 class="sidebar-title">Tags</h3>
                                <ul class="mt-3">
                                    <li><a href="{{ route('news', ['title' => 'Kesehatan']) }}">Kesehatan</a></li>
                                    <li><a href="{{ route('news', ['title' => 'Industri']) }}">Indutri</a></li>
                                    <li><a href="{{ route('news', ['title' => 'Pangan']) }}">Pangan</a></li>
                                    <li><a href="{{ route('news', ['title' => 'Umum']) }}">Umum</a></li>
                            </div><!-- End sidebar tags-->

                        </div><!-- End Blog Sidebar -->

                    </div>

                </div>

            </div>
        </section><!-- End Blog Section -->

    </main><!-- End #main -->
@endsection
