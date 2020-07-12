@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Peminjaman Lab')
{{--@section('js')--}}
{{--    <script src="{{ asset('js/app.js') }}"></script>--}}
{{--@endsection--}}

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar Peminjam Lab</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Peminjaman Lab</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
{{--    <div class="flashdata-success" data-flashdata="{{ session('success') }}"></div>--}}
{{--    <div class="flashdata-warning" data-flashdata="{{ session('warning') }}"></div>--}}
{{--    <div class="flashdata-danger" data-flashdata="{{ session('danger') }}"></div>--}}
    @if(session('success'))
    <div class="row mt-2">
        <div class="col-sm">
            <div class="alert alert-default-success alert-dismissible fade show m-0" role="alert">
                Data Peminjam Lab <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @elseif(session('warning'))
    <div class="row mt-2">
        <div class="col-sm">
            <div class="alert alert-default-warning alert-dismissible fade show m-0" role="alert">
                <strong>{{ session('warning') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @elseif(session('danger'))
    <div class="row mt-2">
        <div class="col-sm">
            <div class="alert alert-default-danger alert-dismissible fade show m-0" role="alert">
                Data Peminjam Lab <strong>{{ session('danger') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Peminjam Lab</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <a href="{{ route('PeminjamanLab.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-user-plus"></i>
                        Insert
                    </a>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center">
                            No
                        </th>
                        <th class="text-center">
                            Tanggal
                        </th>
                        <th class="text-center">
                            Nama
                        </th>
                        <th class="text-center">
                            Prodi
                        </th>
                        <th class="text-center">
                            Mata Kuliah
                        </th>
                        <th class="text-center">
                            Lab
                        </th>
                        <th>
                            #
                        </th>
                    </tr>
                </thead>
                <tbody>

                @foreach($PeminjamanLab as $elemen)
                    <tr>
                        <td class="text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->tanggal }}
                            </a>
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->mahasiswa->nama_mahasiswa }}
                            </a>
                            <br>
                            <small>
                                {{ $elemen->mahasiswa->kelas }} - {{ $elemen->mahasiswa->nim }}
                            </small>
                            <br>
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->jadwal->prodi->nama_prodi }}
                            </a>
                            <br>
                            <small>
                                {{ $elemen->mahasiswa->angkatan }}
                            </small>
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->jadwal->matakuliah->nama_matkul }}
                            </a>
                            <br>
                            <small>
                                {{ $elemen->jadwal->dosen->nama_dosen }}
                            </small>
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->lab->nama_lab }}
                            </a>
                            <br>
                            <small>
                                {{ $elemen->jam_pinjam }} - {{ $elemen->jam_kembali }}
                            </small>
                        </td>
                        <td class="project-actions text-right">
                            <button class="btn btn-secondary btn-sm" type="button">
                                <i class="fas fa-folder"></i>
                                Detail
                            </button>
                            <a class="btn btn-info btn-sm" href="{{ route('PeminjamanLab.edit', $elemen->id) }}">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </a>
                            <form action="{{ route('PeminjamanLab.destroy', $elemen->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm" type="submit">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

@endsection
