@extends('adminlte::page')
@section('title', 'Labkom FMIPA UNS | Surat Bebas Labkom')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar Surat Bebas Labkom</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Surat Bebas Labkom</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="suratbebaslabkom-success" data-flashdata="{{ session('success') }}"></div>
    <div class="suratbebaslabkom-warning" data-flashdata="{{ session('warning') }}"></div>
    <div class="suratbebaslabkom-danger" data-flashdata="{{ session('danger') }}"></div>
@endsection

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Surat Bebas Labkom</h3>
            <div class="card-tools">
                <a href="{{ route('SuratBebasLabkom.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-user-plus"></i>
                    Insert
                </a>
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
                            Tanggal
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

                @foreach($SuratBebasLabkom as $elemen)
                    <tr>
                        <td class="text-center">
                            {{ ($SuratBebasLabkom->currentPage() - 1) * $SuratBebasLabkom->perPage() + $loop->index + 1 }}
                        </td>
                        <td class="text-center">
                            <a>
                                {{ $elemen->tanggal }}
                            </a>
                        </td>
                        <td class="text-center">
                            <a class="d-inline">
                                {{ $elemen->mahasiswa->nama_mahasiswa }}
                            </a>
                            <small>
                                {{ $elemen->mahasiswa->kelas }} | {{ $elemen->mahasiswa->nim }}
                            </small>
                        </td>
                        <td class="text-center">
                            <a class="d-inline">
                                {{ $elemen->mahasiswa->prodi->nama_prodi }}
                            </a>
                            <small>
                                {{ $elemen->mahasiswa->angkatan }}
                            </small>
                        </td>
                        <td class="project-actions text-right">
                            <button class="btn btn-secondary btn-sm detail-suratbebaslabkom-button" data-toggle="modal" data-target="#suratbebaslabkomModal" data-showurl="{{ route('SuratBebasLabkom.show', $elemen->id) }}">
                                <i class="fas fa-folder"></i>
                                Detail
                            </button>
                            <a class="btn btn-info btn-sm" href="{{ route('SuratBebasLabkom.edit', $elemen->id) }}">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </a>
                            <form action="{{ route('SuratBebasLabkom.destroy', $elemen->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm delete-suratbebaslabkom-button" type="submit">
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
                {{ $SuratBebasLabkom->links() }}
            </section>
        </div>
        <!-- /.card-body -->
        <div id="detail-suratbebaslabkom"></div>
    </div>
    <!-- /.card -->
@endsection
