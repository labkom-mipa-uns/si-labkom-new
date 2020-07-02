@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Peminjaman Alat')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Peminjaman Alat</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Peminjaman Alat</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <!-- Default box -->
    <div class="card shadow">
        <div class="card-header">
            <h3 class="card-title">Data Peminjaman Alat</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <a href="{{ route('PeminjamanAlat.create') }}" class="btn btn-primary btn-sm">
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
                        Hari, Tanggal
                    </th>
                    <th class="text-center">
                        Nama
                    </th>
                    <th class="text-center">
                        Prodi
                    </th>
                    <th >
                        #
                    </th>
                </tr>
                </thead>
                <tbody>

{{--                @foreach($PeminjamanAlat as $elemen)--}}
{{--                    <tr>--}}
{{--                        <td class="text-center">--}}
{{--                            {{ $loop->iteration }}--}}
{{--                        </td>--}}
{{--                        <td class="text-center">--}}
{{--                            <a>--}}
{{--                                {{ $elemen->hari }}, {{ $elemen->tanggal }}--}}
{{--                            </a>--}}
{{--                        </td>--}}
{{--                        <td class="text-center">--}}
{{--                            <a>--}}
{{--                                {{ $elemen->nama_mahasiswa }}--}}
{{--                            </a>--}}
{{--                            <br>--}}
{{--                            <small>--}}
{{--                                {{ $elemen->nim_mahasiswa }}--}}
{{--                            </small>--}}
{{--                        </td>--}}
{{--                        <td class="text-center">--}}
{{--                            <a>--}}
{{--                                {{ $elemen->nama_prodi }}--}}
{{--                            </a>--}}
{{--                            <br>--}}
{{--                            <small>--}}
{{--                                {{ $elemen->tahun_angkatan }}--}}
{{--                            </small>--}}
{{--                        </td>--}}
{{--                        <td class="project-actions text-right">--}}
{{--                            <a class="btn btn-primary btn-sm" href="/PeminjamanAlat/{{ $elemen->id }}">--}}
{{--                                <i class="fas fa-folder"></i>--}}
{{--                                Detail--}}
{{--                            </a>--}}
{{--                            <a class="btn btn-info btn-sm" href="/PeminjamanAlat/{{ $elemen->id }}/edit">--}}
{{--                                <i class="fas fa-pencil-alt"></i>--}}
{{--                                Edit--}}
{{--                            </a>--}}
{{--                            <form action="/PeminjamanAlat/{{ $elemen->id }}" method="post">--}}
{{--                                @method('delete')--}}
{{--                                @csrf--}}
{{--                                <a class="btn btn-danger btn-sm" href="#">--}}
{{--                                    <i class="fas fa-trash"></i>--}}
{{--                                    <input style="margin: 0; padding: 0;" class="btn btn-danger btn-sm" type="submit" name="submit" value="Delete">--}}
{{--                                </a>--}}
{{--                            </form>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
