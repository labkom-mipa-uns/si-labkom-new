@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Peminjaman Lab | Edit Data')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Data Peminjam</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('PeminjamanLab.index') }}">Peminjaman Lab</a></li>
                <li class="breadcrumb-item active">Edit Data</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <form action="{{ route('PeminjamanLab.update', $PeminjamanLab->id) }}" method="post">
        @csrf
        @method('put')
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
                            @foreach($Mahasiswa as $elemen)
                                @if($elemen->id === $PeminjamanLab->id_mahasiswa)
                                    <option selected value="{{ $PeminjamanLab->id }}">{{ $PeminjamanLab->mahasiswa->nama_mahasiswa }}</option>
                                @else
                                    <option value="{{ $elemen->id}}">{{ $elemen->nama_mahasiswa }}</option>
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
                            <input type="date" name="tanggal" id="Tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ $PeminjamanLab->tanggal }}">
                            @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Jadwal">Jadwal :</label>
                            <select name="id_jadwal" id="Jadwal" class="custom-select @error('id_jadwal') is-invalid @enderror" >
                            @foreach($Jadwal as $elemen)
                                @if($elemen->id === $PeminjamanLab->id_jadwal)
                                    <option selected value="{{ $PeminjamanLab->id_jadwal }}">{{ $PeminjamanLab->jadwal->dosen->nama_dosen }} - {{ $PeminjamanLab->jadwal->matakuliah->nama_matkul }} - {{ $PeminjamanLab->jadwal->prodi->nama_prodi }}</option>
                                @else
                                    <option value="{{ $elemen->id }}">{{ $elemen->dosen->nama_dosen }} - {{ $elemen->matakuliah->nama_matkul }} - {{ $elemen->prodi->nama_prodi }}</option>
                                @endif
                            @endforeach
                            </select>
                            @error('id_jadwal')
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
                            <select name="id_lab" id="Lab" class="custom-select @error('id_lab') is-invalid @enderror">
                                @foreach($Lab as $elemen)
                                    @if($elemen->id === $PeminjamanLab->id_lab)
                                        <option selected value="{{ $PeminjamanLab->id_lab }}">{{ $PeminjamanLab->lab->nama_lab }}</option>
                                    @else
                                        <option value="{{ $elemen->id }}">{{ $elemen->nama_lab }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('id_lab')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="JamPinjam">Jam Pinjam :</label>
                            <input type="time" name="jam_pinjam" id="JamPinjam" class="form-control @error('jam_pinjam') is-invalid @enderror" value="{{ $PeminjamanLab->jam_pinjam }}">
                            @error('jam_pinjam')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="JamKembali">Jam Kembali :</label>
                            <input type="time" name="jam_kembali" id="JamKembali" class="form-control @error('jam_kembali') is-invalid @enderror" value="{{ $PeminjamanLab->jam_kembali }}">
                            @error('jam_kembali')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Keperluan">Keperluan :</label>
                            <textarea name="keperluan" cols="40" rows="4" id="Keperluan" class="form-control @error('keperluan') is-invalid @enderror" placeholder="Masukkan keperluan">{{ $PeminjamanLab->keperluan }}</textarea>
                            @error('keperluan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori :</label>
                            <select name="kategori" id="kategori" class="custom-select @error('kategori') is-invalid @enderror">
                                @if($PeminjamanLab->kategori === 'didalam_jam')
                                    <option selected value="{{ $PeminjamanLab->kategori }}">Didalam Jam Kuliah</option>
                                    <option value="diluar_jam">Diluar Jam Kuliah</option>
                                @else
                                    <option selected value="{{ $PeminjamanLab->kategori }}">Diluar Jam Kuliah</option>
                                    <option value="didalam_jam">Didalam Jam Kuliah</option>
                                @endif
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status :</label>
                            <select name="status" id="status" class="custom-select @error('status') is-invalid @enderror">
                                @if($PeminjamanLab->status === '0')
                                    <option selected value="{{ $PeminjamanLab->status }}">Masih Dipinjam</option>
                                    <option value="1">Sudah Dikembalikan</option>
                                @else
                                    <option value="{{ $PeminjamanLab->status }}">Sudah Dikembalikan</option>
                                    <option value="0">Masih Dipinjam</option>
                                @endif
                            </select>
                        </div>
                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
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
