<!-- ======= Header ======= -->
<header id="header" class="header fixed-top" data-scrollto-offset="0">
    <div class="container-fluid d-flex align-items-center justify-content-between">

        <a href="{{ route('home') }}" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1>Wikin<span>.</span></h1>
        </a>

        <nav id="navbar" class="navbar">
            <ul>

                <li><a class="nav-link scrollto" href="{{ route('home') }}">Utama</a></li>

                <li><a class="nav-link scrollto" href="{{ route('home') }}#about">Tentang Kami</a></li>
                <li><a class="nav-link scrollto" href="{{ route('pengmases') }}">Pemas</a></li>

                <li><a href="{{ route('communities') }}">Komunitas</a></li>

                <li class="dropdown"><a href=""><span>Forum</span> <i
                            class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="{{ route('news') }}">Forum</a></li>
                        <li><a href="{{ route('news', ['title' => 'Kesehatan']) }}">Kesehatan</a></li>
                        <li><a href="#">Drop Down 3</a></li>
                        <li><a href="#">Drop Down 4</a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="{{ route('contact') }}">Hubungi</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle d-none"></i>
        </nav><!-- .navbar -->

        <a class="btn-getstarted scrollto" href="{{ route('dashboard') }}">Masuk</a>

    </div>
</header><!-- End Header -->
