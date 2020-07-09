@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Laboratorium')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar Laboratorium</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Laboratorium</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Laboratorium</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <a href="{{ route('Prodi.create') }}" class="btn btn-primary btn-sm">
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
                        Laboratorium
                    </th>
                    <th>
                        #
                    </th>
                </tr>
                </thead>
                <tbody>

                @foreach($Laboratorium as $elemen)
                    <tr>
                        <td class="text-center">
                            {{ $loop->iteration() }}
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->nama_lab }}
                            </a>
                        </td>
                        <td class="project-actions text-right">
                            <button class="btn btn-secondary btn-sm" type="button">
                                <i class="fas fa-folder"></i>
                                Detail
                            </button>
                            <a class="btn btn-info btn-sm" href="{{ route('Laboratorium.edit', $elemen->id) }}">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </a>
                            <form action="{{ route('Laboratorium.destroy', $elemen->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <a class="btn btn-danger btn-sm" href="{{ route('Laboratorium.destroy', $elemen->id) }}">
                                    <i class="fas fa-trash"></i>
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
