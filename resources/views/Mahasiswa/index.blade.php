@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Mahasiswa')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar Mahasiswa</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Mahasiswa</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="mahasiswa-success" data-flashdata="{{ session('success') }}"></div>
    <div class="mahasiswa-warning" data-flashdata="{{ session('warning') }}"></div>
    <div class="mahasiswa-danger" data-flashdata="{{ session('danger') }}"></div>
@endsection

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Mahasiswa</h3>
            <div class="card-tools">
                <a href="{{ route('Mahasiswa.create') }}" class="btn btn-primary btn-sm">
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
                        NIM
                    </th>
                    <th class="text-center">
                        Nama
                    </th>
                    <th class="text-center">
                        Prodi
                    </th>
                    <th class="text-center">
                        Angkatan
                    </th>
                    <th>
                        #
                    </th>
                </tr>
                </thead>
                <tbody>

                @foreach($Mahasiswa as $elemen)
                    <tr>
                        <td class="text-center">
                            {{ ($Mahasiswa->currentPage() - 1) * $Mahasiswa->perPage() + $loop->index + 1 }}
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->nim }}
                            </a>
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->nama_mahasiswa }}
                            </a>
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->prodi->nama_prodi }}
                            </a>
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->angkatan }}
                            </a>
                        </td>
                        <td class="project-actions text-right">
                            <button class="btn btn-secondary btn-sm detail-mahasiswa-button" type="button" data-toggle="modal" data-target="#mahasiswaModal" data-showurl="{{ route('Mahasiswa.show',$elemen->id ) }}">
                                <i class="fas fa-folder"></i>
                                Detail
                            </button>
                            <a class="btn btn-info btn-sm" href="{{ route('Mahasiswa.edit', $elemen->id) }}">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </a>
                            <form action="{{ route('Mahasiswa.destroy', $elemen->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm delete-mahasiswa-button" type="submit">
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
                {{ $Mahasiswa->links() }}
            </section>
        </div>
        <!-- /.card-body -->
        <div id="detail-mahasiswa"></div>
    </div>
    <!-- /.card -->
@endsection

