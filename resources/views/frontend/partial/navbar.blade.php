
 <nav class="navbar navbar-expand-lg" id="mainNavbar">
        <div class="container">
            <img src="image/logo-murung-raya.png" alt="" style="width: 45px; height: 45px; ">
            <a class="navbar-brand" href="{{ route('beranda') }}">Diskominfo</a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link dropdown-toggle" href="#" id="profilMenu">Profil</a>
                    </li>
                    <li class="nav-item"><a class="nav-link dropdown-toggle" href="#" id="galeriMenu">Galeri</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="">Dokumen</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('peta.index') }}">Peta Jaringan</a></li>
                    <li class="nav-item"><a class="nav-link" href="">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dropdown Global: Profil -->
    <div class="dropdown-global" id="dropdownProfil">
        <a href="{{ route ('frontend.tentang') }}">Tentang</a>
        <a href="">Maklumat Layanan</a>
        <a href="">Struktur Organisasi</a>
    </div>

    <!-- Dropdown Global: Galeri -->
    <div class="dropdown-global" id="dropdownGaleri">
        <a href="">Galeri Foto</a>
        <a href="">Galeri Video</a>
        <a href="{{ route('lihat-berita') }}">Galeri Berita</a>
        <a href="{{ route('lihat-pengumuman') }}">Galeri Pengumuman</a>
    </div>