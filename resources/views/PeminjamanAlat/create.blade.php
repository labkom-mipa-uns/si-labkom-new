@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Peminjaman Alat | Insert Data')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Insert Data Peminjam</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('PeminjamanAlat.index') }}">Peminjaman Alat</a></li>
                <li class="breadcrumb-item active">Insert Data</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <form action="{{ route('PeminjamanAlat.store') }}" method="post">
        @method('post')
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
                            <select name="id_mahasiswa" id="Nama" class="custom-select @error('id_mahasiswa') is-invalid @enderror">
                                <option disabled @if(!old('id_mahasiswa')) selected @endif>Pilih Nama Mahasiswa</option>
                                @foreach($Mahasiswa as $elemen)
                                    @if(old('id_mahasiswa') == $elemen->id)
                                        <option selected value="{{ old('id_mahasiswa') }}">{{ $elemen->nama_mahasiswa }}</option>
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
                            <label for="Tanggal_Pinjam">Tanggal Pinjam :</label>
                            <input type="text" name="tanggal_pinjam" id="Tanggal_Pinjam" class="form-control @error('tanggal_pinjam') is-invalid @enderror" placeholder="Masukkan tanggal" onfocus="this.type = 'date'" value="{{ old('tanggal_pinjam') }}">
                            @error('tanggal_pinjam')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Tanggal_Kembali">Tanggal Kembali :</label>
                            <input type="text" name="tanggal_kembali" id="Tanggal_Kembali" class="form-control @error('tanggal_kembali') is-invalid @enderror" placeholder="Masukkan tanggal" onfocus="this.type = 'date'" value="{{ old('tanggal_kembali') }}">
                            @error('tanggal_kembali')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="JamPinjam">Jam Pinjam :</label>
                            <input type="time" name="jam_pinjam" id="JamPinjam" class="form-control @error('jam_pinjam') is-invalid @enderror" value="{{ old('jam_pinjam') }}">
                            @error('jam_pinjam')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="JamKembali">Jam Kembali :</label>
                            <input type="time" name="jam_kembali" id="JamKembali" class="form-control @error('jam_kembali') is-invalid @enderror" value="{{ old('jam_kembali') }}">
                            @error('jam_kembali')
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
                            <label for="alat">Alat :</label>
                            <select name="id_alat" id="alat" class="custom-select @error('id_alat') is-invalid @enderror">
                                <option disabled @if(!old('id_alat')) selected @endif>Pilih Alat</option>
                                @foreach($Alat as $elemen)
                                    @if(old('id_alat') == $elemen->id)
                                        <option selected value="{{ old('id_alat') }}">{{ $elemen->nama_alat }}</option>
                                    @else
                                        <option value="{{ $elemen->id }}">{{ $elemen->nama_alat }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('id_alat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Keperluan">Keperluan :</label>
                            <textarea name="keperluan" cols="40" rows="4" id="Keperluan" class="form-control @error('keperluan') is-invalid @enderror"
                                      placeholder="Masukkan keperluan">{{ old('keperluan') }}</textarea>
                            @error('keperluan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jumlah_pinjam">Jumlah Pinjam :</label>
                            <input name="jumlah_pinjam" type="number" id="jumlah_pinjam" min="0" class="form-control @error('jumlah_pinjam') is-invalid @enderror" value="{{ old('jumlah_pinjam') }}">
                            @error('jumlah_pinjam')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status :</label>
                            <select name="status" id="status" class="custom-select @error('status') is-invalid @enderror">
                                <option disabled @if(!old('status')) selected @endif>Pilih Status</option>
                                @if(old('status') === "0")
                                    <option selected value="0">Masih Dipinjam</option>
                                    <option value="1">Sudah Dikembalikan</option>
                                @elseif(old('status') === "1")
                                    <option selected value="1">Sudah Dikembalikan</option>
                                    <option value="0">Masih Dipinjam</option>
                                @else
                                    <option value="0">Masih Dipinjam</option>
                                    <option value="1">Sudah Dikembalikan</option>
                                @endif
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
