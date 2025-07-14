<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #0071b4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('templateadmin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">DiskominfoSP</span>
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
            <a href="{{ route ('logo.index') }}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Logo
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route ('carousel.index') }}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Carousel
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
            <a href="{{ route ('berita.index') }}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Berita
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route ('pengumuman.index') }}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Pengumuman
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route ('galeri.index') }}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Galeri
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route ('video.index') }}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Video
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route ('layanan.index') }}" class="nav-link">
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
            <a href="{{ route ('kontak.index') }}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Kontak
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('lokasi.index') }}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Peta Jaringan
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
