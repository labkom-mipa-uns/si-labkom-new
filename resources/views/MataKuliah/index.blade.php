@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Mata Kuliah')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar Mata Kuliah</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Mata Kuliah</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="matakuliah-success" data-flashdata="{{ session('success') }}"></div>
    <div class="matakuliah-warning" data-flashdata="{{ session('warning') }}"></div>
    <div class="matakuliah-danger" data-flashdata="{{ session('danger') }}"></div>
@endsection

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Mata Kuliah</h3>
            <div class="card-tools">
                <a href="{{ route('MataKuliah.create') }}" class="btn btn-primary btn-sm">
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
                            Nama Mata Kuliah
                        </th>
                        <th>
                            #
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($MataKuliah as $elemen)
                    <tr>
                        <td class="text-center">
                            {{ ($MataKuliah->currentPage() - 1) * $MataKuliah->perPage() + $loop->index + 1 }}
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->nama_matkul }}
                            </a>
                        </td>
                        <td class="project-actions text-right">
                            <button class="btn btn-secondary btn-sm detail-matakuliah-button" type="button" data-toggle="modal" data-target="#matakuliahModal" data-showurl="{{ route('MataKuliah.show', $elemen->id) }}">
                                <i class="fas fa-folder"></i>
                                Detail
                            </button>
                            <a class="btn btn-info btn-sm" href="{{ route('MataKuliah.edit', $elemen->id) }}">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </a>
                            <form action="{{ route('MataKuliah.destroy', $elemen->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm delete-matakuliah-button" type="submit">
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
                {{ $MataKuliah->links() }}
            </section>
        </div>
        <!-- /.card-body -->
        <div id="detail-matakuliah"></div>
    </div>
    <!-- /.card -->
@endsection
