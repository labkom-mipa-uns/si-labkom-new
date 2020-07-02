@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Peminjaman Alat | Edit Data')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Data Peminjam</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('PeminjamanAlat.index') }}">Peminjaman Alat</a></li>
                <li class="breadcrumb-item active">Edit Data</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <form action="{{ route('PeminjamanAlat.update', $PeminjamanAlat->id) }}" method="post">
        @method('put')
        @csrf
        <div class="row">
            <div class="col-md-6">
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
                                <option selected value="{{ $PeminjamanAlat->id_mahasiswa }}">{{ $PeminjamanAlat->nama_mahasiswa }}</option>
                                @foreach($Peminjam as $elemen)
                                    <option value="{{ $elemen->id_mahasiswa }}">{{ $elemen->nama_mahasiswa }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Hari">Hari :</label>
                            <select name="hari" id="Hari" class="custom-select" required="">
                                <option>{{ $PeminjamanAlat->hari }}</option>
                                <option>Senin</option>
                                <option>Selasa</option>
                                <option>Rabu</option>
                                <option>Kamis</option>
                                <option>Jum'at</option>
                                <option>Sabtu</option>
                                <option>Minggu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Tanggal">Tanggal :</label>
                            <input type="text" name="tanggal" id="Tanggal" class="form-control" placeholder="Masukkan Tanggal" maxlength="25" required="" value="{{ $PeminjamanAlat->tanggal }}">
                        </div>
                        <div class="form-group">
                            <label for="Waktu">Waktu :</label>
                            <input type="text" name="waktu" id="Waktu" class="form-control" placeholder="Masukkan Waktu" maxlength="30" required="" value="{{ $PeminjamanAlat->waktu }}">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Barang</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="Alat">Alat :</label>
                            <select name="id_alat" id="Alat" class="custom-select" required="">
                                <option selected value="{{ $PeminjamanAlat->id_alat }}">{{ $PeminjamanAlat->nama_alat }}</option>
                                @foreach($Alat as $elemen)
                                    <option value="{{ $elemen->id_alat }}">{{ $elemen->nama_alat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Jumlah">Jumlah :</label>
                            <input type="number" name="jumlah" id="Jumlah" class="form-control" min="0" required="" value="{{ $PeminjamanAlat->jumlah }}">
                        </div>
                        <div class="form-group">
                            <label for="LamaPeminjaman">Lama Peminjaman :</label>
                            <select name="lama_peminjaman" id="LamaPeminjaman" class="custom-select" required="">
                                <option selected>{{ $PeminjamanAlat->lama_peminjaman }}</option>
                                <option>1 hari</option>
                                <option>2 hari</option>
                                <option>3 hari</option>
                                <option>4 hari</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Keperluan">Keperluan :</label>
                            <textarea name="keperluan" cols="40" rows="4" id="Keperluan" class="form-control" placeholder="Masukkan keperluan" required="">{{ $PeminjamanAlat->keperluan }}</textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.card -->
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-body">
                    <div class="card-tools" >
                        <a href="{{ route('PeminjamanAlat.index') }}" class="btn btn-secondary btn-lg">Cancel</a>
                        <button type="submit" class="btn btn-info btn-lg float-right">
                            <a>
                                <i class="fas fa-pen"></i>
                                Update Data
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
