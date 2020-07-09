@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Peminjaman Lab | Insert Data')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Insert Data Peminjam</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('PeminjamanLab.index') }}">Peminjaman Lab</a></li>
                <li class="breadcrumb-item active">Insert Data</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <form action="{{ route('PeminjamanLab.store') }}" method="post">
        @csrf
        @method('post')
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
                            <select name="id_mahasiswa" id="Nama" class="custom-select">
                                <option disabled selected>Pilih Nama Mahasiswa</option>
                                @foreach($Mahasiswa as $elemen)
                                    <option value="{{ $elemen->id }}">{{ $elemen->nama_mahasiswa }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Hari">Hari :</label>
                            <select name="hari" id="Hari" class="form-control custom-select">
                                <option disabled selected>Pilih hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Tanggal">Tanggal :</label>
                            <input type="text" name="tanggal" id="Tanggal" class="form-control" placeholder="Masukkan tanggal" onfocus="this.type = 'date'">
                        </div>
                        <div class="form-group">
                            <label for="Jadwal">Jadwal :</label>
                            <select name="id_jadwal" id="Jadwal" class="custom-select" >
                                <option disabled selected>Pilih Jadwal</option>
                                @foreach($Jadwal as $elemen)
                                    <option value="{{ $elemen->id }}">{{ $elemen->nama_dosen }} - {{ $elemen->nama_prodi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Ruang</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="Lab">Lab :</label>
                            <select name="id_lab" id="Lab" class="custom-select">
                                <option disabled selected>Pilih Laboratorium</option>
                                @foreach($Lab as $elemen)
                                    <option value="{{ $elemen->id_lab }}">{{ $elemen->nama_lab }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="JamPinjam">Jam Pinjam :</label>
                            <input type="time" name="jam_pinjam" id="JamPinjam" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="JamKembali">Jam Kembali :</label>
                            <input type="time" name="jam_kembali" id="JamKembali" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Keperluan">Keperluan :</label>
                            <textarea name="keperluan" cols="40" rows="4" id="Keperluan" class="form-control"
                                      placeholder="Masukkan keperluan"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori :</label>
                            <select name="kategori" id="kategori" class="custom-select">
                                <option disabled selected>Pilih Kategori</option>
                                <option value="didalam_jam">Didalam Jam Kuliah</option>
                                <option value="diluar_jam">Diluar Jam Kuliah</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status :</label>
                            <select name="status" id="status" class="custom-select">
                                <option disabled selected>Pilih Status</option>
                                <option value="0">Masih Dipinjam</option>
                                <option value="1">Sudah Dikembalikan</option>
                            </select>
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
                        <a href="{{ route('PeminjamanLab.index') }}" class="btn btn-secondary btn-lg">Cancel</a>
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
