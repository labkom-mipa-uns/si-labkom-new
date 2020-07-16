@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Alat | Insert Data')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Insert Data Alat</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('Alat.index') }}">Alat</a></li>
                <li class="breadcrumb-item active">Insert Data</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <form action="{{ route('Alat.store') }}" method="post">
        @csrf
        @method('post')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Alat</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="Nama">Nama Alat :</label>
                            <input type="text" name="nama_alat" id="Nama" class="form-control @error('nama_alat') is-invalid @enderror" placeholder="Masukkan Nama Alat" autocomplete="off" value="{{ old('nama_alat') }}"/>
                            @error('nama_alat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Harga">Harga Alat :</label>
                            <input type="number" name="harga_alat" id="Harga" class="form-control @error('harga_alat') is-invalid @enderror" placeholder="Masukkan Harga Alat" value="{{ old('harga_alat') }}" autocomplete="off">
                            @error('harga_alat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-body">
                    <div class="card-tools" >
                        <a href="{{ route('Alat.index') }}" class="btn btn-secondary btn-lg">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-lg float-right">
                            <i class="fas fa-plus"></i>
                            Insert Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
