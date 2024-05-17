@extends('tamplate.landingpage.main')

@section('main')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Pengabdian Masyarakat Nuklir</h2>
                    <ol>
                        <li><a href="{{ route('home') }}">Utama</a></li>
                        <li>Pengabdian</li>
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
                            @foreach ($pengmases as $pemas)
                                <div class="col-lg-6">
                                    <article class="d-flex flex-column">

                                        <div class="post-img">
                                            <img src="{{ asset('storage/images/' . $pemas->image) }}" alt=""
                                                class="img-fluid">
                                        </div>

                                        <h2 class="title">
                                            <a href="{{ route('detailpemas', $pemas->slug) }}">{{ $pemas->name }}</a>
                                        </h2>


                                        <div class="meta-top">
                                            <ul>
                                                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                                        href="blog-details.html">{{ $pemas->author }}</a></li>
                                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                                        href="blog-details.html"><time
                                                            datetime="2022-01-01">{{ $pemas->created }}</time></a></li>
                                            </ul>
                                            <ul>
                                                <li class="d-flex align-items-center mt-2"><i class="bi bi-chat-dots"></i>
                                                    <a href="blog-details.html">{{ $pemas->total_comments }} Komentar</a>
                                                </li>
                                                <li class="d-flex align-items-center mt-2"><i class="bi bi-alarm"></i>
                                                    <a href="blog-details.html">Status:
                                                        <strong>{{ $pemas->status_pemas }}</strong></a>
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="content">
                                            <p>
                                                {!! $pemas->content !!}
                                            </p>
                                        </div>

                                        <div class="read-more mt-auto align-self-end">
                                            <a href="{{ route('detailpemas', $pemas->slug) }}">Baca</a>
                                        </div>

                                    </article>
                                </div><!-- End post list item -->
                            @endforeach
                        </div><!-- End blog posts list -->

                        <div class="blog-pagination">
                            {{ $pengmases->links() }}
                        </div><!-- End blog pagination -->

                    </div>

                    <div class="col-lg-4">

                        <div class="sidebar">

                            <div class="sidebar-item search-form">
                                <h3 class="sidebar-title">Cari</h3>
                                <form action="{{ route('pengmases') }}" method="GET" class="mt-3">
                                    <input type="text" name="name" placeholder="Masukkan judul">
                                    <button type="submit"><i class="bi bi-search"></i></button>
                                </form>

                            </div><!-- End sidebar search formn-->

                            <div class="sidebar-item tags">
                                <h3 class="sidebar-title">Tags</h3>
                                <ul class="mt-3">
                                    <li><a href="{{ route('pengmases', ['name' => 'selesai']) }}">Selesai</a></li>
                                    <li><a href="{{ route('pengmases', ['name' => 'Pencarian Volunteer']) }}">Pencarian
                                            Volunteer</a></li>
                                    <li><a href="{{ route('pengmases', ['name' => 'Kesehatan']) }}">Kesehatan</a></li>
                                    <li><a href="{{ route('pengmases', ['name' => 'Industri']) }}">Indutri</a></li>
                                    <li><a href="{{ route('pengmases', ['name' => 'Pangan']) }}">Pangan</a></li>
                                    <li><a href="{{ route('pengmases', ['name' => 'Umum']) }}">Umum</a></li>
                            </div><!-- End sidebar tags-->

                        </div><!-- End Blog Sidebar -->

                    </div>

                </div>

            </div>
        </section><!-- End Blog Section -->

    </main><!-- End #main -->
@endsection
