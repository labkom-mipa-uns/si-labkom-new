@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Peminjaman Lab')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Peminjaman Lab</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Peminjaman Lab</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Peminjaman Lab</h3>
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
                        <th >
                            #
                        </th>
                    </tr>
                </thead>
                <tbody>

                @foreach($PeminjamanLab as $elemen)
                    <tr>
                        <td class="text-center">
                            {{ $loop->iteration() }}
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->tanggal }}
                            </a>
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->nama_mahasiswa }}
                            </a>
                            <br>
                            <small>
                                {{ $elemen->kelas }} - {{ $elemen->nim }}
                            </small>
                            <br>
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->nama_prodi }}
                            </a>
                            <br>
                            <small>
                                {{ $elemen->angkatan }}
                            </small>
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->nama_matkul }}
                            </a>
                            <a>
                                {{ $elemen->nama_dosen }}
                            </a>
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->nama_lab }}
                            </a>
                            <a>
                                {{ $elemen->jam_pinjam }} - {{ $elemen->jam_kembali }}
                            </a>
                        </td>
                        <td class="project-actions text-right">
                            <button class="btn btn-primary btn-sm" type="button">
                                <i class="fas fa-folder"></i>
                                Detail
                            </button>
                            <a class="btn btn-info btn-sm" href="{{ route('PeminjamanLab.edit', $elemen->id) }}">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </a>
                            <form action="{{ route('PeminjamanLab.destroy') }}" method="post">
                                @method('delete')
                                @csrf
                                <a class="btn btn-danger btn-sm" href="{{ route('PeminjamanLab.destroy', $elemen->id) }}">
                                    <i class="fas fa-trash"></i>
                                    <input class="btn btn-danger btn-sm" type="submit" name="submit" value="Delete">
                                </a>
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

