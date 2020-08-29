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
    <div class="lab-success" data-flashdata="{{ session('success') }}"></div>
    <div class="lab-warning" data-flashdata="{{ session('warning') }}"></div>
    <div class="lab-danger" data-flashdata="{{ session('danger') }}"></div>
@endsection

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Laboratorium</h3>
            <div class="card-tools">
                <a href="{{ route('Laboratorium.create') }}" class="btn btn-primary btn-sm">
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
                            {{ ($Laboratorium->currentPage() - 1) * $Laboratorium->perPage() + $loop->index + 1 }}
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->nama_lab }}
                            </a>
                        </td>
                        <td class="project-actions text-right">
                            <button class="btn btn-secondary btn-sm detail-lab-button" type="button" data-toggle="modal" data-target="#labModal" data-showurl="{{ route('Laboratorium.show', $elemen->id) }}">
                                <i class="fas fa-folder"></i>
                                Detail
                            </button>
                            <a class="btn btn-info btn-sm" href="{{ route('Laboratorium.edit', $elemen->id) }}">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </a>
                            <form action="{{ route('Laboratorium.destroy', $elemen->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm delete-lab-button" type="submit">
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
                {{ $Laboratorium->links() }}
            </section>
        </div>
        <!-- /.card-body -->
        <div id="detail-lab"></div>
    </div>
    <!-- /.card -->
@endsection
