@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Surat Bebas Labkom')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Surat Bebas Labkom</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Surat Bebas Labkom</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Surat Bebas Labkom</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <a href="{{ route('SuratBebasLabkom.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-user-plus"></i>
                        Insert Data
                    </a>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
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
                            Jurusan
                        </th>
                        <th >
                            #
                        </th>
                    </tr>
                </thead>
                <tbody>

{{--                @foreach($Surat as $elemen)--}}
{{--                    <tr>--}}
{{--                        <td class="text-center">--}}
{{--                            {{ $i++ }}--}}
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
{{--                            <a class="btn btn-primary btn-sm" href="{{ route('SuratBebasLabkom.show', $elemen->id) }}">--}}
{{--                                <i class="fas fa-folder"></i>--}}
{{--                                Detail--}}
{{--                            </a>--}}
{{--                            <a class="btn btn-info btn-sm" href="{{ route('SuratBebasLabkom.edit', $elemen->id) }}">--}}
{{--                                <i class="fas fa-pencil-alt"></i>--}}
{{--                                Edit--}}
{{--                            </a>--}}
{{--                            <form action="{{ route('SuratBebasLabkom.destroy', $elemen->id) }}" method="post">--}}
{{--                                @method('delete')--}}
{{--                                @csrf--}}
{{--                                <a style="margin: 0; padding: 4px;" class="btn btn-danger btn-sm" href="#">--}}
{{--                                    <i class="fas fa-trash"></i>--}}
{{--                                    <input class="btn btn-danger btn-sm" type="submit" name="submit" value="Delete">--}}
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
