@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Mahasiswa | Insert Data')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Insert Data Mahasiswa</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('Mahasiswa.index') }}">Mahasiswa</a></li>
                <li class="breadcrumb-item active">Insert Data</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <form action="{{ route('Mahasiswa.store') }}" method="post">
        @csrf
        @method('post')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Personal</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="Nama">Nama :</label>
                            <input type="text" name="nama_mahasiswa" id="Nama" class="form-control" placeholder="Masukkan nama" maxlength="55">
                        </div>
                        <div class="form-group">
                            <label for="NIM">NIM :</label>
                            <input type="text" name="nim" id="NIM" class="form-control" placeholder="Masukkan NIM" maxlength="8">
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin :</label>
                            <select name="jenis_kelamin_mahasiswa" id="jenis_kelamin" class="custom-select">
                                <option disabled selected>Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Kelas">Kelas :</label>
                            <input type="text" name="kelas" id="Kelas" class="form-control" placeholder="Masukkan kelas" maxlength="10" required>
                        </div>
                        <div class="form-group">
                            <label for="ProgramStudi">Program Studi :</label>
                            <select name="id_prodi" id="ProgramStudi" class="custom-select">
                                <option ></option>
                                @foreach($Prodi as $elemen)
                                    <option value="{{ $elemen->id }}">{{ $elemen->nama_prodi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Angkatan">Angkatan :</label>
                            <select name="angkatan" id="Angkatan" class="custom-select">
                                <option disabled selected>Pilih Angkatan</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No HP :</label>
                            <input type="number" name="no_hp" id="no_hp" class="form-control" min="0">
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
                        <a href="{{ route('Mahasiswa.index') }}" class="btn btn-secondary btn-lg">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-lg float-right">
                            <a>
                                <i class="fas fa-plus"></i>
                                Insert Data
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
