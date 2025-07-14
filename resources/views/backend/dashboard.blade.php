@extends('backend.layout.master')

@section('judul')

    Halaman Admin
    <h1>Selamat Datang di Dashboard Admin <strong>{{ Auth::user()->name }}</strong></h1>

@endsection

@section('content')

<div class="container-fluid">

    <!-- Small boxes (Stat box) -->
    <div class="row">

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$jumlahBidang}}</h3>

            <p>Data Bidang</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          {{-- <a href="{{ route('bidang.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
             <h3>{{$jumlahJabatan}}</h3>

            <p>Data Jabatan</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
           <div class="inner">
             <h3>{{$jumlahPegawai}}</h3>

            <p>Data Pegawai</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
           <div class="inner">
             <h3>{{$jumlahBerita}}</h3>

            <p>Data Berita</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
        </div>
      </div>
      
    </div>

    <div class="row">

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$jumlahPengumuman}}</h3>

            <p>Data Pengumuman</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          {{-- <a href="{{ route('bidang.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
             <h3>{{$jumlahGaleri}}</h3>

            <p>Data Galeri</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
           <div class="inner">
             <h3>{{$jumlahVideo}}</h3>

            <p>Data Video</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
           <div class="inner">
             <h3>{{$jumlahLayanan}}</h3>

            <p>Data Layanan</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
        </div>
      </div>
      
    </div>
    <!-- /.row -->

    <div class="row">

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$jumlahDokumen}}</h3>

            <p>Data Dokumen</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          {{-- <a href="{{ route('bidang.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
             <h3>{{$jumlahPeta}}</h3>

            <p>Data Peta Jaringan</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
        </div>
      </div>

    </div>

    <!-- Main row -->
    <div class="row">
      <section class="col-12">
        
      </section>
    </div>


  </div>

    
@endsection