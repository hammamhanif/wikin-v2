@extends('tamplate.landingpage.main')

@section('main')
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact mt-5">
        <div class="container">

            <div class="section-header">
                <h2>Hubungi Kami</h2>
                <p>Apabila ada pertanyaan, masukkan, dan meminta bantuan seputar fitur wikin. silahkan kirimkan formulir di
                    bawah ini</p>
            </div>

        </div>

        {{-- <div class="map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621"
                frameborder="0" allowfullscreen></iframe>
        </div><!-- End Google Maps --> --}}

        <div class="container">

            <div class="row gy-5 gx-lg-5">

                <div class="col-lg-4">

                    <div class="info">
                        <h3>Hubungi Luring</h3>
                        <p>Silahkan datangi kami sesuai alamat kami.</p>

                        <div class="info-item d-flex">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h4>Lokasi:</h4>
                                <p>{{ $landing->location }}</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h4>Email:</h4>
                                <p>{{ $landing->email }}</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex">
                            <i class="bi bi-phone flex-shrink-0"></i>
                            <div>
                                <h4>Telepon:</h4>
                                <p>{{ $landing->telp }}</p>
                            </div>
                        </div><!-- End Info Item -->

                    </div>

                </div>

                <div class="col-lg-8">
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
                    <form action="{{ route('kontaks') }}" method="post" role="form" class="php-email-form">
                        @method('POST')
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Nama"
                                    required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                                    required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subjek"
                                required>
                        </div>

                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" placeholder="Pesan" required></textarea>
                        </div>
                        <div class="form-group mb-3 mt-2">
                            <div class="captcha">
                                <span id="captcha-img">{!! captcha_img() !!}</span>
                                <button type="button" class="btn btn-primary reload" id="reload">&#x21bb;</button>
                            </div>
                        </div>
                        <div class="input-group mb-1">
                            <input type="text" id="captcha" name="captcha" required placeholder="Masukkan Captcha">
                        </div>
                        <div class="text-center"><button type="submit">Kirimkan pesan</button></div>
                    </form>
                </div><!-- End Contact Form -->

            </div>

        </div>
    </section><!-- End Contact Section -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the reload button and captcha image
            var reloadButton = document.getElementById('reload');
            var captchaImage = document.getElementById('captcha-img');

            // Attach a click event listener to the reload button
            reloadButton.addEventListener('click', function() {
                // Generate a new captcha image URL by adding a timestamp parameter
                var captchaImageUrl = "{{ route('captcha') }}?" + Date.now();

                // Update the src attribute of the captcha image with the new URL
                captchaImage.innerHTML = '<img src="' + captchaImageUrl + '" alt="Captcha Image">';
            });
        });
    </script>
@endsection
