@extends('tamplate.landingpage.main')


@section('main')
    <section id="hero-fullscreen" class="hero-fullscreen d-flex align-items-center">
        <video autoplay muted loop id="video-background">
            <source src="{{ asset('img/uranium.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="container d-flex flex-column align-items-center position-relative" data-aos="zoom-out">
            <h2 class="text-white">Selamat Datang di <span>Wikin</span></h2>
            <p class="text-white">Website Interaktif Komunitas Nuklir Indonesia.</p>
            <div class="d-flex">
                <a href="#about" class="btn-get-started scrollto">Mulai</a>
                <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ"
                    class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch
                        Video</span></a>
            </div>
        </div>
    </section>
    <main id="main">



        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Tentang Wikin</h2>
                    <p>Wikin (Website Interaktif Komunitas Nuklir Indonesia) Tempat anda menuangkan segala ide dan gagasan
                        tentang kenukliran.</p>
                </div>

                <div class="row g-4 g-lg-8" data-aos="fade-up" data-aos-delay="200">

                    <div class="col-lg-5 about-logo">
                        <div class="about-img">
                            <img src="{{ asset('img/logo.png') }}" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-7">

                        <!-- Tab Content -->
                        <div class="tab-content">

                            <div class="tab-pane fade show active" id="tab1">

                                <p class="fst-italic">Wikin bertujuan untuk mendorong pertumbuhan komunitas nuklir yang
                                    berdedikasi, berwawasan
                                    luas, dan memiliki kontribusi positif bagi kemajuan teknologi nuklir di Indonesia.
                                </p>
                                <p class="fst-italic"> Dengan
                                    memberikan wadah interaktif dan informatif, web ini berupaya menciptakan ruang yang aman
                                    dan
                                    terbuka bagi para pemangku kepentingan nuklir dalam berbagi pengetahuan dan pengalaman
                                    kepada masyarakat umum.
                                    Fitur-fitur yang bisa anda dapatkan :
                                </p>

                                <ul>
                                    <li><i class="bi bi-check-circle-fill"></i> Sharing Informasi Kenukliran</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Pengajuan Pengabdian Masyarakat Kenukliran
                                    </li>
                                    <li><i class="bi bi-check-circle-fill"></i> Join Komunitas Kenukliran</li>
                                </ul>

                            </div>

                        </div>

                    </div>

                </div>
        </section><!-- End About Section -->


        <!-- ======= Features Section ======= -->
        <section id="features" class="features">
            <div class="container" data-aos="fade-up">

                <ul class="nav nav-tabs row gy-4 d-flex">

                    <li class="nav-item col-12 col-md-4 col-lg-4">
                        <a class="nav-link show" data-bs-toggle="tab" data-bs-target="#tab-1">
                            <i class="bi bi-newspaper color-cyan"></i>
                            <h4>Berita Informasi</h4>
                            <p>12</p>
                        </a>
                    </li><!-- End Tab 1 Nav -->


                    <li class="nav-item col-12 col-md-4 col-lg-4">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-4">
                            <i class="bi bi-people color-red"></i>
                            <h4>Komunitas</h4>
                            <p>13</p>
                        </a>
                    </li><!-- End Tab 4 Nav -->

                    <li class="nav-item col-12 col-md-4 col-lg-4">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-6">
                            <i class="bi bi-house-heart color-orange"></i>
                            <h4 class="text-center">Pengabdian</h4>
                            <p>16</p>
                        </a>
                    </li><!-- End Tab 6 Nav -->

                </ul>


            </div>
        </section><!-- End Features Section -->


        <!-- ======= On Focus Section ======= -->
        <section id="onfocus" class="onfocus">
            <div class="container-fluid p-0" data-aos="fade-up">

                <div class="row g-0">
                    <div class="col-lg-6 video-play position-relative">
                        <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>
                    </div>
                    <div class="col-lg-6">
                        <div class="content d-flex flex-column justify-content-center h-100">
                            <h3>Galeri Komunitas Nuklir Indonesia</h3>
                            <p class="fst-italic">
                                Merupakan wadah bagi komunitas nuklir yang bertujuan untuk
                                mempromosikan pemahaman dan kesadaran tentang teknologi
                                nuklir di
                                Indonesia. Kegiatan tersebut dapat berupa pameran, seminar, atau kegiatan lainnya untuk
                                memperkenalkan dan mengedukasi masyarakat tentang berbagai aspek teknologi nuklir. aspek
                                tersebut antara lain :
                            </p>
                            <ul>
                                <li><i class="bi bi-check-circle"></i> Kesehatan</li>
                                <li><i class="bi bi-check-circle"></i>Energi</li>
                                <li><i class="bi bi-check-circle"></i> Pangan.</li>
                                <li><i class="bi bi-check-circle"></i> Industri.</li>
                            </ul>
                            <p>
                                Untuk melihat komunitas-komunitas silahkan klik tombol di bawah ini
                            </p>
                            <a href="{{ route('communities') }}"
                                class="read-more align-self-start"><span>Selengkapnya</span><i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End On Focus Section -->


        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Layanan tersedia</h2>
                    <p>Terdapat beberapa layanan yang tersedia di platform wikin.</p>
                </div>

                <div class="row gy-5">

                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="500">
                        <div class="service-item">
                            <div class="img">
                                <img src="{{ asset('img/informasi.jpeg') }}" class="img-fluid" alt="">
                            </div>
                            <div class="details position-relative">
                                <div class="icon">
                                    <i class="bi bi-chat-square-text"></i>
                                </div>
                                <a href="#" class="stretched-link">
                                    <h3>Sharing Informasi</h3>
                                </a>
                                <p>Sharing informasi kenukliran adalah proses pengguna untuk memperluas pengetahuan dan
                                    memahami sudut pandang yang beragam terhadap nuklir melalui
                                    kolaborasi dan diskusi, sehingga mencapai pemahaman yang lebih dalam dan menyeluruh.
                                </p>
                                <a href="#" class="stretched-link"></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="600">
                        <div class="service-item">
                            <div class="img">
                                <img src="{{ asset('img/pemas.jpeg') }}" class="img-fluid" alt="">
                            </div>
                            <div class="details position-relative">
                                <div class="icon">
                                    <i class="bi bi-house-heart-fill"></i>
                                </div>
                                <a href="#" class="stretched-link">
                                    <h3>Pengajuan Pemas</h3>
                                </a>
                                <p>Pengajuan Pengabdian Masyarakat (Pemas) adalah masyarakat dapat mengajukan suatu kegiatan
                                    di
                                    daerahnya ataupun di suatu tempat yang berhubungan dengan teknologi nuklir.
                                </p>
                                <a href="#" class="stretched-link"></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="700">
                        <div class="service-item">
                            <div class="img">
                                <img src="{{ asset('img/community.jpeg') }}" class="img-fluid" alt="">
                            </div>
                            <div class="details position-relative">
                                <div class="icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <a href="#" class="stretched-link">
                                    <h3>Galeri Komunitas</h3>
                                </a>
                                <p>Galeri Komunitas adalah ruang bagi masyarakat untuk mengeksplorasi mengenai
                                    komunitas-komunitas nuklir di Indonesia. Selain itu, dapat melihat kegiatan-kegiatan
                                    komunitas tersebut hingga dapat berkolaborasi.</p>
                                <a href="#" class="stretched-link"></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>
        </section><!-- End Services Section -->

        <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials">
            <div class="container" data-aos="fade-up">

                <div class="testimonials-slider swiper">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="{{ asset('img/testimonials/testimonials-3.jpg') }}" class="testimonial-img"
                                    alt="">
                                <h3>B.J. Habibie</h3>
                                <h4>Presiden Ketiga Dan Mantan Kementrian Ristek dan Teknologi</h4>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    Saya tidak menolak (pembangunan PLTN), namun sebaiknya tetap harus berhati-hati
                                    dalam mengambil keputusan.
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="{{ asset('img/testimonials/testimonial2.png') }}" class="testimonial-img"
                                    alt="">
                                <h3>Bung Karno</h3>
                                <h4>Presiden Pertama Indonesia</h4>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    Negara maju harus menguasai teknologi nuklir. Kalau ini bisa terealisasi, kita bisa
                                    merealisasikan visi pendiri bangsa ini
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="{{ asset('img/testimonials/testimonial1.jpg') }}" class="testimonial-img"
                                    alt="">
                                <h3>Albert Einstein</h3>
                                <h4>Ilmuan</h4>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    Energi nuklir tidak berbahaya. Bahaya datang dari manusia yang salah dalam
                                    menggunakannya.
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img"
                                    alt="">
                                <h3>Matt Brandon</h3>
                                <h4>Freelancer</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat
                                    minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore
                                    labore illum veniam.
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img"
                                    alt="">
                                <h3>John Larson</h3>
                                <h4>Entrepreneur</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster
                                    veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam
                                    culpa fore nisi cillum quid.
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section><!-- End Testimonials Section -->

        <!-- ======= Recent Blog Posts Section ======= -->
        <section id="recent-blog-posts" class="recent-blog-posts">

            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Informasi Trending</h2>
                    <p>Berisikan informasi-informasi terkini mengenai teknologi kenukliran</p>
                </div>

                <div class="row">
                    @foreach ($lot_news as $news)
                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="post-box">
                                <div class="post-img"><img src="{{ asset('images/' . $news->image) }}" class="img-fluid"
                                        alt="">
                                </div>
                                <div class="meta">
                                    <span class="post-date">{{ $news->created }}</span>
                                    <span class="post-author"> / {{ $news->author }}</span>
                                </div>
                                <h3 class="post-title">{{ $news->title }}
                                </h3>
                                <p>{{ $news->description }}...</p>
                                <a href="{{ route('detail', $news->slug) }}"
                                    class="readmore stretched-link"><span>Baca</span><i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    @endforeach




                </div>

            </div>
            <div class="container mt-4">
                <div class="d-flex justify-content-center">
                    <a href="{{ route('news') }}" class="btn"
                        style="background-color: #6f2da8; color: white;">Selengkapnya</a>
                </div>
            </div>


        </section><!-- End Recent Blog Posts Section -->
        <!-- ======= Recent Blog Posts Section ======= -->
        <section id="recent-blog-posts" class="recent-blog-posts">

            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Pengabdian Masyarakat</h2>
                    <p>Berisikan informasi mengenai adanya kegiatan pengabdian masyarakat di Indonesia</p>
                </div>

                <div class="row">
                    @foreach ($pemases as $pemas)
                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="post-box">
                                <div class="post-img"><img src="{{ asset('storage/images/' . $pemas->image) }}"
                                        class="img-fluid" alt="">
                                </div>
                                <div class="meta">
                                    <span class="post-date">{{ $pemas->created }}</span>
                                    <span class="post-author"> / {{ $pemas->author }}</span>
                                    <span class="post-author"> / Status: ({{ $pemas->status_pemas }})</span>
                                </div>
                                <h3 class="post-title">{{ $pemas->name }} ({{ $pemas->location }})
                                </h3>
                                <p>{!! $pemas->content !!}</p>
                                <a href="{{ route('detailpemas', $pemas->slug) }}"
                                    class="readmore stretched-link"><span>Baca</span><i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
            <div class="container mt-4">
                <div class="container mt-4">
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('news') }}" class="btn"
                            style="background-color: #6f2da8; color: white;">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </section><!-- End Recent Blog Posts Section -->

        <!-- ======= F.A.Q Section ======= -->
        <section id="faq" class="faq">
            <div class="container-fluid" data-aos="fade-up">

                <div class="row gy-4">

                    <div
                        class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

                        <div class="content px-xl-5">
                            <h3><strong>Pertanyaan</strong> yang sering diajukan</h3>
                            <p>
                                Merupakan kumpulan pertanyaan mengenai wikin
                            </p>
                        </div>

                        <div class="accordion accordion-flush px-xl-5" id="faqlist">

                            <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-content-1">
                                        <i class="bi bi-question-circle question-icon"></i>
                                        Apa itu wikin?
                                    </button>
                                </h3>
                                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet
                                        non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor
                                        purus non.
                                    </div>
                                </div>
                            </div><!-- # Faq item-->

                            <div class="accordion-item" data-aos="fade-up" data-aos-delay="300">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-content-2">
                                        <i class="bi bi-question-circle question-icon"></i>
                                        Bagaimana cara membuat informasi kenukliran?
                                    </button>
                                </h3>
                                <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum
                                        velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend
                                        donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in
                                        cursus turpis massa tincidunt dui.
                                    </div>
                                </div>
                            </div><!-- # Faq item-->

                            <div class="accordion-item" data-aos="fade-up" data-aos-delay="400">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-content-3">
                                        <i class="bi bi-question-circle question-icon"></i>
                                        Bagaimana mengajukan pengabdian masyarakat?
                                    </button>
                                </h3>
                                <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus
                                        pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit.
                                        Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis
                                        tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                                    </div>
                                </div>
                            </div><!-- # Faq item-->

                            <div class="accordion-item" data-aos="fade-up" data-aos-delay="500">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-content-4">
                                        <i class="bi bi-question-circle question-icon"></i>
                                        Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?
                                    </button>
                                </h3>
                                <div id="faq-content-4" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        <i class="bi bi-question-circle question-icon"></i>
                                        Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum
                                        velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend
                                        donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in
                                        cursus turpis massa tincidunt dui.
                                    </div>
                                </div>
                            </div><!-- # Faq item-->

                            <div class="accordion-item" data-aos="fade-up" data-aos-delay="600">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-content-5">
                                        <i class="bi bi-question-circle question-icon"></i>
                                        Tempus quam pellentesque nec nam aliquam sem et tortor consequat?
                                    </button>
                                </h3>
                                <div id="faq-content-5" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in
                                        est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl
                                        suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
                                    </div>
                                </div>
                            </div><!-- # Faq item-->

                        </div>

                    </div>

                    <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img"
                        style='background-image: url("img/faq.jpg");'>&nbsp;</div>
                </div>

            </div>
        </section><!-- End F.A.Q Section -->

    </main><!-- End #main -->
@endsection
