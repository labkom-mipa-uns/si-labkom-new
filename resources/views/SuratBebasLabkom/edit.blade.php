@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Surat Bebas Labkom | Edit Data')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Data Pemohon</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('SuratBebasLabkom.index') }}">Surat Bebas Labkom</a></li>
                <li class="breadcrumb-item active">Edit Data</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <form action="{{ route('SuratBebasLabkom.update', $Surat->id) }}" method="post">
        @method('put')
        @csrf
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
                            <select name="id_mahasiswa" id="Nama" class="custom-select" required>
                                <option value="{{ $Surat->id_mahasiswa }}">{{ $Surat->nama_mahasiswa }}</option>
                                @foreach($Mahasiswa as $elemen)
                                    <option value="{{ $elemen->id_mahasiswa }}">{{ $elemen->nama_mahasiswa }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Hari">Hari :</label>
                            <input type="text" name="hari" id="Hari" class="form-control" placeholder="Masukkan hari" maxlength="7" required="" value="{{ $Surat->hari }}">
                        </div>
                        <div class="form-group">
                            <label for="Tanggal">Tanggal :</label>
                            <input type="text" name="tanggal" id="Tanggal" class="form-control" placeholder="Masukkan tanggal" maxlength="25" required="" value="{{ $Surat->tanggal }}">
                        </div>
                        <div class="form-group">
                            <label for="Keperluan">Keperluan :</label>
                            <textarea class="form-control" name="keperluan" id="Keperluan" cols="30" rows="4" placeholder="Masukkan keperluan" required>{{ $Surat->keperluan }}</textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.card -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card-body">
                    <div class="card-tools">
                        <a href="{{ route('SuratBebasLabkom.index') }}" class="btn btn-secondary btn-lg">Cancel</a>
                        <button type="submit" class="btn btn-info btn-lg float-right">
                            <a>
                                <i class="fas fa-pen"></i>
                                Update
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
