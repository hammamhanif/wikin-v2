@extends('tamplate.landingpage.main')

@section('main')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Galeri Komunitas Nuklir</h2>
                    <ol>
                        <li><a href="{{ route('home') }}">Utama</a></li>
                        <li>Komunitas</li>
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
                            @foreach ($communities as $community)
                                <div class="col-lg-6">
                                    <article class="d-flex flex-column">

                                        <div class="post-img">
                                            <img src="{{ asset('storage/' . $community->image) }}" alt=""
                                                class="img-fluid">
                                        </div>

                                        <h2 class="title">
                                            <a
                                                href="{{ route('detailpemas', $community->slug) }}">{{ $community->name }}</a>
                                        </h2>

                                        <div class="meta-top">
                                            <ul>
                                                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                                        href="blog-details.html">{{ $community->user->username }}</a></li>
                                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                                        href="blog-details.html"><time
                                                            datetime="{{ $community->created }}">{{ $community->created }}</time></a>
                                                </li>
                                            </ul>
                                            <ul>
                                                <li class="d-flex align-items-center mt-2"><i class="bi bi-alarm"></i> <a
                                                        href="blog-details.html">Status:
                                                        <strong>{{ $community->status }}</strong></a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="content">
                                            <p>
                                                {!! $community->content !!}
                                            </p>
                                        </div>

                                        <div class="read-more mt-auto align-self-end">
                                            <a href="{{ route('detailcommunity', $community->slug) }}">Baca</a>
                                        </div>

                                    </article>
                                </div><!-- End post list item -->
                            @endforeach
                        </div>

                        <div class="blog-pagination">
                            {{ $communities->links() }}
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
                                    <li><a href="{{ route('communities', ['name' => 'selesai']) }}">Selesai</a></li>
                                    <li><a href="{{ route('communities', ['name' => 'Pencarian Volunteer']) }}">Pencarian
                                            Volunteer</a></li>
                                    <li><a href="{{ route('communities', ['name' => 'Kesehatan']) }}">Kesehatan</a></li>
                                    <li><a href="{{ route('communities', ['name' => 'Industri']) }}">Indutri</a></li>
                                    <li><a href="{{ route('communities', ['name' => 'Pangan']) }}">Pangan</a></li>
                                    <li><a href="{{ route('communities', ['name' => 'Umum']) }}">Umum</a></li>
                            </div><!-- End sidebar tags-->

                        </div><!-- End Blog Sidebar -->

                    </div>

                </div>

            </div>
        </section><!-- End Blog Section -->

    </main><!-- End #main -->
@endsection
