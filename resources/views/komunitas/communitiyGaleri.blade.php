@extends('tamplate.landingpage.main')

@section('main')
    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Galeri <strong>Komunitas {{ $community->name }}</strong></h2>
                <p>Galeri Komunitas nuklir di indonesia yang bergerak di berbagai bidang. berisikan segala kegiatan
                    komunitas yang bersifat positif dan edukatif.</p>

            </div>



            <div class="row gy-5">
                @foreach ($galleries as $gallery)
                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="500">
                        <div class="service-item">
                            <div class="img">
                                <img src="{{ asset('storage/' . $gallery->image) }}" class="img-fluid" alt="">
                            </div>
                            <div class="details position-relative">
                                <div class="icon">
                                    <i class="bi bi-bounding-box-circles"></i>
                                </div>
                                <a href="#" class="stretched-link">
                                    <h3>{{ $gallery->title }}</h3>
                                </a>
                                <p>{{ $gallery->description }}</p>
                                <a href="#" class="stretched-link"></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->
                @endforeach


            </div>

        </div>
    </section><!-- End Services Section -->
@endsection
