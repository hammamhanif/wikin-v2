@extends('tamplate.landingpage.main')
@push('custom-css')
    <style>
        .post-img {
            margin-bottom: 20px;
            max-width: 100%;
            /* Adjusted maximum width */
        }



        @media (min-width: 768px) {
            .post-img {
                float: left;
                margin-right: 20px;
                /* Reduced margin for better spacing */
                width: 40%;
                /* Reduced width for better layout */
            }

            .content {
                overflow: hidden;
            }
        }

        /* For screen sizes smaller than 768px */
        @media (max-width: 993px) {
            .post-img {
                display: block;
                margin: auto;
                width: 100%;
                float: none;
                /* Disable float for center alignment */
            }

            .content {
                padding: 0 10px;
            }

        }

        .btn-outline-primary-custom {
            color: #6F2DA8;
            border-color: #6F2DA8;
        }

        .btn-outline-primary-custom:hover {
            color: #fff;
            background-color: #6F2DA8;
            border-color: #6F2DA8;
        }

        .btn-primary-custom2 {
            color: #fff;
            background-color: #6F2DA8;
            border-color: #6F2DA8;
        }

        .btn-primary-custom2:hover {
            color: #fff;
            background-color: #4A156B;
            border-color: #4A156B;
        }
    </style>
@endpush

@section('main')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
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
                            <div class="post-img mt-3">
                                <img src="{{ asset('images/' . $community->image) }}" alt="" class="img-fluid">
                            </div>
                            <h2 class="title">{{ htmlentities($community->name) }}</h2>
                            <div class="meta-top">
                                <ul>
                                    <li class="d-flex align-items-center">
                                        <i class="bi bi-person"></i>
                                        {{ htmlentities($community->user->username) }}
                                        <a href=""></a>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <i class="bi bi-clock"></i>
                                        <a href=""><time
                                                datetime="2020-01-01">{{ htmlentities($community->created) }}</time></a>
                                    </li>
                                </ul>
                            </div><!-- End meta top -->
                            <div class="content">
                                {!! html_entity_decode($community->content) !!}
                            </div><!-- End post content -->
                            <a class="btn btn-outline-primary-custom"
                                href="https://wa.me/{{ $community->number }}?text=Saya%20tertarik%20dengan%20komunitas%20Anda,%20bolehkah%20saya%20bertanya-tanya%3F"
                                role="button" target="_blank">Hubungi Kontak</a>
                            <a class="btn btn-primary-custom2"
                                href="https://wa.me/{{ $community->number }}?text=Saya%20tertarik%20dengan%20komunitas%20Anda,%20bolehkah%20saya%20bertanya-tanya%3F"
                                role="button" target="_blank">Galeri Kegiatan</a>
                        </article><!-- End blog post -->
                    </div>
                </div>
            </div>
        </section><!-- End Blog Details Section -->


    </main><!-- End #main -->
@endsection
