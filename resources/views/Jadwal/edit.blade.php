@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Jadwal | Update Data')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Insert Jadwal</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('Jadwal.index') }}">Jadwal</a></li>
                <li class="breadcrumb-item active">Update Jadwal</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <form action="{{ route('Jadwal.update') }}" method="post">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Jadwal</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="Prodi">Program Studi :</label>
                            <select name="id_prodi" id="Prodi" class="form-control custom-select">
                                <option selected value="{{ $Jadwal->id_prodi }}">{{ $Jadwal->nama_prodi }}</option>
                                @foreach($Prodi as $elemen)
                                    <option value="{{ $elemen->id }}">{{ $elemen->nama_prodi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Dosen">Dosen :</label>
                            <select name="id_dosen" id="Dosen" class="form-control custom-select">
                                <option selected value="{{ $Jadwal->id_dosen }}">{{ $Jadwal->nama_dosen }}</option>
                                @foreach($Dosen as $elemen)
                                    <option value="{{ $elemen->id }}">{{ $elemen->nama_dosen }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="MataKuliah">Mata Kuliah :</label>
                            <select name="id_matkul" id="MataKuliah" class="form-control custom-select">
                                <option selected value="{{ $Jadwal->id_matkul }}">{{ $Jadwal->nama_matkul }}</option>
                                @foreach($MataKuliah as $elemen)
                                    <option value="{{ $elemen->id }}">{{ $elemen->nama_matkul }}</option>
                                @endforeach
                            </select>
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
                        <a href="{{ route('Jadwal.index') }}" class="btn btn-secondary btn-lg">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-lg float-right">
                            <a>
                                <i class="fas fa-plus"></i>
                                Update Data
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
