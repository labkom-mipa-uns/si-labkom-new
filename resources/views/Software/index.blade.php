@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Software')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar Software</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Software</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="software-success" data-flashdata="{{ session('success') }}"></div>
    <div class="software-warning" data-flashdata="{{ session('warning') }}"></div>
    <div class="software-danger" data-flashdata="{{ session('danger') }}"></div>
@endsection

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Software</h3>
            <div class="card-tools">
                <a href="{{ route('Software.create') }}" class="btn btn-primary btn-sm">
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
                        Nama Software
                    </th>
                    <th class="text-center">
                        Harga Software
                    </th>
                    <th>
                        #
                    </th>
                </tr>
                </thead>
                <tbody>

                @foreach($Software as $elemen)
                    <tr>
                        <td class="text-center">
                            {{ ($Software->currentPage() - 1) * $Software->perPage() + $loop->index + 1 }}
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->nama_software }}
                            </a>
                        </td>
                        <td class="text-center">
                            <a>
                                Rp.{{ $elemen->harga_software }}
                            </a>
                        </td>
                        <td class="project-actions text-right">
                            <button class="btn btn-secondary btn-sm detail-software-button" type="button" data-toggle="modal" data-target="#softwareModal" data-showurl="{{ route('Software.show', $elemen->id) }}">
                                <i class="fas fa-folder"></i>
                                Detail
                            </button>
                            <a class="btn btn-info btn-sm" href="{{ route('Software.edit', $elemen->id) }}">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </a>
                            <form action="{{ route('Software.destroy', $elemen->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm delete-software-button" type="submit">
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
                {{ $Software->links() }}
            </section>
        </div>
        <!-- /.card-body -->
        <div id="detail-software"></div>
    </div>
    <!-- /.card -->
@endsection
