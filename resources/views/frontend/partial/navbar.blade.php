@php
    $logo = \App\Models\Logo::first();
@endphp

<nav class="navbar navbar-expand-lg" id="mainNavbar">
    <div class="container">
        @if ($logo && $logo->foto)
            <img src="{{ asset('storage/logo/' . $logo->foto) }}" alt="" style="width: 45px; height: 45px;">
            <a class="navbar-brand" href="{{ route('beranda') }}">{{ $logo->judul }}</a>
        @else
            <a class="navbar-brand" href="{{ route('beranda') }}">Logo belum ada</a>
        @endif

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

         <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav ms-auto">
                 <li class="nav-item"><a class="nav-link" href="{{ route('beranda') }}">Beranda</a></li>
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="profilMenu" role="button">Profil<i
                             class="bi bi-chevron-down ms-1 small-indicator"></i></a>
                     <div class="dropdown-global" id="dropdownProfil">
                         <a href="{{ route('frontend.tentang') }}">Tentang</a>
                         <a href="{{ route('frontend.maklumat') }}">Maklumat Layanan</a>
                         <a href="{{ route('lihat-pegawai') }}">Struktur Organisasi</a>
                     </div>
                 </li>
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="galeriMenu" role="button">Galeri<i
                             class="bi bi-chevron-down ms-1 small-indicator"></i></a>
                     <div class="dropdown-global" id="dropdownGaleri">
                         <a href="{{ route('frontend.galerifoto') }}">Galeri Foto</a>
                         <a href="{{ route('frontend.galerivideo') }}">Galeri Video</a>
                         <a href="{{ route('lihat-berita') }}">Galeri Berita</a>
                         <a href="{{ route('lihat-pengumuman') }}">Galeri Pengumuman</a>
                     </div>
                 </li>
                 <li class="nav-item"><a class="nav-link" href="{{ route('frontend.dokumen') }}">Dokumen</a></li>
                 <li class="nav-item"><a class="nav-link" href="{{ route('peta.index') }}">Peta Jaringan</a></li>
                 <li class="nav-item"><a class="nav-link" href="{{ route('frontend.kontak') }}">Kontak</a></li>
                 @auth
                     <li class="nav-item"><a class="nav-link" href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                 @endauth
                  
                 <div class="theme-toggle" id="darkModeToggle">
                     <div class="toggle-switch">
                         <i id="darkIcon" class="bi bi-moon-stars-fill"></i>
                         <span id="darkLabel">Dark</span>
                     </div>
                 </div>
                 
             </ul>
         </div>
     </div>
 </nav>
