@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Dashboard')
@section('css')
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endsection

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Home</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="home-success" data-flashdata="{{ session('success') }}"></div>
    <div class="home-warning" data-flashdata="{{ session('warning') }}"></div>
    <div class="home-danger" data-flashdata="{{ session('danger') }}"></div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="small-box bg-light shadow">
                <div class="inner">
                    <h3>{{ $PeminjamanLab }}</h3>
                    <h5>Peminjaman Lab</h5>
                </div>
                <div class="icon">
                    <i class="ion ion-android-apps"></i>
                </div>
                <a href="{{ route('PeminjamanLab.index') }}" class="small-box-footer">Info Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="small-box bg-light shadow">
                <div class="inner">
                    <h3>{{ $PeminjamanAlat }}</h3>
                    <h5>Peminjaman Alat</h5>
                </div>
                <div class="icon">
                    <i class="ion ion-settings"></i>
                </div>
                <a href="{{ route('PeminjamanAlat.index') }}" class="small-box-footer">Info Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="small-box bg-light shadow">
                <div class="inner">
                    <h3>{{ $SuratBebasLabkom }}</h3>
                    <h5>Surat Bebas Labkom</h5>
                </div>
                <div class="icon">
                    <i class="ion ion-document"></i>
                </div>
                <a href="{{ route('SuratBebasLabkom.index') }}" class="small-box-footer">Info Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="small-box bg-light shadow">
                <div class="inner">
                    <h3>{{ $JasaPrint }}</h3>
                    <h5>Jasa Print</h5>
                </div>
                <div class="icon">
                    <i class="ion ion-printer"></i>
                </div>
                <a href="{{ route('JasaPrint.index') }}" class="small-box-footer">Info Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="small-box bg-light shadow">
                <div class="inner">
                    <h3>{{ $JasaInstallasi }}</h3>
                    <h5>Jasa Installasi</h5>
                </div>
                <div class="icon">
                    <i class="ion ion-laptop"></i>
                </div>
                <a href="{{ route('JasaInstallasi.index') }}" class="small-box-footer">Info Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div id="home"></div>
@endsection
