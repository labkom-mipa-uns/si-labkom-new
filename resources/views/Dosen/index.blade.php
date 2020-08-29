@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Dosen ')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar Dosen</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Dosen</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="dosen-success" data-flashdata="{{ session('success') }}"></div>
    <div class="dosen-warning" data-flashdata="{{ session('warning') }}"></div>
    <div class="dosen-danger" data-flashdata="{{ session('danger') }}"></div>

@endsection

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Dosen</h3>
            <div class="card-tools">
                <a href="{{ route('Dosen.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-user-plus"></i>
                    Insert
                </a>
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
                        Dosen
                    </th>
                    <th>
                        #
                    </th>
                </tr>
                </thead>
                <tbody>

                @foreach($Dosen as $elemen)
                    <tr>
                        <td class="text-center">
                            {{ ($Dosen->currentPage() - 1) * $Dosen->perPage() + $loop->index + 1 }}
                        </td>
                        <td class="text-center">
                            <a class="d-block">
                                {{ $elemen->nama_dosen }}
                            </a>
                            <small>
                                {{ $elemen->nidn }}
                            </small>
                        </td>
                        <td class="project-actions text-right">
                            <button class="btn btn-secondary btn-sm detail-dosen-button" type="button" data-toggle="modal" data-target="#dosenModal" data-showurl="{{ route('Dosen.show', $elemen->id) }}">
                                <i class="fas fa-folder"></i>
                                Detail
                            </button>
                            <a class="btn btn-info btn-sm" href="{{ route('Dosen.edit', $elemen->id) }}">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </a>
                            <form action="{{ route('Dosen.destroy', $elemen->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm delete-dosen-button" type="submit">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <section class="d-flex align-items-center justify-content-center mt-3">
                {{ $Dosen->links() }}
            </section>
        </div>
        <!-- /.card-body -->
        <div id="detail-dosen"></div>
    </div>
    <!-- /.card -->

@endsection
