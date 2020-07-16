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
    <form action="{{ route('SuratBebasLabkom.update', $SuratBebasLabkom->id) }}" method="post">
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
                            <select name="id_mahasiswa" id="Nama" class="custom-select @error('id_mahasiswa') is-invalid @enderror">
                                @foreach($Mahasiswa as $elemen)
                                    @if($SuratBebasLabkom->id_mahasiswa == $elemen->id)
                                        <option selected value="{{ $SuratBebasLabkom->id_mahasiswa }}">{{ $elemen->nama_mahasiswa }}</option>
                                    @else
                                        <option value="{{ $elemen->id }}">{{ $elemen->nama_mahasiswa }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('id_mahasiswa')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Tanggal">Tanggal :</label>
                            <input type="text" name="tanggal" id="Tanggal" class="form-control @error('tanggal') is-invalid @enderror" placeholder="Masukkan tanggal" onfocus="this.type = 'date'" value="{{ $SuratBebasLabkom->tanggal }}">
                            @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Keperluan">Keperluan :</label>
                            <textarea name="keperluan" cols="40" rows="4" id="Keperluan" class="form-control @error('keperluan') is-invalid @enderror"
                                      placeholder="Masukkan keperluan">{{ $SuratBebasLabkom->keperluan }}</textarea>
                            @error('keperluan')
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
        <!-- /.card -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card-body">
                    <div class="card-tools">
                        <a href="{{ route('SuratBebasLabkom.index') }}" class="btn btn-secondary btn-lg">Cancel</a>
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
