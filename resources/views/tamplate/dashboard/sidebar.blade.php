  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
              <a class="nav-link {{ Request::is('dashboard') ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
                  <i class="bi bi-grid"></i>
                  <span>Dashboard</span>
              </a>
          </li><!-- End Dashboard Nav -->


          <li class="nav-heading">Berita Kamu</li>

          <li class="nav-item">
              <a class="nav-link {{ Request::is('post-informasi') ? '' : 'collapsed' }}"
                  href="{{ route('post.informasi') }}">
                  <i class="bi bi-newspaper"></i>
                  <span>Posting Berita</span>
              </a>
          </li><!-- End Profile Page Nav -->

          <li class="nav-item">
              <a class="nav-link {{ Request::is('informasi') ? '' : 'collapsed' }}" href="{{ route('informasi') }}">
                  <i class="bi bi-gear"></i>
                  <span>Menu Berita</span>
              </a>
          </li><!-- End Profile Page Nav -->
          <li class="nav-heading">Pengabdian Masyarakat (Pemas)</li>
          <li class="nav-item">
              <a class="nav-link {{ Request::is('requestpemas') ? '' : 'collapsed' }}"
                  href="{{ route('requestpemas') }}">
                  <i class="bi bi-ui-checks"></i>
                  <span>Pengajuan</span>
              </a>
          </li>
          @if (Auth::check() &&
                  (Auth::user()->type == 'admin' || Auth::user()->type == 'dosen' || Auth::user()->type == 'mahasiswa'))
              <li class="nav-item">
                  <a class="nav-link {{ Request::is('pemas') ? '' : 'collapsed' }}" href="{{ route('pemas') }}">
                      <i class="bi bi-file-earmark-post"></i>
                      <span>Laporan dan Open Rec</span>
                  </a>
              </li>
          @endif

          <li class="nav-item">
              <a class="nav-link {{ Request::is('registrasi-pemas/*') ? '' : 'collapsed' }}"
                  href="{{ route('registrasi_pemas.user') }}">
                  <i class="bi bi-person-fill-check"></i>
                  <span>Daftar Pengabdianmu</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link {{ Request::is('pemasSetting') || Request::is('pemasSetting/*') || Request::is('memberPemas/*') ? '' : 'collapsed' }}"
                  href="{{ route('pemasSetting') }}">
                  <i class="bi bi-gear"></i>
                  <span>Menu Pengabdian</span>
              </a>
          </li>

          <li class="nav-heading">Komunitas </li>
          <li class="nav-item">
              <a class="nav-link  {{ Request::is('komunitas/daftar') ? '' : 'collapsed' }}"
                  href="{{ route('komunitas.daftar') }}">
                  <i class="bi bi-person-video2"></i>
                  <span>Daftar Komunitas Wikin</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link {{ Request::is('community') ? '' : 'collapsed' }}"
                  href="{{ route('communities.create') }}">
                  <i class="bi bi-people-fill"></i>
                  <span>Pendaftaran Komunitas</span>
              </a>
          </li><!-- End Contact Page Nav -->
          <li class="nav-item">
              <a class="nav-link {{ Request::is('komunitas/pengguna') ? '' : 'collapsed' }}"
                  href="{{ route('komunitas.pengguna') }}">
                  <i class="bi bi-person-lines-fill"></i>
                  <span>Komunitas Kamu</span>
              </a>
          </li><!-- End Contact Page Nav -->
          <li class="nav-item">
              <a class="nav-link {{ Request::is('komunitas') || Request::is('registrasi-communities/*') || Request::is('galeri/*') || Request::is('community/*') ? '' : 'collapsed' }}"
                  href="{{ route('komunitas') }}">
                  <i class="bi bi-gear"></i>
                  <span>Menu Komunitas</span>
              </a>
          </li><!-- End Contact Page Nav -->
          @if (Auth::check() && Auth::user()->type == 'admin')
              <li class="nav-heading">Menu Admin</li>
              <li class="nav-item">
                  <a class="nav-link {{ Request::is('userdate') ? '' : 'collapsed' }}" href="{{ route('userdate') }}">
                      <i class="bi bi-person-circle"></i>
                      <span>Pengguna</span>
                  </a>
              </li><!-- End Register Page Nav -->

              <li class="nav-item">
                  <a class="nav-link {{ Request::is('menuNews') || Request::is('menuNews/*') ? '' : 'collapsed' }}"
                      href="{{ route('menuNews') }}">
                      <i class="bi bi-border-style"></i>
                      <span>Berita</span>
                  </a>
              </li><!-- End Login Page Nav -->
              <li class="nav-item">
                  <a class="nav-link  {{ Request::is('menuPemas') || Request::is('menuPemas/*') || Request::is('memberPemas-admin/*') ? '' : 'collapsed' }}"
                      href="{{ route('menuPemas') }}">
                      <i class="bi bi-house-door"></i>
                      <span>Pengabdian Masyarakat</span>
                  </a>
              </li><!-- End Blank Page Nav -->
              <li class="nav-item">
                  <a class="nav-link {{ Request::is('menuCommunity') || Request::is('menuCommunity/*') ? '' : 'collapsed' }}"
                      href="{{ route('menuCommunity') }}">
                      <i class="bi bi-people"></i>
                      <span>Komunitas</span>
                  </a>
              </li><!-- End Blank Page Nav -->

              <li class="nav-item">
                  <a class="nav-link {{ Request::is('menuHome') || Request::is('menuHome/*') ? '' : 'collapsed' }}"
                      href="{{ route('menuHome') }}">
                      <i class="bi bi-columns-gap"></i>
                      <span>Halaman Utama</span>
                  </a>
              </li><!-- End Error 404 Page Nav -->
              <li class="nav-item">
                  <a class="nav-link {{ Request::is('contacts') ? '' : 'collapsed' }}" href="{{ route('contacts') }}">
                      <i class="bi bi-telephone-inbound"></i>
                      <span>Hubungi Admin</span>
                  </a>
              </li><!-- End Error 404 Page Nav -->
          @endif
          <div style="text-align: center;">
              <a href="{{ route('home') }}" class="btn btn-outline-primary mb-3">
                  Halaman utama
              </a>
          </div>


      </ul>

  </aside><!-- End Sidebar-->
