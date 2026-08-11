<aside class="main-sidebar sidebar-dark-primary elevation-4"
  style="background-image: linear-gradient(180deg, #1e4974, #1e4974)">
  <!-- Brand Logo -->
  <a href="{{ route('beranda') }}" class="brand-link">
    <img src="{{ asset('image/logo-murung-raya.png') }}" alt="kelberiwit Logo" class="brand-image" style="opacity: .8;">
    <span class="brand-text font-weight-light">Kel. P. Cahu Sebrang</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item">
          <a href="{{ route('backend.dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('logo.index') }}" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Logo
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('carousel.index') }}" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Carousel
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('profilbidang.index') }}" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Profil Bidang
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Profil
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('tentang.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tentang</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('maklumat.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Maklumat Layanan</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Pegawai
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('jabatan.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Jabatan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('bidang.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Bidang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('pegawai.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Pegawai</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Statistik
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                  Data Statistik
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                {{-- Kependudukan --}}
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Kependudukan
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{ route('rentang-umur.index') }}" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Rentang Umur</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('jenis-kelamin.index') }}" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Jenis Kelamin</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('agama.index') }}" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Agama</p>
                      </a>
                    </li>
                  </ul>
                </li>

                {{-- Pendidikan --}}
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Pendidikan
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{ route('ijazah-tertinggi.index') }}" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Ijazah Tertinggi</p>
                      </a>
                    </li>
                  </ul>
                </li>

                {{-- Ketenagakerjaan --}}
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Ketenagakerjaan
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{ route('pekerjaan.index') }}" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Pekerjaan</p>
                      </a>
                    </li>
                  </ul>
                </li>

              </ul>
            </li>
            <li class="nav-item">
              <a href="{{ route('publikasi.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Publikasi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('infografis.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Infografis</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="{{ route('berita.index') }}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Berita
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('pengumuman.index') }}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Pengumuman
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('publikasi.index') }}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Publikasi
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('galeri.index') }}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Galeri
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('video.index') }}" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Video
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('layanan.index') }}" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Layanan
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('dokumen.index') }}" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Dokumen
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('kontak.index') }}" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Kontak
            </p>
          </a>
        </li>



        {{-- <li class="nav-item">
          <a href="{{ route('lokasi.index') }}" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Peta
            </p>
          </a>
        </li> --}}

      </ul>
    </nav>
    <!-- /.sidebar-menu -->

  </div>
  <!-- /.sidebar -->
</aside>