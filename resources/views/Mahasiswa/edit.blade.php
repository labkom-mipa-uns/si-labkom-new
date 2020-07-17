@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Peminjaman Lab')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Data Mahasiswa</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('Mahasiswa.index') }}">Mahasiswa</a></li>
                <li class="breadcrumb-item active">Edit Data</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <form action="{{ route('Mahasiswa.update', $Mahasiswa->id) }}" method="post">
        @csrf
        @method('put')
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
                            <input type="text" name="nama_mahasiswa" id="Nama" class="form-control @error('nama_mahasiswa') is-invalid @enderror" placeholder="Masukkan nama" value="{{ $Mahasiswa->nama_mahasiswa }}" autocomplete="off">
                            @error('nama_mahasiswa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="NIM">NIM :</label>
                            <input type="text" name="nim" id="NIM" class="form-control @error('nim') is-invalid @enderror" placeholder="Masukkan NIM" value="{{ $Mahasiswa->nim }}" autocomplete="off">
                            @error('nim')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin :</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="custom-select @error('jenis_kelamin') is-invalid @enderror">
                                @if($Mahasiswa->jenis_kelamin === 'L')
                                    <option selected value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                @else
                                    <option value="L">Laki-laki</option>
                                    <option selected value="P">Perempuan</option>
                                @endif
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Kelas">Kelas :</label>
                            <input type="text" name="kelas" id="Kelas" class="form-control @error('kelas') is-invalid @enderror" placeholder="Masukkan kelas" value="{{ $Mahasiswa->kelas }}" autocomplete="off">
                            @error('kelas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="ProgramStudi">Program Studi :</label>
                            <select name="id_prodi" id="ProgramStudi" class="custom-select @error('id_prodi') is-invalid @enderror">
                                @foreach($Prodi as $elemen)
                                    @if($elemen->id === $Mahasiswa->id_prodi)
                                        <option selected value="{{ $Mahasiswa->id_prodi }}">{{ $Mahasiswa->prodi->nama_prodi }}</option>
                                    @else
                                        <option value="{{ $elemen->id_prodi }}">{{ $elemen->nama_prodi }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('id_prodi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Angkatan">Angkatan :</label>
                            <select name="angkatan" id="Angkatan" class="custom-select @error('angkatan') is-invalid @enderror">
                                <?php $array_angkatan = ['2016','2017','2018','2019','2020'] ?>
                                @foreach($array_angkatan as $year)
                                    @if($Mahasiswa->angkatan === $year)
                                        <option selected value="{{ $Mahasiswa->angkatan }}">{{ $Mahasiswa->angkatan }}</option>
                                    @else
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('angkatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No HP :</label>
                            <input type="tel" name="no_hp" id="no_hp" class="form-control" min="0" value="{{ $Mahasiswa->no_hp }}" autocomplete="off">
                            @error('no_hp')
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
                        <a href="{{ route('Mahasiswa.index') }}" class="btn btn-secondary btn-lg">Cancel</a>
                        <button type="submit" class="btn btn-info btn-lg float-right">
                            <i class="fas fa-pen"></i>
                            Update Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
